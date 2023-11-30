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
    <title>Lista de Productos</title>
    <link href="../admin/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body>
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
                 

                if (isset($_SESSION['producto_habilitado']) && $_SESSION['producto_habilitado'] == true) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Producto habilitado correctamente.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                    unset($_SESSION['producto_habilitado']);
                }
        
                if (isset($_SESSION['producto_editado']) && $_SESSION['producto_editado'] == true) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Producto actualizado con éxito.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                    
                    unset($_SESSION['producto_editado']);
                }

                if (isset($_SESSION['producto_inhabilitado']) && $_SESSION['producto_inhabilitado'] == true) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Producto inhabilitado con éxito.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                    
                    unset($_SESSION['producto_inhabilitado']);
                }


                if (isset($_SESSION['producto_agregado']) && $_SESSION['producto_agregado'] == true) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Producto agregado con éxito.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                    
                    unset($_SESSION['producto_agregado']);
                }
                if (isset($_SESSION['producto_repetido']) && $_SESSION['producto_repetido'] == true) {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        El producto ya existe. Favor de revisar.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                    
                    unset($_SESSION['producto_repetido']);
                } 
                ?>
                <h1 class="mb-2">Lista de Teléfonos</h1>
                <a href="add_prod.php" class="btn btn-success mb-3">Agregar Teléfono</a>
                <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            
                            <th>Marca</th>
                            <th style="width: 100px">Modelo</th>
                            <th>Descripción</th>
                            <th>Color</th>
                            <th style="width: 100px">Precio</th>
                            
                            <th>Imagen</th>

                            <th style="width: 250px">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $lista_query2 = tableProd();
                    while ($row = mysqli_fetch_array($lista_query2)) {
                        echo "<tr>";
                        echo "<td>" . $row['marca'] . "</td>";
                        echo "<td>" . $row['modelo'] . "</td>";
                        echo "<td>" . $row['descripcion'] . "</td>";
                        echo "<td>" . $row['color'] . "</td>";
                        echo "<td>$" . $row['precio'] . " </td>";


                        echo "<td><img src='" . $row['imagen'] . "' style='max-width: 180px; max-height: 150px;'></td>";

                        echo '<td> 
                            <div class="d-flex justify-content-center">
                                
                                <a href="edit_prod.php?producto='.$row['id'].'" class="btn btn-primary btn-sm">
                                    <i class="bi bi-pencil"></i> Editar
                                </a>
                            </div>
                        </td>';
                        echo "</tr>";

                        

                    }
                    ?>
                    </tbody>
                </table>
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
<?php
    
}
?>