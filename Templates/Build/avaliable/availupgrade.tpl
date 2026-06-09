<?php declare(strict_types=1);
/**
 * availupgrade.tpl - fix redeclare + PHP 8.2 safe
 * NU mai declară funcții, folosește variabilă
 */
$bid = (int)($_GET['bid']?? 0);
$id = (int)$id;

$bindicator = (int)$building->canBuild($id, $bid);
$uprequire = $building->resourceRequired($id, $bid);

// --- pregătim o singură dată HTML-ul pentru Master Builder ---
$masterBuilderHtml = '';
if ($session->goldclub == 1) {
    $canUse = ($session->gold >= 1 && $village->master == 0);
    $checker = htmlspecialchars((string)$session->checker, ENT_QUOTES, 'UTF-8');
    $url = "dorf2.php?master={$bid}&id={$id}&c={$checker}";
    $label = htmlspecialchars(CONSTRUCTING_MASTER_BUILDER, ENT_QUOTES, 'UTF-8');
    $goldIcon = htmlspecialchars(GP_LOCATE. 'img/a/gold_g.gif', ENT_QUOTES, 'UTF-8');
    $cost = '<span class="gold-cost">(costs: <img src="'.$goldIcon.'" alt="'.GOLD.'" title="'.GOLD.'"/>1)</span>';

    $masterBuilderHtml = $canUse
       ? '<br><a class="build" href="'.htmlspecialchars($url, ENT_QUOTES, 'UTF-8').'">'.$label.'</a> '.$cost
        : '<br><span class="none">'.$label.'</span> '.$cost;
}

$totalRequired = (int)($uprequire['wood'] + $uprequire['clay'] + $uprequire['iron'] + $uprequire['crop']);
$canNpc = ($session->userinfo['gold'] >= 3 && $building->getTypeLevel(17) >= 1 && $village->atotal >= $totalRequired);
?>
<td class="res">
    <img class="r1" src="img/x.gif" alt="<?php echo LUMBER; ?>" title="<?php echo LUMBER; ?>" /><?= (int)$uprequire['wood']?> |
    <img class="r2" src="img/x.gif" alt="<?php echo CLAY; ?>" title="<?php echo CLAY; ?>" /><?= (int)$uprequire['clay']?> |
    <img class="r3" src="img/x.gif" alt="<?php echo IRON; ?>" title="<?php echo IRON; ?>" /><?= (int)$uprequire['iron']?> |
    <img class="r4" src="img/x.gif" alt="<?php echo CROP; ?>" title="<?php echo CROP; ?>" /><?= (int)$uprequire['crop']?> |
    <img class="r5" src="img/x.gif" alt="Crop consumption" title="Crop consumption" /><?= (int)$uprequire['pop']?> |
    <img class="clock" src="img/x.gif" alt="<?php echo DURATION; ?>" title="<?php echo DURATION; ?>" /><?= htmlspecialchars($generator->getTimeFormat($uprequire['time']), ENT_QUOTES, 'UTF-8')?>
    <?php if ($canNpc):?>
        | <a href="build.php?gid=17&amp;t=3&amp;r1=<?= (int)$uprequire['wood']?>&amp;r2=<?= (int)$uprequire['clay']?>&amp;r3=<?= (int)$uprequire['iron']?>&amp;r4=<?= (int)$uprequire['crop']?>" title="<?php echo NPC_TRADE; ?>">
            <img class="npc" src="img/x.gif" alt="<?php echo NPC_TRADE; ?>" title="<?php echo NPC_TRADE; ?>" />
          </a>
    <?php endif;?>
</td>
</tr>
<tr>
    <td class="link">
<?php
switch ($bindicator) {
    case 2:
        echo '<span class="none">'.htmlspecialchars(WORKERS_ALREADY_WORK_WAITING, ENT_QUOTES, 'UTF-8').'</span>';
        echo $masterBuilderHtml;
        break;
    case 3:
        echo '<span class="none">'.WORKERS_ALREADY_WORK_WAITING.'</span>';
        echo $masterBuilderHtml;
        break;
    case 4:
        echo '<span class="none">'.ENOUGH_FOOD_EXPAND_CROPLAND.'</span>';
        break;
    case 5:
        echo '<span class="none">Upgrade Warehouse.</span>';
        break;
    case 6:
        echo '<span class="none">Upgrade Granary.</span>';
        break;
    case 7:
        $needed = $building->calculateAvaliable($id, $bid);
        echo '<span class="none">'.htmlspecialchars(ENOUGH_RESOURCES, ENT_QUOTES, 'UTF-8').' '.htmlspecialchars((string)$needed[0], ENT_QUOTES, 'UTF-8').' at '.htmlspecialchars((string)$needed[1], ENT_QUOTES, 'UTF-8').'</span>';
        echo $masterBuilderHtml;
        break;
    case 8:
        $url = ($session->access!= BANNED)
          ? "dorf2.php?a={$bid}&id={$id}&c={$session->checker}"
            : "banned.php";
        echo '<a class="build" href="'.htmlspecialchars($url, ENT_QUOTES, 'UTF-8').'">'.htmlspecialchars(CONSTRUCT_BUILD, ENT_QUOTES, 'UTF-8').'</a>';
        break;
    case 9:
        $url = ($session->access!= BANNED)
          ? "dorf2.php?a={$bid}&id={$id}&c={$session->checker}"
            : "banned.php?a={$bid}&id={$id}&c={$session->checker}";
        echo '<a class="build" href="'.htmlspecialchars($url, ENT_QUOTES, 'UTF-8').'">Construct building. (waiting loop)</a>';
        break;
}
?>
    </td>