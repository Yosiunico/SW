<?php
header("Cache-Control: no-store, no-cache, must-revalidate");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();

if (isset($_POST['email'])) {

    require_once('config.php');
    $email = $_POST['email'];
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
    $mail->Body = "<i>https://josebaelde4a.000webhostapp.com/ModificarPassword.php?" . "email=" . $receiver_email . "&" . "code=" . $recovery_code . "</i>";
    $mail->AltBody = "This is the plain text version of the email content";

    if (!$mail->send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        echo "Message has been sent successfully";
    }
}
?>

<html>
<head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
    <title>Registrarse</title>
    <link rel='stylesheet' type='text/css' href='estilos/style.css'/>
    <link rel='stylesheet'
          type='text/css'
          media='only screen and (min-width: 530px) and (min-device-width: 481px)'
          href='estilos/wide.css'/>
    <link rel='stylesheet'
          type='text/css'
          media='only screen and (max-width: 480px)'
          href='estilos/smartphone.css'/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"
          integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<?php
$show_error = False;
$email;
if (isset($_POST['password'])) {
    require_once('config.php');
    $link = mysqli_connect($servidor, $usuario, $pass, $bbdd);

    $code = $_GET['code'];
    $password = $_POST['password'];
    $hashed_password = crypt($password);

    $usuarios = mysqli_query($link, "select * from usuarios where code='$code'");
    mysqli_query($link, "update usuarios set password='$hashed_password' where code='$code'");

    mysqli_close($link);

    echo '<script>window.open("./layout.php", "_self");</script>';
}
?>
<div id='page-wrap'>
    <header class='main' id='h1'>
        <span class="right"><a href="./Registrar.php">Registrarse</a></span>
        <h2>Quiz: el juego de las preguntas</h2>
    </header>
    <nav class='main' id='n1' role='navigation'>
        <?php
        if (isset($_SESSION['email'])) {
            echo "<span><a href='layout.php?logged_user=" . $_SESSION['email'] . "'>Inicio</a></span>";
            echo "<span><a href='./preguntasHTML5.php?logged_user=" . $_SESSION['email'] . "'>Preguntas</a></span>";
            echo "<span><a href='./GestionarPreguntas.php?logged_user=" . $_SESSION['email'] . "'>Gestionar preguntas</a></span>";
            echo "<span><a href='./creditos.php?logged_user=" . $_SESSION['email'] . "'>Creditos</a></span>";
            echo "<span><a href='./ClienteDeSW.php?logged_user=" . $_SESSION['email'] . "'>Cliente consumidor del SW</a></span>";

        } else {
            echo "<span><a href='layout.php'>Inicio</a></span>";
            echo "<span><a href='./creditos.php'>Creditos</a></span>";
        }
        ?>
    </nav>
    <section class="main" id="s1">
        <div align="left">
            <!-- Mostrar formulario para registrarse -->
            <fieldset>

                <legend align="center">Recuperar password</legend>
                <form action="./RecuperarPassword.php" method="post">
                    <div style="padding: 20px; max-width: 240px; margin: 0 auto;">
                        <label for="input_email">Email:*</label>
                        <input id="input_email" class="form-control" style="width: 200px" name="email"
                               type="text" required><br>

                        <div style="max-width: 70px; margin: 0 auto;">
                            <input type="submit" class="btn btn-primary" value="Enviar">
                        </div>
                    </div>
                </form>
            </fieldset>
            <?php
            if ($show_error == True) {
                echo "<p>Nombre de usuario o contraseña incorrectos</p>";
            }
            ?>


        </div>
    </section>
    <footer class='main' id='f1'>
        <p><a href="http://es.wikipedia.org/wiki/Quiz" target="_blank">Que es un Quiz?</a></p>
        <a href='https://github.com'>Link GITHUB</a>
    </footer>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"
        integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"
        integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ"
        crossorigin="anonymous"></script>
</body>
</html>
