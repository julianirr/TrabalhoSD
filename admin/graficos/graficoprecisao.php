<?php
	require_once("banco-grafico.php");
	require_once("../logica-usuario.php"); verificaUsuario();

	$consulta = buscaGraficoPrecisao();
	$qtde = count($consulta);
?>

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<script type="text/javascript" src="//www.google.com/jsapi"></script>
	<script type="text/javascript">
	  google.load('visualization', '1');
	</script>
		<script type="text/javascript">
			google.load("visualization", "1", {packages:["corechart"]});
			
			google.setOnLoadCallback(drawChart2);
			function drawChart2() 
			{
				var data = google.visualization.arrayToDataTable([
					['Nome do Cliente', 'Qtde Consultas'],
					<?php for($i=0; $i< $qtde; $i++){ ?>
						['<?php echo $consulta[$i]["nome"]?>',<?php echo $consulta[$i]["quantidade"] ?>],
					<?php }?>
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
	<body style="font-family: Arial;border: 0 none;">
		<div id="chart_div"> </div>	
	</body>
</html>