<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

<!DOCTYPE html>
<html lang="en">

<?php
  include "../site/header.php";
?>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.118.2">

  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="styles1.css">

  <title>Login</title>
</head>

<body>
  

  <section class="login-container">
    <div class="w-50 ">
      <img class="image-container w-100" src="images/login.svg" alt="">
    </div>
    <div class="w-50 d-flex justify-content-center align-self-center">
      <article class="login-info-container">
        <form method="get" action="login_connection.php">
          <div class="mb-3">
            
            <label for="correo" class="form-label">Nombre de Usuario</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Nombre de Usuario">
          </div>
          <div class="mb-3">
            <label for="contrasena" class="form-label">Contraseña</label>
            <input type="password" id="contrasena" class="form-control" name="password" placeholder="Contraseña">
          </div>
          <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
        </form>
        <p>No tienes una cuenta?<A href="registro.html" class="span"> Registrate</A></p>
        </form>
      </article>
    </div>
  </section>

  <?php
        include "../site/footer.php";
    ?>
</body>

</html>