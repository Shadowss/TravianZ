<?php 
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       gold.tpl                                                    ##
##  Developed by:  aggenkeech                                                  ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2012. All rights reserved.                ##
##                                                                             ##
#################################################################################

if($_SESSION['access'] < ADMIN) die("Access Denied: You are not Admin!");
$id = $_SESSION['id']; ?>

<form action="../GameEngine/Admin/Mods/givePlus.php" method="POST">
	<input type="hidden" name="admid" id="admid" value="<?php echo $_SESSION['id']; ?>">
	<table id="member" style="width:300px;">
		<thead>
			<tr>
				<th colspan="2">Give Everyone Free Plus</th>
			</tr>
			<tr>
				<td></td>
				<td></td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<center>
						<b>How Long?</b>
					</center>
				</td>
				<td>
					<center>
						<input class="fm" name="plus" value="1" maxlength="4"> Day
					</center>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<center>
						<input type="image" src="../img/admin/b/ok1.gif" value="submit" title="Give Players Free Gold">
					</center>
				</td>
			</tr>
		</tbody>
	</table>
</form>

<?php
    if(isset($_GET['g']))
	{
		echo '<br /><br /><font color="Red"><b>Plus Given</font></b>';
	}
?>