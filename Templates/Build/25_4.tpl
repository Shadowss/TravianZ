<?php
// 25_4.tpl - RESIDENCE EXPANSION 
global $village, $database, $generator, $id;

$level = (int)$village->resarray['f'.$id];
$slots = [
    (int)$database->getVillageField($village->wid, 'exp1'),
    (int)$database->getVillageField($village->wid, 'exp2'),
    (int)$database->getVillageField($village->wid, 'exp3'),
];
?>
<div id="build" class="gid25">
    <h1><?php echo RESIDENCE;?> <span class="level"><?php echo LEVEL;?> <?php echo $level;?></span></h1>
    <p class="build_desc">
        <a href="#" onClick="return Popup(25,4, 'gid');" class="build_logo">
            <img class="building g25" src="img/x.gif" alt="<?php echo RESIDENCE; ?>" title="<?php echo RESIDENCE;?>" />
        </a>
        <?php echo RESIDENCE_DESC;?>
    </p>

    <?php include("25_menu.tpl"); ?>

    <table cellpadding="1" cellspacing="1" id="expansion">
        <thead>
            <tr><th colspan="6"><a name="h2"></a><?php echo CONQUERED_BY_VILLAGE;?></th></tr>
            <tr>
                <td colspan="2"><?php echo VILLAGE;?></td>
                <td><?php echo PLAYER;?></td>
                <td><?php echo INHABITANTS;?></td>
                <td><?php echo COORDINATES;?></td>
                <td><?php echo DATE;?></td>
            </tr>
        </thead>
        <tbody>
            <?php $hasSlots = false; foreach ($slots as $idx => $slotId): if ($slotId == 0) continue; $hasSlots = true;
                $coor = $database->getCoor($slotId);
                $vname = $database->getVillageField($slotId, 'name');
                $owner = $database->getVillageField($slotId, 'owner');
                $pop = $database->getVillageField($slotId, 'pop');
                $vcreated = $database->getVillageField($slotId, 'created');
                $ownername = $database->getUserField($owner, 'username', 0);
           ?>
            <tr>
                <td class="ra"><?php echo $idx+1;?>.</td>
                <td class="vil"><a href="karte.php?d=<?php echo $slotId;?>&c=<?php echo $generator->getMapCheck($slotId);?>"><?php echo htmlspecialchars($vname);?></a></td>
                <td class="pla"><a href="spieler.php?uid=<?php echo $owner;?>"><?php echo htmlspecialchars($ownername);?></a></td>
                <td class="ha"><?php echo (int)$pop;?></td>
                <td class="aligned_coords"><div class="cox">(<?php echo $coor['x'];?></div><div class="pi">|</div><div class="coy"><?php echo $coor['y'];?>)</div></td>
                <td class="dat"><?php echo date('d.m.Y', $vcreated);?></td>
            </tr>
            <?php endforeach; if (!$hasSlots):?>
            <tr><td colspan="6" class="none"><?php echo NONE_CONQUERED_BY_VILLAGE;?></td></tr>
            <?php endif;?>
        </tbody>
    </table>
</div>