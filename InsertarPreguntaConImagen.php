<?php
    require_once('config.php');
    $link = mysqli_connect($servidor, $usuario, $pass, $bbdd);



    $email = $_GET['logged_user'];
    $question = $_POST['question'];
    $correctAnswer = $_POST['correctAnswer'];
    $incorrectAnswer1 = $_POST['incorrectAnswer1'];
    $incorrectAnswer2 = $_POST['incorrectAnswer2'];
    $incorrectAnswer3 = $_POST['incorrectAnswer3'];
    $complexity = $_POST['complexity'];
    $topic = $_POST['topic'];
    $isCorrect = verify($email, $question, $correctAnswer, $incorrectAnswer1, $incorrectAnswer2, $incorrectAnswer3, $complexity, $topic);


    if($isCorrect){
        $image = addslashes(file_get_contents($_FILES['inputFile']['tmp_name']));
        $sql = "INSERT INTO preguntas(email,question,correct_answer,incorrect_answer_1, incorrect_answer_2, incorrect_answer_3, complexity, topic,image) VALUES ('$email','$question','$correctAnswer','$incorrectAnswer1','$incorrectAnswer2','$incorrectAnswer3','$complexity','$topic','$image')";


        if(!mysqli_query($link, $sql))
        {
            die('Error: '.mysqli_error($link));
        }
        echo "<h1>Insert correcto!</h1><br>";
        echo "<p> <a href=VerPreguntasConImagen.php> Ver Preguntas </a>";
        echo "<br>";
    }else {
        echo "<h1> Insert incorrecto</h1>";
    }

    function verify($mail, $question, $correctAnswer, $incorrectAnswer1, $incorrectAnswer2, $incorrectAnswer3, $complexity, $topic) {
        $isCorrect = true;
        if(preg_match("/^[a-zA-Z]{3,}[0-9]{3}@ikasle.ehu.eu?s$/",$mail) == 0){
            $isCorrect = false;
        }
        $opciones = array(
            'options' => array(
                'min_range' => 0,
                'max_range' => 5
            )
        );
        if( filter_var($complexity, FILTER_VALIDATE_INT, $opciones ) == false){
            $isCorrect = false;
        }
        if(preg_match("/^.{10,}$/",$question) == 0){
            $isCorrect = false;
        }
        if(strlen($correctAnswer) == 0 || strlen($incorrectAnswer1) == 0 || strlen($incorrectAnswer2) == 0 || strlen($incorrectAnswer3) || strlen($topic) == 0){
            $isCorrect = false;
        }
        return $isCorrect;
    }

?>
