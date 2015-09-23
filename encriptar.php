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

require_once './Frame/_base.php';
$config = Sfphp_Config::get();
echo Sfphp::encrypt(trim($_GET['s']),$config['app']['key']);