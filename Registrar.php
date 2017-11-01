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
</head>
<body>
<?php
if (isset($_POST['email'])) {
    function alert($msj){
        echo "<script type='text/javascript'>alert('$msj'); </script>";
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

    $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));

    alert("Inserting...");

    $sql = "INSERT INTO usuarios(email,name_lastnames,nick,password, image) VALUES ('$email','$name_lastnames','$nick','$password','$image')";

    if(!mysqli_query($link, $sql))
    {
        alert( "Error de inserción");
        die('Error: '.mysqli_error($link));
    }else{
        header('Location: ./layout.php');
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
                        <input id="input_email" name="email" title="Ej: crivas004@ikasle.ehu.es" type="text" pattern="^[a-zA-Z]{3,}[0-9]{3}@ikasle.ehu.eu?s$" required><br>
                        <label for="input_name_lastnames">Nombre y apellidos:*</label>
                        <input id="input_name_lastnames" name="name_lastnames" type="text" pattern="[A-Za-z\s]{2,}" title="Ej: Joseba Merino Pina" required><br>
                        <label for="input_nick">Nick:*</label>
                        <input id="input_nick" name="nick" type="text" pattern=".+" required><br>
                        <label for="input_password">Contraseña:*</label>
                        <input id="input_password" name="password" type="password" pattern=".{6,}" required><br>
                        <label for="input_repeat_password">Repite la contraseña:*</label>
                        <input id="input_repeat_password" name="repeat_password" type="password" pattern=".{6,}" required ><br>
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
</body>
</html>
<?php


?>