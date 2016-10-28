<?php

//CHAMANDO MANUAIS
$chdc = "SELECT * FROM doctos ORDER BY id DESC";
$dc = $PDO->prepare($chdc);
$dc->execute();
?>
<table id="tabMan" class="table table-hover table-responsive">
 <thead>
  <tr>
   <td>#</td>
   <td>Modelo</td>
   <td>Versão</td>
   <td>Release</td>
   <td></td>
  </tr>
 </thead>
 <tbody>
  <?php while ($d = $dc->fetch(PDO::FETCH_ASSOC)): 
   echo '<tr>';
   echo '<td>' . $d["id"] . '</td>';
   echo '<td>' . $d["Modelo"] . '</td>';
   echo '<td>' . $d["Versao"] . '</td>';
   echo '<td class="texto">' . $f["Obs"] . '</td>';
   echo '<td>';
    $Arquivo = $d["file"];
    echo '<a href="uploads/' . $Arquivo . ' " target="_blank" class="btn btn-default btn-xs"><i class="fa fa-download"></i> BAIXAR </a>';
   echo '</td>';
   echo '</tr>';
   endwhile;
  ?>
 </tbody>
</table>