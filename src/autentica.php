<?php

// CONECTA COM A BASE DE DADOS
$link = mysqli_init();
mysqli_ssl_set($link,NULL,NULL, 'ca.pem', NULL, NULL);
mysqli_real_connect($link, "dbemanu.mysql.database.azure.com", "emanu", "L@ctog@l2205", "pap", 3306, MYSQLI_CLIENT_SSL);

// RECEBE OS DADOS DO FORMULÁRIO


$user=$_POST['user'];
$pass=$_POST['pass'];
mysqli_query($link,"insert into logs(idu,descricao) values(25,'regchfg')");

// VERIFICA
$sql = mysqli_query($link,"SELECT * FROM utilizadores WHERE nome = '$user' AND password ='$pass' AND ativo=0")or die("ERRO NO COMANDO SQL");


// LINHAS AFECTADAS PELA CONSULTA
$row = mysqli_num_rows($sql);

// VERIFICA SE DEVOLVEU ALGO
if($row == 0){
	Header("Location:admin.php");
session_start();
$pag='index.php?erro=1';
$_SESSION['erro']=1;
Header("Location:$pag");
}
else {
	// aqui a variavel row deixa de ser um numero e passa a ser um array/vetor com os dados da tabela
	$row=mysqli_fetch_array($sql,MYSQLI_ASSOC);
    
	$iduser=$row['coduser'];
	$tipo=$row['tipo'];
	//INICIALIZA A SESSÃO
session_start();
	//GRAVA AS VARIÁVEIS NA SESSÃO
	$_SESSION['iduser']=$iduser;
	$_SESSION['user']=$user;
	$_SESSION['tipo'] = $tipo;
	$_SESSION['erro']=0;
	
	//faz o log

	$log=mysqli_query($link,"insert into logs(idu,descricao) values($iduser,'Início de Sessão')");
	
		if($tipo==1){
			Header("Location:admin.php");
		}
		else{
			Header("Location:user.php");
		}
}//fecha else
	?>