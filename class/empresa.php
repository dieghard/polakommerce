<?php

class Empresa{

  private $id   ;
  private $descripcion;
	private $direccion;
	private $cuit;
	private $localidad;
	private $provincia;
	private $email;
	private $telefono;
	private $facebook_link;
	private $twitter_link;
	private $instagram_link;
  private $pinterest_link;
	private $logo;
	private $maneja_mercado_pago;
	private $mercado_pago_access_token;
	private $mercado_pago_key;
  private $realiza_envios_gratis_mayor_a;

  const TABLA = 'empresa';

  public function getId() {
       return $this->id;
  }
  public function setId($id) {
       $this->id = $id;
  }

  public function getDescripcion() {
       return $this->descripcion;
  }
  public function setDescripcion($descripcion) {
       $this->descripcion = $descripcion;
  }

  public function getDireccion() {
       return $this->direccion;
  }
  public function setDireccion($direccion) {
       $this->direccion = $direccion;
  }

  public function getCuit() {
       return $this->cuit;
  }
  public function setCuit($cuit) {
       $this->cuit = $cuit;
  }

  public function getLocalidad() {
       return $this->localidad;
  }
  public function setLocalidad($localidad) {
       $this->localidad = $localidad;
  }

  public function getProvincia() {
       return $this->provincia;
  }
  public function setProvincia($provincia) {
       $this->provincia = $provincia;
  }

  public function getEmail() {
       return $this->email;
  }
  public function setEmail($email) {
       $this->email = $email;
  }

  public function getTelefono() {
       return $this->telefono;
  }
  public function setTelefono($telefono) {
       $this->telefono = $telefono;
  }

  public function getFacebook_link() {
       return $this->facebook_link;
  }
  public function setFacebook_link($facebook_link) {
       $this->facebook_link = $facebook_link;
  }

  public function getTwitter_link() {
       return $this->twitter_link;
  }
  public function setTwitter_link($twitter_link) {
       $this->twitter_link = $twitter_link;
  }

  public function getInstagram_link() {
       return $this->instagram_link;
  }
  public function setInstagram_link($instagram_link) {
       $this->instagram_link = $instagram_link;
  }

	public function getPinterest_link() {
       return $this->pinterest_link;
  }
  public function setPinterest_link($pinterest_link) {
       $this->pinterest_link = $pinterest_link;
  }

	public function getLogo() {
       return $this->logo;
  }
  public function setLogo($logo) {
       $this->logo = $logo;
  }

	public function getManeja_mercado_pago() {
       return $this->maneja_mercado_pago;
  }
  public function setManeja_mercado_pago($maneja_mercado_pago) {
       $this->maneja_mercado_pago = $maneja_mercado_pago;
  }

  public function getMercado_pago_access_token() {
       return $this->mercado_pago_access_token;
  }
  public function setMercado_pago_access_token($mercado_pago_access_token) {
       $this->mercado_pago_access_token = $mercado_pago_access_token;
  }

	public function getmercado_pago_key() {
       return $this->mercado_pago_key;
  }
  public function setmercado_pago_key($mercado_pago_key) {
       $this->mercado_pago_key = $mercado_pago_key;
  }

	public function getRealizaEnvios() {
      $dato = '';
      if ($this->realiza_envios_gratis_mayor_a >0) {
        $dato = '<li>envios gratis por compras mayores a $' . $this->realiza_envios_gratis_mayor_a . '</li>';
      }
       return $dato;
  }
  public function setRealizaEnvios($realiza_envios_gratis_mayor_a) {
       $this->realiza_envios_gratis_mayor_a = $realiza_envios_gratis_mayor_a;
  }

  Public function getLinksRedes (){
    $dato = '';

    if (strlen($this->facebook_link) >0) {
      $dato = '<a href="'. $this->facebook_link.'"><i class="fa fa-facebook"></i></a>';
    }
    if (strlen($this->twitter_link) >0) {
      $dato .= '<a href="'. $this->twitter_link.'"><i class="fa fa-twitter"></i></a>';
    }
    if (strlen($this->instagram_link) >0) {
      $dato .= '<a href="'. $this->instagram_link.'"><i class="fa fa-instagram"></i></a>';
    }
    if (strlen($this->pinterest_link) >0) {
      $dato .= '<a href="'. $this->instagram_link.'"><i class="fa fa-pinterest-p"></i></a>';
    }

    return $dato;

  }

  public function __construct(  int $id = null,
                                string $descripcion = null,
                                string $direccion = null,
                                string $cuit = null,
                                string $localidad = null,
                                string $provincia = null,
                                string $email = null,
                                string $telefono = null,
                                string $facebook_link = null ,
                                string $twitter_link = null ,
                                string $instagram_link = null ,
                                string $pinterest_link = null,
                                string $logo = null ,
                                string  $maneja_mercado_pago = null ,
                                string $mercado_pago_access_token = null ,
                            	  string  $mercado_pago_key = null,
                                 $realiza_envios_gratis = 0 ){

        $this->id = $id   ;
        $this->descripcion = $descripcion;
        $this->direccion = $direccion;
        $this->cuit = $cuit;
        $this->localidad = $localidad;
        $this->provincia = $provincia;
        $this->email = $email;
        $this->telefono = $telefono;
        $this->facebook_link = $facebook_link;
        $this->twitter_link = $twitter_link;
        $this->instagram_link = $instagram_link;
        $this->pinterest_link = $pinterest_link;
        $this->logo = $logo;
        $this->maneja_mercado_pago = $maneja_mercado_pago;
        $this->mercado_pago_access_token = $mercado_pago_access_token;
        $this->mercado_pago_key = $mercado_pago_key;
        $this->realiza_envios_gratis_mayor_a = $realiza_envios_gratis;
        require_once 'conexion.php';

  }

    public function Empresa(){

            $superArray =  array();
            $superArray['success'] = true;
            $conexion = new Conexion($superArray);
            $dbConectado = $conexion->DBConect($superArray);
            $sql = $this->sqlEmpresa() . '  LIMIT 1';
            $stm= $dbConectado->prepare($sql);
            $stm->execute();
            $registro = $stm->fetch();

            if($registro){
              return new self( $registro['id'],
                              $registro['descripcion'],
                              $registro['direccion'],
                              $registro['cuit'],
                              $registro['localidad'],
                              $registro['provincia'],
                              $registro['email'],
                              $registro['telefono'],
                              $registro['facebook_link'],
                              $registro['twitter_link'],
                              $registro['instagram_link'],
                              $registro['pinterest_link'],
                              $registro['logo'],
                              $registro['maneja_mercado_pago'],
                              $registro['mercado_pago_access_token'],
                              $registro['mercado_pago_key'],
                              $registro['realiza_envios_gratis']
                            );
            }else{

              return false;
            }

    }

	private function _redirect(){

		return header("Location:index.php");

	}

  private function sqlEmpresa(){
    return "SELECT empresa.id, IFNULL(empresa.descripcion,'')as descripcion,
            IFNULL(empresa.direccion,'')as direccion,
            IFNULL(empresa.cuit,'')as cuit,
            IFNULL(empresa.localidad,'')as localidad ,
            IFNULL(empresa.provincia,'')as provincia,
            IFNULL(empresa.email,'')as email,
            IFNULL(empresa.telefono,'')as telefono,
            IFNULL(empresa.facebook_link,'')as facebook_link,
            IFNULL(empresa.twitter_link,'')as twitter_link,
            IFNULL(empresa.instagram_link,'')as instagram_link,
            IFNULL(empresa.pinterest_link,'')as pinterest_link,
            IFNULL(empresa.logo,'')as logo,
            IFNULL(empresa.maneja_mercado_pago,'')as maneja_mercado_pago,
            IFNULL(empresa.mercado_pago_access_token,'')as mercado_pago_access_token,
            IFNULL(empresa.mercado_pago_key,'')as  mercado_pago_key ,
            IFNULL(empresa.realiza_envios_gratis ,0) as  realiza_envios_gratis

          FROM  ". self::TABLA ;
  }

  public static function recuperarTodos(){
      $superArray =  array();
      $superArray['success'] = true;
      $conexion = new Conexion($superArray);
      $dbConectado = $conexion->DBConect($superArray);
      $sql = $this->sqlEmpresa();
      $stm= $dbConectado->prepare($sql);
      $stm->execute();
      $registros = $stm->fetchAll();
      return $registros;
    }

  public function guardar(){
     /*  $conexion = new Conexion();
       if($this->id)  {
          $consulta = $conexion->prepare('UPDATE ' . self::TABLA .' SET nombre = :nombre, descripcion = :descripcion WHERE id = :id');
          $consulta->bindParam(':nombre', $this->nombre);
          $consulta->bindParam(':descripcion', $this->descripcion);
          $consulta->bindParam(':id', $this->id);
          $consulta->execute();
       }else  {
          $consulta = $conexion->prepare('INSERT INTO ' . self::TABLA .' (nombre, descripcion) VALUES(:nombre, :descripcion)');
          $consulta->bindParam(':nombre', $this->nombre);
          $consulta->bindParam(':descripcion', $this->descripcion);
          $consulta->execute();
          $this->id = $conexion->lastInsertId();
       }
       $conexion = null;
       */
    }
}
