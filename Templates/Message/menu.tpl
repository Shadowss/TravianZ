<div id="textmenu">
   <a href="nachrichten.php" <?php if(!isset($_GET['t'])) { echo "class=\"selected\""; } ?>>Inbox</a>
 | <a href="nachrichten.php?t=1" <?php if(isset($_GET['t']) && $_GET['t'] == 1) { echo "class=\"selected\""; } ?> >Write</a>
 | <a href="nachrichten.php?t=2" <?php if(isset($_GET['t']) && $_GET['t'] == 2) { echo "class=\"selected\""; } ?> >Sent</a>
 <?php if($session->plus) {
 echo " | <a href=\"nachrichten.php?t=3\"";
 if(isset($_GET['t']) && $_GET['t'] == 3) { echo "class=\"selected\""; }
 echo ">Archive</a> | <a href=\"nachrichten.php?t=4\"";
 if(isset($_GET['t']) && $_GET['t'] == 4) { echo "class=\"selected\""; }
 echo ">Notes</a>";
 }
 ?>
</div>