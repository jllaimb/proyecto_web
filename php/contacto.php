<?php
require '../config/config.php';
require '../config/clienteFunciones.php';
require '../config/database.php';
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

if(isset($_POST['asunto'])){
  enviarEmail("Mensaje Web","Asunto: ". $_POST['asunto']."<br>Este es el correo de " . $_POST['email'] ."<br>" . $_POST['mensaje'],"tuplegable@outlook.com");
  header("LOCATION: mensajeContacto.php");
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
  <link rel="stylesheet" href="../css/login.css">


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
  <?php include "menu.php"?>

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

          <script src="../js/validarMensajeContacto.js"></script>

          <div class="panel-body">
            <div class="row">
              <div class="col-lg-12">
                <form name="mensajeContacto" id="login-form" action="contacto.php" method="post" role="form" style="display: block;" onsubmit="return validarMensajeContacto()">
                  <div class="form-group">
                    <input type="text" name="nombre" id="nombre " tabindex="1" class="form-control" placeholder="Nombre" value="" required>
                  </div>

                  <div class="form-group">
                    <input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email" value="" required>
                  </div>

                  <div class="form-group">
                    <input type="text" name="asunto" id="asunto" tabindex="1" class="form-control" placeholder="Asunto" required>
                  </div>

                  <div class="form-group">
                    <textarea name="mensaje" id="mensaje" class="form-control" cols="61" rows="10" placeholder="Mensaje"></textarea>
                  </div>

                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-6 col-sm-offset-3">
                        <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Enviar">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-12">

                      </div>
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

  <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


</body>

</html>