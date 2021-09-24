<?php
  //  header("Content-type: application/json; charset=utf-8");
/*
 MANEJO DEL MODELO DE MATPEL
 */

require_once 'conexion.php';

class UserModelo
{
    public function Modificar($data)
    {
        $conexion = new Conexion();
        $dbConectado = $conexion->DBConect();
        $strSql = 'UPDATE usuarios SET nombre= :nombre,
                                             mail=:mail,
                                             pass=:pass,
                                             activo=:activo,
                                             cuartelID=:cuartelID,
                                             rol=:rol                          
                            WHERE id=:id';

        $stmt = $dbConectado->prepare($strSql);
        $stmt->bindParam(':nombre', $data['nombre'], PDO::PARAM_STR);
        $stmt->bindParam(':mail', $data['mail'], PDO::PARAM_STR);
        $stmt->bindParam(':pass', $data['pass'], PDO::PARAM_STR);
        $stmt->bindParam(':activo', $data['activo'], PDO::PARAM_STR);
        $stmt->bindParam(':bibliotecaID', $data['bibliotecaID'], PDO::PARAM_INT);
        $stmt->bindParam(':rol', $data['rol'], PDO::PARAM_INT);
        $stmt->bindParam(':id', $data['id'], PDO::PARAM_INT);

        /*Comienzo la transaccion */
        $dbConectado->beginTransaction();
        try {
            $stmt->execute();
            $Ejecucion = '1';
            $dbConectado->commit();
        } catch (Exception $e) {
            $Ejecucion = 'Error: '.$e->getMessage();
            $dbConectado->rollBack();
        }

        $stmt = null;
        $dbConectado = null;

        return $Ejecucion;
    }

    private function ArmarSqlInsert()
    {
        $strSql = 'INSERT INTO  socios (bilbiotecaId,
                                        numeroSocio,
                                        apellidoyNombre,
                                        telefono,
                                        mail,
                                        pass,
                                        sectorid,
                                        domicilio,
                                        localidadid,
                                        provinciaid,
                                        documento,
                                        activo,
                                        tipoSocioId,
                                        rol,
                                        pagaCuota)
                    VALUES( 
                            :bilbiotecaId,
                            :numeroSocio,
                            :apellidoyNombre,
                            :telefono,
                            :mail,
                            :pass,
                            :sectorid,
                            :domicilio,
                            :localidadid,
                            :provinciaid,
                            :documento,
                            :activo,
                            :tipoSocioId,
                            :rol,
                            :pagaCuota
                        )';

        return $strSql;
    }

    private function ArmarSqlUpdate()
    {
        $strSql = 'UPDATE socios SET    bilbiotecaId =:bilbiotecaId,
                                        numeroSocio  =:numeroSocio,
                                        apellidoyNombre=:apellidoyNombre,
                                        telefono=:telefono,
                                        mail=:mail,
                                        pass=:pass,
                                        sectorid=:sectorid,
                                        domicilio=:domicilio,
                                        localidadid=:localidadid,
                                        provinciaid=:provinciaid,
                                        documento=:documento,
                                        activo=:activo,
                                        tipoSocioId=:tipoSocioId,
                                        rol=:rol,
                                        pagaCuota=:pagaCuota
                        WHERE id=:id                    
                    ';

        return $strSql;
    }

    public function IngresoSocio($bibliotecaID, $data)
    {
        /* ACA INSERTAMOS LOS DATOS!!!! */

        $conexion = new Conexion();
        $dbConectado = $conexion->DBConect();
        $Ejecucion = '0';
        header('Content-Type: text/html;charset=utf-8');
        $superArray['success'] = true;
        $superArray['mensaje'] = '';
        $superArray['$data->numeroSocio'] = $data->numeroSocio;
        if ($data->id > 0) {
            $strSql = $this->ArmarSqlUpdate();
        } else {
            $strSql = $this->ArmarSqlInsert();
        }
        ////////////////ENCABEZADO

        $pass = base64_encode($data->pass);

        $stmt = $dbConectado->prepare($strSql);
        if ($data->id > 0) {
            $stmt->bindParam(':id', $data->id, PDO::PARAM_INT);
        }
        $stmt->bindParam(':bilbiotecaId', $bibliotecaID, PDO::PARAM_INT);
        $stmt->bindParam(':numeroSocio', $data->numeroSocio, PDO::PARAM_STR);
        $stmt->bindParam(':apellidoyNombre', $data->nombre, PDO::PARAM_STR);
        $stmt->bindParam(':telefono', $data->telefono, PDO::PARAM_STR);
        $stmt->bindParam(':mail', $data->mail, PDO::PARAM_STR);
        $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
        $stmt->bindParam(':sectorid', $data->sectorID, PDO::PARAM_INT);
        $stmt->bindParam(':domicilio', $data->domicilio, PDO::PARAM_STR);
        $stmt->bindParam(':localidadid', $data->localidadID, PDO::PARAM_INT);
        $stmt->bindParam(':provinciaid', $data->provinciaID, PDO::PARAM_INT);
        $stmt->bindParam(':documento', $data->documento, PDO::PARAM_STR);
        $stmt->bindParam(':activo', $data->activo, PDO::PARAM_STR);
        $stmt->bindParam(':tipoSocioId', $data->tipoSocioID, PDO::PARAM_INT);
        $stmt->bindParam(':rol', $data->rolID, PDO::PARAM_INT);
        $stmt->bindParam(':pagaCuota', $data->pagaCuota, PDO::PARAM_STR);

        /*
        $superArray['bilbiotecaId']=$bibliotecaID;
        $superArray['$data->nombre']=$data->nombre;
        $superArray['$data->mail']=$data->mail;
        $superArray['$pass']=$pass;
        $superArray['$data->pass']=$data->pass;

        $superArray['$data->sectorID']=$data->sectorID;
        $superArray['$data->domicilio']=$data->domicilio;
        $superArray['$data->localidadID']=$data->localidadID;
        $superArray['$data->provinciaID']=$data->provinciaID;
        $superArray['$data->documento']=$data->documento;
        $superArray['$data->activo']=$data->activo;
        $superArray['$data->tipoSocioID']=$data->tipoSocioID;
        $superArray['$data->rolID']=$data->rolID;
        $superArray[' $data->pagaCuota']= $data->pagaCuota;
        */

        //Comienzo la transaccion
        $dbConectado->beginTransaction();
        try {
            $stmt->execute();
            $Ejecucion = '1';
            $dbConectado->commit();
        } catch (Exception $e) {
            $superArray['success'] = false;
            $superArray['mensaje'] = 'Error: '.$e->getMessage();
            $dbConectado->rollBack();
        }

        $stmt = null;
        $dbConectado = null;

        return json_encode($superArray);

        /*
        $from = "soporte@rasoftware.com.ar";
        $to = $data['mail'];
        $subject = "SOFTWARE BIBLIOTECA -EL USUARIO:" . $data['nombre'] . "  fue ingresado al sistema datos" ;
        $message = "NUEVO INGRESO DE DATOS PARA EL USER:" .  $nombre ;
        $message = $message . "";
        $headers = "Desde:" . $from;
        mail($to,$subject,$message, $headers);

        $from = "soporte@rasoftware.com.ar";
        $to = 'soporte@rasoftware.com.ar';
        $subject = "SOFTWARE BIBLIOTECA  -EL USUARIO:" . $data['nombre'] . "  fue ingresado al sistema datos" ;
        $message = "NUEVO INGRESO DE DATOS PARA EL USER:" .  $nombre ;
        $message = $message . "";
        $headers = "Desde:" . $from;
        mail($to,$subject,$message, $headers);

        */
    }

    public function EliminarSocio($bibliotecaID, $data)
    {
        $conexion = new Conexion();
        $dbConectado = $conexion->DBConect();
        $superArray['success'] = true;
        $superArray['mensaje'] = '';
        $superArray[''] = '';

        $strSql = 'DELETE FROM socios   WHERE id=:id ';
        $stmt = $dbConectado->prepare($strSql);

        $stmt->bindParam(':id', $data->id, PDO::PARAM_INT);

        /*Comienzo la transaccion */
        $dbConectado->beginTransaction();
        try {
            $stmt->execute();
            $dbConectado->commit();
        } catch (Exception $e) {
            $superArray['success'] = false;
            $superArray['mensaje'] = 'Error: '.$e->getMessage();
            $dbConectado->rollBack();
        }
        $stmt = null;
        $dbConectado = null;

        return json_encode($superArray);
    }

    public function LlenarComboBiliotecas()
    {
        $Coneccion = new Conexion();
        $dbConectado = $Coneccion->DBConect();
        $strSql = 'SELECT id, nombre 
                    FROM biblioteca  
                    ORDER BY nombre ';
        try {
            $stmt = $dbConectado->prepare($strSql);
            $stmt->execute();
            $sunaCantidad = 0;
            $sumUnidad = 0;
            $sumaTotal = 0;
            $registro = $stmt->fetchAll();
            $tabla = '<div class="form-group">
                                <label for="cmbBilioteca">Selecione Biblioteca</label>
                                    <select class="form-control" id="cmbBiblioteca" require>';
            if ($registro) {
                /* obtener los valores */
                foreach ($registro  as $row) {
                    $tabla .= '<option value='.$row['id'].'>'.$row['nombre'].'</option>';
                }
            }
            $tabla .= '</select> </br><small>si no encuentra su biblioteca, envie sus datos a info@rasoftware.com.ar y será ingresado.</small> 
                              </div>';
        } catch (Throwable $e) {
            $trace = $e->getTrace();
            echo $e->getMessage().' en '.$e->getFile().' en la linea '.$e->getLine().' llamado desde '.$trace[0]['file'].' on line '.$trace[0]['line'];
        }
        $Coneccion = null;

        return $tabla;
    }

    public function LlenarGrilla($bibliotecaID)
    {
        $Coneccion = new Conexion();
        $dbConectado = $Coneccion->DBConect();

        $superArray['success'] = true;
        $superArray['mensaje'] = '';
        $superArray['tabla'] = '';
        $bibliotecalID = $bibliotecaID;

        $strSql = $this->ARMAR_SQL_SELECT();
        $strSql .= '    WHERE  S.bilbiotecaId=:bibliotecaID
                                ORDER by apellidoyNombre';
        $tabla = '';
        try {
            $stmt = $dbConectado->prepare($strSql);
            $stmt->bindParam(':bibliotecaID', $bibliotecalID, PDO::PARAM_INT);
            $stmt->execute();
            $registro = $stmt->fetchAll();
            $tabla = '<div class="table-responsive">
                     <table class="table table-condensed  table-striped  table-bordered" id="idTablaUser">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">DOCUMENTO</th>
                            <th scope="col">NOMBRE</th>
                            <th scope="col">TELEFONO</th> 
                            <th scope="col">MAIL</th>
                            <th scope="col">PASS</th>
                            <th scope="col">SECTOR</th>
                            <th scope="col">DOMICILIO</th>
                            <th scope="col">I/G</th>
                            <th scope="col">ACTIVO</th>
                            <th scope="col">TIPO SOCIO</th>
                            <th scope="col">PAGA CUOTA</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                <tbody>';

            if ($registro) {
                /* obtener los valores */

                foreach ($registro  as $row) {
                    $encabezadoRow = '<tr id="user-'.$row['id'].'"';
                    $encabezadoRow .= 'data-id="'.$row['id'].'"';
                    $encabezadoRow .= 'data-bibliotecaid="'.$row['bilbiotecaId'].'"';
                    $encabezadoRow .= 'data-blibioteca="'.$row['biblioteca'].'"';
                    $encabezadoRow .= 'data-apellidoyNombre="'.$row['apellidoyNombre'].'"';
                    $encabezadoRow .= 'data-numerosocio="'.$row['numeroSocio'].'"';
                    $encabezadoRow .= 'data-telefono="'.$row['telefono'].'"';
                    $encabezadoRow .= 'data-mail="'.$row['mail'].'"';
                    $encabezadoRow .= 'data-pass="'.base64_decode($row['pass']).'"';
                    $encabezadoRow .= 'data-sectorid="'.$row['sectorid'].'"';
                    $encabezadoRow .= 'data-sector="'.$row['sector'].'"';
                    $encabezadoRow .= 'data-domicilio="'.$row['domicilio'].'"';
                    $encabezadoRow .= 'data-localidad="'.$row['localidad'].'"';
                    $encabezadoRow .= 'data-provincia="'.$row['provincia'].'"';
                    $encabezadoRow .= 'data-localidadid="'.$row['localidadid'].'"';
                    $encabezadoRow .= 'data-provinciaid="'.$row['provinciaid'].'"';
                    $encabezadoRow .= 'data-documento="'.$row['documento'].'"';
                    $encabezadoRow .= 'data-individualgrupal="'.$row['individualgrupal'].'"';
                    $encabezadoRow .= 'data-activo="'.$row['activo'].'"';
                    $encabezadoRow .= 'data-tiposocioId="'.$row['tipoSocioId'].'"';
                    $encabezadoRow .= 'data-tiposocio="'.$row['tipoSocio'].'"';
                    $encabezadoRow .= 'data-valorcuota="'.$row['valorCuota'].'"';
                    $encabezadoRow .= 'data-rol="'.$row['rol'].'"';
                    $encabezadoRow .= 'data-pagacuota="'.$row['pagaCuota'].'"';
                    $encabezadoRow .= '">';
                    $tabla .= $encabezadoRow.'<td>'.$row['documento'].'</td>';
                    $tabla .= '<td>'.$row['apellidoyNombre'].' -'.$row['numeroSocio'].'</td>';
                    $tabla .= '<td>'.$row['telefono'].'</td>';
                    $tabla .= '<td>'.$row['mail'].'</td>';
                    $tabla .= '<td>'.base64_decode($row['pass']).'</td>';
                    $tabla .= '<td>'.$row['sector'].'</td>';
                    $tabla .= '<td>'.$row['domicilio'].'-'.$row['localidad'].'</td>';
                    $tabla .= '<td>'.$row['individualgrupal'].'</td>';
                    $tabla .= '<td>'.$row['activo'].'</td>';
                    $tabla .= '<td>'.$row['tipoSocio'].'</td>';
                    $tabla .= '<td>'.$row['pagaCuota'].'</td>';
                    $tabla .= '<td><button type="button" title="Presione para modificar el usuario" class="btn btn-primary edit" onclick="fnProcesaEditar(this)"  value="'.$row['id'].'"><i class="fa fa-edit "></i></button> </td>';
                    $tabla .= '<td><button type="button" title="Presione para eliminar el usuario" class="btn btn-danger delete" onclick="fnProcesaEliminar(this)" value="'.$row['id'].'"><i class="fa fa-eraser "></i></button></td>';
                    $tabla .= '</tr>'; //nueva fila
                }
            }
            $tabla .= '</tbody> 
                        </table>
                        </div>';
        } catch (Throwable $e) {
            $superArray['success'] = false;

            $trace = $e->getTrace();
            $superArray['mensaje'] = $e->getMessage().' en '.$e->getFile().' en la linea '.$e->getLine().' llamado desde '.$trace[0]['file'].' on line '.$trace[0]['line'];
        }
        $superArray['tabla'] = $tabla;

        $Coneccion = null;

        return json_encode($superArray);
    }

    public function BuscarxDNI($data)
    {
        $strtabla = '';
        $Coneccion = new Conexion();
        $dbConectado = $Coneccion->DBConect();

        $bibliotecaID = $data['bibliotecaID'];
        $documento = $data['documento'];

        $superArray['success'] = true;
        $superArray['encontrado'] = false;
        $superArray['mensaje'] = '';
        $bibliotecalID = $bibliotecaID;

        $strSql = $this->ARMAR_SQL_SELECT();
        $strSql .= '    WHERE  S.bilbiotecaId=:bibliotecaID
                            AND     S.documento =:documento
                            ORDER by apellidoyNombre';

        try {
            $stmt = $dbConectado->prepare($strSql);
            $stmt->bindParam(':bibliotecaID', $bibliotecalID, PDO::PARAM_INT);
            $stmt->bindParam(':documento', $documento, PDO::PARAM_INT);
            $stmt->execute();
            $registro = $stmt->fetchAll();
            if ($registro) {
                $superArray['encontrado'] = true;
                foreach ($registro  as $row) {
                    $superSocio['id'] = $row['id'];
                    $superSocio['bilbiotecaId'] = $row['bilbiotecaId'];
                    $superSocio['biblioteca'] = $row['biblioteca'];
                    $superSocio['apellidoyNombre'] = $row['apellidoyNombre'];
                    $superSocio['telefono'] = $row['telefono'];
                    $superSocio['mail'] = $row['mail'];
                    $superSocio['pass'] = base64_decode($row['pass']);
                    $superSocio['sectorid'] = $row['sectorid'];
                    $superSocio['sector'] = $row['sector'];
                    $superSocio['domicilio'] = $row['domicilio'];
                    $superSocio['localidad'] = $row['localidad'];
                    $superSocio['provincia'] = $row['provincia'];
                    $superSocio['localidadid'] = $row['localidadid'];
                    $superSocio['provinciaid'] = $row['provinciaid'];
                    $superSocio['documento'] = $row['documento'];
                    $superSocio['individualgrupal'] = $row['individualgrupal'];
                    $superSocio['tipoSocioId'] = $row['tipoSocioId'];
                    $superSocio['tipoSocio'] = $row['tipoSocio'];
                    $superSocio['valorCuota'] = $row['valorCuota'];
                    $superSocio['rol'] = $row['rol'];
                    $superSocio['pagacuota'] = $row['pagaCuota'];
                    array_push($superArray, $superSocio);
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

    public function ARMAR_SQL_SELECT()
    {
        $sql = "SELECT  S.id, 
                            S.bilbiotecaId,
                            IFNULL(numeroSocio,'') as numeroSocio  ,
                            upper(B.nombre) as biblioteca,
                            S.apellidoyNombre,
                            IFNULL(S.telefono,'') as telefono,
                            S.mail,
                            S.pass,
                            S.mail,
                            S.sectorid,
                            IFNULL(UPPER(Se.descripcion),'')  as sector,
                            S.domicilio,
                            S.localidadid,
                            IFNULL(UPPER(Lo.descripcion),'')  as localidad,
                            S.provinciaid,
                            IFNULL(UPPER( Pro.descripcion),'')   as provincia,
                            S.documento,
                            S.individualgrupal,
                            S.activo,
                            S.tipoSocioId,
                            IFNULL(UPPER(  Ts.descripcion),'')  as tipoSocio,
                            IFNULL(UPPER( Ts.valorCuota),0)  as valorCuota,
                            S.rol,
                            IFNULL(UPPER(pagaCuota),'SI') as pagaCuota,
                             IFNULL(UPPER(B.nombre),'')   as biblioteca,
                            IFNULL(UPPER(B.direccion),'') 	as biblioteca_direccion,
                                    IFNULL(UPPER(B.mail),'') 	as biblioteca_mail,
                            IFNULL(UPPER(B.nombreContacto),'') 	as biblioteca_contacto,
                            IFNULL(UPPER(B.telContacto),'') 	as biblioteca_telContacto

                    FROM socios S
                        left join sector Se on Se.id=S.sectorid
                        left join localidades Lo on Lo.id =S.localidadid
                        left join provincias Pro on Pro.id = S.provinciaid
                        left join tiposocio Ts on Ts.id = S.tipoSocioId
                        inner join  biblioteca B on B.id = S.bilbiotecaId";

        return $sql;
    }

    /*======================================================================================================================*/
    /*VALIDAR PASSWORD!*/
    /*======================================================================================================================*/
    public function validarPasswordModelo($mailweb, $pass, $bibliotecaId)
    {
        header('Content-type: application/json; charset=utf-8');

        $UsuarioNombre = strtoupper($mailweb);
        $pass = base64_encode($pass);

        $Coneccion = new Conexion();

        $jsondata['success'] = false;

        $strSql = $this->ARMAR_SQL_SELECT();
        $strSql .= "    WHERE  S.mail=:mail
                          AND   S.pass=:pass
                          AND   S.bilbiotecaId=:bibliotecaID
                          AND S.activo ='SI'
                                LIMIT 1;                    
                                ";
        // Start the session
        // $jsondata['sql'] = $strSql;

        session_start();
        $usuario = ['bibliotecaID' => 0,
                    'id' => 0,
                    'apellidoyNombre' => '',
                    'mail' => '',
                    'activo' => 'NO',
                    'rol' => 0,
                    'sectorid' => 0,
                    'sector' => '',
                    'domicilio' => '',
                    'localidadId' => 0,
                    'localidad' => '',
                    'provinciaId' => 0,
                    'provincia' => '',
                    'documento' => '',
                    'individualgrupal' => '',
                    'tipoSocioId' => 0,
                    'tipoSocio' => '',
                    'valorCuota' => 0,
                    'pagaCuota' => 'SI',
            ];
        $_SESSION['usuario'] = $usuario;

        $biblioteca = ['id' => 0,
                       'nombre' => '',
                       'direccion' => '',
                       'mail' => '',
                       'nombreContacto' => '',
                       'telContacto' => '',
            ];
        $_SESSION['biblioteca'] = $biblioteca;

        try {
            $stmt = $Coneccion->DBConect()->prepare($strSql);
            $jsondata['mail'] = $mailweb;
            $jsondata['pass'] = $pass;
            $jsondata['bibliotecaID'] = $bibliotecaId;

            $stmt->bindParam(':mail', $mailweb, PDO::PARAM_STR);
            $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
            $stmt->bindParam(':bibliotecaID', $bibliotecaId, PDO::PARAM_INT);

            $stmt->execute();
            $jsondata['success'] = true;
            $jsondata['error'] = '';

            $registro = $stmt->fetchAll();

            if ($registro) {
                foreach ($registro  as $row) {
                    $usuario = ['bibliotecaID' => $row['bilbiotecaId'],
                                'id' => $row['id'],
                                'apellidoyNombre' => $row['apellidoyNombre'],
                                'mail' => $row['mail'],
                                'activo' => $row['activo'],
                                'rol' => $row['rol'],
                                'sectorid' => $row['sectorid'],
                                'sector' => $row['sector'],
                                'domicilio' => $row['domicilio'],
                                'localidadId' => $row['localidadid'],
                                'provinciaId' => $row['provinciaid'],
                                'provincia' => $row['provincia'],
                                'documento' => $row['documento'],
                                'individualgrupal' => $row['individualgrupal'],
                                'tipoSocioId' => $row['tipoSocioId'],
                                'tipoSocio' => $row['tipoSocio'],
                                'valorCuota' => $row['valorCuota'],
                                'pagaCuota' => $row['pagaCuota'],
                            ];
                    $biblioteca = [
                                'id' => $row['bilbiotecaId'],
                                 'nombre' => $row['biblioteca'],
                                 'direccion' => $row['biblioteca_direccion'],
                                 'mail' => $row['biblioteca_mail'],
                                 'nombreContacto' => $row['biblioteca_contacto'],
                                 'telContacto' => $row['biblioteca_telContacto'],
                                ];
                }
                $_SESSION['usuario'] = $usuario;
                $_SESSION['biblioteca'] = $biblioteca;
                $jsondata['path'] = 'vista/index.php?controlador=panel'; //COINCIDEN LAS CLAVES!
            } else {
                $jsondata['success'] = false;
                $jsondata['error'] = 'Usuario o contraseña incorrento';
                $jsondata['path'] = '#';
            }
        } catch (Throwable $e) {
            $trace = $e->getTrace();
            $elDato = $e->getMessage().' en '.$e->getFile().' en la linea '.$e->getLine().' llamado desde '.$trace[0]['file'].' on line '.$trace[0]['line'];
            $jsondata['success'] = false;
            $jsondata['error'] = 'Message: '.$e->getMessage();
            $jsondata['path'] = '#';
        }

        return json_encode($jsondata);
        $Coneccion = null;
    }

    public function TraerPass($mail)
    {
        $Coneccion = new Conexion();
        echo $mail;
        $strSql = 'SELECT U.id,U.pass, U.mail  FROM  socios U WHERE U.mail=:mail LIMIT 1;';
        $elDato = array();
        try {
            $stmt = $Coneccion->DBConect()->prepare($strSql);
            $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
            $elDato = '0';
            $stmt->execute();
        } catch (Throwable $e) {
            $trace = $e->getTrace();
            $registro = $e->getMessage().' en '.$e->getFile().' en la linea '.$e->getLine().' llamado desde '.$trace[0]['file'].' on line '.$trace[0]['line'];

            return $elDato;
            exit();
        }

        $registro = $stmt->fetchAll();
        $pass = '';
        if ($registro) {
            /* obtener los valores */
            foreach ($registro  as $row) {
                $pass = base64_decode($row['pass']);
            }
        }
        if ($pass == '') {
            return 'NO SE ENCONTRO EL PASSWORD O EL USUARIO, envie un mail con sus datos a info@rasiftware.com.ar';
            exit();
        }

        ini_set('display_errors', 1);
        error_reporting(E_ALL);
        $from = 'noresponder@bmp51.com';
        $to = $mail;
        $subject = 'SOFTWARE Biblioteca - Su Pedido de Pass';
        $message = 'UD. A pedido el reenvio de su password, el mismo es:'.$pass.'  ahora puede ingresar con su mail y password en biblio.rasoftware.com.ar ';
        $message = $message.'';
        $headers = 'Desde:'.$from;

        mail($to, $subject, $message, $headers);
        $mensajeEnviado = 'El mensaje fue enviado exitosamente, revise su casilla de correo';

        return $mensajeEnviado;
        $Coneccion = null;
    }

    public function UserEdit($nombre, $pass, $id)
    {
        $Coneccion = new Conexion();
        $pass = base64_encode($pass);
        $strSql = 'Update  usuarios set nombre=:nombre,pass=:pass where id=:id;';
        $elDato = array();
        try {
            $stmt = $Coneccion->DBConect()->prepare($strSql);
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            $elDato = '0';
            $stmt->execute();
        } catch (Throwable $e) {
            $trace = $e->getTrace();
            $registro = $e->getMessage().' en '.$e->getFile().' en la linea '.$e->getLine().' llamado desde '.$trace[0]['file'].' on line '.$trace[0]['line'];

            return $elDato;
            exit();
        }

        session_start();
        $usuario = ['nombre' => $nombre];
        $_SESSION['usuario'] = $usuario;

        ini_set('display_errors', 1);
        error_reporting(E_ALL);
        $from = 'dieghard@gmail.com';
        $to = 'dieghard@gmail.com';
        $subject = 'SOFTWARE BIBLIO -EL USUARIO:'.$nombre.' a editado sus datos';
        $message = 'CAMBIO DE DATOS PARA EL USER:'.$nombre;
        $message = $message.'';
        $headers = 'Desde:'.$from;
        mail($to, $subject, $message, $headers);

        $elDato = '1';

        return $elDato;

        $Coneccion = null;
    }
}
