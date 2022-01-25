<?php
namespace Class;
use Class\CarritoDigital;

require_once '../Class/CarritoDigital.php';
class DriverCart
{
    public function __construct()
    {
        require_once '../config.php';
        require_once '../autoload.php';
    }
    public function Add(&$superArray, $input)
    {

        if (!isset($input["id"])) :
            return;
        endif;

        $superArray['productoid'] = $input["id"];
        $superArray['cantidad'] = $input["cantidad"];

        if (isset($superArray['cantidad'])) :
            $cantidad = strip_tags($superArray['cantidad']);
        else :
            $cantidad = 1;
        endif;

        if (isset($superArray['productoid'])) :
            $productoid = strip_tags($superArray['productoid']);
        else :
            $prodcutoid = 0;
            header("Location:index.php");
        endif;

        $CarritoDigital = new CarritoDigital();

        $CarritoDigital->setCantidad($cantidad);
        $CarritoDigital->setProductoId($productoid);

        $CarritoDigital->Add($superArray);

        $superArray['cantidadTotal'] = $CarritoDigital->getCantidadTotal();
        $superArray['TotalaPagar'] = $CarritoDigital->getTotalAPagar();

        $superArray['carrito'] = $CarritoDigital->getCarro();

        $superArray['success'] = true;
        $superArray['mensaje'] = "";

        return;
    }

    public function ShowTotals(&$superArray)
    {


        $superArray['DIR'] = __DIR__;


        $CarritoDigital = new CarritoDigital();

        $superArray['cantidadTotal'] = $CarritoDigital->getCantidadTotal();
        $superArray['TotalaPagar'] = $CarritoDigital->getTotalAPagar();
        $superArray['carrito'] = $CarritoDigital->getCarro();

        $dirname = str_replace('\\', '/', dirname(__FILE__));
        $file =  $dirname            . '/CarritoDigital.php';


        $superArray['DIRNAME'] = str_replace('\\', '/', dirname(__FILE__));
        $superArray['file '] = $file;

        $superArray['success'] = true;
        $superArray['mensaje'] = "";
        return;
    }

    public function ShowCart(&$superArray)
    {

        $CarritoDigital = new CarritoDigital();

        $superArray['tabla'] = $CarritoDigital->ShowCart();
        $superArray['success'] = true;

        return;
    }


    public function ShowOrden(&$superArray)
    {

        $CarritoDigital = new CarritoDigital();
        $superArray['tabla'] = $CarritoDigital->ShowOrden();
        $superArray['success'] = true;

        return;
    }
}
