<div class="row">
    <div class ="col-12">
        <div class="row">
            <div class="box box-solid box-success">
                    <div class="box-header">
                        <h4>Maestro de socios <button type="button" class="btn btn-primary" id="btnNuevo" title="haga un click aqui para ingresar un nuevo socio">NUEVO SOCIO</button> </h4>
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
        <div class="modal" id="modalUsers2" >
            <div class="modal-dialog">
                <!-- Modal content -->
                <div class="modal-content">

                <!-- Modal HEADER-->
                    <div class="modal-header">
                        <h4 class="modal-title">USUARIO</h4>
                        <button type="button" id="btnCerrar" class="btn btn-cancel close" data-dismiss="modal">&times;</button>
                        <input type="hidden" id="id"  > 
                    </div>
                    <!-- Modal BODY-->
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="documento">Documento</label>
                            <input type="text" class="form-control" id="documento" placeholder="Ingrese el documento y presione enter"  onkeypress="return AddKeyPress(event);" maxlength="20" tabindex="1" required > 
                        </div>
                        <div class="form-group">
                            <label for="numeroSocio">N°SOCIO</label>
                            <input type="text" class="form-control" id="numeroSocio" placeholder="Ingrese el numeroSocio "  onkeypress="return AddKeyPress(event);" maxlength="20" tabindex="2" required > 
                        </div>
                        <div class="form-group ">
                            <label for="apellidoyNombre">Apellido y Nombre:</label>
                            <input type="text" class="form-control" id="apellidoyNombre" placeholder="Ingrese el nombre y apellido" maxlength="100" tabindex="3" required>  
                        </div>
                        <div class="form-group ">
                            <label for="telefono">telefono:</label>
                            <input type="text" class="form-control" id="telefono" placeholder="Ingrese el telefono" maxlength="50" tabindex="3" required>  
                        </div>    
                        <div class="form-group ">
                            <label for="mail">E-mail:</label>
                            <input type="email" class="form-control" id="mail" placeholder="e-mail" maxlength="100" tabindex="4" required >
                        </div>    
                        <div class="form-group ">
                            <label for="pass">Password</label>
                            <input type="password" class="form-control" id="pass" placeholder="Password" tabindex="5" required >
                        </div>
                        <div class="form-group">
                            <div id="elSector" class="form-group">
                                <!-- lo llenamos por js-->    
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="domicilio">Domicilio</label>
                            <input type="text" class="form-control" id="domicilio" placeholder="domicilio" maxlength="100" tabindex="7" required >
                        </div>
                        <div id="laLocalidad" class="form-group">
                            <!-- lo llenamos por js-->    
                        </div>
                        <div id="laProvincia" class="form-group">
                            <!-- lo llenamos por js-->    
                        </div>
                    
                        <div class="form-group">
                            <label for="activo">Activo</label>
                            <select id="cmbActivo" tabindex="10" >
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>    
                        </div>
                        <div class="form-group">
                            <div id="elTipoSocio" class="form-group">
                                <!-- lo llenamos por js-->    
                            </div> 
                        </div>
                        <div class="form-group">
                            <label for="rol">ROL</label>
                            <select id="cmbRol" tabindex="12" >
                                <option value="0">Seleccione Rol</option>
                                <option value="1">Socio</option>
                                <option value="2">Administrador</option>
                                <option value="3">Super Admin</option>
                            </select>    
                        </div>
                        <div class="form-group">
                            <label for="pagaCuota">Paga Cuota</label>
                            <select id="cmbPagaCuota" tabindex="13" >
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>    
                        </div>
                    </div>
                    <!-- Modal FOOTER-->
                    <div class="modal-footer">
                        <button type="button" id="btnGuardar" class="btn btn-success" tabindex="13" >Guardar</button>
                        <button type="button" id="btnCerrarAbajo" class="btn btn-cancel close btn btn-warning" data-dismiss="modal" tabindex="14" >Cerrar</button>
                    </div>
                    <div id="error"></div>    
                </div>
            </div>
        </div>    
    </div>    
</div>
<!-- /////////////////////////////////////////////////////////////////////-->
    <!--------------------------------------------------------------------------------- -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="assets/js/jquery-3.2.1.min.js"></script>
  <!-- Bootstrap -->

<script src="paginas/js/usersabm.js"></script>



