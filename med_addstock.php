<?php
session_start();
	$link= mysqli_connect('db','root','test','pap');
	if (((isset($_POST["stock"])) ))
						{
							$divide  = explode("?", $_SERVER["REQUEST_URI"]);
							$divide['1'];
							$med=$divide['1'];
							$qry="Select * from medicamentos where idm=$med";
							$result=mysqli_query($link,$qry);
							$row=mysqli_fetch_array($result);
							$qdisp=$row['qdisp'];
							$fstock=$_POST["stock"];
							
							$addstock=$qdisp+$fstock;
							
							$query=mysqli_query($link,"update medicamentos set qdisp='$addstock' where idm=$med");
							if($query){
							
							$iduser=$_SESSION['iduser'];
							
							//adiciona despesa
							$despesa= $fstock*$row['qtml'];
							$despesa=(round($despesa,2));
							mysqli_query($link,"insert into despesas(valor,descricao,user) values($despesa,'Compra de $row[nome]', $iduser)");
							
							//log
							mysqli_query($link,"insert into logs(idu,descricao) values($iduser,'Aumentou o Stock de um Medicamento')");
							$url = 'medicamento.php?'.$med;
							Header("Location:$url");
						}	
						}

?>