<?php require_once("../logica-usuario.php"); verificaUsuario();?>
<?php
	if($_POST) 
	{
		require_once("banco-cliente.php");
		extract($_POST);
		$id			= $_POST["id"];
		$nome		= $_POST["nome"];
		$email 		= $_POST["email"];
		$ativo		= $_POST["ativo"];
		$senha		= $_POST["senha"];
		$token		= $_POST["token"];

		alteraUsuario($id, $nome, $email, $ativo, md5($senha), $token);

		header('Location: processacadastrarcliente.php');
		die;
	}
?>