<?php
#################################################################################
##                                                                             ##
##              -= YOU MUST NOT REMOVE OR CHANGE THIS NOTICE =-                ##
##                                                                             ##
## --------------------------------------------------------------------------- ##
##                                                                             ##
##  Project:       ZravianX                                                    ##
##  Version:       2011.12.03                                                  ##
##  Filename:      Templates/Admin/give.tpl                                    ##
##  Developed by:  ZZJHONS                                                     ##
##  License:       Creative Commons BY-NC-SA 3.0                               ##
##  Copyright:     ZravianX (c) 2011 - All rights reserved                     ##
##  URLs:          http://zravianx.zzjhons.com                                 ##
##  Source code:   http://www.github.com/ZZJHONS/ZravianX                      ##
##                                                                             ##
#################################################################################

if($_SESSION['access'] < ADMIN) die("Access Denied: You aren't Admin!");
$id = $_SESSION['id'];
?>
<center>
	<h1>Here you can give gold to all players of this server.</h1>
    <br />
    <h2>Gold</h2>
	<form action="GameEngine/Admin/Mods/gold.php" method="POST">
		<input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
        <b>How much gold do you want to give to all players?</b>
        <br />
        <input class="give_gold" name="gold" id="gold" value="20" maxlength="4">&nbsp;<img src="img/admin/gold.gif" width="10" height="" class="gold" alt="Gold" title="Gold"/>&nbsp;&nbsp;<font color="gray" size="1">Insert a number and press enter <img src="img/admin/enter.gif" class="enter" alt="Enter" title="Enter"/>.</font>
	</form>
    <br />
	<?php if(isset($_GET['g'])){ ?>
		<font color="Red" size="+6"><b><?php echo $_GET['g']; ?> Gold added</b></font>
	<?php } ?>
</center>