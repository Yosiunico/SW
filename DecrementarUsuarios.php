<?php
header("Cache-Control: no-store, no-cache, must-revalidate");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
session_destroy();

$usuarios = file_get_contents('usuarios.txt');
$usuarios = $usuarios - 1;
file_put_contents('usuarios.txt', $usuarios);
?>
