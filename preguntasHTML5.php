<?php

header("Cache-Control: no-store, no-cache, must-revalidate");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if (!isset($_SESSION['email'])) {
    echo '<script>location.replace("./layout.php");</script>';
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script></head>
<body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<div id='page-wrap'>
    <header class='main' id='h1'>
        <span class="right" ><a href="./layout.php" onclick="decrementarUsuarios()">Logout</a></span>
        <div style="float: right;">
            <?php
            $email;
            if(isset($_GET['logged_user'])){
                require_once('config.php');
                $link = mysqli_connect($servidor, $usuario, $pass, $bbdd);
                $email = $_GET['logged_user'];
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
        if (isset($_GET['logged_user'])) {
            echo "<span><a href='layout.php?logged_user=" . $_GET['logged_user'] . "'>Inicio</a></span>";
            echo "<span><a href='./preguntasHTML5.php?logged_user=" . $_GET['logged_user'] . "'>Preguntas</a></span>";
            echo "<span><a href='./GestionarPreguntas.php?logged_user=" . $_GET['logged_user'] . "'>Gestionar preguntas</a></span>";
            echo "<span><a href='./creditos.php?logged_user=" . $_GET['logged_user'] . "'>Creditos</a></span>";
            echo "<span><a href='./ClienteDeSW.php?logged_user=" . $_GET['logged_user'] . "'>Cliente consumidor del SW</a></span>";

        } else {
            echo "<span><a href='layout.php'>Inicio</a></span>";
            echo "<span><a href='./creditos.php'>Creditos</a></span>";
        }
        ?>
    </nav>
    <section class="main" id="s1" style="height: auto">
        <div align="center">
            <?php
            $email = $_GET['logged_user'];
            echo '<form id="fpreguntas" name="fpreguntas" enctype="multipart/form-data" action="InsertarPreguntaConImagen.php?logged_user=' . $email . '" method="POST">';
            ?>
                <fieldset>
                    <legend>Datos de la pregunta:</legend>
                    <table>
                        <tr>
                            <td style="width: 50%">
                                <label for="input_question">Enunciado de la pregunta:*</label>
                                <input id="input_question" name="question" type="text" title="Mínimo 10 caracteres."><br>
                                <label for="input_correct_answer">Respuesta correcta:*</label>
                                <input id="input_correct_answer" name="correctAnswer" type="text"><br>
                                <label for="input_incorrect_answer_1">Respuesta incorrecta 1:*</label>
                                <input id="input_incorrect_answer_1" name="incorrectAnswer1" type="text"><br>
                                <label for="input_incorrect_answer_2">Respuesta incorrecta 2:*</label>
                                <input id="input_incorrect_answer_2" name="incorrectAnswer2" type="text"><br>
                                <label for="input_incorrect_answer_3">Respuesta incorrecta 3:*</label>
                                <input id="input_incorrect_answer_3" name="incorrectAnswer3" type="text"><br>
                                <label for="input_conplexity">Complejidad:*</label>
                                <input id="input_conplexity" name="complexity" type="number"><br>
                                <label for="input_topic">Tema:*</label>
                                <input id="input_topic" name="topic" type="text"><br>
                                <label for="input_file">Image:</label>
                                <input type="file" id="input_file" name="inputFile"/><br>
                                <button type="submit">Enviar solicitud</button>
                            </td>
                            <td align="center">
                                <img id="img_question" src="resources/empty_image.png" alt="Imagen " style="background-color: white; border: solid 2px white; width: 128px">
                            </td>
                        </tr>
                    </table>
                </fieldset>
            </form>
        </div>
    </section>
    <footer class='main' id='f1'>
        <p><a href="http://es.wikipedia.org/wiki/Quiz" target="_blank">Que es un Quiz?</a></p>
        <a href='https://github.com'>Link GITHUB</a>
    </footer>
</div>
<script>
    function handleFileSelect(event) {
        // Get the file selected by the user
        var file = event.target.files[0];
        console.log(file);

        // Check if the file is an image
        if (!file.type.match('image.*')) {
            // Clear selected file path and image
            $(event.target).val("");
            $("#img_question").attr("src", "resources/empty_image.png");
            return;
        }

        // User FileReader for reading the file
        var fileReader = new FileReader();

        // Select FileReaders behaviour when the file is readed
        fileReader.onload = function (event) {
            $("#img_question").attr("src", event.target.result);
        }

        // Read file for getting its URL
        fileReader.readAsDataURL(file);
    }

    $("#input_file").on("change", handleFileSelect);

    function decrementarUsuarios() {
        $.ajax("DecrementarUsuarios.php");
    }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
</body>
</html>
