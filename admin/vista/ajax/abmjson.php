<?php
 // header('Content-type: application/json; charset=utf-8');
  
  $misDatosJSON = json_decode($_POST["datosjson"]);
   
   

$nombre['nombre']  =$misDatosJSON->nombre;
$nombre['mail'] = $misDatosJSON->mail;
echo  json_encode($nombre) ;