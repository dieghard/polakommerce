$(document).ready(function() {
    ///BOTON CERRAR
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
        SocioNuevo();
    });
    $('#modalUsers2').on('hidden.bs.modal', function (e) {
          LlenarGrilla();     
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
   
   /* //////////////////////////////////////////////////////////////////////////////// */
    $.getScript("paginas/js/combos.js", function( data, textStatus, $xhr){
            LLenarComboSector(5); 
            llenarComboLocalidad(7); 
            LLenarComboProvincias(8);
            LLenarComboTipoSocio(10);   
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
           //alert ('DNI:'+dni ) ;
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
                                alert ('Este socio ya se encuentra ingresado:'+ oRta['0'].apellidoyNombre );
                            }
                            else{$('#btnGuardar').prop('disabled', false);   
                                    
                                    $('#documento').prop('disabled', true);
                                    $('#apellidoyNombre').prop('disabled', false);
                                    $('#telefono').prop('disabled', false);
                                    $('#numeroSocio').prop('disabled', false); 
                                    $('#mail').prop('disabled', false);
                                    $('#pass').prop('disabled', false);
                                    $('#cmbSector').prop('disabled', false);
                                    $('#domicilio').prop('disabled', false);
                                    $('#cmbLocalidad').prop('disabled', false);
                                    $('#cmbProvincia').prop('disabled', false);
                                    $('#cmbActivo').prop('disabled', false);
                                    $('#cmbTipoSocio').prop('disabled', false);
                                    $('#cmbRol').prop('disabled', false);
                                    $('#cmbPagaCuota').prop('disabled', false);
                                    $('#apellidoyNombre').focus();
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
    var bibliotecaid= $(x).closest('tr').data('bibliotecaid');
    var blibioteca= $(x).closest('tr').data('blibioteca');
    var numeroSocio= $(x).closest('tr').data('numerosocio');
    console.log('numeroSocio:'+numeroSocio);
    var apellidoyNombre= $(x).closest('tr').data('apellidoynombre');
    var telefono= $(x).closest('tr').data('telefono');
    var mail= $(x).closest('tr').data('mail');
    var pass= $(x).closest('tr').data('pass');
    var sectorid= $(x).closest('tr').data('sectorid');
    var sector= $(x).closest('tr').data('sector');
    var domicilio= $(x).closest('tr').data('domicilio');
    var localidad= $(x).closest('tr').data('localidad');
    var provincia= $(x).closest('tr').data('provincia');
    var localidadid= $(x).closest('tr').data('localidadid');
    var provinciaid= $(x).closest('tr').data('provinciaid');
    var documento= $(x).closest('tr').data('documento');
    var individualgrupal= $(x).closest('tr').data('individualgrupal');
    var activo= $(x).closest('tr').data('activo');
    var tipoSocioId= $(x).closest('tr').data('tiposocioid');
    var tipoSocio= $(x).closest('tr').data('tiposocio');
    var rol= $(x).closest('tr').data('rol');
    var pagaCuota= $(x).closest('tr').data('pagacuota');
    var valorCuota= $(x).closest('tr').data('valorcuota');
   
    
   // alert ('rol:'+rol);
    
   
    $("#id").val(id);
    $('#documento').val(documento);
    
    $("#apellidoyNombre").val(apellidoyNombre);
    $("#telefono").val(telefono);
    
    $("#mail").val(mail);
    $("#pass").val(pass);
    $("#domicilio").val(domicilio);
    $("#documento").val(documento);
    $("#numeroSocio").val(numeroSocio);
    
    $('#documento').prop('disabled', true);
    $('#apellidoyNombre').prop('disabled', false);
    $('#numeroSocio').prop('disabled', false);
    $('#mail').prop('disabled', false);
    $('#pass').prop('disabled', false);
    $('#cmbSector').prop('disabled', false);
    
    $('#domicilio').prop('disabled', false);
    $('#cmbLocalidad').prop('disabled', false);
    $('#cmbProvincia').prop('disabled', false);
    $('#cmbActivo').prop('disabled', false);
    $('#cmbTipoSocio').prop('disabled', false);
    $('#cmbRol').prop('disabled', false);
    $('#cmbPagaCuota').prop('disabled', false);
    
    /*COMBOS */
       
        $('#cmbActivo').val(activo); 
        $('#cmbActivo').trigger('change'); // Notify any JS components that the value changed
    
        
        $('#cmbPagaCuota').val(pagaCuota); 
        $('#cmbPagaCuota').trigger('change'); // Notify any JS components that the value changed
        
        $('#cmbLocalidad').val(localidadid); 
        $('#cmbLocalidad').trigger('change'); // Notify any JS components that the value changed
    
        $('#cmbProvincia').val(provinciaid); 
        $('#cmbProvincia').trigger('change'); // Notify any JS components that the value changed

        $('#cmbSector').val(sectorid); 
        $('#cmbSector').trigger('change'); // Notify any JS components that the value changed
    
        $('#cmbTipoSocio').val(tipoSocioId); 
        $('#cmbTipoSocio').trigger('change'); // Notify any JS components that the value changed
        
        $('#cmbRol').val(rol); 
        $('#cmbRol').trigger('change'); // Notify any JS components that the value changed

        $("#modalUsers2").modal("show");
    
    
}
function LlenarGrilla(){
    nombre = $('#user').val();
   
    var strUrl="ajax/ajaxabmUsers.php";
    var datos = new FormData();
    datos.append("bibliotecaID","llenarGrilla");
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
                   
                        var oRta  = JSON.parse(respuesta);
                        console.log(oRta);
                        if (oRta.success ==true ){
                            $('#tabla').html(oRta.tabla);
                            //TRADUCCION DE LA GRILLA DE MAESTRO SECTOR!!!
                             
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
function SocioNuevo(){
    
    $("#id").val('0');
    $('#documento').val('');
    $('#numeroSocio').val('');
    $('#apellidoyNombre').val('');
    $('#telefono').val('');
    $('#mail').val('');
    $('#pass').val('');
    $('#cmbSector').val('Seleccione');
    $("#cmbSector option[value=0]").attr("selected",true);
    $('#domicilio').val('');
    $("#cmbLocalidad option[value=0]").attr("selected",true);
    $("#cmbProvincia option[value=0]").attr("selected",true);

    $('#cmbActivo').val('SI');
    $("#cmbTipoSocio option[value=0]").attr("selected",true);
    $("#cmbRol option[value=0]").attr("selected",true);
    $('#cmbPagaCuota').val('SI'),
    $('#documento').prop('disabled', false);
    $('#numeroSocio').prop('disabled', true);
    $('#apellidoyNombre').prop('disabled', true);
    $('#telefono').prop('disabled', true);
    $('#mail').prop('disabled', true);
    $('#pass').prop('disabled', true);
    $('#cmbSector').prop('disabled', true);
    $('#domicilio').prop('disabled', true);
    $('#cmbLocalidad').prop('disabled', true);
    $('#cmbProvincia').prop('disabled', true);
    $('#cmbActivo').prop('disabled', true);
    $('#cmbTipoSocio').prop('disabled', true);
    $('#cmbRol').prop('disabled', true);
    $('#cmbPagaCuota').prop('disabled', true);

    $("#modalUsers2").modal("show");

    $('#btnGuardar').prop('disabled', true);   
} 

function PasarDatosSocio(){
    var socio ={
                    id: $('#id').val(),
                    documento : $('#documento').val(),
                    numeroSocio: $('#numeroSocio').val(),
                    nombre : $('#apellidoyNombre').val(),
                    telefono:$('#telefono').val(),
                    mail : $('#mail').val(),
                    pass: $('#pass').val(),
                    sectorID: $('#cmbSector').val(),
                    domicilio: $('#domicilio').val(),
                    localidadID: $('#cmbLocalidad').val(),
                    provinciaID: $('#cmbProvincia').val(),
                    activo: $('#cmbActivo').val(),
                    tipoSocioID:$('#cmbTipoSocio').val(),
                    rolID:$('#cmbRol').val(),
                    pagaCuota:$('#cmbPagaCuota').val(),
                    seguir: true,
                    mensaje: ''};
    return socio;
}
function Validar(socio){
        blnContinuar=true;
        
        if (socio.nombre!= null && socio.nombre.length <=0 ){
            socio.mensaje = socio.mensaje + 'Debe ingresar un apellido y nombre</br>';
            socio.seguir = false;
            blnContinuar=false;   
        }
        

        if ( socio.mail!= null &&  socio.mail.length<=0 ){
            socio.mensaje = socio.mensaje +  'Debe ingresar un mail</br>';
            socio.seguir = false;
            blnContinuar=false;   
        }
        if ( socio.pass!= null  && socio.pass.length<=0 ){
            socio.mensaje = socio.mensaje + 'Debe ingresar un pass</br>';
            socio.seguir = false;
            blnContinuar=false;   
        }
        if (  socio.sectorID!= null && socio.sectorID.length<=0 ){
            socio.mensaje = socio.mensaje + 'Debe ingresar un sector</br>';
            socio.seguir = false;
            blnContinuar=false;   
        }
        if (   socio.domicilio!= null &&  socio.domicilio.length<=0 ){
            socio.mensaje = socio.mensaje + 'Debe ingresar un domicilio</br>';
            socio.seguir = false;
            blnContinuar=false;   
        }
        if ( socio.localidadID!= null &&  socio.localidadID.length<=0 ){
            socio.mensaje = socio.mensaje + 'Debe ingresar una localidad</br>';
            socio.seguir = false;
            blnContinuar=false;   
        }
        if (socio.provinciaID!= null &&  socio.provinciaID.length<=0 ){
            socio.mensaje = socio.mensaje + 'Debe ingresar una provincia</br>';
            socio.seguir = false;
            blnContinuar=false;   
        }
        if (socio.tipoSocioID!= null &&   socio.tipoSocioID.length<=0 ){
            socio.mensaje = socio.mensaje +  'Debe ingresar un tipo de socio</br>';
            socio.seguir = false;
            blnContinuar=false;   
        }
        if ( socio.pagaCuota!= null &&   socio.pagaCuota.length<=0 ){
            socio.mensaje = socio.mensaje + 'Debe seleccionar si paga cuota</br>';
            socio.seguir = false;
            blnContinuar=false;   
        }
         
        
    return socio;
}
function Guardar_Datos(){
       ////CREO EL OBJETO
        var socio =PasarDatosSocio();
        ///Valido los datos del socio
        socio = Validar(socio);
    
        if (socio.seguir==false){
            $('#error').html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Se econtraron errores!</strong></br>'+ socio['mensaje']+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        return false;
        }   
        ///SI PASA LO STRINGIFICO
        var titulo ='Guardar el nuevo socio '  + socio.nombre;
        var content ='¿Guardar el nuevo socio '  + socio.nombre + ' ?';
        if (socio.id >0){
            var titulo ='Guardar modificaciones  del socio ' + socio.nombre  ;
            var content ='¿Guardar modificaciones del socio?' + socio.nombre  ;
        }
    
        $.confirm({
                theme: 'Modern',
                title: titulo ,
                content: content,
                buttons: {
                    Confirmar: function() {
                        GuardarSocio(socio);
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
function GuardarSocio(socio){
        var oSocio = JSON.stringify(socio);
        var datos = new FormData();
        datos.append("ACTION",'ingresoSocio');
        datos.append("datosjson",oSocio);
        ////LO PASO CON FORM DATA    
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
                title: 'ELIMINACIÓN SOCIO',
                content: '¿Desea eliminar el socio?- Atención:si el socio tiene movimientos no va a ser eliminado',
                buttons: {
                    Confirmar: function() {
                        EliminarSocio(socio);
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
function EliminarSocio(socio){
    ///SI PASA LO STRINGIFICO
        var oSocio = JSON.stringify(socio);
        var datos = new FormData();
        datos.append("ACTION",'eliminarSocio');
        datos.append("datosjson",oSocio);
        ////LO PASO CON FORM DATA    
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
                                
                                LlenarGrilla();                    
                            }
                            else{
                                alert (oRta.mensaje);
                            }
                }  
        });

}

   

