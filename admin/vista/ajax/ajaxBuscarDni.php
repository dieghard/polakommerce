<?php

class Ajax_Users_Busqueda{
      
        public function __construct(){
            require_once "../../controlador/userController.php";
        }
        
         public function BuscarxDNI($data){
                       
            $user = new UserController();
          
            $respuesta = $user->BuscarxDNI($data); 
            echo $respuesta;
            $user = null;
        }
}

if ($accion='buscarxDni'){BuscarxDNI();}


function  BuscarxDNI(){
    
   
    if (session_status() == PHP_SESSION_NONE) { 
        session_start();
    }
    $biblioteca = $_SESSION["biblioteca"];
    $bibliotecaID = $biblioteca['id'];
    
    $data['documento']= $_POST["documento"];
    $data['bibliotecaID']=$bibliotecaID;
    
    $respuesta = new Ajax_Users_Busqueda();
    $respuesta->BuscarxDNI($data);
}
