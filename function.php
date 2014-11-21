<?php

require_once ('conexaoBD.php');
/**
 * Funчѕes referente ao Manter do User
 **/
/**
 * funчуo usada para cadastrar o usuсrio
 * @param array com o formato do dado tipo User, definido no arquivo dataDefinition.php
 * @return String contendo a informaчуo se o cadastro foi realizado com sucesso
 */
function insertUser($user){
	extract($user);
	if(!$usutelefone)
		$usutelefone="NULL";
	$inserir = "INSERT INTO usuario VALUES (NULL,'$usunome','$usuemail','$ususenha',$usutelefone)";
	$resultado = inserir($inserir);
	$retorno = "Usuсrio nуo cadastrado";
	if($resultado == 1)
		$retorno = "Usuсrio $usunome cadastrado com sucesso";
	
	return $retorno;
	
}


/**
 * funчуo usada para pesquisar o usuсrio ou retornar um array contendo vсrios usuсrios (utilizado normalmente para atualizar o banco local do website ou app)
 * @param array com o formato do dado tipo Search, definido no arquivo dataDefinition.php
 * @return array do tipo UserArray contendo um ou mais usuсrios
 * 
 * caso o parametro passado seja NULL a funчуo irс retornar todos os usuсrios contidos no BD do WebService
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
 * funчуo usada para alterar dados de um usuсrio especifico
 * @param array com o formato do dado tipo User, definido no arquivo dataDefinition.php
 * @return String confirmando se a alteraчуo foi realizada com sucesso 
 */
function alterUser($user){
	extract($user);
	$resultado = "Usuсrio $usunome nуo alterado";
	$consulta;
	if(!$usutelefone)
		$usutelefone="NULL";
	if(!$usucodigo)
		$consulta = "UPDATE usuario SET usunome = '$usunome',usuemail='$usuemail',ususenha='$ususenha',usutelefone=$usutelefone WHERE usunome = '$usunome'";
	else
		$consulta = "UPDATE usuario SET usunome = '$usunome',usuemail='$usuemail',ususenha='$ususenha',usutelefone=$usutelefone WHERE usucodigo = $usucodigo";
	$retorno = alterar($consulta);
	if($retorno)
		$resultado = "Usuсrio $usunome alterado com sucesso";
	return $resultado;
}

/**
 * funчуo usada para deletar um usuсrio especifico
 * @param array com o formato do dado tipo User, definido no arquivo dataDefinition.php
 * @return String confirmando se o delete foi realizada com sucesso
 */

function deleteUser($user){
	
	extract($user);
	$resultado = "Usuсrio $usunome nуo excluэdo";
	$consulta;
	if(!$usucodigo)
		$consulta = "DELETE FROM usuario WHERE usunome = '$usunome'";
	else if($usucodigo)
		$consulta = "DELETE FROM usuario WHERE usucodigo = $usucodigo";
		
	$retorno = alterar($consulta);
	if($retorno)
		$resultado = "Usuсrio $usunome excluэdo com sucesso";
	return $resultado;
	
}



/**
 * Funчѕes referente ao Manter do Autor
 **/
/**
 * funчуo usada para cadastrar o Autor
 * @param array com o formato do dado tipo Autor, definido no arquivo dataDefinition.php
 * @return String contendo a informaчуo se o Autor foi realizado com sucesso
 */
function insertAutor($autor){
	$nome = $autor['nomeAutor'];
	$retorno="Autor $nome nуo cadastrado";
	$inserir = "INSERT INTO autor VALUES (NULL,'$nome')";
	$resultado = inserir($inserir);
	if($resultado)
		$retorno="Autor $nome cadastrado com sucesso";
	
	
	return $retorno;
}

/**
 * funчуo usada para pesquisar o Autor ou retornar um array contendo vсrios Autores (utilizado normalmente para atualizar o banco local do website ou app)
 * @param array com o formato do dado tipo Search, definido no arquivo dataDefinition.php
 * @return array do tipo AutorArray contendo um ou mais Autor
 *
 * caso o parametro passado seja NULL a funчуo irс retornar todos os autores contidos no BD do WebService
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
 * funчуo usada para alterar dados de um Autor especifico
 * @param array com o formato do dado tipo Autor, definido no arquivo dataDefinition.php
 * @return String confirmando se a alteraчуo foi realizada com sucesso
 */
function alterAutor($autor){
	
	extract($autor);
	$resultado = "Autor $autnome nуo alterado";
	$consulta;

	if(!$autcodigo)
		$consulta = "UPDATE autor SET autnome = '$autnome' WHERE autnome = '$autnome'";
	else if($autcodigo)
		$consulta = "UPDATE autor SET autnome = '$autnome' WHERE autcodigo = $autcodigo";
	$retorno = alterar($consulta);
	if($retorno)
		$resultado = "Alterado $autnome alterado com sucesso";
	return $resultado;
	
}
/**
 * funчуo usada para deletar um Autor especifico
 * @param array com o formato do dado tipo Autor, definido no arquivo dataDefinition.php
 * @return String confirmando se o delete foi realizada com sucesso,
 * 
 */
function deleteAutor($autor){
	extract($autor);
	$resultado = "Autor $autnome nуo excluэdo";
	$consulta;
	if(!$usucodigo)
		$consulta = "DELETE FROM autor WHERE autnome = '$autnome'";
	else if($usucodigo)
		$consulta = "DELETE FROM autor WHERE autcodigo = $autcodigo";
	
	$retorno = alterar($consulta);
	if($retorno)
		$resultado = "Autor $autnome excluэdo com sucesso";
	return $resultado;
	
}


/**
 * Funчѕes referente ao Manter do Genero
 **/

/**
 * funчуo usada para cadastrar um Genero
 * @param array com o formato do dado tipo Genero, definido no arquivo dataDefinition.php
 * @return String contendo a informaчуo se o Genero foi realizado com sucesso
 */
function insertGenero($genero){
	$nome = $genero['gennome'];
	$retorno="Autor $nome nуo cadastrado";
	$inserir = "INSERT INTO autor VALUES (NULL,'$nome')";
	$resultado = inserir($inserir);
	if($resultado)
		$retorno="Genero $nome cadastrado com sucesso";
	
	
	return $retorno;
	
}
/**
 * funчуo usada para pesquisar o Genero ou retornar um array contendo vсrios Generos (utilizado normalmente para atualizar o banco local do website ou app)
 * @param array com o formato do dado tipo Search, definido no arquivo dataDefinition.php
 * @return array do tipo GeneroArray contendo um ou mais Genero
 *
 * caso o parametro passado seja NULL a funчуo irс retornar todos os generos contidos no BD do WebService
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
 * funчуo usada para alterar dados de um Genero especifico
 * @param array com o formato do dado tipo Genero, definido no arquivo dataDefinition.php
 * @return String confirmando se a alteraчуo foi realizada com sucesso
 */
function alterGenero($genero){
	extract($genero);
	$resultado = "Genero $gennome nуo alterado";
	$consulta;
	
	if(!$gencodigo)
		$consulta = "UPDATE genero SET gennome = '$gennome' WHERE gennome = '$gennome'";
	else if($gencodigo)
		$consulta = "UPDATE autor SET gennome = '$gennome' WHERE gencodigo = $gencodigo";
	$retorno = alterar($consulta);
	if($retorno)
		$resultado = "Alterado $gennome alterado com sucesso";
	return $resultado;
	
}
/**
 * funчуo usada para deletar um Genero especifico
 * @param array com o formato do dado tipo Genero, definido no arquivo dataDefinition.php
 * @return String confirmando se o delete foi realizada com sucesso
 */
function deleteGenero($genero){
	extract($genero);
	$resultado = "Genero $gennome nуo excluэdo";
	$consulta;
	if(!$gencodigo)
		$consulta = "DELETE FROM genero WHERE gennome = '$gennome'";
	else if($gencodigo)
		$consulta = "DELETE FROM genero WHERE gencodigo = $gencodigo";
	
	$retorno = alterar($consulta);
	if($retorno)
		$resultado = "Genero $gennome excluэdo com sucesso";
	return $resultado;
}

/**
 * Funчѕes referente ao Manter do Book
 **/

/**
 * funчуo usada para cadastrar um Book
 * @param array com o formato do dado tipo Book, definido no arquivo dataDefinition.php
 * @return String contendo a informaчуo se o Book foi realizado com sucesso
 */
function insertBook($Livro){
	extract($Livro);
	
	$nomeArquivo  = gerarNomeArquivo($Livro);
	//salvarArquivo($nomeARQUIVO, $filePDFBase64, $fileThumbBase64)
	
	$inserir = "INSERT INTO book VALUES (NULL,$livautcodigo,$livgencodigo,'$livnome','$livanopublicacao','$nomeArquivo.pdf','$nomeArquivo.jpg')";
	$resultado = inserir($inserir);
	$retorno = "Livro $livnome nуo cadastrado";
	if($resultado == 1){
		$retorno = "Livro $livnome cadastrado com sucesso";
		salvarArquivo($livnome, $livrlocalsalvo, $livthumb);
	}
	
	return $retorno;
	
}
/**
 * funчуo usada para pesquisar o Genero ou retornar um array contendo vсrios Generos (utilizado normalmente para atualizar o banco local do website ou app)
 * @param array com o formato do dado tipo Search, definido no arquivo dataDefinition.php
 * @return array do tipo BookArray contendo um ou mais Book,lembrando que o livro e a capa do livro serуo enviados codificados em base64
 *
 * caso o parametro passado seja NULL a funчуo irс retornar todos os usuсrios contidos no BD do WebService
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
	
	$tamanhoVetor = sizeof($retorno);
	$posicao = 0;
	//Codificando os arquivos PDF e JPG de retorno para Base64
	if($retorno)
		while($posicao<$tamanhoVetor){
			$pathPDF = "static/pdf/$retorno[$posicao]['livrlocalsalvo']";
			$pathThumb = "static/thumb/$retorno[$posicao]['livthumb']";
			$retorno[$posicao]['livrlocalsalvo'] = encode_decode_base64($pathPDF, "encode");
			$retorno[$posicao]['livthumb'] = encode_decode_base64($pathThumb, "encode");
			$posicao=$posicao+1;
		}
	
	return $retorno;
	
}



/**
 * funчуo usada para alterar dados de um Book especifico
 * @param array com o formato do dado tipo Book, definido no arquivo dataDefinition.php
 * @return String confirmando se a alteraчуo foi realizada com sucesso
 */
function alterBook($Livro){
	extract($Livro);
	$resultado = "Livro $livnome nуo alterado";
	$consulta;
	
	$nomeArquivo = gerarNomeArquivo($Livro);
	
	if($livcodigo){
		$consulta = "UPDATE livro SET livnome = '$livnome',livautcodigo=$livautcodigo,livgencodigo=$livgencodigo,livanopublicacao='$livanopublicacao',";
		$consulta.= "livrlocalsalvo='$nomeArquivo.pdf',livthumb='$nomeArquivo.jpg' WHERE livcodigo = $livcodigo";
	}/* else if($gencodigo)
		$consulta = "UPDATE autor SET gennome = '$gennome' WHERE gencodigo = $livcodigo";*/
	$retorno = alterar($consulta); 
	if($retorno){
		$resultado = "Alterado $livnome alterado com sucesso";
		salvarArquivo($nomeArquivo, $livrlocalsalvo, $livthumb);
	}
	return $resultado;
}

/**
 * funчуo usada para deletar um Book especifico
 * @param array com o formato do dado tipo Book, definido no arquivo dataDefinition.php
 * @return String confirmando se o delete foi realizada com sucesso
 */
function deleteBook($book){
	extract($book);
	$resultado = "Livro $livnome nуo excluэdo";
	$consulta;
	if($livcodigo)
		$consulta = "DELETE FROM livro WHERE livcodigo = $livcodigo";
	
	$retorno = alterar($consulta);
	if($retorno){
		$resultado = "Livro $livnome excluэdo com sucesso";
		$filenome = gerarNomeArquivo($book);
		deletePDFandThumb($filenome);
	}
	return $resultado;
	
}


/**
 *funчуo usada para inserir o relacionamento de LIVRO LIDO no banco de dados
 *@param LivroLido, contendo o usucodigo e livcodigo.
 *@return String informando se for cadastrado com sucesso.
 *
 **/
function insertLivroLido($LivroLido){
	extract($LivroLivro);
	$inserir = "INSERT INTO booklido VALUES ($boolidusucodigo,$boolidlivcodigo)";
	$resultado = inserir($inserir);
	$retorno = "Relacionamento nуo cadastrado";
	if($resultado == 1){
		$retorno = "Relacionamento cadastrado com sucesso";
		salvarArquivo($livnome, $livrlocalsalvo, $livthumb);
	}
	
	return $retorno;
}
/**
 *funчуo usada para recuper um relacionamento de LIVRO LIDO,existente no banco de dados
 *@param LivroLido, contendo o usucodigo e livcodigo.
 *@return LivroLidoArray contendo a informaчуo do relacionamento.
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
 *funчуo usada para deletar um relacionamento de LIVRO LIDO,existente no banco de dados
 *@param LivroLidoArray, contendo o usucodigo e livcodigo.
 *@return String informando se o delete foi realizado com sucesso.
 *
 **/
function deleteLivroLido($LivroLido){
	extract($LivroLido);
	$resultado = "Livro lido $boolidlivnome nуo excluэdo";
	$consulta;
	if($boolidlivcodigo)
		$consulta = "DELETE FROM booklido WHERE boolidlivcodigo = $boolidlivcodigo and boolidusucodigo = $boolidusucodigo";
	
	$retorno = alterar($consulta);
	if($retorno)
		$resultado = "Livro livro $boolidlivnome excluэdo com sucesso";
	return $resultado;
}
/**
 * funcoes genericas para ADD,ALTER,DEL os dados e funcoes usadas internamente por outras funcoes
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

function encode_decode_base64($file,$opcao){
	$retorno = NULL;
	if($opcao="decode")
		$retorno = base64_decode($file);
	else if ($opcao="encode"){
		$filename = file("$file",FILE_BINARY);
		$retorno = base64_encode(implode('', $filename));
	}

	return $retorno;
}

function salvarArquivo($filenome,$filePDFBase64,$fileThumbBase64){

	$filePDFdecoded = encode_decode_base64($filePDFBase64, "decode");
	$fileThumbdecoded = encode_decode_base64($fileThumbBase64, "decode");

	$pathPDF = "static/pdf/$filenome.pdf";
	$pathThumb = "static/thumb/$filenome.jpg";
	file_put_contents($pathPDF,$filePDFdecoded);//Cria o arquivo PDF
	file_put_contents($pathThumb,$fileThumbdecoded);//Cria o arquivo .jpg
}

function gerarNomeArquivo($book){
	$retorno = NULL;
	$bookautcodigo = $book['livautcodigo'];
	$Search  = array(
			'codigo'=>$bookautcodigo,
	);
	$nomeautor = getAutor($Search);
	$retorno = str_replace(" ", "-", $nomeautor[0]['autnome']." ".$book['livnome']);
	return $retorno;
}

function deletePDFandThumb($filenome){
	$pathPDF = "static/pdf/$filenome";
	$pathThumb = "static/thumb/$filenome";
	unlink($pathPDF);
	unlink($pathThumb);
}

?>