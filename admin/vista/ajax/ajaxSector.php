<?php
/**
 * Description of ajaxComboBibliotecas.
 *
 * @author Diego
 */
class AjaxSector
{
    public function __construct()
    {
        require_once '../../controlador/controladorSector.php';
    }

    public function llenarGrilla($bibliotecaID)
    {
        $ajaxSector = new ControladorSector();
        $respuesta = $ajaxSector->llenarGrilla($bibliotecaID);
        echo $respuesta;
    }

    public function eliminarSector($bibliotecaID, $misDatosJSON)
    {
        $ajaxSector = new ControladorSector();
        $respuesta = $ajaxSector->eliminarSector($bibliotecaID, $misDatosJSON);
        echo $respuesta;
    }

    public function ingresarActualizarSector($bibliotecaID, $misDatosJSON)
    {
        $ajaxSector = new ControladorSector();
        $respuesta = $ajaxSector->ingresarActualizarSector($bibliotecaID, $misDatosJSON);
        echo $respuesta;
    }
}

$ajaxSector = new AjaxSector();

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$biblioteca = $_SESSION['biblioteca'];
$bibliotecaID = $biblioteca['id'];

if (isset($_POST['ACTION'])) {
    if ($_POST['ACTION'] == 'llenarGrilla') {
        $ajaxSector->llenarGrilla($bibliotecaID);
        $ajaxSector = null;
    }
    if ($_POST['ACTION'] == 'eliminarSector') {
        $misDatosJSON = json_decode($_POST['datosjson']);
        $ajaxSector->eliminarSector($bibliotecaID, $misDatosJSON);
        $ajaxSector = null;
    }
    if ($_POST['ACTION'] == 'ingresarActualizarSector') {
        $misDatosJSON = json_decode($_POST['datosjson']);
        $ajaxSector->ingresarActualizarSector($bibliotecaID, $misDatosJSON);
        $ajaxSector = null;
    }
} else {
    //  var_dump($_POST);
}
