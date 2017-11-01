<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       search.tpl                                                  ##
##  Developed by:  Dzoki                                                       ##
##  Reworked:      aggenkeech                                                  ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2012. All rights reserved.                ##
##                                                                             ##
#################################################################################
?>
<form action="" method="post">
	<br />
	<table id="member">
		<thead>
			<tr>
				<th colspan="3">Search v1.0</th>
			</tr>
		</thead>
		<tr class="slr3">
			<td>
				<select name="p" size="1" class="slr3">
					<option value="player" <?php if(isset($_POST['p']) && $_POST['p']=='player'){echo "selected";}?>>Search Players</option>
					<option value="alliances" <?php if(isset($_POST['p']) && $_POST['p']=='alliances'){echo "selected";}?>>Search Alliances</option>
					<option value="villages" <?php if(isset($_POST['p']) && $_POST['p']=='villages'){echo "selected";}?>>Search Villages</option>
					<option value="email" <?php if(isset($_POST['p']) && $_POST['p']=='email'){echo "selected";}?>>Search E-mails</option>
					<option value="ip" <?php if(isset($_POST['p']) && $_POST['p']=='ip'){echo "selected";}?>>Search IPs</option>
					<option value="deleted_players" <?php if(isset($_POST['p']) && $_POST['p']=='deleted_players'){echo "selected";}?>>Search Deleted Players</option>
				</select>
			</td>
			<td>
				<input name="s" value="<?php echo stripslashes((isset($_POST['p']) ? $_POST['s'] : ''));?>">
			</td>
			<td>
				<input type="submit" value="Search" class="slr3">
			</td>
		</tr>
	</table>
</form>

<?php
	if(!empty($_GET['msg']))
	{
		echo '<div style="margin-top: 50px;" class="b"><center>';
		if($_GET['msg'] == 'ursdel')
		{
			echo "User was deleted.";

		}
		echo '</center></div>';
	}
?>