<?php
	error_reporting(E_ALL ^ E_NOTICE);
	date_default_timezone_set('America/Sao_Paulo');
	function ValidaData($dat){
		$data = explode("/","$dat"); 
		if (count($data)<3){
			return 0;
		}else{
			$d = $data[0];
			$m = $data[1];
			$y = $data[2];
			$res = checkdate($m,$d,$y);
			return $res;
		}
	}

	function calc_idade($data_nasc) {
		$data_nasc=explode('/',$data_nasc);
		
		$data=date('d/m/Y');
		$data=explode('/',$data);
		$anos=$data[2]-$data_nasc[2];
		if($data_nasc[1] > $data[1])
			return $anos-1;
		if($data_nasc[1] == $data[1])
			if($data_nasc[0] <= $data[0]) {
				return $anos;
				break;
			}else{
				return $anos-1;
				break;
			}
		if ($data_nasc[1] < $data[1])
			return $anos;
		}

	function validaCPF($cpf) {
		if(empty($cpf)) {
			return false;
		}
		//echo $cpf; exit;
		$cpf = str_replace("-", "", str_replace(".", "", $cpf));
		$cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);

		if (strlen($cpf) != 11) {
			return false;
		}
		elseif ($cpf == '00000000000' || 
				$cpf == '11111111111' || 
				$cpf == '22222222222' || 
				$cpf == '33333333333' || 
				$cpf == '44444444444' || 
				$cpf == '55555555555' || 
				$cpf == '66666666666' || 
				$cpf == '77777777777' || 
				$cpf == '88888888888' || 
				$cpf == '99999999999') 
			{
				return false;
			} else {
				for ($t = 9; $t < 11; $t++) {
					for ($d = 0, $c = 0; $c < $t; $c++) {
						$d += $cpf{$c} * (($t + 1) - $c);
					}
					$d = ((10 * $d) % 11) % 10;
					if ($cpf{$c} != $d) {
						return false;
					}
				}
				return true;
			}
	}
