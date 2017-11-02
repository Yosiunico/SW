<?php
    require_once('config.php');
    $link = mysqli_connect($servidor, $usuario, $pass, $bbdd);
    $preguntas = mysqli_query($link, "SELECT * FROM preguntas");

    echo "<table border=1> <tr> <th>MAIL</th> <th> QUESTION </th> <th> CORRECT ANSWER </th> <th> INCORRECT ANSWER 1 </th> <th> INCORRECT ANSWER 2 </th> <th> INCORRECT ANSWER 3 </th> <th> COMPLEXITY </th> <th> TOPIC </th> <th> IMAGE </th> </tr>";

    $imagen = 'imagen.png';



    while ($row = mysqli_fetch_array($preguntas)) {

        //echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['image'] ).'"/>';//codigo bueno
        echo '<tr> <td>'. $row['email'] . '</td><td>'. $row['question'] . '</td><td>'. $row['correct_answer'] . '</td><td>'. $row['incorrect_answer_1'] . '</td><td>'. $row['incorrect_answer_2'] . '</td><td>'. $row['incorrect_answer_3'] . '</td><td>'. $row['complexity'] . '</td><td>'. $row['topic'] . '</td><td>'. '<img src="data:image/jpeg;base64,'.base64_encode( $row['image'] ).'"/>' .' </td></tr>';
    }
    echo "</table>";
    $preguntas->close();
    mysqli_close($link);
 ?>
