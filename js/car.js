window.addEventListener("load", function(event) {
    show_cart();

});

function pagar() {
    // cancels the form submission
    event.preventDefault();
    console.log('ESTOY PAGANDO');

    var strUrl = "./finalizar_compra.php";

    let object = {
        'nombre': document.getElementById("nombre").value,
        'apellido': document.getElementById("apellido").value,
        'pais': document.getElementById("pais").value,
        'pais': document.getElementById("pais").value,
        'direccion': document.getElementById("direccion").value,

    };

    fetch(strUrl, {
            method: 'POST',
            body: JSON.stringify(object)
        })
        .then(response => response.json())
        .then(function(data) {
            console.log(data);
            if (data.success) {
                document.getElementById("tabla").innerHTML = data.tabla;
            };

        })
        .catch(function(err) {
            console.log(err);
        });

};

function show_cart() {

    var strUrl = "./drivercart/drivercart.php";
    let object = {
        'action': 'SHOW_CART'
    };

    fetch(strUrl, {
            method: 'POST',
            body: JSON.stringify(object)
        })
        .then(response => response.json())
        .then(function(data) {
            console.log(data);
            if (data.success) {
                document.getElementById("tabla").innerHTML = data.tabla;
            };

        })
        .catch(function(err) {
            console.log(err);
        });
}