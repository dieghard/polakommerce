<?php

class UserController{
/*=============================================
LLAMAMOS LA PLANTILLA
=============================================*/
    public function __construct(){
           require_once '../../modelo/userModelo.php'; 
    }
    public function TraerPass($Mail){
            $MP = new UserModelo();
            $respuesta = $MP->TraerPass($Mail);    
            return $respuesta;
            $MP =null;   
           }
    public function UserEdit($nombre,$pass,$id){
            $MP = new UserModelo();
            $respuesta = $MP->UserEdit($nombre,$pass,$id);    
            return $respuesta;
            $MP =null;   
           }
    public function LLenarGrilla($bibliotecaID){
            $MP = new UserModelo();
              
            $grilla = $MP->LlenarGrilla($bibliotecaID);    
            return $grilla ;
            $MP =null;
    }
    public function BuscarxDNI($data){
            $MP = new UserModelo();
              
            $grilla = $MP->BuscarxDNI($data);    
            return $grilla ;
            $MP =null;
    }
    public function Modificar($data){
            $user = new UserModelo();
            $respuesta= $user->Modificar($data);    
            echo $respuesta;
            $user = null;
    }
    public function IngresoSocio($bibliotecaID,$data){
            $user = new UserModelo();
            $respuesta= $user->IngresoSocio($bibliotecaID,$data);    
            return $respuesta;
            $user = null;
        }
    public function EliminarSocio($bibliotecaID,$data){
            $user = new UserModelo();
            $respuesta= $user->EliminarSocio($bibliotecaID,$data);    
            return $respuesta;
            $user = null;
        }
    public function Eliminar($data){
            $user = new UserModelo();
            $respuesta= $user->Eliminar($data);    
            echo $respuesta;
        }
    public function LlenarComboBibliotecas(){
            $MP = new UserModelo();
            $combo = $MP->LlenarComboBiliotecas();    
            return $combo ;
            $MP =null;   
        }
        /*=============================================
        VALIDAR PASSWORD
        =============================================*/
        public function ValidarPasswordController($usuario,$password,$bibliotecaId){
            require_once "../../modelo/userModelo.php";
            $MP = new UserModelo();
            $datosUsuario=$usuario;
            $datosPass=$password;
            $respuesta= $MP->validarPasswordModelo($datosUsuario,$datosPass,$bibliotecaId);
            
            return  $respuesta;
            $MP = null;            
        }            
}
