  <?php

function registrar($NIF, $nombre, $apellidos, $correo, $contrasenya, $telf, $direccion, $CP, $con)
{
  $contrasenya = hash("sha512", $contrasenya);

  $sql = $con->prepare('INSERT INTO usuario (NIF, nombre, apellidos, correo, contrasenya, telf, direccion, CP) VALUES (?,?,?,?,?,?,?,?)');

  $sql->bindParam(1, $NIF);
  $sql->bindParam(2, $nombre);
  $sql->bindParam(3, $apellidos);
  $sql->bindParam(4, $correo);
  $sql->bindParam(5, $contrasenya);
  $sql->bindParam(6, $telf);
  $sql->bindParam(7, $direccion);
  $sql->bindParam(8, $CP);

  $sql->execute();
}


function cambiarContrasenya($nuevaContrasenya, $email, $con)
{

  $sql = $con->prepare('UPDATE usuario SET contrasenya = ? WHERE correo = ?');
  $sql->bindParam(1, $nuevaContrasenya);
  $sql->bindParam(2, $email);
  $sql->execute();
}

function login($correo, $contrasenya, $con)
{
  //A PARTIR DEL CORREO COMPARAMOS LA CONTRASEÑA DE LA BASE DE DATOS 
  $sql = $con->prepare('SELECT NIF, correo, contrasenya FROM usuario WHERE correo LIKE ?');
  $sql->bindParam(1, $correo);
  $sql->execute();


  if ($row = $sql->fetch(PDO::FETCH_ASSOC)) {   //SI DEVUELVE UNA FILA, SE ASIGNA A LA VARIABLE ROW
    $contrasenya = hash("sha512", $contrasenya);


    if ($contrasenya == $row['contrasenya']) {

      $_SESSION['usuario_correo'] = $row['correo'];

      header("Location: login.php");
      exit;

    } else {
      return 'El correo y/o contraseña son incorrectos.';
    }
  } else {

    return 'El correo y/o contraseña son incorrectos.';
  }
}
