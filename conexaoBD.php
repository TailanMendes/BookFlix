<?php

$servidor = 'localhost';
$banco      = 'bookflix';
$usuario  = 'root';
$senha    = '';
$link     = @mysql_connect($servidor, $usuario, $senha);
$db          = mysql_select_db($banco,$link);
/* if(!$link)
{
    echo "erro ao conectar ao banco de dados!";
    exit();
}else{
	echo "Conexão realizada com sucesso!";

}
 */

?>