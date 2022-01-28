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
  <title>Administración Polakommerce</title>
  <link rel="stylesheet" href="../../assets/css/metisMenu.min.css" />
  <link rel="stylesheet" href="../../assets/css/vendor.css" />
  <link rel="stylesheet" href="../../assets/vendor/dragula/dragula.css" />
  <link rel="stylesheet" href="../../assets/css/chl.css" />
  <link id="theme-list" rel="stylesheet" href="../../assets/css/theme-peter-river.min.css" />
  <link id="theme-list" rel="stylesheet" href="../../assets/css/AdminLTE.min.css" />
  <link rel="stylesheet" href="../../assets/css/animate.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
        </nav>
      </header>
      <div class="app-container">

        <aside class="app-side">
          <div class="side-content">
            <?php include 'wireframe/user-left-panel.php'; ?>
            <?php include 'wireframe/menu.php'; ?>
          </div>
        </aside>
        <div class="side-visible-line hidden-xs" data-side="collapse">
          <i class="fa fa-caret-left"></i>
        </div>
        <div class="app-main">
          <header class="main-heading shadow-2dp">
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

          <div class="main-content bg-clouds">
            <div class="container-fluid p-t-15">
              <?php
              if ($pagina == 'panel') {
                include 'paginas/panel.php';
              } elseif ($pagina == 'Usuarios') {
                include 'paginas/users_abm.php';
              } elseif ($pagina == 'Rubros') {
                include 'paginas/Rubros.php';
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
        <?php include 'wireframe/footer.php'; ?>
        <!-- END: .app-main -->
      </div>


      <script type="text/javascript" language="javascript" src="../../assets/js/panel.js"></script>
</body>

</html>