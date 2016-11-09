<?php
//CHAMANDO MANUAIS
$FUsr = "SELECT * FROM atendimento WHERE Status='1' AND UserAtendente='$NomeUserLogado' ORDER BY id DESC";
$FU = $PDO->prepare($FUsr);
$FU->execute();
?>
<table id="AFU" class="table table-hover table-striped table-responsive" cellspacing="0" width="100%">
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
      echo '<a class="btn btn-default btn-xs" href="';
      echo "javascript:abrir('Visualizar.php?ID=" . $FUser["id"] . "');";
      echo '"><i class="fa fa-search"></i></a>';    
   echo '</td>';
   echo '</tr>';
   endwhile;
  ?>
 </tbody>
</table>