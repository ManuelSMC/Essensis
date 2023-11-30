
<?php
include "../site/header_dashboard.php";
ini_set('display_errors', 'on');
    error_reporting(E_ALL);

    if (!isset($_SESSION["administrador"])) {
        header("Location:" . $GLOBALS['ruta_raiz_sin_sesion']);
    } else {
        
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
</head>

<body>
<script>
    function mostrarModal(btn) {
    // Obtenemos el valor del atributo data-idproducto del botón clicado
    idproducto = btn.dataset.id_search_prod;

    // Muestra el data-id en el modal
    document.getElementById('id_producto_search').value = idproducto;

    // Muestra el modal
    var miModal = new bootstrap.Modal(document.getElementById('myModal'));
    miModal.show();
    }
    </script>
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
                
    <h1>Registro de inventario</h1>
    <p>Para agregar un inventario, debes buscar un producto primero.</p>
    <form action="agregar_inventario.php" method="post">
        <label class="form-label" for="search">Buscar Producto:</label>
        <input type="search" name="producto_buscado" class="form-control">
    </form>
    <?php 
    if(isset($_POST["producto_buscado"])){
        $conn = connectDatabase();
        $producto_buscado = $_POST["producto_buscado"];
        $busqueda_sql = "SELECT * FROM productos WHERE marca LIKE '%$producto_buscado%' OR modelo LIKE '%$producto_buscado%' OR descripcion LIKE '%$producto_buscado%'";
        
        $sql = mysqli_query($conn, $busqueda_sql);

    ?>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            while($row = mysqli_fetch_array($sql)){
                
            ?>
            <tr>
                <td> <?php echo $row["marca"] ?> </td>
                <td><?php echo $row["modelo"] ?></td>
                <td><?php echo $row["descripcion"] ?></td>
                <td><button id="botonModalID" class="btn btn-primary" data-id_search_prod="<?php echo $row['id'];?>"
                    onclick="mostrarModal(this)">
                    <i class="bi bi-database-fill-add" ></i> Registrar stock</button>
                </td>
            </tr>
            <?php 
            }
            ?>
        </tbody>
    </table>
    <?php
    }
    ?>
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
    <!-- Encabezado del modal -->
    <h3 class="modal-title fs-4" id="exampleModalLabel">Integrar producto a Inventarios</h3>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
    <!-- Contenido del modal -->
    <form action="inv_connection.php" method="post">
    <input type="hidden" name="accion" value="agregar">
    <!-- Colocamos un campo hidden para mandar la información obtenida del data-idproducto -->
    <input type="hidden" id="id_producto_search" name="producto" value="">
    <label for="sucursal" class="form-label mb-3">¿En qué sucursal se encuentra el producto? </label>
    <select class="form-select mb-3" id="sucursal" name="sucursal">
    <?php

    //Mostramos en un Select todas las sucursales
    $sucursales_data = selectSucursales();
    
    while ($row = mysqli_fetch_array($sucursales_data)) {
        echo '<option value="' . $row['id_sucursal'] . '">' . $row['nombre'] . '</option>';
    }
    ?>
    </select>

    <label for="stock" class="form-label mb-3">Stock Disponible</label>
    <input type="number" class="form-control mb-3" id="stock" name="stock" min="0" required>
    <button type="submit" class="btn
    btn-primary">Registrar inventario</button>
    </form>

    </div>
    </div>
    </div>
    </div>
</body>
</html>
<?php 
    }
?>


