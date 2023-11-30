<?php
ini_set('display_errors', 'on');
error_reporting(E_ALL);

include ('functions.php');

habilitar_suc($_GET['estatus'], $_GET['id_sucursal']);

$_SESSION['sucursal_habilitada'] = true;
header("Location: sucursal_list.php");
?>