<?php
header("Content-type: application/json; charset=utf-8");




$input = file_get_contents("php://input");

require_once "../../../config.php";
require_once "../../../admin/Vista/ajax/UserA.php";

try {

    $input = json_decode($input);
    $respuesta['root'] = ROOT_PATH;
    $respuesta['respuesta'] = 'PASE POR AQUI PAPA';
    $respuesta['root_ADMIN'] = PATH_ADMIN;
} catch (Throwable $e) {
    $respuesta['Error'] = $e->getMessage();
}
$respuesta['tipoVerificacion'] = $input;

$respuesta['tipoVerificacion'] = $input->user;





if (isset($input->user->tipoVerificacion)) :
    $Verificacion = $input->user->tipoVerificacion;
else :
    return;
endif;
if ($input->user->tipoVerificacion == 'ingreso') {

    $usuario = new Ajax_Validar_User();
    $respuesta = $usuario->Ingreso($input->user);
}

echo json_encode($respuesta);
