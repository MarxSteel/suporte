<!-- INÍCIO DE CADASTRO DOS MODALS DE REVENDA -->



<script>
process = function()
 {
    window.open('about:blank', 'popup', 'width=1100,height=700,resizeable=no');
    document.login.setAttribute('target', 'popup');
    document.login.setAttribute('onsubmit', '');
    document.login.submit();
 };
</script>




<!-- MODAL REVENDA GERAL-->
<div id="usuarioGeral" class="modal fade" role="dialog">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header bg-yellow">
    <button type="button" class="close" data-dismiss="modal">X</button>
     <h4 class="modal-title">Relatório geral de Usuário</h4>
   </div>
   <div class="modal-body">
	<?php
     $ChamaRevenda = "SELECT nome FROM login WHERE Tipo='1'";
     $P1 = $PDO->prepare($ChamaRevenda);
     $P1->execute();
	?>
    <form name="rusg" action="rUsuarioGeral.php" target="_blank">
     <div class="col-xs-12">Selecione o Usuário
       <select class="form-control revendaGeral" name="atendente" style="width: 100%;">
        <option value="" selected="selected">SELECIONE</option>
        <?php while ($R1 = $P1->fetch(PDO::FETCH_ASSOC)): ?>
        <option value="<?php echo $R1['nome'] ?>"><?php echo $R1['nome'] ?></option>
        <?php endwhile; ?>
       </select>
     </div>
     <div class="col-xs-12"><br />
      <input name="rusg" type="submit" class="btn btn-warning btn-lg btn-block" value="VISUALIZAR"  /> 
     </div>
    </form>




   </div>
   <div class="modal-footer"></div>
  </div>
 </div>
</div>
<!-- MODAL REVENDA GERAL-->


<!-- MODAL REVENDA GERAL-->
<div id="usuarioPeriodo" class="modal fade" role="dialog">
 <div class="modal-dialog modal-lg">
  <div class="modal-content">
   <div class="modal-header bg-yellow">
    <button type="button" class="close" data-dismiss="modal">X</button>
     <h4 class="modal-title">Relatório de usuário por período</h4>
   </div>
   <div class="modal-body">
  <?php
     $ChamaModelo2 = "SELECT nome FROM produto";
     $P2 = $PDO->prepare($ChamaModelo2);
     $P2->execute();
  ?>
    <form name="ruserper" action="rModeloPeriodo.php" target="_blank">

     <div class="col-md-4">Modelo de Equipamento:
      <div class="form-group">
       <select class="form-control select2" name="modelo2" style="width: 100%;">
        <option value="" selected="selected">SELECIONE</option>
        <?php while ($p2 = $P2->fetch(PDO::FETCH_ASSOC)): ?>
        <option value="<?php echo $p2['nome'] ?>"><?php echo $p2['nome'] ?></option>
        <?php endwhile; ?>
       </select>
      </div>
     </div>
     <div class="col-xs-4">Data Inicial
      <div class="input-group">
       <div class="input-group-addon">
        <i class="fa fa-calendar"></i>
       </div>
        <input type="text" name="dtInicio" class="form-control" minlength="10" maxlength="10" OnKeyPress="formatar('##/##/####', this)" required="required">
      </div>
     </div>
     <div class="col-xs-4">Data Final
      <div class="input-group">
       <div class="input-group-addon">
        <i class="fa fa-calendar"></i>
       </div>
        <input type="text" name="dtFinal" class="form-control" minlength="10" maxlength="10" OnKeyPress="formatar('##/##/####', this)" required="required">
      </div>
     </div>
     <div class="col-xs-12"><br />
      <input name="ruserper" type="submit" class="btn btn-warning btn-block btn-lg" value="Visualizar"  /> 
     </div>
    </form>




   </div>
   <div class="modal-footer"></div>
  </div>
 </div>
</div>
<!-- MODAL REVENDA GERAL-->