   <?php 
    //CONFIGURANDO DADOS DE 
    $ChamaProduto = "SELECT * FROM produto";
    $P1 = $PDO->prepare($ChamaProduto);
    $P2 = $PDO->prepare($ChamaProduto);
    $P1->execute();
    $P2->execute();

    $ChamaUsuario = "SELECT * FROM login WHERE Tipo='1'";
     $Chu = $PDO->prepare($ChamaUsuario);
     $Chu->execute();





      $NovaData = date('d/m/Y - H:i');
   ?>
<script>
process = function()
 {
    window.open('about:blank', 'popup', 'width=950,height=700,resizeable=no');
    document.login.setAttribute('target', 'popup');
    document.login.setAttribute('onsubmit', '');
    document.login.submit();
 };
</script>

<!-- MODAL DE CADASTRO DE FIRMWARE -->
<div id="rguser" class="modal fade" role="dialog">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header bg-orange">
    <button type="button" class="close" data-dismiss="modal">X</button>
     <h4 class="modal-title">Relatório por Usuário</h4>
   </div>
   <div class="modal-body">
    <form action="RGUser.php" method="get" name="rgu" target="popup" onsubmit="process(); return false;">
     <div class="col-xs-12">Modelo
      <select class="form-control" name="usuario" id="username" required="required">
       <option value="" selected="selected">SELECIONE</option>
       <?php while ($Chuu = $Chu->fetch(PDO::FETCH_ASSOC)): ?>
       <option value="<?php echo $Chuu['codLogin'] ?>"><?php echo $Chuu['Nome'] ?>
       </option>
       <?php endwhile; ?>
      </select>
     </div>
     <div class="pull-right"><br />
      <input name="rgu" type="submit" class="btn btn-success btn-flat" id="rgu" value="Visualizar"  /> 
     </div>
    </form>
   </div>
   <div class="modal-footer"></div>
  </div>
 </div>
</div>
<!-- MODAL DE CADASTRO DE FIRMWARE -->