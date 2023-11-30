<?php
ini_set('display_errors', 'on');
error_reporting(E_ALL);

include ('functions.php');

if(isset($_POST["producto_id"]) && isset($_POST["cantidad"]) && isset($_POST["sucursal_id"])){
    $id_prod = $_POST["producto_id"];
    $cantidad = $_POST["cantidad"];
    $id_suc = $_POST["sucursal_id"];

    agregarCarrito($id_prod, $cantidad, $id_suc);
    
}