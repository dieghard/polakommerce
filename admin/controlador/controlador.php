<?php

//namespace Controlador;
class Controlador
{
 /*=============================================
   Interaccion del Usuario
 =============================================*/
    public function ControladorLinks()
    {
        $MP = new ModeloPlantilla();

        if (isset($_GET['action'])) {
            $enlaces = $_GET['action'];
        } 
        else {
            $enlaces = 'panel';
        }
        $respuesta = $MP->enlacesPaginasModelo($enlaces);
        include $respuesta;
        $respuesta = null;
    }
}
