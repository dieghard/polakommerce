<?php

class Productos{
	private $datos;

	public function __construct(){
    require_once 'conexion.php';
		$this->datos=array();
  }

  private function sql(){
    $strSql="select productos.id,
              IFNULL(productos.producto,'') as producto ,
              IFNULL(productos.subtitulo,'') as subtitulo,
              IFNULL(productos.precio,0) as precio,
              productos.vig,
              productos.imagenPresentacion,
              productos.empresa,
              productos.idioma,
              productos.edad,
              productos.categoriaID,
              productos.rubroID,
              productos.enCarrusel,
              productos.productoDestacado,
              productos.activo,
              IFNULL(productos.conStock,1) as conStock,
              productos.conDescuento,
              IFNULL(productos.peso,'- kg') as peso,
              IFNULL(productos.descripcion,'') as descripcion,
              IFNULL(productos.informacion,'') as informacion,
              IFNULL(categorias.titulo,'') as categoria,
              IFNULL(rubros.titulo,'') as  rubro
        from productos
        LEFT JOIN categorias ON categorias.id = productos.categoriaID
        LEFT JOIN rubros ON rubros.id = productos.rubroID";
    return $strSql;
  }

  public function getProductos(){
    $strSql= $this->sql() ."     ORDER BY productos.producto  LIMIT 0,10";
     $superArray =  array();
        $superArray['success'] = true;
        $conexion = new Conexion($superArray);
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
        $this->datos[] = $row;
    endwhile;
    if (empty($this->datos)){$this->_redirect();}
    return $this->datos;
  }


   public function getProductosxCarrusel(){
      $strSql= $this->sql() ."  WHERE enCarrusel = 1   ORDER BY productos.producto  LIMIT 10";
      $superArray =  array();
      $superArray['success'] = true;
      $conexion = new Conexion($superArray);
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
        $this->datos[] = $row;
    endwhile;
    if (empty($this->datos)){$this->_redirect();}
    return $this->datos;
  }

  public function getProductosPorId($id=null,&$superArray){

      $id=(int)$id;
      //validacion para que solo se pueda entrar a alchivo pro.php via get sino se
      //redireciona llamanedo el metodo _redirect();.
      if (empty($id) OR !$id) {$this->_redirect();}
      //$superArray =  array();
      $superArray['success'] = true;
      $conexion = new Conexion($superArray);
      $dbConectado = $conexion->DBConect($superArray);
		  $strSql=$strSql= $this->sql() ."  WHERE 1 = 1 AND productos.id=" .$id;

      $stm= $dbConectado->prepare($strSql);
      $stm->execute();

      while ($row=$stm->fetch())
      {
          $this->datos[] = $row;
      }
      //validacion de get para detos que sean superior a los id de db
      if (empty($this->datos)){$this->_redirect();}

      return $this->datos;
    }


    private function _redirect(){
      return header("Location:index.php");
  }

}
