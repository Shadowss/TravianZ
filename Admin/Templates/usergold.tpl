<?php
#################################################################################
##  Filename       usergold.tpl                                                ##
##  Developed by:  aggenkeech                                                  ##
##  Refactored by: Shadow                                                      ##
#################################################################################
if($_SESSION['access'] < ADMIN) die("Access Denied: You are not Admin!");
?>
<form action="../GameEngine/Admin/Mods/gold_1.php" method="POST">
	<input type="hidden" name="admid" value="<?php echo $_SESSION['id']; ?>">
	<table id="member" style="width:300px;">
		<thead>
			<tr><th colspan="2">Give Free gold for specific user</th></tr>
		</thead>
		<tbody>
			<tr>
				<td><center><b>How much gold?</b></center></td>
				<td><center>
					<input class="give_gold" name="gold" value="20" maxlength="6">&nbsp;
					<img src="../img/admin/gold.gif" class="gold" alt="Gold" title="Gold"/>
				</center></td>
			</tr>
			<tr>
				<td><center><b>For which user (id)?</b></center></td>
				<td><center><input class="give_gold" name="id" value=""></center></td>
			</tr>
			<tr>
				<td colspan="2"><center>
					<input type="image" src="../img/admin/b/ok1.gif" value="submit" title="Give Player Free Gold">
				</center></td>
			</tr>
		</tbody>
	</table>
</form>

<?php if(isset($_GET['g'])){ echo '<br><br><font color="green"><b>Gold Added</b></font>'; } ?>