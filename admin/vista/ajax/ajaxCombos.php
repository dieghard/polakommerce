<?php


use Admin\Modelo\Combos;

class Ajax_Combos
{

    public function __construct()
    {
        require_once "../../Modelo/Combos.php";
    }

    public function Perfiles($tabIndex)
    {
        //int $tabIndex, string $tabla, string $nombreCombo, string $descripcionCombo
        $combo = new Combos();
        $combo = $combo->ComboGenerico($tabIndex, 'perfiles', 'cmbPerfil', 'Perfil');
        echo $combo;
        $combo = null;
    }
}


if (isset($_POST["combo"])) {
    $combo = $_POST["combo"];
} else {
    return;
}
if (isset($_POST["tabIndex"])) {
    $tabIndex = $_POST["tabIndex"];
}
if (isset($_POST["idCombo"])) {
    $idCombo = $_POST["idCombo"];
}


if ($combo == 'Perfiles') {
    Perfiles($tabIndex);
}



function Perfiles($tabIndex)
{
    $respuesta = new Ajax_Combos();
    $respuesta->Perfiles($tabIndex);
}
