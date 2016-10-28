<?php
require("../restritos.php"); 
require_once '../init.php';
$UsuarioCod = $_GET['usuario'];
$DataInicio = $_GET['dtInicio'];				// DATA DE INICIO DA PESQUISA (DD/MM/AAAA)
$DataFinal = $_GET['dtFinal'];					// DATA DE FIM DA PESQUISA (DD/MM/AAAA)
$PDO = db_connect();
require_once '../QueryUser.php';
$DataRelatorio = date('Y-m-d H:i:s');
$DataCorrigida = date('d/m/Y H:i:s', strtotime($DataRelatorio));



$DadosUSR = $PDO->prepare("SELECT * FROM login WHERE Nome='$UsuarioCod'");
$DadosUSR->execute();
$Qryusr = $DadosUSR->fetch();
$UNome = $Qryusr['Nome'];
$ULogin = $Qryusr['login'];
$UTipo = $Qryusr['Tipo'];
  if ($UTipo === "1") {
    $TipoUser = "Atendente";
  }
  elseif ($UTipo === "2") {
    $TipoUser = "Gestor";
  }
  elseif ($UTipo === "3") {
    $TipoUser = "Administrador";
  }


  //PREPARANDO A DATA INICIAL:
  $DataInicial = $DataInicio . ' 00:00:00';
	$DtInicio date('Y-m-d H:i:s', strtotime($DataInicial)); // Convertendo para o padrão americano

  $DataFinal = $DataFinal . ' 00:00:00';
	$DtFinal = date_format($DataFinal, 'Y-m-d H:i:s');

  $AtendFinalizado = "SELECT COUNT(*) FROM atendimento WHERE UserAtendente='$UsuarioCod' AND Status='1' AND DataCadastro BETWEEN '$DtInicio' AND '$DtFinal'";
 		$AtFin = $PDO->prepare($AtendFinalizado);
 		$AtFin->execute();
 		$QtAtendFinal = $AtFin->fetchColumn();



//CHAMANDO QUANTIDADE DE ATENDIMENTOS FINALIZADOS
$AtendPendente = "SELECT count(*) FROM atendimento WHERE Status='2' AND UserAtendente='$UsuarioCod'";
 $AtPen = $PDO->prepare($AtendPendente);
 $AtPen->execute();
 $QtAtendPendente = $AtPen->fetchColumn();
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
        <span class="hidden-xs">Olá, <?php echo $QtAtendFinal; ?></span></a>
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
            <small class="pull-right">Data do Relatório: <?php echo $DataCorrigida; ?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <div class="row invoice-info">

       <div class="col-sm-4 invoice-col">
        <address>
        <h4><strong>Usuário:</strong> <br /> <?php echo $UNome; ?></h4>
        <strong>Tipo de Usuário: </strong><br /> <?php echo $TipoUser; ?>
        </address>
       </div>
        <div class="col-sm-4 invoice-col">
         <div class="box box-danger">
          <div class="box-header with-border">
            <h3 class="box-title">Quantidade de Atendimentos</h3>
            </div>
            <div class="box-body">
             <canvas id="pieChart" style="height:250px"></canvas>
             <strong>PENDENTES:</strong><span class="badge bg-red pull-right"><?php echo $QtAtendPendente; ?></span><br  />
             <strong>FINALIZADOS:</strong><span class="badge bg-green pull-right"><?php echo $QtAtendFinal; ?></span>
            </div>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
         <div class="box box-danger">
          <div class="box-header with-border">
            <h3 class="box-title">Quantidade de Atendimentos</h3>
            </div>
            <div class="box-body">
             <canvas id="pieChart2" style="height:250px"></canvas>
             <strong>PENDENTES:</strong><span class="badge bg-red pull-right"><?php echo $QtAtendPendente; ?></span><br  />
             <strong>FINALIZADOS:</strong><span class="badge bg-green pull-right"><?php echo $QtAtendFinal; ?></span>
            </div>
          </div>
        </div>
        <!-- /.col -->
      </div>
    </section>
    <section class="content">
     <div class="box box-default">
     <div class="box-header with-border">
     </div>
     <div class="box-body">
     </div>
    </section>
  </div>
 </div>
<?php include_once '../footer.php'; ?></div>
<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../dist/js/app.min.js"></script>
<script src="../plugins/chartjs/Chart.min.js"></script>

<script>
  $(function () {
    var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
    var pieChart = new Chart(pieChartCanvas);
    var PieData = [
      {
        value: <?php echo $QtAtendPendente; ?>,
        color: "#f56954",
        highlight: "#f56954",
        label: "Não Finalizados"
      },
      {
        value: <?php echo $QtAtendFinal; ?>,
        color: "#00a65a",
        highlight: "#00a65a",
        label: "Finalizados"
      }
    ];
    var pieOptions = {
      //Boolean - Whether we should show a stroke on each segment
      segmentShowStroke: true,
      //String - The colour of each segment stroke
      segmentStrokeColor: "#fff",
      //Number - The width of each segment stroke
      segmentStrokeWidth: 2,
      //Number - The percentage of the chart that we cut out of the middle
      percentageInnerCutout: 50, // This is 0 for Pie charts
      //Number - Amount of animation steps
      animationSteps: 100,
      //String - Animation easing effect
      animationEasing: "easeOutBounce",
      //Boolean - Whether we animate the rotation of the Doughnut
      animateRotate: true,
      //Boolean - Whether we animate scaling the Doughnut from the centre
      animateScale: true,
      //Boolean - whether to make the chart responsive to window resizing
      responsive: true,
      // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio: true,
      //String - A legend template
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
    };
    pieChart.Doughnut(PieData, pieOptions);
  });
</script>
<script>
  $(function () {
    var pieChartCanvas2 = $("#pieChart").get(0).getContext("2d");
    var pieChart2 = new Chart(pieChartCanvas2);
    var PieData2 = [
      {
        value: <?php echo $QtAtendPendente; ?>,
        color: "#f56954",
        highlight: "#f56954",
        label: "Não Finalizados"
      },
      {
        value: <?php echo $QtAtendFinal; ?>,
        color: "#00a65a",
        highlight: "#00a65a",
        label: "Finalizados"
      }
    ];
    var pieOptions2 = {
      //Boolean - Whether we should show a stroke on each segment
      segmentShowStroke: true,
      //String - The colour of each segment stroke
      segmentStrokeColor: "#fff",
      //Number - The width of each segment stroke
      segmentStrokeWidth: 2,
      //Number - The percentage of the chart that we cut out of the middle
      percentageInnerCutout: 50, // This is 0 for Pie charts
      //Number - Amount of animation steps
      animationSteps: 100,
      //String - Animation easing effect
      animationEasing: "easeOutBounce",
      //Boolean - Whether we animate the rotation of the Doughnut
      animateRotate: true,
      //Boolean - Whether we animate scaling the Doughnut from the centre
      animateScale: true,
      //Boolean - whether to make the chart responsive to window resizing
      responsive: true,
      // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio: true,
      //String - A legend template
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
    };
    pieChart2.Doughnut(PieData2, pieOptions2);
  });
</script>




</body>
</html>