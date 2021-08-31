<div class="container">
	<div class="row">
		<div class="categories__slider owl-carousel owl-loaded owl-drag">
			<div class="owl-stage-outer">
				<div class="owl-stage" style="transform: translate3d(-1755px, 0px, 0px); transition: all 1.2s ease 0s; width: 3803px;">
					<?php
                      $categoriaslider = categoriaFrame();
                      echo  $categoriaslider;
                    ?>
				</div>
			</div>
			<div class="owl-nav"><button type="button" role="presentation" class="owl-prev"><span class="fa fa-angle-left"><span></span></span></button><button type="button" role="presentation" class="owl-next"><span class="fa fa-angle-right"><span></span></span></button></div>
			<div class="owl-dots disabled"></div>
		</div>
	</div>
</div>
<?php

function categoriaFrame(){
    require_once("class/categorias.php");
    $categorias = new Categorias();
    $categoria_frame ='';

    $arrCategorias = $categorias->getCategorias();
    foreach ($arrCategorias as $categorias):
        $categoria_frame .=  '<div class="owl-item cloned" style="width: 800.5px;">
                                    <div class="col-lg-3">
                                        <div class="categories__item set-bg" data-setbg="'. $categorias['imagen'].'" style="background-image: url(&quot;'. $categorias['imagen'].'&quot;);">
                                            <h5><a href="index.php?categoriaID='.$categorias['id'] .'">'. $categorias['titulo'].'</a></h5>
                                        </div>
                                    </div>
                                </div>';
    endforeach;

    return  $categoria_frame;
}
?>
