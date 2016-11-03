<?php
require("../restritos.php"); 
require_once '../init.php';
$Revenda = $_GET['revenda'];
$PDO = db_connect();
$PDO2 = db_connect();
require_once '../QueryUser.php';
$DataRelatorio = date('d/m/Y H:i:s');
$teste = "teste";


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
            <small class="pull-right">Data do Relatório: <?php echo $DataRelatorio; ?> </small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <div class="row invoice-info">
       <div class="col-sm-4 invoice-col">
        <address>
         <h4>Revenda: </h4>
          <li class="list-group-item">
           <?php 
           echo $Revenda; 
           echo '<small class="pull-right">';
			echo '<a class="btn btn-default btn-xs" href="';
            echo "javascript:abrir('../revendas/vRevenda.php?ID=" . $Revenda . "');";
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
			 <div id="chartContainer1" style="height: 255px; width: 100%;">
     		</div>
            <!-- /.box-body -->
          </div>
        </div>
        </div>
       <div class="col-sm-4 invoice-col">
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Atendimentos da Revenda</h3>
            </div>
            <div class="box-body chart-responsive">
			 <div id="chartContainer2" style="height: 255px; width: 100%;">
     		</div>
            <!-- /.box-body -->
          </div>
        </div>
        </div>
      </div>
      <h3> Resumo dos chamados no período selecionado </h3>
      <!-- AQUI COMEÇA A TABELA DE LISTA DOS CHAMADOS REALIZADOS NO PERÍODO -->
      <!-- QUERY DE BUSCA DOS CHAMADOS -->
       <?php
        $ChamaChamados = "SELECT * FROM atendimento WHERE Revenda='$Revenda'";
        $ChChama = $PDO->prepare($ChamaChamados);
        $ChChama->execute();
       ?>
       <table id="ModeloRelatorio" class="table table-hover table-striped table-responsive">
        <thead>
         <tr>
          <td>Cham.</td>
          <td>Equipamento</td>
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
          echo '<td>' . $chamadosChamados["Equip"] . '</td>';
          echo '<td>' . $chamadosChamados["RevendaTecnico"] . '</td>'; 
          echo '<td>' . $chamadosChamados["UserAtendente"] . '</td>';   
          echo '<td>' . $chamadosChamados["DescSolicita"] . '</td>';   
          echo '<td>' . $chamadosChamados["DataCadastro"] . '</td>';
          echo '<td>';
           echo '<a class="btn btn-default btn-xs" href="';
           echo "javascript:abrir('../atendimento/Visualizar.php?ID=" . $chamadosChamados["id"] . "');";
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
<script src="../plugins/fastclick/fastclick.js"></script>
<script src="../dist/js/app.min.js"></script>
<script src="../dist/js/demo.js"></script>
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<script src="../plugins/canvas/jquery.canvasjs.min.js"></script>
<script src="../plugins/canvas/canvasjs.min.js"></script>
	<script type="text/javascript">
		window.onload = function () {
			var chart = new CanvasJS.Chart("chartContainer", {
				animationEnabled: true,
				theme: "theme5",
				data: [
				{
					type: "doughnut",
					indexLabelFontFamily: "Helvetica",
					indexLabelFontSize: 15,
					startAngle: 0,
					toolTipContent: "{y} %",
					dataPoints: [
					{ y: 51.04, indexLabel: "Finalizados {y}%" },
					{ y: 40.83, indexLabel: "Pendentes {y}%" }
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
				zoomEnabled: true,
				animationEnabled: true,
				title: {
					text: "Fertility Rate Vs Life Expectancy in different countries - 2009"
				},
				axisX: {
					title: "Life Expectancy",
					maximum: 85
				},
				axisY: {
					title: "Fertility Rate"

				},

				legend: {
					verticalAlign: "bottom",
					horizontalAlign: "left"

				},
				data: [
				{
					type: "bubble",
					legendText: "Size of Bubble Represents Population",
					showInLegend: true,
					legendMarkerType: "circle",
					legendMarkerColor: "grey",
					toolTipContent: "<span style='\"'color: {color};'\"'><strong>{name}</strong></span><br/><strong>Life Exp</strong> {x} yrs<br/> <strong>Fertility Rate</strong> {y}<br/> <strong>Population</strong> {z}mn",

					dataPoints: [
					 { x: 78.1, y: 2.00, z: 306.77, name: "US" },
					 { x: 68.5, y: 2.15, z: 237.414, name: "Indonesia" },
					 { x: 72.5, y: 1.86, z: 193.24, name: "Brazil" },
					 { x: 76.5, y: 2.36, z: 112.24, name: "Mexico" },
					 { x: 50.9, y: 5.56, z: 154.48, name: "Nigeria" },
					 { x: 68.6, y: 1.54, z: 141.91, name: "Russia" },
					 { x: 82.9, y: 1.37, z: 127.55, name: "Japan" },
					 { x: 79.8, y: 1.36, z: 81.90, name: "Australia" },
					 { x: 72.7, y: 2.78, z: 79.71, name: "Egypt" },
					 { x: 80.1, y: 1.94, z: 61.81, name: "UK" },
					 { x: 55.8, y: 4.76, z: 39.24, name: "Kenya" },
					 { x: 81.5, y: 1.93, z: 21.95, name: "Australia" },
					 { x: 68.1, y: 4.77, z: 31.09, name: "Iraq" },
					 { x: 47.9, y: 6.42, z: 33.42, name: "Afganistan" },
					 { x: 50.3, y: 5.58, z: 18.55, name: "Angola" }


					]
				}
				]
			};
			$("#chartContainer1").CanvasJSChart(options);
		});

		$(function () {
			//Better to construct options first and then pass it as a parameter
			var options = {
				title: {
					text: "Email Analysis"
				},
				animationEnabled: true,
				axisX: {
					interval: 3
				},
				axisY: {
					title: "Number of Messages"
				},
				legend: {
					verticalAlign: "bottom",
					horizontalAlign: "center"
				},

				data: [{
					name: "received",
					showInLegend: true,
					legendMarkerType: "square",
					type: "area",
					color: "rgba(40,175,101,0.6)",
					markerSize: 0,

					dataPoints: [
					{ x: new Date(2013, 0, 1, 00, 00), label: "midnight", y: 7 },
					{ x: new Date(2013, 0, 1, 01, 00), y: 8 },
					{ x: new Date(2013, 0, 1, 02, 00), y: 5 },
					{ x: new Date(2013, 0, 1, 03, 00), y: 7 },
					{ x: new Date(2013, 0, 1, 04, 00), y: 6 },
					{ x: new Date(2013, 0, 1, 05, 00), y: 8 },
					{ x: new Date(2013, 0, 1, 06, 00), y: 12 },
					{ x: new Date(2013, 0, 1, 07, 00), y: 24 },
					{ x: new Date(2013, 0, 1, 08, 00), y: 36 },
					{ x: new Date(2013, 0, 1, 09, 00), y: 35 },
					{ x: new Date(2013, 0, 1, 10, 00), y: 37 },
					{ x: new Date(2013, 0, 1, 11, 00), y: 29 },
					{ x: new Date(2013, 0, 1, 12, 00), y: 34, label: "noon" },
					{ x: new Date(2013, 0, 1, 13, 00), y: 38 },
					{ x: new Date(2013, 0, 1, 14, 00), y: 23 },
					{ x: new Date(2013, 0, 1, 15, 00), y: 31 },
					{ x: new Date(2013, 0, 1, 16, 00), y: 34 },
					{ x: new Date(2013, 0, 1, 17, 00), y: 29 },
					{ x: new Date(2013, 0, 1, 18, 00), y: 14 },
					{ x: new Date(2013, 0, 1, 19, 00), y: 12 },
					{ x: new Date(2013, 0, 1, 20, 00), y: 10 },
					{ x: new Date(2013, 0, 1, 21, 00), y: 8 },
					{ x: new Date(2013, 0, 1, 22, 00), y: 13 },
					{ x: new Date(2013, 0, 1, 23, 00), y: 11 }
					]
				},
				{
					name: "sent",
					showInLegend: true,
					legendMarkerType: "square",
					type: "area",
					color: "rgba(0,75,141,0.7)",
					markerSize: 0,
					label: "",
					dataPoints: [

					{ x: new Date(2013, 0, 1, 00, 00), label: "midnight", y: 12 },
					{ x: new Date(2013, 0, 1, 01, 00), y: 10 },
					{ x: new Date(2013, 0, 1, 02, 00), y: 3 },
					{ x: new Date(2013, 0, 1, 03, 00), y: 5 },
					{ x: new Date(2013, 0, 1, 04, 00), y: 2 },
					{ x: new Date(2013, 0, 1, 05, 00), y: 1 },
					{ x: new Date(2013, 0, 1, 06, 00), y: 3 },
					{ x: new Date(2013, 0, 1, 07, 00), y: 6 },
					{ x: new Date(2013, 0, 1, 08, 00), y: 14 },
					{ x: new Date(2013, 0, 1, 09, 00), y: 15 },
					{ x: new Date(2013, 0, 1, 10, 00), y: 21 },
					{ x: new Date(2013, 0, 1, 11, 00), y: 24 },
					{ x: new Date(2013, 0, 1, 12, 00), y: 28, label: "noon" },
					{ x: new Date(2013, 0, 1, 13, 00), y: 26 },
					{ x: new Date(2013, 0, 1, 14, 00), y: 17 },
					{ x: new Date(2013, 0, 1, 15, 00), y: 23 },
					{ x: new Date(2013, 0, 1, 16, 00), y: 28 },
					{ x: new Date(2013, 0, 1, 17, 00), y: 22 },
					{ x: new Date(2013, 0, 1, 18, 00), y: 10 },
					{ x: new Date(2013, 0, 1, 19, 00), y: 9 },
					{ x: new Date(2013, 0, 1, 20, 00), y: 6 },
					{ x: new Date(2013, 0, 1, 21, 00), y: 4 },
					{ x: new Date(2013, 0, 1, 22, 00), y: 12 },
					{ x: new Date(2013, 0, 1, 23, 00), y: 14 }
					]
				}
				]
			};
			$("#chartContainer2").CanvasJSChart(options);
		});

		$(function () {
			//Better to construct options first and then pass it as a parameter
			var options = {
				title: {
					text: "Cumulative App downloads on iTunes And Play Store"
				},
				animationEnabled: true,
				axisY: {
					includeZero: false,
					maximum: 110000,
					valueFormatString: "#0,.",
					suffix: " k"
				},
				axisX: {
					title: "Months After Launch"
				},
				toolTip: {
					shared: true,
					content: "<span style='\"'color: {color};'\"'><strong>{name}</strong></span> {y}"
				},

				data: [
				{
					type: "splineArea",
					showInLegend: true,
					name: "iOS",
					dataPoints: [
					{ x: 1, y: 3000 },
					{ x: 2, y: 7000 },
					{ x: 3, y: 10000 },
					{ x: 4, y: 14000 },
					{ x: 5, y: 23000 },
					{ x: 6, y: 31000 },
					{ x: 7, y: 42000 },
					{ x: 8, y: 56000 },
					{ x: 9, y: 64000 },
					{ x: 10, y: 81000 },
					{ x: 11, y: 105000 }
					]
				},
				{
					type: "splineArea",
					name: "Android",
					showInLegend: true,
					dataPoints: [
					{ x: 4, y: 4000 },
					{ x: 5, y: 6000 },
					{ x: 6, y: 9000 },
					{ x: 7, y: 14000 },
					{ x: 8, y: 21000 },
					{ x: 9, y: 31000 },
					{ x: 10, y: 46000 },
					{ x: 11, y: 61000 }

					]
				}
				]
			};
			$("#chartContainer3").CanvasJSChart(options);
		});

		$(function () {
			//Better to construct options first and then pass it as a parameter
			var options = {
				title: {
					text: "Gaming Consoles Sold in 2012"
				},
				animationEnabled: true,
				legend: {
					verticalAlign: "bottom",
					horizontalAlign: "center"
				},
				data: [
				{
					type: "pie",
					showInLegend: true,
					toolTipContent: "{y} - <strong>#percent%</strong>",
					dataPoints: [
						{ y: 4181563, legendText: "PS 3", indexLabel: "PlayStation 3" },
						{ y: 2175498, legendText: "Wii", indexLabel: "Wii" },
						{ y: 3125844, legendText: "360", exploded: true, indexLabel: "Xbox 360" },
						{ y: 1176121, legendText: "DS", indexLabel: "Nintendo DS" },
						{ y: 1727161, legendText: "PSP", indexLabel: "PSP" },
						{ y: 4303364, legendText: "3DS", indexLabel: "Nintendo 3DS" },
						{ y: 1717786, legendText: "Vita", indexLabel: "PS Vita" }
					]
				}
				]
			};
			$("#chartContainer4").CanvasJSChart(options);
		});
	</script>

	
</body>
</html>