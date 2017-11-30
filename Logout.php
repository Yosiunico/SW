<?php
header("Cache-Control: no-store, no-cache, must-revalidate");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
session_destroy();

echo '
    <html lang="en">
    <head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Document</title>
    </head>
    <body>
    
      <script>location.replace("./layout.php);</script>
    </body>
    </html>
    
    

';

?>