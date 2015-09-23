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
# Funciones base para ejecutar el framework
# -----------------------

# Autocarga de clases
spl_autoload_register(
    function ($nombreClase) {
        if($nombreClase == "Sfphp")
            include_once "./Sfphp/Sfphp.php";
        else {
            $_archivo = str_replace(array('_', '\\'), DIRECTORY_SEPARATOR, $nombreClase)
            . '.php';
            if(file_exists($_archivo)) {
                include_once $_archivo;
            } else {
                # Cuando la clase no se encuentra desde la carga directa
                # es por que es una clase ya sea de la applicación
                # o de una libreria en si
                # Las clases de la aplicación pueden ser personalizadas (Local)
                # o sobre la base del desarrollo (Core), para poder hacer
                # adecuaciones sin modificar la ruta original del sistema e incluso
                # poder realizar sobreescritura de clases básicas
                if(file_exists("./App/Local/".$_archivo)) {
                    #echo "./App/Local/".$_archivo;
                    include_once "./App/Local/".$_archivo;
                }
                elseif(file_exists("./App/Core/".$_archivo)) {
                    #echo "./App/Core/".$_archivo;
                    include_once "./App/Core/".$_archivo;
                }
                elseif(file_exists("./Libs/".$_archivo)) {
                    #echo "./Libs/".$_archivo;
                    include_once "./Libs/".$_archivo;
                }
                else  {
                    #echo "No existe";
                    throw new Sfphp_Error("La clase {$nombreClase} no existe :: {$_archivo}", 1);
                }
            }
        }
    }
);

# Registro de logs
define('DEV_LOGFILE', './Etc/Logs/'.date('YW').'.txt');