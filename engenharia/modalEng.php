   <?php 
    //CONFIGURANDO DADOS DE 
    $ChamaProduto = "SELECT * FROM produto";
    $P1 = $PDO->prepare($ChamaProduto);
    $P2 = $PDO->prepare($ChamaProduto);
    $P1->execute();
    $P2->execute();
      $NovaData = date('d/m/Y - H:i');
   ?>
<!-- MODAL DE CADASTRO DE FIRMWARE -->
<div id="nfw" class="modal fade" role="dialog">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header bg-red">
    <button type="button" class="close" data-dismiss="modal">X</button>
     <h4 class="modal-title">Adicionar novo Firmware</h4>
   </div>
   <div class="modal-body">
    <form name="EdCad" id="name" method="post" action="" enctype="multipart/form-data">
     <div class="col-md-6 col-xs-12">Versão de Fw.
      <input class="form-control" type="text" name="vLinha" required="required">
     </div>
     <div class="col-md-6 col-xs-12">Modelo
      <select class="form-control" name="prodLinha" required="required">
       <option value="" selected="selected">SELECIONE</option>
       <?php while ($Prod1 = $P1->fetch(PDO::FETCH_ASSOC)): ?>
       <option value="<?php echo $Prod1['nome'] ?>"><?php echo $Prod1['nome'] ?>
       </option>
       <?php endwhile; ?>
      </select>
     </div>
     <div class="col-xs-12"><br />
      <input type="file" name="fileUpload">
     </div>
     <div class="col-xs-12">Release da Versão
      <textarea name="rel" cols="45" rows="3" class="form-control" required="required"></textarea><hr>
     </div>
     <div class="pull-right">
      <input name="novoProduto" type="submit" class="btn btn-danger btn-flat" id="novoProduto" value="CADASTRAR"  /> 
      <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">FECHAR</button>
     </div>
    </form>
    <?php
    if(@$_POST["novoProduto"]){
     $DataAtual = date('Y/m/d - H:i:s'); //TRATANDO DATA E HORA, DD/MM/YYYY - HH:MM:SS
      $Versao = $_POST['vLinha'];
      $Mod = $_POST['prodLinha'];
      $Release = str_replace("\r\n", "<br/>", strip_tags($_POST["rel"]));
      $ext = strtolower(substr($_FILES['fileUpload']['name'],-4)); //Pegando extensão do arquivo
      $NovoNome = md5($DataAtual) . $ext; //criando novo nome para o arquivo
      $dir = 'uploads/'; //Diretório para uploads
      move_uploaded_file($_FILES['fileUpload']['tmp_name'], $dir.$NovoNome); //Fazer upload do arquivo
       $novoFw = $PDO->query("INSERT INTO firmware (Versao, Modelo, file, DataCadastro, UserCadastro, Obs) VALUES ('$Versao', '$Mod', '$NovoNome', '$DataAtual', '$NomeUserLogado', '$Release')");


      //	$novoFw = $PDO->query("INSERT INTO firmware (Versao, Modelo, Release, file, DataCadastro, UserCadastro) VALUES ('$Versao', '$Mod', '$rel', '$NovoNome', 'DataAtual', '$NomeUserLogado')");
      	if ($novoFw) {
      		$TpLog = "Cadastrado novo Firmware";
      	 $InsLog = $PDO->query("INSERT INTO log (Cod, TipoLog, DataCadastro, UserCadastro) VALUES ('1', '$TpLog', '$DataAtual', '$NomeUserLogado')");
      	if ($InsLog) 
        {
         echo '<script type="text/JavaScript">alert("Cadastrado com Sucesso");
              location.href="dashboard.php"</script>';
	    }
        else
        {
         echo '<script type="text/javascript">alert("Erro ao salvar Log");</script>';
        }

      	}
        else
        {
        echo '<script type="text/javascript">alert("Erro ao Adicionar");</script>';
        }
      }
      ?>

   </div>
   <div class="modal-footer"></div>
  </div>
 </div>
</div>
<!-- MODAL DE CADASTRO DE FIRMWARE -->
<!-- MODAL DE CADASTRO DE DOCUMENTAÇÃO -->
<div id="nmanual" class="modal fade" role="dialog">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header bg-green">
    <button type="button" class="close" data-dismiss="modal">X</button>
     <h4 class="modal-title">Adicionar nova documentação</h4>
   </div>
   <div class="modal-body">
    <form name="EdCad" id="name" method="post" action="" enctype="multipart/form-data">
     <div class="col-md-6 col-xs-12">Titulo do Doc.
      <input class="form-control" type="text" name="vLinha" required="required">
     </div>
     <div class="col-md-6 col-xs-12">Modelo
      <select class="form-control" name="prodLinha" required="required">
       <option value="" selected="selected">SELECIONE</option>
       <?php while ($Prod2 = $P2->fetch(PDO::FETCH_ASSOC)): ?>
       <option value="<?php echo $Prod2['nome'] ?>"><?php echo $Prod2['nome'] ?>
       </option>
       <?php endwhile; ?>
      </select>
     </div>
     <div class="col-xs-12"><br />
      <input type="file" name="fileUpload">
     </div>
     <div class="col-xs-12">Descrição
      <textarea name="rel" cols="45" rows="3" class="form-control" required="required"></textarea><hr>
     </div>
     <div class="pull-right">
      <input name="ndoc" type="submit" class="btn btn-success btn-flat" id="ndoc" value="CADASTRAR"  /> 
      <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">FECHAR</button>
     </div>
    </form>
    <?php
    if(@$_POST["ndoc"]){
     $DataAtual = date('Y/m/d - H:i:s'); //TRATANDO DATA E HORA, DD/MM/YYYY - HH:MM:SS
      $Versao = $_POST['vLinha'];
      $Mod = $_POST['prodLinha'];
      $Release = str_replace("\r\n", "<br/>", strip_tags($_POST["rel"]));
      $ext = strtolower(substr($_FILES['fileUpload']['name'],-4)); //Pegando extensão do arquivo
      $NovoNome = md5($DataAtual) . $ext; //criando novo nome para o arquivo
      $dir = 'uploads/'; //Diretório para uploads
      move_uploaded_file($_FILES['fileUpload']['tmp_name'], $dir.$NovoNome); //Fazer upload do arquivo
       $novoFw = $PDO->query("INSERT INTO doctos (Versao, Modelo, file, DataCadastro, UserCadastro, Obs) VALUES ('$Versao', '$Mod', '$NovoNome', '$DataAtual', '$NomeUserLogado', '$Release')");


      //  $novoFw = $PDO->query("INSERT INTO firmware (Versao, Modelo, Release, file, DataCadastro, UserCadastro) VALUES ('$Versao', '$Mod', '$rel', '$NovoNome', 'DataAtual', '$NomeUserLogado')");
        if ($novoFw) {
          $TpLog = "Cadastrado novo documento";
         $InsLog = $PDO->query("INSERT INTO log (Cod, TipoLog, DataCadastro, UserCadastro) VALUES ('2', '$TpLog', '$DataAtual', '$NomeUserLogado')");
        if ($InsLog) 
        {
         echo '<script type="text/JavaScript">alert("Cadastrado com Sucesso");
              location.href="dashboard.php"</script>';
      }
        else
        {
         echo '<script type="text/javascript">alert("Erro ao salvar Log");</script>';
        }

        }
        else
        {
        echo '<script type="text/javascript">alert("Erro ao Adicionar");</script>';
        }
      }
      ?>

   </div>
   <div class="modal-footer"></div>
  </div>
 </div>
</div>
<!-- MODAL DE CADASTRO DE DOCUMENTAÇÃO -->

<!-- MODAL DE CADASTRO DE PRODUTO -->
<div id="NovoProduto" class="modal fade" role="dialog">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header bg-blue">
    <button type="button" class="close" data-dismiss="modal">X</button>
     <h4 class="modal-title">Cadastro de Produto</h4>
   </div>
   <div class="modal-body">
    <form name="pd" id="name" method="post" action="" enctype="multipart/form-data">
     <div class="col-xs-8">Modelo
      <input class="form-control" type="text" name="ni" required="required">
     </div>
     <div class="col-xs-4">Categoria
      <select class="form-control" name="cat" required="required">
       <option value="" selected="selected">SELECIONE</option>
       <option value="PONTO">PONTO</option>
       <option value="ACESSO">ACESSO</option>
      </select>
     </div>
     <div class="col-xs-12"><br /><br /><br />
     <input name="pd" type="submit" class="btn btn-success btn-block" id="pd" value="CADASTRAR"  />
     </div>
    </form>
    <?php
    if(@$_POST["pd"])
    {
     $produto = $_POST['ni'];          //NOME DO ITEM
     $categoria = $_POST['cat'];
      $novoProd = $PDO->query("INSERT INTO produto (nome, tipo, dataCadastro) VALUES ('$produto', '$categoria', '$NovaData')");
        if($novoProd)
        {
        echo '<script type="text/JavaScript">alert("Modelo Adicionado!");
              location.href="dashboard.php"</script>';
        }
        else{
        }
    }
    ?>
   </div>
   <div class="modal-footer"></div>
  </div>
 </div>
</div>
<!-- FINAL DO MODAL DE CADASTRO DE PRODUTO -->