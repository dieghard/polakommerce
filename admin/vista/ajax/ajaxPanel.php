<?php


use admin\Modelo\ModeloPanel;

class AjaxPanel
{
    public function __construct()
    {

        require_once '../../modelo/modeloPanel.php';
    }

    public function EstadoPedidos()
    {
        $moduloPanel = new modeloPanel();

        $ingreso = $moduloPanel->EstadoPedidos();

        return $ingreso;
        $moduloPanel = null;
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
