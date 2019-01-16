<?php 

		$local="mysql:dbname=projeto_financeiro;host=localhost";
		$user="root";
		$senha="";




		try {
			$pdo = new PDO($local,$user,$senha);
			

		} catch (Exception $e) {
			echo "ERRO ".$e->getMessage();
		}


	




 ?>