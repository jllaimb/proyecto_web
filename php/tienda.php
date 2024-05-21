<?php
require '../config/config.php';
require '../config/database.php';

$db = new Database();
$con = $db->conectar();

$sql = $con->prepare("SELECT cod_pro, nombre, precio_venta FROM producto WHERE activo = 1");
$sql->execute();
$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);




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
      <li><a href="carrito.php">Carrito <span id="num_cart" class="badget bg-secundary"><?php echo $num_cart; ?></span></a></li>  
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
      <div class="row row-cols-1 row-cols-md-2 row-cols-md-4 g-9">
        <?php foreach ($resultado as $row) { ?>
          <div class="col">
            <div class="card shadow-sm">
              <?php
              
              $cod_pro = $row['cod_pro'];
              $imagen = "../img/productos/" . $cod_pro   . "/imagen.png";

              if(!file_exists($imagen)) {
                $imagen = "../img/productos/no-photo.jpg";
              }
      

              ?>
              <img src="<?php echo $imagen; ?>">
              <div class="card-body">
                <h5 style="color:black" class="card-title"><?php echo $row['nombre']; ?></h5>
                <p style= "color:black"class="card-text"><?php echo number_format($row['precio_venta'], 2,',' , '.'); ?>€</p>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">
                    <a href="details.php?cod_pro=<?php echo $row['cod_pro']; ?>&token=<?php echo hash_hmac('sha1', $row['cod_pro'], KEY_TOKEN);?>" class="btn btn-primary">Detalles</a>
                  </div>
                  
                  <button id="addToCartButton" class="btn btn-success type="button" onclick="addProducto
                  (<?php echo $row['cod_pro']; ?>, '<?php echo hash_hmac('sha1', $row['cod_pro'], KEY_TOKEN);?>')">Agregar</button>

                  
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
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