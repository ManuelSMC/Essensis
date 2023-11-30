<?php
ini_set('display_errors', 'on');
error_reporting(E_ALL);

include ('functions.php');

inhabilitar_cli($_GET['estatus'], $_GET['id_cliente']);

$_SESSION['cliente_inhabilitado'] = true;
header("Location: client_list.php");
?>