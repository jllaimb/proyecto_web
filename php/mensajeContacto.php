<?php
require '../config/config.php';
require '../config/clienteFunciones.php';
require '../config/database.php';

$db = new Database();
$con = $db->conectar();


$nombre; /*Si nombre esta vacio, es decir, si la variable esta vacía, abajo se ejecuta una página u otra, es decir, la
          página de LOGIN o la página de MI CUENTA con el nombre del usuario. */

if (isset($_SESSION['usuario_correo'])) {


  $sql = $con->prepare("SELECT nombre FROM usuario WHERE correo = ?");
  $sql->execute([$_SESSION['usuario_correo']]);
  $row = $sql->fetch(PDO::FETCH_ASSOC);

  //print_r($_SESSION);
  $nombre = $row['nombre'];
}


$sql = $con->prepare("SELECT cod_pro, nombre, precio_venta FROM producto WHERE activo = 1");
$sql->execute();
$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);



$productos = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;

$lista_carrito = array();

if ($productos != null) {
  foreach ($productos as $clave => $cantidad) {


    $sql = $con->prepare("SELECT cod_pro, nombre, precio_venta, descuento, $cantidad AS cantidad FROM producto WHERE cod_pro=? AND activo = 1");
    $sql->execute([$clave]);
    $lista_carrito[] = $sql->fetch(PDO::FETCH_ASSOC);
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
  


  <title>TuPlegable</title>
  

  <!-- Bootstrap Core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet" />
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
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>


  <!------ Include the above in your HEAD tag ---------->
  <link rel="stylesheet" href="../css/login.css">
  <link rel="stylesheet" href="../css/estilo_letra_menu.css">
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

      <?php if (!isset($nombre)) { ?>
        <!-- Si no se recibe el nombre del usuario de la base de datos, te redirige aparece la página de login -->
        <li><a href="login.php">Login</a></li>
      <?php } else { ?>
        <!-- Si vuelves a la página de inicio despúes de haber iniciado sesión, y vuelves a darle a tu nombre de ususario te redirige
                a un menu desplegable.-->
        <li class="dropdown">

          <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user"></i> <?php echo $nombre ?> <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a cla href="miCuenta.php">Mi Cuenta</a></li>
            <li><a href="misCompras.php">Mis compras</a></li>
            <li><a href="logout.php">Cerrar sesión</a></li>
          </ul>
        </li>
      <?php } ?>
      <li><a href="contacto.php">Contacto</a></li>
      <li><a href="tienda.php">Tienda</a></li>
      <li><a class="active" href="carrito.php"><i class="fa-solid fa-cart-shopping"></i> Carrito <span id="num_cart" class="badge bg-secondary"><?php echo $num_cart; ?></span></a></li>

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

  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-login">
          <div class="panel-heading">
            <div class="row">
              <div class="col-6 text-center">
                <h1>Contáctame</h1>
              </div>
            </div>
            <hr>
          </div>
          <h4 class="mensaje_h4">Mensaje enviado correctamente.<h4>
              <div class="panel-body">
                <div class="row">
                  <div class="col-lg-12">

                  </div>
                </div>
              </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer>
    <p class="copyright text-muted">Copyright &copy; TuPlegable.com 2024</p>
  </footer>

  <!-- jQuery -->
  <script src="vendor/jquery/jquery.min.js"></script>

  <!-- Bootstrap Core JavaScript -->
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

  <!-- Contact Form JavaScript -->
  <script src="js/jqBootstrapValidation.js"></script>
  <script src="js/contact_me.js"></script>

  <!-- Theme JavaScript -->
  <script src="js/clean-blog.min.js"></script>
</body>

</html>