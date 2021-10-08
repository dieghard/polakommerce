<!DOCTYPE html>
<html>

<head>
  <link rel='shortcut icon' type='image/png' href='../favicon.ico' />
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Administración - POLAKOMMERCE</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="../assets/vendor/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="../assets/css/animate.css">
  <!--<link rel="stylesheet" href="../assets/css/loguin.css">-->
  <link rel="stylesheet" href="../assets/css/loguin2.css">

</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-md-6 mx-auto p-0">
        <div class="card">
          <h1 class="text-center">POLAKOMMERCE</h1>
          <div class="login-box">
            <div class="login-snip"> <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Ingreso</label> <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">¡Registrame!</label>
              <div class="login-space">
                <div class="login">
                  <div class="group"> <label for="user" class="label">Mail</label> <input type="text" class="input" id="inputEmail" placeholder="Ingrese su Email"> </div>
                  <div class="group"> <label for="pass" class="label">Password</label> <input type="password" class="input" data-type="password" id="inputPassword" placeholder="Ingrese su Password"> </div>
                  <div class="group"> <input id="check" type="checkbox" class="check" checked> <label for="check"><span class="icon"></span> Mantenerme Logueado</label> </div>
                  <div class="group"><button id="btn-login" class="btn btn-primary btn-lg m-3 ">Ingresar</button></div>
                  <div class="hr"></div>
                  <div class="foot"> <a href="#">¿Olvidaste tu Password?</a> </div>
                </div>
                <div class="sign-up-form">
                  <div class="group"> <label for="user" class="label">Mail</label> <input id="user" type="text" class="input" placeholder="Ingrese su mail"> </div>
                  <div class="group"> <label for="pass" class="label">Password</label> <input id="pass" type="password" class="input" data-type="password" placeholder="Crear password"> </div>
                  <div class="group"> <label for="pass" class="label">Repetir Password</label> <input id="pass" type="password" class="input" data-type="password" placeholder="Repetir tu password"> </div>
                  <div class="group"> <input type="submit" class="button" value="Registrate"> </div>
                  <div class="hr"></div>
                  <div class="foot"> <label for="tab-1">¿Ya estas registrado?</label> </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="../assets/js/login.js"></script>
</body>

</html>