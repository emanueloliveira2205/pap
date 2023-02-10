<?php
	include 'DBConnection.php';
	include'sessaoseguraadmin.php';
			$divide  = explode("?", $_SERVER["REQUEST_URI"]);
			$divide['1'];
			$iddesp=$divide['1'];
			$query = mysqli_query($link,"update despesas set ativo=1 where iddesp=$iddesp");

					if($query){
						$iduser=$_SESSION['iduser'];
						$log=mysqli_query($link,"insert into logs(idu,descricao) values($iduser,'Eliminou uma Despesa')");
						if($log){
						Header("Location:carteira.php");}
					}
	
?>