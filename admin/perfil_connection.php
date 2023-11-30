<?php
ini_set('display_errors', 'on');
error_reporting(E_ALL);

include ('functions.php');


if(isset($_GET["id_administrador"]) && isset($_GET["nombre"]) && isset($_GET["apellido"]) && isset($_GET["correo"]) && isset($_GET["password"]) && isset($_GET["estatus"])){
    $id_admin = $_GET["id_administrador"];
    $nombre = $_GET["nombre"];
    $apellido = $_GET["apellido"];
    $correo = $_GET["correo"];
    $password = $_GET["password"];
    $estatus = $_GET["estatus"];
    
    updateWorker($id_admin, $nombre, $apellido, $correo, $password, $estatus );
    $_SESSION['perfilAdmin_editado'] = true;
    header("Location: perfil_admin.php");
    
}