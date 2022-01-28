 <div class="modal-header">
    <h4 class="modal-title">RUBRO</h4>
    <input type="hidden" id="id">
    <button type="button" id="btnCerrar" class="btn btn-cancel close" data-dismiss="modal">&times;</button>

 </div>
 <!-- Modal BODY-->
 <div class="modal-body">
    <div class="form-group">
       <label for="titulo">Titulo</label>
       <input type="text" class="form-control" id="titulo" placeholder="Ingrese el titulo" maxlength="255" tabindex="1" required>
    </div>
    <div class="form-group">
       <label for="subtitulo">Subtitulo</label>
       <input type="text" class="form-control" id="subtitulo" placeholder="Ingrese el Subtitulo" maxlength="255" tabindex="2" required>
    </div>
    <div class="form-group">
       <label for="descripcion">Descripcion</label>
       <input type="text" class="form-control" id="descripcion" placeholder="Ingrese la descripción" maxlength="255" tabindex="3" required>
    </div>
    <div class="form-group">
       <form method="post" action="#" enctype="multipart/form-data">
          <div class="card" style="width: 18rem;">
             <img class="card-img-top" src="../../assets/img/rubros/default.png">
             <div class="card-body">
                <!--<h5 class="card-title">Sube una foto</h5>
                <p class="card-text">Sube una imagen...</p>-->
                <div class="form-group">
                   <label for="image">Subir imagen</label>
                   <input type="file" class="form-control-file" name="image" id="image">
                </div>
                <input type="button" id='btnUpload' class="btn btn-primary upload" value="Subir">
             </div>
          </div>
       </form>
    </div>
    <div class="form-group">
       <label for="activo">Activo</label>
       <select id="cmbActivo" tabindex="4">
          <option value="-1">SI</option>
          <option value="0">NO</option>
       </select>
    </div>
    <div id="error_abm"></div>