<?php

/**
 * Fun��es referente ao Manter do User
 **/
/**
 * fun��o usada para cadastrar o usu�rio
 * @param array com o formato do dado tipo User, definido no arquivo dataDefinition.php
 * @return String contendo a informa��o se o cadastro foi realizado com sucesso
 */
function insertUser($user){
	
	return $array;
	
}


/**
 * fun��o usada para pesquisar o usu�rio ou retornar um array contendo v�rios usu�rios (utilizado normalmente para atualizar o banco local do website ou app)
 * @param array com o formato do dado tipo Search, definido no arquivo dataDefinition.php
 * @return array do tipo UserArray contendo um ou mais usu�rios
 * 
 * caso o parametro passado seja NULL a fun��o ir� retornar todos os usu�rios contidos no BD do WebService
 */
function getUser($pesquisa){
	
	return $recebido;
}


/**
 * fun��o usada para alterar dados de um usu�rio especifico
 * @param array com o formato do dado tipo User, definido no arquivo dataDefinition.php
 * @return String confirmando se a altera��o foi realizada com sucesso 
 */
function alterUser($user){

	return $recebido;
}

/**
 * fun��o usada para deletar um usu�rio especifico
 * @param array com o formato do dado tipo User, definido no arquivo dataDefinition.php
 * @return String confirmando se o delete foi realizada com sucesso
 */

function deleteUser($user){

	return $recebido;
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
	
	return $recebido;
}

/**
 * fun��o usada para pesquisar o Autor ou retornar um array contendo v�rios Autores (utilizado normalmente para atualizar o banco local do website ou app)
 * @param array com o formato do dado tipo Search, definido no arquivo dataDefinition.php
 * @return array do tipo AutorArray contendo um ou mais Autor
 *
 * caso o parametro passado seja NULL a fun��o ir� retornar todos os autores contidos no BD do WebService
 */
function getAutor($pesquisa){

	return $recebido;
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
 * @return String confirmando se o delete foi realizada com sucesso
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
function getGenero($pesquisa){

	return $recebido;
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
 * @return array do tipo BookArray contendo um ou mais Genero
 *
 * caso o parametro passado seja NULL a fun��o ir� retornar todos os usu�rios contidos no BD do WebService
 */
function getBook($pequisa){

	return $recebido;
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






?>