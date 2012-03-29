<?php 
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       gold.php                                                    ##
##  Developed by:  Dzoki                                                       ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################

if($_SESSION['access'] < ADMIN) die("Access Denied: You are not Admin!");

?>
<?php $id = $_SESSION['id']; ?>
<form action="../GameEngine/Admin/Mods/gold.php" method="POST">
<input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
<br /><br /><br /><br /><br /><br /><br /><br /><br />
<center><b>How much gold do you want to give to the users?</b></center>
<center><br /><input class="give_gold" name="gold" id="gold" value="20" maxlength="4">&nbsp;<img src="../img/admin/gold.gif" class="gold" alt="Gold" title="Gold"/>&nbsp;&nbsp;<font color="gray" size="1">insert number and press 'enter'</center></form>
<?php
    if(isset($_GET['g'])) {

          echo '<br /><br /><font color="Red"><b>Gold Added</font></b>';
		  }
		  ?>