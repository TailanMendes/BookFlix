<?php
$server->register('cadUser',
		array('user'=>'tns:UserArray'),
		array('return'=>'tns:UserArray'),
		'urn:server.cadUser',
		'urn:server.cadUser#cadUser',
		'rpc',
		'encode',
		'return string informando se o usuário foi cadastrado'
);

//$param = array();




$server->register('cadAutor',
		array('autor'=>'tns:Autor'),
		array('return'=>'xsd:string'),
		'urn:server.cadAutor',
		'urn:server.cadAutor#cadAutor',
		'rpc',
		'encode',
		'return string informando se o autor foi cadastrado'
);


$server->register('cadGenero',
		array('genero'=>'tns:Genero'),
		array('return'=>'xsd:string'),
		'urn:server.cadGenero',
		'urn:server.cadGenero#cadGenero',
		'rpc',
		'encode',
		'return string informando se o genero foi cadastrado'
);


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