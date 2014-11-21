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
		'urn:server.insertUser',
		'urn:server.insertUser#insertUser',
		'rpc',
		'encode',
		'return string informando se o usuário foi cadastrado'
);

$server->register('getUser',
		array('search'=>'tns:Search'),
		array('return'=>'tns:UserArray'),
		'urn:server.getUser',
		'urn:server.getUser#getUser',
		'rpc',
		'encode',
		'return UserArray contendo um ou mais usuários'
);

$server->register('alterUser',
		array('user'=>'tns:User'),
		array('return'=>'xsd:string'),
		'urn:server.alterUser',
		'urn:server.alterUser#alterUser',
		'rpc',
		'encode',
		'return string informando se o usuário foi alterado'
);
$server->register('deleteUser',
		array('user'=>'tns:User'),
		array('return'=>'xsd:string'),
		'urn:server.deleteUser',
		'urn:server.deleteUser#xdeleteUser',
		'rpc',
		'encode',
		'return string informando se o usuário foi deletado'
);

//$param = array();


/**
 * Registrando as funções referentes ao manter do Autor
 *
 **/
$server->register('insertAutor',
		array('autor'=>'tns:Autor'),
		array('return'=>'xsd:string'),
		'urn:server.insertAutor',
		'urn:server.insertAutor#insertAutor',
		'rpc',
		'encode',
		'return String informando se o Autor foi cadastrado'
);

$server->register('getAutor',
		array('search'=>'tns:Search'),
		array('return'=>'tns:AutorArray'),
		'urn:server.getAutor',
		'urn:server.getAutor#getAutor',
		'rpc',
		'encode',
		'return AutorArray contendo um ou mais Autor'
);

$server->register('alterAutor',
		array('autor'=>'tns:Autor'),
		array('return'=>'xsd:string'),
		'urn:server.alterAutor',
		'urn:server.alterAutor#alterAutor',
		'rpc',
		'encode',
		'return string informando se o Autor foi alterado'
);
$server->register('deleteAutor',
		array('autor'=>'tns:Autor'),
		array('return'=>'xsd:string'),
		'urn:server.deleteAutor',
		'urn:server.deleteAutor#xdeleteAutor',
		'rpc',
		'encode',
		'return string informando se o Autor foi deletado'
);


/**
 * Registrando as funções referentes ao manter do Genero
 *
 **/

$server->register('insertGenero',
		array('genero'=>'tns:Genero'),
		array('return'=>'xsd:string'),
		'urn:server.insertGenero',
		'urn:server.insertGenero#insertGenero',
		'rpc',
		'encode',
		'return string informando se o Genero foi cadastrado'
);

$server->register('getGenero',
		array('search'=>'tns:Search'),
		array('return'=>'tns:GeneroArray'),
		'urn:server.getGenero',
		'urn:server.getGenero#getGenero',
		'rpc',
		'encode',
		'return GeneroArray contendo um ou mais Genero'
);

$server->register('alterGenero',
		array('genero'=>'tns:Genero'),
		array('return'=>'xsd:string'),
		'urn:server.alterGenero',
		'urn:server.alterGenero#alterGenero',
		'rpc',
		'encode',
		'return string informando se o Genero foi alterado'
);
$server->register('deleteGenero',
		array('genero'=>'tns:Genero'),
		array('return'=>'xsd:string'),
		'urn:server.deleteGenero',
		'urn:server.deleteGenero#xdeleteGenero',
		'rpc',
		'encode',
		'return string informando se o Genero foi deletado'
);


/**
 * Registrando as funções referentes ao manter do Book
 *
 **/

$server->register('insertBook',
		array('book'=>'tns:Book'),
		array('return'=>'xsd:string'),
		'urn:server.insertBook',
		'urn:server.insertBook#insertBook',
		'rpc',
		'encode',
		'return string informando se o Book foi cadastrado'
);

$server->register('getBook',
		array('search'=>'tns:Search'),
		array('return'=>'tns:BookArray'),
		'urn:server.getBook',
		'urn:server.getBook#getBook',
		'rpc',
		'encode',
		'return BookArray contendo um ou mais Book'
);

$server->register('alterBook',
		array('book'=>'tns:Book'),
		array('return'=>'xsd:string'),
		'urn:server.alterBook',
		'urn:server.alterBook#alterBook',
		'rpc',
		'encode',
		'return string informando se o Genero foi alterado'
);
$server->register('deleteBook',
		array('book'=>'tns:Book'),
		array('return'=>'xsd:string'),
		'urn:server.deleteBook',
		'urn:server.deleteBook#xdeleteBook',
		'rpc',
		'encode',
		'return string informando se o Book foi deletado'
);


/**
 * Registrando as funções referentes ao manter do relacionamento LIVRO LIDO
 *
 **/

$server->register('insertLivroLido',
		array('livrolido'=>'tns:LivroLido'),
		array('return'=>'xsd:string'),
		'urn:server.insertLivroLido',
		'urn:server.insertLivroLido#insertLivroLido',
		'rpc',
		'encode',
		'return string informando se o relacionamento foi cadastrado'
);

$server->register('getLivroLido',
		array('search'=>'tns:Search'),
		array('return'=>'tns:LivroLidoArray'),
		'urn:server.getLivroLido',
		'urn:server.getLivroLido#getLivroLido',
		'rpc',
		'encode',
		'return BookArray contendo um ou mais Livro lido pelo usuário'
);

$server->register('deleteLivroLido',
		array('livrolido'=>'tns:LivroLido'),
		array('return'=>'xsd:string'),
		'urn:server.deleteLivroLido',
		'urn:server.deleteLivroLido#deleteLivroLido',
		'rpc',
		'encode',
		'return String informando se o relacionamento foi deletado'
);



?>