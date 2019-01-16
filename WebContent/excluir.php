<?php 
session_start();
require 'dbconnect.php';


$dado=$_SESSION['dado'];

$user_id=$dado[0][0];


 if (isset($_GET['id']) && empty($_GET['id']==false)){
     $id = $_GET['id'];


     $sql = "SELECT * FROM tb_contas WHERE con_id='$id' AND user_id='$user_id'";
     $sql=$pdo->query($sql);

     if ($sql->rowCount()>0) {

     $pdo->query("DELETE FROM tb_contas WHERE con_id='$id'");
     $pdo->query("DELETE FROM tb_transacoes WHERE con_id='$id' AND user_id='$user_id'");

     header("Location: user.php");
    }

   
}
 
else{
	header("Location: user.php");
}







   





 ?>
