<?php

re
class Modelo
{

    public function ControladorLinksModelo($enlaces)
    {

        if (
            $enlaces == 'panel' ||
            $enlaces == 'turnos' ||
            $enlaces == 'sectores' ||
            $enlaces == 'inhabilitacion'
        ) {
            $module = $enlaces . ".php";
        } else {
            $module = "panel.php";
        }

        if ($enlaces == 'logout') {
            if (headers_sent()) {
                echo '<script>location.replace("logout.php");</script>';
            }
        } else {
            return $module;
        }
    }

    public function __construct()
    {
        require_once "conexion.php";
    }
}
