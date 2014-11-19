<?php


/**
 * 
 * @Autor: Wirlino
 * @Date: 18/11/2014 23:40
 * @information: arquivo responsável por definir os tipos de dados complexos (não primitivos)
 * utilizados pelo WebService
 * 
 * */


//Tipo de dados complexos

/** data User
 * define o tipo de dado User, onde o mesmo é um array contendo cinco outros array
 * como mostrado:
 * User -> codUser->"<codigo do Usuário>"
 *		para a funçao de cadLivro esse campo deve ser NULL, pois, o BD gerará automáticamente 
 * 		esse campo
 * User -> nomeUser->"<nome a ser cadastrado>"
 * User -> emailUser->"<email a ser cadastrado>"
 * User -> telefoneUser->"<telefone a ser cadastrado>"
 * 			caso telefoneUser seja null, o cliente deve mandar esse campo com uma string vazia
 * User -> senhaUser->"<senha a ser cadastrado>"
 * 
 * */
$server->wsdl->addComplexType('User',//Nome do novo tipo de dado
		'complexType',//categoria do tipo de dado
		'struct',//forma
		'all',//
		'',
		array(
				'codUser'=>array('name'=>'codUser','type'=>'xsd:int'),
				'nomeUser'=>array('name'=>'nomeUser','type'=>'xsd:string'),
				'emailUser'=>array('name'=>'emailUser','type'=>'xsd:string'),
				'telefoneUser'=>array('name'=>'telefoneUser','type'=>'xsd:string'),
				'senhaUser'=>array('name'=>'senhaUser','type'=>'xsd:string'),
		)
);

/* data UserArray, mesma funçao que User mas contendo mais de um usário
 *
 * */
$server->wsdl->addComplexType(
    'UserArray',
    'complexType',
    'array',
    '',
    'SOAP-ENC:Array',
    array(),
    array(
        array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:User[]')
    ),
    'tns:User'
	);



/** data Book
 * define o tipo de dado Book, onde o mesmo é um array contendo sete outros array
 * como mostrado:
 *
 * Book -> codLivro->"<codigo do livro>"
 * 		para a funçao de cadLivro esse campo deve ser NULL, pois, o BD gerará automáticamente 
 * 		esse campo
 * Book -> nomeLivro->"<nome a ser cadastrado>"
 * Book -> codAutor->"<codigo do campo autcodigo da tabela autor do banco de dados, que refere-se ao autor do livro>"
 * Book -> codGenero->"<codigo do campo gencodigo da tabela genero do banco de dados, 
 * 		  que refere-se ao genero do livro>"
 * Book -> anopub->"<ano a ser cadastrado>"
 * Book -> arquivo->"um array de byte codificado em base64 referente ao livro PDF"
 * Book -> thumb->"um array de byte codificado em base64 referente a imagem da capa do livro"
 * */
$server->wsdl->addComplexType('Book',//Nome do novo tipo de dado
		'complexType',//categoria do tipo de dado
		'struct',//forma
		'all',//
		'',
		array(
				'codLivro'=>array('name'=>'codLivro','type'=>'xsd:int'),
				'nomeLivro'=>array('name'=>'nomeLivro','type'=>'xsd:string'),
				'codAutor'=>array('name'=>'codAutor','type'=>'xsd:int'),
				'codGenero'=>array('name'=>'codGenero','type'=>'xsd:int'),
				'anopub'=>array('name'=>'anopub','type'=>'xsd:string'),
				'arquivo'=>array('name'=>'arquivo','type'=>'xsd:string'),
				'thumb'=>array('name'=>'thumb','type'=>'xsd:string'),
		)
);

/* data BookArray, mesma funçao que o data Book mas contendo mais de um registro*/
$server->wsdl->addComplexType(
		'BookArray',
		'complexType',
		'array',
		'',
		'SOAP-ENC:Array',
		array(),
		array(
				array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:Book[]')
		),
		'tns:Book'
);




/** data Genero
 * define o tipo de dado Genero, onde o mesmo é um array contendo dois outros array
 * como mostrado:
 *
 * Genero -> codGenero->"<codigo do Genero>"
 * 		para a funçao de cadGenero esse campo deve ser NULL, pois, o BD gerará automáticamente
 * 		esse campo
 * Genero-> nomeGenero->"<nome a ser cadastrado>"
 *
 * */
$server->wsdl->addComplexType('Genero',//Nome do novo tipo de dado
		'complexType',//categoria do tipo de dado
		'struct',//forma
		'all',//
		'',
		array(
				'codGenero'=>array('name'=>'codGenero','type'=>'xsd:int'),
				'nomeGenero'=>array('name'=>'nomeGenero','type'=>'xsd:string'),
		)
);

/* data GeneroArray, mesma funçao que o data Genero mas contendo mais de um registro*/
$server->wsdl->addComplexType(
		'GeneroArray',
		'complexType',
		'array',
		'',
		'SOAP-ENC:Array',
		array(),
		array(
				array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:Genero[]')
		),
		'tns:Genero'
);



/** data Autor
 * define o tipo de dado Autor, onde o mesmo é um array contendo dois outros array
 * como mostrado:
 *
 * Autor -> codAutor->"<codigo do Autor>"
 * 		para a funçao de cadGenero esse campo deve ser NULL, pois, o BD gerará automáticamente
 * 		esse campo
 *  Autor-> nomeAutor->"<nome a ser cadastrado>"
 *
 * */
$server->wsdl->addComplexType('Autor',//Nome do novo tipo de dado
		'complexType',//categoria do tipo de dado
		'struct',//forma
		'all',//
		'',
		array(
				'codAutor'=>array('name'=>'codAutor','type'=>'xsd:int'),
				'nomeAutor'=>array('name'=>'nomeAutor','type'=>'xsd:string'),
		)
);

/* data AutorArray, mesma funçao que o data Autor mas contendo mais de um registro*/
$server->wsdl->addComplexType(
		'AutorArray',
		'complexType',
		'array',
		'',
		'SOAP-ENC:Array',
		array(),
		array(
				array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:Autor[]')
		),
		'tns:Autor'
);




?>
