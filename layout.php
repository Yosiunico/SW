<php header("Cache-Control: no-store, no-cache, must-revalidate"); ?>

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<div id='page-wrap'>
	<header class='main' id='h1'>
        <?php
        if (isset($_GET['logged_user'])) {
            echo '<span class="right"><a href="./layout.php" onclick="decrementarUsuarios()">Logout</a></span>';
        } else {
            echo '<span class="right"><a href="./Registrar.php">Registrarse</a></span>';
            echo '<span> </span>';
            echo '<span class="right"><a href="./Login.php">Login</a></span>';
        }
        ?>
        <div align="right">
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
            } else {
                echo "<span><a href='layout.php'>Inicio</a></span>";
                echo "<span><a href='./creditos.php'>Creditos</a></span>";
            }
        ?>
	</nav>
	<section class="main" id="s1">
		<div>
			<!-- Mostrar vacío -->
		</div>
	</section>
	<footer class='main' id='f1'>
		<p><a href="http://es.wikipedia.org/wiki/Quiz" target="_blank">Que es un Quiz?</a></p>
		<a href='https://github.com'>Link GITHUB</a>
	</footer>
</div>
<script>
    function decrementarUsuarios() {
        $.ajax("DecrementarUsuarios.php");
    }
</script>
</body>
</html>
