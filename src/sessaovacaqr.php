<?php
	session_start();
$divide  = explode("?", $_SERVER["REQUEST_URI"]);
$divide['1'];

// CONECTA COM A BASE DE DADOS
$link= mysqli_connect('db','root','test','pap');
// RECEBE OS DADOS DO FORMULÁRIO
$vaca=$divide['1'];
// VERIFICA
$sql = mysqli_query($link,"SELECT * FROM vacas WHERE numero = '$vaca'");
// LINHAS AFECTADAS PELA CONSULTA
$row = mysqli_num_rows($sql);
// VERIFICA SE DEVOLVEU ALGO
// se nao devolveu nada mostra um erro
if($row == 0){
session_start();
$pag='admin.php?erro=1';
$_SESSION['erro']=1;
Header("Location:$pag");
}
//se tiver devolvido algo vai para a pagina vaca.php
else {

	//GRAVA AS VARIÁVEIS NA SESSÃO
	$_SESSION['vaca'] = $vaca;
	Header("Refresh:0.2; url=vaca.php");

}//fecha else
	?>