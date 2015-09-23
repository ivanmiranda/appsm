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
# Clase abstracta para cualquier modelo en la aplicación, cualquier instancia derivada se conecta automaticamente a la BD
# -----------------------

abstract class Sfphp_Modelo {
	protected $db;
	protected $_campos = array();
	
	public function __construct() {
	# Crear la conexion
		$this->db = Sfphp_BaseDatos::get();
	}
	# Método básico para traer todos los registros siempre que el nombre del modelo
	# corresponda con el nombre de la tabla
	public function todos() {
		$tabla = lcfirst(str_replace("Modelos_", "", get_class($this)));
		return $this->db->query("SELECT * FROM ".$tabla.";");
	}


}