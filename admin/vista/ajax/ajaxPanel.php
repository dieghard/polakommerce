<?php

use admin\Controlador\ControladorPanel;

class AjaxPanel
{
    public function __construct()
    {
        require_once '../../controlador/controladorPanel.php';
    }

    public function EstadoPedidos()
    {
        $controlador = new controladorPanel();
        $respuesta = $controlador->EstadoPedidos();

        return $respuesta;
        $CP = null;
    }
}

if (isset($_POST['ACTION'])) :
    $accion = $_POST['ACTION'];
else :
    return;
endif;

if ($accion == 'estadoPedidos') :
    $panel = new AjaxPanel();
    if (session_status() == PHP_SESSION_NONE) :
        session_start();
    endif;
    $respuesta = 'PASE POR AQUI PAPA';
    $respuesta = $panel->EstadoPedidos();
    echo $respuesta;
endif;
