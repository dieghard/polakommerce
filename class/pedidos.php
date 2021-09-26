<?php

namespace Class;

use Class\Conexion;

class Pedidos
{
    private $_id;
    private $_fecha;
    private $_nombre;
    private $_apellido;
    private $_dni;
    private $_pais;
    private $_direccion;
    private $_numero;
    private $_departamento;
    private $_ciudad;
    private $_codigo_postal;
    private $_telefono;
    private $_email;
    private $_observaciones;
    private $_estado;
    private $_codigoDescuento;
    private $_pagado;
    private $_subtotal;
    private $_descuento;
    private $_total;

    const TABLA = 'pedidos';

    public function getId()
    {
        return $this->_id;
    }
    public function setId($id)
    {
        $this->_id = $id;
    }

    public function getFecha()
    {
        return $this->_fecha;
    }
    public function setFecha($fecha)
    {
        $this->_fecha = $fecha;
    }

    public function getNombre()
    {
        return $this->_nombre;
    }
    public function setNombre($nombre)
    {
        $this->_nombre = $nombre;
    }

    public function getApellido()
    {
        return $this->_apellido;
    }
    public function setApellido($apellido)
    {
        $this->_apellido = $apellido;
    }

    public function getDni()
    {
        return $this->_dni;
    }
    public function setDni($dni)
    {
        $this->_dni = $dni;
    }

    public function getPais()
    {
        return $this->_pais;
    }
    public function setPais($pais)
    {
        $this->_pais = $pais;
    }

    public function getDireccion()
    {
        return $this->_direccion;
    }
    public function setDireccion($direccion)
    {
        $this->_direccion = $direccion;
    }

    public function getNumero()
    {
        return $this->_numero;
    }
    public function setNumero($numero)
    {
        $this->_numero = $numero;
    }

    public function getDepartamento()
    {
        return $this->_departamento;
    }
    public function setDepartamento($departamento)
    {
        $this->_departamento = $departamento;
    }

    public function getCiudad()
    {
        return $this->_ciudad;
    }
    public function setCiudad($ciudad)
    {
        $this->_ciudad = $ciudad;
    }

    public function getcodigo_postal()
    {
        return $this->_codigo_postal;
    }
    public function setcodigo_postal($codigo_postal)
    {
        $this->_codigo_postal = $codigo_postal;
    }

    public function getTelefono()
    {
        return $this->_telefono;
    }
    public function setTelefono($telefono)
    {
        $this->_telefono = $telefono;
    }

    public function getEmail()
    {
        return $this->_email;
    }
    public function setEmail($email)
    {
        $this->_email = $email;
    }

    public function getObservaciones()
    {
        return $this->_observaciones;
    }
    public function setObservaciones($observaciones)
    {
        $this->_observaciones = $observaciones;
    }

    public function getEstado()
    {
        return $this->_estado;
    }
    public function setEstado($estado)
    {
        $this->_estado = $estado;
    }

    public function getCodigoDescuento()
    {
        return $this->_codigoDescuento;
    }
    public function setCodigoDescuento($codigoDescuento)
    {
        $this->_codigoDescuento = $codigoDescuento;
    }

    public function getPagado()
    {
        return $this->_pagado;
    }
    public function setPagado($pagado)
    {
        $this->_pagado = $pagado;
    }

    public function getSubtotal()
    {
        return $this->_subtotal;
    }
    public function setSubtotal($subtotal)
    {
        $this->_subtotal = $subtotal;
    }

    public function getDescuento()
    {
        return $this->_descuento;
    }
    public function setDescuento($descuento)
    {
        $this->_descuento = $descuento;
    }


    public function getTotal()
    {
        return $this->_total;
    }
    public function setTotal($total)
    {
        $this->_total = $total;
    }

    public function __construct(
        int $id = null,
        $_fecha = NULL,
        string $_nombre   = '',
        string $_apellido = '',
        string $_dni = '',
        string $_pais = '',
        string $_direccion = '',
        string $_numero    = '',
        string $_departamento = '',
        string $_ciudad = '',
        string $_codigo_postal = '',
        string $_telefono = '',
        string $_email = '',
        string $_observaciones = '',
        string $_estado = 'NUEVO',
        string $_pagado = 'NO',
        string $_codigoDescuento = '',
        $_subtotal = 0,
        $_descuento = 0,
        $_total = 0
    ) {


        $this->id = $id;
        $this->_fecha = $_fecha;
        $this->_nombre   = $_nombre;
        $this->_apellido = $_apellido;
        $this->_dni = $_dni;
        $this->_pais = $_pais;
        $this->_direccion = $_direccion;
        $this->_numero = $_numero;
        $this->_departamento = $_departamento;
        $this->_ciudad = $_ciudad;
        $this->_codigo_postal = $_codigo_postal;
        $this->_telefono = $_telefono;
        $this->_email = $_email;
        $this->_observaciones = $_observaciones;
        $this->_estado = $_estado;
        $this->_pagado = $_pagado;
        $this->_codigoDescuento = $_codigoDescuento;
        $this->_subtotal = $_subtotal;
        $this->_descuento = $_descuento;
        $this->_total = $_total;

        require_once 'conexion.php';
        $this->datos = array();
    }

    private function sqlUpdateEncabezado()
    {
        return 'UPDATE ' . self::TABLA . '
                SET
                fecha    = :fecha,
                nombre = :nombre,
                apellido = :apellido,
                dni = :dni,
                pais = :pais,
                direccion = :direccion,
                numero = :numero,
                departamento = :departamento,
                ciudad = :ciudad,
                codigo_postal = :codigo_postal,
                telefono = :telefono,
                email = :email,
                observaciones = :observaciones,
                estado = :estado,
                pagado = :pagado,
                subtotal = :subtotal,
                descuento = :descuento,
                total = :total,
                codigoDescuento = :codigoDescuento,
                WHERE id = :id';
    }

    private function sqlInsertEncabezado()
    {
        return 'INSERT INTO ' . self::TABLA . '(
                fecha    ,
                nombre ,
                apellido ,
                dni ,
                pais ,
                direccion ,
                numero ,
                departamento ,
                ciudad ,
                codigo_postal ,
                telefono ,
                email ,
                observaciones ,
                estado ,
                pagado ,
                subtotal ,
                descuento ,
                total ,
                codigoDescuento )

                VALUES(

                :fecha,
                :nombre,
                :apellido,
                :dni,
                :pais,
                :direccion,
                :numero,
                :departamento,
                :ciudad,
                :codigo_postal,
                :telefono,
                :email,
                :observaciones,
                :estado,
                :pagado,
                :subtotal,
                :descuento,
                :total,
                :codigoDescuento)';
    }

    private function sqlInsertDetalle()
    {
        return 'INSERT INTO pedidos_det( pedido_id,  producto_id,cantidad,  precio, porcentaje_descuento, descuento, subtotal, total )
                VALUES                 (:pedido_id,:producto_id,:cantidad,:precio,:porcentaje_descuento, :descuento,:subtotal,:total)';
    }
    public function enviarMails()
    {
    }
    public function guardar()
    {

        $superArray =  array();
        $superArray['success'] = true;
        $conexion = new Conexion($superArray);
        $dbConectado = $conexion->DBConect($superArray);

        if ($this->id) :
            $consulta = $dbConectado->prepare($this->sqlUpdateEncabezado());
        else :
            $consulta = $dbConectado->prepare($this->sqlInsertEncabezado());
        endif;

        $consulta->bindParam(':fecha', $this->_fecha);
        $consulta->bindParam(':nombre', $this->_nombre);
        $consulta->bindParam(':apellido', $this->_apellido);
        $consulta->bindParam(':dni', $this->_dni);
        $consulta->bindParam(':pais', $this->_pais);
        $consulta->bindParam(':direccion', $this->_direccion);
        $consulta->bindParam(':numero', $this->_numero);
        $consulta->bindParam(':departamento', $this->_departamento);
        $consulta->bindParam(':ciudad', $this->_ciudad);
        $consulta->bindParam(':codigo_postal', $this->_codigo_postal);
        $consulta->bindParam(':telefono', $this->_telefono);
        $consulta->bindParam(':email', $this->_email);
        $consulta->bindParam(':observaciones', $this->_observaciones);
        $consulta->bindParam(':estado', $this->_estado);
        $consulta->bindParam(':pagado', $this->_pagado);
        $consulta->bindParam(':subtotal', $this->_subtotal);
        $consulta->bindParam(':descuento', $this->_descuento);
        $consulta->bindParam(':total', $this->_total);
        $consulta->bindParam(':codigoDescuento', $this->_codigoDescuento);

        if ($this->id > 0) :
            $consulta->bindParam(':id', $this->id);
        endif;
        try {
            $dbConectado->beginTransaction();
            $consulta->execute();

            if (!$this->id > 0) :
                $this->id = $dbConectado->lastInsertId();
                $idEncabezado = $this->id;
            endif;
        } catch (PDOException $pdoe) {
            $dbConectado->rollback();
            $superArray['ERROR'] = "Mensaje de Error: " . $pdoe->getMessage();
            $superArray['success'] = false;
            $dbConectado = null;
            return $superArray;
        }

        $_SESSION['pedido']['numeroPedido']  = $idEncabezado;
        foreach ($_SESSION['carro'] as $detalle) :
            $pedidoid   = $idEncabezado;
            $productoid = $detalle["id"];
            $cantidad   =  $detalle["cantidad"];
            $precio     =  $detalle["precio"];
            $porcdesc   = 0;
            $descuento  = 0;
            $subtotal   =  $detalle["total"];
            $total      =  $detalle["total"];

            $consulta   = $dbConectado->prepare($this->sqlInsertDetalle());
            $consulta->bindParam(':pedido_id', $pedidoid);
            $consulta->bindParam(':producto_id', $productoid);
            $consulta->bindParam(':cantidad', $cantidad);
            $consulta->bindParam(':precio', $precio);
            $consulta->bindParam(':porcentaje_descuento', $porcdesc);
            $consulta->bindParam(':descuento', $descuento);
            $consulta->bindParam(':subtotal', $subtotal);
            $consulta->bindParam(':total', $total);
            try {
                $consulta->execute();
            } catch (PDOException $pdoe) {
                $superArray['success'] = false;
                $dbConectado->rollback();
                $superArray['ERROR'] = "Mensaje de Error: " . $pdoe->getMessage();
                $dbConectado = null;
                return $superArray;
            }
        endforeach;

        $dbConectado->commit();
        return $superArray;
    }
}
