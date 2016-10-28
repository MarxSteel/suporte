<?php
require("../restritos.php"); 
require_once '../init.php';
$UsuarioCod = $_GET['usuario'];
$DataIni = $_GET['dtInicio'];       // DATA DE INICIO DA PESQUISA (DD/MM/AAAA)
$DataFim = $_GET['dtFinal'];          // DATA DE FIM DA PESQUISA (DD/MM/AAAA)
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

  //TRATANDO DATA FINAL
  $DataFinInt = explode("/",$DataFim);
  $DataFinal = $DataFinInt[2].'-'.$DataFinInt[1].'-'.$DataFinInt[0] . " 00:00:00";
  //TRATANDO DATA DE INÍCIO
  $DataIniInt = explode("/",$DataIni);
  $DataInicial = $DataIniInt[2].'-'.$DataIniInt[1].'-'.$DataIniInt[0] . " 00:00:00";

require_once 'queries/UserPeriodo.php';
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
  <link rel="stylesheet" href="../plugins/morris/morris.css">

</head>
<!--<body >-->
<body onload="window.print();">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
         Relatório de Atendimento periódico por Usuário
          <small class="pull-right">Data de emissão <?php echo $DataCorrigida; ?></small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
       <img src="../dist/img/logo/logoBlack.png" width="190">
       <li class="list-group-item">
        <strong>Emitido por: <br /></strong><?php echo $NomeUserLogado; ?>
       </li>
      </div>
      <div class="col-sm-4 invoice-col">
       <li class="list-group-item">
        <strong>Usuário: <br /></strong><?php echo $UNome; ?>
       </li>
       <li class="list-group-item">
        <strong>Tipo de Usuário: <br /></strong><?php echo $TipoUser; ?>
       </li>
      </div>
      <div class="col-sm-4 invoice-col">
       <li class="list-group-item">
        <strong>Data Inicio do Relatório: <br /></strong><?php echo $DataIni; ?>
       </li>
       <li class="list-group-item">
        <strong>Data Final do Relatório: <br /></strong><?php echo $DataFim; ?>
       </li>
      </div>
      <!-- /.col -->
    </div>
    <div class="row invoice-info">
      <div class="col-sm-6"><br /><br />
        <li class="list-group-item">
         <strong><h4>Atendimentos do Usuário: </h4><br /></strong>
         <div class="sparkline" align="center" data-type="pie" data-offset="90" data-width="200px" data-height="200px">
          <?php echo $QtAtendFinal; ?>,<?php echo $QtAtendPendente; ?>
         </div> 
          <strong>PENDENTES:</strong>
           <span class="badge bg-red pull-right">
            <?php echo $QtAtendPendente . ' - ' . $PorcentoUP . '%'; ?>
           </span><br  />
          <strong>FINALIZADOS:</strong>
           <span class="badge bg-green pull-right">
            <?php echo $QtAtendFinal . ' - ' . $PorcentoUF . '%'; ?>
           </span>         
        </li>
      </div>
      <div class="col-sm-6"><br /><br />
        <li class="list-group-item">
         <strong><h4>Atendimentos do Usuário: </h4><br /></strong>
         <div class="sparkline" align="center" data-type="pie" data-offset="90" data-width="200px" data-height="200px">
          <?php echo $GQtAtendFinal; ?>,<?php echo $GQtAtendPendente; ?>
         </div> 
         <strong>PENDENTES:</strong>
          <span class="badge bg-red pull-right">
           <?php echo $GQtAtendPendente; ?>
          </span><br  />
          <strong>FINALIZADOS:</strong>
          <span class="badge bg-green pull-right">
           <?php echo $GQtAtendFinal; ?>
          </span>      
        </li>
      </div>

      <!-- /.col -->
    </div>
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../bootstrap/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="../plugins/morris/morris.min.js"></script>
<!-- FastClick -->
<script src="../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>


<script src="../plugins/knob/jquery.knob.js"></script>
<!-- Sparkline -->
<script src="../plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- page script -->
<script>
  $(function () {
    /* jQueryKnob */

    $(".knob").knob({
      /*change : function (value) {
       //console.log("change : " + value);
       },
       release : function (value) {
       console.log("release : " + value);
       },
       cancel : function () {
       console.log("cancel : " + this.value);
       },*/
      draw: function () {

        // "tron" case
        if (this.$.data('skin') == 'tron') {

          var a = this.angle(this.cv)  // Angle
              , sa = this.startAngle          // Previous start angle
              , sat = this.startAngle         // Start angle
              , ea                            // Previous end angle
              , eat = sat + a                 // End angle
              , r = true;

          this.g.lineWidth = this.lineWidth;

          this.o.cursor
          && (sat = eat - 0.3)
          && (eat = eat + 0.3);

          if (this.o.displayPrevious) {
            ea = this.startAngle + this.angle(this.value);
            this.o.cursor
            && (sa = ea - 0.3)
            && (ea = ea + 0.3);
            this.g.beginPath();
            this.g.strokeStyle = this.previousColor;
            this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false);
            this.g.stroke();
          }

          this.g.beginPath();
          this.g.strokeStyle = r ? this.o.fgColor : this.fgColor;
          this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false);
          this.g.stroke();

          this.g.lineWidth = 2;
          this.g.beginPath();
          this.g.strokeStyle = this.o.fgColor;
          this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
          this.g.stroke();

          return false;
        }
      }
    });
    /* END JQUERY KNOB */

    //INITIALIZE SPARKLINE CHARTS
    $(".sparkline").each(function () {
      var $this = $(this);
      $this.sparkline('html', $this.data());
    });

    /* SPARKLINE DOCUMENTATION EXAMPLES http://omnipotent.net/jquery.sparkline/#s-about */
    drawDocSparklines();
    drawMouseSpeedDemo();

  });
  function drawDocSparklines() {

    // Bar + line composite charts
    $('#compositebar').sparkline('html', {type: 'bar', barColor: '#aaf'});
    $('#compositebar').sparkline([4, 1, 5, 7, 9, 9, 8, 7, 6, 6, 4, 7, 8, 4, 3, 2, 2, 5, 6, 7],
        {composite: true, fillColor: false, lineColor: 'red'});


    // Line charts taking their values from the tag
    $('.sparkline-1').sparkline();

    // Larger line charts for the docs
    $('.largeline').sparkline('html',
        {type: 'line', height: '2.5em', width: '4em'});

    // Customized line chart
    $('#linecustom').sparkline('html',
        {
          height: '1.5em', width: '8em', lineColor: '#f00', fillColor: '#ffa',
          minSpotColor: false, maxSpotColor: false, spotColor: '#77f', spotRadius: 3
        });

    // Bar charts using inline values
    $('.sparkbar').sparkline('html', {type: 'bar'});

    $('.barformat').sparkline([1, 3, 5, 3, 8], {
      type: 'bar',
      tooltipFormat: '{{value:levels}} - {{value}}',
      tooltipValueLookups: {
        levels: $.range_map({':2': 'Low', '3:6': 'Medium', '7:': 'High'})
      }
    });

    // Tri-state charts using inline values
    $('.sparktristate').sparkline('html', {type: 'tristate'});
    $('.sparktristatecols').sparkline('html',
        {type: 'tristate', colorMap: {'-2': '#fa7', '2': '#44f'}});

    // Composite line charts, the second using values supplied via javascript
    $('#compositeline').sparkline('html', {fillColor: false, changeRangeMin: 0, chartRangeMax: 10});
    $('#compositeline').sparkline([4, 1, 5, 7, 9, 9, 8, 7, 6, 6, 4, 7, 8, 4, 3, 2, 2, 5, 6, 7],
        {composite: true, fillColor: false, lineColor: 'red', changeRangeMin: 0, chartRangeMax: 10});

    // Line charts with normal range marker
    $('#normalline').sparkline('html',
        {fillColor: false, normalRangeMin: -1, normalRangeMax: 8});
    $('#normalExample').sparkline('html',
        {fillColor: false, normalRangeMin: 80, normalRangeMax: 95, normalRangeColor: '#4f4'});

    // Discrete charts
    $('.discrete1').sparkline('html',
        {type: 'discrete', lineColor: 'blue', xwidth: 18});
    $('#discrete2').sparkline('html',
        {type: 'discrete', lineColor: 'blue', thresholdColor: 'red', thresholdValue: 4});

    // Bullet charts
    $('.sparkbullet').sparkline('html', {type: 'bullet'});

    // Pie charts
    $('.sparkpie').sparkline('html', {type: 'pie', height: '1.0em'});

    // Box plots
    $('.sparkboxplot').sparkline('html', {type: 'box'});
    $('.sparkboxplotraw').sparkline([1, 3, 5, 8, 10, 15, 18],
        {type: 'box', raw: true, showOutliers: true, target: 6});

    // Box plot with specific field order
    $('.boxfieldorder').sparkline('html', {
      type: 'box',
      tooltipFormatFieldlist: ['med', 'lq', 'uq'],
      tooltipFormatFieldlistKey: 'field'
    });

    // click event demo sparkline
    $('.clickdemo').sparkline();
    $('.clickdemo').bind('sparklineClick', function (ev) {
      var sparkline = ev.sparklines[0],
          region = sparkline.getCurrentRegionFields();
      value = region.y;
      alert("Clicked on x=" + region.x + " y=" + region.y);
    });

    // mouseover event demo sparkline
    $('.mouseoverdemo').sparkline();
    $('.mouseoverdemo').bind('sparklineRegionChange', function (ev) {
      var sparkline = ev.sparklines[0],
          region = sparkline.getCurrentRegionFields();
      value = region.y;
      $('.mouseoverregion').text("x=" + region.x + " y=" + region.y);
    }).bind('mouseleave', function () {
      $('.mouseoverregion').text('');
    });
  }

  /**
   ** Draw the little mouse speed animated graph
   ** This just attaches a handler to the mousemove event to see
   ** (roughly) how far the mouse has moved
   ** and then updates the display a couple of times a second via
   ** setTimeout()
   **/
  function drawMouseSpeedDemo() {
    var mrefreshinterval = 500; // update display every 500ms
    var lastmousex = -1;
    var lastmousey = -1;
    var lastmousetime;
    var mousetravel = 0;
    var mpoints = [];
    var mpoints_max = 30;
    $('html').mousemove(function (e) {
      var mousex = e.pageX;
      var mousey = e.pageY;
      if (lastmousex > -1) {
        mousetravel += Math.max(Math.abs(mousex - lastmousex), Math.abs(mousey - lastmousey));
      }
      lastmousex = mousex;
      lastmousey = mousey;
    });
    var mdraw = function () {
      var md = new Date();
      var timenow = md.getTime();
      if (lastmousetime && lastmousetime != timenow) {
        var pps = Math.round(mousetravel / (timenow - lastmousetime) * 1000);
        mpoints.push(pps);
        if (mpoints.length > mpoints_max)
          mpoints.splice(0, 1);
        mousetravel = 0;
        $('#mousespeed').sparkline(mpoints, {width: mpoints.length * 2, tooltipSuffix: ' pixels per second'});
      }
      lastmousetime = timenow;
      setTimeout(mdraw, mrefreshinterval);
    };
    // We could use setInterval instead, but I prefer to do it this way
    setTimeout(mdraw, mrefreshinterval);
  }
</script>


</body>
</html>
