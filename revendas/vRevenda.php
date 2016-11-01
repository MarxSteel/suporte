<?php
 require("../restritos.php"); 
 require_once '../init.php';
 $PDO = db_connect();
require_once '../QueryUser.php';
   $id = $_GET['ID'];
   $dFor = $PDO->prepare("SELECT * FROM revenda WHERE EMPRESA_ID='$id'");
   $dFor->execute();
    $campo = $dFor->fetch();
    $Resumo = $campo['RAZAO_SOCIAL'];
    

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
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
        <span class="hidden-xs">Olá, <?php echo $NomeUserLogado; ?></span>
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
      <h4>Dados da Revenda</h4>
      <div class="col-xs-9">RAZÃO SOCIAL
       <li class="list-group-item">
        <?php echo $campo['RAZAO_SOCIAL']; ?>
       </li>
      </div>
      <div class="col-xs-3">CNPJ
       <li class="list-group-item">
        <?php echo $campo['CNPJ']; ?>
       </li>
      </div>
      <div class="col-xs-4">E-MAIL
       <li class="list-group-item">
        <?php echo $campo['EMAIL']; ?>
       </li>
      </div>
      <div class="col-xs-8">NOME FANTASIA
       <li class="list-group-item">
        <?php echo $campo['NOME_FANTASIA']; ?>
       </li>
      </div>
      <div class="col-xs-3">TELEFONE 1
       <li class="list-group-item">
       <strong>(<?php echo $campo['DDD1']; ?>) - <?php echo $campo['TELEFONE1']; ?></strong>
       </li>
      </div>
      <div class="col-xs-3">TELEFONE 2
       <li class="list-group-item">
       <strong>(<?php echo $campo['DDD2']; ?>) - <?php echo $campo['TELEFONE2']; ?></strong>
       </li>
      </div>
      <div class="col-xs-3">TELEFONE 3
       <li class="list-group-item">
       <strong>(<?php echo $campo['DDD3']; ?>) - <?php echo $campo['TELEFONE3']; ?></strong>
       </li>
      </div>
      <div class="col-xs-3">TELEFONE 4
       <li class="list-group-item">
       <strong>(<?php echo $campo['DDD4']; ?>) - <?php echo $campo['TELEFONE4']; ?></strong>
       </li>
      </div>
      <h4>Dados de Endereço</h4>
      <div class="col-xs-6">ENDEREÇO
       <li class="list-group-item">
        <?php echo $campo['ENDERECO']; ?>
       </li>
      </div>
      <div class="col-xs-2">Nº
       <li class="list-group-item">
        <?php echo $campo['NUMERO_END']; ?>
       </li>
      </div>
      <div class="col-xs-4">COMPLEMENTO
       <li class="list-group-item">
        <?php 
          $COMPLEMENTO = $campo['COMPLEMENTO_END'];
            if ($COMPLEMENTO == "") {
              echo "N";
            }
            else{
              echo $campo['COMPLEMENTO_END'];
            }
         ?>
       </li>
      </div>
      <div class="col-xs-3">USER. ATENDENTE
       <li class="list-group-item">
        <?php echo $Resumo; ?>
       </li>
      </div>
      <div class="col-xs-2">USER. CADASTRO
       <li class="list-group-item">
        <?php echo $Resumo; ?>
       </li>
      </div>
      <div class="col-xs-2">RETORNO DE ASSIST.
       <li class="list-group-item">
        <?php echo $Resumo; ?>
       </li>
      </div>
      <div class="col-xs-2">STATUS
       <li class="list-group-item">
        <?php echo $Resumo; ?>
       </li>
      </div>
      <div class="col-xs-3">Num. Serie
       <li class="list-group-item">
        <?php echo $Resumo; ?>
       </li>
      </div>
      <div class="col-xs-12">ATENDIMENTO
       <li class="list-group-item">
       <h4>Solicitação do Cliente:</h4>
        <i class="texto">
         <?php echo $Resumo; ?>
        </i>
       <h4>Resumo do Atendimento:</h4>
        <i class="texto">
         <?php echo $Resumo; ?>
        </i>
       </li>
      </div>
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