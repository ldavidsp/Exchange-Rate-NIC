<?php


namespace NIBanks\banks;

use GuzzleHttp\Client;
use \NIBanks\interfaces\BANPRO;

/**
 * Grupo Banpro.
 */
class GrupoBanpro implements BANPRO {

  /**
   * @inheritDoc
   *
   * Today Exchange Rate Dollar BANPRO
   * @throws \GuzzleHttp\Exception\GuzzleException
   */
  public static function todayDollar(): array {
    $client = new Client();
    $response = $client->request('GET', banpro_nicaragua(), [
      'query' => ['json' => '{"operacion":2}'],
    ]);
    if ($response->getStatusCode() == 200) {
      $exchange = json_decode($response->getBody(), TRUE)['value'];
      $DOM = new \DOMDocument();
      $DOM->loadHTML($exchange);
      $nodeTD = $DOM->getElementsByTagName('td');

      return [
        'buy' => number_format($nodeTD[3]->textContent, 2),
        'sale' => number_format($nodeTD[4]->textContent, 2),
      ];
    }
    return [];
  }

	/**
	 * @inheritDoc
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 */
	public static function todayEuro(): array {
		$client = new Client();
		$response = $client->request('GET', banpro_nicaragua(), [
			'query' => ['json' => '{"operacion":2}'],
		]);
		if ($response->getStatusCode() == 200) {
			$exchange = json_decode($response->getBody(), TRUE)['value'];
			$DOM = new \DOMDocument();
			$DOM->loadHTML($exchange);
			$nodeTD = $DOM->getElementsByTagName('td');

			return [
				'buy' => number_format($nodeTD[6]->textContent, 2),
				'sale' => number_format($nodeTD[7]->textContent, 2),
			];
		}
		return [];
	}

}