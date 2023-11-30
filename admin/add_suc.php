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
    <title>Agregar Sucursal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php
        
        if (isset($_SESSION['sucursal_existente']) && $_SESSION['sucursal_existente'] == true) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                La sucursal ya existe. Intente con otro por favor.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            
            unset($_SESSION['sucursal_existente']);
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
                    <h1 class="mb-3">Agregar Sucursal</h1>
                    <form method="post" action="sucursal_connection.php" enctype="multipart/form-data">
                        <input type="hidden" name="accion" value="agregar">
                          
                        <label for="nombre" class="form-label mt-3">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>

                        <label for="estado" class="form-label mt-3">Estado</label>
                        <select class="form-select" id="estado" name="estado">
                        
                            <option value="Aguascalientes">Aguascalientes</option>
                            <option value="Baja California">Baja California</option>
                            <option value="Baja California Sur">Baja California Sur</option>
                            <option value="Campeche">Campeche</option>
                            <option value="Chiapas">Chiapas</option>
                            <option value="Chihuahua">Chihuahua</option>
                            <option value="CDMX">Ciudad de México</option>
                            <option value="Coahuila">Coahuila</option>
                            <option value="Colima">Colima</option>
                            <option value="Durango">Durango</option>
                            <option value="Estado de México">Estado de México</option>
                            <option value="Guanajuato">Guanajuato</option>
                            <option value="Guerrero">Guerrero</option>
                            <option value="Hidalgo">Hidalgo</option>
                            <option value="Jalisco">Jalisco</option>
                            <option value="Michoacán">Michoacán</option>
                            <option value="Morelos">Morelos</option>
                            <option value="Nayarit">Nayarit</option>
                            <option value="Nuevo León">Nuevo León</option>
                            <option value="Oaxaca">Oaxaca</option>
                            <option value="Puebla">Puebla</option>
                            <option value="Querétaro">Querétaro</option>
                            <option value="Quintana Roo">Quintana Roo</option>
                            <option value="San Luis Potosí">San Luis Potosí</option>
                            <option value="Sinaloa">Sinaloa</option>
                            <option value="Sonora">Sonora</option>
                            <option value="Tabasco">Tabasco</option>
                            <option value="Tamaulipas">Tamaulipas</option>
                            <option value="Tlaxcala">Tlaxcala</option>
                            <option value="Veracruz">Veracruz</option>
                            <option value="Yucatán">Yucatán</option>
                            <option value="Zacatecas">Zacatecas</option>
                        </select>

                        <label for="municipio" class="form-label mt-3">Municipio</label>
                        <input type="municipio" class="form-control" id="municipio" name="municipio" required>

                        <label for="direccion" class="form-label mt-3">Direccion</label>
                        <input type="direccion" class="form-control" id="direccion" name="direccion" required>

                        <label for="telefono" class="form-label mt-3">Telefono</label>
                        <input type="telefono" class="form-control" id="telefono" name="telefono" required>

                        <label for="estatus" class="form-label mt-3">Estatus</label>
                        <select class="form-select" id="estatus" name="estatus">
                            <option value="1">Activo</option>
                            <option value="2">Bloqueado</option>
                        </select>

                        <label for="imagen" class="form-label mt-3">Imagen</label>
                        <br>
                        <input type="file" name="imagen" id="imagen" accept="image/*" required>
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