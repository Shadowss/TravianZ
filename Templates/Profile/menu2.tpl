<div id="textmenu">
   <a href="spieler.php?uid=<?php if(isset($_GET['uid'])) { echo $_GET['uid']; } else { echo $session->uid; } ?>" <?php if(isset($_GET['uid'])) { echo "class=\"selected\""; } ?>>Overview</a>
 | <span class=none><b>Profile</b></span>
 | <span class=none><b>Preferences</b></span>
 | <span class=none><b>Account</b></span>
 <?php
  if(NEW_FUNCTIONS_VACATION){
 ?>
 | <span class=none><b>Vacation</b></span>
 <?php
 }
 if(GP_ENABLE) {
 ?>
 | <span class=none><b>Graphic pack</b></span>
 <?php
 }
 ?>

</div>
