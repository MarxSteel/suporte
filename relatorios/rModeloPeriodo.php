<?php
require("../restritos.php"); 
require_once '../init.php';
$Modelo = $_GET['modelo2'];
$DataIni = $_GET['dtInicio'];       // DATA DE INICIO DA PESQUISA (DD/MM/AAAA)
$DataFim = $_GET['dtFinal'];          // DATA DE FIM DA PESQUISA (DD/MM/AAAA)

$PDO = db_connect();
require_once '../QueryUser.php';
$DataRelatorio = date('d/m/Y H:i:s');


  //TRATANDO DATA FINAL
  $DataFinInt = explode("/",$DataFim);
  $DataFinal = $DataFinInt[2].'-'.$DataFinInt[1].'-'.$DataFinInt[0] . " 00:00:00";
  //TRATANDO DATA DE INÍCIO
  $DataIniInt = explode("/",$DataIni);
  $DataInicial = $DataIniInt[2].'-'.$DataIniInt[1].'-'.$DataIniInt[0] . " 00:00:00";

	//CHAMANDO A QUANTIDADE DE ATENDIMENTOS TOTAIS 
  	$GeralAtende = "SELECT COUNT(*) FROM atendimento WHERE DataCadastro BETWEEN '$DataInicial' AND '$DataFinal'";
  	 $qGeralAtende = $PDO->prepare($GeralAtende);
  	 $qGeralAtende->execute();
  	 $qtGeralAtende = $qGeralAtende->fetchColumn();

  //CHAMANDO A QUANTIDADE DE ATENDIMENTOS TOTAIS  APENAS DO MODELO
    $ModeloAtende = "SELECT COUNT(*) FROM atendimento WHERE Equip='$Modelo' AND DataCadastro BETWEEN '$DataInicial' AND '$DataFinal'";
     $qModeloAtende = $PDO->prepare($ModeloAtende);
     $qModeloAtende->execute();
     $qtModeloAtende = $qModeloAtende->fetchColumn();

  //QUANTIDADE DE ATENDIMENTOS COM RETORNO DE ASSISTENCIA
    $AtendRetorno = "SELECT COUNT(*) FROM atendimento WHERE Equip='$Modelo' AND TipoAtendimento='2' AND DataCadastro BETWEEN '$DataInicial' AND '$DataFinal'";
     $qAtendRetorno = $PDO->prepare($AtendRetorno);
     $qAtendRetorno->execute();
     $qtAtendRetorno = $qAtendRetorno->fetchColumn();






?>
<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <title>Henry Equipamentos e Sistemas</title>
 <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
 <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
 <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
 <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
 <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
<link href="../plugins/pizza/dist/css/pizza.css" media="screen, projector, print" rel="stylesheet" type="text/css" />

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
 <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">

 <link rel="stylesheet" href="../plugins/iCheck/flat/blue.css">

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
 <section class="content">
  <div class="row">
   <div class="col-md-12">
    <div class="box box-primary">
     <div class="box-header">
      <i class="ion ion-clipboard"></i>
       <h3 class="box-title">Relatório Geral de Modelo</h3>
       <small class="pull-right">Data do Relatório: <?php echo $DataRelatorio; ?> </small>
     </div>
     <div class="box-body">
      <div class="col-sm-4 invoice-col">
       <address>
        <h4>Modelo: </h4>
         <li class="list-group-item">
           <?php 
           echo $Modelo; 
           ?>
          </li>
         <h4>Relatório Emitido por: </h4>
          <li class="list-group-item">
           <?php echo $NomeUserLogado; ?>
          </li>
         <h4>Quantidade Total de Atendimentos: </h4>
          <li class="list-group-item">
           <code><?php echo $qtGeralAtende; ?></code>
          </li>
         <h4>Atendimentos para o Modelo: </h4>
          <li class="list-group-item">
           <code><?php echo $qtModeloAtende; ?></code>
          </li>
       </address>
      </div>
      <div class="col-sm-4 invoice-col">
       <div class="box box-danger">
        <div class="box-header with-border">
         <h3 class="box-title">Atendimentos do Equipamento</h3>
        </div>
        <div class="box-body chart-responsive">
         <div id="chartContainer1" style="width: 100%; height: 400px;display: inline-block;"></div>
        </div>

         <strong>ATENDIMENTOS DO MODELO:</strong>
         <span class="badge bg-red pull-right"><?php echo $qtModeloAtende; ?></span><br  />
         <strong>TODOS ATENDIMENTOS:</strong>
         <span class="badge bg-green pull-right"><?php echo $qtGeralAtende; ?></span>
       </div>
      </div>
      <div class="col-sm-4 invoice-col">
       <div class="box box-danger">
        <div class="box-header with-border">
         <h3 class="box-title">Retorno de Assistência</h3>
        </div>
        <div class="box-body chart-responsive">
  <div id="chartContainer2" style="width: 100%; height: 400px;display: inline-block;"></div>
        </div>
          <strong>ATENDIMENTOS COM RETORNO:</strong>
          <span class="badge bg-red pull-right"><?php echo $qtAtendRetorno; ?></span><br  />
          <strong>TODOS OS ATENDIMENTOS:</strong>
          <span class="badge bg-green pull-right"><?php echo $qtGeralAtende; ?></span>
       </div>
      </div>
     </div>
    </div>
   </div>
  </div><!-- CLASS ROW -->
 </section>
 <section class="content">
  <div class="row">
   <div class="col-md-12">
    <div class="box box-primary">
     <div class="box-header">
      <i class="ion ion-clipboard"></i>
       <h3 class="box-title">Lista de Atendimentos</h3>
     </div>
     <div class="box-body">
      <?php
      $PUsr = "SELECT * FROM atendimento WHERE Equip='$Modelo' AND DataCadastro BETWEEN '$DataInicial' AND '$DataFinal'";
      $PU = $PDO->prepare($PUsr);
      $PU->execute();
      ?>
      <table id="revenda" class="table table-hover table-responsive" cellspacing="0" width="100%">
       <thead>
        <tr>
         <td>Cham.</td> 
         <td>Status</td>
         <td>Modelo</td>
         <td>Revenda</td>
         <td>Técnico da Revenda</td>
         <td>Cadastro</td>
         <td>Atendente</td>
         <td></td>
        </tr>
       </thead>
       <tbody>
       <?php while ($PUser = $PU->fetch(PDO::FETCH_ASSOC)): 
        echo '<tr>';
        echo '<td>' . $PUser["id"] . '</td>';
         $StatusAtend = $PUser["Status"];
         if ($StatusAtend === "1") {
         echo '<td><span class="badge bg-green">FINALIZADO</span></td>';
         }
         elseif ($StatusAtend === "2") {
         echo '<td><span class="badge bg-red">PENDENTE</span></td>';
         }
         else{
          echo '<td></td>';
         }
         echo '<td><span class="badge bg-blue">' . $PUser["Equip"] . '</span></td>';
         echo '<td>' . $PUser["Revenda"] . '</td>';   
         echo '<td>' . $PUser["RevendaTecnico"] . '</td>';   
         echo '<td>' . $PUser["DescSolicita"] . '</td>';   
         echo '<td>' . $PUser["UserAtendente"] . '</td>';
         echo '<td>';
          echo '<a class="btn btn-default btn-xs" href="';
          echo "javascript:abrir('../atendimento/Visualizar.php?ID=" . $PUser["id"] . "');";
          echo '"><i class="fa fa-search"></i></a>';  
         echo '</td>';
        echo '</tr>';
        endwhile;
        ?>
       </tbody>
      </table>
     </div>
    </div>
   </div>
  </div><!-- CLASS ROW -->
 </section>
  </div>
 </div>
<?php include_once '../footer.php'; ?></div>
<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../plugins/fastclick/fastclick.js"></script>
<script src="../dist/js/app.min.js"></script>
<script src="../dist/js/demo.js"></script>
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="../plugins/canvas/jquery.canvasjs.min.js"></script>
<script src="../plugins/canvas/canvasjs.min.js"></script>


<script type="text/javascript">
    $(function () {
      //Better to construct options first and then pass it as a parameter
      var options = {
        animationEnabled: true,
        legend: {
          verticalAlign: "bottom",
          horizontalAlign: "center"
        },
        data: [
        {
          type: "pie",
                    startAngle: 90,

          showInLegend: false,
          toolTipContent: "{y} - <strong>#percent%</strong>",
          dataPoints: [
            { y: <?php echo $qtModeloAtende; ?>, legendText: "Modelo", exploded: true, indexLabel: "Modelos #percent%" },
            { y: <?php echo $qtGeralAtende; ?>, legendText: "Todos os Modelos", indexLabel: "Todos os Modelos #percent%" }
          ]

        }
        ]
      };
      $("#chartContainer1").CanvasJSChart(options);
    });

    $(function () {
      //Better to construct options first and then pass it as a parameter
      var options = {
        animationEnabled: true,
        legend: {
          verticalAlign: "bottom",
          horizontalAlign: "center"
        },
        data: [
        {
          type: "pie",
                    startAngle: 90,

          showInLegend: false,
          toolTipContent: "{y} - <strong>#percent%</strong>",
          dataPoints: [
            { y: <?php echo $qtGeralAtende; ?>, legendText: "Geral", exploded: true, indexLabel: "Geral #percent%" },
            { y: <?php echo $qtAtendRetorno; ?>, legendText: "Retorno", indexLabel: "Retorno #percent%" }
          ]
        }
        ]
      };
      $("#chartContainer2").CanvasJSChart(options);
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
    $('#revenda').DataTable({
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
</body>
</html>