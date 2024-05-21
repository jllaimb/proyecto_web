<?php

define("CLIENT_ID", "AZK6ysIcb3mH7E2GrG7Tlb6qkUUqJEKzaylQxl8t13NWk3Fqs7C0R3mKrDqWTDeVkw4xHaCON81Z8HpU");
define("CURRENCY", "EUR");
define("KEY_TOKEN", "BRC.rtf-528*");
define("MONEDA", "€");

session_start();

$num_cart = 0;
if(isset( $_SESSION['carrito']['productos'])) {
    $num_cart = count($_SESSION['carrito']['productos']);
}

?>