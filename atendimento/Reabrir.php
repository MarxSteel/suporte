<?php
 require("../restritos.php"); 
 require_once '../init.php';
 $PDO = db_connect();
require_once '../QueryUser.php';
   $id = $_GET['ID'];
   $dFor = $PDO->prepare("SELECT * FROM atendimento WHERE id='$id'");
   $dFor->execute();
    $campo = $dFor->fetch();
    $Resumo = $campo['DescAtend'];
    $Revenda = $campo['Revenda'];
    $RevendaTecnico = $campo['RevendaTecnico'];
    $DataCadastro = $campo['DataCadastro'];
    $UserAtendente = $campo['UserAtendente'];
    $UserCadastro = $campo['UserCadastro'];
    $DescSolicita = $campo['DescSolicita'];
    $DescAtend = $campo['DescAtend'];
    $TipoAtendimento = $campo['TipoAtendimento'];
     if ($TipoAtendimento === "1") {
       $Retorno = '<button class="btn btn-success btn-block btn-xs">N&Atilde;O</button>';
     }
     elseif ($TipoAtendimento === "2") {
       $Retorno = '<button class="btn btn-danger btn-block btn-xs">SIM</button>';
     }
     else{

     }
    $Status = $campo['Status'];
    if ($Status === "1") {
       $RStatus = '<button class="btn btn-success btn-block btn-xs">FINALIZADO</button>';
     }
     elseif ($Status === "2") {
       $RStatus = '<button class="btn btn-danger btn-block btn-xs">PENDENTE</button>';
     }
     else{

     }
        $ChamaUser = "SELECT * FROM login WHERE Tipo='1'  ";
         $USR = $PDO->prepare($ChamaUser);
         $USR->execute();
?>
<!DOCTYPE html>
<html>
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <meta http-equiv="Content-Language" content="pt-br">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $Titulo; ?></title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="../plugins/iCheck/flat/blue.css">
  <link rel="stylesheet" href="../plugins/morris/morris.css">
  <link rel="stylesheet" href="../plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<style type="text/css">
.texto {
word-wrap: break-word;
}
</style>
</head>
<body class="hold-transition <?php echo $cor; ?> layout-top-nav">
<div class="wrapper">
 <header class="main-header">
  <nav class="navbar navbar-static-top">
   <div class="container">
    <div class="navbar-header">
     <img src="../dist/img/logo/logoWhite.png" width="150" />
    </div>
    <div class="navbar-custom-menu">
     <ul class="nav navbar-nav">
      <li class="dropdown user user-menu">
       <a href="../#" class="dropdown-toggle" data-toggle="dropdown">
        <span class="hidden-xs">Ol&aacute;, <?php echo $NomeUserLogado; ?></span>
       </a>
      </li>
     </ul>
    </div>
   </div>
  </nav>
 </header>
 <div class="content-wrapper">
  <div class="container">
   <section class="content">
    <div class="box box-default">
     <div class="box-body">
      <div class="col-xs-4">REVENDA
       <li class="list-group-item">
        <?php echo utf8_encode($Revenda); ?>
       </li>
      </div>
      <div class="col-xs-4">TÉCNICO RESPONSÁVEL (REVENDA)
       <li class="list-group-item">
       <?php echo utf8_encode($RevendaTecnico); ?>
       </li>
      </div>
      <div class="col-xs-4">DATA DE CADASTRO
       <li class="list-group-item">
        <?php echo $DataCadastro; ?>
       </li>
      </div>
      <div class="col-xs-3">USER. ATENDENTE
       <li class="list-group-item">
       <?php echo utf8_encode($UserAtendente); ?>
       </li>
      </div>
      <div class="col-xs-3">USER. CADASTRO
       <li class="list-group-item">
       <?php echo utf8_encode($UserCadastro); ?>
       </li>
      </div>
      <div class="col-xs-3">RETORNO DE ASSIST&EcircNCIA
       <li class="list-group-item">
       <?php echo utf8_encode($Retorno); ?>
       </li>
      </div>
      <div class="col-xs-3">STATUS
       <li class="list-group-item">
       <?php echo utf8_encode($RStatus); ?>
       </li>
      </div>
      <div class="col-xs-12">ATENDIMENTO
       <li class="list-group-item">
       <h4>Solicitação do Cliente:</h4>
        <i class="texto">
        <?php echo utf8_encode($DescSolicita); ?>
        </i>
       <h4>Resumo do Atendimento:</h4>
        <i class="texto">
        <?php echo utf8_encode($DescAtend); ?>
        </i>
       </li>
      </div>
      <form name="finaliza" id="name" method="post" action="" enctype="multipart/form-data">
       <div class="col-md-6 col-xs-12">Selecione o respons&aacute;vel pelo chamado
        <select class="form-control" name="usuario" required="required">
         <option value="" selected="selected">SELECIONE</option>
         <?php while ($Userss = $USR->fetch(PDO::FETCH_ASSOC)): ?>
         <option value="<?php echo $Userss['Nome'] ?>"><?php echo $Userss['Nome'] ?>
         </option>
         <?php endwhile; ?>
        </select>
       </div>
       <div class="col-xs-12"><br />
        <input name="finaliza" type="submit" class="btn bg-red btn-block btn-lg" value="FINALIZAR"  /> 
       </div>  
      </form>
      <?php
       if(@$_POST["finaliza"])
       {
        $dataFin = date('d/m/Y - H:i:s');
        $NovoAtendente = $_POST['usuario'];
          $V1 = "<br /><strong>Chamado Reaberto</strong>";
          $V2 = "<br />Data: " . $dataFin;
          $V3 = "<br />Usuário: " . $NomeUserLogado . "<br />";
          $Obs = $Resumo . $V1 . $V2 . $V3;
        $Finalizar = $PDO->query("UPDATE atendimento SET Status='2', UserAtendente='$NovoAtendente' WHERE id='$id'");
         if ($Finalizar) 
         {
          $DataLog = date('Y-m-d - H:i:s');
          $Loog = "Chamado Reaberto";
          $InsereLog = $PDO->query("INSERT INTO log (Cod, TipoLog, DataCadastro, UserCadastro, Descreve) VALUES ('115', '$Loog', '$DataLog', '$NomeUserLogado', '$Obs')");
          if ($InsereLog) 
          {
           echo '<script type="text/JavaScript">alert("Finalizado com Sucesso");</script>';
           echo '<script type="text/javascript">window.close();</script>';
          }
          else
          {
           echo '<script type="text/JavaScript">alert("Erro ao Salvar Log");</script>';
           echo '<script type="text/javascript">window.close();</script>';
          }
         }
         else
         {
         echo '<script type="text/javascript">alert("NÃO FOI POSSÍVEL FINALIZAR");</script>';
         echo '<script type="text/javascript">window.close();</script>';
         }
       }
      ?>

      
     </div>
    </div>
   </section>
  </div>
 </div>
<?php include_once '../footer.php'; ?>
</div>
<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="../plugins/fastclick/fastclick.js"></script>
<script src="../dist/js/app.min.js"></script>
<script src="../dist/js/demo.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
</body>
</html>