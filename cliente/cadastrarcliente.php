<?php require_once("../logica-usuario.php"); verificaUsuario();?>
<?php require_once("../cabecalho.php"); ?>
<?php require_once("funcoes-cliente.php"); $token = gera_Token(32); ?>

<div class="container">
	<div class="row no-margin">
		<div class="col-md-6">
			<h3 class="titulo">Cadastrar Cliente</h3>
		</div>
	</div>
	
	<small>Campos marcados com asterisco (*) são obrigatórios.</small>
	<form name="infos" class="form-principal" action="processacadastrarcliente.php" method="post" enctype="multipart/form-data">
		<div class="form-group infos">
			<h4><b>Dados do Cliente</b></h4>
			<br>
			<div class="row no-margin">
				<div class="col-md-6">
					<label for="nome" >Nome *</label>
					<input type="text" id="nome" name="nome" class="form-control nome" >
				</div>
				<div class="col-md-6">
					<label for="email">Email *</label>
					<input type="text" id="email" name="email" class="form-control email" >
				</div>
			</div>
			<div class="row no-margin">
				<div class="col-md-6">
					<label for="senha">Senha *</label>
					<input type="password" id="senha" name="senha" class="form-control senha" >
				</div>
				<div class="col-md-6">
					<label for="token">Token de Acesso *</label>
					<input type="text" id="token" name="token" class="form-control token" readonly="true" value=<?php echo $token;?> >
				</div>
			</div>
			<input type="submit" class="btn btn-md btn-primary" id="enviaForm" value="ENVIAR" />
		</div>
	</form>
</div>
