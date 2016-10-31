<?php
//CHAMANDO MANUAIS
$FinalGeral = "SELECT * FROM atendimento WHERE Status='1' ORDER BY id DESC";
$FG = $PDO->prepare($FinalGeral);
$FG->execute();
require_once '../QueryUser.php';
?>
<table id="tabFinalGeral" class="table table-hover table-responsive">
 <thead>
  <tr>
   <td>Chamado</td>
   <td>Modelo</td>
   <td>Revenda</td>
   <td>Técnico da Revenda</td>
   <td>Cadastro</td>
   <td>Técnico</td>
   <td></td>
  </tr>
 </thead>
 <tbody>
  <?php while ($finalG = $FG->fetch(PDO::FETCH_ASSOC)): 
   echo '<tr>';
   echo '<td>' . $finalG["id"] . '</td>';
   echo '<td><span class="badge bg-blue">' . $finalG["Equip"] . '</span></td>';

   echo '<td>' . $finalG["Revenda"] . '</td>';
   echo '<td>' . $finalG["RevendaTecnico"] . '</td>';   
   echo '<td>' . $finalG["DescSolicita"] . '</td>';   
   echo '<td>' . $finalG["UserAtendente"] . '</td>';
   echo '<td>';
    echo '<a class="btn btn-default btn-xs" href="';
    echo "javascript:abrir('Visualizar.php?ID=" . $finalG["id"] . "');";
    echo '"><i class="fa fa-search"></i></a>&nbsp;';
    if ($Reabrir == "1") {
     echo '<a class="btn bg-navy btn-xs" href="';
     echo "javascript:abrir('Reabrir.php?ID=" . $finalG["id"] . "');";
     echo '"><i class="fa fa-reply-all"></i></a>&nbsp;';  
    }
    else
    {  
    }  
    echo '<a class="btn btn-warning btn-xs" href="';
    echo "javascript:abrir('Atualizar.php?ID=" . $finalG["id"] . "');";
    echo '"><i class="fa fa-refresh"></i></a>&nbsp;';    
    echo '<a class="btn btn-success btn-xs" href="';
    echo "javascript:abrir('Finaliza.php?ID=" . $finalG["id"] . "');";
    echo '"><i class="fa fa-check"></i></a>';    
   echo '</td>';
   echo '</tr>';
   endwhile;
  ?>
 </tbody>
</table>