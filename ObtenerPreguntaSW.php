<?php
//incluimos la clase nusoap.php
require_once('lib/nusoap.php');
require_once('lib/class.wsdlcache.php');
//creamos el objeto de tipo soap_server
$ns="http://localhost/nusoap-0.9.5/samples";
$server = new soap_server;
$server->configureWSDL('ObtenerPregunta',$ns);
$server->wsdl->schemaTargetNamespace=$ns;
//añadimos el tipo complejo.
$server->wsdl->addComplexType(
    'Pregunta',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'enunciado' => array('name' => 'enunciado', 'type' => 'xsd:string'),
        'respuestaCorrecta' => array('name' => 'respuestaCorrecta', 'type' => 'xsd:string'),
        'complejidad' => array('name' => 'complejidad', 'type' => 'xsd:int')
    )
);


//registramos la función que vamos a implementar
$server->register('ObtenerPregunta',
    array('idPregunta' => 'xsd:int'),
    array('Pregunta'=>'tns:Pregunta'),
    $ns);
//implementamos la función
function ObtenerPregunta ($idPregunta){
    require_once('config.php');
    $link = mysqli_connect($servidor, $usuario, $pass, $bbdd);
    $preguntas = mysqli_query($link, "SELECT * FROM preguntas WHERE ident = $idPregunta");
    if(mysqli_num_rows($preguntas) == 1){
        $row = mysqli_fetch_array($preguntas);
        $resp = array('enunciado'=> $row['question'],'respuestaCorrecta'=> $row['correct_answer'], 'complejidad'=> $row['complexity']);
    }else{
        $resp = array('enunciado'=> '','respuestaCorrecta'=>'', 'complejidad'=> 0);
    }
    $preguntas->close();
    mysqli_close($link);
    return $resp;
}
//llamamos al método service de la clase nusoap
if ( !isset( $HTTP_RAW_POST_DATA ) ) $HTTP_RAW_POST_DATA =file_get_contents( 'php://input' );
$server->service($HTTP_RAW_POST_DATA);
?>