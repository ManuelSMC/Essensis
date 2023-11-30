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
    <title>Lista de Inventarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
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
                if (isset($_SESSION['stock_agregado']) && $_SESSION['stock_agregado'] == true) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Stock agregado con éxito.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                    
                    unset($_SESSION['stock_agregado']);
                }

                if (isset($_SESSION['inventario_editado']) && $_SESSION['inventario_editado'] == true) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Inventario actualizado con éxito.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                    
                    unset($_SESSION['inventario_editado']);
                }

                if (isset($_SESSION['inventario_inhabilitado']) && $_SESSION['inventario_inhabilitado'] == true) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Inventario inhabilitado correctamente.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                    unset($_SESSION['inventario_inhabilitado']);
                }

                if (isset($_SESSION['stock_modificado']) && $_SESSION['stock_modificado'] == true) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Stock modificado correctamente.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                    unset($_SESSION['stock_modificado']);
                }
                
                ?>
                <h1 class="mb-2">Lista de Inventarios</h1>
                <a href="agregar_inventario.php" class="btn btn-success mb-3">Agregar inventario</a>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Sucursal</th>
                            <th>Stock</th>
                            <th style="width: 250px">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $inventarios_data = selectInventario();

                    while ($row_inv = mysqli_fetch_array($inventarios_data)) {
                        $row_prod = obtenerProducto($row_inv['id_producto']);
                        $row_suc = obtenerSucursal($row_inv['id_sucursal']);
    
                        echo '<tr>';
                        echo '<td>' . $row_prod['marca'] . '</td>';
                        echo '<td>' . $row_prod['modelo'] . '</td>';
                        echo '<td>' . $row_suc['nombre'] . '</td>';
                        
                        if ($row_inv['disponibles'] > 0) {
                            echo '<td>' . $row_inv['disponibles'] . '</td>';
                        } else {
                            echo '<td>0</td>';
                        }
                        echo '<td> 

                        <div class="d-flex justify-content-center">
                        <a href="edit_inventario.php?id_inventario='.$row_inv['id_inventario'].'" class="btn btn-primary btn-sm">
                                    <i class="bi bi-pencil"></i> Editar
                                </a>
                        <div class="d-flex flex-row justify-content-center">
                        <a href="inhabilitar_inv.php?disponibles=0&&id_inventario='.$row_inv['id_inventario'].'" class="btn btn-danger btn-sm me-1">
                                <i class="bi bi-trash"></i> Reiniciar stock a 0
                            </a>
                                </div> </td>';
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

            