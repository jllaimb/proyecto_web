<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
function enviarEmail($asunto,$mensaje,$correo,){

    try {
        $mail = new PHPMailer(true);
        //Server settings
        $mail->SMTPDebug = 2;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp-mail.outlook.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'tuplegable@outlook.com';                     //SMTP username
        $mail->Password   = 'p0o9i8u7y6t5';                               //SMTP password
        $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('tuplegable@outlook.com', 'TuPlegable');   // (Lo envía mi correo con la información del cliente.) 
        $mail->addAddress($correo);     //Add a recipient  (Correo del cliente)
    

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML  
        $mail->Subject = $asunto;

        $mail->Body    = $mensaje;
        $mail->AltBody = 'Le enviamos los detalles de su compra.';
        $mail->CharSet = 'UTF-8';


        $mail->setLanguage('es', '../vendor/phpmailer\phpmailer/language/phpmailer.lang-es.php'); //En caso de que se genere algún error, se muestra en


        $mail->send();
      

    } catch (Exception $e) {
        echo "Error al enviar: {$mail->ErrorInfo}";
    }
}




?>