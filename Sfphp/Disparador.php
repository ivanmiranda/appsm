<?php
# NOTICE OF LICENSE
#
# This source file is subject to the Open Software License (OSL 3.0)
# that is available through the world-wide-web at this URL:
# http://opensource.org/licenses/osl-3.0.php
#
# -----------------------
# @author: Iván Miranda
# @version: 1.0.0
# -----------------------
# Ejecución de eventos según la petición realizada desde el navegador
# -----------------------

class Sfphp_Disparador {
	public function __construct() {
		Sfphp_Sesion::get();
		$peticion = Sfphp_Peticion::get();
		$clase = NULL;
		if(!is_null($peticion['_modulo']))
			$clase = ucwords($peticion['_modulo'])."_";
		$clase .= "Controladores_".ucwords($peticion['_control']);
		try {
			$objClase = new $clase();
			if(is_callable(array($objClase, $peticion['_accion'])))
				call_user_func(array($objClase, $peticion['_accion']));
			else
				throw new Sfphp_Error("La accion {$peticion['_accion']} no esta definida en {$clase}", 1);
		} catch (Sfphp_Error $e) {
			Sfphp_Logs::procesa($e);
		}
	}

	public function all()
	{
		if(!self::$instancia instanceof self)
			self::$instancia = new self();
		return self::$instancia->config;
	}
}