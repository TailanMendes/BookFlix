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
 *		para a funçao de insertUser esse campo deve ser NULL, pois, o BD gerará automáticamente 
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
				'usucodigo'=>array('name'=>'usucodigo','type'=>'xsd:int'),
				'usunome'=>array('name'=>'usunome','type'=>'xsd:string'),
				'usuemail'=>array('name'=>'usuemail','type'=>'xsd:string'),
				'ususenha'=>array('name'=>'ususenha','type'=>'xsd:string'),
				'usutelefone'=>array('name'=>'usutelefone','type'=>'xsd:int'),
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
 * 		para a funçao de insertLivro esse campo deve ser NULL, pois, o BD gerará automáticamente 
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
				'livcodigo'=>array('name'=>'livcodigo','type'=>'xsd:int'),
				'livnome'=>array('name'=>'livnome','type'=>'xsd:string'),
				'livautor'=>array('name'=>'livautor','type'=>'xsd:int'),
				'livgencodigo'=>array('name'=>'livgencodigo','type'=>'xsd:int'),
				'livanopublicacao'=>array('name'=>'livanopublicacao','type'=>'xsd:string'),
				'livrlocalsalvo'=>array('name'=>'livrlocalsalvo','type'=>'xsd:string'),
				'livthumb'=>array('name'=>'livthumb','type'=>'xsd:string'),
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
 * 		para a funçao de insertGenero esse campo deve ser NULL, pois, o BD gerará automáticamente
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
				'gencodigo'=>array('name'=>'gencodigo','type'=>'xsd:int'),
				'gennome'=>array('name'=>'gennome','type'=>'xsd:string'),
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
 * 		para a funçao de insertGenero esse campo deve ser NULL, pois, o BD gerará automáticamente
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
				'autcodigo'=>array('name'=>'autcodigo','type'=>'xsd:int'),
				'autnome'=>array('name'=>'autnome','type'=>'xsd:string'),
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
/** data Search
 * define o tipo de dado Search, onde o mesmo é um array contendo quatro outros array
 * como mostrado:
 * Search -> codigo->"<caso preenchido, retorna a informacao referente a este codigo>"
 * Search -> nomeAprox->"<nome a ser pesquisado no BD, retornará nomes que contenham esse campo como substring>"
 * Search-> nomeExato->"<nome exato que será pesquisado no BD>"
 * Search-> limite->"<limit de resultado retornados pela busca>"
 * 
 * 
 * regras:
 * caso o campo 'codigo' seja preenchido, somente o campo 'limite' poderá ou não ser preenchido os outros dois não devem conter informação
 * Somente um dos campos referente a nome deve ser preenchido(nomeAprox,nomeExato), caso os dois sejam preenchidos e enviado a solicitação 
 * retornará uma mensagem de erro.
 * o campo 'limite' é aconselhável que seja preenchido
 *
 * */
$server->wsdl->addComplexType('Search',//Nome do novo tipo de dado
		'complexType',//categoria do tipo de dado
		'struct',//forma
		'all',//
		'',
		array(
				'codigo'=>array('name'=>'codigo','type'=>'xsd:int'),
				'nomeAprox'=>array('name'=>'nomeAprox','type'=>'xsd:string'),
				'nomeExato'=>array('name'=>'nomeExato','type'=>'xsd:string'),
				'limite'=>array('name'=>'limite','type'=>'xsd:int'),
		)
);

/** data LivroLido
 * define o tipo de dado LivroLido, onde o mesmo é um array contendo dois outros array
 * como mostrado:
 * Search -> usucodigo->"<codigo do usuario>"
 * Search -> livcodigo->"<codigo do livro>"
 *
 * */
$server->wsdl->addComplexType('LivroLido',//Nome do novo tipo de dado
		'complexType',//categoria do tipo de dado
		'struct',//forma
		'all',//
		'',
		array(
				'boolidusucodigo'=>array('name'=>'usucodigo','type'=>'xsd:int'),
				'boollidlivcodigo'=>array('name'=>'livcodigo','type'=>'xsd:int'),
		)
);
/* data LivroLidoArray, mesma funçao que o data LivroLido mas contendo mais de um registro*/
$server->wsdl->addComplexType(
		'LivroLidoArray',
		'complexType',
		'array',
		'',
		'SOAP-ENC:Array',
		array(),
		array(
				array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:LivroLido[]')
		),
		'tns:LivroLido'
);


?>
