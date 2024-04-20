<?php
require '../config/database.php';
require '../config/clienteFunciones.php';
require '../config/config.php';

$db = new Database();
$con = $db->conectar();



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
      registrar($NIF, $nombre, $apellidos, $correo, $contrasenya, null, null, null, $con);
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


  <title>Clean Blog</title>

  <!-- Bootstrap Core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet" />

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
      <li><a class="active" href="login.php">Login</a></li>
      <li><a href="../php/contacto.php">Contacto</a></li>
      <li><a href="../php/tienda.php">Tienda</a></li>
      <li><a href="#">Carrito <span id="num_cart" class="badget bg-secundary"><?php echo $num_cart; ?></span></a></li>
      
      
      
      
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

                <!-- FORMULARIO INICIO SESIÓN -->
                <form id="login-form" action="login.php" method="post" role="form" style="display: block;">
                  <div class="form-group">
                    <input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Correo electronico*" value="">
                  </div>

                  <div class="form-group">
                    <input type="password" name="contrasenya" id="contrasenya" tabindex="2" class="form-control" placeholder="Contraseña*">
                  </div>

                  <div class="form-group text-center">
                    <input type="checkbox" tabindex="3" class="" name="remember" id="remember">
                    <label for="remember"> Recordarme</label>
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
                          <a href="cambiarContrasenya.html" tabindex="5" class="forgot-password">¿Has olvidado tu contraseña?</a>
                        </div>
                        <input type="hidden" name="accion" value="login">
                      </div>
                    </div>
                  </div>
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



                <!-- FORMULARIO REGISTRO -->
                <form id="register-form" action="login.php" method="post" role="form" style="display: none;">
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
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer>
    <p class="copyright text-muted">Copyright &copy; Your Website 2016</p>
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