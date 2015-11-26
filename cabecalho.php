<?php 
	error_reporting(E_ALL ^ E_NOTICE);
	require_once("mostra-alerta.php"); 
?>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>Análise CPF</title>
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<link rel="stylesheet" href="../font-awesome/css/font-awesome.css">
		<link rel="stylesheet" href="../css/style.css">
		<link rel="stylesheet" href="../css/analisecpf.css">
	</head>
	<body>
		<div id class="navbar navbar-default navbar-fixed-top" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<a class="navbar-brand" href="../admin">Análise CPF</a>
				</div>
				<div class="row no-margin">
					<ul class="nav navbar-nav">
						<li><a href="../cliente/cadastrarcliente.php">Cadastrar Cliente</a></li>
						<li><a href="../cliente/processacadastrarcliente.php">Listar Cliente</a></li>
						<li><a href="../consultar/index.php">Consultar</a></li>
					</ul>
				
					<ul class="nav navbar-nav navbar-right">
						<li><a href=""><?php echo $_SESSION["usuario_logado_nome"]?></a></li>
						<li><a href="../login/logout.php">Deslogar</a></li>
					</ul>
				</div>
			</div>
		</div>
		<br><br>
		<?php mostraAlerta("success"); ?>
		<?php mostraAlerta("danger"); ?>