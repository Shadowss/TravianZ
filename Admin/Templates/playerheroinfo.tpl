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
$id=$user['id'];
$hero = mysql_query("SELECT * FROM " . TB_PREFIX . "hero WHERE `uid` = ".$id); 
$hero_info = mysql_fetch_array($hero);
if (!empty($hero_info)) {
	$hero = $units->Hero($id,1);
}else {
$hero="none";
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
		<td colspan="3">Player Hero Info 
		<?php if (!$hero_info['dead'] && $hero!="none") {?>
			&nbsp;&nbsp;<a href='admin.php?p=editHero&uid=<?php echo $id; ?>'>
			<img src="../img/admin/edit.gif" title="Edit Player Hero Info"></a>
			&nbsp;<a href='?action=killHero&uid=<?php echo $id; ?>'>
			<img src="../img/admin/del.gif" title="Kill Player Hero"></a>
		<?php }?>	
		</td>
	</tr>
	</thead>
	<?php if ($hero=="none") {?>
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
	<?php }else {?>
	<tr>
		<td width="35%">Hero Name</td> 
			<td colspan="2" width="65%"><?php echo $hero_info['name']; ?></td> 
	</tr>
	<tr>
		<td>Hero Level</td> 
		<td colspan="2"><?php echo $hero_info['level']; ?></td> 
	</tr>
	<tr>
		<td>Hero Unit</td> 
		<td colspan="2"><?php echo "<img class=\"unit u".$hero_info['unit']."\" src=\"img/x.gif\" alt=\"".$technology->getUnitName($hero_info['unit'])."\" title=\"".$technology->getUnitName($hero_info['unit'])."\" /> (".$technology->getUnitName($hero_info['unit']); ?>)</td> 
	</tr>
	<?php if (!$hero_info['dead']) {?>
	<thead>
	<tr>
		<td width="35%">Details</td>
		<td width="40%">Point</td>
		<td width="25%">Level</td>
	</tr>
	</thead>
	<tr>
		<td>Offence</td> 
		<td><?php echo $hero['atk']; ?></td> 
		<td><?php echo $hero_info['attack']; ?></td> 
	</tr> 
	<tr> 
		<td>Defence</td> 
		<td><?php echo $hero['di'] . "/" . $hero['dc']; ?></td> 
			<td><?php echo $hero_info['defence']; ?></td> 
		</tr> 
        <tr> 
			<td>Off-Bonus</td> 
			<td><?php echo ($hero['ob']-1)*100; ?>%</td> 
			<td><?php echo $hero_info['attackbonus']; ?></td> 
		</tr> 
		<tr> 
			<td>Def-Bonus</td> 
			<td><?php echo ($hero['db']-1)*100; ?>%</td> 
			<td><?php echo $hero_info['defencebonus']; ?></td> 
		</tr> 
		<tr> 
			<td>Regeneration</td> 
			<td><?php echo ($hero_info['regeneration']*5*SPEED); ?>/Day</td> 
			<td><?php echo $hero_info['regeneration']; ?></td> 
		<tr> 
			<?php 
			$count_level_exp=500-intval($hero_info['attack']+$hero_info['defence']+$hero_info['attackbonus']+$hero_info['defencebonus']+$hero_info['regeneration']);
			if ($hero_info['points']>$count_level_exp) $hero_info['points']=$count_level_exp;
			if($hero_info['experience'] < 495000){ ?>
				<td>Experience: <?php echo (int) (($hero_info['experience'] - $hero_levels[$hero_info['level']]) / ($hero_levels[$hero_info['level']+1] - $hero_levels[$hero_info['level']])*100) ?>%</td> 
		        <td colspan="2"><?php echo $hero_info['points']; ?></td> 
			<?php }else{ ?>
				<td>Experience: 100%</td> 
		        <td colspan="2"><?php echo $hero_info['points']; ?></td> 
			<?php } ?>
		</tr>
		<tr> 
			<td>Health</td> 
			<td colspan="2"><?php echo round($hero_info['health']); ?>%</td> 
		<tr>
		<?php }else{?>
		<tr> 
			<td>Status</td> 
			<td colspan="2" class="c5">Dead &nbsp;&nbsp;<a href="?action=reviveHero&uid=<?php echo $id;?>" title="Revive hero"><?php echo $refreshicon; ?></a></td> 
		<tr>
	
	<?php }
	}
	?>
	</table>	
	<?php
	if(isset($_GET['e'])){
		echo '<div align="center"><font color="Red"><b>Problem to kill hero</font></b></div>';
	}elseif(isset($_GET['kc'])){
		echo '<div align="center"><font color="blue"><b>Kill hero has done</font></b></div>';
	}elseif(isset($_GET['rc'])){
		echo '<div align="center"><font color="blue"><b>Revive hero has done</font></b></div>';
	}elseif(isset($_GET['ac'])){
		echo '<div align="center"><font color="blue"><b>Add hero has done</font></b></div>';
	}elseif(isset($_GET['cs'])){
		echo '<div align="center"><font color="blue"><b>Change hero info has done</font></b></div>';
	}elseif(isset($_GET['ce'])){
		echo '<div align="center"><font color="Red"><b>Problem to change hero info</font></b></div>';
	}
	?>