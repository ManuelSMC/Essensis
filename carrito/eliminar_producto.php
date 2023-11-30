<?php
session_start();
unset($_SESSION['carrito'][$_GET["id_inv"]]);
header("Location: ../Cliente/Carrito.php");
?>