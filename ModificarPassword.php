<?php
header("Cache-Control: no-store, no-cache, must-revalidate");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();
$show_error = False;

if (isset($_POST['password'])) {
    require_once('config.php');
    $email = $_GET['email'];
    $recovery_code = $_GET['code'];
    $password = $_POST['password'];
    $repeat_password = $_POST['repeat_password'];
    if(strcmp($password, $repeat_password) == 0) {
        $hashed_password = crypt($password);
        $link = mysqli_connect($servidor, $usuario, $pass, $bbdd);
        $sql = "update usuarios set password='$hashed_password' where email='$email' and recovery_code='$recovery_code'";


        if (!mysqli_query($link, $sql)) {
            die('Error: ' . mysqli_error($link));
        } else {
            mysqli_close($link);
            echo '<script> location.replace("./layout.php"); </script>';
        }

    }else{
        $show_error = True;
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

//$email;
//if (isset($_POST['password'])) {
//    require_once('config.php');
//    $link = mysqli_connect($servidor, $usuario, $pass, $bbdd);
//
//    $code = $_GET['code'];
//    $password = $_POST['password'];
//    $hashed_password = crypt($password);
//
//    $usuarios = mysqli_query($link, "select * from usuarios where code='$code'");
//    mysqli_query($link, "update usuarios set password='$hashed_password' where code='$code'");
//
//    mysqli_close($link);
//
//    echo '<script>window.open("./layout.php", "_self");</script>';
//}
//?>
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

                <legend align="center">Modificar password</legend>
                <form action="./ModificarPassword.php?email=<?php echo $_GET['email']; ?>&code=<?php echo $_GET['code']; ?>" method="post">
                    <div style="padding: 20px; max-width: 240px; margin: 0 auto;">
                        <label for="input_password">Password:*</label>
                        <input id="input_password" class="form-control" style="width: 200px" name="password"
                               type="password" required><br>
                        <label for="input_repeat_password">Repeat password:*</label>
                        <input id="input_repeat_password" class="form-control" style="width: 200px" name="repeat_password"
                               type="password" required><br>
                        <div style="max-width: 70px; margin: 0 auto;">
                            <input type="submit" class="btn btn-primary" value="Enviar">
                        </div>
                    </div>
                </form>
            </fieldset>
            <?php
            if ($show_error == True) {
                echo "<p>Las contraseñas no coinciden</p>";
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
