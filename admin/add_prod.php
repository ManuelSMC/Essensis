<?php

include "../site/header_dashboard.php";

if (!isset($_SESSION["administrador"])) {
    header("Location:" . $GLOBALS['ruta_raiz_sin_sesion']);
} else {

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php
        
        if (isset($_SESSION['producto_existente']) && $_SESSION['producto_existente'] == true) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                El producto ya existe. Intente con otro por favor.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            
            unset($_SESSION['producto_existente']);
        } 
    ?>

    <section id="dashboard" class="overflow-hidden">
        <div class="row">
            <nav id="sidebar" class="col-12 col-lg-2 bg-light sidebar p-4 min-vh-100">
                <div class="position-sticky">
                    <ul class="nav flex-row flex-lg-column justify-content-md-center justify-content-lg-start">
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $GLOBALS['worker_dashboard']?>">
                                Inicio
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="workers_list.php">
                                Lista administradores
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="client_list.php">
                                Lista clientes
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="client_list.php">
                                Lista sucursales
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="productos_list.php">
                                Productos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="inventario_list.php">
                                Inventarios
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-12 col-lg-10 p-4">
                <div class="w-50 mx-auto">
                    <h1 class="mb-3">Agregar Producto</h1>
                    <form method="post" action="producto_connection.php" enctype="multipart/form-data">
                        <input type="hidden" name="accion" value="agregar">
                          
                        <label for="marca" class="form-label mt-3">Marca</label>
                        <input class="form-control" id="marca" name="marca" required>

                        <label for="modelo" class="form-label mt-3">Modelo</label>
                        <input class="form-control" id="modelo" name="modelo" required>

                        <label for="descripcion" class="form-label mt-3">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="4" required></textarea>

                        <label for="color" class="form-label mt-3">Color</label>
                        <input class="form-control" id="color" name="color" required>

                        <label for="precio" class="form-label mt-3">Precio</label>
                        <input class="form-control" id="precio" name="precio" required>


                        <label for="imagen" class="form-label mt-3">Imagen</label>
                        <br>
                        <input type="file" name="imagen" id="imagen" required>
                        <br>
                        <input type="submit" class="btn btn-primary mt-3" value="Guardar">
                    </form>
                </div>
            </main>
        </div>
    </section>
    <?php
        include "../site/footer.php";
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php } ?>