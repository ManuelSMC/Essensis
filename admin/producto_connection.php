<?php
ini_set('display_errors', 'on');
error_reporting(E_ALL);

include ('functions.php');

if (isset($_POST['accion'])) {

    $accion = $_POST['accion'];

    if ($accion == 'agregar') {
        if(isset($_POST['marca']) && isset($_POST['modelo']) && isset($_POST['descripcion']) && isset($_POST['color']) && isset($_POST['precio']) && isset($_FILES['imagen'])){
            addProd($_POST['marca'], $_POST['modelo'], $_POST['descripcion'], $_POST['color'], $_POST['precio'], $_FILES["imagen"]); 
        }
    } elseif ($accion == 'editar') {
        if(isset($_POST['id_producto']) && isset($_POST['marca']) && isset($_POST['modelo']) && isset($_POST['descripcion']) && isset($_POST['color']) && isset($_POST['precio']) && isset($_FILES['imagen'])){
            if ($_FILES['imagen']['name'] == null) {
                updateProdVacio($_POST['id_producto'], $_POST['marca'], $_POST['modelo'], $_POST['descripcion'], $_POST['color'], $_POST['precio']);
            }
            else{
                updateProdNoVacio($_POST['id_producto'], $_POST['marca'], $_POST['modelo'], $_POST['descripcion'], $_POST['color'], $_POST['precio'], $_FILES['imagen']);
            }
            $_SESSION['producto_editado'] = true;
            header("Location: productos_list.php");
        }
    }else{
        header("Location:" . $GLOBALS['worker_dashboard']);
    }
}
?>