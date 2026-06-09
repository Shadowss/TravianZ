<?php
// 41.tpl - HORSEDRINKING
global $village, $building, $bid41, $id, $loopsame, $doublebuild, $master;

include("next.tpl");

$level = (int)$village->resarray['f'.$id];
$current = $level > 0 ? (int)($bid41[$level]['attri'] * 100 - 100) : 0;
?>
<div id="build" class="gid41">
    <a href="#" onClick="return Popup(41,4);" class="build_logo">
        <img class="building g41" src="img/x.gif" alt="<?php echo HORSEDRINKING; ?>" title="<?php echo HORSEDRINKING;?>" />
    </a>
    <h1><?php echo HORSEDRINKING;?> <span class="level"><?php echo LEVEL;?> <?php echo $level;?></span></h1>
    <p class="build_desc"><?php echo HORSEDRINKING_DESC;?></p>

    <table cellpadding="1" cellspacing="1" id="build_value">
        <tr>
            <th><?php echo CURRENT_BONUS;?></th>
            <td><b><?php echo $current;?></b> <?php echo PERCENT;?></td>
        </tr>
        <?php if (!$building->isMax($village->resarray['f'.$id.'t'], $id)):
            $next = $level + 1 + $loopsame + $doublebuild + $master;
            $next = $next > 20 ? 20 : $next;
            $nextBonus = (int)($bid41[$next]['attri'] * 100 - 100);
        ?>
        <tr>
            <th><?php echo BONUS_LEVEL;?> <?php echo $next;?>:</th>
            <td><b><?php echo $nextBonus;?></b> <?php echo PERCENT;?></td>
        </tr>
        <?php endif;?>
    </table>

    <?php include("upgrade.tpl");?>
</div>