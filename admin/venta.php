<?php
ini_set('display_errors', 'on');
error_reporting(E_ALL);

include('functions.php');
$monto = 0;

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = array();
} else if($_SESSION['pay'] == true) {
    unset($_SESSION['pay']);
    // Variable para almacenar el id_venta
    $id_venta = 0;

    foreach ($_SESSION['carrito'] as $inventario_id => $detalle) {
        $inv = getInventario($inventario_id);
        $prod = getProducto($inv["id_producto"]);
        $suc = getSuc($inv["id_sucursal"]);
        $inv_id = $inv["id_inventario"];
        
        // Obtener información del producto
        $id_producto = $prod["id"];
        $id_sucursal = $suc["id_sucursal"];
        $precio_unitario = $prod["precio"];

        // Obtener información del detalle actual
        $cantidad = $detalle["cantidad"];
        $subtotal = $precio_unitario * $cantidad;

        // Sumar al total el precio del producto multiplicado por la cantidad
        $monto += $subtotal;

        // Agregar detalle solo si $id_venta ya está definida
        if ($id_venta != 0) {
            agregarDetalleVenta($id_venta, $inv_id, $cantidad, $precio_unitario, $subtotal);
        }
    }

$id_cli = $_SESSION['id_cliente'];
$monto_iva = $monto * 0.16;
$monto_total = $monto_iva + $monto;
$fechaActual = date("Y-m-d");

// Agregar la venta y obtener el id_venta
$id_venta = agregarVenta($id_cli, $monto_total, $monto_iva, $fechaActual);

// Actualizar $id_venta en el bucle
if ($id_venta != 0) {
    foreach ($_SESSION['carrito'] as $inventario_id => $detalle) {
        $inv = getInventario($inventario_id);
        $prod = getProducto($inv["id_producto"]);
        $suc = getSuc($inv["id_sucursal"]);
        $inv_id = $inv["id_inventario"];
        
        // Obtener información del producto
        $id_producto = $prod["id"];
        $precio_unitario = $prod["precio"];
        $id_sucursal = $suc["id_sucursal"];
        
        // Obtener información del detalle actual
        $cantidad = $detalle["cantidad"];
        $subtotal = $precio_unitario * $cantidad;

        // Agregar detalle ahora que $id_venta está definida
        agregarDetalleVenta($id_venta, $inv_id, $cantidad, $precio_unitario, $subtotal);
    }
}

// Limpiar la sesión si la venta fue exitosa
if (isset($_SESSION['ventaHecha']) && $_SESSION['ventaHecha'] == true) {
    unset($_SESSION['carrito']);
}
}
else{
    echo "Error";
}
?>