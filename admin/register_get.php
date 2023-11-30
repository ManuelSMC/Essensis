  <!DOCTYPE html>
  <html lang="es">

  <head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>

  <body>
  <?php
session_start();
?>
  <section>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" aria-label="Offcanvas navbar large">
        <div class="container-fluid">
            <a href="../Cliente/index.php"><img src="1.png" height="60px"></a>
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-4">
            <li class="nav-item">
              <a class="nav-link active" href="../admin/catalogo.php"> <p>Productos</p></a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
</section>
<?php

    if (isset($_SESSION['inicioadmin']) && $_SESSION['inicioadmin'] == true) {
        header("Location: dashboard_worker.php");
    }

    if (isset($_SESSION['iniciocliente']) && $_SESSION['iniciocliente'] == true) {
        header("Location: catalogo.php");
    }

    if (isset($_SESSION['correo_existente']) && $_SESSION['correo_existente'] == true) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            El correo que intentas registrar ya existe. Intente con otro por favor.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        
        unset($_SESSION['correo_existente']);
    }

    

?>
      <main>
      <section id="login-register" class="my-5">
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <section id="register-user" class="col-12 col-md-6 p-5 bg-light rounded-4">

                        <div id="error" class="alert alert-danger" style="display:none">
                            ¡Las contraseñas no coinciden, vuelve a intentar!
                        </div>
                        <div id="easy-password" class="alert alert-danger" style="display:none">
                            <strong>Contraseña débil:</strong> Tu contraseña debe cumplir con los siguientes criterios:
                            <ul>
                                <li>Debe contener al menos una letra mayúscula.</li>
                                <li>Debe contener al menos una letra minúscula.</li>
                                <li>Debe contener al menos un número.</li>
                                <li>Debe contener al menos uno de los siguientes caracteres especiales: @, #, $, %, &, o *. </li>
                            </ul>
                        </div>

                        <h2 class="text-center">Registro</h2>
                        <form id="form-registro" method="get" action="login_connection.php" onsubmit="validarPasswords()">
                            <div class="mb-3">
                                <label for="nombre" class="form-label mt-3">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre"
                                    placeholder="Nombre" required>
                            </div>

                            <div class="mb-3">
                                <label for="apellido" class="form-label mt-3">Apellidos</label>
                                <input type="text" class="form-control" id="apellido" name="apellido"
                                    placeholder="Apellidos" required>
                            </div>

                            <div class="mb-3">
                                <label for="direccion" class="form-label mt-3">Dirección</label>
                                <input type="text" class="form-control" id="direccion" name="direccion"
                                    placeholder="Dirección" required>
                            </div>

                            <div class="mb-3">
                                <label for="usuario" class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control" id="usuario" name="usuario"
                                    placeholder="Correo electrónico" required>
                            </div>
                            <div class="mb-3">
                                <label for="main-contrasena" class="form-label">Contraseña</label>
                                <input type="password" id="main-contrasena" class="form-control" name="password" minlength="8"
                                    placeholder="Contraseña" required>
                            </div>
                            <div class="mb-3">
                                <label for="contrasena-confirmation" class="form-label">Confirmar Contraseña</label>
                                <input type="password" id="contrasena-confirmation" class="form-control" minlength="8"
                                    name="password-confirmation" placeholder="Confirmar Contraseña" required>
                            </div>
                            <div class="mb-3 visually-hidden" >
                                    <label for="estatus" class="form-label mt-3  ">Estatus</label>
                                <select class="form-select" id="estatus" name="estatus">
                                    <option value="1">Activo</option>
                                    <option value="2">Bloqueado</option>
                                </select>
                                </div>
                            <input type="submit" class="btn btn-warning d-block mx-auto" value="Registrarse">
                        </form>
                        <p class="text-center">¿Ya tienes una cuenta? <a href="login_get.php">Inicia sesión</a></p>
                        
                    </section>
                </div>
            </div>
        </section>

      </main>
    

      <script>
      function validarPasswords() {
          main_contrasena = document.getElementById("main-contrasena");
          contrasena_confirmation = document.getElementById("contrasena-confirmation");

          error_message = document.getElementById("error");
          error_easy_password = document.getElementById("easy-password");


          if (main_contrasena.value != contrasena_confirmation.value) {
              error_message.style.display = "block";
              event.preventDefault();
          } else {
              if (main_contrasena.value == contrasena_confirmation.value) {
                  if (!main_contrasena.value.match(/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[@#$%&*.]).{8,}$/)) {
                    error_message.style.display = "none";
                    error_easy_password.style.display = "block";
                      event.preventDefault();
                  }   
              }
            }
          }
      </script>

  </body>

  </html>