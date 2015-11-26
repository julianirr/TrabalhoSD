<?php 
	require_once("../logica-usuario.php"); 
	require_once("banco-login.php");

	extract($_REQUEST);
	$usuario = buscaLogin($_REQUEST['email'], $_REQUEST['senha']);
	if ($usuario == null){ 
		$_SESSION["danger"]="Usuário ou senha inválido.";
		header("Location: ../index.php");
	}else {
		gravarAcesso($usuario['id']);
		$_SESSION["success"]="Bem Vindo(a) , ".$usuario["nome"]."!";
		$_SESSION["acesso"]="";
		logaUsuario($usuario["email"]);
		nomeUsuario($usuario["nome"]);
		gravarAcesso($email,$senha);
		header("Location: ../admin");
	}
	die();
