<?php
// 28.tpl - TRADEOFFICE
global $village, $building, $bid28, $id, $loopsame, $doublebuild, $master;

include("next.tpl");

$level = (int)$village->resarray['f'.$id];
$current = $level > 0 ? (int)$bid28[$level]['attri'] : 100;
?>
<div id="build" class="gid28">
    <a href="#" onClick="return Popup(28,4);" class="build_logo">
        <img class="building g28" src="img/x.gif" alt="<?php echo TRADEOFFICE; ?>" title="<?php echo TRADEOFFICE;?>" />
    </a>
    <h1><?php echo TRADEOFFICE;?> <span class="level"><?php echo LEVEL;?> <?php echo $level;?></span></h1>
    <p class="build_desc"><?php echo TRADEOFFICE_DESC;?></p>

    <table cellpadding="1" cellspacing="1" id="build_value">
        <tr>
            <th><?php echo CURRENT_MERCHANT;?></th>
            <td><b><?php echo $current;?></b> <?php echo PERCENT;?></td>
        </tr>
        <tr>
            <?php if (!$building->isMax($village->resarray['f'.$id.'t'], $id)):
                $next = $level + 1 + $loopsame + $doublebuild + $master;
                $next = $next > 20 ? 20 : $next;
            ?>
            <th><?php echo MERCHANT_LEVEL;?> <?php echo $next;?>:</th>
            <td><b><?php echo (int)$bid28[$next]['attri'];?></b> <?php echo PERCENT;?></td>
            <?php endif;?>
        </tr>
    </table>

    <?php include("upgrade.tpl");?>
</div>