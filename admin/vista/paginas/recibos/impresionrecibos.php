<?php

require 'fpdf/fpdf.php';
require_once '../../../modelo/conexion.php';

$action = $_GET['ACTION'];

$superArray['mensaje'] = '';
$superArray['success'] = false;


if ($action == 'impresionRecibos') {
    $socioID = $_GET['socioID'];
    $mesImpresion = $_GET['mesImpresion'];
    $anioImpresion = $_GET['anioImpresion'];
    $numeroRecibo = $_GET['numeroReciboImpresion'];
    $sectorImpresion  = $_GET['sectorImpresion'];
}

$strSql = "SELECT mov.id,
		        IFNULL(S.nombreyapellido,'') as socio,
                IFNULL(S.numeroSocio,'') as numeroSocio,
                IFNULL(tS.descripcion,'') as tipoSocio ,
                IFNULL(mov.ReciboCobro,'') as reciboCobro,
                IFNULL(S.domicilio,'') as domicilio,
                IFNULL(se.descripcion,'') as sector,
		        IFNULL(mov.NumeroReciboPagado,'') as reciboPagado,
                mov.fecha,
                mov.periodoMes,
                mov.periodoAnio,
                mov.socioId,
                mov.debe,
                mov.haber,
                (select saldo from movimientos where socioId = mov.socioId order by id DESC  limit 1)  as saldo
            FROM movimientos mov
            INNER join socios S on S.id = mov.socioId
            INNER join tiposocio tS on tS.id = S.tipoSocioId
            INNER join sector se on se.id = S.sectorid
            WHERE IFNULL(mov.Eliminado,'NO')='NO' ";
if ($socioID > 0) {
    $strSql .= " AND S.id=" . $socioID;
}
if ($mesImpresion > 0) {
    $strSql .= " AND mov.periodoMes=" . $mesImpresion;
}
if ($anioImpresion > 0) {
    $strSql .= " AND mov.periodoAnio=" . $anioImpresion;
}
if ($numeroRecibo > 0) {
    $strSql .= " AND mov.id=" . $numeroRecibo;
}
if ($sectorImpresion > 0) {
    $strSql .= " AND S.sectorid=" . $sectorImpresion;
}
//echo    ($strSql);
$coneccion = new Conexion();
$dbConectado = $coneccion->DBConect();

$pdf = new FPDF();
$pdf->SetFont('Arial', '', 10);
$data['socio'] = '';
$data['nsocio'] = '0';
$data['tipoSocio'] = '';
$data['domicilio'] = '';
$data['sector'] = '';
$data['saldoAnterior'] = '0';
$data['periodo'] = '';
$data['saldoActual'] = '0';
$data['fecha'] = '';
$data['numeroRecibo'] = '0';
$lineaY_izquierda = 2;
$lineaY_derecha = 2;
$correarALaDerecha = 120;
$renglonesHaciaAbajo = 8;
$pdf->AddPage();
$lineaX = 10;
try {
    $stmt = $dbConectado->prepare($strSql);
    $stmt->execute();
    $registro = $stmt->fetchAll();
    $contador = 1;
    if ($registro) {
        foreach ($registro  as $row) {
            $data['socio'] = $row['socio'];
            $data['nsocio'] = $row['numeroSocio'];
            $data['tipoSocio'] = $row['tipoSocio'];
            $data['domicilio'] = $row['domicilio'];
            $data['sector'] = $row['sector'];
            $data['saldoAnterior'] = $row['saldo'];
            $data['periodo'] = $row['periodoMes'] . '/' . $row['periodoAnio'];
            $data['saldoActual'] = $row['debe'];
            $data['fecha'] = $row['fecha'];
            $data['numeroRecibo'] = $row['id'];
            //impresion
            $lineaY_izquierda = $lineaY_izquierda + $renglonesHaciaAbajo;
            $lineaY_derecha = $lineaY_derecha + $renglonesHaciaAbajo;
            $lineaY_izquierda = Crear_Recibo($pdf, $lineaX, $lineaY_izquierda, $data);
            $lineaY_derecha = Crear_Recibo($pdf, $lineaX + $correarALaDerecha, $lineaY_derecha, $data);
            $contador++;
            if ($contador == 6) {
                $contador = 1;
                $lineaY_izquierda = 2;
                $lineaY_derecha = 2;
                $correarALaDerecha = 120;
                $renglonesHaciaAbajo = 7;
                $pdf->AddPage();
                $lineaX = 10;
            }
        }
    }
} catch (Throwable $e) {
    $superArray['success'] = false;
    $trace = $e->getTrace();
    echo $e->getMessage() . ' en ' . $e->getFile() . ' en la linea ' . $e->getLine() . ' llamado desde ' . $trace[0]['file'] . ' on line ' . $trace[0]['line'];
}

$pdf->Output();
$coneccion = null;

function crear_Recibo($pdf, $lineaX, $lineaY, $data)
{

    $pdf->SetXY($lineaX, $lineaY);
    $pdf->Cell(40, 1, utf8_decode('Biblioteca Popular Florentino Ameghino'), 0, 0, 'L');

    $pdf->SetFont('Arial', 'B', 6);

    $lineaY = $lineaY + 1;
    $pdf->SetXY($lineaX, $lineaY);
    $pdf->Cell(50, 5, utf8_decode('Rivadavia 10 - Gral. Levalle (Cba)'), 0, 0, 'L');

    $lineaY = $lineaY + 4;
    $pdf->SetXY($lineaX, $lineaY);
    $pdf->Cell(50, 5, utf8_decode('Tel.03385-480737 CUIT 30-66878313-5'), 0, 0, 'L');

    $pdf->SetFont('Arial', '', 8);
    $lineaY = $lineaY + 4;
    $pdf->SetXY($lineaX, $lineaY);
    $pdf->Cell(50, 5, utf8_decode('Socio:' . $data['socio']), 0, 0, 'L');

    $lineaY = $lineaY + 4;
    $pdf->SetXY($lineaX, $lineaY);
    $pdf->Cell(50, 5, utf8_decode('N°:Socio:'  . $data['nsocio']), '0', 0, 'L');

    //$lineaY   = $lineaY   + 4;
    $pdf->SetXY($lineaX + 24, $lineaY);
    $pdf->Cell(50, 5, utf8_decode('Tipo:' . $data['tipoSocio']), '0', 0, 'L');

    $lineaY = $lineaY + 4;
    $pdf->SetXY($lineaX, $lineaY);
    $pdf->Cell(10, 5, utf8_decode('Dom:' . $data['domicilio']), 0, 0, 'L');

    //$lineaY   = $lineaY   + 4;
    $pdf->SetXY($lineaX + 34, $lineaY);
    $pdf->Cell(50, 5, utf8_decode('Sector:' . $data['sector']), '0', 0, 'L');

    $lineaY = $lineaY + 4;
    $pdf->SetXY($lineaX, $lineaY);
    $pdf->Cell(50, 5, utf8_decode('Saldo Anterior:' . $data['saldoAnterior']), 0, 0, 'L');

    $lineaY = $lineaY + 4;
    $pdf->SetXY($lineaX, $lineaY);
    $pdf->Cell(50, 5, utf8_decode('Periodo:' . $data['periodo']), 0, 0, 'L');

    $lineaY = $lineaY + 4;
    $pdf->SetXY($lineaX, $lineaY);
    $pdf->Cell(50, 5, utf8_decode('Saldo Actual:' . $data['saldoActual']), 0, 0, 'L');

    $lineaY = $lineaY + 4;
    $pdf->SetXY($lineaX, $lineaY);
    $pdf->Cell(50, 5, utf8_decode('Recibi Pesos:'), 0, 0, 'L');

    /*    $lineaY = $lineaY + 4;
    $pdf->SetXY($lineaX, $lineaY);
    $pdf->Cell(50, 5, utf8_decode('Son:$'), 0, 0, 'L');
*/
    $lineaY = $lineaY + 4;
    $pdf->SetXY($lineaX, $lineaY);
    $pdf->Cell(50, 5, utf8_decode('Fecha:' . $data['fecha']), 0, 0, 'L');

    $lineaY = $lineaY + 4;
    $pdf->SetXY($lineaX, $lineaY);
    $pdf->Cell(50, 5, utf8_decode('Recibo N°:' . $data['numeroRecibo']), 0, 0, 'L');

    $lineaY = $lineaY + 4;
    $pdf->SetXY($lineaX, $lineaY);
    $pdf->Cell(50, 5, utf8_decode('-------------------------------------------------------------------------------------------------------'), 0, 0, 'L');
    return $lineaY;
}
//============================================================+
// END OF FILE
//============================================================+
