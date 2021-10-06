window.onload = function() {
  init();

};

function init(){
  //  document.getElementById("btn-login").addEventListener("click", login);
}

$(document).ready(function() {
   /* ACA VEMOS SI ENTRAMOS O NO AL PANEL DE CONTROL!!!!!!*/
   $("#btn-login").click(function() {
    var usuario = $("#inputEmail").val();
    var password = $("#inputPassword").val();

    var continuar = true;
    if (usuario.length <=0){
        $("#divUsuario").fadeToggle(2000);
        $("#divUsuario").text('Debe ingresar un usuario') ;
        $("#divUsuario").css("color", "red");
        continuar=false;
        return false;
    }

    if (password.length <=0){
        $("#divUsuario").fadeToggle(2000);
        $("#divUsuario").text('Debe ingresar una contraseña') ;
        $("#divUsuario").css("color", "red");
        continuar=false;
        return false;
    }


    if (continuar == true){
        var datos = new FormData();
        console.log(usuario);
        console.log(password);

        datos.append("usuario", usuario);
        datos.append("password",password);
        datos.append("tipoVerificacion","ingreso");

        console.log(JSON.stringify(datos));
        JSON.stringify({usuario: usuario})

        strUrl = "../admin/Vista/ajax/ajaxLoguin.php";

        fetch(strUrl, {
            method: 'POST',
            body: JSON.stringify({ "user": {
                "tipoVerificacion" : "ingreso" ,
                "email": usuario,
                "password" : password
                }}),
        })
        .then(response => response.json())
        .then(function(data) {
            console.log(data);
            if(data.success == true) {
                console.log(data.path);
                window.location.href =   data.path;
            }
            else {
                    $("#divUsuario").fadeToggle(2000);
                    $("#divUsuario").text(data.mensaje) ;
                    $("#divUsuario").css("color", "red");
            }

        })
        .catch(function(err) {
            console.log(err);
        });
    }
  });



});

function onSignIn(googleUser) {
    var profile = googleUser.getBasicProfile();
    console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
    console.log('Name: ' + profile.getName());
    console.log('Image URL: ' + profile.getImageUrl());
    console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
  }