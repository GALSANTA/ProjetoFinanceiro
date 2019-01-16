<?php 
session_start();
require 'dbconnect.php';
require '../src/controler/Configuracao.class.php';


//Global
$dado=$_SESSION['dado'];
$email= $dado[0][3];
$nome= $dado[0][1];
$sobrenome= $dado[0][2];
$user_id= $dado[0][0];

$configuracao = new Configuracao();




//imagem de perfil
$user_img = $_SESSION['imgperfil'];

//imagem de background
$user_imgbackground=$_SESSION['imgbackground'];



//UPLOAD FOTO PERFIL

if(isset($_FILES['arquivo']) && empty($_FILES['arquivo'])==false){
     
	$configuracao->uploadFotoPerfil($_FILES['arquivo']['tmp_name'],$_FILES['arquivo']['name'],$user_id);
}

//UPLOAD BACKGROUND PERFIL

if(isset($_FILES['arquivo2']) && empty($_FILES['arquivo2'])==false){	

	$configuracao->uploadFotoBackground($_FILES['arquivo2']['tmp_name'],$_FILES['arquivo2']['name'],$user_id);	

}

//UPLOAD DA SENHA

if(isset($_POST['antigasenha']) && empty($_POST['antigasenha'])==false){

	$configuracao->mudarSenha($_POST['antigasenha'],$_POST['novasenha'],$user_id);	
	
}



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

			<ul class="collapsible" data-collapsible="accordion">
				<li>
					<div class="collapsible-header"><i class="material-icons">account_box</i>Conta</div>
					<div class="collapsible-body"><span>
						<ul class="collapsible" data-collapsible="accordion">
							<li>
								<div class="collapsible-header"><i class="material-icons">filter_drama</i>Mudar a senha</div>
								<div class="collapsible-body">
									<span>
										<form method="POST">
											<div class="row">
												<div class="input-field col s12 m6 l3">
													<input id="password" type="password" class="validate" name="antigasenha">
													<label for="password">Senha Antiga</label>
												</div>
											</div>
											<div class="row">
												<div class="input-field col s12 m6 l3">
													<input id="password1" type="password" class="validate" name="novasenha">
													<label for="password1">Nova Senha</label>
												</div>
											</div>
											<div class="row">
												<button class="btn waves-effect waves-light" type="submit" name="action">Enviar
													<i class="material-icons right">send</i>
												</button>
											</div>

										</form>
									</span>
								</div>
							</li>
							<li>
								<div class="collapsible-header"><i class="material-icons">place</i>Second</div>
								<div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
							</li>
						</ul>
					</span></div>
				</li>
				<li>
					<div class="collapsible-header"><i class="material-icons">add_a_photo</i>Mudar Foto</div>
					<div class="collapsible-body">
						<span>
							<ul class="collapsible" data-collapsible="accordion">
								<li>
									<div class="collapsible-header"><i class="material-icons">filter_drama</i>Perfil</div>
									<div class="collapsible-body">
										<span>
											<form method="POST" enctype="multipart/form-data">
												<div class="row">


													<input  type="file" name="arquivo">

												</div>
												<div class="row">
													<button class="btn waves-effect waves-light" type="submit" name="action">Enviar
														<i class="material-icons right">send</i>
													</button>
												</div>
											</form>
										</span>
									</div>
								</li>
								<li>
									<div class="collapsible-header"><i class="material-icons">place</i>Background do Perfil</div>
									<div class="collapsible-body">
										<span>
											<form method="POST" enctype="multipart/form-data">
												<div class="row">
													<input  type="file" name="arquivo2">
												</div>
												<div class="row">
													<button class="btn waves-effect waves-light" type="submit" name="action">Enviar
														<i class="material-icons right">send</i>
													</button>
												</div>
											</form>

										</span>
									</div>
								</li>
							</ul>
						</span>
					</div>
				</li>
	</ul>
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