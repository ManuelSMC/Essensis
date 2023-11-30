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
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Pantalon Azul</h5>
            <p class="card-text">Descripción del producto.</p>
            <p class="card-text">Precio: $20.00</p>

            <!-- Formulario para agregar al carrito -->
            <form action="" method="post">
                <div class="mb-3">
                    <label for="cantidad" class="form-label">Cantidad:</label>
                    <input type="number" name="cantidad" class="form-control" value="1" min="1" max="10">
                </div>
                <button type="submit" class="btn btn-primary">Agregar al Carrito</button>
            </form>
        </div>
    </div>
</div>

<?php
// Verifica si el formulario ha sido enviado y si se envió una cantidad del producto por medio del método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cantidad'])) {
    
    // Obtenemos la cantidad de productos seleccionados del formulario
    $cantidad = $_POST['cantidad'];
    
    // Damos el id del inventario donde se encuentra el producto
    $inventario_id = 2;

    // Verifica si la variable de sesión carrito está definida
    if (!isset($_SESSION['carrito'])) {
        // Si no está definida, inicialízala como un array vacío
        $_SESSION['carrito'] = array();
    }

    // Actualiza o agrega al carrito en la sesión
    if (isset($_SESSION['carrito'][$inventario_id])) {
        // Si el inventario ya está en el carrito, actualiza la cantidad
        $_SESSION['carrito'][$inventario_id]['cantidad'] += $cantidad;
    } else {
        // Si no está en el carrito, agrégalo
        $_SESSION['carrito'][$inventario_id] = array(
            'cantidad' => $cantidad
        );
    }

    // Muestra la información del carrito
    echo "Cantidad del producto A en el inventario: " . $inventario_id . "<br>" . $_SESSION['carrito'][$inventario_id]['cantidad'];
}


// Vaciar el carrito (Destruye las variables especificadas, pero no destruye la sesión)
// unset($_SESSION['carrito']);

?>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
