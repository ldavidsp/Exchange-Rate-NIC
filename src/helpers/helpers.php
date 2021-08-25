<?php

if (!function_exists('bac_credomatic')) {
  /**
   * @return string
   */
  function bac_credomatic(): string {
    return 'https://www.sucursalelectronica.com/exchangerate/showXmlExchangeRate.do';
  }
}

if (!function_exists('banpro_nicaragua')) {
  /**
   * @return string
   */
  function banpro_nicaragua(): string {
    return 'https://www.banprogrupopromerica.com.ni/umbraco/Surface/TipoCambio/Run';
  }
}

if (!function_exists('bcn_nicaragua')) {
  /**
   * @param $month
   * @param $year
   *
   * @return string
   */
  function bcn_nicaragua($month, $year): string {
    return "https://www.bcn.gob.ni/IRR/tipo_cambio_mensual/mes.php?mes=' . $month . '&anio=' . $year'";
  }
}
