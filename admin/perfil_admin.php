<?php
include "../site/header_dashboard.php";

if (!isset($_SESSION["administrador"])) {
    header("Location:" . $GLOBALS['ruta_raiz_sin_sesion']);
} else {

    $lista_query = perfilAdmin($_SESSION["id_administrador"]);
    $row = mysqli_fetch_array($lista_query)
        

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php
        
        if (isset($_SESSION['perfilAdmin_editado']) && $_SESSION['perfilAdmin_editado'] == true) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Perfil editado correctamente.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            
            unset($_SESSION['perfilAdmin_editado']);
        }

        if (isset($_SESSION['no_inicio']) && $_SESSION['no_inicio'] == true) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Datos incorrectos. Intente de nuevo.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            
            unset($_SESSION['no_inicio']);
        }

        if (isset($_SESSION['correo_existente']) && $_SESSION['correo_existente'] == true) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                El correo que intentas registrar ya existe. Intente con otro por favor.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            
            unset($_SESSION['correo_existente']);
        }
    ?>
<section id="dashboard" class="overflow-hidden">
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
                            <a class="nav-link" href="client_list.php">
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
                    </ul>
                </div>
            </nav>

            <main class="col-12 col-lg-10 p-4">

      <section id="login-register" class="my-5">
            <div class="container">
                
                <div class="row justify-content-center align-items-center">
                    
                    <section id="register-admin" class="col-12 col-md-6 p-5 bg-light rounded-4">

                        <div id="error" class="alert alert-danger" style="display:none">
                            ¡Las contraseñas no coinciden, vuelve a intentar!
                        </div>
                        <div id="easy-password" class="alert alert-danger" style="display:none">
                            <strong>Contraseña débil:</strong> Tu contraseña debe cumplir con los siguientes criterios:
                            <ul>
                                <li>Debe contener al menos una letra mayúscula.</li>
                                <li>Debe contener al menos una letra minúscula.</li>
                                <li>Debe contener al menos un número.</li>
                                <li>Debe contener al menos uno de los siguientes caracteres especiales: @, #, $, %, &, o *.</li>
                            </ul>
                        </div>

                        <h2 class="text-center">Datos de: <br><br>-  <?php echo $_SESSION["administrador"]?>  -</h2><br>
                        <form id="form-registro" method="get" action="perfil_connection.php" onsubmit="validarPasswords()">
                        <div class="mb-3">
                                <input type="hidden" class="form-control" id="id_administrador" name="id_administrador"
                                    value="<?php echo $row['id_administrador']?> " >
                            </div>
                            <div class="mb-3">
                                <label for="nombre" class="form-label mt-3">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre"
                                    value="<?php echo $row['nombre']?> " >
                            </div>

                            <div class="mb-3">
                                <label for="apellido" class="form-label mt-3">Apellidos</label>
                                <input type="text" class="form-control" id="apellido" name="apellido"
                                value="<?php echo $row['apellido']?>">
                            </div>

                            <div class="mb-3">
                                <label for="correo" class="form-label mt-3">Correo Electrónico</label>
                                <input type="email" class="form-control" id="correo" name="correo"
                                value="<?php echo $row['usuario']?>">
                            </div>

                            <div class="mb-3">
                                <label for="main-contrasena" class="form-label">Contraseña</label>
                                <input type="text" class="form-control" name="password" minlength="8"
                                value="<?php echo $row['password']?>">
                            </div>

                            <div class="mb-3 visually-hidden" >
                                    <label for="estatus" class="form-label mt-3  ">Estatus</label>
                                <select class="form-select" id="estatus" name="estatus">
                                    <option value="1">Activo</option>
                                    <option value="2">Bloqueado</option>
                                </select>
                                </div>
                                <input type="submit" class="btn btn-primary mt-3" value="Guardar cambios">
                        </form>
                        
                        
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
  <?php
        include "../site/footer.php";
    ?>
</html>

<?php } ?>