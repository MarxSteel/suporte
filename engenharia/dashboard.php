<?php
require("../restritos.php"); 
require_once '../init.php';
$cDoc = "active";
$PDO = db_connect();
require_once '../QueryUser.php';
?>
<!DOCTYPE html>
<html>
<head>

 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <title><?php echo $titulo; ?></title>
 <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
 <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
 <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
 <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
 <link rel="stylesheet" href="../plugins/iCheck/flat/blue.css">
</head>
<body class="hold-transition skin-blue-light fixed sidebar-mini">
<div class="wrapper">
 <header class="main-header">
  <a href="#" class="logo">
   <span class="logo-mini"><img src="../dist/img/logo/logoWhite.png" width="50"/></span>
   <span class="logo-lg"><img src="../dist/img/logo/logoWhite.png" width="180" /></span>
  </a>
  <nav class="navbar navbar-static-top">
   <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
    <span class="sr-only">Minizar Navegação</span>
   </a>
   <div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
     <li class="dropdown user user-menu">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
       <span class="hidden-xs"><?php echo $NomeUserLogado; ?></span>
      </a>
      <ul class="dropdown-menu">
       <li class="user-header">
        <p><?php echo $NomeUserLogado; ?></p>
       </li>
       <li class="user-footer">
        <div class="pull-left">
         <a href="user/perfil.php" class="btn btn-info">Dados de Perfil</a>
        </div>
        <div class="pull-right">
         <a href="../logout.php" class="btn btn-danger">Sair</a>
        </div>
       </li>
      </ul>
     </li>
     <li>
       <a href="../logout.php" class="btn btn-danger btn-flat">Sair</a>
     </li>
    </ul>
    </div>
    </nav>
  </header>
  <aside class="main-sidebar">
   <section class="sidebar">
    <?php include_once '../menuLateral.php'; ?>
    </section>
  </aside>
<div class="content-wrapper">
 <section class="content-header">
  <h1>Engenharia - Controle de Documentos <small><?php echo $titulo; ?></small></h1>
 </section>
 <section class="content">
  <div class="row">
  <?php if ($permFw === "1") { ?>
   <div class="col-md-4 col-sm-6 col-xs-12">
    <div class="info-box">
     <a data-toggle="modal" data-target="#nfw"">
      <span class="info-box-icon bg-red">
       <i class="fa fa-plus"></i>
      </span>
     </a>
     <div class="info-box-content"><br /><h4>Adicionar Firmware</h4></div>
    </div>
   </div>
   <div class="col-md-4 col-sm-6 col-xs-12">
    <div class="info-box">
     <a data-toggle="modal" data-target="#nmanual"">
      <span class="info-box-icon bg-green">
       <i class="fa fa-plus"></i>
      </span>
     </a>
     <div class="info-box-content"><br /><h4>Adicionar Manual</h4></div>
    </div>
   </div>
    <div class="col-md-4 col-sm-6 col-xs-12">
     <div class="info-box">
      <a data-toggle="modal" data-target="#NovoProduto"">
       <span class="info-box-icon bg-blue">
        <i class="fa fa-plus"></i>
       </span>
      </a>
      <div class="info-box-content"><br /><h4>Novo Produto</h4></div>
     </div>
    </div>
    <?php } else { } ?>
   <div class="col-md-8">
    <div class="nav-tabs-custom">
     <ul class="nav nav-tabs pull-right">
      <li class="active"><a href="#firmware" data-toggle="tab">FIRMWARE</a></li>
      <li><a href="#manual" data-toggle="tab">MANUAIS</a></li>
     </ul>
     <div class="tab-content">
      <div class="tab-pane active" id="firmware">
      <?php include_once 'tabelaFw.php'; ?>
      </div>
      <div class="tab-pane" id="manual">
        <?php include_once 'tabelaManual.php'; ?>

         </div>
        </div>
       </div>
      </div>
      <div class="col-md-4">
       <div class="nav-tabs-custom">
        <div class="box-header with-border">
         <i class="fa fa-warning"></i>
         <h3 class="box-title">Lista de Produtos</h3>
        </div>
        <?php include_once 'tabelaProduto.php'; ?>
       </div>
      </div>
      <?php include_once 'modalEng.php'; ?>
<!-- MODAL DE CADASTRO DE FIRMWARE DE LINHA -->

<!-- FINAL DO MODAL DE CADASTRO DE FIRMWARE DE LINHA -->
  
  </div><!-- CLASS ROW -->
 </section>
</div><!-- CONTENT-WRAPPER -->
<?php include_once '../footer.php'; ?>
<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="../plugins/fastclick/fastclick.js"></script>
<script src="../dist/js/app.min.js"></script>
<script src="../dist/js/demo.js"></script>
<script>
  $(function () {
    $('#tabfw').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": false,
      "info": true,
      "autoWidth": true
    });
    $('#tabMan').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": false,
      "info": true,
      "autoWidth": true
    });
  });
</script>
<script language="JavaScript">
function abrir(URL) { 
  var width = 1200;
  var height = 650;
  var left = 99;
  var top = 99;
  window.open(URL,'janela', 'width='+width+', height='+height+', top='+top+', left='+left+', scrollbars=yes, status=no, toolbar=no, location=no, directories=no, menubar=no, resizable=no, fullscreen=no');
}
</script>
</html>
