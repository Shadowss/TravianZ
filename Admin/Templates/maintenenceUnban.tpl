<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       maintenenceUnban.tpl                                        ##
##  Developed by:  aggenkeech                                                  ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2012. All rights reserved.                ##
##                                                                             ##
#################################################################################

$bannedUsers = $admin->search_banned();
?>
<form action="../GameEngine/Admin/Mods/mainteneceUnban.php" method="POST">
	<input type="hidden" name="admid" id="admid" value="<?php echo $_SESSION['id']; ?>">
	
	<br />		
	<table id="member" cellpadding="1" cellspacing="1" >
		<thead>
			<tr>
				<th colspan="2">Open Server (Unban Players by Reason)</th>
			</tr> 
			<tr>
				<td class="on">Unban "Reason"</td>
				<td class="hab">Action</td>
			</tr>
		</thead>
		<tbody> 
			<tr>
				<td><input type="text" class="fm" name="unbanreason" value=""></td>
				<td class="hab" colspan="2"><center><input type="image" src="../img/admin/b/ok1.gif" value="submit"></center></td>
			</tr>
		</tbody>
	</table>
</form>

<table id="member" cellpadding="1" cellspacing="1">
    <thead>
		<tr>
			<th colspan="6">Bannned Players (<?php echo count($bannedUsers); ?>)</th>
		</tr>
		<tr>
			<td><b>Username</b></td>
			<td><b>Start Ban / End Ban</b></td>
			<td><b>Reason</b></td>
			<td></td>
		</tr>
		</thead>
		<tbody>
		<?php
			if($bannedUsers)
			{
				for ($i = 0; $i <= count($bannedUsers)-1; $i++)
				{
					if($database->getUserField($bannedUsers[$i]['uid'],'username',0)=='')
					{

						$name = $bannedUsers[$i]['name'];
						$link = "<span class=\"c b\">[".$name."]</span>";

					}
					else
					{
						$name = $database->getUserField($bannedUsers[$i]['uid'],'username',0);
						$link = '<a href="?p=player&uid='.$bannedUsers[$i]['uid'].'">'.$name.'<a/>';

					} 
					if($bannedUsers[$i]['end'])
					{
						$end = date("d.m.y H:i",$bannedUsers[$i]['end']);
					}
					else
					{
						$end = '*';
					}
					echo '
					<tr>
						<td>'.$link.'</td>
						<td ><span class="f7">'.date("d.m.y H:i",$bannedUsers[$i]['time']).' - '.$end.'</td>
						<td>'.$bannedUsers[$i]['reason'].'</td>
						<td class="on"><a href="?action=delBan&uid='.$bannedUsers[$i]['uid'].'&id='.$bannedUsers[$i]['id'].'" onClick="return del(\'unban\',\''.$name.'\')"><img src="../img/Admin/del.gif" class="del" title="cancel" alt="cancel"></img></a></td>
					</tr>';
				}
			}
			else
			{
				echo '<tr><td colspan="6" class="on">No Players are Banned</td></tr>';
			}
		?>
    </tbody>
</table>