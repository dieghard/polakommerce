<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="box box-solid box-success">
                <div class="box-header">
                    <h4>Maestro de Usuarios <button type="button" class="btn btn-primary" id="btnNuevo" title="haga un click aqui para ingresar un nuevo socio">NUEVO Usuario</button> </h4>
                </div>
                <div class="box-body">
                    <div id="tabla">
                        <!---se llena por j -->
                    </div>
                </div>
                <!--<hr class="b-w-5 b-wisteria">---DIBUJA UNA LINEA -->
            </div>
        </div>
        <!-- Modal -->
        <div class="modal" id="modalUsers2">
            <div class="modal-dialog">
                <!-- Modal content -->
                <div class="modal-content">
                    <!-- Modal HEADER-->
                    <?php include 'users_modal.php'; ?>
                    <!-- Modal FOOTER-->
                    <div class="modal-footer">
                        <button type="button" id="btnGuardar" class="btn btn-success" tabindex="13">Guardar</button>
                        <button type="button" id="btnCerrarAbajo" class="btn btn-cancel close btn btn-warning" data-dismiss="modal" tabindex="14">Cerrar</button>
                    </div>
                    <div id="error"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="paginas/js/users_abm.js"></script>