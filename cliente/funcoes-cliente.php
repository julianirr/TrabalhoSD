<?php
function gera_Token($tamanho) 
{
	$caracterDisponivel = "1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$tokenGerado = '';
	for($i=0;$i<$tamanho;$i++) {
		$tokenGerado .= $caracterDisponivel{rand(0,61)};
	}
	return $tokenGerado;
}

?>