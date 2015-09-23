<?php
/************************************
* Funciones comúnes de HTML
*************************************
*************************************
Rev:
*************************************
@ivanmiranda: 1.0
************************************/
class Sfphp_HTML {

	public static function DibujaTabla($datos) {
		$html = "<table><tr>";
		foreach (array_keys($datos[0]) as $key => $value) {
		 	$html .= "<th>{$value}</th>";
		}
		$html .= "</tr>";
		while ($registro = array_shift($datos)) {
			$html .= "<tr>";
			foreach ($registro as $key => $value) {
				$html .= "<td>{$value}</td>";
			}
			$html .= "</tr>";
		}
		$html .= "</tr></table>";
		echo $html;
	}
}
