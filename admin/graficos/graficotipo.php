<?php
	require_once("banco-grafico.php");
	require_once("../logica-usuario.php"); verificaUsuario();
	$consulta = buscaGraficoTipo();
	$qtde = count($consulta);
?>

<html>
  <head>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
		google.load("visualization", "1", {packages:["corechart"]});
		google.setOnLoadCallback(graficotipo);
		function graficotipo() 
		{
			var data = google.visualization.arrayToDataTable([
				['Tipo de Retorno', 'Qtde Consultas'],
				<?php for($i=0; $i< $qtde; $i++){ ?>
					['<?php echo $consulta[$i]["tipo_consulta"];?>',<?php echo $consulta[$i]["quantidade"]; ?>],
				<?php }?>
			]);

			var options = 
			{
				title: '',
				backgroundColor: 'none',
				is3D: true
			};

			var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
			chart.draw(data, options);
		}
    </script>
  </head>
  <body>
    <div id="piechart_3d"></div>
  </body>
</html>