window.addEventListener("load", function (event) {
     ShowTotals();
});

function agregar(valor, action){

     var strUrl = "./drivercart/drivercart.php";
     let producto = {
          'id': valor,
          'cantidad': 1,
          'action' : action
     };

     fetch(strUrl, {
            method: 'POST',
            body: JSON.stringify(producto)
        })
        .then(response => response.json())
        .then(function(data) {
             console.log(data);
             if (data.success) {
                  document.getElementById("cantidadTotal").textContent = data.cantidadTotal;
                  document.getElementById("totalaPagar").textContent = '$' + data.TotalaPagar;

            };

        })
        .catch(function(err) {
            console.log(err);
        });
}

function ShowTotals() {

     var strUrl = "./drivercart/drivercart.php";
     let object = {
          'action' : 'SHOW_TOTALS'
     };

     fetch(strUrl, {
            method: 'POST',
            body: JSON.stringify(object)
        })
        .then(response => response.json())
        .then(function(data) {
             console.log(data);
             if (data.success) {
                  document.getElementById("cantidadTotal").textContent = data.cantidadTotal;
                  document.getElementById("totalaPagar").textContent = '$' + data.TotalaPagar;
            };
        })
        .catch(function(err) {
            console.log(err);
        });
}
function doesFileExist(urlToFile) {
    $.ajax({
               url: urlToFile,
               type: 'HEAD',
               error: function()
               {
                    //console.log('NO EXISTE');
                    return false;
               },
               success: function()
               {
                    //console.log('EXISTE');
                    return true;
               }
     });
}
function imageClick(imgenSeleccionada) {

     var image = document.getElementById('picturePrincipal');
     //var result = doesFileExist(imgenSeleccionada.src);

     image.style.height = '400px';
     image.style.width = '80px';
     image.src = imgenSeleccionada.src;



}
