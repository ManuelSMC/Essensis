<?php
ini_set('display_errors', 'on');
error_reporting(E_ALL);

include ('functions.php');

if(isset($_GET["email"]) && isset($_GET["password"])){
    $usuario = $_GET["email"];
    $password = $_GET["password"];

    loginUser($usuario, $password);
}

elseif(isset($_GET["nombre"]) && isset($_GET["apellido"]) && isset($_GET["direccion"]) && isset($_GET["usuario"]) && isset($_GET["password"]) && isset($_GET["password-confirmation"]) && isset($_GET["estatus"])){
    $nombre = $_GET["nombre"];
    $apellido = $_GET["apellido"];
    $direccion = $_GET["direccion"];
    $usuario = $_GET["usuario"];
    $password = $_GET["password"];
    $estatus = $_GET["estatus"];

    addUser2($nombre, $apellido, $direccion, $usuario, $password, $estatus);
    
}

?>
