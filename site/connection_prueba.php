<?php
function connectDatabase(){
    $servername = "localhost";
    $username = "root";
    $password = "Perfect97";
    $database = "VinnyBooks";

    return mysqli_connect($servername, $username, $password, $database, 3306);
}

$conexion = connectDatabase();

$idU = 0;
$nomC = isset($_POST['nomC']) ? $_POST['nomC'] : '';
$apC = isset($_POST['apC']) ? $_POST['apC'] : '';
$calle = isset($_POST['calle']) ? $_POST['calle'] : '';
$nE = isset($_POST['nE']) ? $_POST['nE'] : '';
$cp = isset($_POST['cp']) ? $_POST['cp'] : '';
$col = isset($_POST['col']) ? $_POST['col'] : '';
$ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : '';
$rfc = isset($_POST['rfc']) ? $_POST['rfc'] : '';
$razonfisc = isset($_POST['razonfisc']) ? $_POST['razonfisc'] : '';
$estatus = 1;
$tipo = 2;
$emailC = isset($_POST['emailC']) ? $_POST['emailC'] : '';
$passC = isset($_POST['passC']) ? $_POST['passC'] : ''; // Usar la variable correcta para la contraseña

$query_usu = "INSERT INTO usuario (idU, nomU, passU, estatus, tipo) 
              VALUES ($idU, '$emailC', '$passC', $estatus, $tipo)";
$ejecutar = mysqli_query($conexion, $query_usu);

$id_usuario = mysqli_insert_id($conexion);

$query_cli = "INSERT INTO cliente (nomC, apC, calle, nE, col, cp, ciudad, rfc, razonfisc, estatus, idU) 
    VALUES ('$nomC', '$apC', '$calle', $nE, '$col', $cp, '$ciudad', '$rfc', '$razonfisc', $estatus, '$id_usuario')";
mysqli_query($conexion, $query_cli);



if ($ejecutar) {
    echo '
    <script> 
        alert("Usuario registrado exitosamente");
        window.location = "./login.php";
    </script>
    ';
} else {
    echo '
    <script> 
          alert("Error, usuario NO registrado");
          window.location = "./registro.php";
    </script>
    ';
}

mysqli_close($conexion);
?>
