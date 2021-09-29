<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/phpmailer/src/Exception.php';
require 'phpmailer/phpmailer/src/PHPMailer.php';
require 'phpmailer/phpmailer/src/SMTP.php';

$mail=$_REQUEST['email_send'];
 
$mail = new PHPMailer(true);
try {
    // $mail->SMTPDebug = 2;  // Sacar esta línea para no mostrar salida debug
    $mail->isSMTP();
    $mail->Host = 'mail.callamericangroup.com';  // Host de conexión SMTP
    $mail->SMTPAuth = true;
    $mail->Username = 'no.reply@callamericangroup.com';                 // Usuario SMTP
    $mail->Password = 'Norp239/';                           // Password SMTP
    $mail->SMTPSecure = 'tls';                            // Activar seguridad TLS
    $mail->Port = 587;                                    // Puerto SMTP

    #$mail->SMTPOptions = ['ssl'=> ['allow_self_signed' => true]];  // Descomentar si el servidor SMTP tiene un certificado autofirmado
    #$mail->SMTPSecure = false;				// Descomentar si se requiere desactivar cifrado (se suele usar en conjunto con la siguiente línea)
    #$mail->SMTPAutoTLS = false;			// Descomentar si se requiere desactivar completamente TLS (sin cifrado)
 
    $mail->setFrom('no.reply@callamericangroup.com');		// Mail del remitente
    $mail->addAddress('pipeal1040@gmail.com');     // Mail del destinatario
 
    $mail->isHTML(true);
    $mail->Subject = 'Contacto desde formulario';  // Asunto del mensaje
    $mail->Body    = 'Este es el contenido del mensaje <b>en negrita!</b>';    // Contenido del mensaje (acepta HTML)
    $mail->AltBody = 'Este es el contenido del mensaje en texto plano';    // Contenido del mensaje alternativo (texto plano)
 
    $mail->send();
    $arr = array("s" => '1');
    echo json_encode($arr);
} catch (Exception $e) {
    $arr = array("s" => 'El mensaje no se ha podido enviar, error: ', $mail->ErrorInfo);
    echo json_encode($arr);
}