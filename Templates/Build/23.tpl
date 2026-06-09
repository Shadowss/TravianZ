<?php
// 23.tpl - Cranny
global $session, $village, $database, $bid23, $id, $loopsame, $doublebuild, $master;

include("next.tpl");

$multiplier = (($session->tribe == 3) ? 2 : 1) * CRANNY_CAPACITY;
$actualLevel = (int)$village->resarray['f'.$id];
$level = min($actualLevel + 1 + $loopsame + $doublebuild + $master, 10);

$currentHidden = $database->getArtifactsValueInfluence($session->uid, $village->wid, 7, $bid23[$actualLevel]['attri'] * $multiplier);
$nextHidden = $database->getArtifactsValueInfluence($session->uid, $village->wid, 7, $bid23[$level]['attri'] * $multiplier);
?>
<div id="build" class="gid23">
    <a href="#" onClick="return Popup(23,4);" class="build_logo">
        <img class="building g23" src="img/x.gif" alt="<?php echo CRANNY; ?>" title="<?php echo CRANNY;?>" />
    </a>
    <h1><?php echo CRANNY;?> <span class="level"><?php echo LEVEL;?> <?php echo $actualLevel;?></span></h1>
    <p class="build_desc"><?php echo CRANNY_DESC;?></p>

    <table cellpadding="1" cellspacing="1" id="build_value">
        <tr>
            <th><?php echo CURRENT_HIDDEN_UNITS;?></th>
            <td><b><?php echo $currentHidden;?></b> <?php echo UNITS;?></td>
        </tr>
        <?php if ($actualLevel < 10):?>
        <tr>
            <th><?php echo HIDDEN_UNITS_LEVEL;?> <?php echo $level;?>:</th>
            <td><b><?php echo $nextHidden;?></b> <?php echo UNITS;?></td>
        </tr>
        <?php endif;?>
    </table>

    <?php include("upgrade.tpl");?>
</div>