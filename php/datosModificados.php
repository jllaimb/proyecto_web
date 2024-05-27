<?php
require '../config/database.php';
require '../config/clienteFunciones.php';
require '../config/config.php';

$db = new Database();
$con = $db->conectar();


if(isset($_POST)) {
    
    $sql = $con->prepare('UPDATE usuario SET nombre = ?, apellidos = ?, correo = ?, telf = ?, direccion = ?, 
    CP = ? WHERE NIF = ?');
    
    $sql->bindParam(1, $_POST["nombre"]);
    $sql->bindParam(2, $_POST["apellidos"]);
    $sql->bindParam(3, $_POST["correo"]);
    $sql->bindParam(4, $_POST["telf"]);
    $sql->bindParam(5, $_POST["direccion"]);
    $sql->bindParam(6, $_POST["CP"]);
    $sql->bindParam(7, $_POST["NIF"]);
    

    $sql->execute();

    $_SESSION['mensaje'] = "Datos modificados correctamente.";
    
    header("LOCATION: miCuenta.php");
}

?>

