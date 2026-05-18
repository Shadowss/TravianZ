<?php

// ARMOURY

$field = 'f' . $id;
$currentLevel = isset($village->resarray[$field]) ? (int)$village->resarray[$field] : 0;
$hasArmoury = $building->getTypeLevel(13) > 0;
?>
<div id="build" class="gid13">
    <a href="#" onclick="return Popup(13,4);" class="build_logo">
        <img class="building g13" src="img/x.gif" alt="<?php echo ARMOURY; ?>" title="<?php echo ARMOURY; ?>">
    </a>

    <h1>
        <?php echo ARMOURY; ?>
        <span class="level"><?php echo LEVEL; ?> <?php echo $currentLevel; ?></span>
    </h1>

    <p class="build_desc"><?php echo ARMOURY_DESC; ?></p>

    <?php if ($hasArmoury): ?>
        <?php include '13_upgrades.tpl'; ?>
    <?php else: ?>
        <p><b><?php echo UPGRADES_COMMENCE_ARMOURY; ?></b></p>
    <?php endif; ?>

    <?php include 'upgrade.tpl'; ?>
</div>