<?php
//CHAMANDO MANUAIS
$PUsr = "SELECT * FROM atendimento WHERE Status='2' AND UserAtendente='$NomeUserLogado' ORDER BY id DESC";
$PU = $PDO->prepare($PUsr);
$PU->execute();
?>
<table id="pendente" class="table table-hover table-responsive">
 <thead>
  <tr>
   <td width="5%">Chamado</td>
   <td width="10%" >Modelo</td>
   <td width="15%">Revenda</td>
   <td width="15%">Técnico da Revenda</td>
   <td width="30%" >Cadastro</td>
   <td width="10%" >Solicitação</td>
   <td width="15%"></td>
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
   echo '<td>' . $PUser["DataCadastro"] . '</td>';
   echo '<td>';
      echo '<a class="btn btn-default btn-sm" href="';
      echo "javascript:abrir('Visualizar.php?ID=" . $PUser["id"] . "');";
      echo '"><i class="fa fa-search"></i></a>&nbsp;';  
      echo '<a class="btn btn-warning btn-sm" href="';
      echo "javascript:abrir('Atualizar.php?ID=" . $PUser["id"] . "');";
      echo '"><i class="fa fa-refresh"></i></a>&nbsp;';    
      echo '<a class="btn btn-success btn-sm" href="';
      echo "javascript:abrir('Finaliza.php?ID=" . $PUser["id"] . "');";
      echo '"><i class="fa fa-check"></i></a>';    
   echo '</td>';
   echo '</tr>';
   endwhile;
  ?>
 </tbody>
</table>