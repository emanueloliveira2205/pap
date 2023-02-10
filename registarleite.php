 <?php session_start();
	
$link = mysqli_init();
mysqli_ssl_set($link,NULL,NULL, 'ca.pem', NULL, NULL);
mysqli_real_connect($link, "dbemanu.mysql.database.azure.com", "emanu", "L@ctog@l2205", "pap", 3306, MYSQLI_CLIENT_SSL);

	$vaca=$_SESSION['vaca'];
	if ((isset($_POST["leite"])) && (isset($vaca)) && (isset($_POST["timestamp"]))){
		$fleite=$_POST["leite"];
		$ftimestamp=$_POST["timestamp"];
		$fvaca=$vaca;
		$datarecolha=date("Y-m-d");
		
		$query=mysqli_query($link,"insert into leite(data,quantidade,numero,timestamp) values('$datarecolha',$fleite,'$fvaca','$ftimestamp')");
		
		if($query){
			$iduser=$_SESSION['iduser'];
						mysqli_query($link,"insert into logs(idu,descricao) values($iduser,'Registou Leite')");
			header("Refresh:0.1; url=vaca.php");
						}
					else{
						echo"Erro ao inserir!Erro: ".mysqli_error($link)."";
						}
					
					}		
					
 ?>