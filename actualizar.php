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
# Actualiza los cambios del framework
# NOTA:: Esto no actualiza la APP, para ello se deben crear scripts que
# se encarguen de este trabajo
# -----------------------

require_once './Frame/_base.php';

echo "Verificando la versión del framework...<br>\n";
echo "Descargando cambios...<br>\n";
$_archivos = explode("\n", file_get_contents("http://sincco.com/versiones/sfphp.files","./sfphp.files"));
foreach ($_archivos as $_archivo) {
	copy("http://sincco.com/versiones/sfphp/Frame/".$_archivo,"./Frame/".$_archivo);
	chmod("./Frame/".$_archivo, 775);
	echo $_archivo." :: OK<br>\n";
}