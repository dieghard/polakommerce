<?php
define('NAMEHOST', 'polakommerce');
define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT'].'/'.NAMEHOST.'/');
define('CLASS_PATH', ROOT_PATH.'class/');
session_start();
$_SESSION['CLASS_PATH'] = ROOT_PATH.'class/';
//include_once ($_SERVER['DOCUMENT_ROOT'].'/dirs.php');
