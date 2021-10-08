<?php

namespace admin\Modelo;

require_once "../../../Class/Conexion.php";

use Class\Conexion;
use PDO;

class ModeloCombos
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
    public function ComboLocalidad($tabIndex)
    {
        $superArray = array();
        $conexion = new Conexion($superArray);
        $dbConectado = $conexion->DBConect($superArray);
        $superArray['success'] = true;
        $superArray['mensaje'] = '';
        $superArray['combo'] = '';
        header('Content-Type: text/html;charset=utf-8');
        $strSql = 'SELECT id, descripcion
                FROM localidades
                ORDER BY descripcion';
        try {
            $stmt = $dbConectado->prepare($strSql);
            $stmt->execute();

            $registro = $stmt->fetchAll();
            $combo = '<label for="cmbLocalidad">Localidad: </label><select class="form-control" id="cmbLocalidad" style="width:100%;" tabindex="' . $tabIndex . '"  require><option value=0>Seleccione Localidad</option>';
            if ($registro) {
                /* obtener los valores */
                foreach ($registro  as $row) {
                    $combo .= '<option value=' . $row['id'] . '>' . $row['descripcion'] . '</option>';
                }
            }
            $combo .= '</select>';
            $superArray['combo'] = $combo;
        } catch (Throwable $e) {
            $trace = $e->getTrace();
            $superArray['false'] = false;
            $superArray['mensaje'] = $e->getMessage() . ' en ' . $e->getFile() . ' en la linea ' . $e->getLine() . ' llamado desde ' . $trace[0]['file'] . ' on line ' . $trace[0]['line'];
        }
        $Coneccion = null;

        return json_encode($superArray);
    }
}
