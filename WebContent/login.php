<?php
require 'dbconnect.php';
session_start();


if (isset($_POST['email']) && empty( $_POST['email'])==false) {
$email= $_POST['email'];
$senha= $_POST['senha'];

	$sql= "SELECT * FROM tb_usuarios WHERE user_email='$email' AND user_senha='$senha'";

	$sql = $pdo->query($sql);

	if ($sql->rowCount()>0) {
	

		$dado=$sql->fetchAll();
		$_SESSION['dado']=$dado;
		header("Location: user.php");

	}
	else{
		echo "SEM NADA";
	}

}







 ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sistema Financeiro</title>
	<link rel="icon" href="assets/img/controleicon.png">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="css/materialize.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">


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
		<div class="row">
			<form class="col s12" method="POST">

				<div class="row" >
					<div class="input-field col s12 m6 l3">
						<input id="email" type="email" class="validate" name="email">
						<label for="email">Email</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12 m6 l3">
						<input id="password" type="password" class="validate" name="senha">
						<label for="password">Password</label>
					</div>
				</div>
				<button class="btn waves-effect waves-light  grey darken-2" type="submit" name="action">Logar
					<i class="material-icons right">send</i>
				</button>

			</form>
		</div>
		


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




	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/materialize.min.js"></script>
	<script type="text/javascript" src="js/jquery.js"></script>
</body>
</html>