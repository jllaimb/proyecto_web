<?php
require '../config/database.php';
require '../config/clienteFunciones.php';
require '../config/config.php';



$db = new Database();
$con = $db->conectar();

$nombre; /* Si nombre está vacío, es decir, si la variable está vacía, abajo se ejecuta una página u otra, es decir, la
                página de LOGIN o la página de MI CUENTA con el nombre del usuario. */

if (isset($_SESSION['usuario_correo'])) {
  $sql = $con->prepare("SELECT nombre FROM usuario WHERE correo = ?");
  $sql->execute([$_SESSION['usuario_correo']]);
  $row = $sql->fetch(PDO::FETCH_ASSOC);
  $nombre = $row['nombre'];
}

$errors = [];

if (!empty($_POST)) {
  if ($_POST['accion'] == 'registro') {
    $nombre = trim($_POST['nombre']);
    $apellidos = trim($_POST['apellidos']);
    $NIF = trim($_POST['NIF']);
    $correo = trim($_POST['correo']);
    $contrasenya = trim($_POST['contrasenya']);

    // VERIFICAR SI LOS CAMPOS NO ESTÁN VACÍOS
    if (!empty($nombre) && !empty($apellidos) && !empty($NIF) && !empty($correo) && !empty($contrasenya)) {
      registrar($NIF, $nombre, $apellidos, $correo, $contrasenya, null, null, null, $con);
    } else {
      $errors[] = "Los campos con * deben de estar rellenos.";
    }
  }

  // PARA EL LOGUEO
  if ($_POST['accion'] == 'login') {
    $correo = trim($_POST['email']);
    $contrasenya = trim($_POST['contrasenya']);
    if (!empty($correo) && !empty($contrasenya)) {
      $errors[] = login($correo, $contrasenya, $con);
    } else {
      $errors[] = "Todos los campos son obligatorios";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>Clean Blog</title>

  <!-- Bootstrap Core CSS -->
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />

  <!-- Theme CSS -->
  <link href="../css/clean-blog.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="../css/style.css" />

  <!-- Custom Fonts -->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body style="background-color: #242424">
  <link rel="stylesheet" href="../css/login.css">
  <link rel="stylesheet" href="../css/estilo_letra_menu.css">
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
  <script src="../js/login.js"></script>

  <!-- Navigation -->
  <nav>
    <input type="checkbox" id="check" />
    <label for="check" class="checkbtn">
      <i class="fas fa-bars"></i>    
    </label>
    <a class="enlace" href="../index.php">
      <img src="../img/logo.png" alt="" class="logo" width="200px" />
    </a>
    <ul>
      <li><a href="../index.php">Inicio</a></li>
      <?php if (empty($nombre)) { ?>
        <!-- Si no se recibe el nombre del usuario de la base de datos, te redirige aparece la página de login -->
        <li><a class="active" href="../html/login.php">Login</a></li>
      <?php } else { ?>
        <li class="dropdown">
          <!-- Si se recibe el nombre te redirige a la pagina de mi cuenta con el nombre de usuario en la página-->
          <a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user"></i> <?php echo $nombre ?> <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a cla href="../php/miCuenta.php">Mi Cuenta</a></li>
            <li><a href="../php/logout.php">Cerrar sesión</a></li>
          </ul>
        </li>
      <?php } ?>
      <li><a href="../php/contacto.php">Contacto</a></li>
      <li><a href="../php/tienda.php">Tienda</a></li>
      <li><a href="../php/carrito.php"><i class="fa-solid fa-cart-shopping"></i> Carrito <span id="num_cart" class="badge bg-secondary"><?php echo $num_cart; ?></span></a></li>
    </ul>
  </nav>

  <!-- Page Header -->
  <!-- Set your background image for this header on the line below. -->
  <header class="intro-header" style="background-image: url('../img/home-bg.jpg')">
    <div class="container">
      <div class="row">
        <div class="col-lg--8 col-lg-offset--8 col-md--8 col-md-offset--8">
          <div class="site-heading"></div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->

  <!-- Footer -->
  <footer>
    <p class="copyright text-muted">Copyright &copy; Your Website 2016</p>
  </footer>
</body>

</html>
