<?php
require '../config/config.php';
require '../config/database.php';

$db = new Database();
$con = $db->conectar();

$productos = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;

$lista_carrito = array();

if ($productos != null) {
    foreach ($productos as $clave => $cantidad) {


        $sql = $con->prepare("SELECT cod_pro, nombre, precio_venta, descuento, $cantidad AS cantidad FROM producto WHERE cod_pro=? AND activo = 1");
        $sql->execute([$clave]);
        $lista_carrito[] = $sql->fetch(PDO::FETCH_ASSOC);
    }
} else {
    header("Location: index.php");
    exit;
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
    <link rel='stylesheet' type='text/css' media='screen' href='../css/estiloCarrito.css'> 
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


    <!-- Bootstrap Core CSS -->
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

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
            <li><a href="tienda.php">Tienda</a></li>
            <li><a class="active" href="carrito.php">Carrito <span id="num_cart" class="badget bg-secundary"><?php echo $num_cart; ?></span></a></li></a></li>

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
                <div class="col-6">
                    <h4>Detalles de pago</h4>
                    <div id="paypal-button-container"></div>
                </div>

                <div class="col-6">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Producto</th>
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
                                            <td>
                                                <div id="subtotal_<?php echo $_cod_pro; ?>" name="subtotal[]">
                                                    <?php echo number_format($subtotal, 2, ',', '.') . MONEDA; ?></div>
                                            </td>
                                        </tr>
                                    <?php } ?>


                                    <tr>
                                        <td colspan="2">
                                            <p class="h3 text-end" id="total"><?php echo number_format($total, 2, ',', '.') . MONEDA ?></p>
                                        </td>
                                    </tr>


                            </tbody>

                        <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>



    <script src="https://www.paypal.com/sdk/js?client-id=<?php echo CLIENT_ID;?>&currency=<?php echo CURRENCY;?>"></script>
    <script>
    // Render the PayPal button into #paypal-button-container
    paypal.Buttons({

        style: {
            color:  'blue',
            shape:  'pill',
            label:  'pay',
            height: 40
        },
        createOrder: function(data, actions){
           console.log(<?php echo $total;?>)
            return actions.order.create({  
                purchase_units: [{
                    amount: {
                        
                        value: <?php echo round($total, 2);?>
                    }
                }]
            });
        },

        onApprove: function(data, actions){
            let url = '../clases/captura.php'
            actions.order.capture().then(function(detalles){
               
               //window.location.href='../html/completado.html'
               console.log(detalles);

               return fetch(url, {
                method: 'post',
                headers: {
                    'content-type': 'applications/json'
                },
                body: JSON.stringify({
                    detalles: detalles
                })
               })
            });
        },

        onCancel: function(data){
            alert("Pago cancelado");
            console.log(data);
        }

    }).render('#paypal-button-container');
</script>


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