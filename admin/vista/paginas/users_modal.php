 <div class="modal-header">
     <h4 class="modal-title">USUARIO</h4>
     <button type="button" id="btnCerrar" class="btn btn-cancel close" data-dismiss="modal">&times;</button>
     <input type="hidden" id="id">
 </div>
 <!-- Modal BODY-->
 <div class="modal-body">
     <div class="form-group">
         <label for="mail">Mail</label>
         <input type="email" class="form-control" id="mail" placeholder="Ingrese el documento y presione enter" onkeypress="return AddKeyPress(event);" maxlength="20" tabindex="1" required>
     </div>
     <div class="form-group ">
         <label for="nombreyapellido">Apellido y Nombre:</label>
         <input type="text" class="form-control" id="nombreyapellido" placeholder="Ingrese el nombre y apellido" maxlength="100" tabindex="2" required>
     </div>
     <div class="form-group ">
         <label for="pass">Password</label>
         <input type="password" class="form-control" id="pass" placeholder="Password" tabindex="3" required>
     </div>
     <div class="form-group">
         <label for="activo">Activo</label>
         <select id="cmbActivo" tabindex="10">
             <option value="-1">SI</option>
             <option value="0">NO</option>
         </select>
     </div>
     <div class="form-group">
         <div id="divPerfil" class="form-group">
         </div>
     </div>
     <div class="form-group">
         <label for="domicilio">Observaciones</label>
         <input type="text" class="form-control" id="observaciones" placeholder="Observaciones" maxlength="255" tabindex="5">
     </div>