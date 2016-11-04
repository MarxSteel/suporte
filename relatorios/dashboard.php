<?php
require("../restritos.php"); 
require_once '../init.php';
$cUser = "active";
$PDO = db_connect();
require_once '../QueryUser.php';

$Chamauser = "SELECT * FROM login";
$QryUser = $PDO->prepare($Chamauser);
$QryUser->execute();
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
    <link rel="stylesheet" href="../plugins/select2/select2.min.css">

  <!-- bootstrap datepicker -->
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="../../plugins/iCheck/all.css">
  <!-- Bootstrap Color Picker -->
  <!-- Bootstrap time Picker -->
  <!-- Select2 -->



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
  <h1>Relatórios<small><?php echo $titulo; ?></small></h1>
 </section>
 <section class="content">
  <div class="row">
  <?php if ($permRel === "1") { ?>
    <div class="col-md-4 col-sm-6 col-xs-12">
     <div class="info-box">
      <a data-toggle="modal" data-target="#usuarioGeral"">
       <span class="info-box-icon bg-yellow">
        <i class="fa fa-plus"></i>
       </span>
      </a>
      <div class="info-box-content"><br /><h4>Relatório de Usuário Geral</h4></div>
     </div>
    </div>
    <div class="col-md-4 col-sm-6 col-xs-12">
     <div class="info-box">
      <a data-toggle="modal" data-target="#ruserPeriodo"">
       <span class="info-box-icon bg-yellow">
        <i class="fa fa-plus"></i>
       </span>
      </a>
      <div class="info-box-content">X<br /><h4>Relatório de Usuário por período</h4></div>
     </div>
    </div>
    <div class="col-md-4 col-sm-6 col-xs-12">
     <div class="info-box">
     </div>
    </div>
    <div class="col-md-4 col-sm-6 col-xs-12">
     <div class="info-box">
      <a data-toggle="modal" data-target="#modeloGeral"">
       <span class="info-box-icon bg-blue">
        <i class="fa fa-plus"></i>
       </span>
      </a>
      <div class="info-box-content"><br /><h4>Relatório de Modelo Geral</h4></div>
     </div>
    </div>
    <div class="col-md-4 col-sm-6 col-xs-12">
     <div class="info-box">
      <a data-toggle="modal" data-target="#ruserPeriodo"">
       <span class="info-box-icon bg-blue">
        <i class="fa fa-plus"></i>
       </span>
      </a>
      <div class="info-box-content">X<br /><h4>Relatório de Modelo por período</h4></div>
     </div>
    </div>
    <div class="col-md-4 col-sm-6 col-xs-12">
     <div class="info-box">
     </div>
    </div>
    <div class="col-md-4 col-sm-6 col-xs-12">
     <div class="info-box">
      <a data-toggle="modal" data-target="#revendaGeral"">
       <span class="info-box-icon bg-red">
        <i class="fa fa-plus"></i>
       </span>
      </a>
      <div class="info-box-content"><br /><h4>Relatório de Revenda Geral</h4></div>
     </div>
    </div>
    <div class="col-md-4 col-sm-6 col-xs-12">
     <div class="info-box">
      <a data-toggle="modal" data-target="#revendaPeriodo"">
       <span class="info-box-icon bg-red">
        <i class="fa fa-plus"></i>
       </span>
      </a>
      <div class="info-box-content">X<br /><h4>Relatório de Revenda por período</h4></div>
     </div>
    </div>
    <div class="col-md-4 col-sm-6 col-xs-12">
     <div class="info-box">
     </div>
    </div>
   <?php  
   require_once 'modalUsuario.php'; 
   require_once 'modalRevenda.php';
   require_once 'modalModelo.php';
   } else{ ?>
   <div class="col-md-12 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-red">
      <i class="fa fa-exclamation-triangle"></i>
      </span>
      <div class="info-box-content">
       <h4><strong><i>Atenção!</i></strong></h4>
       <h4>Você não possui privilégios suficientes para abrir esta página. Contate o Administrador!</h4>
      </div>
     </div>
    </div>
    <?php } ?>
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
<script src="../plugins/select2/select2.full.min.js"></script>
<script language="JavaScript">
function abrir(URL) { 
  var width = 1200;
  var height = 650;
  var left = 99;
  var top = 99;
  window.open(URL,'janela', 'width='+width+', height='+height+', top='+top+', left='+left+', scrollbars=yes, status=no, toolbar=no, location=no, directories=no, menubar=no, resizable=no, fullscreen=no');
}
</script>
<!-- SCRIPT PARA FORMATAR A DATA -->
<script>
function formatar(mascara, documento){
  var i = documento.value.length;
  var saida = mascara.substring(0,1);
  var texto = mascara.substring(i)
  
  if (texto.substring(0,1) != saida){
            documento.value += texto.substring(0,1);
  }
  
}
</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();
  });
</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select3").select2();
  });
</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".revendaGeral").select2();
  });
</script>

<script type="text/javascript">
$('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever')
  var idvalor = button.data('idvalue') 
  var botao = button.data('botao')
  var modal = $(this)
  modal.find('.modal-title').text('New message to ' + recipient)
  modal.find('.modal-body input').val(recipient)
  modal.find('.modal-valor input').val(idvalor)
  modal.find('.modal-botao input').val(botao)
  modal.find('.modal-titulo input').val(recipient)
})

</script>
</html>
