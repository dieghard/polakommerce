function LLenarComboProvincias(tabIndex){
    var datos = new FormData();
    var strUrl="ajax/ajaxCombos.php";
    datos.append("tabIndex",tabIndex);
    datos.append("combo","provincias");

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
                            $('#laProvincia').html(oRta.combo);
                            $('#cmbProvincia').select2();
                        }else
                        {
                            $('#cartel').html(oRta.mensaje);
                        }

                }
        });
}
function llenarComboLocalidad(tabIndex){
    var datos = new FormData();
    var strUrl="ajax/ajaxCombos.php";
    datos.append("tabIndex",tabIndex);
    datos.append("combo","localidades");

     $.ajax({
            url:strUrl,
                method:"POST",
                data:datos,
                cache:false,
                contentType:false,
                processData :false,
                success:function(respuesta){
                        var oRta  = JSON.parse(respuesta);
                        //alert(respuesta);
                        if (oRta.success ==true ){
                            $('#laLocalidad').html(oRta.combo);
                            //$('#cmbLocalidad').select2();
                        }else
                        {
                            $('#cartel').html(oRta.mensaje);
                        }                              
                      
                }         
        });
     
}
function LLenarComboSector(tabIndex){
    var datos = new FormData();
    var strUrl="ajax/ajaxCombos.php";
    
    
    datos.append("tabIndex",tabIndex);
    datos.append("combo","sector");

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
                            $('#elSector').html(oRta.combo);
                            $('#cmbSector').select2();    
                        }else
                        {
                            $('#cartel').html(oRta.mensaje);
                        }                              
                      
                }         
        });
}
function LLenarComboTipoSocio(tabIndex){
    var datos = new FormData();
    var strUrl="ajax/ajaxCombos.php";
    datos.append("tabIndex",tabIndex);
    datos.append("combo","tipoSocio");

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
                            $('#elTipoSocio').html(oRta.combo);
                            $('#cmbTipoSocio').select2();    
                        }else
                        {
                            $('#cartel').html(oRta.mensaje);
                        }                              
                      
                }         
        });
}
function LLenarComboSocios(tabIndex){
    var datos = new FormData();
    var strUrl="ajax/ajaxCombos.php";
    datos.append("tabIndex",tabIndex);
    datos.append("combo","Socios");

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
                            $('#comboSocios').html(oRta.combo);
                            $('#cmbSocio').select2();    
                        }else
                        {
                            $('#cartel').html(oRta.mensaje);
                        }

                }
        });
}


