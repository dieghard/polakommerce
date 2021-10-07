<?php

namespace admin\Controlador;

use admin\Modelo\ModeloPanel;

class ControladorPanel
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
