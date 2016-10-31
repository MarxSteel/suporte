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
   <td>Técnico da Revenda</td>
   <td>Cadastro</td>
   <td>Atendente</td>
   <td></td>
  </tr>
 </thead>
 <tbody>
  <?php while ($PUser = $PU->fetch(PDO::FETCH_ASSOC)): 
   echo '<tr>';
   echo '<td>' . $PUser["id"] . '</td>';
   echo '<td>' . $PUser["Equip"] . '</td>';
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
      echo '<a class="btn btn-success btn-xs" href="';
      echo "javascript:abrir('Finaliza.php?ID=" . $PUser["id"] . "');";
      echo '"><i class="fa fa-check"></i></a>';    
   echo '</td>';
   echo '</tr>';
   endwhile;
  ?>
 </tbody>
</table>