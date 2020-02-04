<?php


namespace Banks;


interface Banks {

	/**
	 * Today central bank
	 */
	public static function todayCentralBank();

	/**
	 * @param int $day
	 * @param int $month
	 *
	 * Month central bank
	 */
	public static function monthCentralBank(int $day, int $month);
}