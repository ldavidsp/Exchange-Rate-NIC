<?php


namespace NIBanks\interfaces;


interface BCN {

  /**
   * Today Central Bank
   */
  public static function todayDollar(): string;

  /**
   * @param int $day
   * @param int $month
   *
   * Month Central Bank
   */
  public static function monthDollar(int $day, int $month);

}
