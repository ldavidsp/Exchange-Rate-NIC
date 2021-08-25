<?php


namespace NIBanks\banks;

use GuzzleHttp\Client;
use NIBanks\interfaces\BAC;

/**
 *
 * @property false|string htmlContent
 */
class BACCredomatic implements BAC {

  /**
   * @inheritDoc
   *
   * Today Exchange Rate Dollar BAC
   * @throws \GuzzleHttp\Exception\GuzzleException
   */
  public static function todayDollar(): array {
    $client = new Client();
    $response = $client->request('GET', bac_credomatic());
    if ($response->getStatusCode() == 200) {
      $exchangerate = json_decode(json_encode(simplexml_load_string($response->getBody())));
      $position = array_search('Nicaragua', array_column($exchangerate->country, 'name'));
      $dollar = $exchangerate->country[$position];
      return [
        'buy' => number_format($dollar->buyRateUSD, 2),
        'sale' => number_format($dollar->saleRateUSD, 2),
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
    $response = $client->request('GET', bac_credomatic());
    if ($response->getStatusCode() == 200) {
      $exchangerate = json_decode(json_encode(simplexml_load_string($response->getBody())));
      $position = array_search('Nicaragua', array_column($exchangerate->country, 'name'));
      $euro = $exchangerate->country[$position];
      return [
        'buy' => number_format($euro->buyRateEUR, 2),
        'sale' => number_format($euro->saleRateEUR, 2),
      ];
    }
    return [];
  }

}