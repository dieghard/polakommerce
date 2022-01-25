$(document).ready(function() {
    llenarData();
});

function llenarData(){

    var strUrl="ajax/ajaxPanel.php";
    var datos = new FormData();

    datos.append("ACTION","cantidadSocios");
    $('#sociosActivos').html('<div class="loading"><h7>Aguarde Un momento, por favor...</h7><img src="../../assets/img/save.gif"  width="50" height="50" alt="loading"/></div>');
    $('#sociosInactivos').html('<div class="loading"><h7>Aguarde Un momento, por favor...</h7><img src="../../assets/img/save.gif"  width="50" height="50" alt="loading"/></div>');
    $('#saldoSociosActivos').html('<div class="loading"><h7>Aguarde Un momento, por favor...</h7><img src="../../assets/img/save.gif"  width="50" height="50" alt="loading"/></div>');
    $.ajax({
            url:strUrl,
                method:"POST",
                data:datos,
                cache:false,
                contentType:false,
                processData :false,
                success:function(respuesta){
                        var oRta  = JSON.parse(respuesta);
                        if (oRta.success==true ){

                            $('#sociosActivos').html(oRta.cantidadUsuariosActivos);
                            $('#sociosInactivos').html(oRta.cantidadUsuariosInactivos);
                            $('#saldoSociosActivos').html('$ ' + oRta.saldo);
                        }
                }
        });
}