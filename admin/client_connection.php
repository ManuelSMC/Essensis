<?php
ini_set('display_errors', 'on');
error_reporting(E_ALL);

include ('functions.php');

if (isset($_GET['accion'])) {

    $accion = $_GET['accion'];

   if ($accion == 'editar') {
        if(isset($_GET['id_cliente']) && isset($_GET['nombre']) && isset($_GET['apellido']) && isset($_GET['direccion']) && isset($_GET['email']) && isset($_GET['password']) && isset($_GET['usuario'])  && isset($_GET['estatus'])){
            updateClient($_GET['id_cliente'], $_GET['nombre'], $_GET['apellido'], $_GET['direccion'],  $_GET['email'], $_GET['password'], $_GET['usuario'], $_GET['estatus']);
            
            $_SESSION['cliente_editado'] = true;
            header("Location: client_list.php");
        }
    }
    else {
        header("Location:" . $GLOBALS['worker_dashboard']);
    }

    
}
?>
