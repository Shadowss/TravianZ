<?php 
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       add_village.tpl                                             ##
##  Developed by:  Dzoki                                                       ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################
?>
<style>
.del {width:12px; height:12px; background-image: url(img/admin/icon/del.gif);} 
</style>  
<form method="post" action="admin.php">
<input name="action" type="hidden" value="addVillage">
<input name="uid" type="hidden" value="<?php echo $user['id'];?>">
<table id="member" style="width: 225px;"> 
  <thead>
    <tr>
        <th colspan="2">Add Village</th>
    </tr>
  </thead>   
  
	<tr>
        <td colspan="2"><center>Coordinates (<b>X</b>|<b>Y</b>)</center></td>
    </tr>  
    
	<tr>
        <td>X:</td>
        <td><input name="x" class="fm" value="" type="input" <?php if($_SESSION['access'] == ADMIN){ echo ''; } else if($_SESSION['access'] == MULTIHUNTER){ echo 'disabled="disabled"'; } ?>></td>
    </tr>
	
    <tr>
        <td>Y:</td>
        <td><input name="y" class="fm" value="" type="input" <?php if($_SESSION['access'] == ADMIN){ echo ''; } else if($_SESSION['access'] == MULTIHUNTER){ echo 'disabled="disabled"'; } ?>></td>
    </tr>
	
    <tr>
        <td colspan="2"><center><input value="Add Village" type="submit" <?php if($_SESSION['access'] == ADMIN){ echo ''; } else if($_SESSION['access'] == MULTIHUNTER){ echo 'disabled="disabled"'; } ?>></center></td>
    </tr> 
	
</table>
</form>