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
# Ejecución del framework
# -----------------------

require_once './Sfphp/_base.php';
# Carga de configuración de la app
Sfphp_Config::get();
if(DEV_SHOWPHPERRORS)
	error_reporting(-1);
else
	error_reporting(0);
# Inicia la app
try {
	new Sfphp_Disparador;
} catch (Sfphp_Error $e) {
	var_dump($e);
}
