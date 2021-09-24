<?php

class ControladorSector
{
    public function __construct()
    {
        require_once '../../modelo/modeloSector.php';
    }

    public function eliminarSector($bibliotecaID, $data)
    {
        $controlador = new Modelosector();
        $respuesta = $controlador->eliminarSector($bibliotecaID, $data);

        return $respuesta;
        $controlador = null;
    }

    public function ingresarActualizarSector($bibliotecaID, $data)
    {
        $controlador = new Modelosector();
        $respuesta = $controlador->ingresarActualizarSector($bibliotecaID, $data);

        return $respuesta;
        $controlador = null;
    }

    public function llenarGrilla($bibliotecaID)
    {
        $controlador = new Modelosector();
        $respuesta = $controlador->llenarGrilla($bibliotecaID);

        return $respuesta;
        $controlador = null;
    }
}
