<?php
include ('../admin/functions.php');
?>
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
                <li><a class="dropdown-item" href="../cliente/Carrito.php">  <p>Carrito de compras</p></a></li>
                <li><a class="dropdown-item" href="../cliente/compras.php">  <p>Mis compras</p></a></li>
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
