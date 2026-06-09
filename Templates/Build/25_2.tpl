<?php
// 25_2.tpl - RESIDENCE CULTURE POINTS
global $village, $database, $session, $id;

$level = (int)$village->resarray['f'.$id];
$isNatar = (int)$database->getVillageField($village->wid, 'natar') == 1;
$villageCp = $isNatar ? 0 : (int)$database->getVillageField($village->wid, 'cp');
$accountCp = (int)$database->getVSumField($session->uid, 'cp');
$totalVillages = count($database->getProfileVillages($session->uid));

$mode = CP;
$nextCpNeeded = ${'cp'.$mode}[$totalVillages + 1];
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

    <p><?php echo RESIDENCE_CULTURE_DESC;?></p>

    <table cellpadding="1" cellspacing="1" id="build_value">
        <tr>
            <th><?php echo PRODUCTION_POINTS;?></th>
            <td><b><?php echo $villageCp;?></b> <?php echo POINTS_DAY;?></td>
        </tr>
        <tr>
            <th><?php echo PRODUCTION_ALL_POINTS;?></th>
            <td><b><?php echo $accountCp;?></b> <?php echo POINTS_DAY;?></td>
        </tr>
    </table>
    <p><?php echo VILLAGES_PRODUCED;?> <b><?php echo $session->cp;?></b> <?php echo POINTS_NEED;?> <b><?php echo $nextCpNeeded;?></b> <?php echo POINTS;?>.</p>
</div>