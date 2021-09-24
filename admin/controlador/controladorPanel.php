<?php


class controladorPanel
{
    /*=============================================
    LLAMAMOS LA PLANTILLA
    =============================================*/
    public function __construct()
    {
        require_once '../../modelo/modeloPanel.php';
    }

    public function verificarUsuarios($bibliotecaID)
    {
        $moduloPanel = new modeloPanel();

        $ingreso = $moduloPanel->verificarUsuarios($bibliotecaID);

        return $ingreso;
        $moduloPanel = null;
    }
}
