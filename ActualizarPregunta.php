<?php
header("Cache-Control: no-store, no-cache, must-revalidate");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('config.php');
$link = mysqli_connect($servidor, $usuario, $pass, $bbdd);

$id = $_GET['id'];
$question = $_GET['question'];
$correct_answer = $_GET['correct_answer'];
$incorrect_answer_1 = $_GET['incorrect_answer_1'];
$incorrect_answer_2 = $_GET['incorrect_answer_2'];
$incorrect_answer_3 = $_GET['incorrect_answer_3'];
$complexity = $_GET['complexity'];
$topic = $_GET['topic'];

$sql = "update preguntas set question='$question', correct_answer='$correct_answer', incorrect_answer_1='$incorrect_answer_1', incorrect_answer_2='$incorrect_answer_2', incorrect_answer_3='$incorrect_answer_3', complexity='$complexity', topic='$topic' where ident='$id'";

if ($link->query($sql) === TRUE) {
    echo "Actualizada con éxito";
} else {
    echo "No se ha podido actualizar";
}

?>