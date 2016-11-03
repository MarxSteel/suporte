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
<div id="revendaGeral" class="modal fade" role="dialog">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header bg-red">
    <button type="button" class="close" data-dismiss="modal">X</button>
     <h4 class="modal-title">Relatório geral de revenda (sem período definido)</h4>
   </div>
   <div class="modal-body">
	<?php
     $ChamaRevenda = "SELECT RAZAO_SOCIAL FROM lista_revenda";
     $P1 = $PDO->prepare($ChamaRevenda);
     $P1->execute();
	?>
    <form action="rRevendaGeral.php" method="get" name="revg" target="popup" onsubmit="process(); return false;">
     <div class="col-xs-12">Selecione a Revenda
       <select class="form-control revendaGeral" name="revenda" style="width: 100%;">
        <option value="" selected="selected">SELECIONE</option>
        <?php while ($R1 = $P1->fetch(PDO::FETCH_ASSOC)): ?>
        <option value="<?php echo $R1['RAZAO_SOCIAL'] ?>"><?php echo $R1['RAZAO_SOCIAL'] ?></option>
        <?php endwhile; ?>
       </select>
     </div>
     <div class="col-xs-12"><br />
      <input name="revg" type="submit" class="btn btn-danger btn-lg btn-block" value="VISUALIZAR"  /> 
     </div>
    </form>




   </div>
   <div class="modal-footer"></div>
  </div>
 </div>
</div>
<!-- MODAL REVENDA GERAL-->


<!-- MODAL REVENDA GERAL-->
<div id="revendaPeriodo" class="modal fade" role="dialog">
 <div class="modal-dialog modal-lg">
  <div class="modal-content">
   <div class="modal-header bg-red">
    <button type="button" class="close" data-dismiss="modal">X</button>
     <h4 class="modal-title">Relatório de revenda por período</h4>
   </div>
   <div class="modal-body">

   </div>
   <div class="modal-footer"></div>
  </div>
 </div>
</div>
<!-- MODAL REVENDA GERAL-->