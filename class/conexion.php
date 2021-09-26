<?php

namespace Class;

use PDO;

class Conexion
{

    private $iniData;

    public function __construct(&$arraydata)
    {
        try {
            $this->iniData = parse_ini_file(".config/db.php.ini");
            //$arraydata['mensaje   '] ='CARGUE TODO BIEN';
        } catch (PDOException $e) {
            $arraydata['mensaje'] =  'ERROR:' . $e->getMessage() . '-CODIGO: ' . $e->getCode();
            return $arraydata;
        }
    }

    public function DBConect(&$superArray)
    {


        $SERVIDOR   = $this->iniData['DB_HOST'];
        $BASE_DE_DATOS = $this->iniData['DB_NAME'];
        $USUARIO    = $this->iniData['DB_USER'];
        $PASSWORD   = $this->iniData['DB_PASSWD'];
        $PUERTO     = $this->iniData['DB_PORT'];

        $superArray['success'] = true;
        $superArray['mensaje'] = '';


        try {
            $conexion = new PDO("mysql:host=$SERVIDOR;port=$PUERTO;dbname=$BASE_DE_DATOS", "$USUARIO", "$PASSWORD", array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''));
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $superArray['success'] = true;
            $superArray['mensaje'] = 'CONEXION EXITOSA';
            return  $conexion;
        } catch (PDOException $e) {
            echo 'ERROR:' . $e->getMessage() . '-CODIGO: ' . $e->getCode();
            $superArray['success'] = false;
            $superArray['mensaje'] = 'ERROR:' . $e->getMessage() . '-CODIGO: ' . $e->getCode();
            return;
        }
    }
}
/*
$arraydata= [];
$conexion = new Conexion($arraydata);
var_dump($arraydata);
$teconecte = $conexion->DBConect($arraydata);
var_dump($arraydata);
var_dump($teconecte);
*/
