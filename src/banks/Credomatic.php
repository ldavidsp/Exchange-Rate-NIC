<?php


namespace NIBanks\banks;

use GuzzleHttp\Client;
use NIBanks\interfaces\BAC;

class Credomatic implements BAC {

  /**
   * @inheritDoc
   *
   * Today Exchange Rate Dollar BAC
   */
  public static function todayDollar(): array {
    $client = new Client();
    $response = $client->request('GET', 'https://www.baccredomatic.com/es-ni/bac/exchange-rate-ajax/es-ni');
    if ($response->getStatusCode() == 200) {
      $dollar = json_decode($response->getBody(), TRUE);
      return [
        'buy' => number_format($dollar['buyRateUSD'], 4, '.', ','),
        'sales' => number_format($dollar['saleRateUSD'], 4, '.', ','),
      ];
    }
    return [];
  }

  /**
   * @inheritDoc
   */
  public static function todayEuro(): array {
    $client = new Client();
    $response = $client->request('GET', 'https://www.baccredomatic.com/es-ni/bac/exchange-rate-ajax/es-ni');
    if ($response->getStatusCode() == 200) {
      $dollar = json_decode($response->getBody(), TRUE);
      return [
        'buy' => number_format($dollar['buyRateEUR'], 4, '.', ','),
        'sales' => number_format($dollar['saleRateEUR'], 4, '.', ','),
      ];
    }
    return [];
  }

}