<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head><script src="/docs/5.3/assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.118.2">
    <link rel="stylesheet" href="styles1.css">
    <title>Tienda de celulares Essensis</title>

  </head>
  
  <?php
include ('../admin/functions.php');
?>
<section>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark" aria-label="Offcanvas navbar large">
    <div class="container-fluid">
      <a href="../cliente/index.php"><img src="1.png" height="60px"></a>
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
                <li><a class="dropdown-item" href="Carrito.php">  <p>Carrito de compras</p></a></li>
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


  <body>
<main>
<section id="main-header">

  <div class="main-header-content">
      <h1>Calidad a los mejores precios</h1>
      <p>Buscamos la excelencia en todo lo que hacemos. Nos esforzamos por superar las expectativas y</p>
      <p>alcanzar los más altos estándares de calidad en nuestros productos y servicios.</p>
      <br>
  </div>           
</section>
<br><br>
<section >
  <div class="row1">
      <section class="our-services2">
          <article>
              <section class="si">
              <br>
                  <img src="xiaomi.webp" height="150px" width="150px">
                  <br><br>
                  
                    <H2>Xiaomi</H2>
                    <br>
              
                  
                      
              </section>
          </article>
         
          <article>
              <section class="si">
              <br>
                  <img src="samsung.png" class="img" height="150px" width="150px">
                  <br><br>
                  <h2>Samsung</h2>
                  <br>
              </section>
          </article>  
          <article>
              <section class="si">
              <br>
                  <img src="apple.png" height="150px" width="150px">
                  <br><br>
                  <h2>Apple</h2>
                  <br>
              </section>
          </article>
          <article>
          
            <section class="si">
            <br>
                <img src="motorola.png" height="150px" width="150px">
                <br><br>
                <h2>Motorola</h2>
          <br>
            </section>
        </article>
      </section>
  </div>
</section>
<section id="services"><!-- .container -->
            <div class="row">
                <section class="our-services">
                    <article>
                        <img src="2.jpg" alt="Web Development" height="600px" width="600px" class="imagen"> 
                    </article>
                   
                    <article>
                    <br><br><br>
                   
                    <h1>
                        Mision y Vision.
                    </h1>
                    <br>
                    <section class="texto2">
                      <p>Brindar soluciones de comunicación móvil de alta calidad y servicios excepcionales a nuestros clientes. Nos esforzamos por ser una tienda de 
                        celulares de confianza que ofrece una amplia gama de dispositivos y accesorios innovadores, mientras proporcionamos un excelente servicio al cliente y asesoramiento experto para satisfacer las necesidades de conectividad de nuestros clientes.</p>
                        <br>
                      <p>Ser reconocidos como líderes en el mercado de dispositivos móviles y servicios relacionados, siendo la primera opción para nuestros clientes cuando buscan soluciones de comunicación móvil. Nos esforzamos por mantenernos a la vanguardia de la 
                        tecnología y la innovación, expandiendo nuestra presencia en el mercado y contribuyendo a la conectividad efectiva y la satisfacción de nuestros clientes en todo momento</p>

                      
                    </section>
                        
                    </article>  
                </section>
            </div>
</section>
        <br><br>
<footer class="fondo">
  <section class="our-services2">
    <article>
      <section class="si2">
        <img src="https://cdn-icons-png.flaticon.com/512/1170/1170678.png" height="50px" width="50px">
          <br><br>
            
                <H3>Carrito de compras</H3>
            
                        
      </section>
    </article>
           
    <article>
      <section class="si2">
        <img src="https://cdn-icons-png.flaticon.com/512/3884/3884880.png"  height="50px" width="50px">
          <br><br>
            <section>
              <h3>Factura</h3>
            </section>
                        
      </section>
    </article>  
    <article>
      <section class="si2">
        <img src="https://cdn-icons-png.flaticon.com/512/388/388531.png" height="50px" width="50px">
          <br><br>
            <section >
              <H3>Seguridad</H3>
            </section>
                        
      </section>
    </article>
    <article>
      <section class="si2">
        <img src="https://cdn-icons-png.flaticon.com/512/679/679720.png" height="50px" width="50px">
          <br><br>
            <section>
              <h3>Envios</h3>
            </section>
                      
      </section>
    </article>
  </section>
</div>
</section>
</footer>
</main>

    </body>
</html>