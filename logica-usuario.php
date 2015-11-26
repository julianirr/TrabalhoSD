<?php
	session_start();
	function usuarioEstaLogado(){
		return isset($_SESSION["usuario_logado"]);
	}
	function verificaUsuario() {
		if(!usuarioEstaLogado())
		{
			$_SESSION["danger"]="Você não tem acesso a esta fucionalidade.";
			header("Location:../index.php");
			die();
		}
	}
	
	function usuarioLogado(){
		return $_SESSION["usuario_logado"];
	}
	
	function logaUsuario($email){
		$_SESSION["usuario_logado"] = $email;
	}
	
	function nomeUsuario($nome){
		$_SESSION["usuario_logado_nome"] = $nome;
	}
	
	function logout(){
		session_destroy();
		session_start();
	}