<!--<section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg" style="background-image: url(&quot;img/breadcrumb.jpg&quot;);">-->
<?php
	$obj=new Productos();
   	$id=strip_tags($_GET["id"]);
   	$productos=$obj->getProductosPorId($id);
    $productos= (object)$productos[0];

?>
<div class="container">
	<div class="row">
		<div class="col-lg-12 text-center">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
					<li class="breadcrumb-item"><a href="index.php?rubroid=" <?php echo $productos->rubroID; ?>"><?php echo $productos->rubro; ?></a></li>
					<li class="breadcrumb-item"><a href="index.php?categoriaId=" <?php echo $productos->categoriaID; ?>"><?php echo $productos->categoria; ?></a></li>
					<li class="breadcrumb-item active" aria-current="page"><?php echo $productos->producto ?></li>
				</ol>
			</nav>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 text-center">
			<h2 class="tituloProducto"><?php echo $productos->producto;?></h2>
		</div>
	</div>
</div>
<!--</section>-->
