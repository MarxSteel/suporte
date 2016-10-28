<?php
$ChPlaca = "SELECT * FROM produto";
$Cpll = $PDO->prepare($ChPlaca);
$Cpll->execute();
echo '<table id="tabEstr" class="table table-hover table-responsive" cellspacing="0">';
  echo '<thead>
         <tr>
          <th>#</th>
          <th>Produto</th>
          <th>Categoria</th>
         </tr>
        </thead>
        <tbody>';
        while ($Rs = $Cpll->fetch(PDO::FETCH_ASSOC)): 
   echo '<tr>
          <td>' . $Rs["id"] . '</td>
          <td>' . $Rs["nome"] . '</td>
          <td>' . $Rs["tipo"] . '</td>
         </td>';
        endwhile;
  echo '</tbody>
      </table>';  
?>