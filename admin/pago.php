<?php
include "../site/header.php";
if (!isset($_SESSION["cliente"])) {
    
    header("Location:" . $GLOBALS['ruta_raiz_sin_sesion']);
} else {
    $subtotal = 0;
    $iva = 0;
    $total = 0; // Inicializa la variable total
    $id_cli = $_SESSION['id_cliente'];
    $cliente = mysqli_fetch_array(getCliente($id_cli));
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
      <title>Pago</title>
  </head>
  <?php
?>
<body>
    <!-- Page Content -->
  <div class="container">

<div class="py-5 text-center">
      <h2>Confirmar compra</h2>
      
      
      
    </div>

    <div class="row">
      <div class="col-md-4 order-md-2 mb-4">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-muted">Tus productos</span>
          <span class="badge badge-secondary badge-pill">15</span>
        </h4>
        <ul class="list-group mb-3">
        
        <?php
            foreach ($_SESSION['carrito'] as $inventario_id => $detalle) {
                $inv = getInventario($inventario_id);
                $prod = getProducto($inv["id_producto"]);
                $subtotal += $prod["precio"] * $detalle["cantidad"];
                $iva = $subtotal * .16;
                $total = $subtotal + $iva;
        ?>

          <li class="list-group-item d-flex justify-content-between lh-condensed">
            <div>
              <h6 class="my-0"><?= $prod["marca"]." ".$prod["modelo"] ?> X <?= $detalle["cantidad"] ?></h6>
              <small class="text-muted"><?= $prod["descripcion"] ?></small>
            </div>
            <span class="text-muted">$<?= number_format($prod["precio"] * $detalle["cantidad"]) ?></span>
          </li>

          <?php
            }
          ?>

          <!--<li class="list-group-item d-flex justify-content-between bg-light">
            <div class="text-success">
              <h6 class="my-0">Promo code</h6>
              <small>EXAMPLECODE</small>
            </div>
            <span class="text-success">-$5</span>
          </li>-->
          <li class="list-group-item d-flex justify-content-between">
            <span>SubTotal (MXN)</span>
            <strong>$<?= number_format($subtotal) ?></strong>
          </li>
          <li class="list-group-item d-flex justify-content-between">
            <span>IVA (MXN)</span>
            <strong>$<?= number_format($iva) ?></strong>
          </li>
          <li class="list-group-item d-flex justify-content-between">
            <span>Total (MXN)</span>
            <strong>$<?= number_format($total) ?></strong>
          </li>
        </ul>

        <!--<form class="card p-2">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Promo code">
            <div class="input-group-append">
              <button type="submit" class="btn btn-secondary">Redeem</button>
            </div>
          </div>
        </form>-->
        <!-- INICIA BOTON DE PAYPAL -->
        <script src="https://www.paypal.com/sdk/js?client-id=AYJHY-fsqxlNa6M0E1KDtOaO5azvYDzP8AHuJLEi01YS4PE7R6oYXYYF5oxBcKqgb6_Xd54mv8JkDWmO&currency=MXN"></script>
        <div id="paypal-button-container"></div>
        <!-- TERMINA BOTON DE PAYPAL -->
      </div>
      <div class="col-md-8 order-md-1">
        <h4 class="mb-3">Datos de pago</h4>
        <table class="table">
        <tr>
            <td>Nombre:</td>
            <td><?= $cliente["nombre"] . " " . $cliente["apellido"] ?></td>
        </tr>
        <tr>
            <td>Dirección:</td>
            <td><?= $cliente["direccion"] ?></td>
        </tr>
        </table>
      </div>
    </div>

    <!-- footer -->
    <footer class="my-5 pt-5 text-muted text-center text-small">
      
    </footer>
    <!-- /.footer -->

</div>
<!-- /.container -->

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

</body>

</html>
<?php
}
?>

<script>
    paypal.Buttons({
      createOrder: function(data, actions) {
        return actions.order.create({
          purchase_units: [{
            amount: {
              value: <?php echo $total; ?>,  //Precio del producto
              //description: 'test.'
            },
              description: 'Compra realizada en la tienda Essensis.'
              //custom: '90048630024435',
          }]
        });
      },
      onApprove: function(data, actions) { //En pago aprobado
        return actions.order.capture().then(function(details) {
      //Aqui van las instrucciones que deseamos realice una vez procese el pago
          <?php
          $_SESSION["pay"] = true;
          ?>
          location.href="venta.php";
          // Instrucciones para el servidor:
          return fetch('/paypal-transaction-complete', {
            method: 'post',
            headers: {
              'content-type': 'application/json'
            },
            body: JSON.stringify({
              orderID: data.orderID
            })
          });
    //fin de instruciones para el servidor
        });
      }
    }).render('#paypal-button-container');
  </script>