<?php
header("Cache-Control: no-store, no-cache, must-revalidate");
//ini_set('display_errors', 1);
//error_reporting(E_ALL);

//incluimos la clase nusoap.php
require_once('lib/nusoap.php');
require_once('lib/class.wsdlcache.php');

$ip = $_SERVER['REMOTE_ADDR'];

//$ip = '74.125.91.106';

//creamos el objeto de tipo soapclient.
//http://www.mydomain.com/server.php se refiere a la url
//donde se encuentra el servicio SOAP que vamos a utilizar.
$soapclient = new nusoap_client( 'http://www.webservicex.net/geoipservice.asmx?WSDL',true);

$result = $soapclient->call('GetGeoIP', array('IPAddress'=>$ip));

//echo $result['GetGeoIPResult']['CountryName'];

echo "*" . $_SERVER['REMOTE_ADDR'] . "*";

?>