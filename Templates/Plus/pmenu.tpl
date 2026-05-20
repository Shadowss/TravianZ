<div id="content" class="plus">
<h1>Travian <font color="#71D000">P</font><font color="#FF6F0F">l</font><font color="#71D000">u</font><font color="#FF6F0F">s</font></h1>
<div id="textmenu">
<?php
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$uri = basename($_SERVER['REQUEST_URI']);

function sel($cond){ return $cond ? 'class="selected"' : ''; }
?>
   <a href="plus.php" <?= sel($id==0 || $id==1 || $id>=100) ?>>Tariffs</a>
 | <a href="plus.php?id=2" <?= sel($id==2) ?>>Advantages</a>
 | <a href="plus.php?id=3" <?= sel($id==3 || ($id>=6 && $id<=15)) ?>>Gold</a>
 | <a href="plus.php?id=4" <?= sel($id==4) ?>>FAQ</a>
 | <a href="plus.php?id=5" <?= sel($id==5) ?>>Earn gold</a>
 | <a href="a2b2.php" <?= sel($uri==='a2b2.php') ?>>Account Statement</a>
</div>