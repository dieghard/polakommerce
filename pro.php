<?php


//require_once($_SERVER["DOCUMENT_ROOT"] . '/polakommerce/class/productos.php');
//require_once('autoload.php');

require_once('Class/Productos.php');

use Class\Productos;

$obj = new Productos();

$id  = strip_tags($_GET["id"]);
$menssages = [];
$productos = $obj->getProductosPorId($id, $menssages);
$productos = (object)$productos[0];
?>

<html>
<?php require_once("head.php"); ?>

<body>

    <?php require_once("header.php") ?>
    <?php require_once("breadcum.php") ?>
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large" id='picturePrincipal' src="fotos/<?php echo $productos->imagenPresentacion; ?>" alt="">
                            <div class="containerGaleria">
                                <ul class="menuGaleria">
                                    <li>
                                        <img class="minigaleria" src="fotos/<?php echo $productos->imagenPresentacion; ?>" onclick="imageClick(this)" />
                                    </li>
                                    <?php
                                    $categoriaslider = categoriaFrame($id);
                                    echo  $categoriaslider;
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <form action="carrito.php" method="post">
                            <h3><?php echo $productos->producto ?></h3>
                            <h6><?php echo $productos->subtitulo ?></h6>
                            <div class="product__details__price">$<?php echo $productos->precio; ?></div>
                            <p><?php echo $productos->descripcion; ?></p>
                            <div class="product__details__quantity">
                                <input type="number" value=<?php echo $productos->id ?> name='productoid' hidden>
                                <div class="quantity">
                                    <input type="number" value="1" min="1" name='cantidad'>
                                </div>
                            </div>
                            <input type="submit" class="primary-btn" value="COMPRAR">
                            <!--<a href="carrito.php?id=<?php //echo $productos->id;
                                                        ?>&action=add">AGREGAR AL CARRITO</a>-->
                            <a href="#" class="heart-icon"><i class="fas fa-heart"></i></a>
                            <ul>
                                <li><b>Disponibilidad:</b>
                                    <?php if ($productos->conStock) :
                                        echo '<span style= "color:green" >SIN STOCK</span>';
                                    else :
                                        echo '<span style= "color:red" >CON STOCK</span>';
                                    endif; ?>
                                </li>
                                <!--<li><b>Envio:</b> <span><samp>Free pickup today</samp></span></li>-->
                                <li><b>Peso</b> <span><?php echo $productos->peso; ?></span></li>
                        </form>
                        <li><b>Compartilo:</b>
                            <div class="share">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                            </div>
                        </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
        </div>

        <div class="col-lg-12">
            <div class="product__details__tab">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab" aria-selected="true">INFORMACIÓN</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tabs-1" role="tabpanel">
                        <div class="product__details__tab__desc">
                            <!--<h6>INFORMACIÓN</h6>-->
                            <p><?php echo $productos->informacion; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    </section>

    <!--<div id="video">
					<a href="carrito.php?id=<?php echo $pro['id']; ?>&action=add">Comprar</a>
					<button onclick="add2(<?php echo $pro['id']; ?>,'add');" class="btn success">Comprar</button>
					<p><?php //echo $pro["video"];
                        ?></p>
				</div>-->
    <!--********************contenedor****************************************-->

    <?php require_once("footer.php") ?>
    </div>
</body>

</html>
<?php
require_once('autoload.php');

use Class\FotosVideosProductos;

function categoriaFrame($id)
{


    $obj         = new FotosVideosProductos();
    $fotosProductos     = $obj->getFotosVideos($id);
    $fotoProducto_frame = '';

    foreach ($fotosProductos as $fotoProducto) :
        if (file_exists($fotoProducto['foto'])) :
            $fotoProducto_frame .=  '<li><img class="minigaleria" src="' . $fotoProducto['foto'] . '"onclick="imageClick(this)" /></li>';
        endif;
    endforeach;

    return  $fotoProducto_frame;
}
?>