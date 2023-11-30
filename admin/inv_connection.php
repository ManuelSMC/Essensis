<?php
ini_set('display_errors', 'on');
error_reporting(E_ALL);

include ('functions.php');

if (isset($_POST['accion'])) {

    $accion = $_POST['accion'];

    if ($accion == 'agregar') {
        
        if(isset($_POST['producto']) && isset($_POST['sucursal']) && isset($_POST['stock'])){
            $id_producto = $_POST['producto'];
            $id_sucursal = $_POST['sucursal'];
            $stock = $_POST['stock'];

            addInventario($id_producto, $id_sucursal, $stock);
            $_SESSION['stock_agregado'] = true;
            header("Location:" . $GLOBALS['ruta_raiz'] . "/admin/inventario_list.php");
        }

    } elseif ($accion == 'editar') {
        
        if(isset($_POST['id_inventario']) && isset($_POST['stock'])){
           $id_inventario = $_POST['id_inventario'];
           $stock = $_POST['stock'];
            
           editInventario($id_inventario, $stock);
           
           $_SESSION['stock_modificado'] = true;
           header("Location:" . $GLOBALS['ruta_raiz'] . "/admin/inventario_list.php");
           
        }
    }

}
?>



