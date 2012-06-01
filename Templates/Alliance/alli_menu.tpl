<?php if($session->alliance == $aid) {
?>
<div id="textmenu">
   <a href="allianz.php" <?php if(!isset($_GET['s'])) { echo "class=\"selected\""; } ?>>Overview</a>
 | <a href="allianz.php?s=2" <?php if(isset($_GET['s']) && $_GET['s'] == 2) { echo "class=\"selected\""; } ?>>Forum</a>
 | <a href="allianz.php?s=6" <?php if(isset($_GET['s']) && $_GET['s'] == 6) { echo "class=\"selected\""; } ?>>Chat</a>
 | <a href="allianz.php?s=3" <?php if(isset($_GET['s']) && $_GET['s'] == 3) { echo "class=\"selected\""; } ?>>Attacks</a>
 | <a href="allianz.php?s=4" <?php if(isset($_GET['s']) && $_GET['s'] == 4) { echo "class=\"selected\""; } ?>>News</a>
<?php
if($session->sit == 0){
?>
 | <a href="allianz.php?s=5" <?php if(isset($_GET['s']) && $_GET['s'] == 5) { echo "class=\"selected\""; } ?>>Options</a>
<?php
}else{
?>
 | <span class=none><b>Options</b></span>
<?php 
}
?>
</div>
<?php 
}
?>