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
    $today->format('d');
    $dollar = self::monthDollar($today->format('Y'), $today->format('m'));
	  $position = array_search($today->format('Y-m-d'), array_column($dollar, 'date'));
	  return $dollar[$position]->amount;
  }

  /**
   * @inheritDoc
   *
   * Month Exchange Rate Central Bank
   */
  public static function monthDollar(int $year, int $month): array {
    $dollar = [];
    $htmlContent = file_get_contents('https://www.bcn.gob.ni/IRR/tipo_cambio_mensual/mes.php?mes=' . $month . '&anio=' . $year);
    $DOM = new \DOMDocument();
    $DOM->loadHTML($htmlContent);
    $nodeTD = $DOM->getElementsByTagName('td');

    foreach ($nodeTD as $key => $td) {
      $id = ($key + 1);
      if ($id % 2 != 0 && $id != 1) {
        $day = explode('-', $nodeTD[$key]->textContent)[0];
        $date = $year . '-' . $month . '-' . $day;
        $dollar[] = (object) [
          'date' => trim($date),
          'amount' => trim($nodeTD[$id]->textContent),
        ];
      }
    }

    return $dollar;
  }

}
