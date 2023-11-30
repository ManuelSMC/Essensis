<?php
include ('functions.php');

if (!isset($_SESSION["cliente"])) {
    header("Location:" . $GLOBALS['ruta_raiz_sin_sesion']);
} else {

    $lista_query = perfilCliente($_SESSION["id_cliente"]);
    $row = mysqli_fetch_array($lista_query)
        

?>
<!DOCTYPE html>
<html lang="en">
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
                <li><a class="dropdown-item" href="../Cliente/compras.php">  <p>Mis compras</p></a></li>
                <li>
                <hr class="dropdown-divider">
                </li>
                <li><div class="container">
            
            <a href="../admin/destroy_cliente.php" class="btn btn-danger m-4">Cerrar Sesión</a>
            
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <meta charset="UTF-8">
</head>

<body>
    <?php
        
        if (isset($_SESSION['perfilCliente_editado']) && $_SESSION['perfilCliente_editado'] == true) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Perfil editado correctamente.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            
            unset($_SESSION['perfilCliente_editado']);
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

      <main>
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

                        <h2 class="text-center">Datos de: <br><br>-  <?php echo $_SESSION["cliente"]?>  -</h2><br>
                        <form id="form-registro" method="get" action="perfil_connection_cliente.php" onsubmit="validarPasswords()">
                        <div class="mb-3">
                                <input type="hidden" class="form-control" id="id_cliente" name="id_cliente"
                                    value="<?php echo $row['id_cliente']?> " >
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
                                <label for="direccion" class="form-label mt-3">Dirección</label>
                                <input type="text" class="form-control" id="direccion" name="direccion"
                                value="<?php echo $row['direccion']?>">
                            </div>

                            <div class="mb-3">
                                <label for="correo" class="form-label mt-3">Correo Electrónico</label>
                                <input type="email" class="form-control" id="correo" name="correo"
                                value="<?php echo $row['usuario']?>">
                            </div>

                            <div class="mb-3">
                                <label for="main-contrasena" class="form-label">Contraseña</label>
                                <input type="text" class="form-control" name="password" minlength="8" placeholder="Ingresa tu contraseña">
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