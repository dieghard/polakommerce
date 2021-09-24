$(document).ready(function() {
    ///BOTON CERRAR
    LlenarGrilla();
    $('#error').html('');
    $("#btnCerrar").on( "click", function() {});
    $("#btnCerrarAbajo").on( "click", function() {});
    $("#botonOcultar" ).trigger( "click" );
    
    $("#btnGuardar").click(function() {
        Guardar_Datos();
    });
    $("#btnNuevo").click(function() {
        sectorNuevo();
    });
    
   
    $('#modalCostoCuota').on('hidden.bs.modal', function (e) {
          LlenarGrilla();     
    });
    
    $("#descripcion").keypress(function(e) {
        //no recuerdo la fuente pero lo recomiendan para
        //mayor compatibilidad entre navegadores.
        var code = (e.keyCode ? e.keyCode : e.which);
        if(code==13){
            $("#btnGuardar").trigger("click");
        }
    });
   
        
/*
$('#modalUsers2')
   .on('hide', function() {
       console.log('hide');
   })
   .on('hidden', function(){
       console.log('hidden');
   })
   .on('show', function() {
       console.log('show');
   })
   .on('shown', function(){
      console.log('shown' );
   });
*/
   
       
});


function LlenarGrilla(){
   
       
    var strUrl="ajax/ajaxSector.php";
    
    var datos = new FormData();
    datos.append("ACTION","llenarGrilla");
    
    
    $('#tabla').html('<div class="loading"><h7>Aguarde Un momento, por favor...</h7><img src="../vista/images/save.gif"  width="50" height="50" alt="loading"/></div>'); 
    
    
    $('#idTablaUser').html('');
    
    $.ajax({
            url:strUrl,
                method:"POST",
                data:datos,
                cache:false,
                contentType:false,
                processData :false,
                success:function(respuesta){
                        console.log(respuesta);
                        var oRta  = JSON.parse(respuesta);
                        //console.log(oRta);
                        if (oRta.success ==true ){
                            $('#tabla').html(oRta.tabla);
                            //TRADUCCION DE LA GRILLA DE MAESTRO SECTOR!!!
                             
                            $('#idTablaUser').DataTable( {
                                dom: 'Bfrtip',
                                buttons: [{extend: 'excelHtml5'},],
                                "language": {
                                        "lengthMenu": "Mostrando _MENU_ registros por página",
                                        "zeroRecords": "Nada para Mostrar",
                                        "info": "Mostrando Pagina _PAGE_ de _PAGES_",
                                        "infoEmpty": "No hay registros disponibles",
                                        "search":"Buscar",
                                        "paginate": {
                                        "first":      "Primero",
                                        "last":       "Ultimo",
                                        "next":       "Siguiente",
                                        "previous":   "Anterior"
                                                    },
                                        "infoFiltered": "(Filtrado de _MAX_ total registros),"
                                    }
                                } );
                        }
                        else{
                            $('#error').html(oRta.mensaje);
                        } 
                }         
        });

}
function sectorNuevo(){
  
    $("#id").val('0');
    $('#descripcion').val('');
    $("#modalSector").modal("show");
        
}


function PasarDatosSector(){
    
    var id = $('#id').val();
    if (id==''){
        id =0;
    }
    var sector ={
                   
                    id : id,
                    descripcion : $('#descripcion').val(),
                    seguir: true,
                    mensaje: ''};
    return sector;
}
function Validar(sector){
        blnContinuar=true;
        
        if (sector.descripcion!= null && sector.descripcion.length <=0 ){
            costoCuota.mensaje = costoCuota.mensaje + 'Debe ingresar una descripción</br>';
            costoCuota.seguir = false;
            blnContinuar=false;   
        }
        
  
         
    return sector;
}
function Guardar_Datos(){
       ////CREO EL OBJETO
        var sector =PasarDatosSector();
        ///Valido los datos de la Localidad
        sector = Validar(sector);
    
        if (sector.seguir==false){
            $('#error').html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Se econtraron errores!</strong></br>'+ sector.mensaje +'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        return false;
        }   
        ///SI PASA LO STRINGIFICO
        
        var titulo ='¿Guardar datos? ';
        var content ='¿Guardar datos?';
        $.confirm({
                theme: 'Modern',
                title: titulo ,
                content: content,
                buttons: {
                    Confirmar: function() {
                        GuardarDatos(sector);
                    },
                    Cancelar: {
                        //text: 'Cancelar', // With spaces and symbols
                        action: function() {
                                return;
                        }
                    }
                }
            });
        
    
}
function GuardarDatos(sector){
        var oSector = JSON.stringify(sector);
        var datos = new FormData();
        $('#error').html('<div class="loading"><h7>Aguarde Un momento, por favor...</h7><img src="../vista/images/save.gif"  width="50" height="50" alt="loading"/></div>');     
        datos.append("ACTION",'ingresarActualizarSector');
        datos.append("datosjson",oSector);
        
    ////LO PASO CON FORM DATA    
        var strUrl="ajax/ajaxSector.php";
         $.ajax({
                url:strUrl,
                method:"POST",
                data:datos,
                cache:false,
                contentType:false,
                processData :false,
                success:function(respuesta){
                        var oRta  = JSON.parse(respuesta);
                        if (oRta.success ==true ){    
                            $('#modalSector').modal('toggle');    
                            LlenarGrilla();
                            $('#error').html('');
                        }else
                        {
                            $('#error').html(oRta.mensaje);
                        }                              
                      
                }         
        });
}
///Eliminar Sector
function fnProcesaEliminar(x){
    var id= $(x).closest('tr').data('id');
    //console.log('id:'+id);
    ////CREO EL OBJETO
    var  sector ={id: id} ;
    
    
    
    $.confirm({
                theme: 'Modern',
                title: 'ELIMINACIÓN',
                content: '¿Desea eliminar el item?',
                buttons: {
                    Confirmar: function() {
                        eliminarSector(sector);
                    },
                    Cancelar: {
                        //text: 'Cancelar', // With spaces and symbols
                        action: function() {
                                return;
                        }
                    }
                }
            });
        
}
function fnProcesaEditar(x){
    var id= $(x).closest('tr').data('id');
    var descripcion= $(x).closest('tr').data('descripcion');
    
    
    
    $("#id").val(id);
    $('#descripcion').val(descripcion);
    
    $("#modalSector").modal("show");
    
    
}
function eliminarSector(sector){
    ///SI PASA LO STRINGIFICO
        var oSector = JSON.stringify(sector);
        var datos = new FormData();
        datos.append("ACTION","eliminarSector");
        datos.append("datosjson",oSector);
        ////LO PASO CON FORM DATA    
        var strUrl="ajax/ajaxSector.php";
        $('#tabla').html('<div class="loading"><h7>Aguarde Un momento, por favor...</h7><img src="../vista/images/save.gif"  width="50" height="50" alt="loading"/></div>'); 
        $.ajax({
            url:strUrl,
            method:"POST",
            data:datos,
            cache:false,
            contentType:false,
            processData :false,
            success:function(respuesta){   
                console.log(respuesta);            
                var oRta  = JSON.parse(respuesta); 
                   
                if (oRta.success==false){
                
                    alert (oRta.mensaje);
                }
                LlenarGrilla();
            }  
        });

}
