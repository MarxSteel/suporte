<?php
$DataAtual = date('Y/m/d - H:i:s'); //TRATANDO DATA E HORA, DD/MM/YYYY - HH:MM:SS
$ChamaProduto = "SELECT * FROM produto";
 $prod = $PDO->prepare($ChamaProduto);
 $prod->execute();
$ChamaRevenda = "SELECT * FROM lista_revenda";
 $Rev = $PDO->prepare($ChamaRevenda);
 $Rev->execute();
?>
<!-- MODAL DE CADASTRO DE FIRMWARE -->
<div id="nAtend" class="modal fade" role="dialog">
 <div class="modal-dialog modal-lg">
  <div class="modal-content">
   <div class="modal-header bg-primary">
    <button type="button" class="close" data-dismiss="modal">X</button>
     <h4 class="modal-title">Novo Atendimento</h4>
   </div>
   <div class="modal-body">
    <form name="CadAtend" id="name" method="post" action="" enctype="multipart/form-data">
     <div class="col-md-3">Data de Cadastro:
      <input class="form-control" type="text" disabled="disabled" placeholder="<?php echo $DataAtual; ?>">
      </div>
     <div class="col-md-6">Revenda:
      <div class="form-group">
       <select class="form-control select3" name="revenda" style="width: 100%;">
        <option value="" selected="selected">SELECIONE</option>
        <?php while ($r = $Rev->fetch(PDO::FETCH_ASSOC)): ?>
        <option value="<?php echo $r['RAZAO_SOCIAL'] ?>"><?php echo $r['RAZAO_SOCIAL'] ?></option>
        <?php endwhile; ?>
       </select>
      </div>
     </div>
     <div class="col-md-3">Equipamento:
      <div class="form-group">
       <select class="form-control select2" name="equip" style="width: 100%;">
        <option value="" selected="selected">SELECIONE</option>
        <?php while ($pd = $prod->fetch(PDO::FETCH_ASSOC)): ?>
        <option value="<?php echo $pd['nome'] ?>"><?php echo $pd['nome'] ?></option>
        <?php endwhile; ?>
       </select>
      </div>
     </div>
     <div class="col-md-3">Técnico da Revenda:
      <input class="form-control" type="text" name="tecnico" required="required">
     </div>
     <div class="col-xs-3">Retorno de Assist&ecirc;ncia?
      <select class="form-control" name="tipo" required="required">
       <option value="" selected="selected">SELECIONE</option>
       <option value="1">N&Atilde;O &Eacute; RETORNO</option>
       <option value="2">RETORNO DE ASSIST&Ecirc;NCIA</option>
      </select>
     </div>

     <div class="col-md-3">Poss&iacute;vel envio &agrave; Assist&ecirc;ncia:
      <select class="form-control" name="assist" required="required">
       <option value="" selected="selected">SELECIONE</option>
       <option value="1">PRETENDE ENVIAR</option>
       <option value="2">N&Atilde;O PRETENDE ENVIAR</option>
      </select>     
     </div>
     <div class="col-md-3">N&uacute;mero de S&eacute;rie:
      <input class="form-control" type="text" name="nser" maxlength="17">
     </div>
     <div class="col-xs-12">Solicita&ccedil;&atilde;o do Cliente (Descreva aqui o item que o cliente quer solu&ccedil;&atilde;o):
      <textarea name="requis" cols="45" rows="3" class="form-control" required="required"></textarea>
     </div>
     <div class="col-xs-12">Solu&ccedil;&atilde;o (Descreva aqui a instru&ccedil;&atilde;o passada ao cliente):
      <textarea name="atend" cols="45" rows="3" class="form-control" required="required"></textarea><hr>
     </div>
     <div class="pull-right">
      <input name="CadAtend" type="submit" class="btn btn-primary btn-flat" value="CADASTRAR"  /> 
      <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">FECHAR</button>
     </div>
    </form>
    <?php
    if(@$_POST["CadAtend"])
    {
     $nRevenda = $_POST['revenda'];      //DESCRIÇÃO DA REVENDA
     $nTecnico = $_POST['tecnico'];      //TECNICO RESPONSÁVEL PELO ATENDIMENTO
      $nTecnico = TiraCaractere($nTecnico);
     $nTipo = $_POST['tipo'];            //É OU NÃO RETORNO (1 - NÃO É, 2 - É)
     $nEquip = $_POST['equip'];    //EQUIPAMENTO DO ATENDIMENTO
     $nAssist = $_POST['assist'];        //INFORMA SE PRETENDE OU NÃO ENVIAR À ASSISTÊNCIA
     $nSer = $_POST['nser'];             //NÚMERO DE SÉRIE
     $Nome = $NomeUserLogado;            //DECLARANDO A STRING DE LOGIN, SÓ PRA FICAR MENOR
     $nReq = str_replace("\r\n", "<br/>", strip_tags($_POST["requis"]));
      $nReq = TiraCaractere($nReq);
     $nAten = str_replace("\r\n", "<br/>", strip_tags($_POST["atend"]));
      $nAten = TiraCaractere($nAtend);
      $InsereAtendimento = $PDO->query("INSERT INTO atendimento (Status, TipoAtendimento, DescAtend, DescSolicita, UserCadastro, UserAtendente, DataCadastro, Revenda, RevendaTecnico, NumSerie, Equip) VALUES ('2', '$nTipo', '$nAten', '$nReq', '$Nome', '$Nome', '$DataAtual', '$nRevenda', '$nTecnico', '$nSer', '$nEquip')");

        if ($InsereAtendimento) {
          $TpLog = "Cadastrado novo Firmware";
         $InsLog = $PDO->query("INSERT INTO log (Cod, TipoLog, DataCadastro, UserCadastro) VALUES ('111', '$TpLog', '$DataAtual', '$NomeUserLogado')");
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


<!-- MODAL DE CADASTRO DE FIRMWARE -->
<div id="help" class="modal fade" role="dialog">
 <div class="modal-dialog modal-lg">
  <div class="modal-content">
   <div class="modal-header bg-navy">
    <button type="button" class="close" data-dismiss="modal">X</button>
     <h4 class="modal-title">AJUDA</h4>
   </div>
   <div class="modal-body">
   <h3> Descri&ccedil;&atilde;o dos Bot&otilde;es da &aacute;rea de suporte: </h3>
   <div class="col-xs-4" align="center">BOT&Atilde;O</div>
   <div class="col-xs-8" align="center">FUN&Ccedil;&Atilde;O</div><br />
   <div class="col-xs-4">
    <button class="btn bg-navy btn-block"><i class="fa fa-reply-all"></i></button>
   </div>
   <div class="col-xs-8" align="left"><h4>BOT&Atilde;O PARA REABRIR CHAMADO FINALIZADO</h4>
   </div><br />
   <div class="col-xs-4">
    <button class="btn btn-default btn-block"><i class="fa fa-search"></i></button>
   </div>
   <div class="col-xs-8" align="left"><h4>BOT&Atilde;O PARA VISUALIZAR CHAMADO</h4>
   </div><br />
   <div class="col-xs-4">
    <button class="btn bg-orange btn-block"><i class="fa fa-refresh"></i></button>
   </div>
   <div class="col-xs-8" align="left"><h4>BOT&Atilde;O PARA ATUALIZAR OBSERVA&Ccedil;&Otilde;ES DE CHAMADO</h4>
   </div><br />
   <div class="col-xs-4">
    <button class="btn btn-success btn-block"><i class="fa fa-check"></i></button>
   </div>
   <div class="col-xs-8" align="left"><h4>BOT&Atilde;O PARA FINALIZAR CHAMADO</h4>
   </div><br />

   <div class="modal-footer"></div>
  </div>
 </div>
</div>
<!-- MODAL DE CADASTRO DE FIRMWARE -->

