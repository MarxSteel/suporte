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
 <link rel="stylesheet" href="../plugins/iCheck/flat/blue.css">
 <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
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
     <?php
      $sql = "SELECT EMPRESA_ID, CIDADE, DDD1, EMAIL, RAZAO_SOCIAL, TELEFONE1 FROM lista_revenda";
       $result = $conn->query($sql);
        if ($result->num_rows > 0) {
     ?>
      <table id="revenda" class="table table-striped" width="100%" cellspacing="0">
       <thead>
        <tr>
         <td width="5%"></td>
         <td width="50%">Razão Social</td>
         <td width="15%">Cidade</td>
         <td width="15%">Telefone</td>
         <td width="15%">E-Mail</td>         
        </tr>
       </thead>
       <tbody>
       <?php
        while($row = $result->fetch_assoc()) {

        echo '<tr>';
         echo '<td>';
         echo '<a class="btn btn-default btn-xs" href="';
         echo "javascript:abrir('vRevenda.php?ID=" . $row["EMPRESA_ID"] . "');";
         echo '"><i class="fa fa-search"></i></a>';  
        echo '</td>';
         echo '<td>' . $row["RAZAO_SOCIAL"] . '</td>';
         echo '<td>' . $row["CIDADE"] . '</td>';
         echo '<td>' . $row["DDD1"] . '-' .  $row["TELEFONE1"] . '</td>';
         echo '<td>' . $row["EMAIL"] . '</td>';
        echo '</tr>';

       }
     }
     else{

     }
       $conn->close();
       ?>
       </tbody>
     </table>
     </div>
    </div>
   </div>
  </div><!-- CLASS ROW -->
 </section>
</div><!-- CONTENT-WRAPPER -->
<?php include_once '../footer.php'; ?>
<script src="../plugins/tabela/jquery-1.12.3.js"></script>
<script src="../plugins/tabela/jquery.dataTables.min.js"></script>
<script src="../plugins/tabela/dataTables.scroller.min.js"></script>
<script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../plugins/fastclick/fastclick.js"></script>
<script src="../dist/js/app.min.js"></script>
<script src="../dist/js/demo.js"></script>
<script>
  $(function () {
    $('#revenda').DataTable();
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
