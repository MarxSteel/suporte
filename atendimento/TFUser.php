<?php
//CHAMANDO MANUAIS
$FUsr = "SELECT * FROM atendimento WHERE Status='1' AND UserAtendente='$NomeUserLogado' ORDER BY id DESC";
$FU = $PDO->prepare($FUsr);
$FU->execute();
?>
<table id="finalizadosUser" class="table table-hover table-responsive">
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
  <?php while ($FUser = $FU->fetch(PDO::FETCH_ASSOC)): 
   echo '<tr>';
   echo '<td>' . $FUser["id"] . '</td>';
   echo '<td><span class="badge bg-blue">' . $FUser["Equip"] . '</span></td>';

   echo '<td>' . $FUser["Revenda"] . '</td>';
   echo '<td>' . $FUser["RevendaTecnico"] . '</td>';   
   echo '<td>' . $FUser["DescSolicita"] . '</td>';   
   echo '<td>' . $FUser["DataCadastro"] . '</td>';
   echo '<td>';
      echo '<a class="btn btn-default btn-sm" href="';
      echo "javascript:abrir('Visualizar.php?ID=" . $FUser["id"] . "');";
      echo '"><i class="fa fa-search"></i></a>';    
   echo '</td>';
   echo '</tr>';
   endwhile;
  ?>
 </tbody>
</table>