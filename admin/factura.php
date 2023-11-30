<?php

include ('functions.php');

if (!isset($_SESSION["administrador"])) {
    header("Location:" . $GLOBALS['ruta_raiz_sin_sesion']);
} else {

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Sucursales</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body>
    <?php
        
    ?>

    <section id="dashboard">
        <div class="row">
            

            <main class="col-12 col-lg-10 p-4">
                
             
                
            <center>
        <a href="../Cliente/index.php"><img src="1.png" height="150px"></a>
        <h1 class="mb-2">Factura</h1>
    </center>
    
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            
                        <th>Fecha</th>
                        
                        <th>Producto</th>
                        <th>Precio Unitario</th>
                        <th>Cantidad Vendida</th>
                        <th>IVA</th>
                        <th>total con IVA</th>

                           
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $lista_query2 = TableDet();
                    while ($row = mysqli_fetch_array($lista_query2)) {
                        echo "<tr>";
                        echo "<td>" . $row['fecha'] . "</td>";
                        echo "<td>" . $row['marca'] . "</td>";
                        echo "<td> $" . $row['precio_unitario'] . "</td>";
                        echo "<td>" . $row['cantidad'] . "</td>";
                        echo "<td> $" . $row['tasa_iva'] . "</td>";
                        echo "<td> $" . $row['monto_total'] . "</td>";
                    }
                    ?>
                    </tbody>
                </table>
                
                <a href="reporte.php" class="btn btn-success mb-3">Descargar</a>
            </main>
        </div>
    </section>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php
    
}
?>