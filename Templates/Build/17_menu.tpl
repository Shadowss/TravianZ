<div id="textmenu"> 
   <a href="build.php?id=<?php echo $id; ?>"<?php if(!isset($_GET['t'])) { echo "class=\"selected\""; } ?>">Send Resouces</a> 
 | <a href="build.php?id=<?php echo $id; ?>&amp;t=1" <?php if(isset($_GET['t']) && $_GET['t'] == 1) { echo "class=\"selected\""; } ?>>Buy</a> 
 | <a href="build.php?id=<?php echo $id; ?>&amp;t=2" <?php if(isset($_GET['t']) && $_GET['t'] == 2) { echo "class=\"selected\""; } ?>>Offer</a> 
 <?php if($session->userinfo['gold'] > 2) {
 ?>
 | <a href="build.php?id=<?php echo $id; ?>&amp;t=3" <?php if(isset($_GET['t']) && $_GET['t'] == 3) { echo "class=\"selected\""; } ?>>NPC trading</a> 
 <?php
 }
 ?>
 <?php if($session->goldclub == 1 && count($database->getProfileVillages($session->uid)) > 1) {
 ?>
 | <a href="build.php?id=<?php echo $id; ?>&amp;t=4" <?php if(isset($_GET['t']) && $_GET['t'] == 4) { echo "class=\"selected\""; } ?>>trade routes</a> 
 <?php
 }
 ?>
</div> 