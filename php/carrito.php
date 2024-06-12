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
//Esta sintaxis comprueba si la variable $_SESSION['carrito']['productos'] esta definida y no es nula,
// si se cumple se obtiene y se asigna a la variable productos. Si no se cumple se le asigna null; 

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
    <link rel='stylesheet' type='text/css' media='screen' href='../css/estiloCarrito.css'>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


    <!-- Bootstrap Core CSS -->
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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

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
    <main>
        <div class="container">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($lista_carrito == null) {
                            echo '<tr><td colspan="5" class="text-center"><b>Lista vacia</b></td></tr>';
                        } else {
                            $total = 0;

                            foreach ($lista_carrito as $producto) {
                                $_cod_pro = $producto['cod_pro'];
                                $nombre = $producto['nombre'];
                                $precio = $producto['precio_venta'];
                                $descuento = $producto['descuento'];
                                $cantidad = $producto['cantidad'];
                                $precio_desc = $precio - (($precio * $descuento) / 100);
                                $subtotal = $cantidad * $precio_desc;
                                $total += $subtotal;

                        ?>

                                <tr>
                                    <td><?php echo $nombre; ?></td>
                                    <td><?php echo number_format($precio_desc, 2, ',', '.') . MONEDA; ?></td>
                                    <td>
                                        <input class="cant" type="number" min="1" max="10" step="1" value="<?php echo 
                                        $cantidad ?>" size="5" id="cantidad_<?php echo $_cod_pro; ?>" onchange="actualizaCantidad(this.value, <?php echo $_cod_pro ?>)">
                                    </td>
                                    <td>
                                        <div id="subtotal_<?php echo $_cod_pro; ?>" name="subtotal[]">
                                            <?php echo number_format($subtotal, 2, ',', '.') . MONEDA; ?></div>
                                    </td>
                                    <td><a id="eliminar" class="btn btn-warning btn-sm" data-bs-id="<?php echo
                                    $_cod_pro; ?>" data-toggle="modal" data-target="#eliminaModal">Eliminar</a></td>
                                </tr>
                            <?php } ?>

                            <tr>
                                <td colspan="3"></td>
                                <td colspan="2">TOTAL
                                    <p class="h3" id="total"><?php echo number_format($total, 2, ',', '.') . MONEDA ?></p>
                                </td>
                            </tr>


                    </tbody>

                <?php } ?>
                </table>
            </div>

            <?php if ($lista_carrito != null) { ?>                  
            <div class="row">
                <div class="col-md-5 offset-md-7 d-grid gap-2">
                  <?php if(isset($_SESSION['usuario_correo'])){?>
                  
                    <a href="pago.php" class="btn btn-primary btn-lg">Realizar pago</a>

                    <?php } else{?>

                      <a href="login.php" class="btn btn-primary btn-lg">Realizar pago</a>
                      <?php }?>
                </div>
            </div>
            <?php } ?>

        </div>
    </main>
  

<!-- Modal -->
<div class="modal fade" id="eliminaModal" tabindex="-1" role="dialog" aria-labelledby="eliminaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="eliminaModalLabel">Alerta</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          ¿Desea eliminar el producto de la lista?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button id="btn-elimina"type="button" class="btn btn-danger" onclick="eliminar()">Eliminar</button>
        </div>
      </div>
    </div>
  </div>


  <link rel="stylesheet" href="../css/style.css" />
 <!-- Footer -->
 <footer class="footer">
    <div class="footer-container">
    <a class="termin"  href="terminosCondiciones.php">Terminos y condiciones</a>
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
              <!-- <script src="http://192.168.1.102/pago.js"></script> -->
               


    <script src="../js/actualizarEliminarCantidad.js"></script>

</body>

</html>