<?php
    $usuarios = file_get_contents('usuarios.txt');
    $usuarios = $usuarios - 1;
    file_put_contents('usuarios.txt', $usuarios);
?>
