<?php
	require_once("../cabecalho.php"); 
	require_once("../logica-usuario.php"); verificaUsuario();
	require_once("../mostra-alerta.php");
	
?>
		<div class="container">
			<div class="row no-margin">
				<div class="col-md-6">
					<h3 class="titulo">Tela Inicial</h3>
				</div>
			</div>
			
			<form name="infos" class="form-principal" enctype="multipart/form-data">
				<div class="form-group infos">
					<div class="row no-margin">
						<div class="col-md-12" >
							<label for="uf">
								<legend><b>Gráfico de Tipo de Retorno:</b></legend>
							</label>
<?php require_once("graficos/graficotipo.php"); ?>
						</div>
					</div>
				</div>
				
				<div class="form-group infos">
					<div class="row no-margin">
						<div class="col-md-12" >
							<label for="uf">
								<legend><b>Gráfico de Consultas por Cliente:</b></legend>
							</label>
<?php require_once("graficos/graficoprecisao.php"); ?>
						</div>
					</div>
				</div>
			</form>
		</div>
<?php require_once "../rodape.php"; ?>
