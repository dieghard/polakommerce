<!DOCTYPE html>
<html>

<head>
  <link rel='shortcut icon' type='image/png' href='../favicon.ico' />
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Administción - POLAKOMMERCE</title>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../assets/vendor/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="../assets/css/animate.css">
  <link rel="stylesheet" href="../assets/css/loguin.css">

</head>

<body>
  <div class="container">

    <!---div class="app"> -->
    <div class="row">
      <!---<div class="text-center box shadow-5 animated fadeInLeft b-r-4 p-a-20">-->
      <div class="wrapper fadeInDown">
        <div id="formContent">
          <!-- Icon -->
          <div class="fadeIn first">
            <!--<img src="../assets/img/biblioteca.jpg"  class="rounded mx-auto d-block img-fluid m-2" width="10%" height="10%"  id="icon"  alt="User Icon" />-->
          </div>
          <hr>
          <div class="text-center box shadow-5 animated fadeInLeft b-r-4 p-a-20">ADMIN - POLAKOMMERCE</div>
          <div class="form-group has-feedback m-1">
            <input type="email" class="form-control fadeIn second" id="inputEmail" placeholder="Ingrese su Email">
          </div>
          <div class="form-group has-feedback m-1">
            <input type="password" class="form-control fadeIn third" id="inputPassword" placeholder="Ingrese su Password">

          </div>
          <div class="form-group has-feedback m-1">
            <div id="divUsuario"></div>
            <button id="btn-login" class="btn btn-primary btn-lg m-3 ">Ingresar</button>
            <div class="row m-3 text-center  justify-content-center align-items-center minh-100">
              <a href="app-forgot.html">
                <small>¿Olvido el password?</small>
              </a>
            </div>
          </div>
        </div>
      </div>

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

      <script src="../assets/js/login.js"></script>
</body>

</html>