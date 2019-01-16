<?php 
session_start();
require 'dbconnect.php';

//Global
$dado=$_SESSION['dado'];
$email= $dado[0][3];
$nome= $dado[0][1];
$sobrenome= $dado[0][2];
$user_id= $dado[0][0];




//imagem de perfil
$user_img = $_SESSION['imgperfil'];

//imagem de background
$user_imgbackground=$_SESSION['imgbackground'];


$dataAtual = date('Y-m-d');


if(isset($_GET['id'])){

	$con_id= $_GET['id'];


	$sql="SELECT con_saldo FROM tb_contas WHERE user_id='$user_id' AND con_id=$con_id";
	$sql= $pdo->query($sql);
	$con_saldo=$sql->fetchAll();
	$con_saldo=$con_saldo[0][0];

}

if(isset($_POST['desc']) && empty($_POST['desc'])==false){

	$tran_tipo=$_POST['tipo'];
	$tran_desc=$_POST['desc'];
	$tran_data=$_POST['data'];
	$tran_valor=$_POST['valor'];

	if($tran_tipo==1){


		$pdo->query("UPDATE tb_contas SET con_saldo = con_saldo + '$tran_valor' WHERE con_id='$con_id'");

	}
	else{

		$pdo->query("UPDATE tb_contas SET con_saldo= con_saldo - '$tran_valor' WHERE con_id='$con_id'");

	}

	$sql="INSERT INTO `tb_transacoes`(`tran_id`, `con_id`, `tran_tipo`, `tran_valor`, `tran_data`, `tran_desc`, `user_id`) VALUES ('','$con_id','$tran_tipo','$tran_valor','$tran_data','$tran_desc','$user_id')";

	$pdo->query($sql);

	header("Location: sobre.php?id=".$con_id);



}

if (isset($_POST['datatransicao']) && empty($_POST['datatransicao'])==false) {

	$tran_data = $_POST['datatransicao'];

	$dataAtual = $tran_data;

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
		<section>
			<div class="row">
				<div class="row">
					<form method="POST">
						<div class="row">
							<div class=" input-field col s12 m6 l6">
								<input type="date" name="datatransicao" id="data" class="datepicker" onChange="this.form.submit()">
								<label for="data">Data</label>
							</div>	
						</div>
					</form>
				</div>
				<div class="col s12 m6 l6">
					<div class="row">
						<div class="card green darken-3">
							<div class="card-content white-text">
								<span class="card-title">RECEITAS</span>
								<p>
									<table class="bordered">
										<thead>
											<tr>
												<th>Remetente</th>
												<th>Data</th>
												<th>Valor</th>
											</tr>
										</thead>
										<tbody>

											<?php 



											$sql ="SELECT * FROM tb_transacoes WHERE tran_tipo=1 AND tran_data='$dataAtual' AND con_id='$con_id' AND user_id='$user_id' ";

											$sql= $pdo->query($sql);

											if($sql->rowCount()>0){

												foreach ($sql->fetchAll() as $receita) {
													?>


													<tr>
														<td><?php echo $receita['tran_desc'] ?></td>

														<td><?php echo $receita['tran_data'] ?></td>

														<td><?php echo "R$ ".$receita['tran_valor'] ?></td>
													</tr>

													<?php  

												}

											}
											else{
												?>
												<tr>
													<td>Sem Transações</td>

													
												</tr>

												<?php  	


											}

											?>


										</tbody>
									</table>
								</p>
							</div>

						</div>
					</div>
					<div class="row">
						<div class="card red darken-3">
							<div class="card-content white-text">
								<span class="card-title">DESPESAS</span>
								<p>
									<table class="bordered">
										<thead>
											<tr>
												<th>Remetente</th>
												<th>Data</th>
												<th>Valor</th>
											</tr>
										</thead>
										<tbody>

											<?php 



											$sql ="SELECT * FROM tb_transacoes WHERE tran_tipo=0 AND tran_data ='$dataAtual' AND con_id='$con_id' AND user_id='$user_id'";

											$sql=$pdo->query($sql);

											if($sql->rowCount()>0){

												foreach ($sql->fetchAll() as $despesa) {
													?>


													<tr>
														<td><?php echo $despesa['tran_desc'] ?></td>

														<td><?php echo $despesa['tran_data'] ?></td>

														<td><?php echo "R$ "." - ".$despesa['tran_valor'] ?></td>
													</tr>

													<?php  

												}

											}
											else{
												?>

												<tr>
													<td>Sem Transações</td>

													
												</tr>


												<?php  	


											}


											?>



										</tbody>
									</table>
								</p>
							</div>

						</div>

					</div>
				</div>
				<div class="col s12 m6 l6">
					<div class="row">
						<div class="card blue-grey darken-3">
							<div class="card-content white-text">
								<span class="card-title">SALDO</span>
								<p>
									R$: <?php echo $con_saldo ?>
								</p>
							</div>

						</div>
					</div>
					<div class="row">
						<!-- Modal Trigger -->
						<a class="waves-effect waves-light btn modal-trigger col s12 m6 l6 grey darken-2" href="#modal">Nova Transação</a>
					</div>
				</div>
			</div>			
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

		<!-- Modal Structure -->
		<div id="modal" class="modal modal-fixed-footer">
			<div class="modal-content">
				<h4>Nova Transação</h4>
				<form method="POST">
					<div class="row" >
						<div class="input-field col s12 m6 l6">
							<input id="desc" type="text" class="validate" name="desc">
							<label for="desc">Destinatario/Remetente</label>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s12 m6 l6">
							<select name="tipo">
								<option value="" disabled selected>Despesa/Receita</option>
								<option value="0">Despesa</option>
								<option value="1">Receita</option>

							</select>
							<label>Selecione</label>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s12 m6 l6">
							<input id="valor" type="text" name="valor">
							<label for="valor">Valor</label>
						</div>
					</div>
					<div class="row">
						<div class=" input-field col s6">
							<input type="date" name="data" id="data">
							<label for="data">Data</label>
						</div>
					</div>
					<button class="btn waves-effect waves-light grey darken-2" type="submit" name="action">Enviar
						<i class="material-icons right">send</i>
					</button>
				</form>

			</div>
			<div class="modal-footer">
				<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Cancelar</a>
			</div>
		</div>

		<script src="js/jquery-3.2.1.min.js"></script>
		<script src="js/materialize.min.js"></script>
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript">

			$(document).ready(function(){
    // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
    $('.modal').modal();
    $('select').material_select();

    $('.datepicker').pickadate({
    	monthsFull: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
    	monthsShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
    	weekdaysFull: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabádo'],
    	weekdaysShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
    	today: 'Hoje',
    	clear: 'Limpar',
    	close: '',
    	labelMonthNext: 'Próximo mês',
    	labelMonthPrev: 'Mês anterior',
    	labelMonthSelect: 'Selecione um mês',
    	labelYearSelect: 'Selecione um ano',
    	selectMonths: true, 
    	selectYears: 15,
    	format: 'yyyy-mm-dd',

    });

});









</script> 
</body>
</html>