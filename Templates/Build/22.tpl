<?php
// 22.tpl - ACADEMY
global $village, $building, $session, $id;

$level = (int)$village->resarray['f'.$id];
$hasAcademy = $building->getTypeLevel(22) > 0;
$tribe = (int)$session->tribe;
?>
<div id="build" class="gid22">
    <a href="#" onClick="return Popup(22,4);" class="build_logo">
        <img class="building g22" src="img/x.gif" alt="<?php echo ACADEMY; ?>" title="<?php echo ACADEMY;?>" />
    </a>
    <h1><?php echo ACADEMY;?> <span class="level"><?php echo LEVEL;?> <?php echo $level;?></span></h1>
    <p class="build_desc"><?php echo ACADEMY_DESC;?></p>

    <?php if ($hasAcademy):?>
        <?php include("22_".$tribe.".tpl");?>
    <?php else:?>
        <p><b><?php echo RESEARCH_COMMENCE_ACADEMY;?></b><br /></p>
    <?php endif;?>

    <?php include("upgrade.tpl");?>
</div>