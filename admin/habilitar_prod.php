<?php
ini_set('display_errors', 'on');
error_reporting(E_ALL);

include ('functions.php');

habilitar_prod($_GET['estatus'], $_GET['id_producto']);

$_SESSION['producto_habilitado'] = true;
header("Location: productos_list.php");
?>