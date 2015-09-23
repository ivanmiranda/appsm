<?php
class Controladores_Inicio extends Sfphp_Controlador {
	public function inicio()
	{
		#var_dump(Sfphp_Peticion::parametros());
		if(Sfphp_Sesion::get('usuario'))
			$this->vistaInicio;
		else
			$this->vistaIndex;
	}

	public function acceder() 
	{
		$resp = $this->modeloUsuarios->login(Sfphp_Peticion::parametros());
		echo json_encode($resp);
	}
}