<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>4Cows >Adicionar Utilizador</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="assets/modules/bootstrap-social/bootstrap-social.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
<!-- Start GA -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-94034622-3');
</script>
<!-- /END GA --></head>

<?php include "DBConnection.php";?>
<?php include "sessaoseguraadmin.php";?>

<body>
<?php include'menuadmin.php';?>
  <div id="app">
  <div class="main-wrapper main-wrapper-1">
    <section class="section">
	<div class="main-content">
    <div class="section-header">
            <h1>Adicionar Utilizador</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="admin.php">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="#">Utilizadores</a></div>
              <div class="breadcrumb-item">Adicionar Utilizador</div>
            </div>
          </div>
       
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              <img src="assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle">
            </div>

            <div class="card card-primary">
              <div class="card-header"><h4>Inserir Dados</h4></div>

              <div class="card-body">
                <form enctype="multipart/form-data" method="POST" action="adduser.php" class="needs-validation" novalidate="">
                  <div class="form-group">
                    <label for="nome">Nome</label>
                    <input id="nome" type="nome" class="form-control" name="nome">

                  </div>

                  <div class="form-group">
                    <div class="d-block">
                    	<label for="password" class="control-label">Password</label>  
                    </div>
                    <input id="password" type="password" class="form-control" name="pass" >
                  </div>
				  
				  <div class="form-group">
                    <div class="d-block">
                    	<label class="control-label">Fotografia</label>  
                    </div>
                    <div><input type="file" name="pic" ></div>
                  </div>

                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="tipo" id="tipo" class="custom-control-input" value="1" >
                      <label class="custom-control-label" for="tipo">Este Utilizador é um Administrador!</label>
                    </div>
                  </div>
				
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Inserir
                    </button>
                  </div>
                </form>
              </div>
            </div>
            
          </div>
        </div>
      </div>
      </div>
    </section>
	<?php include 'footer.php';?>
  </div>
  
<?php			
				if (empty($_POST["tipo"]))
				{
				$ftipo=0;
				}
				elseif((isset($_POST["tipo"]))){
					$ftipo=$_POST["tipo"];
				}
					
				if (((isset($_POST["nome"])) && (isset($_POST["pass"]))&& (isset($ftipo))))
				{
					
					$fnome=$_POST["nome"];
					$fpass=$_POST["pass"];
					$ftipo=$ftipo;
				

					$query=mysqli_query($link,"insert into utilizadores(nome, password,tipo) values('$fnome','$fpass','$ftipo')");
					
					if($query){
						echo "Inserido com Sucesso";
						
					}
					else{
						echo"Erro ao inserir!Erro: ".mysqli_error($link)."";
					}
				}
?>  
<?php
 if(isset($_FILES['pic']))
 {
	$qry="Select * from utilizadores where nome='$fnome' and ativo=0";
	$result2=mysqli_query($link,$qry);
	while($row2=mysqli_fetch_array($result2)){
	$coduser=$row2['coduser'];
	}
    $ext = strtolower(substr($_FILES['pic']['name'],-4)); // extensão da imagem
    $new_name = $coduser . $ext; // novo nome para a imagem
    $dir = 'imagens_users/'; //pasta para onde vao as imagens 
    move_uploaded_file($_FILES['pic']['tmp_name'], $dir.$new_name); //Fazer upload da imagem
 } 
?>

  <!-- General JS Scripts -->
  <script src="assets/modules/jquery.min.js"></script>
  <script src="assets/modules/popper.js"></script>
  <script src="assets/modules/tooltip.js"></script>
  <script src="assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="assets/modules/moment.min.js"></script>
  <script src="assets/js/stisla.js"></script>
  
  <!-- JS Libraies -->

  <!-- Page Specific JS File -->
  
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <script src="assets/js/custom.js"></script>
</body>
</html>