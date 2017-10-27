<?php
    require_once('config.php');
    $link = mysqli_connect($servidor, $usuario, $pass, $bbdd);


    $image = addslashes(file_get_contents($_FILES['inputFile']['tmp_name']));

    $sql = "INSERT INTO preguntas(mail,question,correct_answer,incorrect_answer_1, incorrect_answer_2, incorrect_answer_3, complexity, topic,image) VALUES ('$_POST[email]','$_POST[question]','$_POST[correctAnswer]','$_POST[incorrectAnswer1]','$_POST[incorrectAnswer2]','$_POST[incorrectAnswer3]','$_POST[complexity]','$_POST[topic]','$image')";


    if(!mysqli_query($link, $sql))
    {
        die('Error: '.mysqli_error($link));
    }
    echo "<h1>Insert correcto!</h1><br>";
    echo "<p> <a href=VerPreguntasConImagen.php> Ver Preguntas </a>";
    echo "<br>";

?>
