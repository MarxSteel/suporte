<?php
//CHAMANDO MANUAIS
$pGeral = "SELECT * FROM atendimento WHERE Status='2' ORDER BY id DESC";
$PG = $PDO->prepare($pGeral);
$PG->execute();
?>
<table id="tabPendenteGeral" class="table table-hover table-responsive">
 <thead>
  <tr>
   <td width="5%">Chamado</td>
   <td width="10%" >Modelo</td>
   <td width="12%">Revenda</td>
   <td width="15%">Técnico da Revenda</td>
   <td width="15%">Técnico</td>
   <td width="28%" >Cadastro</td>
   <td width="10%" >Solicitação</td>
   <td width="20%"></td>
  </tr>
 </thead>
 <tbody>
  <?php while ($Pgeral = $PG->fetch(PDO::FETCH_ASSOC)): 
   echo '<tr>';
   echo '<td>' . $Pgeral["id"] . '</td>';
   echo '<td><span class="badge bg-blue">' . $Pgeral["Equip"] . '</span></td>';
   echo '<td>' . $Pgeral["Revenda"] . '</td>';
   echo '<td>' . $Pgeral["RevendaTecnico"] . '</td>';   
   echo '<td>' . $Pgeral["UserAtendente"] . '</td>';   
   echo '<td>' . $Pgeral["DescSolicita"] . '</td>';   
   echo '<td>' . $Pgeral["DataCadastro"] . '</td>';
   $Atendente = $Pgeral["UserAtendente"];
   echo '<td>';
    echo '<a class="btn btn-default btn-sm" href="';
    echo "javascript:abrir('Visualizar.php?ID=" . $Pgeral["id"] . "');";
    echo '"><i class="fa fa-search"></i></a>&nbsp;';  
    echo '<a class="btn btn-warning btn-sm" href="';
    echo "javascript:abrir('GAtualiza.php?ID=" . $Pgeral["id"] . "');";
    echo '"><i class="fa fa-refresh"></i></a>&nbsp;';
     if ($Atendente === $NomeUserLogado) 
     {
      echo '<a class="btn btn-success btn-sm" href="';
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