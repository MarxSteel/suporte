<?php
require("../restritos.php"); 
require_once '../init.php';
$cRev = "active";
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
 <link href="dist/jquery.bootgrid.css" rel="stylesheet" />




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
  <h1>Suporte Técnico - Cadastro de Revendas<small><?php echo $titulo; ?></small></h1>
 </section>
 <section class="content">
  <div class="row">
   <div class="col-md-12">
    <div class="box box-primary">
     <div class="box-header">
      <i class="ion ion-clipboard"></i>
       <h3 class="box-title">Lista de Revendas</h3>
     </div>
     <div class="box-body">
      <table id="tabelaRevenda" class="table table-hover table=responsive table-striped" width="100%" cellspacing="0">
        <thead>
        <tr>
         <th data-column-id="RAZAO_SOCIAL">Razão Social</th>
         <th data-column-id="CIDADE">Cidade</th>
         <th data-column-id="EMAIL">E-Mail</th>
         <th data-column-id="TELEFONE1">TELEFONE</th>
         <th data-column-id="link" data-formatter="link" data-sortable="false">Link</th>
         <th data-column-id="link2" data-formatter="link" data-sortable="false">Link</th>

        </tr>
        </thead>        
    </table>
     </div>
    </div>
   </div>
  </div><!-- CLASS ROW -->
 </section>
</div><!-- CONTENT-WRAPPER -->
<?php include_once '../footer.php'; ?>
<script src="../plugins/tabela/jquery-1.12.3.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../plugins/fastclick/fastclick.js"></script>
<script src="../dist/js/app.min.js"></script>
<script src="../dist/js/demo.js"></script>
<script src="dist/jquery-1.11.1.min.js"></script>
<script src="dist/jquery.bootgrid.min.js"></script>
<script type="text/javascript">
$( document ).ready(function() {
  $("#tabelaRevenda").bootgrid({
    ajax: true,
    post: function ()
    {
      return {
        id: "b0df282a-0d67-40e5-8558-c9e93b7befed"
      };
    },
    url: "response.php",
    formatters: 
     {
            "link": function(row)
        {
            return "<a href=\"vRevenda.php?ID=" + row.EMPRESA_ID + "\" class=\"btn btn-default btn-xs\" target=\"_blank\"> <i class=\"fa fa-search\"></i></a>";
        }
                "commands": function(column, row)
        {
            return "<button type=\"button\" class=\"btn btn-xs btn-default command-edit\" data-row-id=\"" + row.id + "\"><span class=\"fa fa-pencil\"></span></button> " + 
                "<button type=\"button\" class=\"btn btn-xs btn-default command-delete\" data-row-id=\"" + row.id + "\"><span class=\"fa fa-trash-o\"></span></button>";
        }
    }
   });
});
</script>

</html>
