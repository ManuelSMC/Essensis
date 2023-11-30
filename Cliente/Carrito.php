<?php
include "../site/header.php";
if (!isset($_SESSION["cliente"])) {
    include ('functions.php');
    header("Location:" . $GLOBALS['ruta_raiz_sin_sesion']);
} else {
    $total = 0; // Inicializa la variable total
?>

<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
      <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
      <title>Carrito de Compras</title>
  </head>
  <?php
?>
<body>
    <section class="pb-4">
        <div class="bg-white border rounded-5">
            <section class="w-100 px-3 py-5" style="background-color: #eee; border-radius: .5rem .5rem 0 0;">
                <div class="row d-flex justify-content-center">
                    <div class="col-xl-11">

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h3 class="fw-normal mb-0 text-black">Carrito de Compras</h3>
                        </div>

                        <?php
                        if (empty($_SESSION['carrito'])) {
                        ?>
                            <div class="alert alert-info" role="alert">
                                El carrito de compras está vacío.
                            </div>
                        <?php
                        } else {
                            foreach ($_SESSION['carrito'] as $inventario_id => $detalle) {
                                $inv = getInventario($inventario_id);
                                $prod = getProducto($inv["id_producto"]);
                                $total = $prod["precio"] * $detalle["cantidad"];
                                $iva = $total*.16;
                                $final = $total-$iva;
                        ?>
                                <div class="card rounded-3 mb-4">
                              <div class="card-body p-5">
                                  <div class="row d-flex justify-content-between align-items-center">
                                      <div class="col-md-2 col-lg-2 col-xl-2">
                                          <img src="<?= $prod["imagen"] ?>" class="img-fluid rounded-3" alt="Cotton T-shirt">
                                      </div>
                                      <div class="col-md-3 col-lg-3 col-xl-3">
                                          <p><span class="lead fw-normal mb-2"></span><?= $prod["descripcion"] ?></p>
                                          <p><span class="text-muted">Color: </span><?= $prod["color"] ?></p>
                                      </div>
                                      <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                          <h5 class="mb-0">Precio: $<?= $prod["precio"] ?></h5>
                                      </div>
                                      <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                      <h5>Cantidad:</h5> 
                                      <input id="form1" min="0" name="cantidad" value="<?= $detalle["cantidad"] ?>" type="number" class="form-control form-control-sm">
                                    </div> 
                                      <div class="col-md-3 col-lg-3 col-xl-2">
                                          <a href="../carrito/eliminar_producto.php?id_inv=<?= $inventario_id ?>" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                                      </div>
                                    <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                      <a href="#!" class="text-danger"><i class="fas fa-trash fa-lg"></i></a>
                                    </div>
                                  </div>
                              </div>
                          </div>

                        <?php
                            }
                        }
                        ?>

                        <div class="card">
                            <div class="card-body p-4">
                                <?php if (!empty($_SESSION['carrito'])) { ?>
                                    <h5 class="text-end">Total sin IVA: $<?= $final ?> MXN</h5>
                                    <h5 class="text-end">IVA: $<?= $iva ?> MXN</h5>
                                    <h5 class="text-end">Total: $<?= $total ?> MXN</h5>
                                    
                                    

                                    <a href="../admin/venta.php" type="button" class="btn btn-warning btn-block btn-lg">Realizar Compra</a>
                                <?php } ?>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
        </div>
    </section>
</body>

</html>
<?php
}
?>