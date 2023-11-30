<?php
include ('functions.php');

unset($_SESSION["administrador"]);
unset($_SESSION["inicioadmin"]);

header("Location:" . $GLOBALS['login']);
?>