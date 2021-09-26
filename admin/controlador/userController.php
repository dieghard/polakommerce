<?php

namespace admin\Controlador;

require_once "../../../admin/Modelo/ModeloUser.php";

//use admin\Modelo;

class UserController
{
        public function __construct()
        {
        }

        public function ValidarPasswordController($usuario)
        {
                $respuesta = '';
                //$MP = new ModeloUser();
                $respuesta = 'LLEGUE HASTA EL CONTROLADOR';
                //$respuesta = $MP->ValidarUser($usuario);

                return  $respuesta;
                $MP = null;
        }
}
