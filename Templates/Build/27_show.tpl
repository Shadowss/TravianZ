<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : TREASURY SHOW       	                                   ##
##  Type           : BUILDING TEMPLATE                                         ##
## --------------------------------------------------------------------------- ##
##  Refactored by  : Shadow                                                    ##
##  Redesign by    : Shadow                                                    ##
## --------------------------------------------------------------------------- ##
##  Contact        : cata7007@gmail.com                                        ##
##  Project        : TravianZ                                                  ##
##  Test Server    : https://travianz.org                                      ##
##  GitHub         : https://github.com/Shadowss/TravianZ                      ##
## --------------------------------------------------------------------------- ##
##  License        : TravianZ Project                                          ##
##  Copyright      : TravianZ (c) 2010-2026. All rights reserved.              ##
## --------------------------------------------------------------------------- ##
#################################################################################

include_once("GameEngine/Artifacts.php");

$showId = (int)($_GET['show'] ?? 0);
$artifact = $database->getArtefactDetails($showId);

if(empty($artifact)){
	header("location: build.php?id=" . ($id ?? 0));
	exit;
}

$artifactInfo = Artifacts::getArtifactInfo($artifact);
$imgClass = str_replace(['type', '.gif'], '', $artifact['img'] ?? '');
?>

<div class="artefact image-<?php echo $imgClass; ?>">
<table id="art_details" cellpadding="1" cellspacing="1">
<thead>
<tr>
<th colspan="2"><?php echo $artifact['name'] ?? '-';?></th>
</tr>
</thead>
<tbody>
<tr>
<td colspan="2" class="desc">
<span class="detail"><?php echo $artifact['desc'] ?? '';?></span>
</td>
</tr>
<tr>
<th><?php echo OWNER; ?></th>
<td>
<?php 
$artifactOwnerUsername = $database->getUserField($artifact['owner'] ?? 0, "username", 0) ?? "[?]";
if($artifactOwnerUsername != "[?]" && !empty($artifact['owner'])){ ?>
<a href="spieler.php?uid=<?php echo $artifact['owner'];?>"><?php echo $artifactOwnerUsername; ?></a>
<?php } else { ?>
<font color="grey"><span>[?]</span></font>
<?php } ?>
</td>
</tr>
<tr>
<th><?php echo VILLAGE; ?></th>
<td>
<?php if(!empty($artifact['vref']) && $database->checkVilExist($artifact['vref'])){ 
    $villageName = $database->getVillageField($artifact['vref'], "name") ?? '[?]';
?>
<a href="karte.php?d=<?php echo $artifact['vref'];?>&c=<?php echo $generator->getMapCheck($artifact['vref']);?>"><?php echo $villageName;?> </a>
<?php } else { ?>
<font color="grey"><span>[?]</span></font>
<?php }?>
</td>
</tr>
<tr>
<th><?php echo ALLIANCE; ?></th>
<td>
<?php 
$alliance = (int)($database->getUserField($artifact['owner'] ?? 0, "alliance", 0) ?? 0);
if($alliance > 0){ 
    $allianceName = $database->getAllianceName($alliance) ?? '-';
?>
<a href="allianz.php?aid=<?php echo $alliance;?>"><?php echo $allianceName; ?></a>
<?php } else { ?>
<span>-</span>
<?php }?>
</td>
</tr>
<tr>
<th><?php echo AREA_EFFECT; ?></th>
<td><?php echo $artifactInfo['effectInfluence'] ?? '-'; ?></td>
</tr>

<tr>
<th><?php echo BONUS; ?></th>
<td><?php echo $artifactInfo['bonus'] ?? '-'; ?></td>
</tr>

<tr>
<th><?php echo REQUIRED_LEVEL; ?></th>
<td><?php echo TREASURY; ?> <?php echo LEVEL; ?> <b><?php echo $artifactInfo['requiredLevel'] ?? 0; ?></b></td>
</tr>

<tr>
<th><?php echo TIME_CONQUER; ?></th>
<td><?php echo (!empty($artifact['owner']) && $artifact['owner'] != 3 && !empty($artifact['conquered'])) ? date("d.m.Y H:i:s", $artifact['conquered']) : "-";?></td>
</tr>

<tr>
<th><?php echo TIME_ACTIVATION; ?></th>
<td><?php echo $artifactInfo['active'] ?? '-';?></td>
</tr>

<?php if(($artifact['type'] ?? 0) == 8){?>
<tr>
<th><?php echo NEXT_EFFECT; ?></th>
<td><?php echo $artifactInfo['nextEffect'] ?? '-';?></td>
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
$owners = $database->getArtifactsChronology($showId);
if(!empty($owners)){
    foreach($owners as $owner){
        $chronoUsername = $database->getUserField($owner['uid'] ?? 0, "username", 0) ?? "[?]";
        $chronoVillage = (!empty($owner['vref']) && $database->checkVilExist($owner['vref'])) ? ($database->getVillageField($owner['vref'], "name") ?? '[?]') : '[?]';
        $chronoTime = !empty($owner['conqueredtime']) ? date("d.m.Y H:i:s", $owner['conqueredtime']) : '-';
?>
<tr>
<td>
<?php if($chronoUsername != "[?]"){?>
<span class="none"><a href="spieler.php?uid=<?php echo $owner['uid'];?>"><?php echo $chronoUsername;?></a></span>
<?php } else { ?>
<span class="none">[?]</span>
<?php }?>
</td>
<td>
<?php if($chronoVillage != '[?]'){?>
<span class="none"><a href="karte.php?d=<?php echo $owner['vref'];?>&c=<?php echo $generator->getMapCheck($owner['vref']);?>"><?php echo $chronoVillage;?></a></span>
<?php } else { ?>
<span class="none">[?]</span>
<?php }?>
</td>
<td><span class="none"><?php echo $chronoTime;?></span></td>
</tr>
<?php 
    } 
} else {
?>
<tr>
    <td colspan="3"><span class="none"><?php echo NO_PREVIOUS_OWNERS; ?></span></td>
</tr>
<?php
}
?>
</tbody></table></div>