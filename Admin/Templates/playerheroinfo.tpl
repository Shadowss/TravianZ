<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       playerheroinfo.tpl                                          ##
##  Developed by:  ronix                                                       ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2014. All rights reserved.                ##
##                                                                             ##
#################################################################################

include_once("../GameEngine/Data/hero_full.php"); 
include_once("../GameEngine/Units.php");
$id = (int) $_GET['uid'];
$hero = $units->Hero($id,1);

// find a hero who's alive
$heroAliveIndex = -1;
if ($hero !== false) {
	foreach ($hero as $hid => $h) {
		if (!$h['dead']) {
			$heroAliveIndex = $hid;
			break;
		}
	}
}
?>
<style>
td {
	vertical-align:middle; padding:2px 7px; border:1px solid silver; font-size:13px; color:black;
}
th {
	vertical-align:middle; padding:2px 7px; border:1px solid silver; font-size:13px; color:black;
}
thead {
	background-image:url(../img/un/a/c2.gif); background-repeat:repeat; text-align:center; font-weight:bold;
}

</style>
<table style="border-collapse:collapse; margin-top:25px; line-height:16px; width:100%;">
	<thead>
	<tr>
		<td colspan="3">Player Heroes</td>
	</tr>
	</thead>
	<?php if ($hero === false) {?>
		<tr>
			<td colspan="3" align="center">None &nbsp;&nbsp;<font color="blue">Add Hero</font>
			<?php
			$utribe=($user['tribe']-1)*10;
			echo "&nbsp;<a href='?action=addHero&uid=".$id."&u=".($utribe+1)."'><img class=\"unit u".($utribe+1)."\" src=\"img/x.gif\" alt=\"".$technology->getUnitName($utribe+1)."\" title=\"".$technology->getUnitName($utribe+1)."\" /></a>";
			echo "&nbsp;<a href='?action=addHero&uid=".$id."&u=".($utribe+2)."'><img class=\"unit u".($utribe+2)."\" src=\"img/x.gif\" alt=\"".$technology->getUnitName($utribe+2)."\" title=\"".$technology->getUnitName($utribe+2)."\" /></a>";
			if ($utribe!=20) {
				echo "&nbsp;<a href='?action=addHero&uid=".$id."&u=".($utribe+3)."'><img class=\"unit u".($utribe+3)."\" src=\"img/x.gif\" alt=\"".$technology->getUnitName($utribe+3)."\" title=\"".$technology->getUnitName($utribe+3)."\" /></a>";
			}else{
				echo "&nbsp;<a href='?action=addHero&uid=".$id."&u=".($utribe+4)."'><img class=\"unit u".($utribe+4)."\" src=\"img/x.gif\" alt=\"".$technology->getUnitName($utribe+4)."\" title=\"".$technology->getUnitName($utribe+4)."\" /></a>";
			}
			echo "&nbsp;<a href='?action=addHero&uid=".$id."&u=".($utribe+5)."'><img class=\"unit u".($utribe+5)."\" src=\"img/x.gif\" alt=\"".$technology->getUnitName($utribe+5)."\" title=\"".$technology->getUnitName($utribe+5)."\" /></a>";
			echo "&nbsp;<a href='?action=addHero&uid=".$id."&u=".($utribe+6)."'><img class=\"unit u".($utribe+6)."\" src=\"img/x.gif\" alt=\"".$technology->getUnitName($utribe+6)."\" title=\"".$technology->getUnitName($utribe+6)."\" /></a>";
			?>
		
		</tr>	
	<?php
		} else {
		$x = 1;
		foreach ($hero as $h) {
	?>
	<tr>
		<td colspan="3" style="text-align: center; color: blue; font-weight: bold">
			Hero #<?php echo $x++; ?>
		</td>
	</tr>
	<tr>
		<td width="35%">Hero Name</td> 
			<td colspan="2" width="65%"><?php echo $h['name']; ?></td> 
	</tr>
	<tr>
		<td>Hero Level</td> 
		<td colspan="2"><?php echo $h['level']; ?></td> 
	</tr>
	<tr>
		<td>Hero Unit</td> 
		<td colspan="2"><?php echo "<img class=\"unit u".$h['unit']."\" src=\"img/x.gif\" alt=\"".$technology->getUnitName($h['unit'])."\" title=\"".$technology->getUnitName($h['unit'])."\" /> (".$technology->getUnitName($h['unit']); ?>)</td> 
	</tr>
	<tr> 
		<td>Status</td> 
		<td colspan="2"<?php
			if ($h['dead']) {
				echo ' class="c5"';
			}
		?>>
		<?php
			if (!$h['dead']) {
		?>
			<span style="color: green; font-weight: bold">Alive</span>
			&nbsp;<a href='admin.php?p=editHero&uid=<?php echo $id; ?>&amp;hid=<?php echo $h['heroid'] ?>'>
			<img src="../img/admin/edit.gif" title="Edit Player Hero Info"></a>
			&nbsp;<a href='?action=killHero&uid=<?php echo $id; ?>'>
			<img src="../img/admin/del.gif" title="Kill Player Hero"></a></td>
		<?php
			} else {
		?>
			Dead &nbsp;
			<?php
				if ($heroAliveIndex === -1) {
			?><a href="?action=reviveHero&uid=<?php echo $id;?>&amp;hid=<?php echo $h['heroid'] ?>" title="Revive hero"><?php echo $refreshicon; ?></a>
			<?php
				} else {
					echo '<span style="color: black; font-size: smaller">(cannot revive, kill living hero first)</span>';
				}
			?>
		<?php
			}
		?>
	<?php if (!$h['dead']) { ?>
	<thead>
	<tr>
		<td width="35%">Details</td>
		<td width="40%">Point</td>
		<td width="25%">Level</td>
	</tr>
	</thead>
	<tr>
		<td>Offence</td> 
		<td><?php echo $h['atk']; ?></td> 
		<td><?php echo $h['attack']; ?></td> 
	</tr> 
	<tr> 
		<td>Defence</td> 
		<td><?php echo $h['di'] . "/" . $h['dc']; ?></td> 
			<td><?php echo $h['defence']; ?></td> 
		</tr> 
        <tr> 
			<td>Off-Bonus</td> 
			<td><?php echo ($h['ob']-1)*100; ?>%</td> 
			<td><?php echo $h['attackbonus']; ?></td> 
		</tr> 
		<tr> 
			<td>Def-Bonus</td> 
			<td><?php echo ($h['db']-1)*100; ?>%</td> 
			<td><?php echo $h['defencebonus']; ?></td> 
		</tr> 
		<tr> 
			<td>Regeneration</td> 
			<td><?php echo ($h['regeneration']*5*SPEED); ?>/Day</td> 
			<td><?php echo $h['regeneration']; ?></td> 
		<tr> 
			<?php 
			$count_level_exp=500-intval($h['attack']+$h['defence']+$h['attackbonus']+$h['defencebonus']+$h['regeneration']);
			if ($h['points']>$count_level_exp) $h['points']=$count_level_exp;
			if($h['experience'] < 495000){ ?>
				<td>Experience: <?php echo (int) (($h['experience'] - $hero_levels[$h['level']]) / ($hero_levels[$h['level']+1] - $hero_levels[$h['level']])*100) ?>%</td> 
		        <td colspan="2"><?php echo $h['points']; ?></td> 
			<?php }else{ ?>
				<td>Experience: 100%</td> 
		        <td colspan="2"><?php echo $h['points']; ?></td> 
			<?php } ?>
		</tr>
		<tr> 
			<td>Health</td> 
			<td colspan="2"><?php echo round($h['health']); ?>%</td> 
		<tr>
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
		<?php 
			} else {
		?>
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
		<?php
			}
		}
	}
	?>
	</table>	
	<?php
	if(isset($_GET['e'])){
		echo '<div align="center"><font color="Red"><b>Here could not be killed due to an unexpected error.</font></b></div>';
	}elseif(isset($_GET['kc'])){
		echo '<div align="center"><font color="blue"><b>Hero has been killed.</b></font></div>';
	}elseif(isset($_GET['rc'])){
		echo '<div align="center"><font color="blue"><b>Hero has been revived.</b></font></div>';
	}elseif(isset($_GET['re'])){
		echo '<div align="center"><font color="red"><b>Hero cannot be revived because another hero still lives or is in revival.</b></font></div>';
	}elseif(isset($_GET['ac'])){
		echo '<div align="center"><font color="blue"><b>A new hero was added.</b></font></div>';
	}elseif(isset($_GET['cs'])){
		echo '<div align="center"><font color="blue"><b>Hero information has been saved.</b></font></div>';
	}elseif(isset($_GET['ce'])){
		echo '<div align="center"><font color="Red"><b>Hero data could not be edited due to an unexpected error.</b></font></div>';
	}
	?>