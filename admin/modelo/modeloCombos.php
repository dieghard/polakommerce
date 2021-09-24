<?php

require_once 'conexion.php';

class ModeloCombos
{
    public function __construct()
    {
        require_once 'conexion.php';
    }
    public function ComboLocalidad($tabIndex)
    {
        $Coneccion = new Conexion();
        $dbConectado = $Coneccion->DBConect();
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
            $combo = '<label for="cmbLocalidad">Localidad: </label><select class="form-control" id="cmbLocalidad" style="width:100%;" tabindex="'.$tabIndex.'"  require><option value=0>Seleccione Localidad</option>';
            if ($registro) {
                /* obtener los valores */
                foreach ($registro  as $row) {
                    $combo .= '<option value='.$row['id'].'>'.$row['descripcion'].'</option>';
                }
            }
            $combo .= '</select>';
            $superArray['combo'] = $combo;
        } catch (Throwable $e) {
            $trace = $e->getTrace();
            $superArray['false'] = false;
            $superArray['mensaje'] = $e->getMessage().' en '.$e->getFile().' en la linea '.$e->getLine().' llamado desde '.$trace[0]['file'].' on line '.$trace[0]['line'];
        }
        $Coneccion = null;

        return json_encode($superArray);
    }
    public function ComboProvincia($tabIndex)
    {
        $Coneccion = new Conexion();
        $dbConectado = $Coneccion->DBConect();
        $superArray['success'] = true;
        $superArray['mensaje'] = '';
        $superArray['combo'] = '';
        header('Content-Type: text/html;charset=utf-8');
        $strSql = 'SELECT id, descripcion
                FROM provincias
                ORDER BY descripcion';
        try {
            $stmt = $dbConectado->prepare($strSql);
            $stmt->execute();
            $registro = $stmt->fetchAll();
            $combo = '<label for="cmbProvincia">Provincia: </label><select class="form-control comboProvincia" style="width:100%;" id="cmbProvincia" tabindex="'.$tabIndex.'"  require><option value=0>Seleccione Provincia </option> ';
            if ($registro) {
                foreach ($registro  as $row) {
                    $combo .= '<option value='.$row['id'].'>'.$row['descripcion'].'</option>';
                }
            }
            $combo .= '</select>';
            $superArray['combo'] = $combo;

            return json_encode($superArray);
        } catch (Throwable $e) {
            $trace = $e->getTrace();
            $superArray['false'] = false;
            $superArray['mensaje'] = $e->getMessage().' en '.$e->getFile().' en la linea '.$e->getLine().' llamado desde '.$trace[0]['file'].' on line '.$trace[0]['line'];
        }
        $Coneccion = null;

        return json_encode($superArray);
    }
    public function ComboSectores($tabIndex)
    {
        $Coneccion = new Conexion();
        $dbConectado = $Coneccion->DBConect();
        $superArray['success'] = true;
        $superArray['mensaje'] = '';
        $superArray['combo'] = '';
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $usuario = $_SESSION['usuario'];
        header('Content-Type: text/html;charset=utf-8');
        $strSql = 'SELECT id, descripcion
                FROM sector
                Where bibliotecaId='.$usuario['bibliotecaID'].'  ORDER BY descripcion';
        try {
            $stmt = $dbConectado->prepare($strSql);
            $stmt->execute();
            $registro = $stmt->fetchAll();
            $combo = '<label for="cmbSector">Sector: </label>
                                <select class="form-control cmbSector" id="cmbSector"  style="width:100%;" tabindex="'.$tabIndex.'"  require>
                                <option value=0>Seleccione Sector </option>';
            if ($registro) {
                /* obtener los valores */
                foreach ($registro  as $row) {
                    $combo .= '<option value='.$row['id'].'>'.$row['descripcion'].'</option>';
                }
            }
            $combo .= '</select>';
            $superArray['combo'] = $combo;

            return json_encode($superArray);
        } catch (Throwable $e) {
            $trace = $e->getTrace();
            $superArray['false'] = false;
            $superArray['mensaje'] = $e->getMessage().' en '.$e->getFile().' en la linea '.$e->getLine().' llamado desde '.$trace[0]['file'].' on line '.$trace[0]['line'];
        }
        $Coneccion = null;

        return json_encode($superArray);
    }
    public function ComboTipoSocio($tabIndex)
    {
        $Coneccion = new Conexion();
        $dbConectado = $Coneccion->DBConect();
        $superArray['success'] = true;
        $superArray['mensaje'] = '';
        $superArray['combo'] = '';
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $usuario = $_SESSION['usuario'];
        header('Content-Type: text/html;charset=utf-8');
        $strSql = 'SELECT id, descripcion	, valorCuota
                FROM tiposocio
                Where bibliotecaId='.$usuario['bibliotecaID'].'  ORDER BY descripcion';
        try {
            $stmt = $dbConectado->prepare($strSql);
            $stmt->execute();
            $registro = $stmt->fetchAll();
            $combo = '<label for="cmbTipoSocio">Tipo Socio: </label>
                                <select class="form-control  cmbTipoSocio" id="cmbTipoSocio" style="width:100%;" tabindex="'.$tabIndex.'" require>
                                <option value=0>Seleccione Tipo Socio </option>';
            if ($registro) {
                /* obtener los valores */
                foreach ($registro  as $row) {
                    $combo .= '<option value='.$row['id'].'>'.$row['descripcion'].'($'.$row['valorCuota'].')'.'</option>';
                }
            }
            $combo .= '</select>';
            $superArray['combo'] = $combo;

            return json_encode($superArray);
        } catch (Throwable $e) {
            $trace = $e->getTrace();
            $superArray['false'] = false;
            $superArray['mensaje'] = $e->getMessage().' en '.$e->getFile().' en la linea '.$e->getLine().' llamado desde '.$trace[0]['file'].' on line '.$trace[0]['line'];
        }
        $Coneccion = null;

        return json_encode($superArray);
    }
    public function ComboSocios($tabIndex)
    {
        $Coneccion = new Conexion();
        $dbConectado = $Coneccion->DBConect();
        $superArray['success'] = true;
        $superArray['mensaje'] = '';
        $superArray['combo'] = '';
        $superArray['sql'] = '';
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $usuario = $_SESSION['usuario'];
        header('Content-Type: text/html;charset=utf-8');
        $strSql = "SELECT id, apellidoyNombre
                FROM socios
                Where activo='SI' AND bilbiotecaId=".$usuario['bibliotecaID'].'  ORDER BY apellidoyNombre';
        $superArray['sql'] = $strSql;
        try {
            $stmt = $dbConectado->prepare($strSql);
            $stmt->execute();
            $registro = $stmt->fetchAll();
            $combo = '<select onchange="LlenarGrilla();" id="cmbSocio" style="width:100%;" tabindex="'.$tabIndex.'" >
                                <option value=0>Seleccione Socio </option>';
            if ($registro) {
                /* obtener los valores */
                foreach ($registro  as $row) {
                    $combo .= '<option value='.$row['id'].'>'.$row['apellidoyNombre'].'</option>';
                }
            }
            $combo .= '</select>';
            $superArray['combo'] = $combo;

            return json_encode($superArray);
        } catch (Throwable $e) {
            $trace = $e->getTrace();
            $superArray['success'] = false;
            $superArray['mensaje'] = $e->getMessage().' en '.$e->getFile().' en la linea '.$e->getLine().' llamado desde '.$trace[0]['file'].' on line '.$trace[0]['line'];
        }
        $Coneccion = null;

        return json_encode($superArray);
    }
    public function socios_impresion($tabIndex,$idCombo)
    {
        $Coneccion = new Conexion();
        $dbConectado = $Coneccion->DBConect();
        $superArray['success'] = true;
        $superArray['mensaje'] = '';
        $superArray['combo'] = '';
        $superArray['sql'] = '';
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $usuario = $_SESSION['usuario'];
        header('Content-Type: text/html;charset=utf-8');
        $strSql = "SELECT s.id, s.apellidoyNombre, ts.valorCuota
                FROM socios s
                inner join tiposocio ts on ts.id = s.tipoSocioId
                Where activo='SI' AND bilbiotecaId=".$usuario['bibliotecaID'].'  ORDER BY apellidoyNombre';
        $superArray['sql'] = $strSql;
        try {
            $stmt = $dbConectado->prepare($strSql);
            $stmt->execute();
            $registro = $stmt->fetchAll();
            $combo = '<select id="'.$idCombo.'" style="width:100%;" tabindex="'.$tabIndex.'"><option value=0>Seleccione Socio </option>';
            if ($registro) {
                /* obtener los valores */
                foreach ($registro  as $row) {
                    $combo .= '<option value='.$row['id'].'>'.$row['apellidoyNombre'].'-(Valor Cuota:$'.$row['valorCuota'].')</option>';
                }
            }
            $combo .= '</select>';
            $superArray['combo'] = $combo;

            return json_encode($superArray);
        } catch (Throwable $e) {
            $trace = $e->getTrace();
            $superArray['success'] = false;
            $superArray['mensaje'] = $e->getMessage().' en '.$e->getFile().' en la linea '.$e->getLine().' llamado desde '.$trace[0]['file'].' on line '.$trace[0]['line'];
        }
        $Coneccion = null;

        return json_encode($superArray);
    }
    public function ComboSociosAbm($tabIndex,$idCombo)
    {
        $Coneccion = new Conexion();
        $dbConectado = $Coneccion->DBConect();
        $superArray['success'] = true;
        $superArray['mensaje'] = '';
        $superArray['combo'] = '';
        $superArray['sql'] = '';
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $usuario = $_SESSION['usuario'];
        header('Content-Type: text/html;charset=utf-8');
        $strSql = "SELECT s.id, s.apellidoyNombre, ts.valorCuota
                FROM socios s
                inner join tiposocio ts on ts.id = s.tipoSocioId
                Where activo='SI' AND bilbiotecaId=".$usuario['bibliotecaID'].'  ORDER BY apellidoyNombre';
        $superArray['sql'] = $strSql;
        try {
            $stmt = $dbConectado->prepare($strSql);
            $stmt->execute();
            $registro = $stmt->fetchAll();
            $combo = '<select id="'.$idCombo.'" style="width:100%;" data-placeholder="Seleccione un socio" ><option value=0>Seleccione Socio </option>';

            if ($registro) {
                /* obtener los valores */
                foreach ($registro  as $row) {
                    $combo .= '<option value='.$row["id"].'>'.$row["apellidoyNombre"].'-(Valor Cuota:$'.$row["valorCuota"].')</option>';
                }
            }
            $combo .= '</select>';
            $superArray['combo'] = $combo;

            return json_encode($superArray);
        } catch (Throwable $e) {
            $trace = $e->getTrace();
            $superArray['success'] = false;
            $superArray['mensaje'] = $e->getMessage().' en '.$e->getFile().' en la linea '.$e->getLine().' llamado desde '.$trace[0]['file'].' on line '.$trace[0]['line'];
        }
        $Coneccion = null;

        return json_encode($superArray);
    }
}
