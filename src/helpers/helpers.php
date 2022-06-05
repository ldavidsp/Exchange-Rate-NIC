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
   * @return string
   */
  function bcn_nicaragua(): string {
    return "https://servicios.bcn.gob.ni/Tc_Servicio/ServicioTC.asmx?WSDL";
  }
}
