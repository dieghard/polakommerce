<?php

namespace Class;

use Class\Conexion;
use Throwable;

class Categorias
{
  private $datos;

  public function __construct()
  {
    require_once 'conexion.php';
    $this->datos = array();
  }

  public function getCategorias()
  {

    $strSql = "	SELECT categorias.id, categorias.titulo, categorias.subtitulo, categorias.descripcion,categorias.imagen, categorias.activo
					FROM categorias
					WHERE categorias.activo = -1

					ORDER BY categorias.titulo";

    $superArray =  array();
    $superArray['success'] = true;
    $conexion = new Conexion($superArray);
    $dbConectado = $conexion->DBConect($superArray);

    try {
      $stmt = $dbConectado->prepare($strSql);
      $stmt->execute();
    } catch (Throwable $e) {
      $superArray['success'] = false;

      $trace = $e->getTrace();
      $superArray['mensaje'] = $e->getMessage() . ' en ' . $e->getFile() . ' en la linea ' . $e->getLine() . ' llamado desde ' . $trace[0]['file'] . ' on line ' . $trace[0]['line'];
      var_dump($trace);
      die('ERROR EN CATEGORIAS');
      return $superArray['mensaje'];
    }

    while ($row = $stmt->fetch()) :
      $this->datos[] = $row;
    endwhile;

    return $this->datos;
  }

  public function getCategoriasPorId($id = null)
  {

    $id = (int)$id;
    //validacion para que solo se pueda entrar a alchivo pro.php via get sino se
    //redireciona llamanedo el metodo _redirect();.

    if (empty($id) or !$id) {

      $this->_redirect();
    }


    $superArray =  array();
    $superArray['success'] = true;
    $conexion = new Conexion($superArray);
    $dbConectado = $conexion->DBConect($superArray);

    $stm = $dbConectado->prepare("SELECT categorias.id, categorias.titulo, categorias.subtitulo, categorias.descripcion,categorias.imagen, categorias.activo
										FROM categorias WHERE categorias.id  ='" . $id . "'");
    $stm->execute();

    while ($row = $stm->fetch()) {
      $this->datos[] = $row;
    }

    //validacion de get para detos que sean superior a los id de db
    if (empty($this->datos)) {
      $this->_redirect();
    }
    //***********************************************

    return $this->datos;
  }

  private function _redirect()
  {

    return header("Location:index.php");
  }
}
