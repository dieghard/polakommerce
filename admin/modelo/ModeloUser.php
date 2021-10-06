<?php

namespace admin\Modelo;

require_once "../../../Class/Conexion.php";

use Class\Conexion;
use PDO;

class ModeloUser
{
   private $iniData;
   public function __construct()
   {
      try {
         $this->iniData = parse_ini_file('../../../Class/.config/db.php.ini');
      } catch (PDOException $e) {
         $arraydata['mensaje'] =  'ERROR:' . $e->getMessage() . '-CODIGO: ' . $e->getCode();
         return $arraydata;
      }
   }
   public function ValidarUser($usuarioLoguin)
   {
      $superArray = array();
      $sql = $this->SqlSelectUser();
      if (session_status() == PHP_SESSION_NONE) :
         session_start();
      endif;
      $usuario = [
         'id' => 0,
         'empresaid' => 0,
         'nombreyapellido' => '',
         'mail' => '',
         'pass' => '',
         'activo' => '',
         'perfil' => ''
      ];
      $_SESSION['usuario'] = $usuario;

      try {

         $superArray['success'] = true;
         $superArray['DEVELOVER_ENVIROMENT'] = $this->iniData['DEVELOVER_ENVIROMENT'];

         $conexion = new Conexion($superArray);

         $dbConectado = $conexion->DBConect($superArray);
         $stmt  = $dbConectado->prepare($sql);
         $password = htmlentities(addslashes($usuarioLoguin->password)); //variable auxiliar para comprobar que el usuario existe o no
         $pass_cifrada = password_hash($password, PASSWORD_DEFAULT, array("cost" => 10));

         $mail = htmlentities(addslashes($usuarioLoguin->email));

         $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
         $stmt->execute();

         $registro = $stmt->fetchAll();
         $superArray['success'] = false;
         $superArray['mensaje'] = 'Usuario o Password incorrecto';
         $superArray['path'] = '#';
         if ($registro) :
            $row = $registro[0];

            if (password_verify($password, $row['pass'])) :
               $superArray['success'] = true;
               $usuario = [
                  'id' => $row['id'],
                  'empresaid' => $row['empresaid'],
                  'nombreyapellido' => $row['nombreyapellido'],
                  'mail' => $row['mail'],
                  'pass' => $row['pass'],
                  'activo' => $row['activo'],
                  'perfil' => $row['perfil']
               ];
               $superArray['mensaje'] = 'Todo ok';


               $_SESSION['usuario'] = $usuario;
               $superArray['path'] = 'vista/index.php?controlador=mesadeentrada'; //COINCIDEN LAS CLAVES!
            else :
               $superArray['mensaje'] = 'Password incorrecto';
            endif;
         endif;
      } catch (Throwable $e) {
         $trace = $e->getTrace();
         $elDato = $e->getMessage() . ' en ' . $e->getFile() . ' en la linea ' . $e->getLine() . ' llamado desde ' . $trace[0]['file'] . ' on line ' . $trace[0]['line'];
         $superArray['success'] = false;
         $superArray['mensaje'] = 'Message: ' . $e->getMessage();
         $superArray['path'] = '#';
         return  $superArray;
      }

      $superArray['EmpresaID'] = $usuario['empresaid'];

      $sqlEmpresa = $this->SqlSelectEmpresa();
      $sqlEmpresa .=  " WHERE empresa.id = " . $usuario['empresaid'];
      $sqlEmpresa .= "  Limit 1";

      $stmt  = $dbConectado->prepare($sqlEmpresa);
      $stmt->execute();
      $registro = $stmt->fetchAll();
      $superArray['success'] = false;
      $superArray['mensaje'] = 'Usuario o Password incorrecto';
      $superArray['path'] = '#';
      if ($registro) :
         $row = $registro[0];
         $superArray['success'] = true;
         $empresa = [
            'id' => $row['id'],
            'descripcion' => $row['descripcion'],
            'cuit' => $row['cuit'],
            'localidad' => $row['localidad'],
            'provincia' => $row['provincia'],
            'codigo_postal' => $row['codigo_postal'],
            'email' => $row['email'],
            'telefono' => $row['telefono'],
            'telefono_ws' => $row['telefono_ws'],
            'facebook_link' => $row['facebook_link'],
            'twitter_link' => $row['twitter_link'],
            'instagram_link' => $row['instagram_link'],
            'pinterest_link' => $row['pinterest_link'],
            'logo' => $row['logo'],
            'maneja_mercado_pago' => $row['maneja_mercado_pago'],
            'mercado_pago_access_token' => $row['mercado_pago_access_token'],
            'mercado_pago_key' => $row['mercado_pago_key'],
            'realiza_envios_gratis' => $row['realiza_envios_gratis'],
            'email_is_smtp' => $row['email_is_smtp'],
            'email_host' => $row['email_host'],
            'email_smtp_auth' => $row['email_smtp_auth'],
            'email_username' => $row['email_username'],
            'email_password' => $row['email_password'],
            'email_smtpSecure' => $row['email_smtpSecure'],
            'email_port' => $row['email_port'],
            'paginaEnabled' => $row['paginaEnabled'],
            'cliengo_chat_token_1' => $row['cliengo_chat_token_1'],
            'cliengo_chat_token_2' => $row['cliengo_chat_token_2']
         ];
         if ($this->iniData['DEVELOVER_ENVIROMENT']) :
            $superArray['sqlUser'] = $sql;
            $superArray['mail'] = $usuarioLoguin->email;
            $superArray['$password'] = $password;
            //$superArray['$pass_cifrada'] = $pass_cifrada;
            $superArray['usuariodb'] = $usuario;
            $superArray['usuarioEmpresa'] = $empresa;
            $superArray['mail'] = $mail;
            $superArray['sqlEmpresa'] = $sqlEmpresa;
         endif;
         $_SESSION['empresa'] = $empresa;
         $_SESSION['usuario'] = $usuario;
         $superArray['path'] = 'vista/index.php?controlador=panel'; //COINCIDEN LAS CLAVES!

      endif;
      $conexion = null;
      return  $superArray;
   }

   private function sqlSelectUser()
   {
      $sql = " SELECT  usuarios.id
               ,usuarios.empresaid
               ,usuarios.nombreyapellido
               ,usuarios.mail
               ,usuarios.pass
               ,usuarios.perfilID
               ,perfiles.descripcion as perfil
               ,usuarios.activo
               FROM usuarios
               INNER JOIN perfiles ON perfiles.id = usuarios.perfilID
               WHERE usuarios.mail    = :mail
               Limit 1
      ";
      return $sql;
   }

   private function SqlSelectEmpresa()
   {
      $sql = "SELECT empresa.id,empresa.descripcion, empresa.direccion, empresa.cuit,empresa.localidad,empresa.provincia
                      ,empresa.codigo_postal,empresa.email,empresa.telefono,empresa.telefono_ws,empresa.facebook_link,empresa.twitter_link
                      ,empresa.instagram_link,empresa.pinterest_link,empresa.logo,empresa.maneja_mercado_pago,empresa.mercado_pago_access_token
                      ,empresa.mercado_pago_key,empresa.realiza_envios_gratis,empresa.email_is_smtp,empresa.email_host,empresa.email_smtp_auth
                      ,empresa.email_username,empresa.email_password,empresa.email_smtpSecure,empresa.email_port,empresa.paginaEnabled
                      ,empresa.cliengo_chat_token_1,empresa.cliengo_chat_token_2  FROM empresa ";

      return $sql;
   }
}
