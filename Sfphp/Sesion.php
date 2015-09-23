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
# Clase para control de sesion en el framework
# -----------------------

final class Sfphp_Sesion
{
	private static $instancia;

	private function __construct()
	{
		$config = Sfphp_Config::get();
		$config = $config['sesion'];
	#Que la cookie de sesión no pueda accederse por javascript.
        $httponly = true;
    #Configuracion para calcular el ID de la sesion
        $session_hash = 'sha512';
        if (in_array($session_hash, hash_algos()))
            ini_set('session.hash_function', $session_hash);
        ini_set('session.hash_bits_per_character', 5);
    #Fuerza a la sesión para que sólo use cookies, no variables URL.
        ini_set('session.use_only_cookies', 1);
    #Define el tiempo en que una sesion puede seguir activa sin tener algún cambio
        ini_set('session.gc_maxlifetime', $config['inactividad']);
    #Configura los parametros de la sesion
        $cookieParams = session_get_cookie_params();
    	if($cookieParams["lifetime"] == 0)
        	$cookieParams["lifetime"] = 28800; #Se mantiene una sesion activa hasta por 8 horas en el navegador
    #Configura los parámetros
        session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $config['ssl'], true); 
        session_save_path(str_replace("Frame", "Etc/Sesiones", realpath(dirname(__FILE__))));
    #Definir el tipo de manejador de las sesiones
    	if(strtoupper(trim($config['tipo'])) == "FILE")
			session_set_save_handler(new Sfphp_SesionFile(), true);
    	if(strtoupper(trim($config['inactividad'])) == "DB")
			session_set_save_handler(new Sfphp_SesionDB(), true);
    #Definir el nombre de la sesion segun la configuracion de la APP
		session_name($config['nombre']);
    #Ahora podemos iniciar la sesión
        session_start();
    #Por default la sesion lleva informacion del navegador, sistema e ip y un token con esa información (tratando de hacer unico ese identificador)
        $_SESSION['__browser'] = Sfphp::obtenNavegador()['name'];
        $_SESSION['__token'] = md5(Sfphp::tokenCliente());
	}

	public static function get($variable = '')
	{
		if(!self::$instancia instanceof self)
			self::$instancia = new self();
        if(strlen(trim($variable)))
            return $_SESSION[$variable];
        else
            return $_SESSION;
	}

    public function set($variable, $valor)
    {
        if(!self::$instancia instanceof self)
            self::$instancia = new self();
        $_SESSION[$variable] = $valor;
    }

    public function id()
    {
        if(!self::$instancia instanceof self)
            self::$instancia = new self();
        return session_id();
    }
}