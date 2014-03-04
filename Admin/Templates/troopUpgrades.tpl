<?php
if($_SESSION['access'] < 9) die("Access Denied: You are not Admin!");
?>
<table id="member">
	<thead>
		<tr>
			<th colspan="16">Troop Upgrades</th>
		</tr>
		<tr>
			<td colspan="8">Armoury</td>
			<td colspan="8">Blacksmith</td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<?php
				$tribe = $user['tribe'];
				if($tribe ==1){ $img = ""; }
				if($tribe ==2){ $img = "1";}
				if($tribe ==3){ $img = "2";}
				if($tribe ==4){ $img = "3";}
				if($tribe ==5){ $img = "4";}
				if($tribe ==6){ $img = "5";}
				
				for($i=1; $i<9; $i++)
				{
					echo '<td><center><img src="../img/un/u/'.$img.''.$i.'.gif"></center></td>';
				}
				for($i=1; $i<9; $i++)
				{
					echo '<td><center><img src="../img/un/u/'.$img.''.$i.'.gif"></center></td>';
				}
			?>
		</tr>
	</tbody>
	<tfoot>
		<tr>
			<?php
				##A
				for($i=1; $i<9; $i++)
				{
					if($tribe==5) { $abtech['a'.$i]="<font color=\"grey\">?</font>"; $abtech['b'.$i]="<font color=\"grey\">?</font>";}
					echo '<td><center>'.$abtech['a'.$i].'</center></td>';
				} ##B
				for($i=1; $i<9; $i++)
				{
					echo '<td><center>'.$abtech['b'.$i].'</center></td>';
				}
			?>
		</tr>
	</tfoot>
</table>
	<?php
		if($_SESSION['access'] == ADMIN)
		{
			if($tribe==5) { echo '<span class="none">Upgrades Troops</span>';}
			else { echo '<a href="admin.php?p=addABTroops&did='.$_GET['did'].'">Upgrades Troops</a>';}
		}
		if(isset($_GET['ab'])){
			echo '<div align="right"><font color="Red"><b>AB Tech Troops upgrades</font></b></div>';
		}
	?>
	
	