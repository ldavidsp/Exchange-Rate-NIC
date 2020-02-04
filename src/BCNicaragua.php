<?php


namespace NIBanks;

use Banks\Banks;
use Carbon\Carbon;

class BCNicaragua implements Banks {

	/**
	 * @inheritDoc
	 *
	 * Today Exchange Rate Central Bank
	 */
	public function todayCentralBank(): string {
		$today =  Carbon::now();
		$urlWSDL = 'https://servicios.bcn.gob.ni/Tc_Servicio/ServicioTC.asmx?WSDL';
		$options = [
			'cache_wsdl' => 0,
			'trace' => 1,
			'stream_context' => stream_context_create([
				'ssl' => [
					'verify_peer' => false,
					'verify_peer_name' => false,
					'allow_self_signed' => true
				]
			])
		];

		$params = [
			'Dia' => $today->format('d'),
			'Mes' => $today->format('m'),
			'Ano' => $today->format('Y'),
		];

		try {
			$client = new \SoapClient($urlWSDL, $options);
			return $client->RecuperaTC_Dia($params)->RecuperaTC_DiaResult;
		} catch (\SoapFault $e) {
			return $e->getMessage();
		}
	}

	/**
	 * @inheritDoc
	 *
	 * Month Exchange Rate Central Bank
	 */
	public function monthCentralBank(int $year, int $month) {
		$urlWSDL = 'https://servicios.bcn.gob.ni/Tc_Servicio/ServicioTC.asmx?WSDL';
		$options = [
			'cache_wsdl' => 0,
			'trace' => 1,
			'stream_context' => stream_context_create([
				'ssl' => [
					'verify_peer' => false,
					'verify_peer_name' => false,
					'allow_self_signed' => true
				]
			])
		];

		$params = [
			'Mes' => 2,
			'Ano' => 2020,
		];

		try {
			$dollar = [];
			$client = new \SoapClient($urlWSDL, $options);
			$xml = (array) $client->RecuperaTC_Mes($params)->RecuperaTC_MesResult;
			$response = simplexml_load_string($xml['any']);
			$json = json_encode($response);
			$array = json_decode($json,TRUE);

			foreach ($array['Tc'] as $key => $value) {
				$val = (object) $value;
				if (!empty($val->Fecha) && !empty($val->Valor)) {
					$dollar[$key] = [
						'date' => $val->Fecha,
						'amount' => $val->Valor,
					];
				}
			}

			return $dollar;
		} catch (\SoapFault $e) {
			return $e->getMessage();
		}
	}

}