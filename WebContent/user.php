<?php 
session_start();
require 'dbconnect.php';
require '../src/controler/Verificacao.class.php';


//Global
$dado=$_SESSION['dado'];
$user_id=$dado[0][0];
$email= $dado[0][3];
$nome= $dado[0][1];
$sobrenome= $dado[0][2];


$verificacao = new Verificacao();


//VERIFICANDO IMAGEM PERFIL

$user_img = $verificacao->verificarImagemPerfil($user_id);

$_SESSION['imgperfil']=$user_img;



//VERIFICANDO BACKGROUND PERFIL

$user_imgbackground= $verificacao->verificarBackground($user_id);

$_SESSION['imgbackground']=$user_imgbackground;


?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sistema Financeiro</title>
	<link rel="icon" href="img/finanças.png">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="css/materialize.min.css">
	<link rel="stylesheet" type="text/css" href="css/estilo.css">


</head>
<body>
	<header>
		<nav>
			<div class="nav-wrapper blue-grey darken-3">
				
				<a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
				<a href="user.php" class="brand-logo center">
					<img class="imgresizable" src="img/finanças.png">
				</a>
				<ul id="nav-mobile" class="left hide-on-med-and-down">
					
				</ul>
			</div>
		</nav>
	</header>
	<main>
		<section class="row">

			<?php

			//VERIFICANDO CONTAS

			$sql="SELECT * FROM tb_contas WHERE user_id='$user_id'"; 
			$sql = $pdo->query($sql);

			if($sql->rowCount()>0){

				$contas=$sql->fetchAll();

				foreach ($contas as $conta) {
					
					?>

					
					<div class="col s12 m6 l4">
						<div class="card grey darken-2">
							<div class="card-content white-text">
								<span class="card-title"><?php echo $conta['con_nome']; ?></span>
								<p>
									Agência: <?php echo $conta['con_agencia']; ?>   <br>
									Conta Corrente: <?php echo $conta['con_corrente']; ?>   <br>
									Titular: <?php echo $conta['con_titular']; ?>   <br>
									Saldo: <?php echo $conta['con_saldo']; ?>   <br>


								</p>
							</div>
							<div class="card-action">
								<?php echo "<a href='sobre.php?id=".$conta['con_id']."'>Mostrar Mais</a>" ?>
								<?php echo "<a href='excluir.php?id=".$conta['con_id']."'>Excluir</a>" ?>
							</div>
						</div>
					</div>
				

					<?php  
				}

			}
			else{

				?>
				<div class="col s12 m6 l4">
						<div class="card grey darken-2">
							<div class="card-content white-text">
								<span class="card-title">Não existem contas</span>
							</div>
						</div>
					</div>

				<?php 

			}

			?>

		</section>
		
	</main>
	<footer class="page-footer blue-grey darken-3">
	<div class="container">
		<div class="row">
			<div class="col l6 s12">
				<h5 class="white-text">Projeto Finanças</h5>
				<p class="grey-text text-lighten-4">Aqui pode fazer a diferença</p>
			</div>
			<div class="col l4 offset-l2 s12">
				<h5 class="white-text">Links</h5>
				<ul>
					<li><a class="grey-text text-lighten-3" href="#!">Git Hub</a></li>

				</ul>
			</div>
		</div>
	</div>
	<div class="footer-copyright">
		<div class="container">
			© 2014 Copyright Fernando Gabriel M. da Silva
		</div>
	</div>
</footer>
	<ul id="slide-out" class="side-nav fixed">
		<li>
			<div class="user-view">
				<div class="background">
					<?php echo "<img  src='".$user_imgbackground."'' >" ?>
				</div><?php echo "<img class='circle' src='".$user_img."'' >" ?>
				<span class="white-text name"><?php echo $nome." ".$sobrenome; ?></span>
				<span class="white-text email"><?php echo $email ?></span>
			</div>
		</li>
		<li><a href="user.php"><i class="material-icons">monetization_on</i>Contas</a></li>
		<li><a href="configuracao.php"><i class="material-icons">build</i>Configurações</a></li>

		<li><div class="divider"></div></li>
		<li><a class="subheader">Funções</a></li>
		<li><a class="waves-effect" href="novaconta.php">Criar nova conta</a></li>
	</ul>
	

	
	

	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/materialize.min.js"></script>
	<script type="text/javascript" src="js/jquery.js"></script>
</body>
</html>