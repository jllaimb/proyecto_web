<?php

define("KEY_TOKEN", "BRC.rtf-528*");
define("MONEDA", "€");

session_start();

$num_cart = 0;
if(isset( $_SESSION['carrito']['productos'])) {
    $num_cart = count($_SESSION['carrito']['productos']);
}

?>