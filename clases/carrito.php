<?php
require '../config/config.php';

$datos = array('ok' => false); // Initialize the $datos array with 'ok' set to false

if(isset($_POST['cod_pro'])){
    
    $cod_pro = $_POST['cod_pro'];
    $token = $_POST['token'];

    $token_tmp = hash_hmac('sha1', $cod_pro, KEY_TOKEN);

    if ($token == $token_tmp) {

        if(isset($_SESSION['carrito']['productos'][$cod_pro])){
            $_SESSION['carrito']['productos'][$cod_pro] += 1;
        } else {
            $_SESSION['carrito']['productos'][$cod_pro] = 1;
        }

        $datos['numero'] = count($_SESSION['carrito']['productos']);
        $datos['ok'] = true;
    }
}

// Set the content type to application/json
header('Content-Type: application/json');
echo json_encode($datos);
?>
