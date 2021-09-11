<?php

class Empresa{

     private $id   ;
     private $descripcion;
	private $direccion;
	private $cuit;
	private $localidad;
	private $provincia;
	private $codigoPostal;
     private $email;
	private $telefono;
     private $telefonoWs;
	private $facebook_link;
	private $twitter_link;
	private $instagram_link;
     private $pinterest_link;
	private $logo;
	private $maneja_mercado_pago;
	private $mercado_pago_access_token;
	private $mercado_pago_key;
     private $realiza_envios_gratis_mayor_a;
     private $email_is_smtp ;
     private $email_host;
     private $email_smtp_auth;
     private $email_username;
     private $email_password;
     private $email_smtpSecure;
     private $email_port;
     private $paginaEnabled;
     private $cliengo_chat_token_1;
     private $cliengo_chat_token_2 ;



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

  public function getCodigoPostal() {
       return $this->codigoPostal;
  }
  public function setCodigoPostal($codigoPostal) {
       $this->codigoPostal = $codigoPostal;
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

  public function getTelefonoWs() {
       return $this->telefonoWs;
  }
  public function setTelefonoWs($telefonoWs) {
       $this->telefonoWs = $telefonoWs;
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

  public function getEmail_is_smtp() {
     return $this->email_is_smtp;
  }
  public function setEmail_is_smtp($email_is_smtp) {
     $this->email_is_smtp = $email_is_smtp;
  }

  public function getEmail_host() {
     return $this->email_host;
  }
  public function setEmail_host($email_host) {
     $this->email_host = $email_host;
  }

  public function getEmail_smtp_auth() {
     return $this->email_smtp_auth;
  }
  public function setEmail_smtp_auth($email_smtp_auth) {
     $this->email_smtp_auth = $email_smtp_auth;
  }

  public function getEmail_username() {
     return $this->email_username;
  }
  public function setEmail_username($email_username) {
     $this->email_username = $email_username;
  }


  public function getEmail_password() {
     return $this->email_password;
  }
  public function setEmail_password($email_password) {
     $this->email_password = $email_password;
  }

  public function getEmail_smtpSecure() {
     return $this->email_smtpSecure;
  }
  public function setEmail_smtpSecure($email_smtpSecure) {
     $this->email_smtpSecure = $email_smtpSecure;
  }

  public function getEmail_port() {
     return $this->email_port;
  }
  public function setEmail_port($email_port) {
     $this->email_port = $email_port;
  }

  public function getPaginaEnabled() {
     return $this->paginaEnabled;
  }
  public function setPaginaEnabled($paginaEnabled) {
     $this->paginaEnabled = $paginaEnabled;
  }

  public function getCliengo_chat_token_1() {
     return $this->cliengo_chat_token_1;
  }
  public function setCliengo_chat_token_1($cliengo_chat_token_1) {
     $this->cliengo_chat_token_1 = $cliengo_chat_token_1;
  }

  public function getCliengo_chat_token_2() {
     return $this->cliengo_chat_token_2;
  }
  public function setCliengo_chat_token_2($cliengo_chat_token_2) {
     $this->cliengo_chat_token_2 = $cliengo_chat_token_2;
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
                                string $codigoPostal = null,
                                string $email = null,
                                string $telefono = null,
                                string $telefonoWs = null,
                                string $facebook_link = null ,
                                string $twitter_link = null ,
                                string $instagram_link = null ,
                                string $pinterest_link = null,
                                string $logo = null ,
                                string $maneja_mercado_pago = null ,
                                string $mercado_pago_access_token = null ,
                            	  string $mercado_pago_key = null,
                                       $realiza_envios_gratis = 0,
                                       $email_is_smtp = -1,
                                string $email_host = '',
                                       $email_smtp_auth = -1,
                                string $email_username = '',
                                string $email_password = '',
                                string $email_smtpSecure ='TLS',
                                string $email_port = '',
                                       $paginaEnabled = -1,
                                string $cliengo_chat_token_1 = '',
                                string $cliengo_chat_token_2 = '',)
     {

        $this->id             = $id   ;
        $this->descripcion    = $descripcion;
        $this->direccion      = $direccion;
        $this->cuit           = $cuit;
        $this->localidad      = $localidad;
        $this->provincia      = $provincia;
        $this->codigoPostal   = $codigoPostal;
        $this->email          = $email;
        $this->telefono       = $telefono;
        $this->telefonoWs     = $telefonoWs;
        $this->facebook_link  = $facebook_link;
        $this->twitter_link   = $twitter_link;
        $this->instagram_link = $instagram_link;
        $this->pinterest_link = $pinterest_link;
        $this->logo           = $logo;
        $this->maneja_mercado_pago = $maneja_mercado_pago;
        $this->mercado_pago_access_token = $mercado_pago_access_token;
        $this->mercado_pago_key = $mercado_pago_key;
        $this->realiza_envios_gratis_mayor_a = $realiza_envios_gratis;
        $this->email_is_smtp    =  $email_is_smtp;
        $this->email_host       = $email_host;
        $this->email_smtp_auth  = $email_smtp_auth;
        $this->email_username = $email_username;
        $this->email_password = $email_password;
        $this->email_smtpSecure = $email_smtpSecure;
        $this->email_port       = $email_port ;
        $this->paginaEnabled    = $paginaEnabled ;
        $this->cliengo_chat_token_1 = $cliengo_chat_token_1 ;
        $this->cliengo_chat_token_2 = $cliengo_chat_token_2;
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
                              $registro['codigo_postal'],
                              $registro['email'],
                              $registro['telefono'],
                              $registro['telefono_ws'],
                              $registro['facebook_link'],
                              $registro['twitter_link'],
                              $registro['instagram_link'],
                              $registro['pinterest_link'],
                              $registro['logo'],
                              $registro['maneja_mercado_pago'],
                              $registro['mercado_pago_access_token'],
                              $registro['mercado_pago_key'],
                              $registro['realiza_envios_gratis'],
                              $registro['email_is_smtp'],
                              $registro['email_host'],
                              $registro['email_smtp_auth'],
                              $registro['email_username'],
                              $registro['email_password'],
                              $registro['email_smtpSecure'],
                              $registro['email_port'],
                              $registro['paginaEnabled'],
                              $registro['cliengo_chat_token_1'],
                              $registro['cliengo_chat_token_2']
                         );
            }else{

              return false;
            }

    }

	private function _redirect(){

		return header("Location:index.php");

	}

  private function sqlEmpresa(){

    return "   SELECT empresa.id, IFNULL(empresa.descripcion,'')as descripcion,
               IFNULL(empresa.direccion,'')as direccion,
               IFNULL(empresa.cuit,'')as cuit,
               IFNULL(empresa.localidad,'')as localidad ,
               IFNULL(empresa.provincia,'')as provincia,
               IFNULL(empresa.codigo_postal,'')as codigo_postal,
               IFNULL(empresa.email,'')as email,
               IFNULL(empresa.telefono,'')as telefono,
               IFNULL(empresa.telefono_ws,'')as telefono_ws,
               IFNULL(empresa.facebook_link,'')as facebook_link,
               IFNULL(empresa.twitter_link,'')as twitter_link,
               IFNULL(empresa.instagram_link,'')as instagram_link,
               IFNULL(empresa.pinterest_link,'')as pinterest_link,
               IFNULL(empresa.logo,'')as logo,
               IFNULL(empresa.maneja_mercado_pago,'')as maneja_mercado_pago,
               IFNULL(empresa.mercado_pago_access_token,'')as mercado_pago_access_token,
               IFNULL(empresa.mercado_pago_key,'')as  mercado_pago_key ,
               IFNULL(empresa.realiza_envios_gratis ,0) as  realiza_envios_gratis ,
               IFNULL(empresa.email_is_smtp,'') as  email_is_smtp,
               IFNULL(empresa.email_host,'') as email_host,
               IFNULL(empresa.email_smtp_auth,'') as email_smtp_auth,
               IFNULL(empresa.email_username,'') as email_username,
               IFNULL(empresa.email_password,'') as email_password,
               IFNULL(empresa.email_smtpSecure,'')  as email_smtpSecure,
               IFNULL(empresa.email_port,'')  as email_port ,
               IFNULL(empresa.paginaEnabled,-1)as paginaEnabled,
               IFNULL(empresa.cliengo_chat_token_1,'')as cliengo_chat_token_1,
               IFNULL(empresa.cliengo_chat_token_2,'')as cliengo_chat_token_2

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
