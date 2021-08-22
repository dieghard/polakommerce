<?php
 require_once("class/productos.php");
 require_once("class/fotosvideosproductos.php");
 require 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/config/');
$dotenv->load();
/*echo getenv('DB_USER') . PHP_EOL;
echo $_ENV['DB_USER'] . PHP_EOL;
echo $_SERVER['DB_USER'] . PHP_EOL;*/
?>

<html>

<?php require_once("head.php"); ?>

<body>

	<div id="header">
		<?php require_once("header.php") ;?>
	</div>

	<section class="categorias">
		<?php require_once("carruselcategorias.php"); ?>
	</section>

	<section class="destacados-spad">
		<?php require_once("features.php"); ?>
	</section>

	<?php require_once("footer.php") ?>
</body>
</html>
