<?php /// SI NO ESTA LOGUEADO ARAFUE

if (!isset($_SESSION['usuario'])) {
  session_start();
  if (isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];
    $empresa = $_SESSION['empresa'];
    $_session_NOMBRE = $usuario['nombreyapellido'];
  } else {
    $newURL = '../index.php';
    header('Location: ' . $newURL);
  }
} else {
  $newURL = '../index.php';
  header('Location: ' . $newURL);
}
if (isset($_GET['controlador'])) {
  $pagina = $_GET['controlador'];
} else {
  $newURL = '../index.php';
}

?>
<!doctype html>

<html lang="es">

<head>
  <link rel='shortcut icon' type='image/png' href='favicon.ico' />
  <meta charset="utf-8">
  <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Adminitración Polakommerce</title>
  <link rel="stylesheet" href="../../assets/css/metisMenu.min.css" />
  <link rel="stylesheet" href="../../assets/css/vendor.css" />
  <link rel="stylesheet" href="../../assets/vendor/dragula/dragula.css" />
  <link rel="stylesheet" href="../../assets/css/chl.css" />
  <link id="theme-list" rel="stylesheet" href="../../assets/css/theme-peter-river.min.css" />
  <link id="theme-list" rel="stylesheet" href="../../assets/css/AdminLTE.min.css" />
  <link rel="stylesheet" href="../../assets/css/animate.css" />
</head>

<body>
  <div class="app">
    <div class="app-wrap">
      <header class="app-heading">
        <nav class="navbar navbar-default navbar-static-top shadow-2dp">
          <div class="navbar-header">
            <div class="navbar-header-left b-r">
              <a class="logo" href="../index.html">
                <span class="logo-xs visible-xs">
                  <img src="../../assets/img/logo_xs.svg" alt="logo-xs">
                </span>
                <span class="logo-lg hidden-xs">
                  <img src="../../assets/img/logo_lg.svg" alt="logo-lg">
                </span>
              </a>
            </div>
            <nav class="nav navbar-header-nav">
              <a class="visible-xs b-r" href="#" data-side=collapse>
                <i class="fa fa-fw fa-bars"></i>
              </a>
              <a class="hidden-xs b-r" id="botonOcultar" href="#" data-side=mini>
                <i class="fa fa-fw fa-bars"></i>
              </a>
            </nav>
            <ul class="nav navbar-header-nav m-l-a">
              <li class="visible-xs b-l">
                <a href="#top-search" data-toggle="canvas">
                  <i class="fa fa-fw fa-search"></i>
                </a>
              </li>
              <?php //include ('wireframe\mails.php') <!-- BEGIN MAILS en NAV ARRIBA -->
              ?>
              <!-- END MAILS en NAV ARRIBA -->
              <?php include 'wireframe/datosUser.php'; ?>
            </ul>
          </div>
          <!-- END: .navbar-header -->
        </nav>
        <!-- END: .navbar -->
      </header>
      <!-- END:  .app-heading -->
      <!-- begin .app-container -->
      <div class="app-container">

        <!-- begin .app-side -->
        <aside class="app-side">
          <!-- begin .side-content -->
          <div class="side-content">
            <!-- begin user-panel -->
            <?php include 'wireframe/user-left-panel.php'; ?>
            <!-- END: user-panel -->
            <!-- begin .side-nav -->
            <?php include 'wireframe/menu.php'; ?>
            <!-- END: .side-nav -->
          </div>
          <!-- END: .side-content -->
          <!-- END: .side-footer -->
        </aside>
        <!-- END: .app-side -->
        <!-- begin side-collapse-visible bar -->
        <div class="side-visible-line hidden-xs" data-side="collapse">
          <i class="fa fa-caret-left"></i>
        </div>
        <!-- begin side-collapse-visible bar -->
        <!-- begin .app-main -->
        <div class="app-main">
          <!-- begin .main-heading -->
          <header class="main-heading shadow-2dp">
            <!-- begin dashhead -->
            <div class="dashhead bg-white">
              <div class="dashhead-titles">
                <h6 class="dashhead-subtitle">Administración<p>Software Polakommerce</p>
                </h6>
                <h3 class="dashhead-title">Panel</h3>
              </div>
              <div class="dashhead-toolbar">
                <div class="dashhead-toolbar-item">
                  <a href="index.php">Panel</a>
                </div>
              </div>
            </div>
            <!-- END: dashhead -->
          </header>
          <!-- jQuery first, then Popper.js, then Bootstrap JS -->
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

          <!-- END: .main-heading -->

          <!-- begin .main-content -->
          <div class="main-content bg-clouds">
            <!-- begin .container-fluid -->
            <div class="container-fluid p-t-15">
              <!-- BEGIN: ACA VIENE EL RESTO DE TODA LA DATA!!!! -->
              <?php
              if ($pagina == 'panel') {
                include 'paginas/panel.php';
              } elseif ($pagina == 'emisionderecibos') {
                include 'paginas/emisionderecibos_abm.php';
              } elseif ($pagina == 'pagosRecibos') {
                include 'paginas/pagosRecibos_abm.php';
              } elseif ($pagina == 'socios') {
                include 'paginas/users_abm.php';
              } elseif ($pagina == 'provincias') {
                include 'paginas/provincias_abm.php';
              } elseif ($pagina == 'localidad') {
                include 'paginas/localidad_abm.php';
              } elseif ($pagina == 'costoCuota') {
                include 'paginas/costoCuota_abm.php';
              } elseif ($pagina == 'sectores') {
                include 'paginas/sector_abm.php';
              } else {
                $newURL = 'logout.php';
                echo '<meta http-equiv="refresh" content="0;URL=logout.php">';
              }
              ?>
              <!-- END: PANELES CON TODAS LAS DATAS -->
            </div>
            <!-- END: .container-fluid -->
          </div>
          <!-- END: .main-content -->
        </div>
        <!-- END: .app-main -->
      </div>
      <!-- END: .app-container -->

      <?php include 'wireframe/footer.php'; ?>

      <!-- Bootstrap -->
      <!-- FIN Bootstrap -->
      <!-- SELECT2 -->
      <link href="../../assets/select2/css/select2.min.css" rel="stylesheet" />
      <script src="../../assets/select2/js/select2.min.js"></script>
      <!--  FIN SELECT -->
      <script src="../../assets/js/metisMenu.min.js"></script>
      <!-- ESTO ES PARA LOS CUADROS DE ALERTA  --->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css" />
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
      <!-- TABLA -->
      <link rel="stylesheet" type="text/css" href="../../assets/css/jquery.dataTables.min.css">
      <script type="text/javascript" language="javascript" src="../../assets/js/jquery.dataTables.min.js"></script>
      <link rel="stylesheet" type="text/css" href="../../assets/css/jquery.dataTables.css">
      <script type="text/javascript" charset="utf8" src="../../assets/js/jquery.dataTables.js"></script>
      <link rel="stylesheet" type="text/css" href="../../assets/css/buttons.dataTables.min.css">
      <script type="text/javascript" language="javascript" src="../../assets/js/dataTables.buttons.min.js"></script>
      <script type="text/javascript" language="javascript" src="../../assets/js/buttons.flash.min.js"></script>
      <script type="text/javascript" language="javascript" src="../../assets/js/jszip.min.js"></script>
      <script type="text/javascript" language="javascript" src="../../assets/js/pdfmake.min.js"></script>
      <script type="text/javascript" language="javascript" src="../../assets/js/vfs_fonts.js"></script>
      <script type="text/javascript" language="javascript" src="../../assets/js/buttons.html5.min.js"></script>
      <script type="text/javascript" language="javascript" src="../../assets/js/dataTables.rowGroup.min.js"></script>
      <script type="text/javascript" language="javascript" src="../../assets/vendor/dragula/dragula.js"></script>
      <script type="text/javascript" language="javascript" src="../../assets/js/chl.js"></script>
      <script type="text/javascript" language="javascript" src="../../assets/js/panel.js"></script>
</body>

</html>