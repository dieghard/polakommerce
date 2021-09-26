<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "../admin/Controlador/Loguin.php";
require_once "../config.php";

/*=============================================
             LLAMADA A LA PLANTILLA            =
=============================================*/

use admin\controlador\Login;

$plantilla = new Login();
$plantilla->Login();
