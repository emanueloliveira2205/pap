<?php
	include 'DBConnection.php';
	include'sessaoseguraadmin.php';
			$divide  = explode("?", $_SERVER["REQUEST_URI"]);
			$divide['1'];
			$idracao=$divide['1'];
			
			if (((isset($_POST["nome"])) && (isset($_POST["preco"]))&& (isset($_POST["dose"]))&& (isset($_POST["tipo"]))&& (isset($_POST["qt"]))))
						{
							
							$fnome=$_POST["nome"];
							$fpreco=$_POST["preco"];
							$fdose=$_POST["dose"];
							$ftipo=$_POST["tipo"];
							$fqt=$_POST["qt"];
							$fobserv=$_POST["observ"];
							
							$grama=$fqt*1000;
							$qtkg=$fpreco/$fqt;
							
							
							$delete=mysqli_query($link,"delete from racao where idracao='$idracao'");
							$query= mysqli_query($link,"insert into racao(idracao,nome,preco,tipo,qd,dose,qtkg,observ) values('$idracao','$fnome','$fpreco',$ftipo,'$grama','$fdose',$qtkg,'$fobserv')");

					if($query){
						$iduser=$_SESSION['iduser'];
						mysqli_query($link,"insert into logs(idu,descricao) values($iduser,'Editou uma Ração')");
						Header("Location:racao.php?$idracao");
					}
					}
	
?>