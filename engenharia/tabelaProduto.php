<?php
$ChPlaca = "SELECT * FROM produto";
$Cpll = $PDO->prepare($ChPlaca);
$Cpll->execute();
echo '<table id="tabprod" class="table table-hover table-responsive" cellspacing="0">';
  echo '<thead>
         <tr>
          <th>#</th>
          <th>Produto</th>
          <th>Data de Cadastro</th>
          <th>Observa&ccedil;&otilde;es</th>
         </tr>
        </thead>
        <tbody>';
        while ($Rs = $Cpll->fetch(PDO::FETCH_ASSOC)): 
   echo '<tr>
          <td>' . $Rs["id"] . '</td>
          <td>' . $Rs["nome"] . '</td>
          <td>' . $Rs["DataCadastro"] . '</td>
          <td class="texto">' . $Rs["Obs"] . '</td>';
    echo '<td>';
     echo '<a class="btn btn-danger btn-xs" href="javascript:abrir(';
      echo "'Deleta.php?ID=" . $Rs['nome'] . "');";
      echo '"><i class="fa fa-remove"></i></a>&nbsp;';
     echo '<a class="btn btn-warning btn-xs" href="javascript:abrir(';
      echo "'Atualiza.php?ID=" . $Rs['nome'] . "');";
      echo '"><i class="fa fa-refresh"></i></a>&nbsp;';
    echo "</td>";
   echo '</tr>';
        endwhile;
  echo '</tbody>
      </table>';  
?>