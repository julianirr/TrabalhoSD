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

	function buscaGraficoTipo() {
		$con = Logar();
		$consultas = array();
		$query = "SELECT 
					concat('Tipo retorno: ',b.descricao_tipo) as tipo_consulta,
					count(b.descricao_tipo) as quantidade
				FROM 
					analisecpf.historico_consulta a
				INNER JOIN analisecpf.tipo_retorno b
					ON a.id_retorno = b.id_retorno
				group by b.descricao_tipo;";

		$resultado = mysqli_query($con,$query);
		while($consulta = mysqli_fetch_assoc($resultado)) {
			array_push($consultas, $consulta);
		}

		Deslogar($con);
		return $consultas;
	}
	
	function buscaGraficoPrecisao() {
		$con = Logar();
		$consultas = array();
		$query = "select
						concat('Cliente: ',b.nome) as nome,
						count(b.nome) as quantidade
					from
						analisecpf.historico_consulta a
					inner join usuarios b
						on (a.id_cliente = b.id)
					group by b.id;";
		$resultado = mysqli_query($con,$query);
		while($consulta = mysqli_fetch_assoc($resultado)) {
			array_push($consultas, $consulta);
		}
		Deslogar($con);
		return $consultas;
	}

	