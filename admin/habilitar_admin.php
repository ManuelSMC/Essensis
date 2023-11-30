<?php
ini_set('display_errors', 'on');
error_reporting(E_ALL);

include ('functions.php');

habilitar_admin($_GET['estatus'], $_GET['id_administrador']);

$_SESSION['administrador_habilitado'] = true;
header("Location: workers_list.php");
?>