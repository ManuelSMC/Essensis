<?php
ini_set('display_errors', 'on');
error_reporting(E_ALL);

include ('functions.php');


if(isset($_GET["id_cliente"]) && isset($_GET["nombre"]) && isset($_GET["apellido"]) && isset($_GET["direccion"]) && isset($_GET["correo"]) && isset($_GET["password"]) && isset($_GET["estatus"])){
    $id_cliente = $_GET["id_cliente"];
    $nombre = $_GET["nombre"];
    $apellido = $_GET["apellido"];
    $direccion = $_GET["direccion"];
    $correo = $_GET["correo"];
    $password = $_GET["password"];
    $estatus = $_GET["estatus"];
    
    updateClient($id_cliente, $nombre, $apellido, $direccion, $correo, $password, $estatus );
    $_SESSION['perfilCliente_editado'] = true;
    header("Location: perfil_cliente.php");
    
}