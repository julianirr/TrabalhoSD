<?php error_reporting(E_ALL ^ E_NOTICE);?>
<?php require_once("logica-usuario.php");?>
<?php require_once("mostra-alerta.php");?>
<?php if(usuarioEstaLogado()) {?>
	<p class="text-success">Você está logado como <?=usuarioLogado()?> ! </p>
	<?php header("Location:admin/inicial.php");?>
	<?php die();?>
<?php }?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Acesso ao Sistema</title>
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/signin.css">
		<link rel="stylesheet" href="css/analisecpf.css">
		<script src="assets/js/ie-emulation-modes-warning.js"></script>
	</head>
	<body>
		<div class="container">
			<form class="form-signin"  method="post" action="login/login.php" >
				<center><?php mostraAlerta("success"); ?></center>
				<center><?php mostraAlerta("danger"); ?></center>
				<center><h2 class="form-signin-heading">Por favor, efetue o login</h2></center>
				<input type="email" id="email" name="email" class="form-control" placeholder="Email" required autofocus>
				<input type="password" id="senha" name="senha" class="form-control" placeholder="Senha" required>
				<input type="submit" class="btn btn-lg btn-primary btn-block" id="enviaForm" value="Entrar">
			</form>
		</div>
	</body>
</html>
