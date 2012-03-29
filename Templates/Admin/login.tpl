<?php 
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       login.tpl                                                   ##
##  Developed by:  Dzoki                                                       ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################
?>
<div align="center"><img src="../img/admin/admin.gif" width="468" height="60" border="0"></div>



<p>Login to control panel:</p>



<form method="post" action="admin.php">

<input type="hidden" name="action" value="login">

<p class="old_p1">

<table width="100%" cellspacing="1" cellpadding="0">

<tr><td><label>Username:</label>

<input class="fm fm110" type="text" name="name" value="<?php echo $_SESSION['username']?>" maxlength="15"> <span class="e f7"></span>

</td></tr>

<tr><td><label>Password:</label>

<input class="fm fm110" type="password" name="pw" value="" maxlength="20"> <span class="e f7"></span>


</td></tr>

</table>

</p>

<p align="center"><input type="image" border="0" src="../img/admin/b/l1.gif" width="80" height="20">
<img align="right" src="../img/admin/senator_roemer.png" width="450" height="620">


</form>




