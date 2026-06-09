<?php
// wwupgrade.tpl
global $village, $building, $database, $generator, $session, $id;

$bid = (int)$village->resarray['f'.$id.'t'];
$bindicate = $building->canBuild($id, $bid);
$wwlevel = (int)$village->resarray['f99'];
$needed_plan = $wwlevel >= 50? 1 : 0;

if (!$building->allowWwUpgrade()) {
    echo $needed_plan == 0
       ? '<p><span class="none">'.NEED_WWCONSTRUCTION_PLAN.'.</span></p>'
        : '<p><span class="none">'.NEED_MORE_WWCONSTRUCTION_PLAN.'.</span></p>';
    return;
}

if ($bindicate == 1) {
    echo '<p><span class="none">'.MAX_LEVEL.'</span></p>'; return;
}
if ($bindicate == 10) {
    echo '<p><span class="none">'.BUILDING_MAX_LEVEL_UNDER.'</span></p>'; return;
}
if ($bindicate == 11) {
    echo '<p><span class="none">'.BUILDING_BEING_DEMOLISHED.'</span></p>'; return;
}

$loopsame = ($building->isCurrent($id) || $building->isLoop($id))? 1 : 0;
$doublebuild = ($building->isCurrent($id) && $building->isLoop($id))? 1 : 0;
$master = count($database->getMasterJobsByField($village->wid, $id));
$nextLevel = (int)$village->resarray['f'.$id] + 1 + $loopsame + $doublebuild + $master;
$uprequire = $building->resourceRequired($id, $bid, 1 + $loopsame + $doublebuild + $master);
$total_required = (int)($uprequire['wood'] + $uprequire['clay'] + $uprequire['iron'] + $uprequire['crop']);
?>
<p id="contract">
    <b><?php echo COSTS_UPGRADING_LEVEL;?> <?php echo $nextLevel;?>:</b><br />
    <img class="r1" src="img/x.gif" title="<?php echo LUMBER; ?>"/><span class="little_res"><?php echo $uprequire['wood'];?></span> |
    <img class="r2" src="img/x.gif" title="<?php echo CLAY; ?>"/><span class="little_res"><?php echo $uprequire['clay'];?></span> |
    <img class="r3" src="img/x.gif" title="<?php echo IRON; ?>"/><span class="little_res"><?php echo $uprequire['iron'];?></span> |
    <img class="r4" src="img/x.gif" title="<?php echo CROP; ?>"/><span class="little_res"><?php echo $uprequire['crop'];?></span> |
    <img class="r5" src="img/x.gif" title="Crop consumption"/><?php echo $uprequire['pop'];?> |
    <img class="clock" src="img/x.gif" title="<?php echo DURATION; ?>"/><?php echo $generator->getTimeFormat($uprequire['time']);?>
    <?php if ($session->userinfo['gold'] >= 3 && $building->getTypeLevel(17) >= 1 && $village->atotal >= $total_required):?>
    | <a href="build.php?gid=17&t=3&r1=<?php echo $uprequire['wood'];?>&r2=<?php echo $uprequire['clay'];?>&r3=<?php echo $uprequire['iron'];?>&r4=<?php echo $uprequire['crop'];?>" title="<?php echo NPC_TRADE; ?>"><img class="npc" src="img/x.gif" alt="<?php echo NPC_TRADE; ?>"/></a>
    <?php endif;?>
    <br />
<?php
switch ($bindicate) {
    case 2: echo '<span class="none">'.WORKERS_ALREADY_WORK.'</span>'; break;
    case 3: echo '<span class="none">'.WORKERS_ALREADY_WORK_WAITING.'</span>'; break;
    case 4: echo '<span class="none">'.ENOUGH_FOOD_EXPAND_CROPLAND.'</span>'; break;
    case 5: echo '<span class="none">'.UPGRADE_WAREHOUSE.'.</span>'; break;
    case 6: echo '<span class="none">'.UPGRADE_GRANARY.'.</span>'; break;
    case 7:
        if ($village->allcrop > 0) {
            $neededtime = $building->calculateAvaliable($id, $bid, 1 + $loopsame + $doublebuild + $master);
            echo '<span class="none">'.ENOUGH_RESOURCES.' '.$neededtime[0].' at '.$neededtime[1].'</span>';
        } else {
            echo '<span class="none">'.YOUR_CROP_NEGATIVE.'</span>';
        }
        break;
    case 8:
    case 9:
        $href = $session->access == BANNED? 'banned.php' : (($id <= 18)? "dorf1.php?a=$id&c=$session->checker" : "dorf2.php?a=$id&c=$session->checker");
        $lvl = $bindicate == 8? $village->resarray['f'.$id] + 1 : $village->resarray['f'.$id] + ($loopsame > 0? 2 : 1);
        echo '<a class="build" href="'.$href.'">'.UPGRADE_LEVEL.' '.$lvl.'.</a>';
        if ($bindicate == 9) echo ' <span class="none">'.WAITING.'</span>';
        break;
}

if (in_array($bindicate, [2,3,7]) && $session->goldclub == 1) {
    echo '<br/>';
    $masterHref = ($id <= 18? 'dorf1.php' : 'dorf2.php'). "?master=$bid&id=$id&c=$session->checker";
    if ($session->gold >= 1 && $village->master == 0) {
        echo '<a class="build" href="'.$masterHref.'">'.CONSTRUCTING_MASTER_BUILDER.'</a>';
    } else {
        echo '<span class="none">'.CONSTRUCTING_MASTER_BUILDER.'</span>';
    }
    echo ' <font color="#B3B3B3">('.COSTS.': <img src="'.GP_LOCATE.'img/a/gold_g.gif" alt="'.GOLD.'" title="'.GOLD.'"/>1)</font>';
}
?>
</p>