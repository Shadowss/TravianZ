
<div id="textmenu"> 
   <a href="build.php?id=<?php echo $id; ?>" <?php if(!isset($_GET['s'])) { echo "class=\"selected\""; } ?>><?php echo TRAIN; ?></a> 
 | <a href="build.php?id=<?php echo $id; ?>&amp;s=2" <?php if(isset($_GET['s']) && $_GET['s'] == 2) { echo "class=\"selected\""; } ?>><?php echo CULTURE_POINTS; ?></a> 
 | <a href="build.php?id=<?php echo $id; ?>&amp;s=3" <?php if(isset($_GET['s']) && $_GET['s'] == 3) { echo "class=\"selected\""; } ?>><?php echo LOYALTY; ?></a> 
 | <a href="build.php?id=<?php echo $id; ?>&amp;s=4" <?php if(isset($_GET['s']) && $_GET['s'] == 4) { echo "class=\"selected\""; } ?>><?php echo EXPANSION; ?></a> 
</div>