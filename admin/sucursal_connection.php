<?php
ini_set('display_errors', 'on');
error_reporting(E_ALL);

include ('functions.php');

if (isset($_POST['accion'])) {

    $accion = $_POST['accion'];

    if ($accion == 'agregar') {
        if(isset($_POST['nombre']) && isset($_POST['estado']) && isset($_POST['municipio']) && isset($_POST['direccion']) && isset($_POST['telefono']) && isset($_POST['estatus']) && isset($_FILES['imagen'])){
            addSuc($_POST['nombre'], $_POST['estado'], $_POST['municipio'], $_POST['direccion'], $_POST['telefono'], $_POST['estatus'], $_FILES["imagen"]); 
        }
    } elseif ($accion == 'editar') {
        if(isset($_POST['id_sucursal']) && isset($_POST['nombre']) && isset($_POST['estado']) && isset($_POST['municipio']) && isset($_POST['direccion']) && isset($_POST['telefono']) && isset($_POST['estatus']) && isset($_FILES['imagen'])){
            if ($_FILES['imagen']['name'] == null) {
                updateSucVacio($_POST['id_sucursal'], $_POST['nombre'], $_POST['estado'], $_POST['municipio'], $_POST['direccion'], $_POST['telefono'], $_POST['estatus']);
            }
            else{
                updateSucNoVacio($_POST['id_sucursal'], $_POST['nombre'], $_POST['estado'], $_POST['municipio'], $_POST['direccion'], $_POST['telefono'], $_POST['estatus'], $_FILES['imagen']);
            }
            $_SESSION['sucursal_editada'] = true;
            header("Location: sucursal_list.php");
        }
    }else{
        header("Location:" . $GLOBALS['worker_dashboard']);
    }
}
?>