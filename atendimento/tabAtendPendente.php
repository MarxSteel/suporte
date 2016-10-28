<?php
//CHAMANDO MANUAIS
$chdc = "SELECT * FROM atendimento WHERE Status='2' ORDER BY id DESC";
$dc = $PDO->prepare($chdc);
$dc->execute();
?>
<table id="pendente" class="table table-hover table-responsive">
 <thead>
  <tr>
   <td width="5%">Chamado</td>
   <td width="10%" >Retorno de Assist</td>
   <td width="15%">Revenda</td>
   <td width="15%">Técnico da Revenda</td>
   <td width="30%" >Cadastro</td>
   <td width="10%" >Solicitação</td>
   <td width="15%"></td>
  </tr>
 </thead>
 <tbody>
  <?php while ($d = $dc->fetch(PDO::FETCH_ASSOC)): 
   echo '<tr>';
   echo '<td>' . $d["id"] . '</td>';
   echo '<td>';
    $TpAtend = $d["TipoAtendimento"];
     if ($TpAtend === "1") {
      echo '<span class="badge bg-blue">NÃO</span>';
     }
     elseif ($TpAtend === "2") {
      echo '<span class="badge bg-red">SIM</span>';
     }
     else{
     }
   echo '</td>';
   echo '<td>' . $d["Revenda"] . '</td>';
   echo '<td>' . $d["RevendaTecnico"] . '</td>';   
   echo '<td>' . $d["DescSolicita"] . '</td>';   
   echo '<td>' . $d["DataCadastro"] . '</td>';
   echo '<td>';
      echo '<a class="btn btn-default btn-sm" href="';
      echo "javascript:abrir('Visualizar.php?ID=" . $d["id"] . "');";
      echo '"><i class="fa fa-search"></i></a>&nbsp;';  
      echo '<a class="btn btn-warning btn-sm" href="';
      echo "javascript:abrir('Atualizar.php?ID=" . $d["id"] . "');";
      echo '"><i class="fa fa-refresh"></i></a>&nbsp;';    
      echo '<a class="btn btn-success btn-sm" href="';
      echo "javascript:abrir('Finaliza.php?ID=" . $d["id"] . "');";
      echo '"><i class="fa fa-check"></i></a>';    
   echo '</td>';
   echo '</tr>';
   endwhile;
  ?>
 </tbody>
</table>