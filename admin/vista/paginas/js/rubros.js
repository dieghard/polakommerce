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
        ProvinciaNuevo();
    });


    $('#modalProvincia').on('hidden.bs.modal', function (e) {
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





});


function LlenarGrilla(){


    var strUrl="ajax/ajaxAbmRubros.php";

    var datos = new FormData();
    datos.append("ACTION","llenarGrilla");


    $('#tabla').html('<div class="loading"><h7>Aguarde Un momento, por favor...</h7><img src="../../assets/img/save.gif"  width="50" height="50" alt="loading"/></div>');


    $('#idTablaUser').html('');

    $.ajax({
            url:strUrl,
                method:"POST",
                data:datos,
                cache:false,
                contentType:false,
                processData :false,
                success:function(respuesta){
                        //console.log(respuesta);
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
function ProvinciaNuevo(){

    $("#id").val('0');
    $('#descripcion').val('');

    $("#modalProvincia").modal("show");

}
$(document).on('show.bs.modal', '.modal', centerModal);
function centerModal() {
    $('#error').html('');
    $(this).css('display', 'block');
    var $dialog  = $(this).find(".modal-dialog"),
    offset       = ($(window).height() - $dialog.height()) / 2,
    bottomMargin = parseInt($dialog.css('marginBottom'), 10);

    // Make sure you don't hide the top part of the modal w/ a negative margin if it's longer than the screen height, and keep the margin equal to the bottom margin of the modal
    if(offset < bottomMargin) offset = bottomMargin;
    $dialog.css("margin-top", offset +100);
}

function PasarDatosProvincia(){

    var id = $('#id').val();
    if (id==''){
        id =0;
    }
    var provincia ={

                    id : id,
                    descripcion : $('#descripcion').val(),
                    seguir: true,
                    mensaje: ''};
    return provincia;
}
function Validar(provincia){
        blnContinuar=true;

        if (provincia.descripcion!= null && provincia.descripcion.length <=0 ){
            provincia.mensaje = provincia.mensaje + 'Debe ingresar una descripción</br>';
            provincia.seguir = false;
            blnContinuar=false;
        }



    return provincia;
}
function Guardar_Datos(){
       ////CREO EL OBJETO
        var provincia =PasarDatosProvincia();
        ///Valido los datos de la provincia
        provincia = Validar(provincia);

        if (provincia.seguir==false){
            $('#error').html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Se econtraron errores!</strong></br>'+ provincia.mensaje +'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
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
                        GuardarDatos(provincia);
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
function GuardarDatos(provincia){
        var oProvincia = JSON.stringify(provincia);
        var datos = new FormData();
        $('#error').html('<div class="loading"><h7>Aguarde Un momento, por favor...</h7><img src="../../assets/img/save.gif"  width="50" height="50" alt="loading"/></div>');
        datos.append("ACTION",'ingresarActualizarProvincia');
        datos.append("datosjson",oProvincia );
        console.log(oProvincia);
    ////LO PASO CON FORM DATA
        var strUrl="ajax/ajaxAbmProvincias.php";
         $.ajax({
                url:strUrl,
                method:"POST",
                data:datos,
                cache:false,
                contentType:false,
                processData :false,
                success:function(respuesta){
                      //console.log(respuesta);
                        var oRta  = JSON.parse(respuesta);
                        if (oRta.success ==true ){
                            $('#modalProvincia').modal('toggle');
                            LlenarGrilla();
                            $('#error').html('');
                        }else
                        {
                            $('#error').html(oRta.mensaje);
                        }

                }
        });
}
///Eliminar Socio
function fnProcesaEliminar(x){
    var id= $(x).closest('tr').data('id');
    //console.log('id:'+id);
    ////CREO EL OBJETO
    var  provincia ={id: id} ;



    $.confirm({
                theme: 'Modern',
                title: 'ELIMINACIÓN',
                content: '¿Desea eliminar el item?',
                buttons: {
                    Confirmar: function() {
                        eliminarProvincia(provincia);
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
    $("#modalProvincia").modal("show");


}
function eliminarProvincia(provincia){
    ///SI PASA LO STRINGIFICO
        var oProvincia = JSON.stringify(provincia);
        var datos = new FormData();
        datos.append("ACTION","eliminarProvincia");
        datos.append("datosjson",oProvincia);
        ////LO PASO CON FORM DATA
        var strUrl="ajax/ajaxAbmProvincias.php";
        $('#tabla').html('<div class="loading"><h7>Aguarde Un momento, por favor...</h7><img src="../../assets/img/save.gif"  width="50" height="50" alt="loading"/></div>');
        $.ajax({
            url:strUrl,
            method:"POST",
            data:datos,
            cache:false,
            contentType:false,
            processData :false,
            success:function(respuesta){
                var oRta  = JSON.parse(respuesta);
                if (oRta.success==false){
                    alert (oRta.mensaje);
                }
                LlenarGrilla();
            }
        });

}
