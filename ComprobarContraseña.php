<?php
header("Cache-Control: no-store, no-cache, must-revalidate");

$pass = $_GET['pass'];
$myfile = fopen("resources/files/toppasswords.txt", "r") or die("Unable to open file!");
$isValid = true;

while(!feof($myfile)) {
    if (strcmp($pass, str_replace(array("\r", "\n"), '', fgets($myfile))) == 0) {
        $isValid = false;
        break;
    }
}
fclose($myfile);

if ($isValid) {
    echo "SI";
} else {
    echo "NO";
}

?>