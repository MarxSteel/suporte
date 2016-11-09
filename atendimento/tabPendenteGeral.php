<?php
//CHAMANDO MANUAIS
$pGeral = "SELECT * FROM atendimento WHERE Status='2' ORDER BY id DESC";
$PG = $PDO->prepare($pGeral);
$PG->execute();
?>
<table id="tabPendenteGeral" class="table table-hover table-striped table-responsive">
 <thead>
  <tr>
   <td>Chamado</td>
   <td>Modelo</td>
   <td>Revenda</td>
   <td>T&eacute;cnico da Revenda</td>
   <td>Cadastro</td>
   <td>T&eacute;cnico Henry</td>
   <td></td>
  </tr>
 </thead>
 <tbody>
  <?php while ($Pgeral = $PG->fetch(PDO::FETCH_ASSOC)): 
   echo '<tr>';
   echo '<td>' . $Pgeral["id"] . '</td>';
   echo '<td><span class="badge bg-blue">' . $Pgeral["Equip"] . '</span></td>';
   echo '<td>' . $Pgeral["Revenda"] . '</td>';
   echo '<td>' . $Pgeral["RevendaTecnico"] . '</td>';   
   echo '<td>' . $Pgeral["DescSolicita"] . '</td>';   
   echo '<td>' . $Pgeral["UserAtendente"] . '</td>';
   $Atendente = $Pgeral["UserAtendente"];
   echo '<td>';
    echo '<a class="btn btn-default btn-xs" href="';
    echo "javascript:abrir('Visualizar.php?ID=" . $Pgeral["id"] . "');";
    echo '"><i class="fa fa-search"></i></a>&nbsp;';  
    echo '<a class="btn btn-warning btn-xs" href="';
    echo "javascript:abrir('GAtualiza.php?ID=" . $Pgeral["id"] . "');";
    echo '"><i class="fa fa-refresh"></i></a>&nbsp;';
     if ($Atendente === $NomeUserLogado) 
     {
      echo '<a class="btn btn-success btn-xs" href="';
      echo "javascript:abrir('GFinaliza.php?ID=" . $Pgeral["id"] . "');";
      echo '"><i class="fa fa-check"></i></a>';    
     }
     else{
      
     }
   echo '</td>';
   echo '</tr>';
   endwhile;
  ?>
 </tbody>
</table>