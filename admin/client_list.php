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
    <title>Lista de Clientes</title>
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
                 
                 if (isset($_SESSION['usuario_agregado2']) && $_SESSION['usuario_agregado2'] == true) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Usuario registrado con éxito.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                    
                    unset($_SESSION['usuario_agregado2']);
                }

                if (isset($_SESSION['habilitado']) && $_SESSION['habilitado'] == true) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Cliente habilitado correctamente.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                    unset($_SESSION['habilitado']);
                }
        
                if (isset($_SESSION['cliente_editado']) && $_SESSION['cliente_editado'] == true) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Cliente actualizado con éxito.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                    
                    unset($_SESSION['cliente_editado']);
                }

                if (isset($_SESSION['cliente_inhabilitado']) && $_SESSION['cliente_inhabilitado'] == true) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Cliente inhabilitado con éxito.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                    
                    unset($_SESSION['cliente_inhabilitado']);
                }

                if (isset($_SESSION['cliente_eliminado']) && $_SESSION['cliente_eliminado'] == true) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Cliente eliminado con éxito.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                    
                    unset($_SESSION['cliente_eliminado']);
                }

                if (isset($_SESSION['cliente_agregado']) && $_SESSION['cliente_agregado'] == true) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        cliente agregado con éxito.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                    
                    unset($_SESSION['cliente_agregado']);
                }
                if (isset($_SESSION['cliente_repetido']) && $_SESSION['cliente_repetido'] == true) {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        El correo del cliente ya existe. Favor de revisar.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                    
                    unset($_SESSION['cliente_repetido']);
                } 
                ?>
                <h1 class="mb-2">Lista de Clientes</h1>
                <a href="add_client.php" class="btn btn-success mb-3">Agregar cliente</a>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Direccion</th>
                            <th>Usuario</th>
                            <th>Contraseña</th>
                            <th>Estatus</th>

                            <th style="width: 250px">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $lista_query2 = tableWorker2();
                    while ($row = mysqli_fetch_array($lista_query2)) {
                        echo "<tr>";
                        echo "<td>" . $row['nombre'] . "</td>";
                        echo "<td>" . $row['apellido'] . "</td>";
                        echo "<td>" . $row['direccion'] . "</td>";
                        echo "<td>" . $row['usuario'] . "</td>";
                        echo "<td>" . $row['password'] . "</td>";
                        if ($row['estatus'] == 1){
                            echo "<td>Activo</td>";
                        }else{
                            echo "<td>Inactivo</td>";
                        }

                        echo '<td> 
                        <div class="d-flex flex-row justify-content-center">
                            <a href="inhabilitar_cli.php?estatus=0&&id_cliente='.$row['id_cliente'].'" class="btn btn-danger btn-sm me-2">
                                <i class="bi bi-trash"></i> Deshabilitar
                            </a>
                            <a href="habilitar_cli.php?estatus=1&&id_cliente='.$row['id_cliente'].'" class="btn btn-success btn-sm">
                                <i class="bi bi-check"></i> Habilitar
                            </a>
                            
                        </div>
                        </td>';
                        echo "</tr>";
/*
<a href="edit_client.php?cliente='.$row['id_cliente'].'" class="btn btn-primary" style="margin-right:10px">
    <i class="bi bi-pencil"></i> Editar
</a>
*/
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