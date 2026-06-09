<?php
// 39.tpl - GREATGRANARY
global $village, $building, $bid39, $id, $loopsame, $doublebuild, $master;

include("next.tpl");

$level = (int)$village->resarray['f'.$id];
$current = $level > 0 ? (int)$bid39[$level]['attri'] * STORAGE_MULTIPLIER : 0;
?>
<div id="build" class="gid39">
    <a href="#" onClick="return Popup(39,4);" class="build_logo">
        <img class="building g39" src="img/x.gif" alt="<?php echo GREATGRANARY; ?>" title="<?php echo GREATGRANARY;?>" />
    </a>
    <h1><?php echo GREATGRANARY;?> <span class="level"><?php echo LEVEL;?> <?php echo $level;?></span></h1>
    <p class="build_desc"><?php echo GREATGRANARY_DESC;?></p>

    <table cellpadding="1" cellspacing="1" id="build_value">
        <tr>
            <th><?php echo CURRENT_CAPACITY;?></th>
            <td><b><?php echo $current;?></b> <?php echo CROP_UNITS;?></td>
        </tr>
        <?php if (!$building->isMax($village->resarray['f'.$id.'t'], $id)):
            $next = $level + 1 + $loopsame + $doublebuild + $master;
            $next = $next > 20 ? 20 : $next;
        ?>
        <tr>
            <th><?php echo CAPACITY_LEVEL;?> <?php echo $next;?>:</th>
            <td><b><?php echo (int)$bid39[$next]['attri'] * STORAGE_MULTIPLIER;?></b> <?php echo CROP_UNITS;?></td>
        </tr>
        <?php endif;?>
    </table>

    <?php include("upgrade.tpl");?>
</div>