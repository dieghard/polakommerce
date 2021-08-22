<html>
<?php require_once("head.php"); ?>
<script src="js/finishhim.js"></script>
<script src="https://sdk.mercadopago.com/js/v2"></script>


<body>

	<div id="header">
		<?php require_once("header.php") ;?>
	</div>
	<?php require_once("breadcumcheckout.php") ?>

	<section class="finalizar_compra spad">
		<div class="container">
			<div class="shoping__checkout">
				<h4>DETALLES DE FACTURACIÓN</h4>
				<form action="#">
					<div class="row">
						<div class="col-lg-8 col-md-6">
							<div class="row">
								<div class="col-lg-6">
									<div class="finalizar_compra__input">
										<p>Nombre<span>*</span></p>
										<input type="text">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="finalizar_compra__input">
										<p>Apellido<span>*</span></p>
										<input type="text">
									</div>
								</div>
							</div>
							<div class="finalizar_compra__input">
								<p>Pais<span>*</span></p>
								<input type="text">
							</div>
							<div class="finalizar_compra__input">
								<p>Dirección<span>*</span></p>
								<input type="text" placeholder="Dirección" class="finalizar_compra__input__add">
								<input type="text" placeholder="departamento (opcional)">
							</div>
							<div class="finalizar_compra__input">
								<p>Ciudad<span>*</span></p>
								<input type="text">
							</div>
							<div class="finalizar_compra__input">
								<p>Pais<span>*</span></p>
								<input type="text">
							</div>
							<div class="finalizar_compra__input">
								<p>Codigo postal<span>*</span></p>
								<input type="text">
							</div>
							<div class="row">
								<div class="col-lg-6">
									<div class="finalizar_compra__input">
										<p>Telefono<span>*</span></p>
										<input type="text">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="finalizar_compra__input">
										<p>Email<span>*</span></p>
										<input type="text">
									</div>
								</div>
							</div>

							<div class="finalizar_compra__input">
								<p>Observaciones<span>*</span></p>
								<input type="text" placeholder="Alguna nota sobre la compra o donde entregarlo">
							</div>
						</div>
						<div class="col-lg-4 col-md-6">
							<div class="finalizar_compra__finalizar" id="finalizar_compra__finalizar">

							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</section>

	<?php require_once("footer.php") ?>
</body>
</html>
