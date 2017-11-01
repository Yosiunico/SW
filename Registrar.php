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

}
?>
<div id='page-wrap'>
    <header class='main' id='h1'>
        <span class="right"><a href="login">Login</a></span>
        <span class="right" style="display:none;"><a href="/logout">Logout</a></span>
        <h2>Quiz: el juego de las preguntas</h2>
    </header>
    <nav class='main' id='n1' role='navigation'><span><a href='./layout.html'>Inicio</a></span>
        <span><a href='./preguntasHTML5.html'>Preguntas</a></span>
        <span><a href='./creditos.html'>Creditos</a></span>
    </nav>
    <section class="main" id="s1">
        <div align="left">
            <!-- Mostrar formulario para registrarse -->
            <fieldset>

                <legend align="center">Registro</legend>
                <form action="./Registrar.php" method="post">
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