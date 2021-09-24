
<?php /// SI NO ESTA LOGUEADO ARAFUE
 require_once '../controlador/controlador.php';
if (!isset($_SESSION['usuario'])) {
    session_start();
    if (isset($_SESSION['usuario'])) {
        $usuario = $_SESSION['usuario'];
        $biblioteca = $_SESSION['biblioteca'];
        $_session_NOMBRE = $usuario['apellidoyNombre'];
    } else {
        $newURL = '../index.php';
        header('Location: '.$newURL);
    }
} else {
    $newURL = '../index.php';
    header('Location: '.$newURL);
}
  if (isset($_GET['controlador'])) {
      $pagina = $_GET['controlador'];
  } else {
      $newURL = '../index.php';
      //        header('Location: '.$newURL);

  }

?>
<!doctype html>

<html lang="es">
<head>
      <link rel='shortcut icon' type='image/png' href='favicon.ico'/>
        <meta charset="utf-8">
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Software Biblios</title>
      <!-- END: End javascript files -->
    <!--MUEVE LOS OBJETOS EN LA PANTALLA -->
    <!--metisMenu-->
      <link rel="stylesheet" href="assets/css/metisMenu.min.css"/>
      <!-- /////////////////////////////////////////////////////-->
        <!-- Vendor stylesheet files. REQUIRED -->
        <!-- BEGIN: Vendor  -->
        <link rel="stylesheet" href="assets/css/vendor.css"/>
        <link rel="stylesheet" href="assets/vendor/dragula/dragula.css"/>
        <!-- END: plugin stylesheet files -->
        <!-- Theme main stlesheet files. REQUIRED -->
        <link rel="stylesheet" href="assets/css/chl.css"/>
        <!-- Theme TESTEO THEME-->
        <link id="theme-list" rel="stylesheet" href="assets/css/theme-peter-river.min.css"/>
        <link id="theme-list" rel="stylesheet" href="assets/css/AdminLTE.min.css"/>
        <!-- END: theme main stylesheet files -->
     <!-- animate.css -->
      <link rel="stylesheet" href="assets/css/animate.css"/>
      <!-- FIN ANIMATE-->
</head>
<body>
  <!-- begin .app -->
  <div class="app">
    <!-- begin .app-wrap -->
      <div class="app-wrap">
        <!-- begin .app-heading -->
        <header class="app-heading">
          <!-- begin .navbar -->
          <nav class="navbar navbar-default navbar-static-top shadow-2dp">
            <!-- begin .navbar-header -->
            <div class="navbar-header">
              <!-- begin .navbar-header-left with image -->
              <div class="navbar-header-left b-r">
                <!--begin logo-->
                <a class="logo" href="../index.html">
                  <span class="logo-xs visible-xs">
                    <img src="assets/img/logo_xs.svg" alt="logo-xs">
                  </span>
                  <span class="logo-lg hidden-xs">
                    <img src="assets/img/logo_lg.svg" alt="logo-lg">
                  </span>
                </a>
                <!--end logo-->
              </div>
              <!-- END: .navbar-header-left with image -->
              <nav class="nav navbar-header-nav">

                <a class="visible-xs b-r"  href="#" data-side=collapse>
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
          <!-- BEGIN MAILS en NAV ARRIBA -->
              <?php //include ('wireframe\mails.php')?>
          <!-- END MAILS en NAV ARRIBA -->

            <!-- BEGIN Usuario en NAV ARRIBA -->
              <?php include 'wireframe/datosUser.php'; ?>
          <!-- END Usuario en NAV ARRIBA -->
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
                  <h6 class="dashhead-subtitle">Biblios<p>Software para biblioteca</p></h6>
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
          <script src="assets/js/jquery-3.2.1.min.js" crossorigin="anonymous"></script>

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
    <!--------------------------------------------------------------------------------- -->


  <!-- Bootstrap -->

    <script src="assets/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="assets/js/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- FIN Bootstrap -->
  <!-- SELECT2 -->
    <link href="assets/select2/css/select2.min.css" rel="stylesheet" />
    <script src="assets/select2/js/select2.min.js"></script>
    <!--  FIN SELECT -->

    <script src="assets/js/metisMenu.min.js"></script>
    <!-- ESTO ES PARA LOS CUADROS DE ALERTA  --->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
    <!-- TABLA -->
    <link rel="stylesheet" type="text/css" href="assets/css/jquery.dataTables.min.css">
    <script type="text/javascript" language="javascript" src="assets/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="assets/js/jquery.dataTables.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/css/buttons.dataTables.min.css">
    <script type="text/javascript" language="javascript" src="assets/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" language="javascript" src="assets/js/buttons.flash.min.js"></script>
    <script type="text/javascript" language="javascript" src="assets/js/jszip.min.js"></script>
    <script type="text/javascript" language="javascript" src="assets/js/pdfmake.min.js"></script>
    <script type="text/javascript" language="javascript" src="assets/js/vfs_fonts.js"></script>
    <script type="text/javascript" language="javascript" src="assets/js/buttons.html5.min.js"></script>
   <!-- <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/rowgroup/1.1.2/js/dataTables.rowGroup.min.js" -->
    <script type="text/javascript" language="javascript" src="assets/js/dataTables.rowGroup.min.js"
    <!--   DATATABLE-->
    <script src="assets/vendor/dragula/dragula.js"></script>
    <script src="assets/js/chl.js"></script>
    <script src="paginas/js/panel.js"></script>
  </body>

</html>
