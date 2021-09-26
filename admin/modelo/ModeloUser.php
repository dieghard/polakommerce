<?php

namespace admin\Modelo;

//require_once "../../Class/Conexion.php";

//use Class\Conexion;

class ModeloUser
{
   public function __construct()
   {
   }
   public function ValidarUser($usuario)
   {
      $superArray = array();
      $superArray['Pase'] = 'Pase x aca';
      //$conexion = new Conexion($superArray);
      //$dbConectado = $conexion->DBConect($superArray);
      return  $superArray;
   }
}
