<div class="row">
    <div class="col-md-12">
        <div class ="row">
            <div class="box box-solid box-warning">
                <div class="box-header">
                    <!--<h4>INGRESO DE PAGOS DE RECIBOS </h4>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">-->
                            <button type="button" class="btn btn-warning" id="btnNuevo" title="haga un click aqui para ingresar recibos ">INGRESO DE PAGOS</button> 
                            <!--</div>-->
                    <!--</div>-->
                </div>
                <!--<div class="box-body"></div>-->
            </div>
            <div class="box box-solid box-primary">
                <div class="box-header">
                    <h4 class="box-title">FILTRO DE PAGOS REALIZADOS</h4>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div id="comboSocios"></div> <!-- Se llena mediante ajax --> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-sm-12">
                            <label for="mesDesdeFiltro">Periodo Desde:</label>  
                                <select id="mesDesdeFiltro" name ="mes">
                                    <option value="0">Seleccione</option>
                                    <option value="1">Enero</option>
                                    <option value="2">Febrero</option>
                                    <option value="3">Marzo</option>
                                    <option value="4">Abril</option>
                                    <option value="5">Mayo</option>
                                    <option value="6">Junio</option>
                                    <option value="7">Julio</option>
                                    <option value="8">Agosto</option>
                                    <option value="9">Septiembre</option>
                                    <option value="10">Octubre</option>
                                    <option value="11">Noviembre</option>
                                    <option value="12">Diciembre</option>
                                </select>
                        </div>
                        <div class="col-md-3 col-sm-12">
                                <label for="anioDesdeFiltro">Año Desde:</label>  
                                <input type="number" id="anioDesdeFiltro" min="2010" >
                        </div>
                        <div class="col-md-3 col-sm-12">
                                <label for="mesHastaFiltro">Periodo Hasta:</label>  
                                <select id="mesHastaFiltro" name ="mes">
                                        <option value="0">Seleccione</option>
                                        <option value="1">Enero</option>
                                        <option value="2">Febrero</option>
                                        <option value="3">Marzo</option>
                                        <option value="4">Abril</option>
                                        <option value="5">Mayo</option>
                                        <option value="6">Junio</option>
                                        <option value="7">Julio</option>
                                        <option value="8">Agosto</option>
                                        <option value="9">Septiembre</option>
                                        <option value="10">Octubre</option>
                                        <option value="11">Noviembre</option>
                                        <option value="12">Diciembre</option>
                                </select>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <label for="anioHastaFiltro">Año Hasta:</label>
                            <input type="number" id="anioHastaFiltro" min="2019" >
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary" id="btnbuscar" title="haga un click aqui para buscar recibos ">BUSQUEDA DE PAGOS</button> 
                </div>
                <div class="box-body">
                <div id="tabla"><!---se llena por j --></div>
                </div>
             <hr class="b-w-5 b-wisteria"><!---  DIBUJA UNA LINEA--->
            </div>
        </div>
    </div>
    
<!-- Modal -->
<div class="modal" id="modalEmisionRecibosAbm" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <!-- Modal HEADER-->
            <div class="modal-header">
                <h4 class="modal-title">INGRESO PAGO</h4>
                <button type="button" id="btnCerrar" class="btn btn-cancel close" data-dismiss="modal">&times;</button>
                <input type="hidden" id="id"  >
            </div>
            <!-- Modal BODY-->
            <div class="modal-body">
                <div class="form-group">
                    <div class="input-group">
                        <div class="col-xs-12 col-md-5">
                            <label for="fecha">Fecha:</label>
                            <input type="date" class="form-control" id="fecha" placeholder="Ingrese la fecha y presione enter"  onkeypress="return AddKeyPress(event);" maxlength="20" tabindex="1" required > 
                        </div>
                        <div class="col-xs-12 col-md-3">
                            <label for="periodoMes">Mes:</label>
                            <input type="number" class="form-control" id="periodoMes" placeholder="Ingrese el numero del mes" maxlength="100" tabindex="2" min="1" max="12" required>  
                        </div>
                        <div class="col-xs-12 col-md-4">
                            <label for="periodoAnio">año:</label>
                            <input type="number" class="form-control" id="periodoAnio" placeholder="Ingrese el numero del mes" maxlength="100" tabindex="3" min="2018" max="2050" required>  
                        </div>
                    </div>
                </div>
                <div class="form-group ">
                    <label for="socios">Socio:</label>
                        <div id="comboSociosabm">
                        </div> <!-- Se llena mediante ajax --> 
                </div>
                <div class="form-group ">
                    <label for="periodoMes">Nº Recibo:</label>
                    <input type="number" class="form-control" id="nRecibo" placeholder="Ingrese el numero del recibo" maxlength="100" tabindex="2" required>  
                </div>
                <div class="form-group ">
                    <label for="periodoMes">Monto$:</label>
                    <input type="number" class="form-control" id="montoPago" placeholder="Ingrese el monto" maxlength="100" tabindex="2" required>  
                </div>
                <div class="form-group">
                    <label for="observaciones">observaciones</label>
                    <input type="text" class="form-control" id="observaciones" placeholder="observaciones" maxlength="100" tabindex="6" required >
                </div>
        </div>
            <!-- Modal FOOTER-->
            <div class="modal-footer">
                <div id="error"></div>
                <button type="button" id="btnGuardar" class="btn btn-success" tabindex="7" >Guardar</button>
                <button type="button" id="btnCerrarAbajo" class="btn btn-cancel close btn btn-warning" data-dismiss="modal" tabindex="8">Cerrar</button>
            </div>
        
    </div>
</div>
<!-- /////////////////////////////////////////////////////////////////////-->
<script src="paginas/js/pagosRecibos.js"></script>
