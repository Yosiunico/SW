<php header("Cache-Control: no-store, no-cache, must-revalidate"); ?>

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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
</head>
<body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<div id='page-wrap'>
    <header class='main' id='h1'>
        <span class="right"><a href="./layout.php" onclick="decrementarUsuarios()">Logout</a></span>
        <div style="float: right;">
            <?php
            $email;
            if (isset($_GET['logged_user'])) {
                require_once('config.php');
                $link = mysqli_connect($servidor, $usuario, $pass, $bbdd);
                $email = $_GET['logged_user'];
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
            <h3>Número de usuarios editando preguntas</h3>
            <div style="border: 1px solid black" id="numero_de_usuarios">6</div>
            <br>

            <h3>TOTAL PREGUNTAS / TUYAS</h3>
            <div style="border:  1px solid black" id="total_preguntas_tuyas">8/3</div>
            <br>

            <button id="button_send" onclick="enviarLaSolicitud()">Enviar solicitud</button>
            <button id="button_view" onclick="mostrarTablaDePreguntas()">Ver preguntas</button>
            <form>
                <fieldset>
                    <legend>Datos de la pregunta:</legend>
                    <table>
                        <tr>
                            <td style="width: 50%">
                                <br/>
                                <label for="input_question">Enunciado de la pregunta:*</label>
                                <input id="input_question" name="question" type="text"
                                       title="Mínimo 10 caracteres."><br>
                                <label for="input_correct_answer">Respuesta correcta:*</label>
                                <input id="input_correct_answer" name="correctAnswer" type="text"><br>
                                <label for="input_incorrect_answer_1">Respuesta incorrecta 1:*</label>
                                <input id="input_incorrect_answer_1" name="incorrectAnswer1" type="text"><br>
                                <label for="input_incorrect_answer_2">Respuesta incorrecta 2:*</label>
                                <input id="input_incorrect_answer_2" name="incorrectAnswer2" type="text"><br>
                                <label for="input_incorrect_answer_3">Respuesta incorrecta 3:*</label>
                                <input id="input_incorrect_answer_3" name="incorrectAnswer3" type="text"><br>
                                <label for="input_complexity">Complejidad:*</label>
                                <input id="input_complexity" name="complexity" type="number"><br>
                                <label for="input_topic">Tema:*</label>
                                <input id="input_topic" name="topic" type="text"><br>
                                <label for="input_file">Image:</label>
                                <input type="file" id="input_file" name="inputFile"/><br>

                            </td>
                            <td align="center">
                                <img id="img_question" src="resources/empty_image.png" alt="Imagen "
                                     style="background-color: white; border: solid 2px white; width: 128px">
                            </td>
                        </tr>
                    </table>
                </fieldset>
            </form>

            <div id="tabla_de_preguntas">

            </div>

            <div id="mensajes">

            </div>
        </div>
    </section>
    <footer class='main' id='f1'>
        <p><a href="http://es.wikipedia.org/wiki/Quiz" target="_blank">Que es un Quiz?</a></p>
        <a href='https://github.com'>Link GITHUB</a>
    </footer>
</div>
<script>
    $(function () {
        setInterval(actualizarNumeroDeUsuarios, 3000);
        setInterval(actualizarNumeroDePreguntas, 3000);

        $("#input_file").on("change", handleFileSelect);
    });

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

    function mostrarTablaDePreguntas() {
        console.log("llega");
        document.getElementById("mensajes").style.display = "none";
        document.getElementById("tabla_de_preguntas").style.display = "block";

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("tabla_de_preguntas").innerHTML = this.responseText;
            }
        }
        xhttp.open("GET", "VerPreguntasAJAX.php", true);
        xhttp.send();
    }

    function enviarLaSolicitud() {
        question = document.getElementById("input_question");
        correctAnswer = document.getElementById("input_correct_answer");
        incorrectAnswer1 = document.getElementById("input_incorrect_answer_1");
        incorrectAnswer2 = document.getElementById("input_incorrect_answer_2");
        incorrectAnswer3 = document.getElementById("input_incorrect_answer_3");
        complexity = document.getElementById("input_complexity");
        topic = document.getElementById("input_topic");

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            document.getElementById("mensajes").style.display = "block";
            document.getElementById("tabla_de_preguntas").style.display = "none";

            document.getElementById("mensajes").innerHTML = "<h3>Enviando pregunta...</h3>";

            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("mensajes").innerHTML = this.responseText;
            }
        }
        <?php echo 'xhttp.open("POST", "InsertarPreguntaAJAX.php?logged_user=' . $_GET["logged_user"] . '");' ?>
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("question=" + question.value + "&correctAnswer=" + correctAnswer.value + "&incorrectAnswer1=" + incorrectAnswer1.value + "&incorrectAnswer2=" + incorrectAnswer2.value + "&incorrectAnswer3=" + incorrectAnswer3.value + "&topic=" + topic.value + "&complexity=" + complexity.value);
    }

    function actualizarNumeroDeUsuarios() {
       // $.ajax('LeerUsuarios.php', function (text) {
          //  $("#numero_de_usuarios").html(text);
           // });
        //$("#numero_de_usuarios").html(response);
        $.ajax({url: "LeerUsuarios.php", cache: false, success: function(result){
            $("#numero_de_usuarios").html(result);
        }});
    }

    function actualizarNumeroDePreguntas() {
        numeroDePreguntas = 0;
        numeroDePreguntasDelUsuario = 0;

        $.get({
            url: 'preguntas.xml',
            cache: false
        }, function (xml) {
            var $xml = $(xml);
            var $items = $xml.find("assessmentItem");
            $.each($items, function () {
                console.log("numeroDePreguntas esta ha: " + numeroDePreguntas);
                numeroDePreguntas++;
                <?php echo "if ($(this).attr('author') === '" . $_GET["logged_user"] . "') { numeroDePreguntasDelUsuario++; }" ?>
            });

            console.log("numeroDePreguntas: " + numeroDePreguntas + "; numeroDePreguntasDelUsuario: " + numeroDePreguntasDelUsuario);
            $("#total_preguntas_tuyas").html(numeroDePreguntas + "/" + numeroDePreguntasDelUsuario);
        });
    };

    function decrementarUsuarios() {
        $.ajax("DecrementarUsuarios.php");
    }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
</body>
</html>
