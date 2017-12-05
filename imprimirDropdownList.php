<?php
echo '<select onchange="updateSelect()" id="select_pregunta" class="custom-select">
                <option selected>Selecciona una pregunta</option>';


require_once('config.php');
$link = mysqli_connect($servidor, $usuario, $pass, $bbdd);
$preguntas = mysqli_query($link, "SELECT * FROM preguntas");

while ($row = mysqli_fetch_array($preguntas)) {
    echo '<option value="' . $row['ident'] . '">' . $row['question'] . '</option>';
}

$preguntas->close();
mysqli_close($link);
echo '</select >';