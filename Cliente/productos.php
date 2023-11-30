<?php
include "../site/header.php";
if (!isset($_SESSION["cliente"])) {
    header("Location:" . $GLOBALS['ruta_raiz_sin_sesion']);
} else {
?>
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
  
  <body>
<main>
    <section id="main-header"><!-- .container -->
        <div class="main-header-content">
            <h1>Calidad a los mejores precios</h1>
            <br><br>
            <p>Buscamos la excelencia en todo lo que hacemos. Nos esforzamos por superar las expectativas y </p>
                <p>alcanzar los más altos estándares de calidad en nuestros productos y servicios.
                </p>
            <br>
        </div>           
      </section>
      <section >
        <div class="row1">
            <section class="our-services2">
                <article>
                    <section class="si">
                        <img src="11.png" height="150px" width="150px">
                        <br><br>
                        
                          <H2>Xiaomi poco M5s</H2>
                        <section class="texto">
                            <p>Con su potente procesador y memoria RAM de 6 GB tu equipo alcanzará un alto rendimiento con gran velocidad 
                                de transmisión de contenidos y ejecutará múltiples aplicaciones a la vez sin demoras.</p>
                            

                        </section>   
                    
                        <div class="btn-group">
                          <a type="button" class="btn btn-sm btn-outline-light" href="producto.php">Ver mas..</a>
                        </div>
                            
                    </section>
                </article>
               
                <article>
                    <section class="si">
                        <img src="13.png" class="img" height="150px" width="150px">
                        <br><br>
                        <h2>I Phone 11</h2>
                        <section class="texto">
                            <p>pantalla profesional increíble, un chip A13 Bionic, un sistema de 
                                cámara profesional e innovador. Además, el iPhone Pro Max tiene la batería con mayor duración en un iPhone
                            </p>
                            <br>

                        </section>
                            <div class="btn-group">
                              <a type="button" class="btn btn-sm btn-outline-light" href="producto.php">Ver mas..</a>
                            </div>
                    </section>
                </article>  
                <article>
                    <section class="si">
                        <img src="12.png" height="150px" width="150px">
                        <br><br>
                        <h2>LG G8X thinQ</h2>
                        <section class="texto">
                            <p>Máxima seguridad para que solo tú puedas acceder al equipo. Podrás elegir 
                                entre el sensor de huella dactilar para habilitar el teléfono en un toque, 
                                o el reconocimiento facial</p>
                                <br>
                        </section>
                            <div class="btn-group">
                              <a type="button" class="btn btn-sm btn-outline-light" href="producto.php">Ver mas..</a>
                            </div>
                    </section>
                </article>
                <article>
                  <section class="si">
                      <img src="14.png" height="150px" width="150px">
                      <br><br>
                      <h2>Moto g200</h2>
                      <section class="texto">
                        <p>Gracias a una mayor sensibilidad a la luz puedes realizar una instantánea con cualquier ajuste y a cualquier hora con la
                             cámara de 108 MP de máxima resolución. La tecnología Ultra Pixel combina 9 píxeles en 1.</p>

                      </section>
                          <div class="btn-group">
                            <a type="button" class="btn btn-sm btn-outline-light" href="producto.php">Ver mas..</a>
                          </div>
                  </section>
              </article>
            </section>
        </div>
      </section>
      <section ><!-- .container -->
        <div class="row1">
            <section class="our-services2">
                <article>
                    <section class="si">
                        <img src="15.png" height="150px" width="150px">
                        <br><br>
                        
                          <H2>Huawei Mate 40 Pro</H2>
                        <section class="texto">
                            <p>Equipo reacondicionado: Al ser un equipo reacondicionado, 
                                en ocasiones puede presentar señales mínimas o detalles estéticos 
                                los cuales no afectan con su funcionamiento</p>
                            <br>
                        </section>   
                    
                        <div class="btn-group">
                          <a type="button" class="btn btn-sm btn-outline-light" href="producto.php">Ver mas..</a>
                        </div>
                            
                    </section>
                </article>
               
                <article>
                    <section class="si">
                        <img src="16.png" class="img" height="150px" width="150px">
                        <br><br>
                        <h2>Samsung Galaxi Z Filp</h2>
                        <section class="texto">
                            <p>Olvídate de borrar. Con su memoria interna de 256 GB podrás 
                              descargar todos los archivos y aplicaciones que necesites, guardar 
                              fotos y almacenar tus películas, series y videos.
                            </p>
                            <br>

                        </section>
                            <div class="btn-group">
                              <a type="button" class="btn btn-sm btn-outline-light" href="producto.php">Ver mas..</a>
                            </div>
                    </section>
                </article>  
                <article>
                    <section class="si">
                        <img src="17.png" height="150px" width="150px">
                        <br><br>
                        <h2>Xiaomi 11Tpro</h2>
                        <section class="texto">
                            <p>Mira tus series y películas favoritas con la mejor definición a
                               través de su pantalla AMOLED de 6.67". Disfruta de colores brillantes y detalles precisos en todos tus contenidos</p>
                               <br>
                        </section>

                            <div class="btn-group">
                              <a type="button" class="btn btn-sm btn-outline-light" href="producto.php">Ver mas..</a>
                            </div>
                    </section>
                </article>
                <article>
                  <section class="si">
                      <img src="motorola.png" height="150px" width="150px">
                      <br><br>
                      <h2>Moto g200</h2>
                      <section class="texto">
                        <p>Gracias a una mayor sensibilidad a la luz puedes realizar una instantánea con cualquier ajuste y a cualquier hora con la
                             cámara de 108 MP de máxima resolución. La tecnología Ultra Pixel combina 9 píxeles en 1.</p>
                          
                      </section>
                          <div class="btn-group">
                            <a type="button" class="btn btn-sm btn-outline-light" href="producto.php">Ver mas..</a>
                          </div>
                  </section>
              </article>
            </section>
        </div>
      </section>
      
      <br><br>
</main>
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
        
        </body>

</html>
<?php }?>