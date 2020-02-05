<?php


namespace NIBanks\interfaces;


interface Banks {

  /**
   * Today Central Bank
   */
  public static function todayCentralBank(): string ;

  /**
   * @param int $day
   * @param int $month
   *
   * Month Central Bank
   */
  public static function monthCentralBank(int $day, int $month);

}
