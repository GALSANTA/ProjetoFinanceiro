<?php 


class Verificacao{

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


	public function verificarImagemPerfil($user_id){



		$sql="SELECT * FROM tb_imagem WHERE user_id='$user_id'";

		$sql= $this->pdo->query($sql);


		if($sql->rowCount()>0){

			$imagem=$sql->fetchAll();

			$user_img = $imagem[0][3]."".$imagem[0][2];

		}
		else{

			$user_img="imagem_usuarios/padrao.png";

		}



		return $user_img;
	}



	public function verificarBackground($user_id){


		$sql="SELECT * FROM tb_background WHERE user_id='$user_id'";

		$sql= $this->pdo->query($sql);

		if($sql->rowCount()>0){


			$background=$sql->fetchAll();

			$filename = $background[0][3]."".$background[0][2];


			$width=330;
			$height=190;

			list($width_original, $height_original)= getimagesize($filename);

			$ratio = $width_original / $height_original;

			if($width/$height > $ratio){

				$width=$height * $ratio;

			}else{
				$height= $width / $ratio;
			}

			$image = imagecreatetruecolor($width, $height);

			$image_original= imagecreatefromjpeg($filename);

			imagecopyresampled($image, $image_original, 0,0,0,0, $width, $height,$width_original,$height_original);

			imagejpeg($image,$background[0][3]."".$background[0][2],100);


			$user_imgbackground = $background[0][3]."".$background[0][2];



		}
		else{

			$user_imgbackground="imagem_background/mar.jpg";

		}

		return $user_imgbackground;


	}
	
	
}







?>