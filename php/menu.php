<nav>
  <input type="checkbox" id="check" />
  <label for="check" class="checkbtn">
    <i class="fas fa-bars"></i>
  </label>
  <a class="enlace" href="index.php">
    <img src="../img/logo.png" alt="logo" class="logo" width="200px" />
  </a>

  <ul>
    <li class="menu-item"><a href="../index.php" <?php if (basename($_SERVER['PHP_SELF']) == 'index.php') echo 'class="active"'; ?>>INICIO</a></li>


    <?php if (!isset($nombre)) { ?>
      <!-- Si no se recibe el nombre del usuario de la base de datos, te redirige a la página de login -->
      <li class="menu-item"><a href="login.php" <?php if (basename($_SERVER['PHP_SELF']) == 'login.php') echo 'class="active"'; ?>>LOGIN</a></li>
    <?php } else { ?>
      <!-- Si vuelves a la página de inicio despúes de haber iniciado sesión, y vuelves a darle a tu nombre de ususario te redirige
                a un menu desplegable.-->
      <li class="dropdown">

      <a class="dropdown-toggle <?php if(basename($_SERVER['PHP_SELF']) == 'miCuenta.php') echo 'active'; ?>" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
    <i class="fas fa-user"></i> <?php echo $nombre; ?> <span class="caret"></span>
</a>

        <ul class="dropdown-menu">
          <li><a href="miCuenta.php">MI CUENTA</a></li>
          <li><a href="misCompras.php">MIS COMPRAS</a></li>
          <li><a href="logout.php">CERRAR SESIÓN</a></li>

        </ul>
      </li>
    <?php } ?>
    <li><a href="contacto.php" <?php if (basename($_SERVER['PHP_SELF']) == 'contacto.php') echo 'class="active"'; ?>>CONTACTO</a></li>
    <li><a href="tienda.php" <?php if (basename($_SERVER['PHP_SELF']) == 'tienda.php') echo 'class="active"'; ?>>TIENDA</a></li>

    <li><a href="carrito.php" <?php if (basename($_SERVER['PHP_SELF']) == 'carrito.php') echo 'class="active"'; ?>><i class="fa-solid fa-cart-shopping"></i> CARRITO <span id="num_cart" class="badge bg-secondary"><?php echo $num_cart; ?></span></a></li>

  </ul>
</nav>