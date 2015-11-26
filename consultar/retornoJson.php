<?php
	function criarJson($entrada){
		$url = 'http://localhost:82/analiseCPF_Entrega/consultar/processaForm.php?token='.$entrada["token"].'&cpf='.$entrada["cpf"].'&nascimento='.$entrada["nascimento"].'&tamanho='.$entrada["precisao"].'&retorno=2';
		header('Content-Type: application/json');
		$jsoncode = json_encode(simplexml_load_file($url));
		$jsoncode = str_replace ( "\/" , "/" , $jsoncode);
		print_r($jsoncode);
	}