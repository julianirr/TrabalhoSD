<?php require_once("../logica-usuario.php"); verificaUsuario();?>
<?php require_once("funcoes-cliente.php"); $token = gera_Token(32); ?>
<?php
	require_once ("banco-cliente.php");
	$id = $_GET['id'];
	
	$cliente = buscaUsuario($id);
?>

<?php require_once("../cabecalho.php"); ?>
	<div class="container">
		<div class="row no-margin">
			<div class="col-md-6">
				<h3 class="titulo">Editar Cliente</h3>
			</div>
		</div>
		
		<small>Campos marcados com asterisco (*) são obrigatórios.</small>
		<form name="infos" class="form-principal" action="updatecadastrarcliente.php" method="post" enctype="multipart/form-data">
			<div class="form-group infos">
				<h4><b>Dados Cliente</b></h4>
				<br>
				<div class="row no-margin">
					<div class="col-md-6">
						<label for="nome">Nome *</label>
						<input type="text" id="nome" name="nome" class="form-control nome" value="<?php echo $cliente["nome"];?>" >
						<input type="text" id="id" name="id" class="form-control id" style="display:none;" value="<?php echo $cliente["id"];?>" >
					</div>
					<div class="col-md-6">
						<label for="email">Email *</label>
						<input type="text" id="email" name="email" class="form-control email" value="<?php echo $cliente["email"];?>" >
					</div>
				</div>
				<div class="row no-margin">
					<div class="col-md-5">
						<label for="senha">Senha *</label>
						<input type="password" id="senha" name="senha" class="form-control senha" >	
					</div>
					<div class="col-md-5">
						<label for="token">Token de Acesso  * </label>
						<input type="text" id="token" name="token" class="form-control token" readonly="true" value=<?php echo $token;?> >	
					</div>
					<div class="col-md-2">
						<label for="ativo">Ativo *</label>
							<select class="form-control" id="ativo" name="ativo">
								<option value="S"<?php if($cliente["ativo"] == 'S' ): ?> selected="selected" <?php endif;?>>Sim</option>
								<option value="N"<?php if($cliente["ativo"] == 'N' ): ?> selected="selected" <?php endif;?>>Não</option>
							</select>
					</div>
				</div>
				<input type="submit" class="btn btn-md btn-primary" id="enviaForm" value="ENVIAR" />
			</div>
		</form>
	</div>
<?php require_once("../rodape.php"); ?>
