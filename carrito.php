<?php
require_once __DIR__ . './class/carritodigital.php';
require_once __DIR__ . './class/productos.php';

if(isset($_POST['productoid'])):
        $superArray = array();
		$cantidad   = 0;
		$productoid = 0 ;
		$productoid = $_POST['productoid'];
		$cantidad   = $_POST['cantidad'];
		$manejoCarrito = new ManejoCarrito();
		$manejoCarrito->setCantidad($cantidad);
		$manejoCarrito->setProductoId($productoid);
		$manejoCarrito->Add($superArray);
	endif;
    $datosCompra = array();
    $messages =[];
	if(!isset($_SESSION['carro'])){header("Location:index.php");}
?>
<html>
<?php require_once("head.php"); ?>
<script src="js/car.js"></script>

<body>
    <?php require_once("header.php") ;?>
    <?php require_once("breadcumcarrito.php") ?>
    <section class="tabla-carro">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="shoping__cart__table">
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
                                    <label for="direccion">DNI</label>
                                    <input type="text" class="form-control" name="dni" placeholder="numero documento" requiered>
                                    <small id="numberHelp" class="form-text text-muted">solo el número(sin puntos)</small>
                                </div>
                                <div class="form-group">
                                    <label for="pais">Pais</label>
                                    <input type="text" class="form-control" name="pais" placeholder="Pais" value='ARGENTINA' requiered>
                                </div>
                                <div class="form-group">
                                    <label for="direccion">Dirección</label>
                                    <input type="text" class="form-control" name="direccion" placeholder="calle" requiered>
                                    <input type="text" class="form-control" name="numero" placeholder="numero">
                                    <small id="numberHelp" class="form-text text-muted">solo el número de la calle</small>
                                    <input type="text" class="form-control" name="ciudad" placeholder="ciudad" requiered>
                                    <input type="text" class="form-control" name="departamento" placeholder="departamento">

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
                                <button type="submit" class="btn btn-primary" name="form-submit">Pagar</button>
                            </form>
                        </div>
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
