<?php
//CHAMANDO MANUAIS
$chdc2 = "SELECT * FROM atendimento ORDER BY id DESC";
$dc2 = $PDO->prepare($chdc2);
$dc2->execute();
?>
<table id="geral" class="table table-hover table-responsive">
 <thead>
  <tr>
   <td width="5%">Chamado</td>
   <td width="10%">Status</td>
   <td width="15%">Revenda</td>
   <td width="15%">Técnico da Revenda</td>
   <td width="10%">Cadastro</td>
   <td width="27%">Solicitação</td>
   <td width="22%"></td>
  </tr>
 </thead>
 <tbody>
  <?php while ($d2 = $dc2->fetch(PDO::FETCH_ASSOC)): 
   echo '<tr>';
   echo '<td>' . $d2["id"] . '</td>';
   echo '<td>';
    $TpAtend = $d2["Status"];
     if ($TpAtend === "1") {
      echo '<span class="badge bg-green">FINALIZADO</span>';
     }
     elseif ($TpAtend === "2") {
      echo '<span class="badge bg-red">PENDENTE</span>';
     }
     else{
     }
   echo '</td>';
   echo '<td>' . $d2["Revenda"] . '</td>';
   echo '<td>' . $d2["RevendaTecnico"] . '</td>';
   echo '<td>' . $d2["DataCadastro"] . '</td>';
   echo '<td class="texto">' . $d2["DescSolicita"] . '</td>';
   echo '<td>';
    echo '<a class="btn btn-default btn-sm" href="';
    echo "javascript:abrir('Visualizar.php?ID=" . $d2["id"] . "');";
    echo '"><i class="fa fa-search"></i></a>&nbsp;';  
    echo '<a class="btn btn-warning btn-sm" href="';
    echo "javascript:abrir('Att.php?ID=" . $d2["id"] . "');";
    echo '"><i class="fa fa-refresh"></i></a>&nbsp;';
    echo '<a class="btn btn-success btn-sm" href="';
    echo "javascript:abrir('Finaliza.php?ID=" . $d2["id"] . "');";
    echo '"><i class="fa fa-check"></i></a>';    
   echo '</td>';
   echo '</tr>';
   endwhile;
   ?>
 <tr>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 </tr>
 </tbody>
</table>