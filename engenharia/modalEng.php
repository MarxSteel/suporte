   <?php 
    //CONFIGURANDO DADOS DE 
    $ChamaProduto = "SELECT * FROM produto";
    $P1 = $PDO->prepare($ChamaProduto);
    $P2 = $PDO->prepare($ChamaProduto);
    $P1->execute();
    $P2->execute();
      $NovaData = date('d/m/Y - H:i');
   ?>
<!-- MODAL DE CADASTRO DE PRODUTO -->
<div id="NovoProduto" class="modal fade" role="dialog">
 <div class="modal-dialog modal-lg">
  <div class="modal-content">
   <div class="modal-header bg-blue">
    <button type="button" class="close" data-dismiss="modal">X</button>
     <h4 class="modal-title">Formulário de Cadastro de Equipamento</h4>
   </div>
   <div class="modal-body">
    <form name="pd" id="name" method="post" action="" enctype="multipart/form-data">
     <div class="col-xs-8">Equipamento
      <input class="form-control" type="text" name="ni" required="required">
     </div>
     <div class="col-xs-4">Data de Cadastro
      <input class="form-control" type="text" disabled="disabled" placeholder="<?php echo $NovaData; ?>">
     </div>
     <div class="col-xs-12">Observações
      <textarea name="rel" cols="45" rows="3" class="form-control"></textarea><hr>
     </div>
     <div class="col-xs-12"><br /><br /><br />
     <input name="pd" type="submit" class="btn btn-success btn-block" id="pd" value="CADASTRAR"  />
     </div>
    </form>
    <?php
    if(@$_POST["pd"])
    {
     $produto = $_POST['ni'];          //NOME DO ITEM
     $Release = str_replace("\r\n", "<br/>", strip_tags($_POST["rel"]));
      $DataCadastro = date('Y-m-d H:i:s');
      
    $novoProd = $PDO->query("INSERT INTO produto (nome, Obs, DataCadastro) VALUES ('$produto', '$Release', '$DataCadastro')");
     if($novoProd)
     {
      $TpLog = "Cadastrado novo Firmware";  //DESCRIÇÃO DO ATENDIMENTO (LOG)
      echo '<script type="text/JavaScript">alert("Modelo Adicionado!");
              location.href="dashboard.php"</script>';
     }
     else
     {
      echo '<script type="text/JavaScript">alert("ERRO! Não foi possível adicionar o equipamento");
              location.href="dashboard.php"</script>';        
     }
    }
    ?>
   </div>
   <div class="modal-footer"></div>
  </div>
 </div>
</div>

