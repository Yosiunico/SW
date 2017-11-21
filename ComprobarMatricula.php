<?php
header("Cache-Control: no-store, no-cache, must-revalidate");
//ini_set('display_errors', 1);
//error_reporting(E_ALL);

//incluimos la clase nusoap.php
require_once('lib/nusoap.php');
require_once('lib/class.wsdlcache.php');

//creamos el objeto de tipo soapclient.
//http://www.mydomain.com/server.php se refiere a la url
//donde se encuentra el servicio SOAP que vamos a utilizar.
$soapclient = new nusoap_client( 'http://ehusw.es/jav/ServiciosWeb/comprobarmatricula.php?wsdl',true);

$result = $soapclient->call('comprobar', array('x'=>$_GET['email']));

print_r($result);
//echo 'La respuesta es...    ' . $result['z'];
?>