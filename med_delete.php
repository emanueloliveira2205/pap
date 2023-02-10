<?php
session_start();
	$link= mysqli_connect('db','root','test','pap');
			$divide  = explode("?", $_SERVER["REQUEST_URI"]);
			$divide['1'];
			$idm=$divide['1'];
			$query = mysqli_query($link,"update medicamentos set ativo=1 where idm=$idm");

					if($query){
						$iduser=$_SESSION['iduser'];
						$log=mysqli_query($link,"insert into logs(idu,descricao) values($iduser,'Eliminou um Medicamento')");
						if($log){
						Header("Location:med_listar.php");}
					}
	
?>