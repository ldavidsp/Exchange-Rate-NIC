<?php


namespace Banks;


interface Banks {

	/**
	 * Today central bank
	 */
	public function todayCentralBank();

	/**
	 * @param int $day
	 * @param int $month
	 *
	 * Month central bank
	 */
	public function monthCentralBank(int $day, int $month);
}