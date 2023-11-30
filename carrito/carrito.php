<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Single Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Detalles del Producto</h2>

    <?php 
    // Actualiza el carrito en la sesión
    if(isset($_POST["inventario_id"], $_POST["cantidad"])){
        $inventario_seleccionado = $_POST["inventario_id"];
        $nueva_cantidad = $_POST["cantidad"];
        
        $_SESSION['carrito'][$inventario_seleccionado]['cantidad'] = $nueva_cantidad;
    }
    
    // Verifica si la variable de sesión carrito está definida
    if (!isset($_SESSION['carrito'])) {
        // Si no está definida, inicialízala como un array vacío
        $_SESSION['carrito'] = array();
    }else{
        foreach ($_SESSION['carrito'] as $inventario_id => $detalle){ ?>
        <div class="card my-3">
            <div class="card-body">
                <h5 class="card-title">Producto en inventario ID: <?php echo $inventario_id; ?></h5>
                <p class="card-text">Cantidad en el carrito: <?php echo $detalle['cantidad']; ?></p>

                <form action="" method="post">
                    <input type="hidden" name="inventario_id" value="<?php echo $inventario_id; ?>">
                    <input type="hidden" name="sucursal_id" value="<?php echo $sucursal_id; ?>">
                    <div class="mb-3">
                        <label for="cantidad" class="form-label">Actualizar Cantidad:</label>
                        <input type="number" name="cantidad" class="form-control" value="<?php echo $detalle['cantidad']; ?>" min="0">
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar Carrito</button>
                </form>
                <form action="eliminar_producto.php" method="post">
                    <input type="hidden" name="inventario_id" value="<?php echo $inventario_id; ?>">
                    <button type="submit" class="btn btn-primary">Eliminar Producto Carrito</button>
                </form>
            </div>
        </div>
    <?php 
        } 
    }

    
    ?>

    <!-- Agrega aquí la lógica para mostrar información adicional del producto si es necesario -->

    <div class="mt-3">
        <!-- Agrega aquí el botón o enlace para vaciar el carrito -->
        <a href="vaciar_carrito.php" class="btn btn-danger">Vaciar Carrito</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
