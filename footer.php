<?php
	if (session_status() === PHP_SESSION_NONE) :
    	session_start();
	endif;

	if (! isset($_SESSION['empresa'])) :
		$_SESSION['empresa'] = '';
	endif;
?>
<!-- Footer Section Begin -->
<footer class="footer spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="footer__about">
                    <div class="footer__about__logo">
                        <a href="./index.html"><img src="<?php echo "./". $_SESSION['empresa']->getLogo()?>" alt=""></a>
                    </div>
                    <ul>
                        <li>Dirección:<?php echo $_SESSION['empresa']->getDireccion() . ',' . $_SESSION['empresa']->getCodigoPostal() .'-'. $_SESSION['empresa']->getLocalidad() .','. $_SESSION['empresa']->getProvincia()?></li>
                        <li>Tel: <?php echo  $_SESSION['empresa']->getTelefono()?></li>
                        <li>Email: <?php echo  $_SESSION['empresa']->getEmail() ?></li>
                    </ul>
                    <ul>
                        <div id="div-totop" class="cmn-divfloat">
                            <a href="https://api.whatsapp.com/send?phone=5195508107&text=Hola%21%20Quisiera%20m%C3%A1s%20informaci%C3%B3n%20sobre%20Varela%202." class="floatws" target="_blank" class="btn btn-primary cmn-btncircle">
                                <i class="fa fa-whatsapp my-float"></i>
                            </a>
                        </div>

                    </ul>
                </div>
            </div>
            <div class=" col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                <div class="footer__widget">
                    <h6>Links Útiles</h6>
                    <!--<ul>
                        <li><a href="#">Sobre nosotros</a></li>
                        <li><a href="#">Infomación de Entrega</a></li>
                    </ul>
                    <ul>
						<li><a href="#">Nuestros Servicios</a></li>
                        <li><a href="#">Proyectos</a></li>
                        <li><a href="#">Contacto</a></li>
                    </ul>
					-->

                    <div class="footer__widget__social">
                        <?php echo $_SESSION['empresa']->getLinksRedes(); ?>
                        <!--<a href="#"><i class="fa fa-facebook-square"></i></a>
                        <a href="#"><i class="fa fa-instagram"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-pinterest"></i></a>-->
                    </div>
                </div>
            </div>
            <!--<div class="col-lg-4 col-md-12">
				<div class="footer__widget">
					<h6>Join Our Newsletter Now</h6>
					<p>Get E-mail updates about our latest shop and special offers.</p>
					<form action="#">
						<input type="text" placeholder="Enter your mail">
						<button type="submit" class="site-btn">Subscribe</button>
					</form>

					<div class="footer__widget__social">
						<a href="#"><i class="fa fa-facebook"></i></a>
						<a href="#"><i class="fa fa-instagram"></i></a>
						<a href="#"><i class="fa fa-twitter"></i></a>
						<a href="#"><i class="fa fa-pinterest"></i></a>
					</div>
				</div>
			</div>-->
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="footer__copyright">
                    <div class="footer__copyright__text">
                        <p>
                            Copyright &copy;<script>
                            document.write(new Date().getFullYear());
                            </script>
                            todos los derechos reservados | powered <i class="fa fa-heart" aria-hidden="true"></i> by <a href="#" target="_blank">bitSnakeSoft</a>
                        </p>
                    </div>
                    <!--<div class="footer__copyright__payment"><img src="img/payment-item.png" alt=""></div>-->
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Section End -->

<?php /* chat bot de Cliengo*/
      if (strlen($_SESSION['empresa']->getCliengo_chat_token_1()) > 0 && strlen($_SESSION['empresa']->getCliengo_chat_token_2() > 0)  ) :
    $strToken =  $_SESSION['empresa']->getCliengo_chat_token_1() . '/'. $_SESSION['empresa']->getCliengo_chat_token_2();

    echo'<script type="text/javascript">(function () { var ldk = document.createElement("script"); ldk.type = "text/javascript"; ldk.async = true; ldk.src = "https://s.cliengo.com/weboptimizer/'.$strToken.'.js?platform=view_installation_code"; var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(ldk, s); })();</script>';

endif;?>
<!-- Js Plugins -->
<script src="js/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="js/jquery.nice-select.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="js/jquery.slicknav.js"></script>
<script src="js/mixitup.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/main.js"></script>
<script src="js/funciones.js"></script>
