<?php
/*  ---------------------------------------------------
    SOFTWARE NAME: polakommerce
    Description:  Software para carrito de compras
    Author: Diego Sebastian Markiewicz
	Email : dieghard@gmail.com
    Version: 1.0
	Obs: se utilizo template de Ogani eCommerce  HTML Template - Created: Colorlib
---------------------------------------------------------  */
 require("config.php");
 require_once('./class/productos.php');
 require_once('./class/fotosvideosproductos.php');

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
