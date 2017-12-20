<?php

header("Cache-Control: no-store, no-cache, must-revalidate");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

$mail->From = "from@yourdomain.com";
$mail->FromName = "Full Name";

//To address and name
$mail->addAddress("rivasgomezcristian@gmail.com", "Cristian Rivas");
//$mail->addAddress("recepient1@example.com"); //Recipient name is optional

//Address to which recipient will reply
$mail->addReplyTo("reply@yourdomain.com", "Reply");

//CC and BCC
//$mail->addCC("cc@example.com");
//$mail->addBCC("bcc@example.com");

//Send HTML or Plain Text email
$mail->isHTML(true);

$mail->Subject = "Subject Text";
$mail->Body = "<i>Mail body in HTML</i>";
$mail->AltBody = "This is the plain text version of the email content";

if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message has been sent successfully";
}

?>