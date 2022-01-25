<?php

namespace admin\Modelo;

require_once "../../../Class/Conexion.php";

use Class\Conexion;
use PDO;
use PDOException;
use Exception;
use Throwable;

class Rubros
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

   private function ArmarSqlInsert()
   {
      $strSql = 'INSERT INTO  rubros (titulo,subtitulo,descripcion,imagen,activo)
                    VALUES(           :titulo,:subtitulo,:descripcion,:imagen,:activo)';

      return $strSql;
   }

   private function ArmarSqlUpdate()
   {
      $strSql = 'UPDATE rubros SET  titulo = :titulo, subtitulo = :subtitulo,descripcion = :descripcion,imagen = :imagen, activo = :activo  Where id=:id';

      return $strSql;
   }
   private function ArmarSqlDelete()
   {
      return 'Delete FROM rubros Where id=:id';
   }
   public function Guardar($oData)
   {
      $superArray = array();
      $superArray['success'] = true;
      $conexion = new Conexion($superArray);
      $dbConectado = $conexion->DBConect($superArray);
      $superArray['mensaje'] = '';

      if ($oData->id > 0) :
         $strSql = $this->ArmarSqlUpdate();
      else :
         $strSql = $this->ArmarSqlInsert();
      endif;
      $superArray['$oData'] = $oData;
      $stmt = $dbConectado->prepare($strSql);

      if ($oData->id > 0) :
         $stmt->bindParam(':id', $oData->id, PDO::PARAM_INT);
      endif;
      $stmt->bindParam(':titulo', $oData->titulo, PDO::PARAM_STR);
      $stmt->bindParam(':subtitulo', $oData->subtitulo, PDO::PARAM_STR);
      $stmt->bindParam(':descripcion', $oData->descripcion, PDO::PARAM_STR);
      $stmt->bindParam(':imagen', $oData->imagen, PDO::PARAM_STR);
      $stmt->bindParam(':activo', $oData->activo);

      $dbConectado->beginTransaction();
      try {
         $stmt->execute();
         $dbConectado->commit();
      } catch (Exception $e) {
         $superArray['success'] = false;
         $superArray['mensaje'] = 'Error: ' . $e->getMessage();
         $dbConectado->rollBack();
      }

      $stmt = null;
      $dbConectado = null;

      return json_encode($superArray);
   }

   public function Eliminar($oData)
   {
      $superArray = array();
      $superArray['success'] = true;
      $conexion = new Conexion($superArray);
      $dbConectado = $conexion->DBConect($superArray);
      $superArray['mensaje'] = '';

      $strSql = $this->ArmarSqlDelete();
      $superArray['$oData'] = $oData;
      $stmt = $dbConectado->prepare($strSql);
      $stmt->bindParam(':id', $oData->id, PDO::PARAM_INT);

      $dbConectado->beginTransaction();
      try {
         $stmt->execute();
         $dbConectado->commit();
      } catch (Exception $e) {
         $superArray['success'] = false;
         $superArray['mensaje'] = 'Error: ' . $e->getMessage();
         $dbConectado->rollBack();
      }

      $stmt = null;
      $dbConectado = null;
      return json_encode($superArray);
   }

   public function LlenarGrilla()
   {
      $superArray = array();
      $sql = $this->SqlSelect();
      $sql .= ' ORDER BY  titulo';
      $tabla = '';

      try {
         $superArray['success'] = true;
         $conexion = new Conexion($superArray);
         $dbConectado = $conexion->DBConect($superArray);
         $stmt  = $dbConectado->prepare($sql);
         $stmt->execute();
         $registro = $stmt->fetchAll();

         if ($registro) :
            $tabla = '<div class="table-responsive">
                     <table class="table table-condensed  table-striped  table-bordered" id="idTabla">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">TITULO</th>
                            <th scope="col">SUBTITULO</th>
                            <th scope="col">DESCRIPCION</th>
                            <th scope="col">ACTIVO</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                <tbody>';

            if ($registro) :
               foreach ($registro  as $row) {
                  $encabezadoRow = '<tr id="' . $row['id'] . '"';
                  $encabezadoRow .= 'data-id="' . $row['id'] . '"';
                  $encabezadoRow .= 'data-titulo="' . $row['titulo'] . '"';
                  $encabezadoRow .= 'data-subtitulo="' . $row['subtitulo'] . '"';
                  $encabezadoRow .= 'data-descripcion="' . $row['descripcion'] . '"';
                  $encabezadoRow .= 'data-imagen="' . $row['imgen'] . '"';
                  $activo = 'NO';
                  if ($row['activo'] == -1) :
                     $activo = 'SI';
                  endif;
                  $encabezadoRow .= 'data-activo="' . $row['activo'] . '"';
                  $encabezadoRow .= '">';
                  $tabla .= $encabezadoRow . '<td>' . $row['titulo'] . '</td>';
                  $tabla .= '<td>' . $row['subtitulo'] . '</td>';
                  $tabla .= '<td>' . $row['descripcion'] . '</td>';
                  $tabla .= '<td>' . $activo . '</td>';
                  $tabla .= '<td><button type="button" title="Presione para modificar item" class="btn btn-primary edit" onclick="fnProcesaEditar(this)"  value="' . $row['id'] . '"><i class="fa fa-edit "></i></button>     ';
                  $tabla .= '<button type="button" title="Presione para eliminar item" class="btn btn-danger delete" onclick="fnProcesaEliminar(this)" value="' . $row['id'] . '"><i class="fa fa-eraser "></i> </button></td>';
                  $tabla .= '</tr>'; //nueva fila
               }
            endif;
            $tabla .= '</tbody>
                        </table>
                        </div>';

         endif;
      } catch (Throwable $e) {
         $trace = $e->getTrace();
         $elDato = $e->getMessage() . ' en ' . $e->getFile() . ' en la linea ' . $e->getLine() . ' llamado desde ' . $trace[0]['file'] . ' on line ' . $trace[0]['line'];
         $superArray['success'] = false;
         $superArray['mensaje'] = 'Message: ' . $e->getMessage();
      }
      $superArray['tabla'] = $tabla;
      return json_encode($superArray);
   }

   private function sqlSelect()
   {
      $sql = " SELECT  id,titulo,subtitulo,descripcion,imagen,activo  FROM rubros ";
      return $sql;
   }


   private function PasarRow($row)
   {
      return [
         'id' => $row['id'],
         'titulo' => $row['titulo'],
         'subtitulo' => $row['subtitulo'],
         'descripcion' => $row['descripcion'],
         'imagen' => $row['imagen'],
         'activo' => $row['activo']
      ];
   }
}
