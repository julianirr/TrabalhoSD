<script language='JavaScript'>

function validarCPF( cpf )
{
	cpf2 = cpf.replace(/[^\d]+/g,'');
	
	if(cpf2.length != 11 || cpf2 == "00000000000" || cpf2 == "11111111111" ||
		cpf2 == "22222222222" || cpf2 == "33333333333" || cpf2 == "44444444444" ||
		cpf2 == "55555555555" || cpf2 == "66666666666" || cpf2 == "77777777777" ||
		cpf2 == "88888888888" || cpf2 == "99999999999")
	{
		window.alert("CPF inválido. Tente novamente.");
		document.getElementById("cpf").focus();
		return false;
	}
	soma = 0;
	for(i = 0; i < 9; i++)
	{
		soma += parseInt(cpf2.charAt(i)) * (10 - i);
	}
	resto = 11 - (soma % 11);
	if(resto == 10 || resto == 11)
	{
		resto = 0;
	}
	if(resto != parseInt(cpf2.charAt(9)))
	{
		window.alert("CPF inválido. Tente novamente.");
		document.getElementById("cpf").focus();
		return false;
	}
	soma = 0;
	for(i = 0; i < 10; i ++)
	{
		soma += parseInt(cpf2.charAt(i)) * (11 - i);
	}
	resto = 11 - (soma % 11);
	if(resto == 10 || resto == 11)
	{
		resto = 0;
	}
	if(resto != parseInt(cpf2.charAt(10)))
	{
		window.alert("CPF inválido. Tente novamente.");
		document.getElementById("cpf").focus();
		return false;
	}
	return true;
}

function validarTOKEN( token )
{
	if(token.length == 0 )
	{
		window.alert("TOKEN inválido. Tente novamente.");
		document.getElementById("token").focus();
		return false;
	}
	return true;
}

function VerificaData(digData) 
{
	if(digData.length != 10)
	{
		window.alert("Data inválida. Tente novamente.");
		document.getElementById("nascimento").focus();
		return false;
	}
	var bissexto = 0;
	var data = digData; 
	var tam = data.length;
	if (tam == 10) 
	{
		var valido = 1;
		var dia = data.substr(0,2)
		var mes = data.substr(3,2)
		var ano = data.substr(6,4)
		if ((ano > 1900)||(ano < 2100))
		{
			switch (mes) 
			{
				case '01':
					if  (dia <= 31) 
					{
						valido = 0;
					}
				case '02':
					/* Validando ano Bissexto / fevereiro / dia */ 
					if ((ano % 4 == 0) || (ano % 100 == 0) || (ano % 400 == 0)) 
					{ 
						bissexto = 1; 
					}
					if ((bissexto == 1) && (dia <= 29)) 
					{ 
						break;				 
					} else
						if ((bissexto != 1) && (dia <= 28)) 
						{ 
							valido = 0;
						} else
							{
								valido = 1;
							}					
				case '03':
					if  (dia <= 31) 
					{
						valido = 0;
					}				
				case '04':		
					if  (dia <= 30) 
					{
						valido = 0;
					}
				case '05':
					if  (dia <= 31) 
					{
						valido = 0;
					}	
				case '06':
					if  (dia <= 30) 
					{
						valido = 0;
					}					
				case '07':
					if  (dia <= 31) 
					{
						valido = 0;
					}				
				case '08':
					if  (dia <= 31) 
					{
						valido = 0;
					}
				case '09':
					if  (dia <= 30) 
					{
						valido = 0;
					}					
				case '10':
					if  (dia <= 31) 
					{
						valido = 0;
					}	
				case '11':
					if  (dia <= 30) 
					{
						valido = 0;
					}					
				case '12':
					if  (dia <= 31) 
					{
						valido = 0;
					}
			}
		}
	}	
	if (valido == 1)
	{
		window.alert("Data inválida. Tente novamente.");
		document.getElementById("nascimento").focus();
	}
}
</script>
<?php require_once("../logica-usuario.php"); verificaUsuario();?>
<?php require_once("../cabecalho.php"); ?>
	<div class="container">
		<div class="row no-margin">
			<div class="col-md-6">
				<h3 class="titulo">Estudo analítico de CPF</h3>
			</div>
		</div>
		<small>Campos marcados com asterisco (*) são obrigatórios.</small>
		<form name="infos" class="form-principal" action="processaForm.php" method="post" enctype="multipart/form-data">
			<div class="form-group infos">
				<h4>Dados de Filtro</h4>
				<hr>
				<div class="row no-margin">
					<div class="col-md-3">
						<label for="cpf">Token *</label>
						<input type="text" id="token" name="token" class="form-control token" maxlength="64" onblur="javascript: if (this.value.length > 0){ validarTOKEN(this.value);}">
					</div>
					<div class="col-md-2">
						<label for="cpf">CPF *</label>
						<input type="text" id="cpf" name="cpf" class="form-control cpf" maxlength="14" onblur="javascript: if (this.value.length > 0){ validarCPF(this.value);}">
					</div>
					<div class="col-md-2">
						<label for="nascimento">Data de Nascimento *</label>
						<input type="text" id="nascimento" name="nascimento" class="form-control data" onBlur="javascript: if (this.value.length > 0){ VerificaData(this.value);}">
					</div>
					<div class="col-md-3">
						<label for="tamanho">Quantidade de Dígitos de Precisão *</label>
							<select class="form-control" id="tamanho" name="tamanho">
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3" selected="selected">3</option>
							</select>
					</div>
					<div class="col-md-2">
						<label for="retorno">Método de retorno *</label>
							<select class="form-control" id="retorno" name="retorno">
								<option value="1" selected="selected">HTML</option>
								<option value="2">XML</option>
								<option value="3">JSON</option>
							</select>
					</div>
				</div>
				<input type="submit" class="btn btn-md btn-primary" id="enviaForm" value="ENVIAR" />
			</div>
				
			
		</form>
	</div>
<?php require_once("../rodape.php"); ?>

