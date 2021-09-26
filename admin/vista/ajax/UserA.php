<?php
require_once "../../../admin/Controlador/UserController.php";

use admin\Controlador\UserController;


class Ajax_Validar_User
{
   public function __construct()
   {
   }

   public function Ingreso($usuario)
   {

      $CP = new UserController();

      $respuesta = $CP->ValidarPasswordController($usuario);

      $CP = null;
      return $respuesta;
   }
}
