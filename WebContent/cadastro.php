<?php
require 'dbconnect.php';
session_start();


if (isset($_POST['email']) && empty( $_POST['email'])==false) {
	$email= $_POST['email'];
	$senha= $_POST['senha'];
	$nome=$_POST['nome'];
	$sobrenome=$_POST['sobrenome'];

	$sql= "INSERT INTO `tb_usuarios`(`user_id`, `user_nome`, `user_sobrenome`, `user_email`, `user_senha`) VALUES ('','$nome','sobrenome','$email','$senha')";

	 $pdo->query($sql);



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
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<header>
		<nav>
			<div class="nav-wrapper grey darken-2">
				<a href="index.php" class="brand-logo"><img class="imgresizable" src="img/finanças.png"></a>
				<ul id="nav-mobile" class="right hide-on-med-and-down">
					<li><a href="sass.html">HOME</a></li>
					<li><a href="sass.html">PLANO</a></li>
					<li><a href="sass.html">EMPRESARIAL</a></li>
					<li><a href="login.php">LOG IN</a></li>
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
				<div class="row">
					<div class="input-field col s12 m6 l3">
						<input id="nome" type="text" class="validate" name="nome">
						<label for="nome">Nome</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12 m6 l3">
						<input id="sobrenome" type="text" class="validate" name="sobrenome">
						<label for="sobrenome">Sobrenome</label>
					</div>
				</div>
				<button class="btn waves-effect waves-light  grey darken-2" type="submit" name="action">Cadastrar
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