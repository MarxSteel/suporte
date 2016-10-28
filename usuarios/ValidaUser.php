<?php
$DadosUSR = $PDO->prepare("SELECT * FROM login WHERE codLogin='$UsuarioCod'");
$DadosUSR->execute();
$Qryusr = $DadosUSR->fetch();
$UNome = $Qryusr['Nome'];
$ULogin = $Qryusr['login'];

?>