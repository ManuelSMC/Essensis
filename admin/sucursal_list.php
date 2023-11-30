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
    <title>Lista Sucursales</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body>
    <?php
        
    ?>

    <section id="dashboard">
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
                        <li class="nav-item">
                            <a class="nav-link" href="reporte_list.php">
                                Reporte  de ventas
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-12 col-lg-10 p-4">
                <?php
                 

                if (isset($_SESSION['sucursal_habilitada']) && $_SESSION['sucursal_habilitada'] == true) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Sucursal habilitada correctamente.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                    unset($_SESSION['sucursal_habilitada']);
                }
        
                if (isset($_SESSION['sucursal_editado']) && $_SESSION['sucursal_editado'] == true) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Sucursal actualizado con éxito.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                    
                    unset($_SESSION['sucursal_editado']);
                }

                if (isset($_SESSION['sucursal_inhabilitada']) && $_SESSION['sucursal_inhabilitada'] == true) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Sucursal inhabilitada con éxito.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                    
                    unset($_SESSION['sucursal_inhabilitada']);
                }


                if (isset($_SESSION['sucursal_agregada']) && $_SESSION['sucursal_agregada'] == true) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Sucursal agregada con éxito.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                    
                    unset($_SESSION['sucursal_agregada']);
                }
                if (isset($_SESSION['sucursal_repetido']) && $_SESSION['sucursal_repetido'] == true) {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        La sucursal ya existe. Favor de revisar.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                    
                    unset($_SESSION['sucursal_repetido']);
                } 
                ?>
                <h1 class="mb-2">Lista de Sucursales</h1>
                <a href="add_suc.php" class="btn btn-success mb-3">Agregar sucursal</a>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            
                            <th>Nombre</th>
                            <th>Estado</th>
                            <th>Municipio</th>
                            <th>Direccion</th>
                            <th>Telefono</th>
                            <th>Estatus</th>
                            <th>Imagen</th>

                            <th style="width: 250px">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $lista_query2 = tableSuc();
                    while ($row = mysqli_fetch_array($lista_query2)) {
                        echo "<tr>";
                        echo "<td>" . $row['nombre'] . "</td>";
                        echo "<td>" . $row['estado'] . "</td>";
                        echo "<td>" . $row['municipio'] . "</td>";
                        echo "<td>" . $row['direccion'] . "</td>";
                        echo "<td>" . $row['telefono'] . "</td>";
                        
                        if ($row['estatus'] == 1){
                            echo "<td>Activo</td>";
                        }else{
                            echo "<td>Inactivo</td>";
                        }

                        echo "<td><img src='" . $row['imagen'] . "' style='max-width: 180px; max-height: 150px;'></td>";

                        echo '<td> 
                            <div class="d-flex justify-content-center">
                                <a href="inhabilitar_suc.php?estatus=0&&id_sucursal='.$row['id_sucursal'].'" class="btn btn-danger btn-sm me-1">
                                    <i class="bi bi-trash"></i> Deshabilitar
                                </a>
                                <a href="habilitar_suc.php?estatus=1&&id_sucursal='.$row['id_sucursal'].'" class="btn btn-success btn-sm me-1">
                                    <i class="bi bi-check"></i> Habilitar
                                </a>
                                <a href="edit_sucursal.php?sucursal='.$row['id_sucursal'].'" class="btn btn-primary btn-sm">
                                    <i class="bi bi-pencil"></i> Editar
                                </a>
                            </div>
                        </td>';
                        echo "</tr>";

                    }
                    ?>
                    </tbody>
                </table>
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