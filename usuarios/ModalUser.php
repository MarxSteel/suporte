<!-- MODAL DE CADASTRO DE USUÁRIO DO ALMOXARIFADO -->
<div id="NovoUser" class="modal fade" role="dialog">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header bg-green">
    <button type="button" class="close" data-dismiss="modal">X</button>
     <h4 class="modal-title">Cadastrar Usuário</h4>
   </div>
   <div class="modal-body">
    <form name="cad" id="name" method="post" action="" enctype="multipart/form-data">
     <div class="col-xs-12">Nome Completo
      <input name="NomeCompleto" type="text" class="form-control" id="NomeCompleto" required="required">
     </div>
     <div class="col-xs-6">Usuário
      <input name="nick" type="text" class="form-control" id="nick" required="required">
     </div>
     <div class="col-xs-6">Senha
      <input name="password" type="password" class="form-control" id="password" required="required">
     </div>
     <div class="col-xs-6">Tipo de Usuário
       <select class="form-control" name="tipo" required="required">
        <option value="" checked="checked"> >>SELECIONE<<</option>
        <option value="1">Técnico</option>
        <option value="2">Gestor</option>
        <option value="3">Administrador</option>
       </select>
     </div>
     <div class="col-xs-6">Pode Gerar Relatórios?
       <select class="form-control" name="relatorio" required="required">
        <option value="" checked="checked"> >>SELECIONE<<</option>
        <option value="9"> Pode Gerar Relatório</option>
        <option value="5"> Não pode gerar</option>
       </select>
     </div>
     <div class="col-xs-6">Pode Cadastrar Usuário?
      <select class="form-control" name="usuario" required="required">
       <option value="" checked="checked"> >>SELECIONE<<</option>
       <option value="1"> Pode Cadastrar</option>
       <option value="0"> Não pode Cadastrar</option>
      </select>
     </div>
     <div class="col-xs-6">Pode reabrir chamado?
      <select class="form-control" name="reabre" required="required">
       <option value="" checked="checked"> >>SELECIONE<<</option>
       <option value="1"> Pode reabrir</option>
       <option value="0"> Não pode reabrir</option>
      </select>
     </div>
     <div class="col-xs-12"><br />
       <input name="cad" type="submit" class="btn btn-success btn-block btn-flat" value="CADASTRAR USUÁRIO"  />
     </div>
    </form>
    <?php 
    if(@$_POST["cad"]){
     $NomeCompleto = $_POST["NomeCompleto"];
     $nick = $_POST["nick"];
     $senha = $_POST["password"];
     $TipoUser = $_POST["tipo"];
     $pRelatorio = $_POST["relatorio"];
     $pUser = $_POST["usuario"];
     $pReabrir = $_POST["reabre"];
      $passwd = md5($senha);
      $CadUser = $PDO->query("INSERT INTO login (Nome, login, senha, pUsr, pRel, pReabre, Tipo) VALUES ('$NomeCompleto', '$nick', '$passwd', '$pUser', '$pRelatorio', '$pReabrir', '$TipoUser')");
        if ($CadUser) {
        echo '<script type="text/javascript">alert("Usuário Adicionado!");</script>';
        echo '<script type="text/javascript">location.href="dashboard.php"</script>';
        }
    }
    ?>
   </div>
   <div class="modal-footer"></div>
  </div>
 </div>
</div>
<!-- MODAL DE CADASTRO DE USUÁRIO DO ALMOXARIFADO -->

<!-- MODAL DE MODELO -->
<div id="NovoProd" class="modal fade" role="dialog">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header bg-yellow">
    <button type="button" class="close" data-dismiss="modal">X</button>
     <h4 class="modal-title">Cadastrar Usuário Produção</h4>
   </div>
   <div class="modal-body">
    <form name="nUser" id="name" method="post" action="" enctype="multipart/form-data">
     <div class="col-xs-12">Nome Completo
      <input name="NomeCompleto" type="text" class="form-control" id="NomeCompleto" required="required">
     </div>
     <div class="col-xs-6">Usuário
      <input name="nick" type="text" class="form-control" id="nick" required="required">
     </div>
     <div class="col-xs-6">Senha
      <input name="password" type="password" class="form-control" id="password" required="required">
     </div>
     <div class="col-xs-12"> Dados de Cartão</div>
     <div class="col-xs-3">Wiegand
      <input name="wiegand" type="text" class="form-control" id="wiegand" required="required"/>
     </div>
     <div class="col-xs-3">Abatrack
      <input name="aba" type="text" class="form-control" id="aba" required="required"/>
     </div>
     <div class="col-xs-3">SmartCard
      <input name="mifare" type="text" class="form-control" id="mifare" required="required"/>
     </div>
     <div class="col-xs-3">IP
      <input name="ip" type="text" class="form-control" id="ip" minlength="13" maxlength="15" required="required"/>
     </div>
     <div class="col-xs-12">Privilégios</div>
     <div class="col-xs-4">Montagem
      <select class="form-control" name="montagem" id="montagem" required="required">
       <option value="" checked="checked"> >>SELECIONE<<</option>
       <option value="P"> Pode montar relógios</option>
       <option value="0"> Não pode montar</option>
      </select>
     </div>
     <div class="col-xs-4">Reteste
      <select class="form-control" name="reteste" id="reteste" required="required">
       <option value="" checked="checked"> >>SELECIONE<<</option>
       <option value="P"> Pode Retestar relógios</option>
       <option value="0"> Não pode Retestar</option>
      </select>
     </div>
     <div class="col-xs-4">Catracas
      <select class="form-control" name="cat" id="cat" required="required">
       <option value="" checked="checked"> >>SELECIONE<<</option>
       <option value="P"> Cadastra Catracas</option>
       <option value="0"> Não pode Cadastrar</option>
      </select>
     </div>
     <div class="col-xs-12"><br /><br />
      <input name="enviar" type="submit" class="btn btn-warning btn-block btn-flat" id="enviar" value="CADASTRAR USUÁRIO"  />
     </div>
    </form>
    <?php 
    if(@$_POST["enviar"])
    {
     $NomeCompleto = $_POST["NomeCompleto"];
     $nick = $_POST["nick"];
     $senha = $_POST["password"];
     $cat = $_POST["cat"];
     $passwd = md5($senha);
      // LEITORAS
      $wiegand = $_POST["wiegand"];
      $aba = $_POST["aba"];
      $mifare = $_POST["mifare"];
      $ip = $_POST["ip"]; //P2IP
      $montagem = $_POST["montagem"]; // P2M
      $reteste = $_POST["reteste"]; //P2R
      $ativo = "1";
      $user_level = "2";
       $executa = $PDO->query("INSERT INTO login (Nome, login, senha, P2Montagem, P2Reteste, CWieg, CAba, CMif, MeuIP, CadCat) VALUES ('$NomeCompleto', '$nick', '$passwd', '$montagem', '$reteste', '$wiegand', '$aba', '$mifare', '$ip', '$cat')");
        if($executa)
        {
         echo '<script type="text/javascript">alert("Usuário Adicionado!");</script>';
         echo '<script type="text/javascript">location.href="usuarios.php"</script>';
        }
        else
        {
         echo '<script type="text/javascript">alert("Erro ao Adicionar!");</script>';
         echo '<script type="text/javascript">location.href="usuarios.php"</script>';        
        }
      }
      ?>
   </div>
   <div class="modal-footer"></div>
  </div>
 </div>
</div>
<!-- MODAL DE MODELO -->


<!-- MODAL DE MODELO -->
<div id="modelo" class="modal fade" role="dialog">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header bg-green">
    <button type="button" class="close" data-dismiss="modal">X</button>
     <h4 class="modal-title">Cadastro de Firmware de Linha</h4>
   </div>
   <div class="modal-body">

   </div>
   <div class="modal-footer"></div>
  </div>
 </div>
</div>
<!-- MODAL DE MODELO -->