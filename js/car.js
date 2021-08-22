window.addEventListener("load", function (event) {
	show_cart();

});

function show_cart() {

	var strUrl = "./drivercart/drivercart.php";
     let object = {
          'action' : 'SHOW_CART'
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