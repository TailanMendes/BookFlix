<?php

require_once ('conexaoBD.php');
/**
 * Fun��es referente ao Manter do User
 **/
/**
 * fun��o usada para cadastrar o usu�rio
 * @param array com o formato do dado tipo User, definido no arquivo dataDefinition.php
 * @return String contendo a informa��o se o cadastro foi realizado com sucesso
 */
function insertUser($user){
	extract($user);
	if(!$usutelefone)
		$usutelefone="NULL";
	$inserir = "INSERT INTO usuario VALUES (NULL,'$usunome','$usuemail','$ususenha',$usutelefone)";
	$resultado = inserir($inserir);
	$retorno = "Usu�rio n�o cadastrado";
	if($resultado == 1)
		$retorno = "Usu�rio $usunome cadastrado com sucesso";
	
	return $retorno;
	
}


/**
 * fun��o usada para pesquisar o usu�rio ou retornar um array contendo v�rios usu�rios (utilizado normalmente para atualizar o banco local do website ou app)
 * @param array com o formato do dado tipo Search, definido no arquivo dataDefinition.php
 * @return array do tipo UserArray contendo um ou mais usu�rios
 * 
 * caso o parametro passado seja NULL a fun��o ir� retornar todos os usu�rios contidos no BD do WebService
 */
function getUser($Search){
	$consulta=NULL;
	if($Search['codigo'])
		$consulta = "SELECT * FROM usuario WHERE usucodigo = ".$Search['codigo'];
	else if($Search['nomeAprox'] && !$Search['nomeExato'])
		$consulta = "SELECT * FROM usuario WHERE usunome LIKE '%".$Search['nomeAprox']."%'";
	else if(!$Search['nomeAprox'] && $Search['nomeExato'])
		$consulta = "SELECT * FROM usuario WHERE usunome = '".$Search['nomeExato']."'";
	else
		$retorno = NULL;
	//$retorno = array();
	if($consulta)
		$retorno = recuperar($consulta);
	
	return $retorno;
	
}


/**
 * fun��o usada para alterar dados de um usu�rio especifico
 * @param array com o formato do dado tipo User, definido no arquivo dataDefinition.php
 * @return String confirmando se a altera��o foi realizada com sucesso 
 */
function alterUser($user){
	extract($user);
	$resultado = "Usu�rio $usunome n�o alterado";
	$consulta;
	if(!$usutelefone)
		$usutelefone="NULL";
	if(!$usucodigo)
		$consulta = "UPDATE usuario SET usunome = '$usunome',usuemail='$usuemail',ususenha='$ususenha',usutelefone=$usutelefone WHERE usunome = '$usunome'";
	else
		$consulta = "UPDATE usuario SET usunome = '$usunome',usuemail='$usuemail',ususenha='$ususenha',usutelefone=$usutelefone WHERE usucodigo = $usucodigo";
	$retorno = alterar($consulta);
	if($retorno)
		$resultado = "Usu�rio $usunome alterado com sucesso";
	return $resultado;
}

/**
 * fun��o usada para deletar um usu�rio especifico
 * @param array com o formato do dado tipo User, definido no arquivo dataDefinition.php
 * @return String confirmando se o delete foi realizada com sucesso
 */

function deleteUser($user){
	
	extract($user);
	$resultado = "Usu�rio $usunome n�o exclu�do";
	$consulta;
	if(!$usucodigo)
		$consulta = "DELETE FROM usuario WHERE usunome = '$usunome'";
	else if($usucodigo)
		$consulta = "DELETE FROM usuario WHERE usucodigo = $usucodigo";
		
	$retorno = alterar($consulta);
	if($retorno)
		$resultado = "Usu�rio $usunome exclu�do com sucesso";
	return $resultado;
	
}



/**
 * Fun��es referente ao Manter do Autor
 **/
/**
 * fun��o usada para cadastrar o Autor
 * @param array com o formato do dado tipo Autor, definido no arquivo dataDefinition.php
 * @return String contendo a informa��o se o Autor foi realizado com sucesso
 */
function insertAutor($autor){
	$nome = $autor['nomeAutor'];
	$inserir = "INSERT INTO autor VALUES (NULL,'$nome')";
	$resultado = inserir($inserir);
	return $resultado;
}

/**
 * fun��o usada para pesquisar o Autor ou retornar um array contendo v�rios Autores (utilizado normalmente para atualizar o banco local do website ou app)
 * @param array com o formato do dado tipo Search, definido no arquivo dataDefinition.php
 * @return array do tipo AutorArray contendo um ou mais Autor
 *
 * caso o parametro passado seja NULL a fun��o ir� retornar todos os autores contidos no BD do WebService
 */
function getAutor($Search){
	$consulta=NULL;
	$retorno=NULL;
	if($Search['codigo'])
		$consulta = "SELECT * FROM autor WHERE autcodigo = ".$Search['codigo'];
	else if($Search['nomeAprox'] && !$Search['nomeExato'])
		$consulta = "SELECT * FROM autor WHERE autnome LIKE '%".$Search['nomeAprox']."%'";
	else if(!$Search['nomeAprox'] && $Search['nomeExato'])
		$consulta = "SELECT * FROM autor WHERE autnome = '".$Search['nomeExato']."'";
	else 
		$retorno = NULL;
		//$retorno = array();
	if($consulta)	
		$retorno = recuperar($consulta);
	
	return $retorno;
}
/**
 * fun��o usada para alterar dados de um Autor especifico
 * @param array com o formato do dado tipo Autor, definido no arquivo dataDefinition.php
 * @return String confirmando se a altera��o foi realizada com sucesso
 */
function alterAutor($autor){
	
	
	return $recebido;
}
/**
 * fun��o usada para deletar um Autor especifico
 * @param array com o formato do dado tipo Autor, definido no arquivo dataDefinition.php
 * @return String confirmando se o delete foi realizada com sucesso,
 * 
 */
function deleteAutor($autor){

	return $recebido;
}


/**
 * Fun��es referente ao Manter do Genero
 **/

/**
 * fun��o usada para cadastrar um Genero
 * @param array com o formato do dado tipo Genero, definido no arquivo dataDefinition.php
 * @return String contendo a informa��o se o Genero foi realizado com sucesso
 */
function insertGenero($genero){
	
	return $recebido;
}
/**
 * fun��o usada para pesquisar o Genero ou retornar um array contendo v�rios Generos (utilizado normalmente para atualizar o banco local do website ou app)
 * @param array com o formato do dado tipo Search, definido no arquivo dataDefinition.php
 * @return array do tipo GeneroArray contendo um ou mais Genero
 *
 * caso o parametro passado seja NULL a fun��o ir� retornar todos os generos contidos no BD do WebService
 */
function getGenero($Search){
	$consulta=NULL;
	if($Search['codigo'])
		$consulta = "SELECT * FROM genero WHERE gencodigo = ".$Search['codigo'];
	else if($Search['nomeAprox'] && !$Search['nomeExato'])
		$consulta = "SELECT * FROM genero WHERE gennome LIKE '%".$Search['nomeAprox']."%'";
	else if(!$Search['nomeAprox'] && $Search['nomeExato'])
		$consulta = "SELECT * FROM genero WHERE gennome = '".$Search['nomeExato']."'";
	else
		$retorno = NULL;
	//$retorno = array();
	if($consulta)
		$retorno = recuperar($consulta);
	
	return $retorno;
	
}

/**
 * fun��o usada para alterar dados de um Genero especifico
 * @param array com o formato do dado tipo Genero, definido no arquivo dataDefinition.php
 * @return String confirmando se a altera��o foi realizada com sucesso
 */
function alterGenero($genero){

	return $recebido;
}
/**
 * fun��o usada para deletar um Genero especifico
 * @param array com o formato do dado tipo Genero, definido no arquivo dataDefinition.php
 * @return String confirmando se o delete foi realizada com sucesso
 */
function deleteGenero($genero){
    
	return $recebido;
}

/**
 * Fun��es referente ao Manter do Book
 **/

/**
 * fun��o usada para cadastrar um Book
 * @param array com o formato do dado tipo Book, definido no arquivo dataDefinition.php
 * @return String contendo a informa��o se o Book foi realizado com sucesso
 */
function insertBook($book){

	return $recebido;
}
/**
 * fun��o usada para pesquisar o Genero ou retornar um array contendo v�rios Generos (utilizado normalmente para atualizar o banco local do website ou app)
 * @param array com o formato do dado tipo Search, definido no arquivo dataDefinition.php
 * @return array do tipo BookArray contendo um ou mais Book,lembrando que o livro e a capa do livro ser�o enviados codificados em base64
 *
 * caso o parametro passado seja NULL a fun��o ir� retornar todos os usu�rios contidos no BD do WebService
 */
function getBook($Search){
	$consulta=NULL;
	
	if($Search['codigo'])
		$consulta = "SELECT * FROM livro WHERE livcodigo = ".$Search['codigo'];
	else if($Search['nomeAprox'] && !$Search['nomeExato'])
		$consulta = "SELECT * FROM livro WHERE livnome LIKE '%".$Search['nomeAprox']."%'";
	else if(!$Search['nomeAprox'] && $Search['nomeExato'])
		$consulta = "SELECT * FROM livro WHERE livnome = '".$Search['nomeExato']."'";
	else
		$retorno = NULL;
	//$retorno = array();
	if($consulta)
		$retorno = recuperar($consulta);
	
	return $retorno;
	
}

/**
 * fun��o usada para alterar dados de um Book especifico
 * @param array com o formato do dado tipo Book, definido no arquivo dataDefinition.php
 * @return String confirmando se a altera��o foi realizada com sucesso
 */
function alterBook($book){

	return $recebido;
}

/**
 * fun��o usada para deletar um Book especifico
 * @param array com o formato do dado tipo Book, definido no arquivo dataDefinition.php
 * @return String confirmando se o delete foi realizada com sucesso
 */
function deletBook($book){

	return $recebido;
}


/**
 *fun��o usada para inserir o relacionamento de LIVRO LIDO no banco de dados
 *@param LivroLido, contendo o usucodigo e livcodigo.
 *@return String informando se for cadastrado com sucesso.
 *
 **/
function insertLivroLido($LivroLido){
	
}
/**
 *fun��o usada para recuper um relacionamento de LIVRO LIDO,existente no banco de dados
 *@param LivroLido, contendo o usucodigo e livcodigo.
 *@return LivroLidoArray contendo a informa��o do relacionamento.
 *
 **/
function getLivroLido($LivroLido){
	$consulta=NULL;
	
	if($LivroLido['boolidusucodigo'] && !$LivroLido['boolidlivcodigo'])
		$consulta = "SELECT * FROM booklido WHERE boolidusucodigo = ".$LivroLido['boolidusucodigo'];
	else if($LivroLido['boolidlivcodigo'] && !$LivroLido['boolidusucodigo'])
		$consulta = "SELECT * FROM booklido WHERE boolidlivcodigo =".$LivroLido['boolidlivcodigo'];
	/* else if($LivroLido['boolidusucodigo'] && $LivroLido['boolidlivcodigo'])
		$consulta = "SELECT * FROM booklido WHERE boolidlivcodigo = ".$Search['boolidlivcodigo']." and boolidusucodigo = ".; */
	else
		$retorno = NULL;
	//$retorno = array();
	if($consulta)
		$retorno = recuperar($consulta);
	
	return $retorno;
}
/**
 *fun��o usada para deletar um relacionamento de LIVRO LIDO,existente no banco de dados
 *@param LivroLidoArray, contendo o usucodigo e livcodigo.
 *@return String informando se o delete foi realizado com sucesso.
 *
 **/
function deleteLivroLido($LivroLido){

}
/**
 * funcoes genericas para ADD,ALTER,DEL os dados
 * */
function inserir($sqlCommand){
	//include ('conexaoBD.php');
	$resultado = mysql_query($sqlCommand);
	return $resultado;
}

function alterar($sqlCommand){
	//include ('conexaoBD.php');
	$resultado = mysql_query($sqlCommand);
	return $resultado;
}
function deletar($sqlCommand){
	//include ('conexaoBD.php');
	$resultado = mysql_query($sqlCommand);
	return $estado;
}
function recuperar($consulta){
	//include ('conexaoBD.php');
	$resultado = mysql_query($consulta);
	$retornoconsulta;
	while ($row = mysql_fetch_assoc($resultado)) {
		$retornoconsulta[] = $row;
		//print_r ($row);
	}
	return $retornoconsulta;
}




?>