$(document).ready(function() {

    LlenarGrilla();

    $("#btnCerrar").on("click", function () { });
    $("#btnCerrarAbajo").on( "click", function() {});
    $("#botonOcultar" ).trigger( "click" );
    $('#titulo').prop('disabled', false);
    $("#btnGuardar").click(function() {
        Guardar_Datos();
    });
    $("#btnNuevo").click(function() {
        Nuevo();
    });
    $('#modalUsers2').on('hidden.bs.modal', function (e) {
        LlenarGrilla();
    });


});


function fnProcesaEditar(x){
    var id   = $(x).closest('tr').data('id');
    var titulo = $(x).closest('tr').data('titulo');
    var subtitulo = $(x).closest('tr').data('subtitulo');
    var descripcion = $(x).closest('tr').data('descripcion');
    var imagen   = $(x).closest('tr').data('imagen');
    var activo = $(x).closest('tr').data('activo');

    $("#id").val(id);
    $("#titulo").val(titulo);
    $("#subtitulo").val(subtitulo);
    $("#activo").val(activo);

    $('#titulo').prop('disabled', true);

    $('#subtitulo').prop('disabled', false);
    $('#pass').prop('disabled', false);

    $('#imagen').val(imagen);
    $('#imagen').trigger('change'); // Notify any JS components that the value changed

    $('#btnGuardar').prop('disabled', false);
    $("#modalUsers2").modal("show");


}

function LlenarGrilla(){

   var strUrl = "ajax/ajaxRubros.php";
   var datos = new FormData();

   datos.append("ACTION", "llenarGrilla");

    $('#tabla').html('<div class="loading"><h7>Aguarde Un momento, por favor...</h7><img src="../../assets/img/save.gif"  width="50" height="50" alt="loading"/></div>');
    $('#idTablaUser').html('');
    $.ajax({
            url:strUrl,
                method:"POST",
                data:datos,
                cache:false,
                contentType:false,
                processData :false,
                success: function (respuesta) {

                    var oRta = JSON.parse(respuesta);
                        if (oRta.success ==true ){
                            $('#tabla').html(oRta.tabla);
                            $('#idTablaUser').DataTable( {
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
                            $('#cartel').html(oRta.mensaje);
                        }
                }
        });

}

function Nuevo(){

    $("#id").val('0');
    $('#subtitulo').val('');
    $('#titulo').val('');
    $('#pass').val('');

    $('#imagen').val(-1);

    $('#titulo').prop('disabled', false);
    $('#subtitulo').prop('disabled', true);
    $('#pass').prop('disabled', true);
    $('#imagen').prop('disabled', true);
    $('#activo').prop('disabled', true);
    $("#modalUsers2").modal("show");
    $('#btnGuardar').prop('disabled', true);
}

function PasarDatos() {

    var data ={ id: $('#id').val(),
                   titulo : $('#titulo').val(),
                   subtitulo : $('#subtitulo').val(),
                   descripcion: $('#Perfil').val(),
                   imagen: $('#imagen').val(),
                   activo: $('#activo').val(),
                   seguir: true,
                   mensaje: ''};

    return data;
}

function Validar(data){
        blnContinuar=true;

        if (data.titulo != null && data.titulo.length <=0 ){
            usuario.mensaje = usuario.mensaje + 'Debe ingresar un titulo</br>';
            usuario.seguir = false;
            blnContinuar=false;
        }


        if ( data.subtitulo != null &&  data.subtitulo.length<=0 ){
            data.mensaje = data.mensaje +  'Debe ingresar un subtitulo</br>';
            data.seguir = false;
            blnContinuar=false;
        }


    return data;
}

function Guardar_Datos(){

    var data = PasarDatos();
    data = validar(data);
    console.log(data);

    if (data.seguir == false) {
        let mensaje = '<div class="alert alert-warning"><strong>' + data.mensaje + '</strong></div>';
    return false;
    }

    var titulo ='Guardar el nuevo Rubro '  + data.titulo;
    var content ='¿Guardar el nuevo Rubro '  + data.titulo + ' ?';
    if (usuario.id >0){
        var titulo ='Guardar modificaciones  del Rubro ' + data.titulo  ;
        var content ='¿Guardar modificaciones del usuario?' + data.titulo  ;
    }

        $.confirm({
                theme: 'Modern',
                title: titulo ,
                content: content,
                buttons: {
                    Confirmar: function() {
                        Guardar(data);
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

function Guardar(data){
        var oData = JSON.stringify(data);
        var datos = new FormData();
        datos.append("ACTION",'guardar');
        datos.append("datosjson",oData);
        var strUrl = "Ajax/Rubros.php";

        $.ajax({
                url:strUrl,
                method:"POST",
                contentType: 'application/json; charset=utf-8',
                data: datos,
                cache:false,
                contentType:false,
                processData :false,
                success:function(respuesta){

                        var oRta = JSON.parse(respuesta);
                            if (oRta.success==true){
                                $('#modalUsers2').modal('toggle');
                                LlenarGrilla();
                            }
                            else{
                                console.log(oRta);
                                alert(oRta.mensaje);
                            }
                }
        });
}

function fnProcesaEliminar(x){
    var id= $(x).closest('tr').data('id');
    var data = { id: id };

    $.confirm({
                theme: 'Modern',
                title: 'ELIMINACIÓN Rubro',
                content: '¿Desea eliminar el rubro?',
                buttons: {
                    Confirmar: function() {
                        Eliminar(data);
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

function Eliminar(data){
        var oData = JSON.stringify(data);
        var datos = new FormData();
        datos.append("ACTION",'eliminar');
        datos.append("datosjson",oData);
        var strUrl="Ajax/Rubros.php";
        $.ajax({
                url:strUrl,
                method:"POST",
                contentType: 'application/json; charset=utf-8',
                data: datos,
                cache:false,
                contentType:false,
                processData :false,
            success: function (respuesta) {
                            var oRta  = JSON.parse(respuesta);
                            if (oRta.success==true){
                                LlenarGrilla();
                            }
                            else{
                                alert (oRta.mensaje);
                            }
                }
        });

}



