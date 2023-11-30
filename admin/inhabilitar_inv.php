<?php
ini_set('display_errors', 'on');
error_reporting(E_ALL);

include ('functions.php');

inhabilitar_inv($_GET['disponibles'], $_GET['id_inventario']);

$_SESSION['inventario_inhabilitado'] = true;
header("Location: inventario_list.php");
?>