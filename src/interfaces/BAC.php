<?php


namespace NIBanks\interfaces;

/**
 * BAC Interface.
 */
interface BAC {

  /**
   * Today Dollar BAC
   */
  public static function todayDollar(): array;

  /**
   * Today Euro BAC
   */
  public static function todayEuro(): array;

}
