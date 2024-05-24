<?php
require 'config/config.php';
require 'config/database.php';

$nombre; /*Si nombre esta vacio, es decir, si la variable esta vacía, abajo se ejecuta una página u otra, es decir, la
          página de LOGIN o la página de MI CUENTA con el nombre del usuario. */

if(isset($_SESSION['usuario_correo'])){
$db = new Database();
$con = $db->conectar();

$sql = $con->prepare("SELECT nombre FROM usuario WHERE correo = ?");
$sql->execute([$_SESSION['usuario_correo']]);
$row = $sql->fetch(PDO::FETCH_ASSOC);

// print_r($_SESSION);
$nombre = $row['nombre'];
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />

    <!-- Theme CSS -->
    <link href="css/clean-blog.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/style.css" />

    <!-- Custom Fonts -->
    <link
      href="vendor/font-awesome/css/font-awesome.min.css"
      rel="stylesheet"
      type="text/css"
    />
    <link
      href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic"
      rel="stylesheet"
      type="text/css"
    />
    <link
      href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800"
      rel="stylesheet"
      type="text/css"
    />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body style="background-color: #242424">
    <!-- Navigation -->
    <nav>
      <input type="checkbox" id="check" />
      <label for="check" class="checkbtn">
        <i class="fas fa-bars"></i>
      </label>
      <a class="enlace" href="index.php">
        <img src="img/logo.png" alt="logo" class="logo" width="200px" />
      </a>

      <ul>
        <li><a class="active" href="index.php">Inicio</a></li>

        <?php if(!isset($nombre)){?>
          <!-- Si no se recibe el nombre del usuario de la base de datos, te redirige aparece la página de login -->
          <li><a  href="html/login.php">Login</a></li>
        <?php } else{?>
          <!-- Si vuelves a la página de inicio despúes de haber iniciado sesión, y vuelves a darle a tu nombre de ususario te redirige
                a un menu desplegable.-->
          <li class="dropdown">
          
          <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user"></i> <?php echo $nombre ?> <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a cla href="php/miCuenta.php">Mi Cuenta</a></li>
            <li><a href="php/logout.php">Cerrar sesión</a></li>
          </ul>
        </li>
          <?php }?>
        <li><a href="php/contacto.php">Contacto</a></li>
        <li><a href="php/tienda.php">Tienda</a></li>
        <li><a href="php/carrito.php"><i class="fa-solid fa-cart-shopping"></i> Carrito <span id="num_cart" class="badge bg-secondary"><?php echo $num_cart; ?></span></a></li>
        
      </ul>
    </nav>

    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header
      class="intro-header"
      style="background-image: url('img/home-bg.jpg')"
    >
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
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
          <div class="post-preview">
            <h1 class="post-title">
              HISTORIA HASTA LLEGAR A LOS DISPOSITIVOS PLEGABLES
            </h1>
            <p>
              Durante estos últimos años hemos visto como el mercado de la
              telefonía móvil ha ido evolucionando gracias al enorme desarrollo
              de la tecnología . Con el tiempo llegaron los primeros Smarthpones
              o móviles inteligentes que supusieron una revolución en el mundo.
              A partir de este momento los teléfonos móviles tal y como los
              conocíamos dejaron de perder su única funcionalidad principal la
              cual consistía fundamentalmente en realizar llamadas y por lo
              tanto estos nuevos dispositivos ya tenían implantadas
              funcionalidades debido en gran parte a que podían establecer
              conexión a Internet como si se tratara de un pequeño ordenador
              capaz de realizar tareas simultáneamente.
            </p>
            <img src="img/moviles1.jpg" alt="moviles1" />
            <p>
              Una de las principales características de estos teléfonos es la
              pantalla táctil capacitiva, que reemplaza a los botones y a la
              pantalla visual pequeña de los teléfonos convencionales. Entre
              otros rasgos comunes está la función multitarea, el soporte
              completo al correo electrónico, el acceso Internet vía Wifi o
              redes LTE, 2G, 3G, 4G, 5G; funciones multimedia (cámara y
              reproductor de audio/vídeo), programas de agenda, administración
              de contactos, acelerómetro, Bluetooth, GPS y algunos programas de
              navegación, así como ocasionalmente la capacidad de leer
              documentos en variedad de formatos como PDF, HTML, TXT y
              documentos ofimáticos.
            </p>
            <p>
              Sin embargo los primeros smarpthones no tenían un tamaño de
              pantalla demasiado grande como para poder disfrutar de contenido
              multimedia durante muchas horas sobretodo por su corta duración de
              la batería. Mientras el desarrollo tecnológico iba aumentando, los
              teléfonos inteligentes fueron evolucionando y la misma vez
              surgieron otro tipos de dispositivos denominados tablets. Estos
              dispositivos compartían la mayoría de las características de un
              smarthpone pero con las diferencias de que su tamaño de pantalla
              era mucho mayor que la de un smarthpone y no puede realizar
              llamadas.
            </p>
            <img src="img/moviles2.jpg" alt="moviles2" />
            <p>
              Conforme las mejoras que se iban implantando, los smartphones
              pasaron de llegar a tener pantallas pequeñas a exageradamente
              grandes, los bordes de las pantallas se disminuyeron, la capacidad
              de la batería aumento considerablemente llegando a ofrecer al
              usuario numerosas cantidad de horas de tiempo de pantalla y las
              mejoras de los procesadores aumento la velocidad multitarea.
            </p>
            <p>
              Pero el hecho de que el dispositivo fuera demasiado grande
              presenta para algunos usuarios una serie de incomodidades como por
              ejemplo en el agarre del dispositivo cuando se esta utilizando y a
              la hora de guardarlo en el bolsillo.
            </p>
            <img src="img/moviles3.jpg" alt="moviles3" width="750px" />
            <p>
              Debido al hecho de que para algunos usuarios los smarthpones con
              pantallas más grandes le resultaran incómodos a la hora de
              transportarlos, los fabricantes se plantearon este problema y en
              el año 2018 durante la conferencia anual para desarrolladores, la
              empresa koreana Samsung presentó oficialmente un prototipo de
              teléfono inteligente plegable, con una pantalla de Samsung Display
              bautizada » Infinity Flex» plegable hacia adentro. Tenía una
              segunda pantalla más pequeña en la cara frontal para utilizar el
              dispositivo una vez cerrado.
            </p>
            <p>
              En el año 2019 Samsung presentó oficialmente el Galaxy Fold en el
              Mobile World Congress el 20 de febrero de 2019. Éste fue el primer
              teléfono inteligente plegable de la historia vendido de forma
              masiva: unas 400.000 unidades se agotaron en tres meses. Sin
              embargo en el momento del lanzamiento del Galaxy Fold se
              plantearon dudas sobre su durabilidad, ya que algunas unidades de
              prueba acabaron dando errores en la pantalla. La salida del
              dispositivo se aplazó hasta el año 2020 con el fin de investigar
              estos fallos y mejorar la durabilidad del dispositivo.
            </p>

            <img src="img/moviles4.jpg" alt="moviles4" width="750px" />

            <p>
              Estos dispositivos plegables todavía no tienen una aceptación y
              una cuota demasiado alta en el mercado de la telefonía debido en
              gran parte a su elevado precio y sobretodo a que todavía presentan
              muchos riesgos de defectos debido sobretodo a la posibilidad de
              roturas de pantalla por su complejo diseño. Desde tu plegable.com
              estamos a la espera de que estos dispositivos mejoren
              considerablemente con el tiempo y alcen el vuelo y se conviertan
              en la mayor tendencia en el mercado.
            </p>
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
