<?php

namespace admin\Modelo;

require_once "../../../Class/Conexion.php";

use Class\Conexion;
use PDO;

class ModeloPanel
{
    private $iniData;
    public function __construct()
    {
        try {
            $this->iniData = parse_ini_file('../../../Class/.config/db.php.ini');
        } catch (PDOException $e) {
            $arraydata['mensaje'] =  'ERROR:' . $e->getMessage() . '-CODIGO: ' . $e->getCode();
            return $arraydata;
        }
    }

    public function EstadoPedidos()
    {
        $superArray = array();
        $conexion = new Conexion($superArray);

        $dbConectado = $conexion->DBConect($superArray);

        $superArray['success'] = true;
        $superArray['mensaje'] = '';
        $superArray['saldo'] = 0;

        $strSql = "SELECT COUNT(*)  as pedido FROM pedidos WHERE estado = 'NUEVO'";
        $cantidadNuevos = 0;
        try {
            $stmt = $dbConectado->prepare($strSql);
            $stmt->execute();
            $registro = $stmt->fetchAll();
            if ($registro) {
                $row = $registro[0];
                $cantidadNuevos =  $row['pedido'];
            }
        } catch (Throwable $e) {
            $superArray['success'] = false;
            $trace = $e->getTrace();
            $superArray['mensaje'] = $e->getMessage() . ' en ' . $e->getFile() . ' en la linea ' . $e->getLine() . ' llamado desde ' . $trace[0]['file'] . ' on line ' . $trace[0]['line'];
        }

        $strSql = "SELECT COUNT(*)  as pedido FROM pedidos WHERE estado = 'ENTREGADOS'";
        $cantidadEntragados = 0;

        try {
            $stmt = $dbConectado->prepare($strSql);
            $stmt->execute();
            $registro = $stmt->fetchAll();
            if ($registro) {
                $row = $registro[0];
                $cantidadEntragados =  $row['pedido'];
            }
        } catch (Throwable $e) {
            $superArray['success'] = false;
            $trace = $e->getTrace();
            $superArray['mensaje'] = $e->getMessage() . ' en ' . $e->getFile() . ' en la linea ' . $e->getLine() . ' llamado desde ' . $trace[0]['file'] . ' on line ' . $trace[0]['line'];
        }

        $strSql = "SELECT COUNT(*)  as pedido FROM pedidos WHERE estado = 'EN PROCESO'";
        $cantidadProceso = 0;

        try {
            $stmt = $dbConectado->prepare($strSql);
            $stmt->execute();
            $registro = $stmt->fetchAll();
            if ($registro) {
                $row = $registro[0];
                $cantidadProceso =  $row['pedido'];
            }
        } catch (Throwable $e) {
            $superArray['success'] = false;
            $trace = $e->getTrace();
            $superArray['mensaje'] = $e->getMessage() . ' en ' . $e->getFile() . ' en la linea ' . $e->getLine() . ' llamado desde ' . $trace[0]['file'] . ' on line ' . $trace[0]['line'];
        }




        $nuevos = '<div class="info-box">
                        <span class="info-box-icon bg-green"><i class="fa fa-money"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">PEDIDOS NUEVOS</span>
                            <span id="pedidosNuevos" class="info-box-number">' . $cantidadNuevos . '</span>
                        </div>
                   </div>' .

            '<div class="info-box">
                        <span class="info-box-icon bg-yellow"><i class="fa fa-money"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">PEDIDOS EN PROCESO</span>
                            <span id="pedidosProceso" class="info-box-number">' . $cantidadProceso . '</span>
                        </div>
                   </div>' .

            '<div class="info-box">
                        <span class="info-box-icon bg-blue"><i class="fa fa-money"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">PEDIDOS ENTREGADOS</span>
                            <span id="pedidosEntregados" class="info-box-number">' . $cantidadEntragados . '</span>
                        </div>
                   </div>';

        $superArray['pedidosNuevos'] = $nuevos;
        $Coneccion = null;

        return json_encode($superArray);
    }
}
