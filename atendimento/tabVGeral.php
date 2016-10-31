<?php
//CHAMANDO MANUAIS
$VGer = "SELECT * FROM atendimento ORDER BY id DESC";
$VG = $PDO->prepare($VGer);
$VG->execute();
?>
<table id="tabVGeral" class="table table-hover table-responsive">
 <thead>
  <tr>
   <td width="5%">Chamado</td>
   <td width="10%">Modelo</td>
   <td width="15%">Revenda</td>
   <td width="15%">Técnico da Revenda</td>
   <td width="15%">Técnico</td>
   <td width="30%" >Cadastro</td>
   <td width="10%" >Solicitação</td>
   <td width="15%"></td>
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
   echo '<td>' . $VGeral["DataCadastro"] . '</td>';
   echo '<td>';
      echo '<a class="btn btn-default btn-sm" href="';
      echo "javascript:abrir('Visualizar.php?ID=" . $VGeral["id"] . "');";
      echo '"><i class="fa fa-search"></i></a>';    
   echo '</td>';
   echo '</tr>';
   endwhile;
  ?>
 </tbody>
</table>