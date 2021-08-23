<!--<div class="container">
	<div class="row">
		<div class="categories__slider owl-carousel owl-loaded owl-drag">
			<div class="owl-stage-outer">
				<div class="owl-stage" style="transform: translate3d(-1755px, 0px, 0px); transition: all 1.2s ease 0s; width: 3803px;">
					<?php
                      //$productosSlider = productosFrame();
                      //echo  $productosSlider;
                    ?>
				</div>
			</div>
			<div class="owl-nav"><button type="button" role="presentation" class="owl-prev"><span class="fa fa-angle-left"><span></span></span></button><button type="button" role="presentation" class="owl-next"><span class="fa fa-angle-right"><span></span></span></button></div>
			<div class="owl-dots disabled"></div>
		</div>
	</div>
</div>--->
<div class="container">
	<div class="row">
		<div class="col-12">

			<h2 class="miralonuevo animate__hinge animate__delay-5s">¡¡¡Mira LO NUEVO!!!</h2>

		</div>


	</div>
</div>
<div class="row">
	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
			<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
			<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
		</ol>
		<div class="carousel-inner">
			<div class="carousel-item active">
				<img class="" src="fotos\alanbig.jpg" alt="First slide">
			</div>
			<div class="carousel-item">
				<img class="" src="fotos\batmanbig.jpg" alt="Second slide">
			</div>
			<div class="carousel-item">
				<img class="" src="fotos\gowbig.jpg" alt="Third slide">
			</div>
		</div>

	</div>

</div>
</div>
<?php

function productosFrame(){

	require_once("class/productos.php");
	$obj		 = new Productos();
	$productos	 = $obj->getProductosxCarrusel();
	$productosCarrusel ='';
	foreach ($productos as $producto):
        $productosCarrusel .=  '<div class="owl-item cloned" style="width: 800.5px;">
                                    <div class="col-lg-3">
                                        <div class="categories__item set-bg" data-setbg="fotos/'. $producto['imagenPresentacion'].'" style="background-image: url(&quot;fotos/'. $producto['imagenPresentacion'].'&quot;);">
                                            <h5><a href="#">'. $producto['producto'].'</a></h5>
                                        </div>
                                    </div>
                                </div>';
    endforeach;
    return  $productosCarrusel;
}
?>
