<?php
header("Cache-Control: no-store, no-cache, must-revalidate");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
    <title>Preguntas</title>
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
            if (isset($_SESSION['email'])) {
                require_once('config.php');
                $link = mysqli_connect($servidor, $usuario, $pass, $bbdd);
                $email = $_SESSION['email'];
                $user = mysqli_query($link, "SELECT * FROM usuarios WHERE email =\"" . $email . "\"");
                $row = mysqli_fetch_array($user);
                if (strlen($row['image']) > 0) {
                    $image = 'image.png';
                    echo '<img height="42" width="42" src="data:image/jpeg;base64,' . base64_encode($row['image']) . '"/>';
                } else {
                    echo "<p>" . $email . "</p>";
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
    <section class="main" id="s1" style="text-align: start">
        <div id="pregunta" class="container" style="padding-left: 100px">
            <div class="row">
                <div class="col">
                    <h1 id="titulo">Titulo</h1>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p id="enunciado" class="text-left" style="max-width: 90%; word-wrap: break-word;">
                        Esto es una frase con espacios. Esperp que sea de tu agrado. 2 + 2 son cuatro, por cuatro dieciseís. Ocho y ocho dieciseís también, la pared es blanca y el suelo también.</p>
                </div>
            </div>
            <div class="row">
                <div class="col" style="margin-left: 40px">
                    <form>
                        <div class="custom-controls-stacked">
                            <label class="custom-control custom-radio ">
                                <input id="radio1" name="radio-stacked" type="radio" class="custom-control-input">
                                <span class="custom-control-indicator"></span>
                                <span id="res1" class="custom-control-description">HTML</span>
                            </label>
                            <label class="custom-control custom-radio ">
                                <input id="radio2" name="radio-stacked" type="radio" class="custom-control-input">
                                <span class="custom-control-indicator"></span>
                                <span id="res2" class="custom-control-description">PHP</span>
                            </label>
                            <label class="custom-control custom-radio">
                                <input id="radio3" name="radio-stacked" type="radio" class="custom-control-input">
                                <span class="custom-control-indicator"></span>
                                <span id="res3" class="custom-control-description">AJAX</span>
                            </label>
                            <label class="custom-control custom-radio">
                                <input id="radio4" name="radio-stacked" type="radio" class="custom-control-input">
                                <span class="custom-control-indicator"></span>
                                <span id="res4" class="custom-control-description">Ninguna</span>
                            </label>
                        </div>
                        <div style="text-align: center; margin-right: 10%">
                            <input class="btn btn-primary" type="button" value="Comprobar">
                        </div>
                    </form>
                </div>
            </div>
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
<script>
<?php
if (isset($_SESSION['partida'])){
    //var_dump($_SESSION['partida']);
    echo 'var partidaJSON =' . $_SESSION['partida'] . ';';

}
?>
    $(function () {
        $('#pregunta').hide();
        cargarPregunta(1);



    });
    function cargarPregunta(pos) {
        $('#pregunta').hide();
        $('#enunciado').html(partidaJSON['preguntasRestantes'][pos]['question']);
        $('#res1').html(partidaJSON['preguntasRestantes'][pos]['incorrect_answer_1']);
        $('#res2').html(partidaJSON['preguntasRestantes'][pos]['incorrect_answer_2']);
        $('#res3').html(partidaJSON['preguntasRestantes'][pos]['incorrect_answer_3']);
        $('#res4').html(partidaJSON['preguntasRestantes'][pos]['correct_answer']);
        $('#pregunta').show();


        //var pregunta = document.getElementById("pregunta");
       /* DivRow1 = document.createElement('div');
        DivRow1.setAttribute('class', 'row');
        DivRow2 = document.createElement('div');
        DivRow2.setAttribute('class', 'row');
        DivRow3 = document.createElement('div');
        DivRow3.setAttribute('class', 'row');

        DivCol1 = document.createElement('div');
        DivCol1.setAttribute('class', 'col');
        DivCol2 = document.createElement('div');
        DivCol2.setAttribute('class', 'col');
        DivCol3 = document.createElement('div');
        DivCol3.setAttribute('class', 'col');

        titulo = document.createElement('h1');
        tituloText = document.createTextNode('Titulo')
        titulo.appendChild(tituloText);
        DivCol1.appendChild(titulo);

        enunciado = document.createElement('p');
        enunciado.setAttribute('class', 'text-left');
        enunciado.setAttribute('style', 'max-width: 90%; word-wrap: break-word;');
        enunciadoText = document.createTextNode(partidaJSON['preguntasRestantes'][pos]['question']);
        enunciado.appendChild(enunciadoText);
        DivCol2.appendChild(enunciado);




        DivRow1.appendChild(DivCol1);
        DivRow2.appendChild(DivCol2);
        DivRow3.appendChild(DivCol3);


        pregunta.appendChild(DivRow1);
        pregunta.appendChild(DivRow2);
        pregunta.appendChild(DivRow3);*/







    }
    function borrarPregunta(pos){
        delete partidaJSON['preguntasRestantes'][pos];
    }
    function guardarPregunta(pos){
        partidaJSON['preguntasResueltas'].push(partidaJSON['preguntasRestantes'][pos]);
        borrarPregunta(pos);
    }
</script>
</body>
</html>
