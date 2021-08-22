<?php

class Rubros{
	private $datos;

	public function __construct(){
    	require_once 'conexion.php';
		$this->datos=array();
    }

	public function getRubros(){

		$strSql="	SELECT rubros.id, rubros.titulo, rubros.subtitulo, rubros.descripcion,rubros.imagen, rubros.activo
					FROM rubros
					WHERE rubros.activo = 1
					ORDER BY rubros.titulo";


        $conexion = new Conexion();
        $superArray['success'] = true;
        $dbConectado = $conexion->DBConect($superArray);

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

    public function getRubrosPorId($id=null){

            $id=(int)$id;
          //validacion para que solo se pueda entrar a alchivo pro.php via get sino se
           //redireciona llamanedo el metodo _redirect();.

            if (empty($id) OR !$id) {

                  $this->_redirect();
            }


          $conexion = new Conexion();
          $superArray['success'] = true;
          $dbConectado = $conexion->DBConect($superArray);

            $stm= $dbConectado->prepare("SELECT rubros.id, rubros.titulo, rubros.subtitulo, rubros.descripcion,rubros.imagen, rubros.activo
										FROM rubros WHERE rubros.id  ='".$id."'");
            $stm->execute();

            while ($row=$stm->fetch())
            {
              $this->datos[]=$row;
            }

            //validacion de get para detos que sean superior a los id de db
           if (empty($this->datos)){
               $this->_redirect();
           }
           //***********************************************

            return $this->datos;
    }

	private function _redirect(){

		return header("Location:index.php");

	}

}
