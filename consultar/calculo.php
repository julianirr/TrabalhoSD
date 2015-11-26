<?php
	function qtdeRegistros($qtde){
		$qtdeRegistro=0;
		foreach($qtde as $valor):
			$qtdeRegistro = $qtdeRegistro + $valor;
		endforeach;
		return $qtdeRegistro;
	}

	function SomaIdadeXQuantidade($tabela,$quantidadeValores){
		for ($i=0,$IdadeXQuantidade=0; $i<$quantidadeValores; $i++):
			$IdadeXQuantidade = $IdadeXQuantidade + ($tabela["quantidade"][$i] * $tabela["idade"][$i]);
		endfor;
		return $IdadeXQuantidade;
	}

	function calcularMediaPonderada($tabela,$quantidadeValores,$somaQuantidade){
		for ($i=0,$IdadeXQuantidade=0; $i<$quantidadeValores; $i++):
			$IdadeXQuantidade = $IdadeXQuantidade + ($tabela["quantidade"][$i] * $tabela["idade"][$i]);
		endfor;
		$media_ponderada = $IdadeXQuantidade/$somaQuantidade;
		return $media_ponderada;
	}	

	function calcularVariancia($tabela,$media_ponderada,$quantidadeValores,$somaQuantidade){
		for ($i = 0, $varianciaLinha=0, $variancia=0; $i < $quantidadeValores; $i++) :
			$variancia = $variancia +  $tabela['quantidade'][$i]*(pow(($tabela['idade'][$i] - $media_ponderada),2));
		endfor;
		$variancia = $variancia/$somaQuantidade;
		return $variancia;
	}

	function calcularDesvioPadrao($variancia){
		$desvio_padrao = round(sqrt($variancia),2);
		return $desvio_padrao;
	}
	
	function calcularDesvioMinimo($media_ponderada,$desvio_padrao,$proporcao){
		$desvio_minimo = floor($media_ponderada - $proporcao*($desvio_padrao));
		return $desvio_minimo;
	}
	
	function calcularDesvioMaximo($media_ponderada,$desvio_padrao,$proporcao){
		$desvio_maximo = floor($media_ponderada + $proporcao*($desvio_padrao));
		return $desvio_maximo;
	}
	
	
	function calcularPorcentagemAbrangencia($tabela,$quantidadeValores,$desvio_minimo,$desvio_maximo,$somaQuantidade){
		for ($i = 0, $quantidadeIntervalo=0; $i < $quantidadeValores; $i++) {
			if ((($tabela['idade'][$i]) >= $desvio_minimo) and (($tabela['idade'][$i]) <= $desvio_maximo)) {
				$quantidadeIntervalo = $quantidadeIntervalo + $tabela['quantidade'][$i];
			}
		}

		$porcentagem_abrangencia = round(($quantidadeIntervalo/$somaQuantidade)*100,2);
		return $porcentagem_abrangencia;
	}