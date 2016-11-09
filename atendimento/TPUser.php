<?php
//CHAMANDO MANUAIS
$PUsr = "SELECT * FROM atendimento WHERE Status='2' AND UserAtendente='$NomeUserLogado' ORDER BY id DESC";
$PU = $PDO->prepare($PUsr);
$PU->execute();
?>

<table id="pendente" class="table table-hover table-striped table-responsive">
 <thead>
  <tr>
   <td>Cham.</td>
   <td>Modelo</td>
   <td>Revenda</td>
   <td>T&eacute;cnico da Revenda</td>
   <td>Cadastro</td>
   <td>Atendente</td>
   <td></td>
  </tr>
 </thead>
 <tbody>
  <?php while ($PUser = $PU->fetch(PDO::FETCH_ASSOC)): 
   echo '<tr>';
   echo '<td>' . $PUser["id"] . '</td>';
   echo '<td><span class="badge bg-blue">' . $PUser["Equip"] . '</span></td>';
   echo '<td>' . $PUser["Revenda"] . '</td>';
   echo '<td>' . $PUser["RevendaTecnico"] . '</td>';   
   echo '<td>' . $PUser["DescSolicita"] . '</td>';   
   echo '<td>' . $PUser["UserAtendente"] . '</td>';
   echo '<td>';
      echo '<a class="btn btn-default btn-xs" href="';
      echo "javascript:abrir('Visualizar.php?ID=" . $PUser["id"] . "');";
      echo '"><i class="fa fa-search"></i></a>&nbsp;';  
      echo '<a class="btn btn-warning btn-xs" href="';
      echo "javascript:abrir('Atualizar.php?ID=" . $PUser["id"] . "');";
      echo '"><i class="fa fa-refresh"></i></a>&nbsp;';    
      echo '<button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#exampleModal" data-whatever="' . $PUser["id"] . '" data-idvalue="' . $PUser["id"] . '" data-botao="FINALIZAR" data-obs="' . $PUser["DescAtend"] . '"><i class="fa fa-check"></i></button></td>';
   echo '</td>';
   echo '</tr>';
   endwhile;
  ?>
 </tbody>
</table>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" class="pull-right">
         <span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
       <div class="callout callout-success">
       <h4><span class="glyphicon glyphicon-exclamation-sign"></span>Aten&ccedil;&atilde;o!</h4>
       Ao finalizar, n&atilde;o &eacute; possivel mais abrir o chamado. Caso necessite reabri-lo ser&aacute; necess&aacute;rio entrar em contato com a Engenharia, para que possa ser reaberto. 
       <h4>TEM CERTEZA QUE DESEJA FINALIZAR ?</h4>  
      </div>
       <form name="adProd" id="adProd" method="post" action="" enctype="multipart/form-data">
       <div class="col-xs-12">Chamado:
        <div class="modal-valor">
         <input type="text" class="form-control" name="IDP" id="modal-valor">
        </div>
       </div>
       <div class="col-xs-12">Observa&ccedil;&otilde;es Finais
        <textarea name="final" cols="45" rows="3" class="form-control" id="obs" required="required"></textarea><br />
       </div>
       <br />
       <div class="modal-botao">
       <input name="adProd" type="submit" class="btn btn-success btn-block" id="adProd"></div>
      </form>
       <?php
        if(@$_POST["adProd"])
        {
         $iProd = $_POST['IDP']; //ID DO PRODUTO
         $Observa = str_replace("\r\n", "<br/>", strip_tags($_POST["final"]));
          $dFor = $PDO->prepare("SELECT * FROM atendimento WHERE id='$iProd'");
          $dFor->execute();
            $campo = $dFor->fetch();
            $Resumo = $campo['DescAtend'];
            $dataFin = date('d/m/Y - H:i:s');
            $V1 = "<br /><strong>Chamado Finalizado</strong>";
            $V2 = "<br />Data: " . $dataFin;
            $V3 = "<br /><strong<Usuário: " . $NomeUserLogado . "</strong>";
            $Obs = $Resumo . $V1 . $V2 . $V3 . $Observa;
          
          $Finalizar = $PDO->query("UPDATE atendimento SET DescAtend='$Obs', Status='1' WHERE id='$iProd'");
         if ($Finalizar) 
         {
          $DataLog = date('Y-m-d - H:i:s');
          $Loog = "Chamado Finalizado";
          $InsereLog = $PDO->query("INSERT INTO log (Cod, TipoLog, DataCadastro, UserCadastro, Descreve) VALUES ('11', '$Loog', '$DataLog', '$NomeUserLogado', '$Obs')");
          if ($InsereLog) 
          {
         echo '<script type="text/JavaScript">alert("Finalizado com Sucesso");
              location.href="dashboard.php"</script>';
          }
          else
          {
         echo '<script type="text/JavaScript">alert("Erro ao Salvar Log");
              location.href="dashboard.php"</script>';
          }
         }
         else
         {
         echo '<script type="text/JavaScript">alert("Não Foi possível finalizar");
              location.href="dashboard.php"</script>';
         }
      }
        ?>
      </div>
    </div>
  </div>
</div> 