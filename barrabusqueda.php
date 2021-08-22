<section class="hero hero-normal">
	<div class="container">
		<div class="row">
			<div class="col-lg-3">
				<div class="hero__categories">
					<div class="hero__categories__all">
						<i class="fa fa-bars"></i>
						<span>Categorias</span>
					</div>
					<ul>
						<?php require_once("class/categorias.php");
 							$categorias = new Categorias();
				 			$arrCategorias = $categorias->getCategorias();
							foreach ($arrCategorias as $categorias):
                                echo '<li><a href="#">'.$categorias['titulo'].'</a></li>';
							endforeach;
						?>
					</ul>
				</div>
			</div>
			<div class="col-lg-9">
				<div class="hero__search">
					<div class="hero__search__form">
						<form action="#">
							<div class="hero__search__categories">
								Rubros
								<span class="arrow_carrot-down"></span>
							</div>
							<input type="text" placeholder="que esta necesitando?">
							<button type="submit" class="site-btn">Buscar</button>
						</form>
					</div>
					<div class="hero__search__phone">
						<div class="hero__search__phone__icon">
							<i class="fa fa-phone"></i>
						</div>
						<div class="hero__search__phone__text">
							<h5>03385 50-5100</h5>
							<span>Horario Comercial</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
