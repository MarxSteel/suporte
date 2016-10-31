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
          <th>Observações</th>
         </tr>
        </thead>
        <tbody>';
        while ($Rs = $Cpll->fetch(PDO::FETCH_ASSOC)): 
   echo '<tr>
          <td>' . $Rs["id"] . '</td>
          <td>' . $Rs["nome"] . '</td>
          <td>' . $Rs["DataCadastro"] . '</td>
          <td class="texto">' . $Rs["Obs"] . '</td>
         </td>';
        endwhile;
  echo '</tbody>
      </table>';  
?>