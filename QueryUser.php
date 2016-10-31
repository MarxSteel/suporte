<?php 
 $query = $PDO->prepare("SELECT * FROM login WHERE login='$login'");
 $query->execute();
  $row = $query->fetch();
  $NomeUserLogado = $row['Nome'];
  $permFw = $row['pFw'];				//PERMISSÃO PARA ALTERAR FW
  $permSup = $row['pSup'];				//PERMISSÃO PARA ALTERAR FW
  $permRel = $row['pRel'];				//PERMISSÃO PARA GERAR RELATÓRIO
  $permUsr = $row['pUsr'];				//PERMISSÃO PARA GERAR RELATÓRIO
  $Reabrir = $row['pReabre'];				//PERMISSÃO PARA GERAR RELATÓRIO

?>
