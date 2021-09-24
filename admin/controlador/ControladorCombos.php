<?php

class controladorCombos{
/*=============================================
LLAMAMOS LA PLANTILLA
=============================================*/
    public function __construct(){
           require_once '../../modelo/modeloCombos.php'; 
           }
            public function ComboLocalidad($tabIndex){
            $MP = new ModeloCombos();
            $respuesta = $MP->ComboLocalidad($tabIndex);    
            return $respuesta;
            $MP =null;   
           }
            public function ComboProvincia($tabIndex){
            $MP = new ModeloCombos();
            $respuesta = $MP->ComboProvincia($tabIndex);    
            return $respuesta;
            $MP =null;   
           }
            public function ComboSectores($tabIndex){
                $MP = new ModeloCombos();
                $respuesta = $MP->ComboSectores($tabIndex);    
                return $respuesta;
                $MP =null;   
           }
            public function ComboTipoSocio($tabIndex ){
                $MP = new ModeloCombos();
                $respuesta = $MP->ComboTipoSocio($tabIndex );    
                return $respuesta;
                $MP =null;   
           }
            public function ComboSocios($tabIndex ){
                $MP = new ModeloCombos();
                $respuesta = $MP->ComboSocios($tabIndex );    
                return $respuesta;
                $MP =null;   
           }
            public function ComboSociosAbm($tabIndex,$idCombo ){
                $MP = new ModeloCombos();
                $respuesta = $MP->ComboSociosAbm($tabIndex,$idCombo );    
                return $respuesta;
                $MP =null;
           }
           public function socios_impresion($tabIndex,$idCombo ){
            $MP = new ModeloCombos();
            $respuesta = $MP->socios_impresion($tabIndex,$idCombo );
            return $respuesta;
            $MP =null;
       }
}