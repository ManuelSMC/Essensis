<?php
include ('functions.php');


    $worker_data = showWorker2();
    $row = mysqli_fetch_array($worker_data);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Worker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php
        include "../site/header_dashboard.php";
        if (isset($_SESSION['correo_existente']) && $_SESSION['correo_existente'] == true) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Correo ya existente. Intente con otro por favor.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            
            unset($_SESSION['correo_existente']);
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
                            <a class="nav-link" href="sucursal_list.php">
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
                    <h1 class="mb-3">Editar Cliente</h1>
                    <form method="set" action="client_connection.php">
                        <input type="hidden" name="accion" value="editar">

                        <input type="hidden" name="id_cliente" value="<?php echo $row['id_cliente'];?>">

                        <label for="nombre" class="form-label mt-3">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $row['nombre'];?>" required>

                        <label for="apellido" class="form-label mt-3">Apellidos</label>
                        <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo $row['apellido'];?>" required>

                        <label for="direccion" class="form-label mt-3">Direccion</label>
                        <input type="direccion" class="form-control" id="direccion" name="direccion" value="<?php echo $row['direccion'];?>" required>

                        <label for="email" class="form-label mt-3">Correo</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['usuario'];?>" required>

                        <label for="password" class="form-label mt-3">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                            
                        </select>

                        <label for="estatus" class="form-label mt-3">Estatus</label>
                        <select class="form-select" id="estatus" name="estatus">
                            <?php
                                if($row['estatus'] == 1){
                            ?>
                            <option value="1" selected>Activo</option>
                            <option value="2">Bloqueado</option>
                            <?php
                                }else{
                            ?>
                            <option value="1">Activo</option>
                            <option value="2" selected>Bloqueado</option>
                            <?php
                                }
                            ?>
                        </select>

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

