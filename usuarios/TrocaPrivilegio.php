<?php
require("../restritos.php"); 
require_once '../init.php';
$UsuarioCod = $_GET['ID']; 
$PDO = db_connect();
require_once '../QueryUser.php';
require_once 'ValidaUser.php';
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
     <div class="box box-default">
     <div class="box-header with-border">
     </div>
     <div class="box-body">
     <h2>Troca de Privilégio</br>Usuário: <?php echo $UNome; ?></h2>
     <form name="cad" id="name" method="post" action="" enctype="multipart/form-data">
      <div class="col-xs-6">Tipo de Usuário
        <select class="form-control" name="tipo" required="required">
         <option value="" checked="checked"> >>SELECIONE<<</option>
         <option value="1">Técnico</option>
         <option value="2">Gestor</option>
         <option value="3">Administrador</option>
        </select>
      </div>
      <div class="col-xs-6">Pode Gerar Relatórios?
        <select class="form-control" name="relatorio" required="required">
         <option value="" checked="checked"> >>SELECIONE<<</option>
         <option value="9"> Pode Gerar Relatório</option>
         <option value="5"> Não pode gerar</option>
        </select>
      </div>
      <div class="col-xs-6">Pode Cadastrar Usuário?
       <select class="form-control" name="usuario" required="required">
        <option value="" checked="checked"> >>SELECIONE<<</option>
        <option value="1"> Pode Cadastrar</option>
        <option value="0"> Não pode Cadastrar</option>
       </select>
      </div>
      <div class="col-xs-6">Pode reabrir chamado?
       <select class="form-control" name="reabre" required="required">
        <option value="" checked="checked"> >>SELECIONE<<</option>
        <option value="1"> Pode reabrir</option>
        <option value="0"> Não pode reabrir</option>
       </select>
      </div>
      <div class="col-xs-12"><br />
       <input name="cad" type="submit" class="btn btn-success btn-block btn-flat" value="ATUALIZAR CADASTRO"  />
      </div>
     </form>
     <?php 
     if(@$_POST["cad"])
     {
      $TipoUser = $_POST["tipo"];
       if ($TipoUser === "1") {
         $CriaChamado = "1";
       }
       else{
        $CriaChamado = "0"; 
       }
      $pRelatorio = $_POST["relatorio"];
      $pUser = $_POST["usuario"];
      $pReabrir = $_POST["reabre"];
        $Priv = $PDO->query("UPDATE login SET pSup='$CriaChamado', pUsr='#pUser', pRel='$pRelatorio', pReabre='$pReabrir', Tipo='$TipoUser' WHERE codLogin='$UsuarioCod'");
       if ($Priv) 
       {
        echo '<script type="text/javascript">alert("Usuário Atualizado!");</script>';
         echo '<script type="text/javascript">window.close();</script>';
       }
       else
       {
        echo '<script type="text/javascript">alert("Erro ao Adicionar");</script>';
       }
     }
     ?>
     </div>
    </section>
  </div>
 </div>
<?php include_once '../footer.php'; ?></div>
<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../dist/js/app.min.js"></script>
</body>
</html>