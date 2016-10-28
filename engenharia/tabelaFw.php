<?php

//CHAMANDO FIRMWARE
if ($permFw === "1") {
$chfw = "SELECT * FROM firmware ORDER BY id DESC";
$fw = $PDO->prepare($chfw);
$fw->execute();
}
else{
$chfw = "SELECT * FROM firmware WHERE Status='1' ORDER BY id DESC";
$fw = $PDO->prepare($chfw);
$fw->execute();
}
?>
<table id="tabfw" class="table table-hover table-responsive">
 <thead>
  <tr>
   <td>#</td>
   <td>Modelo</td>
   <td>Versão</td>
   <td>Release</td>
   <td></td>
   <td></td>
  </tr>
 </thead>
 <tbody>
  <?php while ($f = $fw->fetch(PDO::FETCH_ASSOC)): 
  echo '<tr>';
   echo '<td>' . $f["id"] . '</td>';
   echo '<td>' . $f["Modelo"] . '</td>';
   echo '<td>' . $f["Versao"] . '</td>';
   echo '<td class="texto">' . $f["Obs"] . '</td>';
   echo '<td>';
    $Arquivo = $f["file"];
    $StFw = $f["Status"];
    echo '<a href="uploads/' . $Arquivo . ' " target="_blank" class="btn btn-default btn-xs"><i class="fa fa-download"></i> BAIXAR </a>';
   echo '</td>';
   echo '<td>';
    if ($permFw === "1") 
    {
     if ($StFw === "1") 
     {
      echo '<a class="btn btn-danger btn-block btn-sm" href="';
      echo "javascript:abrir('Inativa.php?ID=" . $f["id"] . "');";
      echo '"><i class="fa fa-calendar-times-o"></i></a>';     
     }
     else
     {
      echo '<a class="btn btn-success btn-block btn-sm" href="';
      echo "javascript:abrir('Ativa.php?ID=" . $f["id"] . "');";
      echo '"><i class="fa fa-calendar-check-o"></i></a>';  
     }
    } else { }
   echo '</td>';
  echo '</tr>';
  endwhile;
  ?>
 </tbody>
</table>