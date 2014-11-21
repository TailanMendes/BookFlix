<?php

require_once("/static/lib/lib/nusoap.php");
 
$namespace ='http://localhost/BookFlix/WebServicePHP/WebService.php';
$server = new nusoap_server;
$server->configureWSDL("WEBSERVICE_BOOKFLIX");
$server->wsdl->schemaTargetNamespace=$namespace;

//require_once ('conexaoBD.php');
require_once ('dataDefinition.php');
require_once ('register.php');
require_once ('function.php');



$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
//$HTTP_RAW_POST_DATA: '';

$server->service($HTTP_RAW_POST_DATA);


exit();
?>