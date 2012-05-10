<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       oasis.tpl                                                   ##
##  Developed by:  aggenkeech                                                  ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2012. All rights reserved.                ##
##                                                                             ##
#################################################################################
?>
<form action="../GameEngine/Admin/Mods/mainteneceCleanBanData.php" method="POST">
	<input type="hidden" name="admid" id="admid" value="<?php echo $_SESSION['id']; ?>">
	<td class="hab">Clean Banlist Data (TRUNCATE)</td>
	<td class="hab"><center><input type="image" src="../img/admin/b/ok1.gif" value="submit"></center></td>
</form>