window.addEventListener("load", function (event) {
	show_Orden();

});

function show_Orden() {

	var strUrl = "./drivercart/drivercart.php";
     let object = {
          'action' : 'SHOW_ORDEN'
     };
     fetch(strUrl, {
            method: 'POST',
            body: JSON.stringify(object)
        })
        .then(response => response.json())
        .then(function (data) {
             console.log(data);
             if (data.success) {
				 document.getElementById("finalizar_compra__finalizar").innerHTML  = data.tabla;
            };

        })
        .catch(function(err) {
            console.log(err);
        });
}