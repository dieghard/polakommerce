<?php


require_once "../../../Admin/Modelo/User.php";

use Admin\Modelo\User;

class Ajax_Validar_User
{
   public function __construct()
   {
   }

   public function GuardarUsuario($oUsuario)
   {

      $respuesta = '';
      $MP = new User();

      $respuesta = $MP->GuardarUsuario($oUsuario);
      return  $respuesta;
      $MP = null;
   }


   public function Ingreso($usuario)
   {

      $respuesta = '';
      $MP = new User();

      $respuesta = $MP->ValidarUser($usuario);
      return  $respuesta;
      $MP = null;
   }

   public function LlenarGrilla()
   {

      $MP = new User();
      $respuesta = $MP->LlenarGrilla();
      return  $respuesta;
      $MP = null;
   }
   public function BuscarxMail($mail)
   {
      $MP = new User();

      $respuesta = $MP->BuscarxMail($mail);
      return  $respuesta;
      $MP = null;
   }
}

if (isset($_POST['ACTION'])) :
   $accion = $_POST['ACTION'];
else :
   return;
endif;

if ($accion == 'llenarGrilla') :
   $panel = new Ajax_Validar_User();
   $respuesta = $panel->LlenarGrilla();
   echo $respuesta;
endif;

if ($accion == 'buscarxMail') :
   if (isset($_POST['mail'])) :
      $mail = $_POST['mail'];
      $panel = new Ajax_Validar_User();
      $respuesta = $panel->BuscarxMail($mail);
   else :
      return;
   endif;

   echo $respuesta;
endif;

if ($action = 'ingresousuario') :
   $panel = new Ajax_Validar_User();
   if (isset($_POST['datosjson'])) :
      $oUsuario = json_decode($_POST["datosjson"]);
      $respuesta = $panel->GuardarUsuario($oUsuario);
      echo $respuesta;
   endif;
endif;
