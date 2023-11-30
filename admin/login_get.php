  <?php
    @session_start();
    
  ?>
  <!DOCTYPE html>
  <html lang="es">

  <section>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" aria-label="Offcanvas navbar large">
        <div class="container-fluid">
            <a href="../Cliente/index.php"><img src="1.png" height="60px"></a>
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-4">
            <li class="nav-item">
              <a class="nav-link active" href="../cliente/index.php"> <p>Inicio</p></a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
</section>

  <head>
      <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
      <meta http-equiv="Pragma" content="no-cache">
      <meta http-equiv="Expires" content="0">
      <title>Login</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  </head>

  <body>
      <?php

        if (isset($_SESSION['inicioadmin']) && $_SESSION['inicioadmin'] == true) {
            header("Location: dashboard_worker.php");
        }

        if (isset($_SESSION['iniciocliente']) && $_SESSION['iniciocliente'] == true) {
            header("Location: ../Cliente/index.php");
        }

        if (isset($_SESSION['usuario_agregado']) && $_SESSION['usuario_agregado'] == true) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Usuario registrado con éxito. Inicie sesión para continuar.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            
            unset($_SESSION['usuario_agregado']);
        }

        if (isset($_SESSION['deshabilitado']) && $_SESSION['deshabilitado'] == true) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Este usuario está deshabilitado, intente con otra cuenta por favor
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            unset($_SESSION['deshabilitado']);
        }

        if (isset($_SESSION['usuario_agregado2']) && $_SESSION['usuario_agregado2'] == true) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Usuario registrado con éxito. Inicie sesión para continuar.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            
            unset($_SESSION['usuario_agregado2']);
        }

        if (isset($_SESSION['no_inicio']) && $_SESSION['no_inicio'] == true) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Datos incorrectos. Intente de nuevo.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            
            unset($_SESSION['no_inicio']);
        }

        
    ?>
      <main>
      <section id="login-register" class="my-5">
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <section id="login-user" class="col-12 col-md-6 p-5 bg-light rounded-4">
                    <div id="email-invalid" class="alert alert-danger" style="display:none">
                            Tu correo electrónico debe cumplir con los siguientes criterios:
                            <ul>
                                <li>Debe contener un texto</li>
                                <li>Debe contener una arroba (@) enseguida del texto</li>
                                <li>Debe contener un dominio incluyendo un punto (.) con más de 1 caracter</li>
                            </ul>
                        </div>
                        <h2 class="text-center">Iniciar Sesión</h2>
                        <form method="get" action="login_connection.php" onsubmit="validateEmail()">
                            <div class="mb-3">
                                <label for="correo" class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Correo electrónico" required>
                            </div>
                            <div class="mb-3">
                                <label for="contrasena" class="form-label">Contraseña</label>
                                <input type="password" id="contrasena" class="form-control" name="password" placeholder="Contraseña" required>
                            </div>
                            <button type="submit" class="btn btn-primary d-block mx-auto">Iniciar Sesión</button>
                        </form>
                        <p class="text-center">¿Aun no tienes cuenta? <a href="register_get.php">Crear cuenta</a></p>
                    </section>
                </div>
            </div>
        </section>

      </main>
    
      <script>
          function validateEmail(){
                
                // Get our input reference.
                var emailField = document.getElementById('email');
                
                // Define our regular expression.
                var validEmail =  /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;
            
                // Using test we can check if the text match the pattern
                if( validEmail.test(emailField.value) ){
                    return true;
                }else{
                    document.getElementById("email-invalid").style.display = "block";
                    event.preventDefault();
                }
            }
      </script>

  </body>

  </html>