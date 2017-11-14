<?php
    header("Cache-Control: no-store, no-cache, must-revalidate");
    $usuarios = file_get_contents('usuarios.txt');
    echo $usuarios;
?>