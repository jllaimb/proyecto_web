<?php

require '../config/database.php';
require '../config/clienteFunciones.php';
require '../config/config.php';

$db = new Database();
$con = $db->conectar();

$correo;


if (isset($_GET['token'])) {



  $sql = $con->prepare("SELECT correo FROM usuario WHERE token = ?");
  $sql->execute([$_GET['token']]);
  $row = $sql->fetch(PDO::FETCH_ASSOC);

  $correo = $row['correo'];


  //print_r($_SESSION);
  if ($row == false) {
    $_SESSION['error'] = true;
    header("Location: ../html/cambiarContrasenya.php");
  }
}



?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">


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

<body>

  <body style="background-color: #242424">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>


    <!------ Include the above in your HEAD tag ---------->
    <link rel="stylesheet" href="../css/login.css">
    <script src="../js/login.js"></script>
    <link rel="stylesheet" href="../css/estilo_letra_menu.css">
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
        <li><a href="contacto.php">Contacto</a></li>
        <li><a href="tienda.php">Tienda</a></li>
        <li><a href="carrito.php"><i class="fa-solid fa-cart-shopping"></i> Carrito <span id="num_cart" class="badge bg-secondary"><?php echo $num_cart; ?></span></a></li>

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


    <div class="container">
      <div class="row">
        <div class="col-md-6 col-md-offset-3">
          <div class="panel panel-login">
            <div class="panel-heading">
              <div class="row">
                <h1>Recuperación Contraseña</h1>
                <p>Introduzca la nueva contraseña </p>
              </div>
              <hr>
            </div>
            <div class="panel-body">
              <div class="row">


              <script src="../js/validarNuevaContrasenya.js"></script>

                  <!-- FORMULARIO PARA CAMBIAR LA CONTRASEÑA -->
                   
                <form name="nuevaContrasenya" id="register-form" action="nuevaContrasenya.php" method="post" role="form" style="display: block;" onsubmit="return validarNuevaContrasenya()">
                  <div class="form-group">
                    <label for="nuevaContrasenya">Introduzca una nueva nueva contraseña:</label>
                    <input type="password" name="nuevaContrasenya" id="nuevaContrasenya" tabindex="1" class="form-control" placeholder="Nueva contraseña" value="">
                  </div>
                  <div class="form-group">
                    <label for="repetirContrasenya">Repite contraseña</label>
                    <input type="password" name="repetirContrasenya" id="repetirContrasenya" tabindex="1" class="form-control" placeholder="Repite contraseña" value="">
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-6 col-sm-offset-3">
                        <input type="submit" name="Cambiar contrasenya" id="Cambiar contrasenya" tabindex="4" class="form-control btn btn-register" value="Cambiar contraseña">
                      </div>
                    </div>
                  </div>
                  <input type="hidden" name="email" value="<?php echo $correo ?>">
                  <!-- Para pasar de un formulario a otro la variable. Es oculto.-->
                </form>
                <p id="error_validacion"></p>
              </div>
            </div>


            <?php

            if (isset($_POST["nuevaContrasenya"]) && isset($_POST["repetirContrasenya"])) {
              $nuevaContrasenya = hash("sha512", $_POST["nuevaContrasenya"]);
              $repetirContrasenya = hash("sha512", $_POST["repetirContrasenya"]);


              // Aquí se verifican si las contraseñas coinciden
              if ($nuevaContrasenya == $repetirContrasenya) {

                $email = trim($_POST['email']);
                cambiarContrasenya($nuevaContrasenya, $email, $con);

                // Se muestra un mensaje de éxito después de cambiar la contraseña
                echo "<h4>Contraseña cambiada con éxito.</h4>";
              } else {
                // Si las contraseñas no coinciden se muestra un mensaje de error
                echo "<h4>Error: Las contraseñas no coinciden.</h4>";
              }
            }



            ?>
  </body>

  <!-- Footer -->
  <footer class="footer">
    <div class="footer-container">
    <a href="terminosCondiciones.php">Terminos y condiciones</a>
    <p class="copyright text-muted">Copyright &copy; TuPlegable.com 2024</p>
      
    </div>
  </footer>