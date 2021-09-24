<?php


/*
=================================================================================================
 * VALIDAR USUARIO!
=================================================================================================
*/

class ajax_Panel
{
    public function __construct()
    {
        require_once '../../controlador/controladorPanel.php';
    }

    public function verificarUsuarios($bibliotecaID)
    {
        $controlador = new controladorPanel();
        $respuesta = $controlador->verificarUsuarios($bibliotecaID);

        return $respuesta;
        $CP = null;
    }
}
/*
=================================================================================================
 * LECTURA DE AJAX DEPENDIENDO EL TIPO DE CHEK LLAMO A UNA CLASE O A OTRA!
=================================================================================================
*/

if (isset($_POST['ACTION'])) {
    $accion = $_POST['ACTION'];
} else {
    return;
}

if ($accion == 'cantidadSocios') {
    $panel = new ajax_Panel();
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $biblioteca = $_SESSION['biblioteca'];
    $bibliotecaID = $biblioteca['id'];

    //$respuesta ='PASE POR AQUI PAPA';
    $respuesta = $panel->verificarUsuarios($bibliotecaID);
    echo $respuesta;
}
