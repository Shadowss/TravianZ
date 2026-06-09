<?php
// 24_1.tpl - TOWNHALL CELEBRATIONS
global $village, $database, $generator, $building, $session, $cel, $gc, $bid24, $id, $technology;

$level = (int)$village->resarray['f'.$id];
$inuse = (int)$database->getVillageField($village->wid, 'celebration');
$now = time();
$inProgress = $inuse > $now;
?>
<table cellpadding="1" cellspacing="1" class="build_details">
    <thead><tr><td><?php echo CELEBRATIONS;?></td><td><?php echo ACTION;?></td></tr></thead>
    <tbody>
        <?php
        $i = 1;
        $c = $cel[$i];
        $time = $generator->getTimeFormat(round($c['time'] * ($bid24[$building->getTypeLevel(24)]['attri']/100) / SPEED));
        $total = $c['wood']+$c['clay']+$c['iron']+$c['crop'];
        $showNpc = $session->userinfo['gold']>=3 && $building->getTypeLevel(17)>=1 && $village->atotal >= $total;
        $canAfford = $c['wood']<=$village->awood && $c['clay']<=$village->aclay && $c['iron']<=$village->airon && $c['crop']<=$village->acrop;
       ?>
        <tr>
            <td class="desc">
                <div class="tit"><?php echo $c['name'];?> (<?php echo $c['attri'];?> <?php echo CULTURE_POINTS;?>)</div>
                <div class="details">
                    <img class="r1" src="img/x.gif" title="<?php echo LUMBER;?>"/><?php echo (int)$c['wood'];?>|
                    <img class="r2" src="img/x.gif" title="<?php echo CLAY;?>"/><?php echo (int)$c['clay'];?>|
                    <img class="r3" src="img/x.gif" title="<?php echo IRON;?>"/><?php echo (int)$c['iron'];?>|
                    <img class="r4" src="img/x.gif" title="<?php echo CROP;?>"/><?php echo (int)$c['crop'];?>|
                    <img class="clock" src="img/x.gif" title="<?php echo DURATION;?>"/><?php echo $time;?>
                    <?php if ($showNpc):?>|<a href="build.php?gid=17&t=3&r1=<?php echo $c['wood'];?>&r2=<?php echo $c['clay'];?>&r3=<?php echo $c['iron'];?>&r4=<?php echo $c['crop'];?>" title="<?php echo NPC_TRADE; ?>"><img class="npc" src="img/x.gif"/></a><?php endif;?>
                    <?php if (!$canAfford &&!$inProgress): if ($village->getProd("crop")>0){ $t=$technology->calculateAvaliable(24,$c); echo "<br><span class=\"none\">".ENOUGH_RESOURCES." ".$t[0]." at ".$t[1]."</span>"; } else echo "<br><span class=\"none\">".CROP_NEGATIVE."</span>"; endif;?>
                </div>
            </td>
            <td class="act">
                <?php if ($inProgress):?><div class="none"><?php echo CELEBRATIONS_IN_PROGRESS;?></div>
                <?php elseif (!$canAfford):?><div class="none"><?php echo TOO_FEW_RESOURCES;?></div>
                <?php else:?><a class="research" href="celebration.php?type=<?php echo $i;?>&id=<?php echo $id;?>"><?php echo HOLD;?></a><?php endif;?>
            </td>
        </tr>

        <?php if ($level >= 10):
            $gcTime = $generator->getTimeFormat(round($gc[$level]/SPEED));
            $gcTotal = 29700+33250+32000+6700;
            $showNpc2 = $session->userinfo['gold']>=3 && $building->getTypeLevel(17)>=1 && $village->atotal >= $gcTotal;
            $canAfford2 = 29700<=$village->awood && 33250<=$village->aclay && 32000<=$village->airon && 6700<=$village->acrop;
       ?>
        <tr>
            <td class="desc">
                <div class="tit"><?php echo GREAT_CELEBRATIONS;?> (2000 <?php echo CULTURE_POINTS;?>)</div>
                <div class="details">
                    <img class="r1" src="img/x.gif" title="<?php echo LUMBER;?>"/>29700|
                    <img class="r2" src="img/x.gif" title="<?php echo CLAY;?>"/>33250|
                    <img class="r3" src="img/x.gif" title="<?php echo IRON;?>"/>32000|
                    <img class="r4" src="img/x.gif" title="<?php echo CROP;?>"/>6700|
                    <img class="clock" src="img/x.gif" title="<?php echo DURATION;?>"/><?php echo $gcTime;?>
                    <?php if ($showNpc2):?>|<a href="build.php?gid=17&t=3&r1=29700&r2=33250&r3=32000&r4=6700" title="<?php echo NPC_TRADE; ?>"><img class="npc" src="img/x.gif"/></a><?php endif;?>
                    <?php if (!$canAfford2 &&!$inProgress): if ($village->getProd("crop")>0){ $t=$technology->calculateAvaliable(24,$cel[2]); echo "<br><span class=\"none\">".ENOUGH_RESOURCES." ".$t[0]." at ".$t[1]."</span>"; } else echo "<br><span class=\"none\">".CROP_NEGATIVE."</span>"; endif;?>
                </div>
            </td>
            <td class="act">
                <?php if ($inProgress):?><div class="none"><?php echo CELEBRATIONS_IN_PROGRESS;?></div>
                <?php elseif (!$canAfford2):?><div class="none"><?php echo TOO_FEW_RESOURCES;?></div>
                <?php else:?><a class="research" href="celebration.php?type=2&id=<?php echo $id;?>"><?php echo HOLD;?></a><?php endif;?>
            </td>
        </tr>
        <?php endif;?>
    </tbody>
</table>