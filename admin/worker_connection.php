<?php
ini_set('display_errors', 'on');
error_reporting(E_ALL);

include ('functions.php');

if (isset($_GET['accion'])) {

    $accion = $_GET['accion'];

    if ($accion == 'agregar') {
        if(isset($_GET['nombre']) && isset($_GET['apellido']) && isset($_GET['email']) && isset($_GET['password']) && isset($_GET['estatus'])){
            addWorker($_GET['nombre'], $_GET['apellido'], $_GET['email'], $_GET['password'], $_GET['estatus']); 
        }
    } elseif ($accion == 'editar') {
        if(isset($_GET['id_administrador']) && isset($_GET['nombre']) && isset($_GET['apellido']) && isset($_GET['email']) && isset($_GET['password'])  && isset($_GET['estatus'])){
            updateWorker($_GET['id_administrador'], $_GET['nombre'], $_GET['apellido'], $_GET['email'], $_GET['password'], $_GET['estatus']);
            
            $_SESSION['empleado_editado'] = true;
            header("Location: workers_list.php");
        }
    }
    else {
        header("Location:" . $GLOBALS['worker_dashboard']);
    }
}
?>
