<?php
require_once 'class/carritodigital.php';
require_once 'class/productos.php';
// SDK de Mercado Pago
	require __DIR__ .  '/vendor/autoload.php';
 	MercadoPago\SDK::setAccessToken('TEST-8883022316865038-082121-a29106f851ba358ef8c612a202e7c1e0-811503701'); //ACCES TOKEN
  $preference = new MercadoPago\Preference();  // Crea un ítem en la preferencia

  $preference->back_urls = array (
   	"success" => "http://localhost:8080/polakommerce/gracias.php",
   	"failure" => "http://localhost:8080/polakommerce/errorpago.php",
   	"pending" =>"http://localhost:8080/polakommerce/pendiente.php"
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
//echo(enviar($vars, $url));

	$datosCompra = array();
    $messages =[];
	foreach ($_SESSION['carro'] as $subarray) :
		$obj = new Productos();
   		$id  = strip_tags( $subarray["id"]);
		$productos=$obj->getProductosPorId($id,$messages);
    	$productos= (object)$productos[0];
		$item = new MercadoPago\Item();
		$item->title = $productos->producto;
		$item->quantity = $subarray["cantidad"];
		$item->unit_price = $subarray["precio"];
		$datosCompra[] =$item;
	endforeach;

  $preference->items = $datosCompra;
  $preference->save();

?>

<html>
<?php require_once("head.php"); ?>
<script src="js/car.js"></script>

<script src="https://sdk.mercadopago.com/js/v2"></script>

<body>
	<?php require_once("header.php") ;?>
	<?php require_once("breadcumcarrito.php") ?>
	<section class="tabla-carro">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="tabla-carro_">
						<div id="tabla">
						</div>
					</div>
				</div>
				<div class="col-lg-6">

					<h4>DETALLES DE FACTURACIÓN</h4>
					<div class="row">
						<div class="col-lg-8 col-md-6">
							<form role="form" id="contactForm" method="post" action="finalizar_compra.php">

								<div class="form-group">
									<label for="nombre">Nombre</label>
									<input type="text" class="form-control" name="nombre" placeholder="Nombre" requiere>
								</div>
								<div class="form-group">

									<label for="apellido">Apellido</label>
									<input type="text" class="form-control" name="apellido" placeholder="Apellido" requiered>
								</div>
								<div class="form-group">
									<label for="pais">Pais</label>
									<input type="text" class="form-control" name="pais" placeholder="Pais" value='ARGENTINA' requiered>
								</div>
								<div class="form-group">
									<label for="direccion">Dirección</label>
									<input type="text" class="form-control" name="direccion" placeholder="Dirección" requiered>
									<input type="text" class="form-control" name="departamento" placeholder="departamento (opcional)">
								</div>
								<div class="form-group">
									<label for="ciudad">Ciudad</label>
									<input type="text" class="form-control" name="ciudad" placeholder="Ciudad" requiered>
								</div>
								<div class="form-group">
									<label for="codigoPostal">Codigo postal</label>
									<input type="text" class="form-control" name="codigoPostal" placeholder="Codigo Postal" requiered>
								</div>
								<div class="form-group">
									<label for="telefono">Telefono</label>
									<input type="text" class="form-control" name="telefono" placeholder="Telefono (opcional)">
								</div>
								<div class="form-group">
									<label for="email">Email</label>
									<input type="email" class="form-control" name="email" placeholder="email" requiered>
								</div>
								<div class="form-group">
									<label for="Observaciones">Observaciones</label>
									<input type="Observaciones" class=" form-control" name="observaciones" placeholder="Observaciones">
									<small id="emailHelp" class="form-text text-muted">Alguna nota sobre la compra o donde entregarlo</small>
								</div>
								<button type="submit" class="btn btn-primary" name=="form-submit">Pagar</button>
							</form>
						</div>

					<div class="shoping__checkout">
						<h4>DETALLES DE FACTURACIÓN</h4>
						<form action="#">

							<div class="finalizar_compra__input">
								<p>Nombre<span>*</span></p>
								<input type="text">
							</div>

							<div class="finalizar_compra__input">
								<p>Apellido<span>*</span></p>
								<input type="text">
							</div>

							<div class="finalizar_compra__input">
								<p>Pais<span>*</span></p>
								<input type="text">
							</div>
							<div class="finalizar_compra__input">
								<p>Dirección<span>*</span></p>
								<input type="text" placeholder="Dirección" class="finalizar_compra__input__add">
								<input type="text" placeholder="departamento (opcional)">
							</div>
							<div class="finalizar_compra__input">
								<p>Ciudad<span>*</span></p>
								<input type="text">
							</div>
							<div class="finalizar_compra__input">
								<p>Pais<span>*</span></p>
								<input type="text">
							</div>
							<div class="finalizar_compra__input">
								<p>Codigo postal<span>*</span></p>
								<input type="text">
							</div>


							<div class="finalizar_compra__input">
								<p>Telefono<span>*</span></p>
								<input type="text">
							</div>


							<div class="finalizar_compra__input">
								<p>Email<span>*</span></p>
								<input type="text">
							</div>

							<div class="finalizar_compra__input">
								<p>Observaciones<span>*</span></p>
								<input type="text" placeholder="Alguna nota sobre la compra o donde entregarlo">
							</div>

					</div>

				</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="finalizar_compra__finalizar" id="finalizar_compra__finalizar">
						<!--<input type="button" id="checkout-open-radio" value="PAGAR" onclick="checkout.open()">-->
						<script>
						const mp = new MercadoPago('TEST-f23a2997-302e-41c4-ad53-2355f4effee7', {
							locale: 'es-AR'
						});

						const checkout = mp.checkout({
							preference: {
								id: '<?php echo $preference->id ?>'
							}
						});
						</script>

					</div>
				</div>
			</div>

			</form>
		</div>

		</div>
		</div>
		</div>
		<!--********************contenedor****************************************-->

		<?php require_once("footer.php") ?>
</body>
</html>
