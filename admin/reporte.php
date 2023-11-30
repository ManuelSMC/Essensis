<?php
ob_start();
?>

<?php
$total=0;
include "../site/header_dashboard.php";

if (!isset($_SESSION["administrador"])) {
    header("Location:" . $GLOBALS['ruta_raiz_sin_sesion']);
} else {

?>
<!DOCTYPE html>
<html lang="en">
    <style>
            table {
   width: 100%;
   border: 1px solid #999;
   text-align: left;
   border-collapse: collapse;
   margin: 0 0 1em 0;
   caption-side: top;
}
caption, td, th {
   padding: 0.3em;
}
th, td {
   border-bottom: 1px solid #999;
   width: 25%;
}
caption {
   font-weight: bold;
   font-style: italic;
}
.total {
            text-align: right;
            font-weight: bold;
        }
    </style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista Sucursales</title>
</head>

<body>
    <?php
        
    ?>

    <section id="dashboard">
        <div class="row">
            
            <main class="col-12 col-lg-10 p-4">
                
                
                <?php
                 $lista_query2 = TableDet();
                 $row = mysqli_fetch_array($lista_query2);
                 echo "<h1 class='mb-2'>Reportes de ventas - Essensis</h1>";
                 echo "<h3 class='mb-2'> Dia: " . $row['fecha'] . "</h3>";
                
                ?>

                <br>
                
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            
                        <th>Fecha</th>
                        <th>Sucursal</th>
                        <th>Producto</th>
                        <th>Precio Unitario</th>
                        <th>Cantidad Vendida</th>
                        <th>total con IVA</th>

                           
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $lista_query2 = TableDet();
                    while ($row = mysqli_fetch_array($lista_query2)) {
                        echo "<tr>";
                        echo "<td>" . $row['fecha'] . "</td>";
                        echo "<td>" . $row['nombre'] . "</td>";
                        echo "<td>" . $row['marca'] . "</td>";
                        echo "<td> $" . $row['precio_unitario'] . "</td>";
                        echo "<td>" . $row['cantidad'] . "</td>";
                        echo "<td> $" . $row['subtotal'] . "</td>";
                        

                        $total = $total + $row['subtotal'];
                        
                    }
                    
                    ?>
                    
                    </tbody>
                    
                    

                </table>
                <div class="total">
                <?php
                    echo "<h4> TOTAL DE VENTAS:  $" . $total . "</h2>";
                    ?>
                </div>
                <br>

            
            </main>
        </div>
    </section>
    <?php
        include "../site/footer.php";
    ?>
    
</body>

</html>
<?php
    
}
?>
<?php

$html=ob_get_clean();


require_once "Reportes/dompdf/autoload.inc.php";
use Dompdf\Dompdf;
$dompdf = new Dompdf();

$dompdf->loadHtml($html);

$dompdf->setPaper('letter');

$dompdf->render();

$dompdf->stream("reporte_ventas.pdef", array("Attachment" =>false));



?>