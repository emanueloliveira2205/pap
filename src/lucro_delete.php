<?php
	include 'DBConnection.php';
	include'sessaoseguraadmin.php';
			$divide  = explode("?", $_SERVER["REQUEST_URI"]);
			$divide['1'];
			$idluc=$divide['1'];
			$query = mysqli_query($link,"update lucros set ativo=1 where idluc=$idluc");

					if($query){
						$iduser=$_SESSION['iduser'];
						$log=mysqli_query($link,"insert into logs(idu,descricao) values($iduser,'Eliminou uma Receita')");
						if($log){
						Header("Location:carteira.php");}
					}
	
?>