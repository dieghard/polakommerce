<?php

namespace admin\Controlador;

require_once "../../../admin/Modelo/ModeloUser.php";

use admin\Modelo\ModeloUser;

class UserController
{
        public function __construct()
        {
        }

        public function ValidarPasswordController($usuario)
        {
                $respuesta = '';
                $MP = new ModeloUser();

                $respuesta = $MP->ValidarUser($usuario);

                return  $respuesta;
                $MP = null;
        }
}
