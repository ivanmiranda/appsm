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
# Clase abstracta para cualquier controlador en la aplicación
# -----------------------

abstract class Sfphp_Controlador {
	protected $_vista;
	protected $_modelo;
	
	# Cualquier instancia tiene el atributo de vista inicilizado
	public function __construct(){
		$this->_vista = new Sfphp_Vista();
	}
	# Metodo mágico para cargar elementos al controlador
	public function __get($elemento) {
	# Modelos
		if("modelo" == substr($elemento,0,6)) {
			$clase = "Modelos_".substr($elemento,6);
			$_modelo = explode("_", get_class($this));
			$_modelo = strtolower($_modelo[0]);
			return new $clase();
		}
	# Vistas
		if("vista" == substr($elemento,0,5)) {
			#var_dump($this->_vista);
			$this->_vista->dibuja(substr($elemento,5));
		}
	# Atributos
		if("get" == substr($elemento,0,3)) {
			$elemento = $this->nombreAtributo($elemento);
			return $this->$elemento;
		}
	}

	# Activa el método mágico SET para cualquier elemento privado
	public function __set($elemento, $valor) {
		if("set" == substr($elemento,0,3)) {
			$elemento = $this->nombreAtributo($elemento);
			$this->$elemento = $valor;
		}
	}

	# Nombre del atributo a usarse en los __get __set
	private function nombreAtributo($atributo) {
		$atributo = str_replace("(", "", $atributo);
		$atributo = str_replace(")", "", $atributo);
		$atributo = "_".strtolower(substr($atributo, 3));
		return $atributo;
	}
}