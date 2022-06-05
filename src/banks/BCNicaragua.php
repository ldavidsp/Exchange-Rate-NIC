<?php


namespace NIBanks\banks;

use NIBanks\interfaces\BCN;

class BCNicaragua implements BCN {

  /**
   * @inheritDoc
   *
   * Today Exchange Rate Central Bank
   */
  public static function todayDollar(): string {
    $today = new \DateTime();
    $urlWSDL = bcn_nicaragua();
    $options = [
      'cache_wsdl' => 0,
      'trace' => 1,
      'stream_context' => stream_context_create([
        'ssl' => [
          'verify_peer' => FALSE,
          'verify_peer_name' => FALSE,
          'allow_self_signed' => TRUE,
        ],
      ]),
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
  public static function monthDollar(int $year, int $month): array {
    $urlWSDL = bcn_nicaragua();
    $options = [
      'cache_wsdl' => 0,
      'trace' => 1,
      'stream_context' => stream_context_create([
        'ssl' => [
          'verify_peer' => FALSE,
          'verify_peer_name' => FALSE,
          'allow_self_signed' => TRUE,
        ],
      ]),
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
      $array = json_decode($json, TRUE);

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
