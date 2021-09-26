<?php
require_once("class/empresa.php");
require_once("class/productos.php");
if (!isset($_SESSION)) {
	session_start();
}

use Class\Empresa;
use Class\Productos;

$empresa = new Empresa();
$empresa = $empresa->Empresa();

// SDK de Mercado Pago

require __DIR__ .  '/vendor/autoload.php';
$accessTocken = $empresa->getMercado_pago_access_token();

//MercadoPago\SDK::setAccessToken('TEST-8883022316865038-082121-a29106f851ba358ef8c612a202e7c1e0-811503701'); //ACCES TOKEN

MercadoPago\SDK::setAccessToken($accessTocken); //ACCES TOKEN
$preference = new MercadoPago\Preference();  // Crea un ítem en la preferencia

$link = str_replace('finalizar_compra', 'fin', "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
$preference->back_urls = array(

	"success" => $link . '?success=true&pagado=true',
	"failure" => $link . '?success=false&pagado=false',
	"pending" => $link . '?&success=true&pagado=false'

);

/*
Public Key
TEST-f23a2997-302e-41c4-ad53-2355f4effee7
Access Token
TEST-7729581734382755-102221-bb742e51818163d75d19a98c158a832d-84362286
*/
/*
VENDEDOR;
{"id":811503701,"nickname":"TESTZLBHC0WB","password":"qatest6219","site_status":"active","email":"test_user_7497575@testuser.com"}
Public Key
TEST-ffcf3d14-1468-4a26-9056-7188caf46073
Access Token
TEST-8883022316865038-082121-a29106f851ba358ef8c612a202e7c1e0-811503701
*/
////////////////////////////////////////////////////
//COMPRADOR
//{"id":811476812,"nickname":"TESTQVTWE78W","password":"qatest197","site_status":"active","email":"test_user_98042701@testuser.com"}
// TARJETA = "4075 5957 1648 3764"  VENCIMIENTO = 11/25  CODIGO = 123
//echo(enviar($vars, $url));

if (!isset($_POST['nombre'])) :
	header("Location:carrito.php");
endif;
if (!isset($_POST['apellido'])) :
	header("Location:carrito.php");
endif;
if (!isset($_POST['dni'])) :
	header("Location:carrito.php");
endif;
if (!isset($_POST['numero'])) :
	header("Location:carrito.php");
endif;
/*
	if(!isset($_POST['pais'])):
		header("Location:carrito.php");
	endif;
	if(!isset($_POST['direccion'])):
		header("Location:carrito.php");
	endif;
	if(!isset($_POST['ciudad'])):
		header("Location:carrito.php");
	endif;
	if(!isset($_POST['codigoPostal'])):
		header("Location:carrito.php");
	endif;
	if(!isset($_POST['email'])):
		header("Location:carrito.php");
	endif;
*/
$_SESSION['cliente']['nombre'] = $_POST['nombre'];
$_SESSION['cliente']['apellido'] = $_POST['apellido'];
$_SESSION['cliente']['pais'] = $_POST['pais'];
$_SESSION['cliente']['direccion'] = $_POST['direccion'];
$_SESSION['cliente']['numero'] = $_POST['numero'];
$_SESSION['cliente']['codigoPostal'] = $_POST['codigoPostal'];
$_SESSION['cliente']['departamento'] = $_POST['departamento'];
$_SESSION['cliente']['ciudad'] = $_POST['ciudad'];
$_SESSION['cliente']['telefono'] = '';
if (isset($_POST['telefono'])) :
	$_SESSION['cliente']['telefono'] = $_POST['telefono'];
endif;
$_SESSION['cliente']['email'] = $_POST['email'];
$_SESSION['cliente']['dni'] = $_POST['dni'];
$_SESSION['cliente']['observaciones'] = '';
if (!isset($_POST['observaciones'])) :
	$_SESSION['cliente']['observaciones'] = $_POST['observaciones'];
endif;


$datosCompra = array();
$messages = [];
foreach ($_SESSION['carro'] as $subarray) :
	$obj = new Productos();
	$id  = strip_tags($subarray["id"]);
	$productos = $obj->getProductosPorId($id, $messages);
	$productos = (object)$productos[0];
	$item = new MercadoPago\Item();
	$item->title = $productos->producto;
	$item->quantity = $subarray["cantidad"];
	$item->currency_id  = 'ARS';
	$item->unit_price = $subarray["precio"];
	$datosCompra[] = $item;
endforeach;


$payer = new MercadoPago\Payer();
$payer->name = $_SESSION['cliente']['nombre'];
$payer->surname = $_SESSION['cliente']['apellido'];
$payer->email = $_SESSION['cliente']['email'];
$payer->phone = array(
	"area_code" => "+54",
	"number" => $_SESSION['cliente']['telefono']
);

$payer->identification = array(
	"type" => "DNI",
	"number" => $_SESSION['cliente']['dni']
);

$payer->address = array(
	"street_name" => $_SESSION['cliente']['direccion'],
	"street_number" => $_SESSION['cliente']['numero'],
	"zip_code" => $_SESSION['cliente']['codigoPostal']
);

$preference->items = $datosCompra;
$preference->prayer =  $payer;
$preference->save();

$key =  $empresa->getmercado_pago_key();
echo '<html>';
require_once("head.php");
echo '<script src="https://sdk.mercadopago.com/js/v2"></script>';
echo '<body>';
echo '	<script>';
echo '	const mp = new MercadoPago("' . $key . '", {';
echo "			locale: 'es-AR'	});";
echo '	const checkout = mp.checkout({';
echo "			preference: {id:'" . $preference->id . "'},autoOpen: true});";
echo '	</script>';
echo '	 <a href="index.php" class="primary-btn cart-btn">volver al inicio</a>';
echo '	</body>';
