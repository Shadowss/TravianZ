<?php 
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       punish.tpl                                                  ##
##  Developed by:  Dzoki                                                       ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################
?>
<?php

$active = $admin->getUserActive(); 

?>

<style>

.del {width:12px; height:12px; background-image: url(img/admin/icon/del.gif);} 

</style>  

<form method="post" action="admin.php">

<input name="action" type="hidden" value="punish">

<input name="uid" type="hidden" value="<?php echo $user['id'];?>">

<input type="hidden" name="admid" id="admid" value="<?php echo $_SESSION['id']; ?>">

<table id="member" style="width: 200px;"> 

  <thead>

    <tr>

        <th colspan="2">Punish Player</th>

    </tr>

  </thead>    

    <tr>
        <td><center /><select name="punish">
			<option name="punish" value="10" selected="selected">10%
			<option name="punish" value="20">20%
			<option name="punish" value="30">30%
			<option name="punish" value="40">40%
			<option name="punish" value="50">50%
			<option name="punish" value="60" <?php if($_SESSION['access'] == ADMIN){ echo ''; } else if($_SESSION['access'] == MULTIHUNTER){ echo 'disabled="disabled"'; } ?>>60%
			<option name="punish" value="70" <?php if($_SESSION['access'] == ADMIN){ echo ''; } else if($_SESSION['access'] == MULTIHUNTER){ echo 'disabled="disabled"'; } ?>>70%
			<option name="punish" value="80" <?php if($_SESSION['access'] == ADMIN){ echo ''; } else if($_SESSION['access'] == MULTIHUNTER){ echo 'disabled="disabled"'; } ?>>80%
			<option name="punish" value="90" <?php if($_SESSION['access'] == ADMIN){ echo ''; } else if($_SESSION['access'] == MULTIHUNTER){ echo 'disabled="disabled"'; } ?>>90%
			<option name="punish" value="100" <?php if($_SESSION['access'] == ADMIN){ echo ''; } else if($_SESSION['access'] == MULTIHUNTER){ echo 'disabled="disabled"'; } ?>>100%</option></td>

        <td rowspan="1"><center /><input value="OK" type="submit"></td>   

    </tr>

    <!--<tr>

        <td colspan="1" style="text-align: center;">

          <input type="checkbox" name="del_troop" value="1"> Delete troops

        </td>

    </tr>   
 <tr>

        <td colspan="1" style="text-align: center;">

          <input type="checkbox" name="clean_ware" value="1"> Empty warehouses 

        </td>

    </tr> -->     

</table>

</form>