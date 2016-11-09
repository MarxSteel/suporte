<?php
require("../restritos.php"); 
require_once '../init.php';
$cAtend = "active";
$PDO = db_connect();
require_once '../QueryUser.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
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
 <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
  <link href="dist/jquery.bootgrid.css" rel="stylesheet" />

<style type="text/css">
.texto {
word-wrap: break-word;
}
</style>
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
  <h1>Suporte T&eacute;cnico - Controle de Atendimentos por T&eacute;cnico<small><?php echo $titulo; ?></small></h1>
 </section>
 <section class="content">
  <div class="row">
  <?php if ($permSup === "1") { ?>
   <div class="col-md-4 col-sm-6 col-xs-12">
    <div class="info-box">
     <a data-toggle="modal" data-target="#nAtend"">
      <span class="info-box-icon bg-blue">
       <i class="fa fa-plus"></i>
      </span>
     </a>
     <div class="info-box-content"><br /><h4>Adicionar Atendimento</h4></div>
    </div>
   </div>
   <div class="col-md-4 col-sm-6 col-xs-12">
    <div class="box box-widget widget-user">
     <div class="info-box">
      <a href="Geral.php" >
       <span class="info-box-icon bg-aqua">
        <i class="fa fa-newspaper-o"></i>
       </span>
      </a>
      <div class="info-box-content"><h4>Todos os Atendimentos</h4></div>
     </div>                  
    </div>
   </div> 
    <?php } else { } ?>
    <section class="col-lg-12 connectedSortable">
     <div class="nav-tabs-custom">
      <ul class="nav nav-tabs pull-right">
       <li class="active"><a href="#pendentes" data-toggle="tab">Atendimentos Pendentes</a></li>
        <li><a href="#finalizados" data-toggle="tab">Atendimentos Finalizados</a></li>
        <li class="pull-left header">
         <i class="fa fa-inbox"></i> Lista de Atendimentos do Usu&aacute;rio
        <li>
         <button type="button" class="btn bg-navy btn-sm" data-toggle="modal" data-target="#help">
          <i class="fa fa-question"></i> AJUDA
         </button>
        </li>
      </ul>
      <div class="tab-content no-padding">
       <div class="tab-pane active" id="pendentes">

        <table id="PendentesUsuario" class="table table-hover table=responsive table-striped" width="100%" cellspacing="0">
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
       <div class="tab-pane" id="finalizados">
        <?php include_once 'TFUser.php'; ?>
       </div>
      </div>
     </div>
    </section>
  </div><!-- CLASS ROW -->
  <?php include_once 'modalSup.php'; ?>

 

 </section>
</div><!-- CONTENT-WRAPPER -->
<?php include_once '../footer.php'; ?>
<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="../plugins/fastclick/fastclick.js"></script>
<script src="../dist/js/app.min.js"></script>
<script src="../dist/js/demo.js"></script>
<script src="../plugins/select2/select2.full.min.js"></script>
<script src="dist/jquery-1.11.1.min.js"></script>
<script src="dist/jquery.bootgrid.min.js"></script>

<script>
  $(function () {
    $('#pendente').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": false,
      "info": true,
      "autoWidth": true
    });
    $('#finalizadosUser').DataTable({
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
<script type="text/javascript">
$('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever')
  var idvalor = button.data('idvalue')
  var obs = button.data('obs') 
  var botao = button.data('botao')
  var modal = $(this)
  modal.find('.modal-title').text('New message to ' + recipient)
  modal.find('.modal-body input').val(recipient)
  modal.find('.modal-valor input').val(idvalor)
  modal.find('.modal-botao input').val(botao)
  modal.find('.modal-titulo input').val(recipient)
  modal.find('.modal-obs input').val(obs)
})

</script>
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

    formatters: {
    }
   });
});
</script>
<script type="text/javascript">
  
$( document ).ready(function() {
  $("#PendentesUsuario").bootgrid({
    ajax: true,
    post: function ()
    {
      return {
        id: "b0df282a-0d67-40e5-8558-c9e93b7befed"
      };
    },
    url: "PendentesUsuario.php",
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


</script>

</html>