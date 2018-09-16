<?php

include_once("GameEngine/Artifacts.php");

$artifact = $database->getArtefactDetails($_GET['show']);
if(empty($artifact)){
	header("location: build.php?gid=27");
	exit;
}

$artifactInfo = Artifacts::getArtifactInfo($artifact);

?>

<div class="artefact image-<?php echo str_replace(['type', '.gif'], '', $artifact['img']); ?>">
<table id="art_details" cellpadding="1" cellspacing="1">
<thead>
<tr>
<th colspan="2"><?php echo $artifact['name'];?></th>
</tr>
</thead>
<tbody>
<tr>
<td colspan="2" class="desc">

<span class="detail"><?php echo $artifact['desc'];?></span>
</td>
</tr>
<tr>
<th><?php echo OWNER; ?></th>
<td>
<?php if(($artifactOwnerUsername = $database->getUserField($artifact['owner'], "username", 0)) != "[?]"){?>
<a href="spieler.php?uid=<?php echo $artifact['owner'];?>"><?php echo $artifactOwnerUsername; ?></a>
<?php }else{?>
<font color="grey"><span>[?]</span></font>
<?php } ?>
</td>
</tr>
<tr>
<th><?php echo VILLAGE; ?></th>
<td>
<?php if($database->checkVilExist($artifact['vref'])){?>
<a href="karte.php?d=<?php echo $artifact['vref'];?>&c=<?php echo $generator->getMapCheck($artifact['vref']);?>"><?php echo $database->getVillageField($artifact['vref'], "name");?> </a>
<?php }else{?>
<font color="grey"><span>[?]</span></font>
<?php }?>
</td>
</tr>
<tr>
<th><?php echo ALLIANCE; ?></th>
<td>
<?php if(($alliance = $database->getUserField($artifact['owner'], "alliance", 0)) > 0){ ?>
<a href="allianz.php?aid=<?php echo $alliance;?>"><?php echo $database->getAllianceName($alliance); ?></a>
<?php }else{?>
<span>-</span>
<?php }?>
</td>
</tr>
<tr>
<th><?php echo AREA_EFFECT; ?></th>
<td><?php echo $artifactInfo['effectInfluence']; ?></td>
</tr>

<tr>
<th><?php echo BONUS; ?></th>
<td><?php echo $artifactInfo['bonus']; ?></td>
</tr>

<tr>
<th><?php echo REQUIRED_LEVEL; ?></th>
<td><?php echo TREASURY; ?> <?php echo LEVEL; ?> <b><?php echo $artifactInfo['requiredLevel']; ?></b></td>
</tr>

<tr>
<th><?php echo TIME_CONQUER; ?></th>
<td><?php echo ($artifact['owner'] != 3) ? date("d.m.Y H:i:s", $artifact['conquered']) : "-";?></td>
</tr>

<tr>
<th><?php echo TIME_ACTIVATION; ?></th>
<td><?php echo $artifactInfo['active'];?></td>
</tr>

<?php if($artifact['type'] == 8){?>
<tr>
<th><?php echo NEXT_EFFECT; ?></th>
<td><?php echo $artifactInfo['nextEffect'];?></td>
</tr>
<?php }?>

</tbody></table>
<table class="art_details" cellpadding="1" cellspacing="1">
<thead>
<tr>
<th colspan="3"><?php echo FORMER_OWNER; ?></th>
</tr>
<tr>
<td><?php echo PLAYER; ?></td>
<td><?php echo VILLAGE; ?></td>
<td><?php echo CONQUERED; ?></td>
</tr>
</thead>
<tbody>
<?php
$owners = $database->getArtifactsChronology($_GET['show']);
if(!empty($owners)){
foreach($owners as $owner){
?>
<tr>
<td>
<?php if(($artifactChronoOwnerUsername = $database->getUserField($owner['uid'], "username", 0)) != "[?]"){?>
<span class="none"><a href="spieler.php?uid=<?php echo $owner['uid'];?>"><?php echo $artifactChronoOwnerUsername;?></a></span>
<?php }else{?>
<span class="none">[?]</span>
<?php }?>
</td>
<td>
<?php if($database->checkVilExist($owner['vref'])){?>
<span class="none"><a href="karte.php?d=<?php echo $owner['vref'];?>&c=<?php echo $generator->getMapCheck($owner['vref']);?>"><?php echo $database->getVillageField($owner['vref'], "name");?></a></span>
<?php }else{?>
<span class="none">[?]</span>
<?php }?>
</td>
<td><span class="none"><?php echo date("d.m.Y H:i:s", $owner['conqueredtime']);?></span></td>
</tr>
<?php 
} 
}else{
?>
<tr>
    <td colspan="3"><span class="none"><?php echo NO_PREVIOUS_OWNERS; ?></span></td>
</tr>
<?php
}
?>
</tbody></table></div>