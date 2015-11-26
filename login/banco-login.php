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

	function gravarAcesso($id_cliente) {
		$con = Logar();
		$id_cliente = mysqli_real_escape_string($con, $id_cliente);
		$ip = $_SERVER['REMOTE_ADDR']; // Salva o IP do visitante
		$query = "insert into log_acesso 
				(
					data_acesso, 
					ip,
					id_cliente
				) values 
				(
					now(),
					'{$ip}',
					 {$id_cliente}
				);";
		$log = mysqli_query($con,$query);
		Deslogar($con);
		return $log;
	}

	function buscaLogin($email, $senha) {
		$con = Logar();
		$senha = mysqli_real_escape_string($con, $senha);
		$senhaMd5 = md5($senha);
		$email = mysqli_real_escape_string($con, $email);
		$query = "select id, nome, email, senha, tipo_usuario from usuarios where ativo = 'S' and email = '{$email}' and senha = '{$senhaMd5}' ";
		$resultado = mysqli_query($con, $query);
		$usuario = mysqli_fetch_assoc($resultado);
		return $usuario;
	}