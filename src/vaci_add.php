<!-- Registar Leite -->		
 
 <?php 
	session_start();
	include 'DBConnection.php';
	$vaca=$_SESSION['vaca'];
	if ((isset($_POST["medic"])) && (isset($vaca)) && (isset($_POST["dose"])) & (isset($_POST["motivo"]))){
		$fmedic=$_POST["medic"];
		$qry=mysqli_query($link,"Select * from medicamentos where nome='$fmedic'");  
			while ($row=mysqli_fetch_array($qry)){
			$idm=$row['idm'];
			}
		$fdose=$_POST["dose"];
		$fmotivo=$_POST["motivo"];
		$fvaca=$vaca;
		$datarecolha=date("Y-m-d");
		
		$query=mysqli_query($link,"insert into vacinacao(idm,numero,data,motivo,dose) values($idm,'$fvaca','$datarecolha','$fmotivo',$fdose)");
		
		//reduzir stock
		$stock=mysqli_query($link,"Select * from medicamentos where idm='$idm'");  
			while ($row=mysqli_fetch_array($stock)){
			$stock1=$row['qdisp'];
			$fqdisp=$stock1-$fdose;}
			mysqli_query($link,"update medicamentos set qdisp=$fqdisp where idm=$idm");
		
		
		if($query){
			$iduser=$_SESSION['iduser'];
			mysqli_query($link,"insert into logs(idu,descricao) values($iduser,'Vacinou uma Vaca')");
			header("Refresh:0; url=vaca.php");
						}
					else{
						echo"Erro ao inserir!Erro: ".mysqli_error($link)."";
						}
					
					}		
					
 ?>