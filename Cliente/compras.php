<?php
include "../site/header.php";
if (!isset($_SESSION["cliente"])) {
    
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
      <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
      <title>Compras</title>
  </head>
  <?php
?>
<body>
    <!-- Page Content -->
<div class="container">

    <div class="py-5 text-center">
      <h2>Mis compras</h2>
    </div>

    <div class="row">
        <div class="col">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <th>#</th>
                        <th>Fecha de venta</th>
                        <th>Cliente</th>
                        <th>Total</th>
                        <th>Acción</th>
                    </thead>
                    <?php

                    $id_cli = $_SESSION['id_cliente'];

                    $res = getVentasPorCliente($id_cli);
                    
                    while($row = mysqli_fetch_array($res)){
                        $test = getDetalleVenta($row["id"]);
                        $testRes = mysqli_fetch_array($test);
                    ?>
                    <tr>
                        <td><?= $row["id"] ?></td>
                        <td><?= $row["fecha"] ?></td>
                        <td><?= $testRes["nombre"] . " " . $testRes["apellido"] ?></td>
                        <td>$<?= number_format($row["monto_total"]) ?> MXN</td>
                        <td>
                            
                        
                        <a type="button" class="btn btn-light btn-app active" data-bs-toggle="modal" data-bs-target="#myModal<?= $row["id"] ?>"><i class="fas fa-info-circle"></i> Mas info</a>

                        <!-- The Modal -->
                        <div class="modal fade" id="myModal<?= $row["id"] ?>">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                            
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Productos de la venta [<?= $row["id"] ?>]</h4>
                                        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                                    </div>
                                    
                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <table class="table table-striped table-responsive">
                                            <tr>
                                            <td>Cliente</td>
                                            <td>Direcci&oacute;n</td>
                                            <td>Producto comprado</td>
                                            <td>Precio del producto</td>
                                            <td>Cantidad</td>
                                            <td>Subtotal (MXN)</td>
                                            <td>IVA (MXN)</td>
                                            <td>Total (MXN)</td>
                                            </tr>
                                            <?php
                                            $resModal = getDetalleVenta($row["id"]);
                                            
                                            while($res2Modal = mysqli_fetch_array($resModal)){
                                            ?>
                                            <tr>
                                                <td><?= $res2Modal["nombre"] . " " . $res2Modal["apellido"] ?></td>
                                                <td><?= $res2Modal["direccion"] ?></td>
                                                <td><?= $res2Modal["marca"] . " " . $res2Modal["modelo"] ?></td>
                                                <td>$<?= number_format($res2Modal["precio_unitario"]) ?></td>
                                                <td><?= $res2Modal["cantidad"] ?></td>
                                                <td>$<?= number_format($res2Modal["precio_unitario"] * $res2Modal["cantidad"]) ?></td>
                                                <td>$<?= number_format($res2Modal["precio_unitario"] * 0.16) ?></td>
                                                <td>$<?= number_format($res2Modal["monto_total"]) ?></td>
                                                
                                            </tr>
                                            <?php
                                            }
                                            ?>
                                        </table>
                                    </div>
                                    
                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                            <!-- End modal -->

        <a type="button" class="btn btn-primary btn-app active" target="_blank" href="factura.php?id_venta=<?= $row["id"] ?>"><i class="fas fa-print"></i> Imprimir factura</a>
                        
                    </td>
                    </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>

    <!-- footer -->
    <footer class="my-5 pt-5 text-muted text-center text-small">
      
    </footer>
    <!-- /.footer -->

</div>
<!-- /.container -->

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>


</body>

</html>
<?php
}
?>