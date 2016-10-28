<?php
$DataAtual = date('Y/m/d - H:i:s'); //TRATANDO DATA E HORA, DD/MM/YYYY - HH:MM:SS

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
     <div class="col-md-5">Revenda:
      <input class="form-control" type="text" name="revenda" required="required">
     </div>
     <div class="col-md-4">Técnico da Revenda:
      <input class="form-control" type="text" name="tecnico" required="required">
     </div>
     <div class="col-xs-3">Retorno de Assistência?
      <select class="form-control" name="tipo" required="required">
       <option value="" selected="selected">SELECIONE</option>
       <option value="1">NÃO É RETORNO</option>
       <option value="2">RETORNO DE ASSISTÊNCIA</option>
      </select>
     </div>
     <div class="col-md-3">Equipamento:
      <input class="form-control" type="text" name="equipamento" required="required">
     </div>
     <div class="col-md-3">Possível envio à Assistência:
      <select class="form-control" name="assist" required="required">
       <option value="" selected="selected">SELECIONE</option>
       <option value="1">PRETENDE ENVIAR</option>
       <option value="2">NÃO PRETENDE ENVIAR</option>
      </select>     
     </div>
     <div class="col-md-3">Número de Série:
      <input class="form-control" type="text" name="nser" required="required">
     </div>
     <div class="col-xs-12">Solicitação do Cliente (Descreva aqui o item que o cliente quer solução):
      <textarea name="requis" cols="45" rows="3" class="form-control" required="required"></textarea>
     </div>
     <div class="col-xs-12">Solução (Descreva aqui a instrução passada ao cliente):
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
     $nTipo = $_POST['tipo'];            //É OU NÃO RETORNO (1 - NÃO É, 2 - É)
     $nEquip = $_POST['equipamento'];    //EQUIPAMENTO DO ATENDIMENTO
     $nAssist = $_POST['assist'];        //INFORMA SE PRETENDE OU NÃO ENVIAR À ASSISTÊNCIA
     $nSer = $_POST['nser'];             //NÚMERO DE SÉRIE

     $Nome = $NomeUserLogado;            //DECLARANDO A STRING DE LOGIN, SÓ PRA FICAR MENOR
    



     $nReq = str_replace("\r\n", "<br/>", strip_tags($_POST["requis"]));
     $nAten = str_replace("\r\n", "<br/>", strip_tags($_POST["atend"]));
      $InsereAtendimento = $PDO->query("INSERT INTO atendimento (Status, TipoAtendimento, DescAtend, DescSolicita, UserCadastro, UserAtendente, DataCadastro, Revenda, RevendaTecnico, NumSerie) VALUES ('2', '$nTipo', '$nAten', '$nReq', '$Nome', '$Nome', '$DataAtual', '$nRevenda', '$nTecnico', '$nSer')");

        if ($InsereAtendimento) {
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


<!-- MODAL DE CADASTRO DE FIRMWARE -->
<div id="help" class="modal fade" role="dialog">
 <div class="modal-dialog modal-lg">
  <div class="modal-content">
   <div class="modal-header bg-navy">
    <button type="button" class="close" data-dismiss="modal">X</button>
     <h4 class="modal-title">AJUDA</h4>
   </div>
   <div class="modal-body">
    NADA AQUI POR ENQUANTO ;)

   </div>
   <div class="modal-footer"></div>
  </div>
 </div>
</div>
<!-- MODAL DE CADASTRO DE FIRMWARE -->

