<?php
	session_start();
	error_reporting(E_ALL ^ E_NOTICE);
	function criaHTML($response,$color){
		$qtde = count($response["histograma"]);
		$estado = explode("-", $response['entrada']['estado_emissor']);
?>
	<!DOCTYPE HTML>
	<html lang="pt-br">
		<head>
			<title>CPF e grupos de idades - Boa Vista Serviços</title>
			<meta name="viewport" content="width=device-width">
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<link rel="stylesheet" href="../css/bootstrap.min.css">
			<link rel="stylesheet" href="../font-awesome/css/font-awesome.css">
			<link rel="stylesheet" href="../css/style.css">
			<script type="text/javascript" src="https://www.google.com/jsapi"></script>
			<script type="text/javascript">
			google.load("visualization", "1", {packages:["corechart"]});
			google.setOnLoadCallback(drawChart);
			function drawChart() 
			{
				var data = google.visualization.arrayToDataTable([
					['Idade', 'Quantidade'],
					<?php 
						$qtde = count($response["histograma"]);
						for($i=0; $i<$qtde; $i++){ 
					if ($i == ($$qtde - 1)) {?>
					['<?php echo  $response["histograma"]["idade".$i]["valor"];?>',<?php echo  $response["histograma"]["idade".$i]["quantidade"]; ?>]
					<?php }else {?>
					['<?php echo  $response["histograma"]["idade".$i]["valor"];?>',<?php echo  $response["histograma"]["idade".$i]["quantidade"]; ?>],
					<?php }}?>
				]);
				var options = {
					title: '',
					backgroundColor: 'none'
				};
				var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
				chart.draw(data, options);
			}
			</script>
		</head>	
		<body>
			<?php include "../cabecalho.php"; ?>
			<div class="container">
				<div class="row no-margin">
					<div class="col-md-6">
						<h3 class="titulo">Estudo analítico de CPF - Resultados</h3>
					</div>
				</div>
				
				<form name="infos" class="form-principal" enctype="multipart/form-data">
					<div class="form-group infos">
						<legend><b>Dados de Entrada</b></legend>
						<div class="row no-margin">
							<div class="col-md-6">
								<label for="uf" title = 'Nome do cliente que fez a consulta'>Cliente: </label>
							</div>
							<div class="col-md-6">
								<b><?php echo $response["entrada"]["nome_cliente"]?></b>
							</div>
						</div>
						<div class="row no-margin">
							<div class="col-md-6">
								<label for="uf" title = 'Chave unica usada para cada cliente'>Token usado: </label>
							</div>
							<div class="col-md-6">
								<b><?php echo $response["entrada"]["token"]?></b>
							</div>
						</div>
						<div class="row no-margin">
							<div class="col-md-6">
								<label for="cpf" title="É o número do documento de CPF informado">CPF: </label>
							</div>
							<div class="col-md-6">
								<b><?php echo $response["entrada"]["cpf"]?></b>
							</div>
						</div>
						<div class="row no-margin">
							<div class="col-md-6">
								<label for="uf" title="É o nono digito do CPF que identifica o estado emissor do CPF">
									Digito do estado emissor  
								</label>
							</div>
							<div class="col-md-6">
								<b> <?php echo $response['entrada']['estado_emissor'] ?> </b>
							</div>
						</div>
						<div class="row no-margin">
							<div class="col-md-6">
								<label for="cpfanalise" title = 'É uma parte do CPF na qual deseja agrupar para analizar'>Número do CPF para análise: </label>
							</div>
							<div class="col-md-6">
								<b><?php echo $response["entrada"]["cpf_cortado"]?></b>
							</div>
						</div>
						<div class="row no-margin">
							<div class="col-md-6">
								<label for="digitos" title = 'Quantidade de digitos para a precisão da análise'>Quantidade de digitos para a análise:</label>
							</div>
							<div class="col-md-6">
								<b><?php echo $response["entrada"]["precisao"]?></b>
							</div>
						</div>

						<div class="row no-margin">
							<div class="col-md-6">
								<label for="uf" title="É a data de nascimento informada pelo usuário">Data de nascimento: </label>
							</div>
							<div class="col-md-6">
								<b><?php echo $response["entrada"]["nascimento"]?></b>
							</div>
						</div>
						<div class="row no-margin">
							<div class="col-md-6">
								<label for="uf" title = 'Idade informada pelo usuário'>Idade informada: </label>
							</div>
							<div class="col-md-6">
								<b><?php echo $response["entrada"]["idade"]?> anos</b>
							</div>
						</div>
					</div>
					<div class="form-group infos">
						<b><legend>Dados de Saída</legend></b>
						<div class="row no-margin">
							<div class="col-md-6" title = 'É a idade que possui maior concentração de CPF'>
								<label for="uf">Idade com maior concentração no resultado: </label>
							</div>
							<div class="col-md-6">
								<b><?php echo $response["saida"]["maior_concentracao"]?> anos</b>
							</div>
						</div>
						<div class="row no-margin">
							<div class="col-md-6" title = 'Intervalo de idade com a maior concentração de CPFs '>
								<label for="uf">Intervalo de Busca:</label>	
							</div>
							<div class="col-md-6">
								<b><?php echo $response["saida"]["desvio_minimo"] ?> à <?php echo $response["saida"]["desvio_maximo"]?> anos</b>
							</div>
						</div>
						<div class="row no-margin">
							<div class="col-md-6" title = 'É desvio de segurança entre os CPFs'>
								<label for="uf">Desvio Padrão:</label>
							</div>
							<div class="col-md-6">
								<b><?php echo $response["saida"]["desvio_padrao"] ?> anos</b>
							</div>
						</div>
						<div class="row no-margin">	
							<div class="col-md-6" title = 'Porcentagem de CPFs presentes no intervalo de Busca'>
								<label for="uf">Porcentagem de Abrangência: </label>
							</div>
							<div class="col-md-6">	
								<b><?php echo $response["saida"]["porcentagem_abrangencia"]?> %</b>
							</div>
						</div>
						<div class="row no-margin">	
							<div class="col-md-6" title = 'Análise realizada através dos dados de nossa base'>
								<label for="uf">Análise sugerida: </label>
							</div>
							<div class="col-md-6">
								<b><font color="<?php echo $color ?>"><?php echo $response["saida"]["analise_sugerida"] ?></font></b>
							</div>
						</div>
					</div>
					<div class="form-group infos">
						<div class="row no-margin">
							<div class="col-md-12" >
								<label for="uf">
									<legend><b>Conclusão:</b></legend>
								</label>
								<p>
									De acordo com a análise das informações contidas em nossa base de dados, o documento informado <b><?php echo $response["entrada"]["cpf"] ?></b> foi emitido no estado de <b><?php echo $estado[1]?></b>. 
								</p>
								<p>
									O perfil de pessoas que se concentram nesta mesma faixa e nesse mesmo estado, possuem idade média de <b><?php echo $response["saida"]["maior_concentracao"]?></b> anos, e no intervalo de <b><?php echo  $response["saida"]["desvio_minimo"] ?></b> à <b><?php echo  $response["saida"]["desvio_maximo"] .' anos'?></b>	 (que possui a maior concentração de pessoas) tem uma porcentagem de abrangência de <b><?php echo  $response["saida"]["porcentagem_abrangencia"] ." %"?></b> dos documentos registrados em nossa base.
								</p>
							</div>
						</div>
					</div>
					<div class="form-group infos">
						<div class="row no-margin">
							<div class="col-md-12">
								<label for="uf">
									<legend><b>Histograma:</b></legend>
								</label>
							</div>
							<div class="col-md-12" >
								<div id="chart_div"> </div>
							</div>
						</div>
					</div>
				</form>
			</div>
	<?php include "../rodape.php"; ?>
<?php }?>
