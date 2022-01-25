<?php

namespace admin\Modelo;

require_once "../../../Class/Conexion.php";

use Class\Conexion;
use PDO;
use PDOException;
use Exception;
use Throwable;

class User
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

   private function ArmarSqlInsert()
   {
      $strSql = 'INSERT INTO  usuarios (empresaid ,nombreyapellido, mail, pass, perfilID, activo, observaciones)
                    VALUES(            :empresaid,:nombreyapellido,:mail,:pass,:perfilID,:activo,:observaciones)';

      return $strSql;
   }

   private function ArmarSqlUpdate()
   {
      $strSql = 'UPDATE usuarios SET  empresaid = :empresaid,
                                      nombreyapellido = :nombreyapellido,
                                        mail          = :mail,
                                        pass          = :pass,
                                        perfilID      = :perfilID,
                                        activo        = :activo,
                                        observaciones = :observaciones
                                        WHERE id=:id';
      return $strSql;
   }

   public function GuardarUsuario($oUsuario)
   {
      $superArray = array();
      $superArray['success'] = true;
      $conexion = new Conexion($superArray);
      $dbConectado = $conexion->DBConect($superArray);
      $superArray['mensaje'] = '';

      if (session_status() == PHP_SESSION_NONE) :
         session_start();
      endif;
      $empresa = $_SESSION['empresa'];
      $superArray['$empresa'] = $empresa;


      if ($oUsuario->id > 0) :
         $strSql = $this->ArmarSqlUpdate();
      else :
         $strSql = $this->ArmarSqlInsert();
      endif;

      $pass = base64_encode($oUsuario->pass);
      $superArray['$oUsuario'] = $oUsuario;

      $stmt = $dbConectado->prepare($strSql);
      if ($oUsuario->id > 0) :
         $stmt->bindParam(':id', $oUsuario->id, PDO::PARAM_INT);
      endif;
      $stmt->bindParam(':empresaid', $empresa['id'], PDO::PARAM_INT);
      $stmt->bindParam(':nombreyapellido', $oUsuario->nombreyapellido, PDO::PARAM_STR);
      $stmt->bindParam(':mail', $oUsuario->mail, PDO::PARAM_STR);
      $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
      $stmt->bindParam(':perfilID', $oUsuario->perfilID, PDO::PARAM_INT);
      $stmt->bindParam(':activo', $oUsuario->activo, PDO::PARAM_STR);
      $stmt->bindParam(':observaciones', $oUsuario->observaciones, PDO::PARAM_STR);
      //Comienzo la transaccion
      $dbConectado->beginTransaction();
      try {
         $stmt->execute();
         $dbConectado->commit();
      } catch (Exception $e) {
         $superArray['success'] = false;
         $superArray['mensaje'] = 'Error: ' . $e->getMessage();
         $dbConectado->rollBack();
      }

      $stmt = null;
      $dbConectado = null;

      return json_encode($superArray);

      /*
        $from = "soporte@rasoftware.com.ar";
        $to = $data['mail'];
        $subject = "SOFTWARE BIBLIOTECA -EL USUARIO:" . $data['nombre'] . "  fue ingresado al sistema datos" ;
        $message = "NUEVO INGRESO DE DATOS PARA EL USER:" .  $nombre ;
        $message = $message . "";
        $headers = "Desde:" . $from;
        mail($to,$subject,$message, $headers);

        $from = "soporte@rasoftware.com.ar";
        $to = 'soporte@rasoftware.com.ar';
        $subject = "SOFTWARE BIBLIOTECA  -EL USUARIO:" . $data['nombre'] . "  fue ingresado al sistema datos" ;
        $message = "NUEVO INGRESO DE DATOS PARA EL USER:" .  $nombre ;
        $message = $message . "";
        $headers = "Desde:" . $from;
        mail($to,$subject,$message, $headers);

        */
   }

   public function ValidarUser($usuarioLoguin)
   {
      $superArray = array();
      $sql = $this->SqlSelectUser();
      $sql .= '   WHERE mail  = :mail  Limit 1';

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

   public function BuscarxMail(string $email)
   {

      $superArray = array();
      $sql = $this->SqlSelectUser();
      $sql .= 'WHERE usuarios.mail  = :mail
               Limit 1';

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
      try {
         $conexion = new Conexion($superArray);
         $dbConectado = $conexion->DBConect($superArray);
         $stmt  = $dbConectado->prepare($sql);
         $mail = htmlentities(addslashes($email));
         $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
         $stmt->execute();
         $registro = $stmt->fetchAll();
         $superArray['success'] = true;
         $superArray['mensaje'] = '';
         $superArray['encontrado'] = false;
         if ($registro) :
            $row = $registro[0];
            $superArray['success'] = true;
            $usuario = $this->PasarRow($row);
            $superArray['mensaje'] = 'Todo ok';
            $superArray['encontrado'] = true;
            $superArray['user'] = $usuario;
         endif;
      } catch (Throwable $e) {
         $trace = $e->getTrace();
         $elDato = $e->getMessage() . ' en ' . $e->getFile() . ' en la linea ' . $e->getLine() . ' llamado desde ' . $trace[0]['file'] . ' on line ' . $trace[0]['line'];
         $superArray['success'] = false;
         $superArray['mensaje'] = 'Message: ' . $e->getMessage();
         $superArray['path'] = '#';
         return json_encode($superArray);
      }
      return json_encode($superArray);
   }

   public function LlenarGrilla()
   {
      $superArray = array();
      $sql = $this->SqlSelectUser();
      $sql .= ' ORDER BY  usuarios.nombreyapellido';
      $tabla = '';

      try {
         $superArray['success'] = true;
         $conexion = new Conexion($superArray);
         $dbConectado = $conexion->DBConect($superArray);
         $stmt  = $dbConectado->prepare($sql);
         $stmt->execute();
         $registro = $stmt->fetchAll();

         if ($registro) :
            $tabla = '<div class="table-responsive">
                     <table class="table table-condensed  table-striped  table-bordered" id="idTablaUser">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">NOMBRE Y APELLIDO</th>
                            <th scope="col">MAIL</th>
                            <th scope="col">PERFIL</th>
                            <th scope="col">ACTIVO</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                <tbody>';

            if ($registro) :
               foreach ($registro  as $row) {
                  $encabezadoRow = '<tr id="' . $row['id'] . '"';
                  $encabezadoRow .= 'data-id="' . $row['id'] . '"';
                  $encabezadoRow .= 'data-nombreyapellido="' . $row['nombreyapellido'] . '"';
                  $encabezadoRow .= 'data-mail="' . $row['mail'] . '"';
                  $encabezadoRow .= 'data-pass="' . $row['pass'] . '"';
                  $encabezadoRow .= 'data-perfilid="' . $row['perfilID'] . '"';
                  $encabezadoRow .= 'data-perfil="' . $row['perfil'] . '"';
                  $encabezadoRow .= 'data-activo="' . $row['activo'] . '"';
                  $encabezadoRow .= '">';
                  $tabla .= $encabezadoRow . '<td>' . $row['nombreyapellido'] . '</td>';
                  $tabla .= '<td>' . $row['mail'] . '</td>';
                  $tabla .= '<td>' . $row['perfil'] . '</td>';
                  $tabla .= '<td>' . $row['activo'] . '</td>';
                  $tabla .= '<td><button type="button" title="Presione para modificar item" class="btn btn-primary edit" onclick="fnProcesaEditar(this)"  value="' . $row['id'] . '"><i class="fa fa-edit "></i></button>     ';
                  $tabla .= '<button type="button" title="Presione para eliminar item" class="btn btn-danger delete" onclick="fnProcesaEliminar(this)" value="' . $row['id'] . '"><i class="fa fa-eraser "></i> </button></td>';
                  $tabla .= '</tr>'; //nueva fila
               }
            endif;
            $tabla .= '</tbody>
                        </table>
                        </div>';

         endif;
      } catch (Throwable $e) {
         $trace = $e->getTrace();
         $elDato = $e->getMessage() . ' en ' . $e->getFile() . ' en la linea ' . $e->getLine() . ' llamado desde ' . $trace[0]['file'] . ' on line ' . $trace[0]['line'];
         $superArray['success'] = false;
         $superArray['mensaje'] = 'Message: ' . $e->getMessage();
      }
      $superArray['tabla'] = $tabla;
      return json_encode($superArray);
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
               INNER JOIN perfiles ON perfiles.id = usuarios.perfilID  ";
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

   private function PasarRow($row)
   {
      return [
         'id' => $row['id'],
         'empresaid' => $row['empresaid'],
         'nombreyapellido' => $row['nombreyapellido'],
         'mail' => $row['mail'],
         'pass' => $row['pass'],
         'activo' => $row['activo'],
         'perfil' => $row['perfil']
      ];
   }
}
