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

	function verificaToken($token) {
		$con = Logar();
		$token = mysqli_real_escape_string($con, $token);
		$query = "SELECT 
					id, nome, token 
				 FROM 
					usuarios 
				WHERE 
					token = '{$token}';";
		$resultado = mysqli_query($con, $query);
		$usuario = mysqli_fetch_assoc($resultado);
		Deslogar($con);
		return $usuario;
	}

	function salvaLog($entrada, $histograma, $saida, $retorno) {
		$con = Logar();
		$ip = $_SERVER['REMOTE_ADDR']; // Salva o IP do visitante
		$entrada['nascimento'] = str_replace('/', '-', $entrada['nascimento']);
		$entrada['nascimento'] = date('Y-m-d', strtotime($entrada['nascimento']));
		$estado_emissor = explode("-", $entrada['estado_emissor']);

		$conclusao = "<p>De acordo com a analise das informacoes contidas em nossa base de dados, o documento informado <b>{$entrada['cpf']} </b>foi emitido no estado de <b>{$estado_emissor[1]}</b>. 
						</p>
						<p>
						O perfil de pessoas que se concentram nesta mesma faixa e nesse mesmo estado, possuem idade media de <b>{$saida['idade_maior_concentracao']}</b> anos, e no intervalo de <b>{$saida['desvio_minimo']} </b> a <b>{$saida['desvio_maximo']} </b> anos (que possui a maior concentracao de pessoas) tem uma porcentagem de abrangencia de <b>{$saida['porcentagem_abrangencia']} %</b> dos documentos registrados em nossa base.";
		$query = "insert into historico_consulta 
				(
					data_consulta, 
					cpf_completo, 
					digito_precisao, 
					data_nascimento, 
					token, 
					idade_maior_concentracao, 
					desvio_minimo, 
					desvio_maximo, 
					desvio_padrao,
					porcentagem_abrangencia,
					analise_sugerida,
					conclusao,
					id_retorno,
					id_cliente,
					estado_emissor
				) values 
				(
					now(),
					'{$entrada['cpf']}',
					{$entrada['precisao']},
					'{$entrada['nascimento']}',
					'{$entrada['token']}',
					{$saida['maior_concentracao']},
					{$saida['desvio_minimo']},
					{$saida['desvio_maximo']},
					{$saida['desvio_padrao']},
					{$saida['porcentagem_abrangencia']},
					'{$saida['analise_sugerida']}',
					'{$conclusao}',
					{$retorno},
					{$entrada['id_cliente']},
					'{$entrada['estado_emissor']}'
				);";
		/*for ($i=0; $i < strlen($query); $i++) { 
			echo $query[$i];
		}exit();*/
		$log = mysqli_query($con,$query);
		$ultimoID = mysqli_insert_id($con);

		foreach ($histograma as $chave) {
			$queryHistograma = "insert into histograma 
							(
								id_historico_consulta, 
								idade, 
								quantidade
							) values 
							(
								{$ultimoID},
								{$chave['valor']},
								{$chave['quantidade']}
							);";
			$log = mysqli_query($con,$queryHistograma);
		}
		Deslogar($con);
		return $log;
	}

	function listaDados($tam,$digito,$cpf) {
		$con 	= Logar();
		$tam 	= mysqli_real_escape_string($con, $tam);
		$digito = mysqli_real_escape_string($con, $digito);
		$cpf 	= mysqli_real_escape_string($con, $cpf);
		$dados 	= array();
		$query	= "SELECT 
					idade,
					total AS quantidade 
				FROM 
					agrupado_cpf{$tam}_digito{$digito}
				WHERE 
					cpf_cortado = '{$cpf}';";
		$resultado = mysqli_query($con, $query);
		while($dado = mysqli_fetch_assoc($resultado)) {
			array_push($dados, $dado);
		}
		Deslogar($con);
		return $dados;
	}

	function alteraCliente($id, $nome, $email, $ativo) {
		$con = Logar();
		$id 	= mysqli_real_escape_string($con, $id);
		$nome 	= mysqli_real_escape_string($con, $nome);
		$email 	= mysqli_real_escape_string($con, $email);
		$ativo 	= mysqli_real_escape_string($con, $ativo);
		
		$query = "update clientes
					set nome = '{$nome}', 
						email = '{$email}', 
						ativo = '{$ativo}'
					where id = {$id}
				 ";

		$usuario = mysqli_query($con, $query);
		Deslogar($con);
	}