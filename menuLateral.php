<?php 
$server = 'http://localhost:8888/suporte';
$endereco = $_SERVER ['SERVER_ADDR']; 
?>
<ul class="sidebar-menu">
 <li class="header"></li>
  <li class="<?php echo $cHome; ?>">
   <a href="<?php echo $server; ?>/dashboard.php">
    <i class="fa fa-home"></i> <span>Início</span>
   </a>
  </li>
  <li class="<?php echo $cAtend; ?>">
   <a href="<?php echo $server; ?>/atendimento/dashboard.php">
    <i class="fa fa-plus"></i> <span>Atendimentos</span>
   </a>
  </li>
  <li class="<?php echo $cRev; ?>">
   <a href="<?php echo $server; ?>/revendas/dashboard.php">
    <i class="fa fa-newspaper-o"></i> <span>Cadastro de Revendas</span>
   </a>
  </li>
  <?php if ($permFw === "1") { ?>
  <li class="<?php echo $cDoc; ?>">
   <a href="<?php echo $server; ?>/engenharia/dashboard.php">
    <i class="fa fa-file-code-o"></i> <span>Documentação</span>
   </a>
  </li>
  <?php } else { } if ($permRel === "1") { ?>
  <li class="<?php echo $cRel; ?>">
   <a href="<?php echo $server; ?>/relatorios/dashboard.php">
    <i class="fa fa-pie-chart"></i> <span>Relatório</span>
   </a>
  </li>
  <?php } else { } if ($permUsr === "1") { ?>
  <li class="<?php echo $cUser; ?>">
   <a href="<?php echo $server; ?>/usuarios/dashboard.php">
    <i class="fa fa-users"></i> <span>Usuários</span>
   </a>
  </li>
  <?php } else { } ?>