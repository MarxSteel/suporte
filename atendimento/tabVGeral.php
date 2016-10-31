<?php
//CHAMANDO MANUAIS
$VGer = "SELECT * FROM atendimento ORDER BY id DESC";
$VG = $PDO->prepare($VGer);
$VG->execute();
?>
<table id="tabVGeral" class="table table-hover table-striped table-responsive">
 <thead>
  <tr>
   <td>Chamado</td>
   <td>Modelo</td>
   <td>Revenda</td>
   <td>Técnico da Revenda</td>
   <td>Técnico</td>
   <td>Cadastro</td>
   <td></td>
  </tr>
 </thead>
 <tbody>
  <?php while ($VGeral = $VG->fetch(PDO::FETCH_ASSOC)): 
   echo '<tr>';
   echo '<td>' . $VGeral["id"] . '</td>';
   echo '<td><span class="badge bg-blue">' . $VGeral["Equip"] . '</span></td>';
   echo '<td>' . $VGeral["Revenda"] . '</td>';
   echo '<td>' . $VGeral["RevendaTecnico"] . '</td>'; 
   echo '<td>' . $VGeral["UserAtendente"] . '</td>';   

   echo '<td>' . $VGeral["DescSolicita"] . '</td>';   
   echo '<td>';
      echo '<a class="btn btn-default btn-xs" href="';
      echo "javascript:abrir('Visualizar.php?ID=" . $VGeral["id"] . "');";
      echo '"><i class="fa fa-search"></i></a>';    
   echo '</td>';
   echo '</tr>';
   endwhile;
  ?>
 </tbody>
</table>