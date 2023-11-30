<?php
include ('functions.php');
?>
<!DOCTYPE html>
<html lang="es">
<head><script src="/docs/5.3/assets/js/color-modes.js"></script>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
<meta name="generator" content="Hugo 0.118.2">
<link rel="stylesheet" href="styles1.css">
<title>Tienda de celulares Essensis</title>

</head>

<section>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark" aria-label="Offcanvas navbar large">
    <div class="container-fluid">
      <a href="../Cliente/index.php"><img src="1.png" height="60px"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar2" aria-controls="offcanvasNavbar2" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasNavbar2" aria-labelledby="offcanvasNavbar2Label">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasNavbar2Label">Offcanvas</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <a class="nav-link active" href="../admin/perfil_cliente.php">
                <i class="bi bi-person"></i> Perfil
              </a>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Menu
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="../Cliente/Carrito.php">  <p>Carrito de compras</p></a></li>
                <li>
                <hr class="dropdown-divider">
                </li>
                <li><div class="container">
            
            <a href="../admin/destroy_cliente.php" class="btn btn-danger m-4">Logout</a>
            
        </div></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="../Cliente/index.php">Inicio</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../admin/catalogo.php"> <p>Productos</p></a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
</section>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Catálogo de Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    
</head>
<?php
  

  if (isset($_SESSION['agregadoAlCarrito']) && $_SESSION['agregadoAlCarrito'] == true) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Producto agregado al carrito de compras correctamente.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    
    unset($_SESSION['agregadoAlCarrito']);
}

if (isset($_SESSION['ventaHecha']) && $_SESSION['ventaHecha'] == true) {
                  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                      Compra realizada.
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
                  
                  unset($_SESSION['ventaHecha']);
              }

?>
<body>
<section id="main-header">

<div class="main-header-content">
    <h1>Calidad a los mejores precios</h1>
    <p>Buscamos la excelencia en todo lo que hacemos. Nos esforzamos por superar las expectativas y</p>
    <p>alcanzar los más altos estándares de calidad en nuestros productos y servicios.</p>
    <br>
</div>           
</section>
<br><br>
<main>

        <div class="container mt-5">
            <label for="filtro">Filtrar por Sucursal:</label>
            <select id="filtro" class="form-select">
                <option value="todos">Todos</option>
                <?php
                $conn = connectDatabase();
                $select_sucursal = "SELECT * FROM sucursales WHERE estatus = 1";
                  $execute_sql = mysqli_query($conn, $select_sucursal);
                  while($row = mysqli_fetch_array($execute_sql)){
                  ?>
                <option value="<?php echo $row["id_sucursal"];?>"><?php echo $row["nombre"];?></option>
                <?php }?>
            </select>
        </div>

        <section id="shoping-catalog" class="container mt-5 mb-5">

            <?php 
            $execute_sql = mysqli_query($conn, $select_sucursal);
            while($row_sucursal = mysqli_fetch_array($execute_sql)){
                $id_sucursal = $row_sucursal["id_sucursal"];
            ?>
            <section class="<?php echo $row_sucursal["id_sucursal"];?> productos">
                <h1 class="fs-4 my-3"><?php echo $row_sucursal["nombre"];?></h1>
                <div class="row g-4">
                    <?php
                      $select_productos_sucursal = "SELECT productos.* FROM inventario 
                      INNER JOIN productos ON inventario.id_producto = productos.id 
                      INNER JOIN sucursales ON inventario.id_sucursal = sucursales.id_sucursal 
                      WHERE sucursales.id_sucursal = '$id_sucursal' 
                      AND sucursales.estatus = 1
                      AND inventario.disponibles > 0";
                      $execute_sql_productos = mysqli_query($conn, $select_productos_sucursal);
                      if(mysqli_num_rows($execute_sql_productos) > 0){
                        while($row_articles = mysqli_fetch_array($execute_sql_productos)){
                          ?>
                            
                            <article class="col-md-12 col-lg-3 h-100">
                              <div class="text-center border rounded">
                                <img class="img-fluid mb-3" src="<?php echo $row_articles['imagen']?>" style='max-width: 180px; max-height: 150px;'>
                                <h2 class="fw-bolder fs-6"><?php echo $row_articles["marca"]?></h2>
                                <h2 class="fw-bolder fs-6"><?php echo $row_articles["modelo"]?></h2>
                                <p>$<?php echo $row_articles["precio"]?></p>

                                <a class="btn btn-outline-dark mb-3" href="detalle_prod.php?id_prod=<?php echo $row_articles["id"];?>&id_suc=<?php echo $id_sucursal; ?>">Ver más</a>
                              </div>
                            </article>
                          <?php
                        }
                    }else{
                      echo "No hay productos disponibles";
                    }?>
                    <hr>
                </div>
            </section>
            <?php }?>
        </section>
        
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    </main>
    <script>
    $(document).ready(function() {
        $("#filtro").change(function() {
            var selectedCategory = $(this).val();
            if (selectedCategory === "todos") {
                $(".productos").show();
            } else {
                $(".productos").hide();
                $("." + selectedCategory).show();
            }
        });
    });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
<?php
        include "../site/footer.php";
    ?>
</html>
