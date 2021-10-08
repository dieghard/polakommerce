<?php
//require_once "../../../admin/Controlador/UserController.php";
//use admin\Controlador\UserController;

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
}
