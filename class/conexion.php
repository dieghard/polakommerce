<?php
/*
ATENCION : TABLA  = Usuarios
           Campo  =  password
           datp   = ' 123456 = $2y$10$yjM7MYiVu3UaUmC7cBE7xu0HjoFKM4AgyAXpFgEwdHSeInQcxBk62
           Si se reemplaza el dato en la tabla por = $2y$10$yjM7MYiVu3UaUmC7cBE7xu0HjoFKM4AgyAXpFgEwdHSeInQcxBk62
           la contraseña es = 123456
*/
 require 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable('config/');
$dotenv->load();
class Conexion{
        public function DBConect(&$superArray){

            $SERVIDOR = $_ENV['DB_HOST'];
            $BASE_DE_DATOS = $_ENV['DB_NAME'];
            $USUARIO= $_ENV['DB_USER'];
            $PASSWORD= $_ENV['DB_PASSWD'];
            $PUERTO= $_ENV['DB_PORT'];
            $superArray['success'] = true;
            $superArray['mensaje'] = '';

            try {
                $conexion = new PDO("mysql:host=$SERVIDOR;port=$PUERTO;dbname=$BASE_DE_DATOS", "$USUARIO", "$PASSWORD", array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''));
                $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                return  $conexion;
            }
            catch (PDOException $e) {
                echo 'ERROR:'.$e->getMessage().'-CODIGO: '.$e->getCode();
                $superArray['success'] = false;
                $superArray['mensaje'] = 'ERROR:'.$e->getMessage().'-CODIGO: '.$e->getCode();
                return ;
            }
        }
    }
