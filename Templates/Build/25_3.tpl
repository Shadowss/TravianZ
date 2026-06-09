<?php
// 25_3.tpl - Residence loyalty
global $village, $database, $id;

$level = (int)$village->resarray['f'.$id];
$loyalty = floor((float)$database->getVillageField($village->wid, 'loyalty'));
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

    <p><?php echo RESIDENCE_LOYALTY_DESC;?> <b><?php echo $loyalty;?></b> <?php echo PERCENT;?>.</p>
</div>