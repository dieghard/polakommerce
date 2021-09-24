<?php
require_once "../../controlador/ControladorCombos.php";
/*
=================================================================================================
 * VALIDAR USUARIO!
=================================================================================================
*/
class Ajax_Combos{

        public function comboLocalidades($tabIndex){
            $combo = new controladorCombos();
            $combo = $combo->ComboLocalidad($tabIndex);
            echo $combo;
            $combo = null;
        }
        public function comboProvincias($tabIndex){

            $combo = new controladorCombos();
            $combo = $combo->ComboProvincia($tabIndex);
            echo $combo ;
            $combo = null;
        }
        public function comboSectores($tabIndex){

            $combo = new controladorCombos();
            $combo = $combo->ComboSectores($tabIndex);
            echo $combo ;
            $combo = null;
        }
        public function comboTipoSocio($tabIndex ){

            $combo = new controladorCombos();
            $combo = $combo->ComboTipoSocio($tabIndex );
            echo $combo ;
            $combo = null;
        }
        public function comboSocios($tabIndex ){

            $combo = new controladorCombos();
            $combo = $combo->ComboSocios($tabIndex );
            echo $combo ;
            $combo = null;
        }
        public function comboSociosAbm($tabIndex,$idCombo ){

            $combo = new controladorCombos();
            $combo = $combo->ComboSociosAbm($tabIndex,$idCombo );
            echo $combo ;
            $combo = null;
        }

        public function socios_impresion($tabIndex,$idCombo ){

            $combo = new controladorCombos();
            $combo = $combo->socios_impresion($tabIndex ,$idCombo);
            echo $combo ;
            $combo = null;
        }

}

if(isset($_POST["combo"])){
        $combo = $_POST["combo"];
}
    else{
        return;
}
if(isset($_POST["tabIndex"])){
        $tabIndex = $_POST["tabIndex"];
}
if(isset($_POST["idCombo"])){
    $idCombo = $_POST["idCombo"];
}




if ($combo=='localidades'){comboLocalidades($tabIndex);}
if ($combo=='sector'){comboSectores($tabIndex);}
if ($combo=='provincias'){comboProvincias($tabIndex);}
if ($combo=='tipoSocio'){combotipoSocio($tabIndex);}
if ($combo=='Socios'){comboSocios($tabIndex);}
if ($combo=='socios_abm'){comboSociosAbm($tabIndex,$idCombo);}
if ($combo=='socios_impresion'){socios_impresion($tabIndex,$idCombo);}

function  comboLocalidades($tabIndex ){
    $respuesta = new Ajax_Combos();
    $respuesta->comboLocalidades($tabIndex );
}
function comboProvincias($tabIndex ){
    $respuesta = new Ajax_Combos();
    $respuesta->comboProvincias($tabIndex );
}
function comboSectores($tabIndex){
    $respuesta = new Ajax_Combos($tabIndex);
    $respuesta->comboSectores($tabIndex);
}
function combotipoSocio($tabIndex ){
    $respuesta = new Ajax_Combos();
    $respuesta->comboTipoSocio($tabIndex );
}
function comboSocios($tabIndex ){
    $respuesta = new Ajax_Combos();
    $respuesta->comboSocios($tabIndex );
}
function comboSociosAbm($tabIndex,$idCombo ){
    $respuesta = new Ajax_Combos();
    $respuesta->comboSociosAbm($tabIndex,$idCombo );
}
function socios_impresion($tabIndex,$idCombo ){
    $respuesta = new Ajax_Combos();
    $respuesta->socios_impresion($tabIndex,$idCombo );
}