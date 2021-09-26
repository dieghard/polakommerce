<?php


namespace Class;

require_once('Productos.php');

use Class\Productos;

if (!isset($_SESSION)) {
	session_start();
}


class CarritoDigital
{

	private int $_productoId;
	private $_cantidad;
	private $_cantidadTotal;
	private $_TotalAPagar;

	public function __construct()
	{
	}


	public function getProductoId()
	{
		return $this->_productoId;
	}

	public function setProductoId(int $productoid)
	{
		$this->_productoId = $productoid;
	}

	public function getCantidad()
	{
		return $this->_cantidad;
	}

	public function setCantidad($cantidad)
	{
		$this->_cantidad = $cantidad;
	}

	public function getCantidadTotal()
	{
		$this->CalcularCantidadTotal();
		return $this->_cantidadTotal;
	}

	public function getTotalAPagar()
	{
		$this->CalcularTotal();
		return $this->_TotalAPagar;
	}

	public function getCarro()
	{
		if (isset($_SESSION["carro"])) :
			return  $_SESSION["carro"];
		endif;
	}

	public function Add(&$superArray)
	{

		$obj = new Productos();
		$superArray['productoid'] = $this->_productoId;
		$productos = $obj->getProductosPorId($this->_productoId, $superArray);
		$productos = (object)$productos[0];

		if (!isset($_SESSION["carro"][$productos->id])) :
			$carrito = array('id' => $productos->id, 'imagen' =>  $productos->imagenPresentacion, 'producto' => $productos->producto, 'precio' => $productos->precio, 'cantidad' => $this->_cantidad, 'total' => $productos->precio * $this->_cantidad);
			$_SESSION["carro"][$productos->id] = $carrito;
		else :
			$carrito =  $_SESSION["carro"][$productos->id];
			$carrito['cantidad'] =  $carrito['cantidad'] + $this->_cantidad;
			$carrito['total']	 = $carrito['cantidad'] *  $carrito['precio'];
			$_SESSION["carro"][$productos->id] = $carrito;
		endif;

		return;
	}

	private function CalcularCantidadTotal()
	{

		$cantidadTotal = 0;
		if (isset($_SESSION["carro"])) :
			foreach ($_SESSION['carro'] as $subarray) :
				$cantidadTotal +=   $subarray['cantidad'];
			endforeach;
		endif;
		$this->_cantidadTotal = $cantidadTotal;
		return;
	}

	private function CalcularTotal()
	{
		$totales = 0;
		if (isset($_SESSION["carro"])) :
			foreach ($_SESSION['carro'] as $subarray) :
				$totales  +=  $subarray['total'];
			endforeach;
		endif;
		$this->_TotalAPagar = $totales;
		return;
	}

	public function ShowCart()
	{

		$tabla = '<table> ';
		$tabla .= '<caption>PRODUCTOS EN EL CARRITO DE COMPRAS</caption>';
		$tabla .=  $this->Thead();
		$tabla .= '<tbody> ';
		$messages = [];
		foreach ($_SESSION['carro'] as $subarray) :
			$obj = new Productos();
			$id  = strip_tags($subarray["id"]);
			$productos = $obj->getProductosPorId($id, $messages);
			$productos = (object)$productos[0];
			$tabla .= '<tr>';
			$tablaProducto = '<td class= "shoping__cart__item"><img src="./fotos/' . $productos->imagenPresentacion . ' " alt=""><h5>' . $productos->producto . '</h5></td>';
			$tabla .= $tablaProducto;
			$tablaPrecio = '		<td class="shoping__cart__price"><h5>$' . $productos->precio . '</h5></td>';
			$tabla .= $tablaPrecio;
			$tablaCantidad = ' <td class="shoping__cart__quantity">
								<h5>' . $subarray["cantidad"] . '</h5>
								<!--<input onchange="" type="number" value="' . $subarray["cantidad"] . '" class="form-control">
								<img onclick="" src="img/aumentar.png" alt="aumentar" title="aumentar">
								<img onclick="" src="img/restar.png" alt="restar" title="restar">
								<img onclick="" src="img/eliminar.png" alt="eliminar" title="eliminar">-->
							</td>';
			$tabla .= $tablaCantidad;
			$tablaSubtotal = '	<td class="shoping__cart__total">$' . $subarray["cantidad"] * $productos->precio . '</td></tr>';
			$tabla .= $tablaSubtotal;
		endforeach;
		$tabla .= '</tbody>';
		$tabla .= '<tfoot>
					<tr>
						<th>PRODUCTO</th>
						<th>PRECIO</th>
						<th>CANTIDAD</th>
						<th>TOTAL</th>
					</tr>
			</tfoot>';
		$tabla .= '</table>';

		$tabla .= '	<div class="row">
						<div class="col-6">
						<div class="shoping__cart__btns">
							<a href="index.php" class="primary-btn cart-btn">SEGUIR COMPRANDO</a>
							</div>
						</div>
						<div class="col-6">
							<div class="shoping__cart__btns">

						<a href="carrito.php" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
                            	ACTUALIZAR CARRO</a>
                    		</div>
						</div>
					</div>
						<div class="row">
						<div class="col-12">
							<div class="shoping__checkout">
								<h5>TOTAL CARRO</h5>
								<ul>
									<li>Total de Productos <span>' . $this->getCantidadTotal() . '</span></li>
								</ul>
								<ul>
									<li>Total a Pagar <span>$' . $this->getTotalAPagar() . '</span></li>
								</ul>
							</div>
						</div>
					</div>';
		return $tabla;
	}

	private function Thead()
	{
		return '<thead>
			<tr>
				<th class="shoping__product">Producto</th>
				<th>Precio</th>
				<th>cantidad</th>
				<th>Total</th>
			</tr>
		</thead>';
	}

	public function ShowOrden()
	{
		$order = '<h4>Tu orden</h4>';
		$order .= '<div class="finalizar_compra__order__products">Productos <span>Total</span></div>';
		$order .= '<ul>';

		foreach ($_SESSION['carro'] as $subarray) :
			$obj = new Productos();
			$id  = strip_tags($subarray["id"]);
			$productos = $obj->getProductosPorId($id);
			$productos = (object)$productos[0];
			$order .= '<li>' . $productos->producto . ' <span>$' . $subarray['total'] . '</span></li>';
		endforeach;

		$order .= '</ul>';
		$order .= '<div class="finalizar_compra__order__subtotal">Subtotal <span>$' . $this->getTotalAPagar() . '</span></div>';
		$order .= '<div class="finalizar_compra__order__total">Total <span>$' . $this->getTotalAPagar() . '</span></div>';


		return $order;
	}
}
