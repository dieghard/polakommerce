<?php

/*
=================================================================================================
 * VALIDAR USUARIO!
================================================================================================= 
*/
class Ajax_Users_abm {
      
        public function __construct(){
            require_once "../../controlador/userController.php";
        }
        public function llenarGrilla($bibliotecaID){
                       
            $user = new UserController();
          
            $respuesta = $user->llenarGrilla($bibliotecaID); 
            echo $respuesta;
            $user = null;
        }
        public function BuscarxDNI($data){
                       
            $user = new UserController();
          
            $respuesta = $user->BuscarxDNI($data); 
            echo $respuesta;
            $user = null;
        }
        public function IngresoSocio($bibliotecaID,$data){
                       
            $user = new UserController();
          
            $respuesta = $user->IngresoSocio($bibliotecaID,$data); 
            
            echo $respuesta;
            $user = null;
        }
        public function EliminarSocio($bibliotecaID,$data){
                       
            $user = new UserController();
          
            $respuesta = $user->EliminarSocio($bibliotecaID,$data); 
            
            echo $respuesta;
            $user = null;
        }
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

if(isset($_POST["ACTION"])){
    $accion = $_POST["ACTION"];}
else{
    
    return;
}

if ($accion=='llenarGrilla'){
    LlenarGrilla();
}
if ($accion=='ingresoSocio'){
    IngresoSocio();
    
}
if ($accion=='eliminarSocio'){
    EliminarSocio();
    
}
function  LlenarGrilla(){
        $respuesta = new Ajax_Users_abm();
        if (session_status() == PHP_SESSION_NONE) { 
                session_start();
        }
        $biblioteca = $_SESSION["biblioteca"];
        $bibliotecaID = $biblioteca['id'];
      //  echo json_encode($biblioteca);
        $respuesta->llenarGrilla($bibliotecaID );
    }
function  IngresoSocio(){
        $respuesta = new Ajax_Users_abm();
        if (session_status() == PHP_SESSION_NONE) { 
                session_start();
        }
        $misDatosJSON = json_decode($_POST["datosjson"]);
        $biblioteca = $_SESSION["biblioteca"];
        $bibliotecaID = $biblioteca['id'];
        $respuesta->IngresoSocio($bibliotecaID,$misDatosJSON  );
    }
function EliminarSocio(){
      $respuesta = new Ajax_Users_abm();
        if (session_status() == PHP_SESSION_NONE) { 
                session_start();
        }
        $misDatosJSON = json_decode($_POST["datosjson"]);
        $biblioteca = $_SESSION["biblioteca"];
        $bibliotecaID = $biblioteca['id'];
        $respuesta->EliminarSocio($bibliotecaID,$misDatosJSON  );
}
