<?php
header("Cache-Control: no-store, no-cache, must-revalidate");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once ('config.php');

$id = $_GET['id'];

$link = mysqli_connect($servidor, $usuario, $pass, $bbdd);

$preguntas = mysqli_query($link, "select * from preguntas where ident='$id'");
$cont = mysqli_num_rows($preguntas);

if ($cont == 1) {
    $pregunta = mysqli_fetch_array($preguntas);
    $email = $pregunta['email'];
    $question = $pregunta['question'];
    $correct_answer = $pregunta['correct_answer'];
    $incorrect_answer_1 = $pregunta['incorrect_answer_1'];
    $incorrect_answer_2 = $pregunta['incorrect_answer_2'];
    $incorrect_answer_3 = $pregunta['incorrect_answer_3'];
    $complexity = $pregunta['complexity'];
    $topic = $pregunta['topic'];

    echo "
    <div style='max-width: 360px; margin: 0 auto; text-align: left'>
        Enunciado:<input id='question' value='$question'/><br>
        Respuesta correcta:<input id='correct_answer' value='$correct_answer'/><br>
        Respuesta incorrecta 1:<input id='incorrect_answer_1' value='$incorrect_answer_1'/><br>
        Respuesta incorrecta 2:<input id='incorrect_answer_2' value='$incorrect_answer_2'/><br>
        Respuesta incorrecta 3:<input id='incorrect_answer_3' value='$incorrect_answer_3'/><br>
        Complejidad:<input id='complexity' value='$complexity' type='number'/><br>
        Tema:<input id='topic' value='$topic'/><br>
    
    </div>
    ";
} else {
    $show_error = True;
}

?>