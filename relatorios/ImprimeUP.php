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
      <!-- /.col -->
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

    <!-- /.row -->
    <div class="row"><br /><br /></div>
    <div class="row">
           <div class="row invoice-info">




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

<script>
  $(function () {
/*
 * Play with this code and it'll update in the panel opposite.
 *
 * Why not try some of the options above?
 */
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
    {label: "Finalizados", value: <?php echo $GQtAtendFinal; ?>},
    {label: "pendentes", value: <?php echo $GQtAtendPendente; ?>}
  ],
  hideHover: 'auto'

});
  });
</script>



</body>
</html>
