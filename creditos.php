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
</head>
<body>
<div id='page-wrap'>
	<header class='main' id='h1'>
		<span class="right"><a href="./Registrar.php">Registrarse</a></span>
		<span class="right"><a href="./Login.php">Login</a></span>
		<span class="right" style="display:none;"><a href="/logout">Logout</a></span>
		<h2>Quiz: el juego de las preguntas</h2>
	</header>
	<nav class='main' id='n1' role='navigation'><span><a href='layout.php'>Inicio</a></span>
        <?php
        if (isset($_POST['logged_user'])) {
            echo "<span><a href='./preguntasHTML5.html'>Preguntas</a></span>";
        }
        ?>
			<span><a href='creditos.php'>Creditos</a></span>
	</nav>
	<section class="main" id="s1">
		<div>
			<p>Nombres: Cristian Rivas y Joseba Merino</p>
			<p>Especialidad: Ingeniería del Software</p>
			<img src="./resources/foto_personal.jpg" alt="Foto personal" width="128">
			<br />
			<a href="layout.php">Volver a la página principal</a>
		</div>
	</section>
	<footer class='main' id='f1'>
		<p><a href="http://es.wikipedia.org/wiki/Quiz" target="_blank">Que es un Quiz?</a></p>
		<a href='https://github.com'>Link GITHUB</a>
	</footer>
</div>
</body>
</html>
