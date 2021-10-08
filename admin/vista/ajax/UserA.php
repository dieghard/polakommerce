<?php


require_once "../../../admin/Modelo/ModeloUser.php";

use admin\Modelo\ModeloUser;

class Ajax_Validar_User
{
   public function __construct()
   {
   }

   public function Ingreso($usuario)
   {

      $respuesta = '';
      $MP = new ModeloUser();

      $respuesta = $MP->ValidarUser($usuario);
      return  $respuesta;
      $MP = null;
   }

   public function LlenarGrilla()
   {

      $MP = new ModeloUser();

      $respuesta = $MP->LlenarGrilla();
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

   $respuesta = 'PASE POR AQUI PAPA';
   $respuesta = $panel->LlenarGrilla();
   echo $respuesta;
endif;
