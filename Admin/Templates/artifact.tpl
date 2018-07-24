<?php 
include_once("../GameEngine/Artifacts.php");

$artifact = reset($database->getOwnArtefactInfo($_GET['did']));
$artifactOfTheFool = !empty($artifact) && $artifact['type'] == 8;
$artifactInfo = Artifacts::getArtifactInfo($artifact);
?>
<table id="member">
	<thead>
		<tr>
			<th colspan="8">Artifact</th>
		</tr>
		<tr>
			<td class="ra"></td>
			<td class="ra"></td>
			<td colspan="1">Name</td>
			<td colspan="1">Bonus</td>
			<td colspan="1">Area of effect</td>
			<td colspan="1">Time of conquer</td>
			<td colspan="1">Time of activation</td>
			<?php if($artifactOfTheFool){?>
			<td colspan="1">Next activation</td>
			<?php } ?>	
		</tr>
	</thead>
	<tbody>
	<?php 
	if(empty($artifact)){
	?>
		<tr>
			<td colspan="8"><div style="text-align: center"><?php echo NO_ARTIFACTS; ?></div></td>
		</tr>
	<?php }else{ ?>
		<tr>
			<td><a href="?action=delArtifact&artid=<?php echo $artifact['id']; ?>&del=0" onClick="return del('arti', <?php echo $artifact['id']; ?>)"><img src="../img/admin/del.gif"></a></td>
			<td class="icon"><img class="artefact_icon_<?php echo $artifact['type']; ?>" src="../img/x.gif"></td>
			<td colspan="1"><div style="text-align: center"><?php echo $artifact['name']; ?></div></td>
			<td colspan="1"><div style="text-align: center"><?php echo $artifactInfo['bonus']; ?></div></td>
			<td colspan="1"><div style="text-align: center"><?php echo $artifactInfo['effectInfluence']; ?></div></td>
			<td colspan="1"><div style="text-align: center"><?php echo date("d.m.Y H:i:s", $artifact['conquered']); ?></div></td>
			<td colspan="1"><div style="text-align: center"><?php echo $artifactInfo['active']; ?></div></td>
			<?php if($artifactOfTheFool){?>
			<td colspan="1"><div style="text-align: center"><?php echo $artifactInfo['nextEffect']; ?></div></td>
			<?php } ?>
		</tr>
	<?php } ?>
	</tbody>
</table>
	<?php
	
	if($village['owner'] != 3 && !empty($artifact)) echo '<a href="admin.php?action=returnArtifact&artid='.$artifact['id'].'">Return to Natars</a>';
	?>
	