<?php

$artefact = $database->getArtefactDetails($_GET['show']);
if($artefact['size'] == 1 && $artefact['type'] != 11){
                       $reqlvl = 10;
                       $effect = VILLAGE;
                   }else{
                                         if($artefact['type'] != 11){
                       $reqlvl = 20;
                                         }else{
                                         $reqlvl = 10;
                                         }
$effect = ACCOUNT;
}
if ($artefact['conquered'] >= (time()-86400)){
                   $active = date("Y-m-d H:i:s",$artefact['conquered']+86400);
                   }else{
                    $active = ACTIVE;
                   }
//// Added by brainiac - thank you
if ($artefact['type'] == 8){$kind=$artefact['kind']; $effecty=$artefact['effect2'];}else{$kind=$artefact['type']; $effecty=$artefact['effect'];}
         switch($kind){
                             case 1:
                             if($artefact['type'] == 8 && $artefact['bad_effect']==1){$betterorbadder=BUILDING_WEAKER;}else{$betterorbadder=BUILDING_STRONGER;}
         break;
         case 2:
         if($artefact['type'] == 8 && $artefact['bad_effect']==1){$betterorbadder=TROOPS_SLOWEST;}else{$betterorbadder=TROOPS_FASTER;}
         break;
         case 3:
         if($artefact['type'] == 8 && $artefact['bad_effect']==1){$betterorbadder=SPIES_DECRESE;}else{$betterorbadder=SPIES_INCREASE;}
         break;
         case 4:
         if($artefact['type'] == 8 && $artefact['bad_effect']==1){$betterorbadder=CONSUME_HIGH;}else{$betterorbadder=CONSUME_LESS;}
         break;
         case 5:
         if($artefact['type'] == 8 && $artefact['bad_effect']==1){$betterorbadder=TROOPS_MAKE_SLOWEST;}else{$betterorbadder=TROOPS_MAKE_FASTER;}
         break;
         case 6:
         if($artefact['type'] == 8 && $artefact['bad_effect']==1){$betterorbadder=YOU_CONSTRUCT;}else{$betterorbadder=YOU_CONSTRUCT;}
         break;
         case 7:
         if($artefact['type'] == 8 && $artefact['bad_effect']==1){$betterorbadder=CRANNY_DECRESE;}else{$betterorbadder=CRANNY_INCREASED;}
         break;
         case 8:
         if($artefact['type'] == 8 && $artefact['bad_effect']==1){$betterorbadder=SPIES_INCREASE;}else{$betterorbadder=SPIES_DECRESE;}

         break;

}

$bonus=$betterorbadder." ".$effecty."";
?>

<div class="artefact image-6">
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
<a href="spieler.php?uid=<?php echo $artefact['owner'];?>"><?php echo $database->getUserField($artefact['owner'],"username",0);?></a>
</td>
</tr>
<tr>
<th><?php echo VILLAGE; ?></th>
<td>
<a href="karte.php?d=<?php echo $artefact['vref'];?>&c=<?php echo $generator->getMapCheck($artefact['vref']);?>"><?php echo $database->getVillageField($artefact['vref'], "name");?> </a>
</td>
</tr>
<tr>
<th><?php echo ALLIANCE; ?></th>
<td><a href="allianz.php?aid=<?php echo $database->getUserField($artefact['owner'],"alliance",0);?>"><?php echo $database->getAllianceName($database->getUserField($artefact['owner'],"alliance",0)); ?></a></td>
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
<td><?php echo date("Y-m-d H:i:s",$artefact['conquered']);?></td>
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

                                        <tr>
<td><span class="none"><a href="spieler.php?uid=<?php echo $artefact['owner'];?>"><?php echo $database->getUserField($artefact['owner'],"username",0);?></a></span></td>
<td><span class="none"><a href="karte.php?d=<?php echo $artefact['vref'];?>&c=<?php echo $generator->getMapCheck($artefact['vref']);?>"><?php echo $database->getVillageField($artefact['vref'], "name");?> </a></span></td>
<td><span class="none"><?php echo date("Y-m-d H:i:s",$artefact['conquered']);?></span></td>

</tr>

</tr></tbody></table></div>