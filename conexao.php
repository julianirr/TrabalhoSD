<?php
class Conecta {
	function conexao() {
		$server		= "localhost";
		$banco		= "analiseCPF";
		$usuario	= "root";
		$senha		= "";

		$con = mysqli_connect($server,$usuario,$senha,$banco);

		if (!$con)
		{
			echo mysqli_error($con);
			exit;
		}
		return $con;
	}
}


