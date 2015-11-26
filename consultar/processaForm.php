<?php
if (!$_REQUEST) {
	header('Location: index.php');
	die;
}
	require_once("retornoXML.php"); 
	require_once("retornoJson.php"); 
	require_once("retornoHTML.php"); 
	require_once("validacao.php"); 
	require_once("calculo.php"); 
	
	require_once("banco-consulta.php"); 

// Array de estados
$explicacao[0] = 'Rio Grande do Sul';
$explicacao[1] = 'Distrito Federal, Goiás, Mato Grosso do Sul e Tocantins';
$explicacao[2] = 'Acre, Amapá, Amazonas, Pará, Rondônia e Roraima';
$explicacao[3] = 'Ceará, Maranhão e Piauí';
$explicacao[4] = 'Alagoas, Paraíba, Pernambuco e Rio Grande do Norte';
$explicacao[5] = 'Bahia e Sergipe';
$explicacao[6] = 'Minas Gerais';
$explicacao[7] = 'Espírito Santo e Rio de Janeiro';
$explicacao[8] = 'São Paulo';
$explicacao[9] = 'Paraná e Santa Catarina';

// Array de ufs
$ufs[0] = 'RS';
$ufs[1] = 'DF,GO,MS,TO';
$ufs[2] = 'AC,AP,AM,PA,RO,RR';
$ufs[3] = 'CE,MA,PI';
$ufs[4] = 'AL,PB,PE,RN';
$ufs[5] = 'BA,SE';
$ufs[6] = 'MG';
$ufs[7] = 'ES,RJ';
$ufs[8] = 'SP';
$ufs[9] = 'PR,SC';

//Arraytipo
$tipo_consulta[1] = 'HTML';
$tipo_consulta['HTML'] = 'HTML';
$tipo_consulta[2] = 'XML';
$tipo_consulta['XML'] = 'XML';
$tipo_consulta[3] = 'JSON';
$tipo_consulta['JSON'] = 'JSON';

extract($_REQUEST);

$nascimento					= $_REQUEST["nascimento"];
$cpf_inteiro2				= $_REQUEST["cpf"];
$tam						= strtoupper($_REQUEST["tamanho"]);
$retorno					= strtoupper($_REQUEST["retorno"]);

$cpf_inteiro 				= str_replace("-", "", str_replace(".", "", $cpf_inteiro2));
$digito 					= substr($cpf_inteiro,-3,1);
$cpf						= substr($cpf_inteiro,-11,$tam);
$nascimento2 				= $nascimento;
$mensagem_erro = array();

if ((($tam == "NULL") && ($tam == "") && ($tam == NULL)) || (($tam < 1) || ($tam > 3))) 
{
	$mensagem_erro["precisao"] = "Precisao invalida";
}
if (!validaCPF($cpf_inteiro))
{
	$mensagem_erro["cpf"] = "CPF invalido";
}

if (($nascimento != "null") && ($nascimento != "NULL") && ($nascimento != "") && ($nascimento != NULL))
{
	if (!ValidaData($nascimento))
	{
		$mensagem_erro["cpf"] = "Data de nascimento invalida";
		$nascimento = "";
		$anos = "";
	}
	else
	{
		$anos = calc_idade($nascimento);
	}
}else
{
	$nascimento = "";
	$anos = "";
}

if (count($mensagem_erro) == 0)
{
	$conexao = new Conecta;
	$con = 	$conexao->conexao();

	// VERIFICA O TOKEN SE ESTÁ VALIDO
	$id_cliente = 0;
	$cliente  = verificaToken($token);
	if ($cliente) {
		$id_cliente = $cliente["id"];
		$nome_cliente = $cliente["nome"]; 
		$mensagem_ws = "Sucesso";
	}

	if ($mensagem_ws == "Sucesso") 
	{
		$response['entrada']['cpf'] 			= $cpf_inteiro;
		$response['entrada']['precisao']		= $tam;
		$response['entrada']['id_cliente'] 		= $id_cliente;
		$response['entrada']['nome_cliente']	= $nome_cliente;
		$response['entrada']['token'] 			= $token;
		$response['entrada']['cpf_cortado'] 	= $cpf;
		$response['entrada']['nascimento'] 		= $nascimento;
		$response['entrada']['idade'] 			= $anos;
		$response['entrada']['estado_emissor'] 	= $digito." - ".$explicacao[$digito];

		$listaUfs = explode(',',$ufs[$digito]);
		$countListaUfs = count($listaUfs);
		for ($x=0; $x<$countListaUfs; $x++) {
			$response['entrada']['emissor']['uf-'.$x] = $listaUfs[$x];
		}

		$dados = listaDados($tam,$digito,$cpf);

		//echo"<br><br><br><br><br><br>";
		$i = 0;
		foreach($dados as $Arr):
			$tabela["idade"][]		= $Arr["idade"];
			$tabela["quantidade"][]	= $Arr["quantidade"];

			$response['histograma']['idade'.$i]['valor'] = $Arr["idade"];
			$response['histograma']['idade'.$i]['quantidade'] = $Arr["quantidade"];

			++$i;
		endforeach;

		$quantidadeValores = count($tabela['quantidade']); // retorna a quantidade de registros na tabela

		$variancia = 0;
		$quantidadeIntervalo = 0;
		
		$somaQuantidade = qtdeRegistros($tabela['quantidade']);
		$media_ponderada = calcularMediaPonderada($tabela,$quantidadeValores,$somaQuantidade);
		$variancia = calcularVariancia($tabela,$media_ponderada,$quantidadeValores,$somaQuantidade);
		$desvio_padrao = calcularDesvioPadrao($variancia);
		$desvio_minimo = calcularDesvioMinimo($media_ponderada,$desvio_padrao,0.66);
		$desvio_maximo = calcularDesvioMaximo($media_ponderada,$desvio_padrao,0.66);
		
		$porcentagem_abrangencia = calcularPorcentagemAbrangencia($tabela,$quantidadeValores,$desvio_minimo,$desvio_maximo,$somaQuantidade);
		if ($anos == 0)
		{
			$mens  = "";
		} 
		else {
			if ($anos >= $desvio_minimo and $anos <= $desvio_maximo) {
				$mensagem = 0;
				$color = "#32CD32";
				$mens  = "CPF dentro do padrao";
			}
			else {
				if ($anos >= 0.5*($desvio_minimo) and $anos <= 1.5*($desvio_maximo)) {
					$mensagem = 1;
					$color = "#FFD700";
					$mens  = "Alerta: CPF com 50% fora do padrao";
				}
				else {
					$mensagem = 2;
					$color = "#FF0000";
					$mens  = "CPF fora do padrao";
				}
			}
		}

		for ($i = 0,$qt_ant = 0; $i < $quantidadeValores; $i++) {
			if ($tabela['quantidade'][$i] > $qt_ant) {
				$media_ponderada =  $tabela['idade'][$i]; 
				$qt_ant = $tabela['quantidade'][$i];
			}
		}
		$response["saida"]["maior_concentracao"] 		= $media_ponderada;
		$response["saida"]["quantidade"]		 		= $qt_ant;
		$response["saida"]["variancia"] 				= round($variancia,2);
		$response["saida"]["desvio_padrao"]				= $desvio_padrao;
		$response["saida"]["desvio_minimo"]				= $desvio_minimo;
		$response["saida"]["desvio_maximo"] 			= $desvio_maximo;
		$response["saida"]["porcentagem_abrangencia"] 	= $porcentagem_abrangencia;
		$response["saida"]["analise_sugerida"] 			= $mens;

		if(strtoupper($retorno) == 'HTML'){
			$retorno = 1;
		}else
		if(strtoupper($retorno) == 'XML'){
			$retorno = 2;
		}else
		if(strtoupper($retorno) == 'JSON'){
			$retorno = 3;
		}

		// logs
		if (isset($_REQUEST["flag"]) && $_REQUEST["flag"] == 'false')
		{}else{
			$log = salvaLog($response['entrada'],$response['histograma'],$response['saida'], $retorno);
		}

		switch ($retorno) {
			case 1:
				criaHTML($response,$color);
				break;
			case 2:
				criaXML($response);
				die;
				break;
			case 3:
				criarJson($response["entrada"]);
				die;
				break;
			default:
				echo "Tipo de retorno invalido";
				break;
		}
		
	}else {
		echo $mensagem_ws;
	}
}else{
	foreach ($mensagem_erro as $value) {
		echo $value ."<br>";
	}
}