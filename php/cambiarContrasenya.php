<?php
require '../config/database.php';
require '../config/clienteFunciones.php';
require '../config/config.php';
require '../php/correo.php';

$db = new Database();
$con = $db->conectar();


$error = "";



if (isset($_POST['email'])) {


    $sql = $con->prepare("SELECT correo FROM usuario WHERE correo = ?");
    $sql->execute([$_POST['email']]);
    $row = $sql->fetch(PDO::FETCH_ASSOC);


    if ($row != false) {
        $token = generarToken();
        echo $token;

        $sql = $con->prepare('UPDATE usuario SET token = ? WHERE correo = ?');
        $sql->bindParam(1, $token);
        $sql->bindParam(2, $_POST['email']);
        $sql->execute();

        enviarEmail("Cambio de contraseña", "Para cambiar su contraseña redirigase a este enlace: <a href='http://localhost/DWEES/Proyecto%20Web/proyecto_web/php/nuevaContrasenya.php?token=$token'>Click aquí</a>", $_POST['email']);
        header("Location: correo_contrasenya.php");
        exit;
    }
    else {
        $error = "El correo no se encuentra registrado.";
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
                                <p>Introduzca la dirección de correo electrónico asociado su cuenta.</p>
                            </div>
                            <hr>
                        </div>
                        <div class="panel-body">
                            <div class="row">


                                <script src="../js/validarCorreoContrasenya.js"></script>

                                <form name="correoNuevaContrasenya" id="register-form" action="cambiarContrasenya.php" method="post" role="form" style="display: block;" onsubmit="return validarCorreo()">
                                    <div class="form-group">
                                        <input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email" value="">
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <input type="submit" name="enviar" id="enviar" tabindex="4" class="form-control btn btn-register" value="Enviar">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <p id="error_validacion"></p>
                            </div>
                        </div>


                        <?php echo $error; ?>
    </body>

  <!-- Footer -->
  <footer class="footer">
    <div class="footer-container">
    <a href="terminosCondiciones.php">Terminos y condiciones</a>
    <p class="copyright text-muted">Copyright &copy; TuPlegable.com 2024</p>
      
    </div>
  </footer>