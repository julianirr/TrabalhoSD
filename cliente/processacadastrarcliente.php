<?php require_once("../logica-usuario.php"); verificaUsuario();?>
<?php
	require_once("banco-cliente.php");
	if($_POST) 
	{
		extract($_POST);
		$nome		= $_POST["nome"];
		$email 		= $_POST["email"];
		$senha		= $_POST["senha"];
		$token		= $_POST["token"];
		$sql = cadastraUsuario($nome, $email, $senha, $token);
	}
?>
<?php require_once( "../cabecalho.php"); ?>
	<div class="container">
		<br>
		<form name="infos" class="form-principal" enctype="multipart/form-data">
			<div class="form-group infos">
				<legend><b>Lista de Clientes</b></legend>
				<br>
				<table class="table ls-table">
					<thead>
						<tr>
							<th class="ls-nowrap col-xs-0.25">ID</th>
							<th class="hidden-xs">Nome</td>
							<th class="hidden-xs">Email</th>
							<th class="hidden-xs">Senha</th>
							<th class="hidden-xs">Token de Acesso</th>							
							<th class="ls-nowrap col-xs-0.50">Ativo</th>
							<th class="hidden-xs">Data de Cadastro</th>
							<th class="ls-nowrap col-xs-1">Editar</th>
						</tr>
					</thead>

					<tbody>
<?php
	$clientes = listaUsuario();
	foreach($clientes as $cliente):
?>
						<tr>
							<td><?php echo $cliente['id']; ?></td>
							<td><?php echo $cliente['nome']; ?></td>
							<td><?php echo $cliente['email']; ?></td>
							<td><?php echo $cliente['senha']; ?></td>
							<td><?php echo $cliente['token']; ?></td>
							<td><?php if  ($cliente['ativo'] == 'S')
											echo "Sim";
										else
											echo "Não";?></td>
							<td><?php echo $cliente['data_cadastro']; ?></td>
							<td>
								<a href="editarcadastrocliente.php?id=<?php echo $cliente['id']; ?>" > <font color="#01DF01">
									Editar  
								</font></a>
							</td>
						</tr>
<?php endforeach;?>
					</tbody>
				</table>
			</div>
		</form>
	</div>
<?php require_once("../rodape.php"); ?>
