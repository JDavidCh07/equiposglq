<?php
 require_once ('controllers/cmen.php'); ?>

<nav class="nav">
  <a href="pmod.php" class="nav_link">
    <i class='fa fa-solid fa-house'></i>
    <span class="nav_name">Inicio</span>
  </a>
  <?php if($dat){ foreach ($dat as $dt) { ?>
    <a href="home.php?pg=<?=$dt['idpag'];?>" class="nav_link" title="<?=$dt['nompag'];?>">
      <i class='<?=$dt['icono'];?>'></i>
      <span class="nav_name"><?php if($_SESSION['idpef']==3 && $dt['idpag']==51) echo "Asignaciones"; elseif($_SESSION['idpef']==3 && $dt['idpag']==53) echo "Datos Personales"; else echo $dt['nompag'];?></span>
    </a>
  <?php }} ?>
</nav>