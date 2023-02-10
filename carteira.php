<?php include'sessaoseguraadmin.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>4Cows >Carteira</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->

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


<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
		<?php  include'menuadmin.php';?>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Carteira</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="admin.php">Dashboard</a></div>
              <div class="breadcrumb-item">Carteira</div>
            </div>
          </div>

          <div class="section-body">
           

            <div class="row">
              <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <h4>Despesas</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-bordered table-md">
                        <tr>
                          <th>Utilizador</th>
                          <th>Descrição</th>
                          <th>Data</th>
                          <th>Valor</th>
                          <th></th>
                        </tr>
						<?php $qry=mysqli_query($link,"Select * from despesas where ativo=0 order by iddesp");
							  while($row=mysqli_fetch_array($qry)){ ?>
                        <tr>
							<?php $qry2=mysqli_query($link,"Select nome from utilizadores where coduser='$row[user]'"); 
							 $nomeu=mysqli_fetch_array($qry2);?>
                          <td><?php echo $nomeu['nome'];?></td>
                          <td><?php echo $row['descricao'];?></td>
                          <td><?php echo $row['timestamp'];?></td>
                          <td><div class="badge badge-danger"><?php echo $row['valor'];?>€</td>
						  <?php $url= 'desp_delete.php?'.$row['iddesp']; ?>
                          <td><a href="<?php echo $url;?>" class="btn btn-secondary">Eliminar</a></td>
                        </tr>
							  <?php } ?>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <h4>Receitas</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                       <table class="table table-bordered table-md">
                        <tr>
                          <th>Utilizador</th>
                          <th>Descrição</th>
                          <th>Data</th>
                          <th>Valor</th>
                          <th></th>
                        </tr>
						<?php $qry=mysqli_query($link,"Select * from lucros where ativo=0  order by idluc");
							  while($row=mysqli_fetch_array($qry)){ ?>
                        <tr>
							<?php $qry2=mysqli_query($link,"Select nome from utilizadores where coduser='$row[user]'"); 
							 $nomeu=mysqli_fetch_array($qry2);?>
                          <td><?php echo $nomeu['nome'];?></td>
                          <td><?php echo $row['descricao'];?></td>
                          <td><?php echo $row['timestamp'];?></td>
                          <td><div class="badge badge-success"><?php echo $row['valor'];?>€</td>
						  <?php $url= 'lucro_delete.php?'.$row['idluc']; ?>
                          <td><a href="<?php echo $url;?>" class="btn btn-secondary">Eliminar</a></td>
                        </tr>
							  <?php } ?>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
			<div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
						<div class="form-group col-0">
						<?php $despesas=mysqli_query($link,"SELECT SUM(valor) as total FROM despesas WHERE ativo = 0");
						$despesas=mysqli_fetch_array($despesas);
						$lucro=mysqli_query($link,"SELECT SUM(valor) as total FROM lucros WHERE ativo = 0");
						$lucro=mysqli_fetch_array($lucro);
						$saldo= $lucro['total'] - $despesas['total']?>
                      <label for="num"><h6>Saldo</h6></label>
                      <input type="text" class="form-control" value="<?php echo round(($saldo),2);?>" readonly>
                    </div>	
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
      <?php include 'footer.php';?>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="assets/modules/jquery.min.js"></script>
  <script src="assets/modules/popper.js"></script>
  <script src="assets/modules/tooltip.js"></script>
  <script src="assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="assets/modules/moment.min.js"></script>
  <script src="assets/js/stisla.js"></script>
  
  <!-- JS Libraies -->
  <script src="assets/modules/jquery-ui/jquery-ui.min.js"></script>

  <!-- Page Specific JS File -->
  <script src="assets/js/page/components-table.js"></script>
  
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <script src="assets/js/custom.js"></script>
</body>
</html>