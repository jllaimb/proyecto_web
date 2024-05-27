<?php
require '../config/config.php';
require '../config/database.php';


$db = new Database();
$con = $db->conectar();

$cod_pro = isset($_GET['cod_pro']) ? $_GET['cod_pro'] : '';
$token = isset($_GET['token']) ? $_GET['token'] : '';

if ($cod_pro == '' || $token == '') {
  echo 'Error al procesar la petición';
  exit;
} else {
  $token_tmp = hash_hmac('sha1', $cod_pro, KEY_TOKEN);

  if ($token == $token_tmp) {

    $sql = $con->prepare("SELECT count(cod_pro) FROM producto WHERE cod_pro=? AND activo=1
        LIMIT 1");
    $sql->execute([$cod_pro]);
    if ($sql->fetchColumn() > 0) {

      $sql = $con->prepare("SELECT nombre, descripcion, precio_venta, descuento FROM producto WHERE cod_pro=? AND activo=1 LIMIT 1");
      $sql->execute([$cod_pro]);
      $row = $sql->fetch(PDO::FETCH_ASSOC);


      $nombre = $row['nombre'];
      $descripcion = $row['descripcion'];
      $precio_venta = $row['precio_venta'];
      $descuento = $row['descuento'];
      $precio_desc = $precio_venta - (($precio_venta * $descuento) / 100);
      $dir_images = '../img/productos/' . $cod_pro . '/carrusel/';
      $rutaImg = $dir_images . 'imagen.png';

      if (!file_exists($rutaImg)) {
        $rutaImg = 'img/productos/no-photo.jpg';
      }


      $images = array();
      if (file_exists($dir_images)) {
        $dir = dir($dir_images);

        while (($archivo = $dir->read()) != false) {
          if ($archivo != 'imagen.png' && (strpos($archivo, 'png') || strpos($archivo, 'jpg'))) {
            $images = $dir_images . $archivo;
            $imagenes[] = $dir_images . $archivo;
          }
        }

        $dir->close();
      }
    }
  } else {
    echo 'Error al procesar la petición';
    exit;
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

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

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
      <li><a href="../html/login.php">Login</a></li>
      <li><a href="contacto.php">Contacto</a></li>
      <li><a class="active" href="tienda.php">Tienda</a></li>
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

  <!-- Main Content -->
  <main>
    <div class="container">
      <div class="row">
        <div class="col-md-4 order-md-1">

          <div id="carouselImages" class="carousel slide">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="<?php echo $rutaImg; ?>" class="d-block w-100">
              </div>


              <?php
              $dir = '../img/productos/' . $cod_pro . '/carrusel/'; // Reemplaza 'tu_carpeta_de_imagenes/' con la ruta de tu carpeta de imágenes
              $imagenes = glob($dir . '*.{jpg,png,gif}', GLOB_BRACE);

              if (!empty($imagenes)) {
                foreach ($imagenes as $key => $img) {
                  $nombreArchivo = basename($img); // Obtiene el nombre del archivo de la ruta completa
                  if ($nombreArchivo != "imagen.png") {
                    echo "<div class='carousel-item'>
            <img src='$img' class='d-block w-100'>
          </div>";
                  }
                }
              }
              ?>

            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselImages" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselImages" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>

        </div>


        <div class="col-md-6 order-md-2">
          <h2 style="color: white;"><?php echo $nombre; ?></h2>

          <!-- PARA APLICAR EL DESCUENTO -->
          <?php if ($descuento > 0) { ?>

            
            <p style="color: white;  text-decoration: line-through red;
            "><del><?php echo number_format($precio_venta, 2, ',', '.') . MONEDA; ?></del></p>
           
            <h2 style="color: white;">

              <?php echo number_format($precio_desc, 2, ',', '.') . MONEDA; ?>
              <small class="text-success"><?php echo $descuento; ?>% descuento</small>
            </h2>

          <?php } else { ?>

            <h2 style="color: white;"><?php echo number_format($precio_venta, 2, ',', '.') . MONEDA; ?></h2>

          <?php } ?>

            



          <p class="lead">
            <?php echo $descripcion; ?>
          </p>


          <div class="d-grid gap-3 col-10 mx-auto">
            <button style="color: white; background-color: orangered;" class="btn btn-primary" type="button">Comprar ahora</button>
            <button style="color: white;" class="btn btn-outline-primary" type="button" onclick="addProducto(<?php echo
            $cod_pro; ?>, '<?php echo $token_tmp ?>')">Agregar al carrito</button>
          
          </div>

        </div>
      </div>
    </div>
  </main>

  <!-- Footer -->
  <footer>
    <p class="copyright text-muted">Copyright &copy; Your Website 2016</p>
  </footer>

  <!-- jQuery -->
  <script src="vendor/jquery/jquery.min.js"></script>

  <!-- Bootstrap Core JavaScript -->
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />

  <!-- Contact Form JavaScript -->
  <script src="js/jqBootstrapValidation.js"></script>
  <script src="js/contact_me.js"></script>

  <!-- Theme JavaScript -->
  <script src="js/clean-blog.min.js"></script>

  <script>
    function addProducto(cod_pro, token) {
      let url = '../clases/carrito.php'
      let formData = new FormData()
      formData.append('cod_pro', cod_pro)
      formData.append('token', token)

      fetch(url, {
          method: 'POST',
          body: formData,
          mode: 'cors'
        }).then(response => response.json())
        .then(data => {
          if (data.ok) {
            let elemento = document.getElementById("num_cart")
            elemento.innerHTML = data.numero
          }
        })
    }
  </script>
</body>


</html>