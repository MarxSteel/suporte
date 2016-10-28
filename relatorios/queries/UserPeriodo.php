<?php


// QUERIES PARA USUÁRIO
  //CHAMANDO QUANTIDADE DE ATENDIMENTOS FINALIZADOS 
  $AtendFinalizado = "SELECT COUNT(*) FROM atendimento WHERE UserAtendente='$UsuarioCod' AND Status='1' AND DataCadastro BETWEEN '$DataInicial' AND '$DataFinal'";
    $AtFin = $PDO->prepare($AtendFinalizado);
    $AtFin->execute();
    $QtAtendFinal = $AtFin->fetchColumn();




  //CHAMANDO QUANTIDADE DE ATENDIMENTOS PENDENTES 
  $AtendPendente = "SELECT COUNT(*) FROM atendimento WHERE UserAtendente='$UsuarioCod' AND Status='2' AND DataCadastro BETWEEN '$DataInicial' AND '$DataFinal'";
    $AtPen = $PDO->prepare($AtendPendente);
    $AtPen->execute();
    $QtAtendPendente = $AtPen->fetchColumn();

    $UserTotal = $QtAtendFinal + $QtAtendPendente;
    $PorcentoUP = porcentagem_nnx ($QtAtendPendente, $UserTotal);
    $PorcentoUF = porcentagem_nnx ($QtAtendFinal, $UserTotal);


// QUERIES GERAIS
  //CHAMANDO QUANTIDADE DE ATENDIMENTOS FINALIZADOS 
  $GAtendFinalizado = "SELECT COUNT(*) FROM atendimento WHERE Status='1' AND DataCadastro BETWEEN '$DataInicial' AND '$DataFinal'";
    $GAtFin = $PDO->prepare($GAtendFinalizado);
    $GAtFin->execute();
    $GQtAtendFinal = $GAtFin->fetchColumn();

  //CHAMANDO QUANTIDADE DE ATENDIMENTOS PENDENTES 
  $GAtendPendente = "SELECT COUNT(*) FROM atendimento WHERE Status='2' AND DataCadastro BETWEEN '$DataInicial' AND '$DataFinal'";
    $GAtPen = $PDO->prepare($GAtendPendente);
    $GAtPen->execute();
    $GQtAtendPendente = $GAtPen->fetchColumn();





?>