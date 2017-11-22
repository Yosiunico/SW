<?php
header("Cache-Control: no-store, no-cache, must-revalidate");
//ini_set('display_errors', 1);
//error_reporting(E_ALL);

//incluimos la clase nusoap.php
require_once('lib/nusoap.php');
require_once('lib/class.wsdlcache.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$ip = '74.125.91.106';

//FALTA QUE PHP DETECTE LA IP DEL CLIENTE

//creamos el objeto de tipo soapclient.
//http://www.mydomain.com/server.php se refiere a la url
//donde se encuentra el servicio SOAP que vamos a utilizar.
$soapclient = new nusoap_client( 'http://www.webservicex.net/geoipservice.asmx?WSDL',true);

$result = $soapclient->call('GetGeoIP', array('IPAddress'=>$ip));

echo $result['GetGeoIPResult']['CountryName'];

?>