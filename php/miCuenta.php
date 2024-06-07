<?php
require '../config/database.php';
require '../config/clienteFunciones.php';
require '../config/config.php';

$db = new Database();
$con = $db->conectar();

$nombre = '';
$apellidos = '';
$NIF = '';
$correo = '';
$telefono = '';
$direccion = '';
$codigo_postal = '';

if (isset($_SESSION['usuario_correo'])) {
  $sql = $con->prepare("SELECT * FROM usuario WHERE correo = ?");
  $sql->execute([$_SESSION['usuario_correo']]);
  $row = $sql->fetch(PDO::FETCH_ASSOC);
  $nombre = $row['nombre'];
  $apellidos = $row['apellidos'];
  $NIF = $row['NIF'];
  $correo = $row['correo'];
  $telefono = $row['telf'];
  $direccion = $row['direccion'];
  $codigo_postal = $row['CP'];
}

$errors = [];

if (!empty($_POST)) {
  if ($_POST['accion'] == 'registro') {
    $nombre = trim($_POST['nombre']);
    $apellidos = trim($_POST['apellidos']);
    $NIF = trim($_POST['NIF']);
    $correo = trim($_POST['correo']);
    $contrasenya = trim($_POST['contrasenya']);

    if (!empty($nombre) && !empty($apellidos) && !empty($NIF) && !empty($correo) && !empty($contrasenya)) {
      registrar($NIF, $nombre, $apellidos, $correo, $contrasenya, null, null, null, $con);
    } else {
      $errors[] = "Los campos con * deben de estar rellenos.";
    }
  }

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
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>TuPlegable.com 2024</title>

  <!-- Bootstrap Core CSS -->
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

  <!-- Theme CSS -->
  <link href="../css/clean-blog.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/estilo_miCuenta.css">
  <link rel="stylesheet" href="../css/miCuentaForm.css">

  <!-- Custom Fonts -->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
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
    <input type="checkbox" id="check">
    <label for="check" class="checkbtn">
      <i class="fas fa-bars"></i>    
    </label>
    <a class="enlace" href="../index.php">
      <img src="../img/logo.png" alt="" class="logo" width="200px">
    </a>
    <ul>
      <li><a href="../index.php">Inicio</a></li>
      <?php if (empty($nombre)) { ?>
        <li><a class="active" href="login.php">Login</a></li>
      <?php } else { ?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user"></i> <?php echo $nombre ?> <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="miCuenta.php">Mi Cuenta</a></li>
            <li><a href="misCompras.php">Mis compras</a></li>
            <li><a href="logout.php">Cerrar sesión</a></li>
          </ul>
        </li>
      <?php } ?>
      <li><a href="contacto.php">Contacto</a></li>
      <li><a href="tienda.php">Tienda</a></li>
      <li><a href="carrito.php"><i class="fa-solid fa-cart-shopping"></i> Carrito <span id="num_cart" class="badge bg-secondary"><?php echo $num_cart; ?></span></a></li>
    </ul>
  </nav>

  <!-- Page Header -->
  <header class="intro-header" style="background-image: url('../img/home-bg.jpg')">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2">
          <div class="site-heading"></div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <main>
    <h3 class="miCuenta">Mi cuenta / Modificar datos</h3>
    <hr>
    <form action="datosModificados.php" method="post" class="mi-cuenta-form">
      <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value='<?php echo $nombre ?>' class="form-control">
      </div>
      <div class="form-group">
        <label for="apellidos">Apellidos:</label>
        <input type="text" name="apellidos" id="apellidos" value='<?php echo $apellidos ?>' class="form-control">
      </div>
      <div class="form-group">
        <label for="NIF">NIF:</label>
        <input type="text" name="NIF" id="NIF" readonly value='<?php echo $NIF ?>' class="form-control">
      </div>
      <div class="form-group">
        <label for="correo">Correo:</label>
        <input type="email" name="correo" id="correo" value='<?php echo $correo ?>' class="form-control">
      </div>
      <div class="form-group">
        <label for="telf">Teléfono:</label>
        <input type="tel" maxlength="9" name="telf" id="telf" value='<?php echo $telefono ?>' class="form-control">
      </div>
      <div class="form-group">
        <label for="direccion">Dirección:</label>
        <input type="text" name="direccion" id="direccion" value='<?php echo $direccion ?>' class="form-control">
      </div>
      <div class="form-group">
        <label for="CP">Código postal:</label>
        <input type="text" name="CP" id="CP" pattern="[0-9]{5}" value='<?php echo $codigo_postal ?>' class="form-control">
      </div>
      <button type="submit" name="accion" value="Modificar datos" class="btn btn-primary">Modificar datos</button>
    </form>

    <?php  
    if(isset($_SESSION['mensaje'])) {
      echo "<p>{$_SESSION['mensaje']}</p>";
      unset($_SESSION['mensaje']); 
    }
    ?>
  </main>

  <!-- Footer -->
  <footer>
    <p class="copyright text-muted">Copyright &copy; TuPlegable.com 2024</p>
  </footer>
</body>

</html>
