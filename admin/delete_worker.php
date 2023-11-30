<?php
ini_set('display_errors', 'on');
error_reporting(E_ALL);

include ('functions.php');

deleteWorker($_GET['administrador']);

$_SESSION['empleado_eliminado'] = true;
header("Location: workers_list.php");
?>