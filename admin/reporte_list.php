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
     .total {
            text-align: right;
            font-weight: bold;
        }
    .boton {
        text-align: center;
            font-weight: bold;
        
    }
</style>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Sucursales</title>
    
</head>

<body>
    <?php
        
    ?>

    <section id="dashboard">
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
                        <li class="nav-item">
                            <a class="nav-link" href="reporte_list.php">
                                Reporte  de ventas
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

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
                <div class="boton">
                <a href="reporte.php" class="btn btn-success mb-3">Descargar</a>
                </div>
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