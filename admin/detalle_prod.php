<?php
    include "../site/header.php"; 
    if (!isset($_SESSION["cliente"])) {
        header("Location:" . $GLOBALS['ruta_raiz_sin_sesion']);
    } else {
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detalle de Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">
    <?php 
    
    if (isset($_SESSION['sinStock']) && $_SESSION['sinStock'] == true) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Lo sentimos, no contamos con esa cantidad de productos por el momento.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        
        unset($_SESSION['sinStock']);
    }
    ?>

    <main class="container mt-5 flex-grow-1">
        <?php
        $producto_id = $_GET['id_prod'];
        $sucursal_id = $_GET['id_suc'];

        $conn = connectDatabase();
        $select_producto = "SELECT * FROM productos WHERE id = '$producto_id'";
        $resultado = mysqli_query($conn, $select_producto);

        if ($row_producto = mysqli_fetch_array($resultado)) {
            ?>
            <div class="row">
                <div class="col-md-6">
                    <img class="img-fluid mb-3" src="<?php echo $row_producto['imagen']?>" style='max-width: 600px; max-height: 580;'>
                </div>
                <div class="col-md-6">
                    <h1 class="fw-bolder fs-4"><?php echo $row_producto["marca"]; ?></h1>
                    <h1 class="fw-bolder fs-4"><?php echo $row_producto["modelo"]; ?></h1>
                    <hr>
                    <p class="fs-6 text-muted"><?php echo $row_producto["descripcion"]; ?></p>
                    <p class="fs-6 fw-bold">Precio: $<?php echo $row_producto["precio"]; ?></p>


                    <!-- form para indicar la cantidad -->
                    <form action="carrito_connection.php" method="post">
                        <div class="mb-3">
                            <label for="cantidad" class="form-label fw-bold">Cantidad:</label>
                            <input type="number" class="form-control" id="cantidad" name="cantidad" value="1" min="1">
                        </div>

                        <!-- campo oculto para enviar id del producto y su sucursal, con la cantidad -->
                        <input type="hidden" name="producto_id" value="<?php echo $row_producto["id"]; ?>">
                        <input type="hidden" name="sucursal_id" value="<?php echo $sucursal_id; ?>">
                        <button type="submit" class="btn btn-primary">Agregar al carrito</button>
                    </form>
                </div>
            </div>
        <?php } ?>
    </main>

    <?php include "../site/footer.php"; ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php 
    }
?>