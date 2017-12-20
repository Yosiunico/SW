<?php
header("Cache-Control: no-store, no-cache, must-revalidate");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
$partida = $_SESSION['partida'];
if($partida['modo'] === 'aleatorio'){
    require_once('config.php');
    $link = mysqli_connect($servidor, $usuario, $pass, $bbdd);
    $preguntas = mysqli_query($link, "SELECT * FROM preguntas");
    $dataJSON = array();
    while($row = mysqli_fetch_array($preguntas)) {
        $dataJSON[] = (object)array(
            'ident' => $row['ident'],
            'question' => $row['question'],
            'correct_answer' =>$row['correct_answer'],
            'incorrect_answer_1' => $row['incorrect_answer_1'],
            'incorrect_answer_2' => $row['incorrect_answer_2'],
            'incorrect_answer_3' => $row['incorrect_answer_3'],
            'topic' => $row['topic'],
            'image' => $row['image']
        );
    }
    $partida = array(
        'modo' => $partida['modo'],
        'tema' => $partida['tema'],
        'puntuacion' => 0,
        'preguntasRestantes' => $dataJSON,
        'preguntasResueltas' => array()
    );


    $preguntasJSON = json_encode($partida);
    $_SESSION['partida']= $preguntasJSON;
    echo '<script>window.open("./PreguntasAleatorias.php", "_self");</script>';


}