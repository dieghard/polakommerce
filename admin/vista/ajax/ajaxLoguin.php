<?php
require_once "../../../config.php";
header("Content-type: application/json; charset=utf-8");
$path = PATH_ADMIN.'/controlador/userController.php';
require_once   $path;

/*
class Ajax_Validar_User {
    public function Ingreso($usuario,$pass,$bibliotecaID){
        $CP = new UserController();
        $respuesta = $CP->ValidarPasswordController ($usuario,$pass,$bibliotecaID);

        return $respuesta;
        $CP = null;
    }
}

if(isset($_POST["tipoVerificacion"])){
    $Verificacion = $_POST["tipoVerificacion"];
}
else{
    return;
}


if ($Verificacion=='ingreso'){

    if(isset($_POST["usuario"])){
        $usuario = new Ajax_Validar_User();

        $usuariote= $_POST["usuario"];
        $password= $_POST["password"];
        $bibliotecaID= $_POST["bibliotecaID"];
        //$respuesta ='PASE POR AQUI PAPA';
        $respuesta = $usuario->Ingreso( $usuariote,$password,$bibliotecaID);
        echo $respuesta ;
    }
    */
    $respuesta['root'] = ROOT_PATH;
    $respuesta['respuesta'] ='PASE POR AQUI PAPA';
    $respuesta['root_ADMIN'] = PATH_ADMIN;
    echo json_encode($respuesta) ;


