<?php


/**
 * Arquivo utilizado para registrar as funções declaradas no arquivo function.php
 * 
 **/


/**
 * Registrando as funções referentes ao manter do User
 * 
 **/
$server->register('insertUser',
		array('user'=>'tns:User'),
		array('return'=>'xsd:string'),
		'urn:server.cadUser',
		'urn:server.cadUser#cadUser',
		'rpc',
		'encode',
		'return string informando se o usuário foi cadastrado'
);

$server->register('gettUser',
		array('limite'=>'xsd:string'),
		array('return'=>'xsd:UserArray'),
		'urn:server.cadUser',
		'urn:server.cadUser#cadUser',
		'rpc',
		'encode',
		'return string informando se o usuário foi cadastrado'
);

//$param = array();


/**
 * Registrando as funções referentes ao manter do User
 *
 **/
$server->register('insertAutor',
		array('autor'=>'tns:Autor'),
		array('return'=>'xsd:string'),
		'urn:server.cadAutor',
		'urn:server.cadAutor#cadAutor',
		'rpc',
		'encode',
		'return string informando se o autor foi cadastrado'
);


/**
 * Registrando as funções referentes ao manter do User
 *
 **/

$server->register('cadGenero',
		array('genero'=>'tns:Genero'),
		array('return'=>'xsd:string'),
		'urn:server.cadGenero',
		'urn:server.cadGenero#cadGenero',
		'rpc',
		'encode',
		'return string informando se o genero foi cadastrado'
);


/**
 * Registrando as funções referentes ao manter do User
 *
 **/

$server->register('cadBook',
		array('user'=>'tns:Book'),
		array('return'=>'xsd:string'),
		'urn:server.cadBook',
		'urn:server.cadBook#cadBook',
		'rpc',
		'encode',
		'return string informando se o livro foi cadastrado'
);
?>