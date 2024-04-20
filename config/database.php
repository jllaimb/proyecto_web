<?php   


class Database {

    private $hostname = "localhost";
    private $database = "tienda_online";
    private $username = "root";
    private $password = "";
    private $charset = "utf8";

    function conectar()
    {
        try{
        $conexion = "mysql:host=" . $this->hostname . "; dbname=" . $this->database . "; charset". $this->charset;
        $options = [
             PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, //Para generar excepciones en caso de que tenga con la conexión.
             PDO::ATTR_EMULATE_PREPARES => false //Configuración para evitar que las preparaciones de las consultas no sean emuladas y tengan seguridad.
        ];

        $pdo = new PDO($conexion, $this->username, $this->password, $options);

        return $pdo;
        
    } catch(PDOException $e){
        echo 'Error conexion: ' . $e->getMessage();
        exit;
    }
    }
}





?>




