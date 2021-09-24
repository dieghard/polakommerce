<?php
    class Conexion{
        public function DBConect(){
            /*
            $SERVIDOR = 'sql111.main-hosting.eu';
            $BASE_DE_DATOS = 'u372719489_bibli';
            $USUARIO = 'u372719489_diegh';
            $PASSWORD = 'Die*666666';
            */
            $SERVIDOR = "localhost";
            $BASE_DE_DATOS = "biblioteca";
            $USUARIO= "root";
            $PASSWORD= "";
            try {
                $conexion = new PDO("mysql:host=$SERVIDOR;dbname=$BASE_DE_DATOS", "$USUARIO", "$PASSWORD", array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''));
                //$conexion = new PDO ("dblib:host=$SERVIDOR;dbname=$BASE_DE_DATOS", "$USUARIO", "$PASSWORD");
                $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                return  $conexion;
            }
            catch (PDOException $e) {
                echo 'ERROR:'.$e->getMessage().'-CODIGO: '.$e->getCode();
                exit();
            }
        }
    }
