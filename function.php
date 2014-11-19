<?php

function cadUser($param){
	//print_r($param)
	$array = array();
	$i=0;
	while($i<2){
		$array[$i]=$param[$i];
		$i=$i+1;
	}
	$recebido = 'Recebido';
	return $array;
	/*
	 foreach($param as $inarray)
	 {
	$retarray[] = array(
			"codUser" => $inarray['codUser'],
			"nomeLivro"=>$inarray['nomeLivro'],
			"nomeLivro"=>$inarray['codUser'],

	);
	}
	return $retarray[0];
	*/

}


function cadAutor($autor){
	$recebido = 'Recebido';
	return $recebido;
}


function cadGenero($genero){
	$recebido = 'Recebido';
	return $recebido;
}




?>