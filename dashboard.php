<?php
require("restritos.php"); 
require_once 'init.php';
$cHome = "active";
$PDO = db_connect();
require_once 'QueryUser.php';
?>
<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <title><?php echo $titulo; ?></title>
 <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
 <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
 <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
 <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
 <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
</head>
<body class="hold-transition skin-blue-light fixed sidebar-mini">
<div class="wrapper">
 <header class="main-header">
  <a href="#" class="logo">
   <span class="logo-mini"><img src="dist/img/logo/logoWhite.png" width="50"/></span>
   <span class="logo-lg"><img src="dist/img/logo/logoWhite.png" width="180" /></span>
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
         <a href="logout.php" class="btn btn-danger">Sair</a>
        </div>
       </li>
      </ul>
     </li>
     <li>
       <a href="logout.php" class="btn btn-danger btn-flat">Sair</a>
     </li>
    </ul>
    </div>
    </nav>
  </header>
  <aside class="main-sidebar">
   <section class="sidebar">
    <?php include_once 'menuLateral.php'; ?>
    </section>
  </aside>
<div class="content-wrapper">
 <section class="content-header">
  <h1>Página Inicial<small><?php echo $titulo; ?></small></h1>
 </section>
 <section class="content">
  <div class="row">
  <?php if ($permSup === "1") { ?>  
   <div class="col-md-4 col-sm-6 col-xs-12">
    <div class="box box-widget widget-user">
     <div class="info-box">
      <a href="atendimento/dashboard.php" >
       <span class="info-box-icon bg-aqua">
        <i class="fa fa-plus"></i>
       </span>
      </a>
      <div class="info-box-content"><h4>ATENDIMENTOS</h4></div>
     </div>                  
    </div>
   </div> 
   <div class="col-md-4 col-sm-6 col-xs-12">
    <div class="box box-widget widget-user">
     <div class="info-box">
      <a href="revendas/dashboard.php" >
       <span class="info-box-icon bg-red">
        <i class="fa fa-newspaper-o"></i>
       </span>
      </a>
      <div class="info-box-content"><h4>CADASTRO DE REVENDAS</h4></div>
     </div>                  
    </div>
   </div> 
  <?php } else { } if ($permFw === "1") { ?>
   <div class="col-md-4 col-sm-6 col-xs-12">
    <div class="box box-widget widget-user">
     <div class="info-box">
      <a href="engenharia/dashboard.php" >
       <span class="info-box-icon bg-green">
        <i class="fa fa-file-code-o"></i>
       </span>
      </a>
      <div class="info-box-content"><h4>CADASTRO DE EQUIPS.</h4></div>
     </div>                  
    </div>
   </div>
   <?php } else { } if ($permRel === "1") { ?>
   <div class="col-md-4 col-sm-6 col-xs-12">
    <div class="box box-widget widget-user">
     <div class="info-box">
      <a href="relatorios/dashboard.php" >
       <span class="info-box-icon bg-orange">
        <i class="fa fa-pie-chart"></i>
       </span>
      </a>
      <div class="info-box-content"><h4>RELATÓRIOS</h4></div>
     </div>                  
    </div>
   </div>
  <?php } else { } if ($permUsr === "1") { ?>
   <div class="col-md-4 col-sm-6 col-xs-12">
    <div class="box box-widget widget-user">
     <div class="info-box">
      <a href="usuarios/dashboard.php" >
       <span class="info-box-icon bg-purple ">
        <i class="fa fa-users"></i>
       </span>
      </a>
      <div class="info-box-content"><h4>USU&Aacute;RIOS</h4></div>
     </div>                  
    </div>
   </div> 
  <?php } else { } ?>
 </section>
</div><!-- CONTENT-WRAPPER -->
<?php include_once 'footer.php'; ?>

</div>
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="plugins/fastclick/fastclick.js"></script>
<script src="dist/js/app.min.js"></script>
<script src="dist/js/pages/dashboard.js"></script>
<script src="dist/js/demo.js"></script>
</body>
</html>
