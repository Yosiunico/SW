<?php
$xml = simplexml_load_file('preguntas.xml');

echo "<table border='1'><tr><th>ENUNCIADO</th><th>RESPUESTA CORRECTA</th><th>RESPUESTAS INCORRECTAS</th></tr>";

foreach ($xml->children() as $assessmentItem) {
    echo "<tr>";
    foreach ($assessmentItem->children() as $group) {
        if ($group->getName() == 'itemBody') {
            echo "<td>$group->p</td>";
        }

        if ($group->getName() == 'correctResponse') {
            echo "<td>$group->value</td>";
        }

        if ($group->getName() == 'incorrectResponses') {
            echo "<td><ol>";
            foreach ($group->children() as $value) {
                echo "<li>$value</li>";
            }
            echo "</ol></td>";
        }
    }
    echo "</tr>";
}
echo "</table>";
?>