<?php
require("../restritos.php"); 
require_once '../init.php';
$UsuarioCod = $_GET['ID']; 
$PDO = db_connect();
require_once '../QueryUser.php';
$teste = "Xablau!";
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
     <h2>Deletar Equipamento: <?php echo $UsuarioCod; ?></h2>
     <h3>DESEJA REALMENTE EXCLUIR ?</h3>  
     <form name="Atualiza" id="name" method="post" action="" enctype="multipart/form-data">
       <div class="col-xs-12">Observa&ccedil;ões Finais
        <textarea name="final" cols="45" rows="3" class="form-control"required="required"></textarea>
       </div>
       <div class="col-xs-12"><br />
        <input name="Atualiza" type="submit" class="btn bg-red btn-block btn-lg" value="FINALIZAR"  /> 
       </div>  
      </form>
      <?php
       if(@$_POST["Atualiza"])
       {
          $Observa = str_replace("\r\n", "<br/>", strip_tags($_POST["final"]));
        $Finalizar = $PDO->query("UPDATE produto SET Obs='$Observa' WHERE nome='$UsuarioCod'");
         if ($Finalizar) 
         {
          $DataLog = date('Y-m-d - H:i:s');
          $Loog = "Modelo de Equipamento Atualizado";
          $InsereLog = $PDO->query("INSERT INTO log (Cod, TipoLog, DataCadastro, UserCadastro, Descreve) VALUES ('145', '$Loog', '$DataLog', '$NomeUserLogado', '$Obs')");
          if ($InsereLog) 
          {
           echo '<script type="text/JavaScript">alert("Finalizado com Sucesso");</script>';
           echo '<script type="text/javascript">window.close();history.back();</script>';
          }
          else
          {
           echo '<script type="text/JavaScript">alert("Erro ao Salvar Log");</script>';
           echo '<script type="text/javascript">window.close();</script>';
          }
         }
         else
         {
         echo '<script type="text/javascript">alert("N&atilde;O FOI POSSÍVEL FINALIZAR");</script>';
         echo '<script type="text/javascript">window.close();</script>';
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