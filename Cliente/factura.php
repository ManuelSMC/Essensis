<?php
ob_start();
include ('../admin/functions.php');
if (!isset($_SESSION["cliente"])) {
    header("Location:" . $GLOBALS['ruta_raiz_sin_sesion']);
} else {
$res = getDetalleVenta($_GET["id_venta"]);
$vta = mysqli_fetch_array($res);

$suc = getSuc($vta["id_sucursal"]);
$subtotal = 0;
$iva = 0;
$total = 0;

?>


<!DOCTYPE html>
<html>

<head><script src="/docs/5.3/assets/js/color-modes.js"></script>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
<meta name="generator" content="Hugo 0.118.2">
<link rel="stylesheet" href="styles1.css">
<link href="http://<?=$_SERVER['HTTP_HOST']?>/Essensis/site/bootstrap.min.css" rel="stylesheet">
<title>Tienda de celulares Essensis</title>

</head>

<body>
     <section id="header" class="mt-3">
          <div class="container">
               <div class="d-flex justify-content-between row">
                    <div class="col-6">
                         <img src="http://<?=$_SERVER['HTTP_HOST']?>/Essensis/Images/Productos/1.png" style="width: 250px;">
                    </div>
                    <div class="col-4">
                         <table class="table table-sm text-center">
                              <thead>
                                   <tr>
                                        <th colspan="3" style="border-top: 0;">DATOS</th>
                                   </tr>
                                   <tr>
                                        <th>Fecha</th>
                                        <th>Venta</th>
                                   </tr>
                              </thead>
                              <tbody>
                                   <tr>
                                        <td> <?= $vta["fecha"] ?></td>
                                        <td> <?= $vta["id"] ?></td>
                                   </tr>
                              </tbody>
                         </table>
                    </div>

               </div>
               <hr>
          </div>
     </section>
     <section id="info">
          <div class="container">
               <div class="row d-flex">
                    <div class="col-6">
                         <div class="card">
                              <div class="card-header bg-danger text-center">
                                   <div class="card-title"><b>SUCURSAL</b></div>
                              </div>
                              <div class="card-body">
                                   <table class="table table-sm">
                                        <tbody>
                                             <tr>
                                                  <th style="border-top: 0;">Sucursal: </th>
                                                  <th style="border-top: 0;"><?= $suc["nombre"] ?></th>
                                             </tr>
                                             <tr>
                                                  <th>Direccion: </th>
                                                  <th><?= $suc["direccion"] ?></th>
                                             </tr>
                                             <tr>
                                                  <th>Telefono:</th>
                                                  <th><?= $suc["telefono"] ?></th>
                                             </tr>
                                        </tbody>
                                   </table>
                              </div>
                         </div>
                    </div>
                    <div class="col-6">
                         <div class="card">
                              <div class="card-header bg-primary text-center">
                                   <div class="card-title"><b>CLIENTE</b></div>
                              </div>
                              <div class="card-body">
                                   <table class="table table-sm">
                                        <tbody>
                                             <tr>
                                                  <th style="border-top: 0;">Cliente: </th>
                                                  <th style="border-top: 0;"><?= $vta["nombre"] ?></th>
                                             </tr>
                                             <tr>
                                                  <th>Direccion: </th>
                                                  <th><?= $vta["direccion"] ?></th>
                                             </tr>
                                        </tbody>
                                   </table>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </section>
     <section id="detalle">
          <div class="container">
               <table class="table table-striped">
                    <thead>
                         <tr>
                              <th scope="col">ID</th>
                              <th scope="col">Inventario</th>
                              <th scope="col">Producto</th>
                              <th scope="col">Cantidad</th>
                              <th scope="col">Precio unitario</th>
                              <th scope="col">Total</th>
                         </tr>
                    </thead>
                    <tbody>
                         <?php
                         $resTr = getDetalleVenta($_GET["id_venta"]);
                         while ($row  = mysqli_fetch_array($resTr)) {
                            $total += $row["precio"] * $row["cantidad"];
                              ?>
                        <tr>
                            <td><?= $row["id"] ?></td>
                            <td><?= $row["id_inventario"] ?></td>
                            <td><?= $row["marca"] . " " . $row["modelo"] ?></td>
                            <td><?= $row["cantidad"] ?></td>
                            <td>$<?= number_format($row["precio"]) ?></td>
                            <td>$<?= number_format($row["precio"] * $row["cantidad"]) ?></td>
                         </tr>
                              <?php
                         }
                         ?>
                         <tr>
                              <th>&nbsp;</th>
                              <th>&nbsp;</th>
                              <th>&nbsp;</th>
                              <th>&nbsp;</th>
                              <th>Subtotal:</th>
                              <th>$<?= number_format($total) ?></th>
                         </tr>
                         <tr>
                              <th>&nbsp;</th>
                              <th>&nbsp;</th>
                              <th>&nbsp;</th>
                              <th>&nbsp;</th>
                              <th>IVA:</th>
                              <th>$<?= number_format($total * 0.16) ?></th>
                         </tr>
                         <tr>
                              <th>&nbsp;</th>
                              <th>&nbsp;</th>
                              <th>&nbsp;</th>
                              <th>&nbsp;</th>
                              <th>TOTAL:</th>
                              <th>$<?= number_format($total * 1.16) ?></th>
                         </tr>
                    </tbody>
               </table>
          </div>
     </section>
     <section id="footer">

     </section>
</body>

</html>
<?php
}

$html=ob_get_clean();


require_once "../admin/Reportes/dompdf/autoload.inc.php";
use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();

$options->setIsRemoteEnabled(true);

$dompdf = new Dompdf($options);

$dompdf->loadHtml($html);

$dompdf->setPaper('letter');

$dompdf->render();

$dompdf->stream("reporte_ventas.pdef", array("Attachment" =>false));

?>