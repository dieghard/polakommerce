<?php

class FotosVideosProductos{
	private $datos;

	public function __construct(){
    	require_once 'conexion.php';
		$this->datos=array();
    }

	public function getFotosVideos($productoId){

		$strSql="	SELECT * FROM productos_fotos_videos Where productoId=". $productoId;
		$this->datos=array();
        $conexion = new Conexion();
        $superArray['success'] = true;
        $dbConectado = $conexion->DBConect($superArray);
       // var_dump($strSql);

		try {
            $stmt = $dbConectado->prepare($strSql);
            $stmt->execute();
		}
		catch (Throwable $e) {
            $superArray['success'] = false;

            $trace = $e->getTrace();
            $superArray['mensaje'] = $e->getMessage().' en '.$e->getFile().' en la linea '.$e->getLine().' llamado desde '.$trace[0]['file'].' on line '.$trace[0]['line'];
        }

         while ($row=$stmt->fetch()) :
         	$this->datos[]=$row;
         endwhile;

         return $this->datos;
    }

	private function _redirect(){

		return header("Location:index.php");

	}

}
