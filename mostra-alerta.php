<?php 
	session_start();error_reporting(E_ALL ^ E_NOTICE);
	function mostraAlerta($tipo){
		if(isset($_SESSION[$tipo])){
?>
	<center><p class="alert-<?php echo $tipo ?>"><?php echo $_SESSION[$tipo]?></p></center>
<?php
		unset($_SESSION[$tipo]);
	}
} 


