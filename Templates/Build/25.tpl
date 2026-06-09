<?php
// 25.tpl - Residence
global $village, $id;

$level = (int)$village->resarray['f'.$id];
?>
<div id="build" class="gid25">
    <h1><?php echo RESIDENCE;?> <span class="level"><?php echo LEVEL;?> <?php echo $level;?></span></h1>
    <p class="build_desc">
        <a href="#" onClick="return Popup(25,4, 'gid');" class="build_logo">
            <img class="building g25" src="img/x.gif" alt="<?php echo RESIDENCE; ?>" title="<?php echo RESIDENCE;?>" />
        </a>
        <?php echo RESIDENCE_DESC;?>
    </p>

    <?php if ($village->capital == 1):?>
        <p class="act"><?php echo CAPITAL;?></p>
    <?php endif;?>

    <?php include("25_menu.tpl"); ?>

    <?php if ($level >= 10):?>
        <?php include("25_train.tpl");?>
    <?php else:?>
        <div class="c"><?php echo RESIDENCE_TRAIN_DESC;?></div>
    <?php endif;?>

    <?php include("upgrade.tpl");?>
</div>