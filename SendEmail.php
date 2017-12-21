<?php
header("Cache-Control: no-store, no-cache, must-revalidate");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if (!isset($_SESSION['email'])) {
    echo '<script>location.replace("./layout.php");</script>';
}

$email = $_SESSION['email'];

require_once('config.php');
$link = mysqli_connect($servidor, $usuario, $pass, $bbdd);
$result = mysqli_query($link, "select * from usuarios where email='$email'");

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    $receiver_email = $email;
    $receiver_name = $row['name_lastnames'];
    $recovery_code = $row['recovery_code'];
}

$result->close();
mysqli_close($link);


require_once "vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;

//PHPMailer Object
$mail = new PHPMailer;

//From email address and name
$mail->From = "from@yourdomain.com";
$mail->FromName = "Full Name";

//To address and name
$mail->addAddress($receiver_email, $receiver_name);

//Address to which recipient will reply
$mail->addReplyTo("reply@yourdomain.com", "Reply");


//Send HTML or Plain Text email
$mail->isHTML(true);

$mail->Subject = "Subject Text";
$mail->Body = "<i>https://josebaelde4a.000webhostapp.com/RecuperarPassword.php?code=" . $recovery_code . "</i>";
$mail->AltBody = "This is the plain text version of the email content";

if(!$mail->send())
{
    echo "Mailer Error: " . $mail->ErrorInfo;
}
else
{
    echo "Message has been sent successfully";
    echo "<i>https://josebaelde4a.000webhostapp.com/RecuperarPassword.php?code=" . $recovery_code . "</i>";
}
?>