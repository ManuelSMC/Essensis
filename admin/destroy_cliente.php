<?php
include ('functions.php');

unset($_SESSION["cliente"]);
unset($_SESSION["iniciocliente"]);

header("Location:" . $GLOBALS['login']);
?>