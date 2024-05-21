<?php

require '../config/config.php';
require '../config/database.php';

$db = new Database();
$con = $db->conectar();

$json = file_get_contents('php://input');
$datos = json_decode($json, true);

echo '<pre>';
print_r($datos);
echo '</pre>';


if(is_array($datos)){

    $id_transaccion = $datos['detalles']['id'];     //id_transaccion paypal
    $fecha = $datos['detalles']['update_time']; //fecha_ped
    $status = $datos['detalles']['status']; //status
    $fecha_nueva = date('Y-m-d H:i:s', strtotime($fecha));
    //$id_cliente = $datos['detalles']['payer']['payer_id']; //ID DE USUARIO DE PAYPAL;

    //(HAY QUE HACERLO CON LAS SESSIONES PORQUE EL USUARIO DEBE DE ESTAR REGISTRADO PARA HACER LA COMPRA.)
    $sql = $con->prepare("SELECT NIF FROM usuario WHERE correo = ?");
    $sql->execute([$_SESSION['usuario_correo']]);
    $row = $sql->fetch(PDO::FETCH_ASSOC);
    $NIF = $row['NIF'];


    $total = $datos['detalles']['purchase_units'][0]['amount']['value']; //total_ped
   

    $sql = $con->prepare("INSERT INTO pedido (id_transaccion, fecha_ped, status, NIF, total_ped) VALUES (?,?,?,?,?)");
    $sql->execute([$id_transaccion, $fecha_nueva, $status, $NIF, $total]);
    $num_pedido = $con->lastInsertId('num_pedido');



    if($num_pedido > 0) {
        $productos = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;

        if ($productos != null) {
            foreach ($productos as $clave => $cantidad) {

                    $sql_insert_productopedido = $con->prepare("INSERT INTO producto_pedido (cod_pro, num_ped, cantidad) VALUES (?,?,?)");
                    $sql_insert_productopedido->execute([$clave, $num_pedido, $cantidad]);
            }
        }
    }

}


?>