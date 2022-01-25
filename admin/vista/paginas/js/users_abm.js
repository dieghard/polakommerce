$(document).ready(function() {

    LLenarComboPerfiles(4);
    LlenarGrilla();

    $("#btnCerrar").on("click", function () { });
    $("#btnCerrarAbajo").on( "click", function() {});
    $("#botonOcultar" ).trigger( "click" );
    $('#mail').prop('disabled', false);
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


function LLenarComboPerfiles(tabIndex){
    var datos = new FormData();
    var strUrl="ajax/ajaxCombos.php";
    datos.append("tabIndex",tabIndex);
    datos.append("combo","Perfiles");

     $.ajax({
            url:strUrl,
                method:"POST",
                data:datos,
                cache:false,
                contentType:false,
                processData :false,
                success:function(respuesta){
                    console.log(respuesta);
                    var oRta = JSON.parse(respuesta);

                        if (oRta.success ==true ){
                            $('#divPerfil').html(oRta.combo);
                            $('#cmbPerfil').select2();
                        }else
                        {
                            $('#cartel').html(oRta.mensaje);
                        }

                }
        });
}


function AddKeyPress(e) {
        // look for window.event in case event isn't passed in
        e = e || window.event;
        if (e.keyCode == 13) {
            var error = '';
            var blnSeguir = true;
            var mail = $('#mail').val();
            if (mail.length<=0){
                error ='Debe escribir un mail';
                blnSeguir = false;
            }
            if (blnSeguir == false){
                alert (error);
                return false;
            }
            var datos = new FormData();
            var strUrl="ajax/UserA.php";
            datos.append("mail",mail);
            datos.append("ACTION",'buscarxMail');

            $.ajax({
                url:strUrl,
                method:"POST",
                data:datos,
                cache:false,
                contentType:false,
                processData :false,
                success:function(respuesta){
                    //console.log(respuesta);
                    var oRta = JSON.parse(respuesta);
                        if (oRta.success == true) {
                            if(oRta.encontrado== true){
                                alert ('Este Usuario ya se encuentra ingresado:'+ oRta.user.nombreyapellido );
                            }
                            else {
                                console.log(oRta);
                                $('#btnGuardar').prop('disabled', false);
                                $('#mail').prop('disabled', true);
                                $('#nombreyapellido').prop('disabled', false);
                                $('#pass').prop('disabled', false);
                                $('#cmbActivo').prop('disabled', false);
                                $('#cmbPerfil').prop('disabled', false);
                                $('#observaciones').prop('disabled', false);
                                $('#nombreyapellido').focus();
                            }
                        }
                        else{
                            $('#cartel').html(oRta.mensaje);
                        }

                }
        });
            return false;
        }
        return true;
}

function fnProcesaEditar(x){
    var id= $(x).closest('tr').data('id');
    var mail= $(x).closest('tr').data('mail');
    var nombreyapellido= $(x).closest('tr').data('nombreyapellido');
    var pass= $(x).closest('tr').data('pass');
    var perfilId= $(x).closest('tr').data('perfilid');
    var activo= $(x).closest('tr').data('activo');
    var observaciones = $(x).closest('tr').data('observaciones');

    console.log('nombreyapellido=' + nombreyapellido);

    $("#id").val(id);
    $("#mail").val(mail);
    $("#nombreyapellido").val(nombreyapellido);
    $("#pass").val(pass);
    $("#observaciones").val(observaciones);

    $('#mail').prop('disabled', true);

    $('#nombreyapellido').prop('disabled', false);
    $('#pass').prop('disabled', false);
    $('#cmbPerfil').prop('disabled', false);

    $('#domicilio').prop('disabled', false);
    $('#cmbActivo').prop('disabled', false);
    $('#cmbPerfil').prop('disabled', false);

    $('#cmbActivo').val(activo);
    $('#cmbActivo').trigger('change'); // Notify any JS components that the value changed

    $('#cmbPerfil').val(perfilId);
    $('#cmbPerfil').trigger('change'); // Notify any JS components that the value changed
    $("#modalUsers2").modal("show");


}

function LlenarGrilla(){
    nombre = $('#user').val();
    var strUrl="ajax/UserA.php";
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
    $('#nombreyapellido').val('');
    $('#mail').val('');
    $('#pass').val('');

    $('#cmbActivo').val('SI');

    $('#mail').prop('disabled', false);
    $('#nombreyapellido').prop('disabled', true);
    $('#pass').prop('disabled', true);
    $('#cmbActivo').prop('disabled', true);
    $("#cmbPerfil option[value=0]").attr("selected",true);
    $('#cmbPerfil').prop('disabled', true);
    $('#observaciones').prop('disabled', true);

    $("#modalUsers2").modal("show");

    $('#btnGuardar').prop('disabled', true);
}

function PasarDatosusuario() {

    var usuario ={
                    id: $('#id').val(),
                    mail : $('#mail').val(),
                    nombre : $('#nombreyapellido').val(),
                    pass: $('#pass').val(),
                    perfilID: $('#cmbPerfil').val(),
                    activo: $('#cmbActivo').val(),
                    observaciones: $('#observaciones').val(),
                    seguir: true,
                    mensaje: ''};
    return usuario;
}

function Validar(usuario){
        blnContinuar=true;

        if (usuario.nombre!= null && usuario.nombre.length <=0 ){
            usuario.mensaje = usuario.mensaje + 'Debe ingresar un apellido y nombre</br>';
            usuario.seguir = false;
            blnContinuar=false;
        }


        if ( usuario.mail!= null &&  usuario.mail.length<=0 ){
            usuario.mensaje = usuario.mensaje +  'Debe ingresar un mail</br>';
            usuario.seguir = false;
            blnContinuar=false;
        }
        if ( usuario.pass!= null  && usuario.pass.length<=0 ){
            usuario.mensaje = usuario.mensaje + 'Debe ingresar un pass</br>';
            usuario.seguir = false;
            blnContinuar=false;
        }
        if (  usuario.sectorID!= null && usuario.sectorID.length<=0 ){
            usuario.mensaje = usuario.mensaje + 'Debe ingresar un sector</br>';
            usuario.seguir = false;
            blnContinuar=false;
        }

    return usuario;
}

function Guardar_Datos(){

    var usuario = PasarDatosusuario();
    usuario = Validar(usuario);

    if (usuario.seguir==false){
        $('#error').html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Se econtraron errores!</strong></br>'+ usuario['mensaje']+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    return false;
    }

    var titulo ='Guardar el nuevo usuario '  + usuario.nombre;
    var content ='¿Guardar el nuevo usuario '  + usuario.nombre + ' ?';
    if (usuario.id >0){
        var titulo ='Guardar modificaciones  del usuario ' + usuario.nombre  ;
        var content ='¿Guardar modificaciones del usuario?' + usuario.nombre  ;
    }

        $.confirm({
                theme: 'Modern',
                title: titulo ,
                content: content,
                buttons: {
                    Confirmar: function() {
                        GuardarUsuario(usuario);
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

function GuardarUsuario(usuario){
        var ousuario = JSON.stringify(usuario);
        var datos = new FormData();
        datos.append("ACTION",'ingresousuario');
        datos.append("datosjson",ousuario);
        var strUrl = "ajax/UserA.php";

        $.ajax({
                url:strUrl,
                method:"POST",
                contentType: 'application/json; charset=utf-8',
                data: datos,
                cache:false,
                contentType:false,
                processData :false,
                success:function(respuesta){
                    //console.log(respuesta);
                        var oRta = JSON.parse(respuesta);
                            if (oRta.success==true){
                                $('#modalUsers2').modal('toggle');
                                LlenarGrilla();
                            }
                            else{
                                alert (oRta.mensaje);
                            }
                }
        });
}

function fnProcesaEliminar(x){
    var id= $(x).closest('tr').data('id');
    var usuario = { id: id };

    $.confirm({
                theme: 'Modern',
                title: 'ELIMINACIÓN usuario',
                content: '¿Desea eliminar el usuario?- Atención:si el usuario tiene movimientos no va a ser eliminado',
                buttons: {
                    Confirmar: function() {
                        Eliminarusuario(usuario);
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

function Eliminarusuario(usuario){
        var ousuario = JSON.stringify(usuario);
        var datos = new FormData();
        datos.append("ACTION",'eliminarusuario');
        datos.append("datosjson",ousuario);
        var strUrl="ajax/UserA.php";
        $.ajax({
                url:strUrl,
                method:"POST",
                contentType: 'application/json; charset=utf-8',
                data: datos,
                cache:false,
                contentType:false,
                processData :false,
            success: function (respuesta) {
                //console.log(respuesta);
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



