<div id="content" class="plus">
<h1><?php echo TZ_TRAVIAN; ?> <font color="#71D000">P</font><font color="#FF6F0F">l</font><font color="#71D000">u</font><font color="#FF6F0F">s</font></h1>
<div id="textmenu">
<?php
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$uri = basename($_SERVER['REQUEST_URI']);

function sel($cond){ return $cond ? 'class="selected"' : ''; }
?>
   <a href="plus.php" <?= sel($id==0 || $id==1 || $id>=100) ?>><?php echo TZ_TARIFFS; ?></a>
 | <a href="plus.php?id=2" <?= sel($id==2) ?>><?php echo TZ_ADVANTAGES; ?></a>
 | <a href="plus.php?id=3" <?= sel($id==3 || ($id>=6 && $id<=15)) ?>><?php echo GOLD; ?></a>
 | <a href="plus.php?id=4" <?= sel($id==4) ?>><?php echo FAQ; ?></a>
 | <a href="plus.php?id=5" <?= sel($id==5) ?>><?php echo TZ_EARN_GOLD; ?></a>
 | <a href="a2b2.php" <?= sel($uri==='a2b2.php') ?>><?php echo TZ_ACCOUNT_STATEMENT; ?></a>
</div>