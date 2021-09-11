<?php
	require_once("class/pedidos.php");
	require_once("enviomail.php");
	session_start();
  	//echo 'HOST:'. $_SERVER["HTTP_HOST"] .'</br>';
  	//echo 'REQUEST_URI:'. $_SERVER["REQUEST_URI"] .'</br>';
  	$url = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
	$success = false;
	if (isset($_GET['success'])) :
		$success =  $_GET['success'];
	else:
		header("Location:carrito.php");
	endif;
	$pagado = false;
	if(isset($_GET['pagado'])):
		$pagado = $_GET['pagado'];
	else:
		header("Location:carrito.php");
	endif;
	if(!isset($_SESSION['cliente'])):
		header("Location:carrito.php");
	endif;
	if(!isset($_SESSION['carro'])):
		header("Location:carrito.php");
	endif;

	$_id            =  0 ;
	$_fecha         =  date('Y-m-d H:i:s')  ;
	$_nombre        = $_SESSION['cliente']['nombre'] ;
	$_apellido      = $_SESSION['cliente']['apellido'] ;
	$_dni		    = $_SESSION['cliente']['dni'] ;
	$_pais		    = $_SESSION['cliente']['pais'] ;
	$_direccion     = $_SESSION['cliente']['direccion'] ;
	$_numero        = $_SESSION['cliente']['numero'] ;
	$_departamento  = $_SESSION['cliente']['departamento'] ;
	$_ciudad        = $_SESSION['cliente']['ciudad'] ;
	$_codPos        = $_SESSION['cliente']['codigoPostal'] ;
	$_telefono      = $_SESSION['cliente']['telefono'] ;
	$_email         = $_SESSION['cliente']['email'] ;
	$_observaciones = $_SESSION['cliente']['observaciones'] ;
	$_estado        = 'NUEVO';
	$_codigoDescuento = '' ;

	$_pagado		   = 'NO';
	if ($pagado):
		$_pagado	= 'SI';
	endif;

	$total         =  0;
	$subtotal      =  0;

	foreach ($_SESSION['carro'] as $subarray) :
		$subtotal = $subarray["precio"] *   $subarray["cantidad"];
		$total    +=  $subtotal;
	endforeach;

	 $_subtotal    = $total;
     $_descuento   = 0;
     $_total       = $total;


?>
<html>
<?php require_once("head.php"); ?>

<body>
    <?php 	if ($success):

	 				$pedidos     = new Pedidos($_id,  $_fecha, $_nombre, $_apellido     ,
										$_dni, $_pais , $_direccion    ,
										$_numero       ,$_departamento , $_ciudad,
										$_codPos       ,
										$_telefono     ,
										$_email        ,
										$_observaciones,
										$_estado       ,
										$_codigoDescuento,$_pagado,
										$_subtotal, $_descuento, $_total );
					$arr = $pedidos->guardar();
					if ($arr['success']):
						echo '<br>';
						echo 'Compra realizada correctamente, muchas gracias  ' .$_SESSION['cliente']['nombre'] . ' ' . $_SESSION['cliente']['apellido']. ' por tu compra</br>' ;
						echo 'le enviamos un mail con el numero de comprobante';
						echo '<br>';
						echo '<br>';
						$envioMail = new Mails();

						$arr = $envioMail->envioEmail();
						unset($_SESSION['cliente']);
						unset($_SESSION['carro']);
						unset($_SESSION['pedido']);
			endif;
		endif;
		?>
    </br>
    <a href="index.php" class="primary-btn cart-btn">volver al inicio</a>
    </br>
    </br>
    <?php require_once("footer.php") ?>
</body>
</html>
