<?php
// Inicializamos sesiones en el documento e incluimos las funciones de procesamiento de datos
include ('functions.php');

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['cliente'])) {
    header("Location:" . $GLOBALS['ruta_raiz_sin_sesion']);
} else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body>
    <?php
        include "../site/header_dashboard.php";
    ?>
    
    <section id="dashboard">
        <div class="row">
            <nav id="sidebar" class="col-12 col-lg-2 bg-light sidebar p-4 min-vh-100">
                <div class="position-sticky">
                    <ul class="nav flex-row flex-lg-column justify-content-md-center justify-content-lg-start">
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Inicio
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-12 col-lg-10 p-4">
                <h1 class="mb-2">Panel de control</h1>
            </main>
        </div>
    </section>
    <?php
        include "../site/footer.php";
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
    
}
?>