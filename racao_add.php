<?php include'sessaoseguraadmin.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="content-type" content="text/html;charset=iso-8859-1"><meta http-equiv="content-type" content="text/html;charset=iso-8859-1">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>4Cows >Inserir Medicamento</title>
 
  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="assets/modules/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="assets/modules/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
  <link rel="stylesheet" href="assets/modules/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="assets/modules/jquery-selectric/selectric.css">
  <link rel="stylesheet" href="assets/modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
  <link rel="stylesheet" href="assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
<!-- Start GA -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-94034622-3');
</script>
<!-- /END GA --></head>
<?php include "DBConnection.php";?>

<body>
<?php include'menuadmin.php';?>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Inserir Ração</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="admin.php">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="#">Rações</a></div>
              <div class="breadcrumb-item">Inserir Ração</div>
            </div>
          </div>
		  
<div class="card card-primary">
              <div class="card-header"><h4>Informação Geral</h4></div>

              <div class="card-body">
                <form enctype="multipart/form-data" action="racao_add.php" method="POST">
                  
                    <div class="form-group col-0">
                      <label for="nome">Nome</label>
                      <input id="nome" type="text" class="form-control" name="nome" autofocus>
                    </div>
					<div class="row">
                    <div class="form-group col-6">
					<div class="form-group">
                      <label>Dose(Grama Por Litro de Leite)</label>
                      <input type="text" class="form-control" name="dose">
                    </div>
                    </div>
					<div class="form-group col-6">
					<div class="form-group">
                      <label>Preço</label>
                      <input type="text" class="form-control" name="preco">
                    </div>
                    </div>
                  </div>
				<div class="row">
                 <div class="form-group col-6">
				 <label for="example-text-input" class="form-control-label">Tipo</label>
					<div class="selectgroup selectgroup-pills">
                        <label class="selectgroup-item">
                          <input type="radio" name="tipo" value="1" class="selectgroup-input" checked=""><!--para fazer um radio group, coloco o mesmo name-->
                          <span class="selectgroup-button selectgroup-button-icon">Lactação</span>
                        </label>
                        <label class="selectgroup-item">
                          <input type="radio" name="tipo" value="0" class="selectgroup-input">
                          <span class="selectgroup-button selectgroup-button-icon">  Seca   </span>
                        </label>
						 <label class="selectgroup-item">
                          <input type="radio" name="tipo" value="3" class="selectgroup-input">
                          <span class="selectgroup-button selectgroup-button-icon">Qualquer</span>
                        </label>
					</div>
                    </div>
				  <div class="form-group col-6">
                      <label for="num">Quantidade(Kg)</label>
                      <input id="qt" type="text" class="form-control" name="qt" autofocus>
                    </div>
				</div>

				  
                  <div class="form-group mb-0">
                    <label>Observações</label>
                    <textarea class="form-control" required="" style="height: 182px;" name="observ"></textarea>
                  </div>
				  <br>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                      Inserir
                    </button>
                  </div>
                </form>
              </div>
            </div>
          <div class="section-body">
            <div class="row">
              
        </section>
      </div>
      <?php include 'footer.php';?>
    </div>
  </div>
  
<?php	
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
					
						$qry="Select * from racao where nome='$fnome'";
						$result=mysqli_query($link,$qry);
						$row = mysqli_num_rows($result);
							if($row == 0){
							$query= mysqli_query($link,"insert into racao(nome,preco,tipo,qd,dose,qtkg,observ) values('$fnome','$fpreco',$ftipo,'$grama','$fdose',$qtkg,'$fobserv')");

							if($query){
							$iduser=$_SESSION['iduser'];
							mysqli_query($link,"insert into logs(idu,descricao) values($iduser,'Inseriu uma Ração')");
							?>
								<script>
								swal({
								  title: "Inserido com Sucesso!",
								  text: "",
								  icon: "success",
								});
								</script>
								<?php
								}
							else{
								echo"Erro ao inserir!Erro: ".mysqli_error($link)."";
								}
							
							}else{
							?>
								<script>
								swal({
								  title: "Esta Ração Já está Registada!",
								  text: "Aceda à Página de Listagem para Fazer Alterações",
								  icon: "error",
								});
								</script>
								<?php
								}
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
  <script src="assets/modules/cleave-js/dist/cleave.min.js"></script>
  <script src="assets/modules/cleave-js/dist/addons/cleave-phone.us.js"></script>
  <script src="assets/modules/jquery-pwstrength/jquery.pwstrength.min.js"></script>
  <script src="assets/modules/bootstrap-daterangepicker/daterangepicker.js"></script>
  <script src="assets/modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
  <script src="assets/modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
  <script src="assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
  <script src="assets/modules/select2/dist/js/select2.full.min.js"></script>
  <script src="assets/modules/jquery-selectric/jquery.selectric.min.js"></script>

  <!-- Page Specific JS File -->
  <script src="assets/js/page/forms-advanced-forms.js"></script>
  
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <script src="assets/js/custom.js"></script>
</body>
</html>