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
    $nombre = $row['nombre'];
}

if (isset($_POST['asunto'])) {
    enviarEmail("Mensaje Web", "Asunto: " . $_POST['asunto'] . "<br>Este es el correo de " . $_POST['email'] . "<br>" . $_POST['mensaje'], "tuplegable@outlook.com");
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
    <?php include "menu.php" ?>

<br><br>
    
    <p class="apartado">Políticas, Términos y Condiciones de la Tienda Virtual TuPlegable.com</p>
    
    <p class="apartado">Introducción</p>
    <p>1.1 Bienvenido a TuPlegable.com, una tienda virtual dedicada a la venta de teléfonos plegables. Estas políticas, términos y condiciones se aplican a todas las compras realizadas en nuestra tienda virtual. Al hacer una compra, usted acepta estas políticas, términos y condiciones. Si no está de acuerdo con alguna de ellas, no podrá realizar una compra en nuestra tienda.</p>
    <p>1.2 Nos reservamos el derecho de actualizar, modificar o cambiar estas políticas, términos y condiciones en cualquier momento y sin previo aviso. Es responsabilidad del usuario revisar periódicamente estos términos y condiciones para estar al tanto de cualquier cambio.</p>
    
    <br>
    <p class="apartado">Información de la Tienda</p>
    <p>2.1 TuPlegable.com es propiedad de TuPlegable S.A, registrada en España. Nuestro número de identificación fiscal es A29268166.</p>
    <p>2.2 La dirección de nuestra tienda virtual es Calle Virgen de la Palma 43. Si necesita comunicarse con nosotros, puede hacerlo a través de nuestra página de contacto.</p>

    <br>
    <p class="apartado">Precios y Pagos</p>
    <p>3.1 Todos los precios que aparecen en nuestra tienda virtual están en € e incluyen el impuesto al valor agregado (IVA).</p>
    <p>3.2 Aceptamos las siguientes formas de pago: Tarjetas de débito y crédito, Paypal.</p>
    <p>3.3 El pago se realizará en el momento de la compra. Una vez que se haya realizado el pago, se enviará un correo electrónico de confirmación al usuario.</p>

    <br>
    <p class="apartado">Envío y Entrega</p>
    <p>4.1 Los productos se enviarán a la dirección proporcionada por el usuario en el momento de la compra. El costo de envío se calculará en función de la dirección de entrega y del peso del producto.</p>
    <p>4.2 Hacemos todo lo posible para entregar los productos en el plazo indicado en la descripción del producto. Sin embargo, no nos hacemos responsables de los retrasos causados por el proveedor de servicios de envío.</p>
    <p>4.3 El usuario es responsable de proporcionar una dirección de entrega precisa y completa. Si el paquete es devuelto a nuestra tienda debido a una dirección incorrecta o incompleta, el usuario será responsable de los costos de reenvío.</p>
    <p>4.4 Si el paquete se pierde durante el envío, haremos todo lo posible para resolver el problema. Si no podemos localizar el paquete, proporcionaremos un reembolso completo al usuario.</p>

    <br>
    <p class="apartado">Devoluciones y Reembolsos</p>
    <p>5.1 Si el usuario no está satisfecho con su compra, puede devolver el producto en un plazo de 20 días a partir de la fecha de entrega. El producto debe estar en las mismas condiciones en que fue recibido, sin usar y en su embalaje original.</p>
    <p>5.2 El usuario es responsable de los costos de envío de la devolución. Una vez que hayamos recibido el producto, proporcionaremos un reembolso completo en un plazo de 3 a 5 días.</p>
    <p>5.3 No se aceptarán devoluciones de productos personalizados o productos que hayan sido usados.</p>

    <br>
    <p class="apartado">Propiedad Intelectual</p>
    <p>6.1 Todo el contenido de nuestra tienda virtual, incluyendo imágenes, textos y diseños, son propiedad de TuPlegable S.A y están protegidos por las leyes de propiedad intelectual.</p>
    <p>6.2 Queda prohibida la reproducción, distribución, exhibición, transmisión o explotación de cualquier contenido de nuestra tienda virtual sin nuestro permiso expreso por escrito.</p>

    <br>
    <p class="apartado">Privacidad</p>
    <p>7.1 Nos comprometemos a proteger la privacidad de nuestros usuarios. Para obtener más información sobre cómo manejamos su información personal, consulte nuestra Política de Privacidad.</p>

    <br>
    <p class="apartado">Limitación de Responsabilidad</p>
    <p>8.1 No nos hacemos responsables de ningún daño directo, indirecto, incidental, especial o consecuente que pueda resultar del uso o la imposibilidad de uso de nuestra tienda virtual.</p>
    <p>8.2 No garantizamos que nuestra tienda virtual esté libre de errores o virus, o que su acceso a ella sea ininterrumpido.</p>
    <p>8.3 En ningún caso nuestra responsabilidad superará el precio de compra del producto en cuestión.</p>

    <br>
    <p class="apartado">Ley Aplicable y Jurisdicción</p>
    <p>9.1 Estas políticas, términos y condiciones se regirán e interpretarán de acuerdo con las leyes de España, sin dar efecto a ninguna disposición sobre conflicto de leyes.</p>
    <p>9.2 Cualquier disputa que surja en relación con estas políticas, términos y condiciones se resolverá exclusivamente en los tribunales de Algeciras, España.</p>

    <br>
    <p class="apartado">Disposiciones Generales</p>
    <p>10.1 Estas políticas, términos y condiciones constituyen el acuerdo completo entre el usuario y TuPlegable.com con respecto al uso de nuestra tienda virtual y reemplazan cualquier acuerdo previo.</p>
    <p>10.2 Si alguna disposición de estas políticas, términos y condiciones se considera inválida o inaplicable, esa disposición se interpretará de manera consistente con la ley aplicable para reflejar, en la medida de lo posible, la intención original de las partes, y las demás disposiciones seguirán siendo válidas y aplicables.</p>
    <p>10.3 El hecho de que no ejerzamos ningún derecho o disposición de estas políticas, términos y condiciones no constituirá una renuncia a tal derecho o disposición.</p>

    <p>Fecha de última actualización: 11/06/2024</p>

    <!-- Footer -->
    <footer>
        <p class="copyright text-muted">Copyright &copy; TuPlegable.com 2024</p>
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
