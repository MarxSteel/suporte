<?php


// QUERIES PARA USUÁRIO
  //CHAMANDO QUANTIDADE DE ATENDIMENTOS FINALIZADOS 
  $AFEquip = "SELECT COUNT(*) FROM atendimento WHERE Equip='$ModeloCod' AND Status='1' AND DataCadastro BETWEEN '$DataInicial' AND '$DataFinal'";

    $AtFinEquip = $PDO->prepare($AFEquip);
    $AtFinEquip->execute();
    $AtendFinEquip = $AtFinEquip->fetchColumn();


  //CHAMANDO QUANTIDADE DE ATENDIMENTOS PENDENTES 
  $APEquip = "SELECT COUNT(*) FROM atendimento WHERE Equip='$ModeloCod' AND Status='2' AND DataCadastro BETWEEN '$DataInicial' AND '$DataFinal'";

    $AtPenEquip = $PDO->prepare($APEquip);
    $AtPenEquip->execute();
    $AtendPenEquip = $AtPenEquip->fetchColumn();


$dez = "10";
$Total = "100";




// QUERIES GERAIS
  //CHAMANDO QUANTIDADE DE ATENDIMENTOS FINALIZADOS 
  $AtendFinalizado = "SELECT COUNT(*) FROM atendimento WHERE Status='1' AND Equip='$ModeloCod' AND DataCadastro BETWEEN '$DataInicial' AND '$DataFinal'";
    $AtFin = $PDO->prepare($AtendFinalizado);
    $AtFin->execute();
    $QtAtendFinal = $AtFin->fetchColumn();

  //CHAMANDO QUANTIDADE DE ATENDIMENTOS PENDENTES 
  $AtendPendente = "SELECT COUNT(*) FROM atendimento WHERE Status='2' AND Equip='$ModeloCod' AND DataCadastro BETWEEN '$DataInicial' AND '$DataFinal'";
    $AtPen = $PDO->prepare($AtendPendente);
    $AtPen->execute();
    $QtAtendPendente = $AtPen->fetchColumn();

    //TIPOS DE ATENDIMENTO
    $SomaAtendimentosModelo = $QtAtendPendente + $QtAtendFinal;
    $PorcentoModPen = porcentagem_nnx ($QtAtendPendente, $SomaAtendimentosModelo);
    $PorcentoModFin = porcentagem_nnx ($QtAtendFinal, $SomaAtendimentosModelo);






?>