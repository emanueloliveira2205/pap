<?php
	include 'DBConnection.php';
	include'sessaoseguraadmin.php';
	if (((isset($_POST["stock"])) ))
						{
							$divide  = explode("?", $_SERVER["REQUEST_URI"]);
							$divide['1'];
							$idracao=$divide['1'];
							$qry="Select * from racao where idracao=$idracao";
							$result=mysqli_query($link,$qry);
							$row=mysqli_fetch_array($result);
							$qdisp=$row['qd'];
							$fstock=$_POST["stock"]*1000;
							
							$addstock=$qdisp+$fstock;
							
							$query=mysqli_query($link,"update racao set qd='$addstock' where idracao=$idracao");
							if($query){
							
							$iduser=$_SESSION['iduser'];
							
							//adiciona despesa
							$despesa= $_POST["stock"]*$row['qtkg'];
							$despesa=(round($despesa,2));
							mysqli_query($link,"insert into despesas(valor,descricao,user) values($despesa,'Compra de $row[nome]', $iduser)");
							
							//log
							mysqli_query($link,"insert into logs(idu,descricao) values($iduser,'Aumentou o Stock de uma Ração')");
							$url = 'racao.php?'.$idracao;
							Header("Location:$url");
						}	
						}

?>