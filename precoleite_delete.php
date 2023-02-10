<?php
	session_start();
	$link= mysqli_connect('db','root','test','pap');
			$divide  = explode("?", $_SERVER["REQUEST_URI"]);
			$divide['1'];
			$idpl=$divide['1'];
			$query = mysqli_query($link,"update precoleite set ativo=1 where idpl=$idpl");

					if($query){
						$iduser=$_SESSION['iduser'];
						mysqli_query($link,"insert into logs(idu,descricao) values($iduser,'Eliminou um Registo de Preço do Leite')");
						Header("Location:precoleite.php");
					}
	
?>