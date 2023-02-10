<?php session_start();
if (isset($_SESSION['iduser'])){
}
else{
	Header("refresh:0.1;url=index.php");}
?>