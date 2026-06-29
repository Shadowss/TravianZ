<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : BREWERY MEAD-FESTIVAL                                     ##
##  Type           : BUILDING TEMPLATE                                         ##
## --------------------------------------------------------------------------- ##
##  Refactored by  : Shadow                                                    ##
##  Redesign by    : Shadow                                                    ##
## --------------------------------------------------------------------------- ##
##  Contact        : cata7007@gmail.com                                        ##
##  Project        : TravianZ                                                  ##
##  Test Server    : https://travianz.org                                      ##
##  GitHub         : https://github.com/Shadowss/TravianZ                      ##
## --------------------------------------------------------------------------- ##
##  License        : TravianZ Project                                          ##
##  Copyright      : TravianZ (c) 2010-2026. All rights reserved.              ##
## --------------------------------------------------------------------------- ##
#################################################################################

global $village, $generator, $building, $session, $technology, $festival, $id;

$inuse       = (int)$village->currentfestival;
$now         = time();
$inProgress  = $inuse > $now;

// Unlike Town Hall celebrations, duration is fixed (not level-scaled) — only
// the combat bonus % scales with Brewery level (see $bid35 in 35.tpl).
$time      = $generator->getTimeFormat(round($festival['time'] / SPEED));
$total     = $festival['wood'] + $festival['clay'] + $festival['iron'] + $festival['crop'];
$showNpc   = $session->userinfo['gold'] >= 3 && $building->getTypeLevel(17) >= 1 && $village->atotal >= $total;
$canAfford = $festival['wood'] <= $village->awood && $festival['clay'] <= $village->aclay && $festival['iron'] <= $village->airon && $festival['crop'] <= $village->acrop;
?>
<table cellpadding="1" cellspacing="1" class="build_details">
    <thead><tr><td><?php echo MEAD_FESTIVAL;?></td><td><?php echo ACTION;?></td></tr></thead>
    <tbody>
        <tr>
            <td class="desc">
                <div class="tit"><?php echo $festival['name'];?></div>
                <div class="details">
                    <img class="r1" src="img/x.gif" title="<?php echo LUMBER;?>"/><?php echo (int)$festival['wood'];?>|
                    <img class="r2" src="img/x.gif" title="<?php echo CLAY;?>"/><?php echo (int)$festival['clay'];?>|
                    <img class="r3" src="img/x.gif" title="<?php echo IRON;?>"/><?php echo (int)$festival['iron'];?>|
                    <img class="r4" src="img/x.gif" title="<?php echo CROP;?>"/><?php echo (int)$festival['crop'];?>|
                    <img class="clock" src="img/x.gif" title="<?php echo DURATION;?>"/><?php echo $time;?>
                    <?php if ($showNpc):?>|<a href="build.php?gid=17&t=3&r1=<?php echo $festival['wood'];?>&r2=<?php echo $festival['clay'];?>&r3=<?php echo $festival['iron'];?>&r4=<?php echo $festival['crop'];?>" title="<?php echo NPC_TRADE; ?>"><img class="npc" src="img/x.gif"/></a><?php endif;?>
                    <?php if (!$canAfford && !$inProgress): if ($village->getProd("crop") > 0) { $t = $technology->calculateAvaliable(35, $festival); echo "<br><span class=\"none\">".ENOUGH_RESOURCES." ".$t[0]." at ".$t[1]."</span>"; } else echo "<br><span class=\"none\">".CROP_NEGATIVE."</span>"; endif;?>
                </div>
            </td>
            <td class="act">
                <?php if ($inProgress):
                    $remaining = max(0, $inuse - $now);
                    $timerId   = ++$session->timer;
                ?>
                    <div class="none">
                        <?php echo MEAD_FESTIVAL_IN_PROGRESS;?><br>
                        <span id="timer<?php echo $timerId;?>"><?php echo $generator->getTimeFormat($remaining);?></span>
                    </div>
                <?php elseif (!$canAfford):?><div class="none"><?php echo TOO_FEW_RESOURCES;?></div>
                <?php else:?><a class="research" href="festival.php?id=<?php echo $id;?>"><?php echo HOLD;?></a><?php endif;?>
            </td>
        </tr>
    </tbody>
</table>
