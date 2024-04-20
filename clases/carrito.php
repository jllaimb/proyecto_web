<?php

require '../config/config.php';

if(isset($_POST['cod_pro'])){
    
    $cod_pro = $_POST['cod_pro'];
    $token = $_POST['token'];


    $token_tmp = hash_hmac('sha1', $cod_pro, KEY_TOKEN);

    if ($token == $token_tmp) {

        if(isset( $_SESSION['carrito']['productos'][$cod_pro])){
            $_SESSION['carrito']['productos'][$cod_pro] += 1;
        } else {
            $_SESSION['carrito']['productos'][$cod_pro] = 1;
        }

        $datos['numero'] = count($_SESSION['carrito']['productos']);
        $datos['ok'] = true;
    } else {
        $datos['ok'] = false;
    }
} else {
    $datos['ok'] = false;
}

echo json_encode($datos);


