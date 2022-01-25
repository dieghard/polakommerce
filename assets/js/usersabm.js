$(document).ready(function() {

    LlenarGrilla();

    $("#btnCerrar").on( "click", function() {});
    $("#btnCerrarAbajo").on( "click", function() {});
    $("#botonOcultar" ).trigger( "click" );
    $('#documento').prop('disabled', false);
    $("#btnGuardar").click(function() {
        Guardar_Datos();
    });
    ///BOTON NUEVO
    $("#btnNuevo").click(function() {
        Nuevo();
    });
    $('#modalUsers2').on('hidden.bs.modal', function (e) {
        LlenarGrilla();
    });
});

function AddKeyPress(e) {
        // look for window.event in case event isn't passed in
        e = e || window.event;
        if (e.keyCode == 13) {
            var error = '';
            var blnSeguir = true;
            var dni = $('#documento').val();
            dni = dni.replace('.','');
            dni = dni.replace('.','');
            if ( dni.length<=0){
                error ='Debe escribir un dni';
                blnSeguir = false;
            }
            if (blnSeguir == false){
                alert (error);
                return false;
            }
            var datos = new FormData();
            var strUrl="ajax/ajaxBuscarDni.php";
            datos.append("documento",dni);
            datos.append("ACTION",'buscarxDni');

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
                            if(oRta.encontrado==true){
                                alert ('Este socio ya se encuentra ingresado:'+ oRta['0'].nombreyapellido );
                            }
                            else{$('#btnGuardar').prop('disabled', false);

                                    $('#documento').prop('disabled', true);
                                    $('#nombreyapellido').prop('disabled', false);
                                    $('#mail').prop('disabled', false);
                                    $('#pass').prop('disabled', false);
                                    $('#cmbActivo').prop('disabled', false);
                                    $('#cmbPerfil').prop('disabled', false);
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
    var perfil= $(x).closest('tr').data('perfil');
    var activo= $(x).closest('tr').data('cmbActivo');
    var observaciones = $(x).closest('tr').data('observaciones');


    $("#id").val(id);
    $("#mail").val(mail);
    $("#nombreyapellido").val(nombreyapellido);
    $("#pass").val(pass);
    $("#cmbActivo").val(activo);
    $("#cmbPerfil").val(perfil);
    $("#observaciones").val(observaciones);

    $('#mail').prop('disabled', false);
    $('#nombreyapellido').prop('disabled', false);
    $('#pass').prop('disabled', false);
    $('#cmbActivo').prop('disabled', false);
    $('#cmbPerfil]').prop('disabled', false);
    $('#cmbActivo').prop('disabled', false);
    $('#observaciones').prop('disabled', false);

    /*COMBOS */

    $('#cmbActivo').val(activo);
    $('#cmbActivo').trigger('change'); // Notify any JS components that the value changed
    $('#cmbPerfil').val(perfil);
    $('#cmbPerfil').trigger('change'); // Notify any JS components that the value changed
    $("#modalUsers2").modal("show");


}

function LlenarGrilla(){
    nombre = $('#user').val();

    var strUrl="ajax/ajaxabmUsers.php";
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
                    var oRta  = JSON.parse(respuesta);
                    console.log(oRta);
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
    $('#mail').val('');
    $('#nombreyapellido').val('');
    $('#pass').val('');

    $("#cmbPerfil option[value=0]").attr("selected",true);
    $("#cmbActivo option[value=0]").attr("selected", true);


    $('#mail').prop('disabled', false);
    $('#nombreyapellido').prop('disabled', true);
    $('#pass').prop('disabled', true);
    $('#cmbPerfil').prop('disabled', true);
    $('#cmbActivo').prop('disabled', true);
    $("#modalUsers2").modal("show");
    $('#btnGuardar').prop('disabled', true);
}

function PasarDatosusuario(){
    var usuario ={    id: $('#id').val(),
                    mail : $('#mail').val(),
                    nombre : $('#nombreyapellido').val(),
                    pass: $('#pass').val(),
                    activo: $('#cmbActivo').val(),
                    perfilid:$('#perfilId').val(),
                    observaciones:$('#observaciones').val(),
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
        if (  usuario.perfilId!= null ){
            usuario.mensaje = usuario.mensaje + 'Debe ingresar un perfl</br>';
            usuario.seguir = false;
            blnContinuar=false;
        }
    return usuario;
}

function Guardar_Datos() {
        var usuario = PasarDatosusuario();
        usuario = Validar(usuario);

        if (usuario.seguir==false){
            $('#error').html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Se econtraron errores!</strong></br>'+ socio['mensaje']+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        return false;
        }
        var titulo ='Guardar el nuevo usuario '  + usuario.nombre;
        var content ='¿Guardar el nuevo usuario '  + usuario.nombre + ' ?';
        if (socio.id >0){
            var titulo ='Guardar modificaciones  del usuario ' + usuario.nombre  ;
            var content ='¿Guardar modificaciones del usuario?' + usuario.nombre  ;
        }
        $.confirm({
                theme: 'Modern',
                title: titulo ,
                content: content,
                buttons: {
                    Confirmar: function() {
                        Guardar(usuario);
                    },
                    Cancelar: {
                        action: function() {
                                return;
                        }
                    }
                }
            });


}

function Guardar(usuario){
    var oUsuario = JSON.stringify(usuario);
    var datos = new FormData();
    datos.append("ACTION",'ingresoUsuario');
    datos.append("datosjson",oSocio);
    var strUrl="ajax/ajaxabmUsers.php";
    $.ajax({
            url:strUrl,
            method:"POST",
            contentType: 'application/json; charset=utf-8',
            data: datos,
            cache:false,
            contentType:false,
            processData :false,
            success:function(respuesta){
                        var oRta  = JSON.parse(respuesta);
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
///Eliminar Socio
function fnProcesaEliminar(x){
    var id= $(x).closest('tr').data('id');
    ////CREO EL OBJETO
    var  socio ={id: id} ;



    $.confirm({
                theme: 'Modern',
                title: 'ELIMINACIÓN USUARIO',
                content: '¿Desea eliminar el socio?- Atención:si el socio tiene movimientos no va a ser eliminado',
                buttons: {
                    Confirmar: function() {
                        Eliminar(socio);
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
function Eliminar(usuario){
    ///SI PASA LO STRINGIFICO
        var oUsuario = JSON.stringify(usuario);
        var datos = new FormData();
        datos.append("ACTION",'eliminarSocio');
        datos.append("datosjson",oSocio);
        ////LO PASO CON FORM DATA
        var strUrl="ajax/UserA.php";
        $.ajax({
                url:strUrl,
                method:"POST",
                contentType: 'application/json; charset=utf-8',
                data: datos,
                cache:false,
                contentType:false,
                processData :false,
                success:function(respuesta){
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



