<?php
// 26_3.tpl - PALACE / LOIALITY
global $database, $village;

$level = (int)$village->resarray['f'.$id];
$loyalty = floor((float)$database->getVillageField($village->wid, 'loyalty'));
$loyalty = max(0, min(100, $loyalty)); // siguranță: între 0-100%
?>
<div id="build" class="gid26">
    <h1><?php echo PALACE; ?> <span class="level"><?php echo LEVEL.' '.$level; ?></span></h1>
    
    <p class="build_desc">
        <a href="#" onclick="return Popup(26,4,'gid');" class="build_logo">
            <img class="building g26" src="img/x.gif" alt="<?php echo PALACE; ?>" title="<?php echo PALACE; ?>" />
        </a>
        <?php echo PALACE_DESC; ?>
    </p>

    <?php include("26_menu.tpl"); ?>

    <p class="loyalty">
        <?php echo RESIDENCE_LOYALTY_DESC; ?> 
        <b><?php echo $loyalty; ?></b> <?php echo PERCENT; ?>.
    </p>
</div>