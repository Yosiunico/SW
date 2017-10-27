<?php
    require_once('config.php');
    $link = mysqli_connect($servidor, $usuario, $pass, $bbdd);

    $image = addslashes(file_get_contents($_FILES['inputFile']['tmp_name']));

    $mail = $_POST['email'];
    $question = $_POST['question'];
    $correctAnswer = $_POST['correctAnswer'];
    $incorrectAnswer1 = $_POST['incorrectAnswer1'];
    $incorrectAnswer2 = $_POST['incorrectAnswer2'];
    $incorrectAnswer3 = $_POST['incorrectAnswer3'];
    $complexity = $_POST['complexity'];
    $topic = $_POST['topic'];



    $sql = "INSERT INTO preguntas(mail,question,correct_answer,incorrect_answer_1, incorrect_answer_2, incorrect_answer_3, complexity, topic,image) VALUES ('$mail','$question','$correctAnswer','$incorrectAnswer1','$incorrectAnswer2','$incorrectAnswer3','$complexity','$topic','$image')";


    if(!mysqli_query($link, $sql))
    {
        die('Error: '.mysqli_error($link));
    }
    echo "<h1>Insert correcto!</h1><br>";
    echo "<p> <a href=VerPreguntasConImagen.php> Ver Preguntas </a>";
    echo "<br>";

?>
