<?php
require("../restritos.php"); 
require_once '../init.php';
$Revenda = $_GET['revenda'];
$PDO = db_connect();
$PDO2 = db_connect();
require_once '../QueryUser.php';
$DataRelatorio = date('d/m/Y H:i:s');
$teste = "teste";


   $dFor = $PDO->prepare("SELECT * FROM lista_revenda WHERE RAZAO_SOCIAL='$Revenda'");
   $dFor->execute();
    $campo = $dFor->fetch();
    $idRevenda = $campo['EMPRESA_ID'];

	//CHAMANDO A QUANTIDADE DE ATENDIMENTOS TOTAIS 
  	$GeralAtende = "SELECT COUNT(*) FROM atendimento ";
  	 $qGeralAtende = $PDO->prepare($GeralAtende);
  	 $qGeralAtende->execute();
  	 $qtGeralAtende = $qGeralAtende->fetchColumn();



	//CHAMANDO A QUANTIDADE DE ATENDIMENTOS TOTAIS DA REVENDA
  	$AtendTotal = "SELECT COUNT(*) FROM atendimento WHERE Revenda='$Revenda'";
  	 $qAtendTotal = $PDO->prepare($AtendTotal);
  	 $qAtendTotal->execute();
  	 $qtAtendTotal = $qAtendTotal->fetchColumn();

	//CHAMANDO A QUANTIDADE DE ATENDIMENTOS TOTAIS DA REVENDA
  	$AtendPendente = "SELECT COUNT(*) FROM atendimento WHERE Revenda='$Revenda' AND Status='2'";
  	 $qAtendPendente = $PDO->prepare($AtendPendente);
  	 $qAtendPendente->execute();
  	 $qtAtendPendente = $qAtendPendente->fetchColumn();

  	 $qtAtendFinal = $qtAtendTotal - $qtAtendPendente;

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
 <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
<link href="../plugins/pizza/dist/css/pizza.css" media="screen, projector, print" rel="stylesheet" type="text/css" />

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="js/vendor/snap.svg.js"></script>
<script src="./plugins/pizza/dist/js/jquery.pizza.js"></script>


<script src="../plugins/chartist/chartist.min.js"></script>
<link href="../plugins/chartist/chartist.min.css" rel="stylesheet" type="text/css" />

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
       <h3 class="box-title">Relatório Geral de Revenda</h3>
       <small class="pull-right">Data do Relatório: <?php echo $DataRelatorio; ?> </small>
     </div>
     <div class="box-body">
      <div class="col-sm-4 invoice-col">
       <address>
        <h4>Revenda: </h4>
         <li class="list-group-item">
           <?php 
           echo $Revenda; 
           echo '<small class="pull-right">';
           echo '<a class="btn btn-default btn-xs" href="';
            echo "javascript:abrir('../revendas/vRevenda.php?ID=" . $idRevenda . "');";
            echo '"><i class="fa fa-search"></i></a>'; 
            echo '</small>';
           ?>
          </li>
         <h4>Relatório Emitido por: </h4>
          <li class="list-group-item">
           <?php echo $NomeUserLogado; ?>
          </li>
         <h4>Quantidade Total de Atendimentos: </h4>
          <li class="list-group-item">
           <code><?php echo $qtAtendTotal; ?></code>
          </li>
         <h4>Quantidade de Atendimentos Pendentes: </h4>
          <li class="list-group-item">
           <code><?php echo $qtAtendPendente; ?></code>
          </li>
       </address>
      </div>
      <div class="col-sm-4 invoice-col">
       <div class="box box-danger">
        <div class="box-header with-border">
         <h3 class="box-title">Atendimentos da Revenda</h3>
        </div>
        <div class="box-body chart-responsive">
         <div id="AtendimentosRevenda" style="height: 220px; width: 100%;"></div>
         <strong>PENDENTES:</strong>
         <span class="badge bg-red pull-right"><?php echo $qtAtendPendente; ?></span><br  />
         <strong>FINALIZADOS:</strong>
         <span class="badge bg-green pull-right"><?php echo $qtAtendFinal; ?></span>
        </div>
       </div>
      </div>
      <div class="col-sm-4 invoice-col">
       <div class="box box-danger">
        <div class="box-header with-border">
         <h3 class="box-title">Atendimentos da Revenda</h3>
        </div>
        <div class="box-body chart-responsive">
         <div id="AtendimentosGerais" style="height: 220px; width: 100%;"></div>
          <strong>ATENDIMENTOS DA REVENDA:</strong>
          <span class="badge bg-red pull-right"><?php echo $qtAtendTotal; ?></span><br  />
          <strong>TODOS OS ATENDIMENTOS:</strong>
          <span class="badge bg-green pull-right"><?php echo $qtGeralAtende; ?></span>
        </div>
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
      <table id="finalizadosUser" class="table table-hover table-striped table-responsive">
 <thead>
  <tr>
   <td>Cham.</td>
   <td>Modelo</td>
   <td>Revenda</td>
   <td>Técnico da Revenda</td>
   <td>Cadastro</td>
   <td>Atendente</td>
   <td></td>

  </tr>
 </thead>
 <tbody>
<tr>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
<td></td>
</tr>
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
<script src="../plugins/select2/select2.full.min.js"></script>

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
    $('#finalizadosUser').DataTable();
  });
</script>


	<script type="text/javascript">
window.onload = function () {
	var chart = new CanvasJS.Chart("AtendimentosRevenda",
	{
     animationEnabled: true,
     data: [
		{
					type: "doughnut",
					indexLabelFontFamily: "Helvetica",
					indexLabelFontSize: 15,
					startAngle: 130,
					indexLabelFontColor: "dimgrey",
					indexLabelLineColor: "darkgrey",
					toolTipContent: "{y} %",
			dataPoints: [
				{y: <?php echo $qtAtendFinal; ?>, indexLabel: "Finalizados #percent%", legendText: "Finalizados" },
				{y: <?php echo $qtAtendPendente; ?>, indexLabel: "Pendentes #percent%", legendText: "Pendentes" }
			]
		}
		]
	});
	chart.render();
	}
	</script>

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
					type: "doughnut",
					indexLabelFontFamily: "Helvetica",
					indexLabelFontSize: 15,
					startAngle: 11,
					indexLabelFontColor: "dimgrey",
					indexLabelLineColor: "darkgrey",
					toolTipContent: "{y} %",
					dataPoints: [
						{ y: 55, legendText: "Geral #percent%", indexLabel: "Geral #percent%" },
						{ y: 55, legendText: "Revenda #percent%", indexLabel: "Revenda #percent%" }
					]
				}

				]
			};
			$("#AtendimentosGerais").CanvasJSChart(options);
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
</body>
</html>