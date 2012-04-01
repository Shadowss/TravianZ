<?php
#################################################################################
##                                                                             ##
##              -= YOU MUST NOT REMOVE OR CHANGE THIS NOTICE =-                ##
##                                                                             ##
## --------------------------------------------------------------------------- ##
##                                                                             ##
##  Project:       ZravianX                                                    ##
##  Version:       2011.11.05                                                  ##
##  Filename:      Templates/Admin/search.tpl                                  ##
##  Developed by:  Dzoki                                                       ##
##  Edited by:     ZZJHONS                                                     ##
##  License:       Creative Commons BY-NC-SA 3.0                               ##
##  Copyright:     ZravianX (c) 2011 - All rights reserved                     ##
##  URLs:          http://zravianx.zzjhons.com                                 ##
##  Source code:   http://www.github.com/ZZJHONS/ZravianX                      ##
##                                                                             ##
#################################################################################
?>
<form action="" method="post">  
<table id="member">
  <thead>
    <tr>
        <th colspan="3">Search v1.01</th>
    </tr>
  </thead> 
  <tr class="slr3">
    <td> 
      <select name="p" size="1" class="slr3">
        <option value="player" <?php if($_POST['p']=='player'){echo "selected";}?>>Search player</option>
        <option value="alliances" <?php if($_POST['p']=='alliances'){echo "selected";}?>>Search alliances</option>
        <option value="villages" <?php if($_POST['p']=='villages'){echo "selected";}?>>Search villages</option>
        <option value="email" <?php if($_POST['p']=='email'){echo "selected";}?>>Search E-mail</option>
        <option value="ip" <?php if($_POST['p']=='ip'){echo "selected";}?>>Search IPs</option>
        <option value="deleted_players" <?php if($_POST['p']=='deleted_players'){echo "selected";}?>>Search deleted players</option>
      </select>
    </td>
    <td>
      <input name="s" value="<?php echo $_POST['s'];?>">
    </td>
    <td>
      <input type=submit value="Search" class="slr3">
    </td>
  </tr>
</table>
</form>
<?php
	if($_GET['msg']){
		echo '<div style="margin-top: 50px;" class="b"><center>';
	if($_GET['msg'] == 'ursdel'){
            echo "User was deleted.";
        }
        echo '</center></div>';
	}
?>