 <?php
    require("config.php");
    require __DIR__ . '/autoload.php';

    use Class\Empresa;

    $empresa = new Empresa();
    $empresa = $empresa->Empresa();
    if (session_status() === PHP_SESSION_NONE) :
        session_start();
    endif;
    $_SESSION['empresa'] = $empresa;
    if (strlen($empresa->getTelefonoWs()) > 0) :
        echo '<a href="https://api.whatsapp.com/send?phone=' . $empresa->getTelefonoWs() . '" class="btn-wsp" target="_blank">
            <i class="fa fa-whatsapp icono"></i>
        </a>';
    endif;
    ?>

 <header class="header">
     <div class="header__top">
         <div class="container">
             <div class="row">
                 <div class="col-sm-12 col-lg-6 col-md-6">
                     <div class="header__top__left">
                         <ul>
                             <li><i class="fa fa-envelope"></i><?php echo $empresa->getEmail(); ?></li>
                             <?php echo $empresa->getRealizaEnvios(); ?>
                         </ul>
                     </div>
                 </div>
                 <div class="col-sm-12 col-lg-6 col-md-6">
                     <div class="header__top__right">
                         <div class="header__top__right__social">
                             <?php echo $empresa->getLinksRedes(); ?>

                         </div>
                         <div class="header__top__right__auth"><a href="#"><i class="fa fa-user"></i> Ingresar</a></div>
                     </div>

                 </div>
             </div>
         </div>
     </div>

     <div class="container">
         <div class="row">
             <div class="col-sm-12 col-lg-3">

                 <div class="header__logo">

                     <a href="./index.php"><strong><?php echo $empresa->getDescripcion(); ?> </strong><img class="logo" src="assets/img/logo.png" alt=""></a>
                 </div>
             </div>
             <div class="col-sm-12 col-lg-6">
                 <nav class="header__menu">
                     <ul>
                         <li class="active"><a href="./index.php">Inicio</a></li>
                         <li><a href="#">Web</a>
                             <ul class="header__menu__dropdown">
                                 <!--<li><a href="./shop-details.html">Shop Details</a></li>-->
                                 <li><a href="./carrito.php">Carrito</a></li>
                                 <li><a href="./finalizar_compra.html">Finalizar Compra</a></li>
                             </ul>
                         </li>
                         <!--<li><a href="./contact.html">Contacto</a></li>-->
                     </ul>
                 </nav>
             </div>
             <div class="col-lg-3">
                 <div class="header__cart">
                     <ul>
                         <li><a href="./carrito.php"><i class="fa fa-shopping-bag"></i> <span class="headerTotal" id="cantidadTotal"></span></a></li>
                     </ul>
                     <div class="header__cart__price">Total: <span id="totalaPagar"></span></div>
                 </div>
             </div>
         </div>
         <div class="humberger__open">
             <i class="fa fa-bars"></i>
         </div>
     </div>
 </header>
 <?php //require_once("barrabusqueda.php")
    ?>