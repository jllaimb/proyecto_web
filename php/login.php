<?php
require '../config/database.php';
require '../config/clienteFunciones.php';
require '../config/config.php';
require 'correo.php';

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


$errors = [];
if (!empty($_POST)) {
  if ($_POST['accion'] == 'registro') {
    $nombre = trim($_POST['nombre']);
    $apellidos = trim($_POST['apellidos']);
    $NIF = trim($_POST['NIF']);
    $correo = trim($_POST['correo']);
    $contrasenya = trim($_POST['contrasenya']);

    // VERIFICAR SI LOS CAMPOS NO ESTAN VACIOS
    if (!empty($nombre) && !empty($apellidos) && !empty($NIF) && !empty($correo) && !empty($contrasenya)) {

      //PARA COMPROBAR QUE EL CORREO NO SE ENCUENTRE YA REGISTRADO 
      $sql = $con->prepare("SELECT correo FROM usuario WHERE correo = ?");
      $sql->execute([$correo]);
      $row = $sql->fetch(PDO::FETCH_ASSOC);

      if($row == false) {

        registrar($NIF, $nombre, $apellidos, $correo, $contrasenya, null, null, null, $con);
       
      } else {
        $errors[] = "Este correo ya se encuentra registrado.";
        
      }

      
    } else {
      $errors[] = "Los campos con * deben de estar rellenos.";
    }
  }

  //PARA EL LOGUEO
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


  <title>TuPlegable</title>

  <!-- Bootstrap Core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
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
      <li><a class="active"   href="login.php">Login</a></li>
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

  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-login">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-6">
                <a href="#" class="active" id="login-form-link">Iniciar sesión</a>
              </div>
              <div class="col-xs-6">
                <a href="#" id="register-form-link">Regístrate ahora</a>
              </div>
            </div>
            <hr>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-lg-12">

                <script src="../js/validarLogin.js"></script>

                <!-- FORMULARIO INICIO SESIÓN -->
                <form name="logueo" id="login-form" action="login.php" method="post" role="form" style="display: block;" onsubmit="return validarLogin()">
                  <div class="form-group">
                    <input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Correo electronico*" value="">
                  </div>
                  <div class="form-group">
                    <input type="password" name="contrasenya" id="contrasenya" tabindex="2" class="form-control" placeholder="Contraseña*">
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-6 col-sm-offset-3">
                        <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Iniciar sesión">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="text-center">
                          <a href="cambiarContrasenya.php" tabindex="5" class="forgot-password">¿Has olvidado tu contraseña?</a>
                        </div>
                        <input type="hidden" name="accion" value="login">
                      </div>
                    </div>
                  </div>
                  <p id="error_validacion"></p>
                </form>

                <div class="col-lg-12">
                  
                  <?php if (!empty($errors)) : ?>
                    <div class="alert alert-danger">

                      <?php foreach ($errors as $error) : ?>
                        <p style="color:red;"><?php echo $error; ?></p>
                      <?php endforeach; ?>

                    </div>
                  <?php endif; ?>
                </div>
                <script src="../js/validarRegistro.js"></script>

                <!-- FORMULARIO REGISTRO -->
                <form name="registro" id="register-form" action="login.php" method="post" role="form" style="display: none;" onsubmit="return validarRegistro()">
                  <div class="form-group">
                    <input type="text" name="nombre" id="nombre" tabindex="1" class="form-control <?php echo (in_array('Los campos con * deben de estar rellenos.', $errors) ? 'has-error' : ''); ?>" placeholder="Nombre*" value="">
                  </div>

                  <div class="form-group">
                    <input type="text" name="apellidos" id="apellidos" tabindex="1" class="form-control" placeholder="Apellidos*" value="">
                  </div>

                  <div class="form-group">
                    <input type="email" name="correo" id="correo" tabindex="1" class="form-control" placeholder="Correo electronico*" value="">
                  </div>

                  <div class="form-group">
                    <input type="text" name="NIF" id="NIF" tabindex="1" class="form-control" placeholder="NIF*" value="">
                  </div>

                  <div class="form-group">
                    <input type="password" name="contrasenya" id="contrasenya" tabindex="2" class="form-control" placeholder="Contraseña*">
                  </div>

                  <div class="form-group">
                    <input type="password" name="confirmar-contrasenya" id="confirmar-contrasenya" tabindex="2" class="form-control" placeholder="Confirmar contraseña">
                  </div>

                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-6 col-sm-offset-3">
                        <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Crear cuenta">
                      </div>
                      <input type="hidden" name="accion" value="registro">
                    </div>
                  </div>
                  <p id="error_validacion2"></p>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php
  if (isset($_POST["nombre"])) {
    enviarEmail(
      "TuPlegable.com, nuevo usuario",

      "<b>¡Hola {$_POST['nombre']}!</b> <p>Bienvenido/a a TuPlegable.com</p>",

      $_POST['correo']
    );
  }
  ?>



  <!-- Footer -->
 <!-- Footer -->
 <footer class="footer">
    <div class="footer-container">
    <a href="terminosCondiciones.php">Terminos y condiciones</a>
    <p class="copyright text-muted">Copyright &copy; TuPlegable.com 2024</p>
      
    </div>
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