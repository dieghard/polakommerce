<?php

require_once 'conexion.php';

class modeloPanel
{
    public function __construct()
    {
        require_once 'conexion.php';
    }

    public function verificarUsuarios($bibliotecaID)
    {
        $Coneccion = new Conexion();
        $dbConectado = $Coneccion->DBConect();

        $superArray['success'] = true;
        $superArray['mensaje'] = '';
        $superArray['cantidadUsuariosActivos'] = 0;
        $superArray['cantidadUsuariosInactivos'] = 0;
        $superArray['saldo'] = 0;
        $bibliotecalID = $bibliotecaID;
        /***********************************************************************************************************************************************************************************************/
        // CANTIDAD ACTIVOS
        /***********************************************************************************************************************************************************************************************/

        $strSql = 'SELECT count(*) as cantidad FROM socios Where Activo = "SI"';
        $strSql .= '    AND  bilbiotecaId=:bibliotecaID';

        try {
            $stmt = $dbConectado->prepare($strSql);
            $stmt->bindParam(':bibliotecaID', $bibliotecalID, PDO::PARAM_INT);
            $stmt->execute();
            $registro = $stmt->fetchAll();

            if ($registro) {
                foreach ($registro  as $row) {
                    $superArray['cantidadUsuariosActivos'] = $row['cantidad'];
                }
            }
        } catch (Throwable $e) {
            $superArray['success'] = false;
            $trace = $e->getTrace();
            $superArray['mensaje'] = $e->getMessage().' en '.$e->getFile().' en la linea '.$e->getLine().' llamado desde '.$trace[0]['file'].' on line '.$trace[0]['line'];
        }
        /***********************************************************************************************************************************************************************************************/
        // CANTIDAD INACTIVOS
        /***********************************************************************************************************************************************************************************************/

        $strSql = 'SELECT count(*) as cantidad FROM socios Where Activo = "NO"';
        $strSql .= '    AND  bilbiotecaId=:bibliotecaID';

        try {
            $stmt = $dbConectado->prepare($strSql);
            $stmt->bindParam(':bibliotecaID', $bibliotecalID, PDO::PARAM_INT);
            $stmt->execute();
            $registro = $stmt->fetchAll();

            if ($registro) {
                foreach ($registro  as $row) {
                    $superArray['cantidadUsuariosInactivos'] = $row['cantidad'];
                }
            }
        } catch (Throwable $e) {
            $superArray['success'] = false;
            $trace = $e->getTrace();
            $superArray['mensaje'] = $e->getMessage().' en '.$e->getFile().' en la linea '.$e->getLine().' llamado desde '.$trace[0]['file'].' on line '.$trace[0]['line'];
        }
        /***********************************************************************************************************************************************************************************************/
        // SALDO ACTIVOS
        /***********************************************************************************************************************************************************************************************/

        $strSql = 'SELECT  m.socioId,m.saldo
                     from movimientos m
                    inner join socios s on s.id = m.socioId
                 Where 1= 1 
                        AND ifnull(m.Eliminado,"NO") <>"SI"
                        AND  ifnull(s.activo,"NO")="SI"
                        AND  bilbiotecaId=:bibliotecaID
                     GROUP by m.socioId';
        $superArray['sql'] = $strSql;
        try {
            $stmt = $dbConectado->prepare($strSql);
            $stmt->bindParam(':bibliotecaID', $bibliotecalID, PDO::PARAM_INT);
            $stmt->execute();
            $registro = $stmt->fetchAll();

            if ($registro) {
                foreach ($registro  as $row) {
                    $superArray['saldo'] += $row['saldo'];
                }
            }
        } catch (Throwable $e) {
            $superArray['success'] = false;
            $trace = $e->getTrace();
            $superArray['mensaje'] = $e->getMessage().' en '.$e->getFile().' en la linea '.$e->getLine().' llamado desde '.$trace[0]['file'].' on line '.$trace[0]['line'];
        }
        $Coneccion = null;

        return json_encode($superArray);
    }
}
