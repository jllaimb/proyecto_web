<?php

require '../config/config.php';
require '../config/database.php';


if (isset($_POST['action'])) {
    $action = $_POST['action'];
    $cod_pro = isset($_POST['cod_pro']) ? $_POST['cod_pro'] : 0;

    if ($action == 'agregar') {
        $cantidad = isset($_POST['cantidad']) ? $_POST['cantidad'] : 0;
       $respuesta = agregar($cod_pro, $cantidad);
       if($respuesta > 0){
        $datos['ok'] = true;
       }else {
        $datos['ok'] = false;
       }
       $datos['sub'] = number_format($respuesta, 2, ',' , '.') . MONEDA;
    }  else if($action == 'eliminar'){
            $datos['ok'] = eliminar($cod_pro);
    } else{
        $datos['ok'] = false;
    }
}else{
    $datos['ok'] = false;
}
echo json_encode($datos); 
    
function agregar($cod_pro, $cantidad)
{
    $res = 0;
    if ($cod_pro > 0 && $cantidad > 0 && is_numeric(($cantidad))) {
        if (isset($_SESSION['carrito']['productos'][$cod_pro])) {
            $_SESSION['carrito']['productos'][$cod_pro] = $cantidad;

            $db = new Database();
            $con = $db->conectar();
            $sql = $con->prepare("SELECT precio_venta, descuento FROM producto WHERE cod_pro=? AND activo=1
             LIMIT 1");
            $sql->execute([$cod_pro]);
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            $precio_venta = $row['precio_venta'];
            $descuento = $row['descuento'];
            $precio_desc = $precio_venta - (($precio_venta * $descuento) / 100);
            $res = $cantidad * $precio_desc;

            return $res;
        }      
    }else{
        return $res;
    }
}


function eliminar($id){
    if($id > 0){
        if  (isset($_SESSION['carrito']['productos'][$id])) {
            unset($_SESSION['carrito']['productos'][$id]);
            return true; 
        }
    } else {
        return false;
    }
}
