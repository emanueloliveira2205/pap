<?php
	include 'DBConnection.php';
	include'sessaoseguraadmin.php';
			$divide  = explode("?", $_SERVER["REQUEST_URI"]);
			$divide['1'];
			$med=$divide['1'];
			
			if (((isset($_POST["nome"])) && (isset($_POST["preco"]))&& (isset($_POST["validade"]))&& (isset($_POST["intseg"]))&& (isset($_POST["qt"]))))
						{
							
							$fnome=$_POST["nome"];
							$fpreco=$_POST["preco"];
							$fvalidade=$_POST["validade"];
							$fintseg=$_POST["intseg"];
							$fqt=$_POST["qt"];
							$fobserv=$_POST["observ"];
							

							$qtml=$fpreco/$fqt;
							
							$delete=mysqli_query($link,"delete from medicamentos where idm='$med'");
							$query= mysqli_query($link,"insert into medicamentos(idm,nome,preco,validade,intseg,observ,qdisp,qtml) values('$med','$fnome','$fpreco','$fvalidade',$fintseg,'$fobserv',$fqt,$qtml)");

					if($query){
						$iduser=$_SESSION['iduser'];
						mysqli_query($link,"insert into logs(idu,descricao) values($iduser,'Editou um Medicamento')");
						Header("Location:medicamento.php?$med");
					}
					}
	
?>