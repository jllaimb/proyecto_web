<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 2;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.ionos.es';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'web@worldofcataclysm.eu';                     //SMTP username
    $mail->Password   = '6%x44_OhuN?!!';                               //SMTP password
    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('web@worldofcataclysm.eu', 'TuPlegable.com');
    $mail->addAddress('web@worldofcataclysm.eu');     //Add a recipient

 


    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $_POST['asunto'];
    $mail->Body    = "Este es el correo de " . $_POST['email'] ."<br>" . $_POST['mensaje'];
    $mail->CharSet = 'UTF-8';


    $mail->send();
    
    header("LOCATION: mensajeContacto.php");
    
    echo 'Enviado correctamente';
} catch (Exception $e) {
    echo "Error al enviar: {$mail->ErrorInfo}";
}