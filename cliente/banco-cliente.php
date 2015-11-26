<?php
	require_once("../conexao.php");

	function Logar() {
		$conexao = new Conecta;
		$con = 	$conexao->conexao();
		return $con;
	}

	function Deslogar($desloga) {
		mysqli_close($desloga);
	}

	function buscaUsuario($id) {
		$con = Logar();
		$query = "select * from usuarios where id = {$id} ";
		$resultado = mysqli_query($con, $query);
		$usuario = mysqli_fetch_assoc($resultado);
		return $usuario;
	}

	function cadastraUsuario($nome, $email, $senha,  $token) {
		$con = Logar();
		$nome = mysqli_real_escape_string($con, $nome);
		$email = mysqli_real_escape_string($con, $email);
		$senha = md5(mysqli_real_escape_string($con, $senha));
		$token = md5(mysqli_real_escape_string($con, $token));
		
		$query = "insert into usuarios (nome, email, ativo, senha, token) values ('{$nome}', '{$email}','S', '{$senha}', '{$token}')";
		$usuario = mysqli_query($con, $query);
		Deslogar($con);
		return $usuario;
	}

	function listaUsuario() {
		$con = Logar();
		$usuarios = array();
		$resultado = mysqli_query($con, "select 
												* 
											from 
												usuarios;");
		while($usuario = mysqli_fetch_assoc($resultado)) {
			array_push($usuarios, $usuario);
		}
		Deslogar($con);
		return $usuarios;
	}

	function alteraUsuario($id, $nome, $email, $ativo, $senha, $token) {
		$conexao = Logar();
		$id = mysqli_real_escape_string($conexao, $id);
		$nome = mysqli_real_escape_string($conexao, $nome);
		$email = mysqli_real_escape_string($conexao, $email);
		$ativo = mysqli_real_escape_string($conexao, $ativo);
		$senha = mysqli_real_escape_string($conexao, $senha);
		$token = mysqli_real_escape_string($conexao, $token);
		
		$query = "update usuarios
					set nome = '{$nome}', 
						email = '{$email}', 
						ativo = '{$ativo}',
						senha = '{$senha}',
						token = '{$token}'
					where id = {$id}
				 ";
		$usuario = mysqli_query($conexao, $query);
		Deslogar($conexao);
	}