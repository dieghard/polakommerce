<?php
	header('Access-Control-Allow-Credentials: true');
	header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
	header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
	header('Content-type: application/json; charset=utf-8');
    $host = 'polakommerce';
//	require_once($_SERVER["DOCUMENT_ROOT"].'/polakommerce/class/carritodigital.php');



	$input = json_decode(file_get_contents("php://input"), true);
	$superArray['success'] = false;
	$superArray['mensaje'] = "ocurrio un error";

	if (!isset($input["action"])) :
        echo json_encode($superArray,$input);
        exit();
    endif;

    $action =  strip_tags($input["action"]);
	$superArray['action'] = $action;

	switch ($action) :
		case 'ADD':
            Add($superArray,$input);
			break;
		case 'SHOW_TOTALS':
            ShowTotals($superArray);
			break;
		case 'SHOW_CART':
            ShowCart($superArray);
			break;
		case 'SHOW_ORDEN':
			ShowOrden($superArray);
			break;
		default:
  			echo json_encode($superArray,$input);
        	exit();
	endswitch;

	echo json_encode($superArray);

function Add(&$superArray,$input){

	if (!isset($input["id"])) :
		return;
	endif;

	$superArray['productoid'] = $input["id"];
	$superArray['cantidad']   = $input["cantidad"];

	if (isset($superArray['cantidad'])) :
		$cantidad = strip_tags($superArray['cantidad']);
	else:
		$cantidad = 1 ;
	endif;

	if (isset($superArray['productoid'])) :
		$productoid = strip_tags($superArray['productoid']);
	else:
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

	$superArray['success']=true;
	$superArray['mensaje']="";

	return ;

}

function ShowTotals(&$superArray){

	require_once  '../config.php';
 	require_once  '../auto.php';
 	Loader::init('../class' );
	$superArray['DIR'] = __DIR__;
	 //$CarritoDigital = new CarritoDigital();
	/*
	$superArray['cantidadTotal'] = $CarritoDigital->getCantidadTotal();
	$superArray['TotalaPagar'] = $CarritoDigital->getTotalAPagar();
	$superArray['carrito'] = $CarritoDigital->getCarro();
*/
	//$superArray['path'] = $_SERVER["DOCUMENT_ROOT"].'/polakommerce/config.php';
	$superArray['success']= true;
	$superArray['mensaje']= "";


	return ;

}

function ShowCart(&$superArray){

	$CarritoDigital = new CarritoDigital();

	$superArray['tabla']  = $CarritoDigital->ShowCart();
	$superArray['success']  = true;

	return;
}


function ShowOrden(&$superArray){

	$CarritoDigital = new CarritoDigital();
	$superArray['tabla']  = $CarritoDigital->ShowOrden();
    $superArray['success']  = true;

	return;
}
