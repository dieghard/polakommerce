<?php
//namespace Controlador;
class ControladorLogin{

	/*=============================================
	LLAMAMOS LA PLANTILLA
	=============================================*/

	public function Login(){
		include "vista/login.php";
	}
	/*=============================================
	Interaccion del Usuario
	=============================================*/
	public function enlacesPaginasController(){
		$MP = new ModeloPlantilla();

		if (isset ($_GET["action"])) {
			$enlaces = $_GET["action"];
		} else{
                        $enlaces ='panel';

		}
		$respuesta = $MP->enlacesPaginasModelo($enlaces);

		include  $respuesta;
		$respuesta =null;
	}
}

