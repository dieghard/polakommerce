<?php


use Admin\Modelo\Rubros;

class AjaxRubros
{

   public function __construct()
   {
      require_once "../../Modelo/Rubros.php";
   }

   public function Guardar($oRubro)
   {

      $objeto = new Rubros();
      $objeto = $objeto->Guardar($oRubro);
      echo $objeto;
      $objeto = null;
   }

   public function Eliminar($oRubro)
   {

      $objeto = new Rubros();
      $objeto = $objeto->Eliminar($oRubro);
      echo $objeto;
      $objeto = null;
   }

   public function LlenarGrilla()
   {
      $objeto = new Rubros();
      $objeto = $objeto->LlenarGrilla();
      echo $objeto;
      $objeto = null;
   }
}

$ajaxRubro = new AjaxRubros();

if ($accion == 'llenarGrilla') :
   $respuesta = $ajaxRubro->LlenarGrilla();
endif;

if ($accion == 'guardar') :
   if (isset($_POST['datosjson'])) :
      $oRubro = json_decode($_POST["datosjson"]);
      $respuesta = $ajaxRubro->Guardar($oRubro);
   endif;
endif;

if ($accion == 'eliminar') :
   if (isset($_POST['datosjson'])) :
      $oRubro = json_decode($_POST["datosjson"]);
      $respuesta = $ajaxRubro->Eliminar($oRubro);
   endif;
endif;
