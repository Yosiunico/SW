<?php
header("Cache-Control: no-store, no-cache, must-revalidate");

    $usuarios = file_get_contents('usuarios.txt');
    $usuarios = $usuarios - 1;
    file_put_contents('usuarios.txt', $usuarios);
?>
