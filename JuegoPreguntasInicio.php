<?php
header("Cache-Control: no-store, no-cache, must-revalidate");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if(isset($_POST['preguntasAleatorias'])){
    $_SESSION['partida'] = [
            'modo' => 'aleatorio'
    ];
    echo '<script>window.open("./EmpezarJuego.php", "_self");</script>';
}
if(isset($_POST['preguntasTema'])){
    $_SESSION['partida'] = [
        'modo' => 'tema'
    ];
    echo '<script>window.open("./EscojeTemaPreguntas.php", "_self");</script>';
}



?>

<!DOCTYPE html>
<html>
<head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
    <title>Preguntas</title>
    <link rel='stylesheet' type='text/css' href='estilos/style.css' />
    <link rel='stylesheet'
          type='text/css'
          media='only screen and (min-width: 530px) and (min-device-width: 481px)'
          href='estilos/wide.css' />
    <link rel='stylesheet'
          type='text/css'
          media='only screen and (max-width: 480px)'
          href='estilos/smartphone.css' />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<div id='page-wrap'>
    <header class='main' id='h1'>
        <?php
        if (isset($_SESSION['email'])) {
            echo '<span class="right"><a href="./layout.php" onclick="decrementarUsuarios()">Logout</a></span>';
        } else {
            echo '<span class="right"><a href="./Registrar.php">Registrarse</a></span>';
            echo '<span> </span>';
            echo '<span class="right"><a href="./Login.php">Login</a></span>';
        }
        ?>
        <div style="float: right;">
            <?php
            $email;
            if(isset($_SESSION['email'])){
                require_once('config.php');
                $link = mysqli_connect($servidor, $usuario, $pass, $bbdd);
                $email = $_SESSION['email'];
                $user= mysqli_query($link, "SELECT * FROM usuarios WHERE email =\"".$email."\"");
                $row = mysqli_fetch_array($user);
                if (strlen ($row['image'])> 0 ){
                    $image = 'image.png';
                    echo '<img height="42" width="42" src="data:image/jpeg;base64,'.base64_encode( $row['image'] ).'"/>';
                }else{
                    echo "<p>".$email."</p>";
                }
            }
            ?>
        </div>

        <h2>Quiz: el juego de las preguntas</h2>

    </header>
    <nav class='main' id='n1' role='navigation'>
        <?php
        if (isset($_SESSION['email'])) {
            echo "<span><a href='layout.php'>Inicio</a></span>";
            echo "<span><a href='./preguntasHTML5.php'>Preguntas</a></span>";
            if ($_SESSION['email'] != 'web000@ehu.es') {
                echo "<span><a href='GestionarPreguntas.php'>Gestionar preguntas</a></span>";
            } else {
                echo "<span><a href='RevisarPreguntas.php'>Revisar preguntas</a></span>";
            }
            echo "<span><a href='./creditos.php'>Creditos</a></span>";
            echo "<span><a href='./ClienteDeSW.php'>Cliente consumidor del SW</a></span>";

        } else {
            echo "<span><a href='layout.php'>Inicio</a></span>";
            echo "<span><a href='./creditos.php'>Creditos</a></span>";
        }
        ?>
    </nav>
    <section class="main" id="s1">
        <div class="container" align="center">
            <h1>¿Cuanto sabes? Pruebame.</h1>
            <br/>
            <p>Selecciona uno de los modos de juego para empezar a jugar</p>
            <br/>
            <form action="JuegoPreguntasInicio.php" method="post">
                <div class="row justify-content-center">
                    <div class="col-2">
                        <input id="preguntasAleatorias" class="btn btn-primary" type="submit" name="preguntasAleatorias" value="Preguntas aleatorias">
                    </div>
                    <div class="col-2">
                        <input id="preguntasTema" class="btn btn-primary" type="submit" name="preguntasTema" value="Sobre un tema">
                    </div>
                </div>
            </form>
        </div>
    </section>
    <footer class='main' id='f1'>
        <p><a href="http://es.wikipedia.org/wiki/Quiz" target="_blank">Que es un Quiz?</a></p>
        <a href='https://github.com'>Link GITHUB</a>
    </footer>
</div>
<script>


</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
</body>
</html>
