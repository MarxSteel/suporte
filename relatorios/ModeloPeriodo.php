<?php
require("../restritos.php"); 
require_once '../init.php';
$ModeloCod = $_GET['equip'];
$DataIni = $_GET['dtInicio'];				// DATA DE INICIO DA PESQUISA (DD/MM/AAAA)
$DataFim = $_GET['dtFinal'];					// DATA DE FIM DA PESQUISA (DD/MM/AAAA)
$PDO = db_connect();
require_once '../QueryUser.php';
$DataRelatorio = date('Y-m-d H:i:s');
$DataCorrigida = date('d/m/Y H:i:s', strtotime($DataRelatorio));






$teste = "teste";

  //TRATANDO DATA FINAL
  $DataFinInt = explode("/",$DataFim);
  $DataFinal = $DataFinInt[2].'-'.$DataFinInt[1].'-'.$DataFinInt[0] . " 00:00:00";
  //TRATANDO DATA DE INÍCIO
  $DataIniInt = explode("/",$DataIni);
  $DataInicial = $DataIniInt[2].'-'.$DataIniInt[1].'-'.$DataIniInt[0] . " 00:00:00";

require_once 'queries/ModeloPeriodo.php';
?>
<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <title>LiberaREP - Henry Equipamentos e Sistemas</title>
 <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
 <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
 <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
 <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
 <link rel="stylesheet" href="../plugins/morris/morris.css">
 <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">


 <style type="text/css">
  .texto {
    word-wrap: break-word;
  }
  </style>
</head>
<body class="hold-transition skin-blue layout-top-nav">
 <div class="wrapper">
  <header class="main-header">
   <nav class="navbar navbar-static-top">
    <div class="container">
     <div class="navbar-header">
      <span class="logo-lg"><img src="../dist/img/logo/henry-logo-branco.png" width="200"></span>
     </div>
     <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
       <li class="dropdown user user-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <span class="hidden-xs">Olá, <?php echo $NomeUserLogado; ?></span></a>
       </li>
      </ul>
     </div>
    </div>
   </nav>
  </header>
  <div class="content-wrapper">
   <div class="container">
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
           Henry Equipamentos e Sistemas
            <small class="pull-right">Data do Relatório: <?php echo $DataCorrigida; ?> 
              <a href="ImprimeUP.php?usuario=<?php echo $UsuarioCod; ?>&dtInicio=<?php echo $DataIni; ?>&dtFinal=<?php echo $DataFim; ?>" target="_blank" class="btn btn-default">
               <i class="fa fa-print"></i> Imprimir</a></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <div class="row invoice-info">
       <div class="col-sm-4 invoice-col">
        <address>
         <h4>Modelo: </h4>
          <li class="list-group-item">
           <?php echo $ModeloCod; ?>
          </li>
         <h4>Data Inicial: </h4>
          <li class="list-group-item">
           <?php echo $DataIni; ?>
          </li>
         <h4>Data Final: </h4>
          <li class="list-group-item">
           <?php echo $DataFim; ?>
          </li>
         <h4>Quantidade de atendimentos no período: </h4>
          <li class="list-group-item">
           <?php echo $AtendFinEquip + $AtendPenEquip; ?>
          </li>
        </address>
       </div>
        <div class="col-sm-4 invoice-col">
         <div class="box box-danger">
          <div class="box-header with-border">
            <h3 class="box-title">Quantidade de Atendimentos</h3>
            </div>
            <div class="box-body">
            <div id="quantUserDonut" style="height:200px"></div>
             <strong>PENDENTES:</strong>
             <span class="badge bg-red pull-right">
              <?php echo $QtAtendPendente . ' - ' . $PorcentoModPen . '%'; ?>
             </span><br  />
             <strong>FINALIZADOS:</strong>
             <span class="badge bg-green pull-right">
              <?php echo $QtAtendFinal . ' - ' . $PorcentoModFin . '%'; ?>
             </span>
            </div>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
         <div class="box box-danger">
          <div class="box-header with-border">
            <h3 class="box-title">Atendimentos Finalizados</h3>
            </div>
            <div class="box-body">
            <div id="quantGerDonut" style="height:200px"></div>
             <strong>PENDENTES:</strong>
              <span class="badge bg-red pull-right">
              <?php echo $QtAtendPendente . ' - ' . $PorcentoModPen . '%'; ?>
              </span><br  />
             <strong>FINALIZADOS:</strong>
              <span class="badge bg-green pull-right">
               <?php echo $QtAtendFinal . ' - ' . $PorcentoModFin . '%'; ?>
              </span>
            </div>
          </div>
        </div>
      </div>
      <h3> Resumo dos chamados no período selecionado </h3>
      <!-- AQUI COMEÇA A TABELA DE LISTA DOS CHAMADOS REALIZADOS NO PERÍODO -->
      <!-- QUERY DE BUSCA DOS CHAMADOS -->
       <?php
        $ChamaChamados = "SELECT * FROM atendimento WHERE Equip='$ModeloCod' AND DataCadastro BETWEEN '$DataInicial' AND '$DataFinal'";
        $ChChama = $PDO->prepare($ChamaChamados);
        $ChChama->execute();
       ?>
       <table id="ModeloRelatorio" class="table table-hover table-striped table-responsive">
        <thead>
         <tr>
          <td>Cham.</td>
          <td>Revenda</td>
          <td>Técnico da Revenda</td>
          <td>Atendente</td>
          <td>Cadastro</td>
          <td>Data de Cadastro</td>
          <td></td>
         </tr>
        </thead>
        <tbody>
        <?php while ($chamadosChamados = $ChChama->fetch(PDO::FETCH_ASSOC)): 
         echo '<tr>';
          echo '<td>' . $chamadosChamados["id"] . '</td>';
          echo '<td>' . $chamadosChamados["Revenda"] . '</td>';
          echo '<td>' . $chamadosChamados["RevendaTecnico"] . '</td>'; 
          echo '<td>' . $chamadosChamados["UserAtendente"] . '</td>';   
          echo '<td>' . $chamadosChamados["DescSolicita"] . '</td>';   
          echo '<td>' . $chamadosChamados["DataCadastro"] . '</td>';
          echo '<td>';
           echo '<a class="btn btn-default btn-xs" href="';
           echo "javascript:abrir('Visualizar.php?ID=" . $chamadosChamados["id"] . "');";
           echo '"><i class="fa fa-search"></i></a>';    
          echo '</td>';
         echo '</tr>';
          endwhile;
        ?>
        </tbody>
       </table>
    </section>
  </div>
 </div>
<?php include_once '../footer.php'; ?></div>
<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="../plugins/morris/morris.min.js"></script>
<script src="../plugins/fastclick/fastclick.js"></script>
<script src="../dist/js/app.min.js"></script>
<script src="../dist/js/demo.js"></script>
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>

<script>
  $(function () {
    $('#ModeloRelatorio').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true
    });
  });
</script>
<script>
  $(function () {

Morris.Donut({
  element: 'quantUserDonut',
  resize: true,
  colors: ["#00a65a", "#f56954"],
  data: [
    {label: "Finalizados", value: <?php echo $QtAtendFinal; ?>},
    {label: "pendentes", value: <?php echo $QtAtendPendente; ?>}
  ],
  hideHover: 'auto'

});
Morris.Donut({
  element: 'quantGerDonut',
  resize: true,
  colors: ["#063951", "#f36f13"],
  data: [
    {label: "Finalizados", value: <?php echo $QtAtendFinal; ?>},
    {label: "pendentes", value: <?php echo $QtAtendpendente; ?>}
  ],
  hideHover: 'auto'

});
  });
</script>



</body>
</html>