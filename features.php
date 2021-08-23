<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<div class="section-title">
				<h2>Productos</h2>
			</div>
			<div class="featured__controls">
				<ul>
					<li class="active" data-filter="*">Todos</li>
					<?php
					require_once("class/categorias.php");
    				$categorias = new Categorias();
    				$arrCategorias = $categorias->getCategorias();
    				$categoria_frame ='';
    				foreach ($arrCategorias as $categorias):
                        $cadena =str_replace(' ', '', $categorias['titulo']);
						echo'<li data-filter=".'.$cadena.'">'.$categorias['titulo'].'</li>';
					endforeach; ?>
				</ul>
			</div>
		</div>
	</div>
	<div class="row featured__filter" id="MixItUp48D1AC">
		<?php
		$obj		 = new Productos();
		$productos	 = $obj->getProductos();
		foreach ($productos as $producto):
		?>

		<div class="col-lg-3 col-md-4 col-sm-6 mix <?php $cadena =str_replace(' ', '', $producto['categoria']);  echo $cadena; ?>">
			<div class="featured__item">
				<div class="featured__item__pic set-bg" data-setbg="fotos/<?php echo $producto['imagenPresentacion']; ?>" style=" background-image: url(&quot;fotos/<?php echo $producto['imagenPresentacion']; ?>&quot;);">
					<ul class="featured__item__pic__hover">
						<?php echo '<li><a href="pro.php?id='.$producto["id"].'"><i class="fa fa-info"></i></a></li>' ;?>
						<?php $action="'ADD'"; echo '<li><a  onclick="agregar('. $producto["id"].','.$action.')"><i class="fa fa-shopping-cart"></i></a></li>' ;?>


					</ul>
				</div>
				<p class="categorysmaller"><?php echo $producto['categoria']; ?></p>
				<div class="featured__item__text">
					<h6 class='nombreNeon'><a href="#"><?php echo $producto['producto']; ?></a></h6>
					<h5>$<?php echo $producto['precio']; ?></h5>
				</div>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
</div>
