<?
include("WSDLGenerator.php");

$soapserver = new SoapServer("urn:test");
$soapserver->addfunction("hello");
$wsdl = new WSDLGenerator("wsdl.php", $soapserver);
$soapserver->handle();

?>