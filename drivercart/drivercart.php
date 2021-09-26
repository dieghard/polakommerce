<?php
header('Access-Control-Allow-Credentials: true');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-type: application/json; charset=utf-8');
$host = 'polakommerce';
//	require_once($_SERVER["DOCUMENT_ROOT"].'/polakommerce/class/carritodigital.php');
require_once  '../config.php';
require_once  '../autoload.php';
require_once  '../Class/DriverCart.php';

use Class\DriverCart;

$input = json_decode(file_get_contents("php://input"), true);
$superArray['success'] = false;
$superArray['mensaje'] = "ocurrio un error";

if (!isset($input["action"])) :
	echo json_encode($superArray, $input);
	exit();
endif;

$action =  strip_tags($input["action"]);
$superArray['action'] = $action;

$driverCart = new DriverCart();


switch ($action):
	case 'ADD':
		$driverCart->Add($superArray, $input);
		break;
	case 'SHOW_TOTALS':
		$driverCart->ShowTotals($superArray);
		break;
	case 'SHOW_CART':
		$driverCart->ShowCart($superArray);
		break;
	case 'SHOW_ORDEN':
		$driverCart->ShowOrden($superArray);
		break;
	default:
		echo json_encode($superArray, $input);
		exit();
endswitch;

echo json_encode($superArray);
