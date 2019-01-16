<?php

class Configuracao{

	private $pdo;
	
	public function __construct(){
		
		$local="mysql:dbname=projeto_financeiro;host=localhost";
		$user="root";
		$senha="";

		try {
			$this->pdo = new PDO($local,$user,$senha);
			

		} catch (Exception $e) {
			echo "ERRO ".$e->getMessage();
		}

	}
	   //FOTO DE PERFIL
	
	public function uploadFotoPerfil($img,$name,$user_id){

		
		$imagem= $img;
		$nome= $name;
		$user_id = $user_id;
		$local= 'imagem_usuarios/';
		

		$sql="SELECT * FROM tb_imagem WHERE user_id = '$user_id'";

		$sql=$this->pdo->query($sql);

		if ($sql->rowCount()>0) {

			$sql="DELETE FROM tb_imagem WHERE user_id='$user_id'";

			$sql=$this->pdo->query($sql);


		}

		move_uploaded_file($imagem, $local."".$nome);

		$sql="INSERT INTO `tb_imagem`(`img_id`, `user_id`, `img_nome`, `img_local`) VALUES ('','$user_id','$nome','$local')";

		$this->pdo->query($sql);

		header("Location: user.php");

	}


	//BACKGROUND 

	public function uploadFotoBackground($img,$name,$user_id){
		
		
		$local= 'imagem_background/';




		$sql="SELECT * FROM tb_background WHERE user_id = '$user_id'";

		$sql=$this->pdo->query($sql);

		if ($sql->rowCount()>0) {

			$sql="DELETE FROM tb_background WHERE user_id='$user_id'";

			$sql=$this->pdo->query($sql);

		}

		move_uploaded_file($img, $local."".$name);

		$sql="INSERT INTO `tb_background`(`img_id`, `user_id`, `img_nome`, `img_local`) VALUES ('','$user_id','$name','$local')";

		$this->pdo->query($sql);

		header("Location: user.php");

	}



	public function mudarSenha($senhaAntiga,$senhaNova,$user_id){

		

		$sql = "SELECT * FROM tb_usuarios  WHERE user_id='$user_id' AND user_senha= '$senhaAntiga' ";

		$sql=$this->pdo->query($sql);

		if($sql->rowCount()>0){


			$sql="UPDATE `projeto_financeiro`.`tb_usuarios` SET `user_senha` = '$senhaNova' WHERE `tb_usuarios`.`user_id` = $user_id";

			$this->pdo->query($sql);

			header("Location: user.php");

		}











}






































    
	
}




?>