<?php
	include 'DBConnection.php';
	include'sessaoseguraadmin.php';
			$divide  = explode("?", $_SERVER["REQUEST_URI"]);
			$divide['1'];
			$idu=$divide['1'];
			$query = mysqli_query($link,"update utilizadores set ativo=1 where coduser=$idu");

					if($query){
						$iduser=$_SESSION['iduser'];
						mysqli_query($link,"insert into logs(idu,descricao) values($iduser,'Eliminou um Utilizador')");
						Header("Location:listarusers.php");
					}
	
?>