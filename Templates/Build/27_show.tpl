<?php
$artefact = $database->getArtefactDetails($_GET['show']);
if($artefact['size'] == 1 && $artefact['type'] != 11){
    $reqlvl = 10;
    $effect = VILLAGE;
}else{
    $reqlvl = $artefact['type'] != 11 ? 20 : 10;
    $effect = ACCOUNT;
}

$activationTime = 86400 / (SPEED == 2 ? 1.5 : (SPEED == 3 ? 2 : SPEED));

if($artefact['owner'] == 3) $active = "-";
elseif(!$artefact['active'] && $artefact['conquered'] < time() - $activationTime) $active = "<b>Can't be activated</b>";
elseif (!$artefact['active']) $active = date("Y-m-d H:i:s", $artefact['conquered'] + $activationTime);
else $active = "<b>".ACTIVE."</b>";
                    
//// Added by brainiac - thank you
if ($artefact['type'] == 8)
{
    $kind = $artefact['kind']; 
    $effecty = $artefact['effect2'];
}else{
    $kind = $artefact['type'];
    $effecty = $artefact['effect'];
}

$artefactBadEffect = $artefact['type'] == 8 && $artefact['bad_effect'] == 1;
switch($kind){
    case 1:
        $betterorbadder = $artefactBadEffect ? BUILDING_WEAKER : BUILDING_STRONGER;
        break;
    case 2:
        $betterorbadder = $artefactBadEffect ? TROOPS_SLOWEST : TROOPS_FASTER;
        break;
    case 3:
        $betterorbadder = $artefactBadEffect ? SPIES_DECRESE : SPIES_INCREASE;
        break;
    case 4:
        $betterorbadder = $artefactBadEffect ? CONSUME_HIGH : CONSUME_LESS;
        break;
    case 5:
        $betterorbadder = $artefactBadEffect ? TROOPS_MAKE_SLOWEST : TROOPS_MAKE_FASTER;
        break;
    case 6:
        $betterorbadder = $artefactBadEffect ? YOU_CONSTRUCT : YOU_CONSTRUCT;
        break;
    case 7:
        $betterorbadder = $artefactBadEffect ? CRANNY_DECRESE : CRANNY_INCREASED;
        break;
    case 8:
        $betterorbadder = $artefactBadEffect ? SPIES_INCREASE : SPIES_DECRESE;
        break;
}

$bonus = $betterorbadder." (<b>".str_replace(["(", ")"], "" , $effecty)."</b>)";
?>

<div class="artefact image-<?php echo str_replace(['type', '.gif'], '', $artefact['img']); ?>">
<table id="art_details" cellpadding="1" cellspacing="1">
<thead>
<tr>
<th colspan="2"><?php echo $artefact['name'];?></th>
</tr>
</thead>
<tbody>
<tr>
<td colspan="2" class="desc">

<span class="detail"><?php echo $artefact['desc'];?></span>
</td>
</tr>
<tr>
<th><?php echo OWNER; ?></th>
<td>
<a href="spieler.php?uid=<?php echo $artefact['owner'];?>"><?php echo $database->getUserField($artefact['owner'], "username", 0);?></a>
</td>
</tr>
<tr>
<th><?php echo VILLAGE; ?></th>
<td>
<?php if($database->checkVilExist($artefact['vref'])){?>
<a href="karte.php?d=<?php echo $artefact['vref'];?>&c=<?php echo $generator->getMapCheck($artefact['vref']);?>"><?php echo $database->getVillageField($artefact['vref'], "name");?> </a>
<?php }else{?>
<span>[?]</span>
<?php }?>
</td>
</tr>
<tr>
<th><?php echo ALLIANCE; ?></th>
<td>
<?php if(($alliance = $database->getUserField($artefact['owner'], "alliance", 0)) > 0){ ?>
<a href="allianz.php?aid=<?php echo $alliance;?>"><?php echo $database->getAllianceName($alliance); ?></a>
<?php }else{?>
<span>-</span>
<?php }?>
</td>
</tr>
<tr>
<th><?php echo AREA_EFFECT; ?></th>
<td><?php echo $effect; ?></td>
</tr>

<tr>
<th><?php echo BONUS; ?></th>
<td><?php echo $bonus; ?></td>
</tr>

<tr>
<th><?php echo REQUIRED_LEVEL; ?></th>
<td><?php echo TREASURY; ?> <?php echo LEVEL; ?> <b><?php echo $reqlvl; ?></b></td>
</tr>

<tr>
<th><?php echo TIME_CONQUER; ?></th>
<td><?php echo ($artefact['owner'] != 3) ? date("Y-m-d H:i:s",$artefact['conquered']) : "-";?></td>
</tr>

<tr>
<th><?php echo TIME_ACTIVATION; ?></th>
<td><?php echo $active;?></td>
</tr>
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
<td><span class="none"><a href="spieler.php?uid=<?php echo $owner['uid'];?>"><?php echo $database->getUserField($owner['uid'], "username", 0);?></a></span></td>
<td>
<?php if($database->checkVilExist($owner['vref'])){?>
<span class="none"><a href="karte.php?d=<?php echo $owner['vref'];?>&c=<?php echo $generator->getMapCheck($owner['vref']);?>"><?php echo $database->getVillageField($owner['vref'], "name");?></a></span>
<?php }else{?>
<span class="none">[?]</span>
<?php }?>
</td>
<td><span class="none"><?php echo date("Y-m-d H:i:s", $owner['conqueredtime']);?></span></td>
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