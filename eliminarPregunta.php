<?php
    header("Cache-Control: no-store, no-cache, must-revalidate");

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require_once ('config.php');


    $id = $_GET['id'];

    $link = mysqli_connect($servidor, $usuario, $pass, $bbdd);

    mysqli_query($link, "delete from preguntas where ident='$id'");

    $conn->close();

?>