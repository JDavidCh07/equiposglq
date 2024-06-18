<?php
 require_once ('controllers/cmen.php'); ?>

<nav class="nav">
  <a href="pmod.php" class="nav_link">
    <i class='bx bx-user nav_icon'></i>
    <span class="nav_name">Inicio</span>
  </a>
  <?php if($dat){ foreach ($dat as $dt) { ?>
    <a href="home.php?pg=<?=$dt['idpag'];?>" class="nav_link" title="<?=$dt['nompag'];?>">
      <i class='<?=$dt['icono'];?>'></i>
      <span class="nav_name"><?=$dt['nompag'];?></span>
    </a>
  <?php }} ?>
</nav>