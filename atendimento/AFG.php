<?php
//CHAMANDO MANUAIS
$FUsr = "SELECT * FROM atendimento WHERE Status='2' ORDER BY id DESC";
$FU = $PDO->prepare($FUsr);
$FU->execute();
?>
<table id="AFG" class="table table-hover table-striped table-responsive" cellspacing="0" width="100%">
 <thead>
  <tr>
   <td width="5%">Cham.</td>
   <td width="15%">Modelo</td>
   <td width="30%">Revenda</td>
   <td width="15%">T&eacute;cnico da Revenda</td>
   <td width="30%">Atendimento</td>
   <td width="5%"></td>
  </tr>
 </thead>
 <tbody>
  <?php while ($FUser = $FU->fetch(PDO::FETCH_ASSOC)): 
   echo '<tr>';
   echo '<td>' . $FUser["id"] . '</td>';
   echo '<td><span class="badge bg-blue">' . $FUser["Equip"] . '</span></td>';
   echo '<td>' . $FUser["Revenda"] . '</td>';
   echo '<td>' . $FUser["RevendaTecnico"] . '</td>';   
   echo '<td>' . $FUser["DescSolicita"] . '</td>';   
   echo '<td>';
    $Atendente = $FUser["UserAtendente"];
    if ($Reabrir == "1") {
     echo '<a class="btn bg-navy btn-xs" href="';
     echo "javascript:abrir('Reabrir.php?ID=" . $FUser["id"] . "');";
     echo '"><i class="fa fa-reply-all"></i></a>&nbsp;';  
    }
    else
    {  
    }  
    echo '<a class="btn btn-default btn-xs" href="';
     echo "javascript:abrir('Visualizar.php?ID=" . $FUser["id"] . "');";
     echo '"><i class="fa fa-search"></i></a>&nbsp;'; 
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
              location.href="Geral.php"</script>';
          }
          else
          {
         echo '<script type="text/JavaScript">alert("Erro ao Salvar Log");
              location.href="Geral.php"</script>';
          }
         }
         else
         {
         echo '<script type="text/JavaScript">alert("Não Foi possível finalizar");
              location.href="Geral.php"</script>';
         }
      }
        ?>
      </div>
    </div>
  </div>
</div> 