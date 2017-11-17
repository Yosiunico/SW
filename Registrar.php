<php header("Cache-Control: no-store, no-cache, must-revalidate"); ?>

<html>
<head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
    <title>Registrarse</title>
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
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
</head>
<body>
<?php

if (isset($_POST['email'])) {
    function alert($msj){
        echo "<script type='text/javascript'>alert('$msj'); </script>";
    }

    function verify($email,$name_lastnames,$nick,$password, $repeat_password) {
        $isCorrect = true;
        if(preg_match("/^[a-zA-Z]{3,}[0-9]{3}@ikasle.ehu.eu?s$/",$email) == 0){
            alert( "Error en el email");
            return false;
        }

        if(preg_match("/^[a-zA-Z]{1,}\s[a-zA-Z]{1,}.*$/",$name_lastnames) == 0){
            alert("Error en el nombre y apellidos");
            return false;
        }
        if(preg_match("/^[a-zA-Z0-9]{1,}$/", $nick)== 0){
            alert("Error en el nick");
            return false;
        }
        if(preg_match("/^.{6,}$/", $password) == 0){
            alert("Contraseña demasiado corta");
            return false;
        }
        if($password != $repeat_password){
            alert("Las contraseñas no coinciden");
            return false;
        }

        return $isCorrect;
    }

    require_once ('config.php');
    $link = mysqli_connect($servidor, $usuario, $pass, $bbdd);
    if (!$link)
    {
        echo "Fallo al conectar a MySQL: " . $link->connect_error;
    }

    $email = $_POST['email'];
    $name_lastnames = $_POST['name_lastnames'];
    $nick = $_POST['nick'];
    $password = $_POST['password'];
    $repeat_password = $_POST['repeat_password'];
    if(verify($email, $name_lastnames, $nick, $password, $repeat_password)){
        if($_FILES['image']['size'] > 0) {
            $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
            $sql = "INSERT INTO usuarios(email,name_lastnames,nick,password, image) VALUES ('$email','$name_lastnames','$nick','$password','$image')";

        }else{
            $sql = "INSERT INTO usuarios(email,name_lastnames,nick,password) VALUES ('$email','$name_lastnames','$nick','$password')";

        }


        if(!mysqli_query($link, $sql))
        {
            alert( "Error de inserción");
            die('Error: '.mysqli_error($link));
        }else{
            //header('Location: ./layout.php');
            echo '<script> location.replace("./layout.php"); </script>';
        }
    }


}
?>
<div id='page-wrap'>
    <header class='main' id='h1'>
        <span class="right"><a href="./Login.php">Login</a></span>
        <span class="right" style="display:none;"><a href="/logout">Logout</a></span>
        <h2>Quiz: el juego de las preguntas</h2>
    </header>
    <nav class='main' id='n1' role='navigation'>
        <?php
        if (isset($_GET['logged_user'])) {
            echo "<span><a href='layout.php?logged_user=" . $_GET['logged_user'] . "'>Inicio</a></span>";
            echo "<span><a href='./preguntasHTML5.php?logged_user=" . $_GET['logged_user'] . "'>Preguntas</a></span>";
            echo "<span><a href='./creditos.php?logged_user=" . $_GET['logged_user'] . "'>Creditos</a></span>";
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

                <legend align="center">Registro</legend>
                <form action="./Registrar.php" enctype="multipart/form-data" method="POST">
                    <div style="padding: 20px">
                        <label for="input_email">Email:*</label>
                        <input id="input_email" name="email" title="Ej: crivas004@ikasle.ehu.es" type="text" required><br>
                        <label for="input_name_lastnames">Nombre y apellidos:*</label>
                        <input id="input_name_lastnames" name="name_lastnames" type="text"  title="Ej: Joseba Merino" required><br>
                        <label for="input_nick">Nick:*</label>
                        <input id="input_nick" name="nick" type="text" required><br>
                        <label for="input_password">Contraseña:*</label>
                        <input id="input_password" name="password" type="password" required><br>
                        <label for="input_repeat_password">Repite la contraseña:*</label>
                        <input id="input_repeat_password" name="repeat_password" type="password"  required ><br>
                        <label for="input_image">Elegir foto de perfil:</label>
                        <input id="input_image" name="image" type="file"><br>

                        <input type="submit" value="Enviar">
                    </div>
                </form>
            </fieldset>


        </div>
    </section>
    <footer class='main' id='f1'>
        <p><a href="http://es.wikipedia.org/wiki/Quiz" target="_blank">Que es un Quiz?</a></p>
        <a href='https://github.com'>Link GITHUB</a>
    </footer>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
</body>
</html>