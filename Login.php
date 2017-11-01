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
        echo "<script display='none' type='text/javascript'>alert('$msj'); </script>";
    }
    require_once ('config.php');
    $link = mysqli_connect($servidor, $usuario, $pass, $bbdd);

    $email = $_POST['email'];
    $password = $_POST['password'];

    $usuarios = mysqli_query($link, "select * from usuarios where email='$email' and password='$password'");
    $cont = mysqli_num_rows($usuarios);

    mysqli_close($link);

    if ($cont == 1) {
        header("Location: ./layout.php?logged_user=" . $email);
    } else {
        alert("Error de identificatión");
    }


}
?>
<div id='page-wrap'>
    <header class='main' id='h1'>
        <span class="right"><a href="./Registrar.php">Registrarse</a></span>
        <span class="right" style="display:none;"><a href="/logout">Logout</a></span>
        <h2>Quiz: el juego de las preguntas</h2>
    </header>
    <nav class='main' id='n1' role='navigation'><span><a href='layout.php'>Inicio</a></span>
        <span><a href='creditos.php'>Creditos</a></span>
    </nav>
    <section class="main" id="s1">
        <div align="left">
            <!-- Mostrar formulario para registrarse -->
            <fieldset>

                <legend align="center">Login</legend>
                <form action="./Login.php" method="post">
                    <div style="padding: 20px">
                        <label for="input_email">Email:*</label>
                        <input id="input_email" name="email" title="Ej: crivas004@ikasle.ehu.es" type="text" pattern="^[a-zA-Z]{3,}[0-9]{3}@ikasle.ehu.eu?s$" required><br>
                        <label for="input_password">Contraseña:*</label>
                        <input id="input_password" name="password" type="password" pattern=".{6,}" required><br>

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