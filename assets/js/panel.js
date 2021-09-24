$(document).ready(function() {
    ///BOTON CERRAR
    llenarData();

});
function llenarData(){

    var strUrl="ajax/ajaxPanel.php";
    var datos = new FormData();

    datos.append("ACTION","cantidadSocios");
    $('#sociosActivos').html('<div class="loading"><h7>Aguarde Un momento, por favor...</h7><img src="../vista/images/save.gif"  width="50" height="50" alt="loading"/></div>'); 
    $('#sociosInactivos').html('<div class="loading"><h7>Aguarde Un momento, por favor...</h7><img src="../vista/images/save.gif"  width="50" height="50" alt="loading"/></div>'); 
    $('#saldoSociosActivos').html('<div class="loading"><h7>Aguarde Un momento, por favor...</h7><img src="../vista/images/save.gif"  width="50" height="50" alt="loading"/></div>'); 
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
                        if (oRta.success==true ){

                            $('#sociosActivos').html(oRta.cantidadUsuariosActivos);
                            $('#sociosInactivos').html(oRta.cantidadUsuariosInactivos);
                            $('#saldoSociosActivos').html('$ ' + oRta.saldo);

                            //TRADUCCION DE LA GRILLA DE MAESTRO SECTOR!!!
                        }
                }
        });
}