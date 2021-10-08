<?php
/**
 * Description of ajaxComboBibliotecas.
 *
 * @author Diego
 */
class AjaxProvincias
{
    public function __construct()
    {
        require_once '../../controlador/controladorProvincia.php';
    }

    public function llenarGrilla()
    {
        $ajaxProvincia = new ControladorProvincia();
        $respuesta = $ajaxProvincia->llenarGrilla();
        echo $respuesta;
    }

    public function eliminarProvincia($misDatosJSON)
    {
        $ajaxProvincia = new ControladorProvincia();
        $respuesta = $ajaxProvincia->eliminarProvincia($misDatosJSON);
        echo $respuesta;
    }

    public function ingresarActualizarProvincia($misDatosJSON)
    {
        $ajaxProvincia = new ControladorProvincia();
        $respuesta = $ajaxProvincia->ingresarActualizarProvincia($misDatosJSON);
        echo $respuesta;
    }
}

$ajaxProvincia = new AjaxProvincias();

if (isset($_POST['ACTION'])) {
    if ($_POST['ACTION'] == 'llenarGrilla') {
        $ajaxProvincia->llenarGrilla();
        $ajaxProvincia = null;
    }
    if ($_POST['ACTION'] == 'eliminarProvincia') {
        $misDatosJSON = json_decode($_POST['datosjson']);
        $ajaxProvincia->eliminarProvincia($misDatosJSON);
        $ajaxProvincia = null;
    }
    if ($_POST['ACTION'] == 'ingresarActualizarProvincia') {
        $misDatosJSON = json_decode($_POST['datosjson']);
        $ajaxProvincia->ingresarActualizarProvincia($misDatosJSON);
        $ajaxProvincia = null;
    }
} else {
    var_dump($_POST);
}
