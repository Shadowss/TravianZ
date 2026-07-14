<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : ACADEMY EGIPTEAN UNITS                                    ##
##  Type           : BUILDING TEMPLATE                                         ##
## --------------------------------------------------------------------------- ##
##  Created by     : Shadow                                                    ##
##  Designed by    : Shadow                                                    ##
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

global $technology, $generator, $village, $session, $building, $bid22, $id;

$acares = $technology->grabAcademyRes();
$success = $fail = 0;
$level = (int)$village->resarray['f'.$id];
?>
<table cellpadding="1" cellspacing="1" class="build_details">
    <thead><tr><td><?php echo ACADEMY;?></td><td><?php echo ACTION;?></td></tr></thead>
    <tbody>
    <?php for ($i = 62; $i <= 69; $i++):
        if (!($technology->meetRRequirement($i) &&!$technology->getTech($i) &&!$technology->isResearch($i,1))) { $fail++; continue; }
        $success++;
        $res = ${'r'.$i};
        $name = $technology->getUnitName($i);
        $time = $generator->getTimeFormat(round($res['time'] * ($bid22[$level]['attri']/100) / SPEED));
        $total_required = (int)($res['wood']+$res['clay']+$res['iron']+$res['crop']);
        $showNpc = $session->userinfo['gold']>=3 && $building->getTypeLevel(17)>=1 && $village->atotal >= $total_required;
 ?>
        <tr>
            <td class="desc">
                <div class="tit"><img class="unit u<?php echo $i;?>" src="img/x.gif" alt="<?php echo htmlspecialchars($name);?>" title="<?php echo htmlspecialchars($name);?>"/><a href="#" onClick="return Popup(<?php echo $i;?>,1);"><?php echo htmlspecialchars($name);?></a></div>
                <div class="details">
                    <img class="r1" src="img/x.gif" title="<?php echo LUMBER;?>"/><?php echo (int)$res['wood'];?>|
                    <img class="r2" src="img/x.gif" title="<?php echo CLAY;?>"/><?php echo (int)$res['clay'];?>|
                    <img class="r3" src="img/x.gif" title="<?php echo IRON;?>"/><?php echo (int)$res['iron'];?>|
                    <img class="r4" src="img/x.gif" title="<?php echo CROP;?>"/><?php echo (int)$res['crop'];?>|
                    <img class="clock" src="img/x.gif" title="<?php echo DURATION;?>"/><?php echo $time;?>
                    <?php if ($showNpc):?>|<a href="build.php?gid=17&t=3&r1=<?php echo (int)$res['wood'];?>&r2=<?php echo (int)$res['clay'];?>&r3=<?php echo (int)$res['iron'];?>&r4=<?php echo (int)$res['crop'];?>" title="<?php echo NPC_TRADE; ?>"><img class="npc" src="img/x.gif"/></a><?php endif;?>
                    <?php
                    if ($res['wood']>$village->maxstore||$res['clay']>$village->maxstore||$res['iron']>$village->maxstore) echo "<br><span class=\"none\">".EXPAND_WAREHOUSE1."</span>";
                    elseif ($res['crop']>$village->maxcrop) echo "<br><span class=\"none\">".EXPAND_GRANARY1."</span>";
                    elseif ($res['wood']>$village->awood||$res['clay']>$village->aclay||$res['iron']>$village->airon||$res['crop']>$village->acrop) {
                        if ($village->getProd("crop")>0){ $t=$technology->calculateAvaliable(22,$res); echo "<br><span class=\"none\">".ENOUGH_RESOURCES." ".$t[0]." at ".$t[1]."</span>"; }
                        else echo "<br><span class=\"none\">".CROP_NEGATIVE."</span>";
                    }
                 ?>
                </div>
            </td>
            <td class="<?php echo ($res['wood']>$village->maxstore||$res['clay']>$village->maxstore||$res['iron']>$village->maxstore||$res['crop']>$village->maxcrop||$res['wood']>$village->awood||$res['clay']>$village->aclay||$res['iron']>$village->airon||$res['crop']>$village->acrop||count($acares)>0)?'none':'act';?>">
                <?php
                if ($res['wood']>$village->maxstore||$res['clay']>$village->maxstore||$res['iron']>$village->maxstore) echo "<div class=\"none\">".EXPAND_WAREHOUSE."</div>";
                elseif ($res['crop']>$village->maxcrop) echo "<div class=\"none\">".EXPAND_GRANARY."</div>";
                elseif ($res['wood']>$village->awood||$res['clay']>$village->aclay||$res['iron']>$village->airon||$res['crop']>$village->acrop) echo "<div class=\"none\">".TOO_FEW_RESOURCES."</div>";
                elseif (count($acares)>0) echo RESEARCH_IN_PROGRESS;
                elseif ($session->access!=BANNED) echo "<a class=\"research\" href=\"build.php?id=".(int)$id."&amp;a=".$i."&amp;c=".$session->mchecker."\">".RESEARCH."</a>";
                else echo "<a class=\"research\" href=\"banned.php\">".RESEARCH."</a>";
             ?>
            </td>
        </tr>
    <?php endfor; if ($success===0):?>
        <tr><td colspan="2"><div class="none" align="center"><?php echo RESEARCH_AVAILABLE;?></div></td></tr>
    <?php endif;?>
    </tbody>
</table>

<?php if ($fail>0):?>
<p class="switch"><a id="researchFutureLink" href="#" onclick="document.getElementById('researchFuture').classList.toggle('hide'); this.textContent = this.textContent == '<?php echo SHOW_MORE;?>'? '<?php echo HIDE_MORE;?>' : '<?php echo SHOW_MORE;?>'; return false;"><?php echo SHOW_MORE;?></a></p>
<table id="researchFuture" class="build_details hide" cellspacing="1" cellpadding="1">
    <thead><tr><td colspan="2"><?php echo PREREQUISITES;?></td></tr></thead>
    <tbody>
        <?php if (!$technology->meetRRequirement(62) &&!$technology->getTech(62)):?>
        <tr><td class="desc"><div class="tit"><img class="unit u62" src="img/x.gif" alt="<?php echo U62; ?>"/><a onclick="return Popup(62,1);" href="#"><?php echo U62; ?></a></div></td><td class="cond"><a href="#" onclick="return Popup(22,4);"><?php echo ACADEMY;?></a> <span><?php echo LEVEL;?> 1</span><br><a href="#" onclick="return Popup(13,4);"><?php echo ARMOURY;?></a> <span><?php echo LEVEL;?> 1</span></td></tr>
        <?php endif;?>
        <?php if (!$technology->meetRRequirement(63) &&!$technology->getTech(63)):?>
        <tr><td class="desc"><div class="tit"><img class="unit u63" src="img/x.gif" alt="<?php echo U63; ?>"/><a onclick="return Popup(63,1);" href="#"><?php echo U63; ?></a></div></td><td class="cond"><a href="#" onclick="return Popup(22,4);"><?php echo ACADEMY;?></a> <span><?php echo LEVEL;?> 3</span><br><a href="#" onclick="return Popup(12,4);"><?php echo BLACKSMITH;?></a> <span><?php echo LEVEL;?> 1</span></td></tr>
        <?php endif;?>
        <?php if (!$technology->meetRRequirement(64) &&!$technology->getTech(64)):?>
        <tr><td class="desc"><div class="tit"><img class="unit u64" src="img/x.gif" alt="<?php echo U64; ?>"/><a onclick="return Popup(64,1);" href="#"><?php echo U64; ?></a></div></td><td class="cond"><a href="#" onclick="return Popup(22,4);"><?php echo ACADEMY;?></a> <span><?php echo LEVEL;?> 5</span><br><a href="#" onclick="return Popup(20,4);"><?php echo STABLE;?></a> <span><?php echo LEVEL;?> 1</span></td></tr>
        <?php endif;?>
        <?php if (!$technology->meetRRequirement(65) &&!$technology->getTech(65)):?>
        <tr><td class="desc"><div class="tit"><img class="unit u65" src="img/x.gif" alt="<?php echo U65; ?>"/><a onclick="return Popup(65,1);" href="#"><?php echo U65; ?></a></div></td><td class="cond"><a href="#" onclick="return Popup(22,4);"><?php echo ACADEMY;?></a> <span><?php echo LEVEL;?> 5</span><br><a href="#" onclick="return Popup(20,4);"><?php echo STABLE;?></a> <span><?php echo LEVEL;?> 5</span></td></tr>
        <?php endif;?>
        <?php if (!$technology->meetRRequirement(66) &&!$technology->getTech(66)):?>
        <tr><td class="desc"><div class="tit"><img class="unit u66" src="img/x.gif" alt="<?php echo U66; ?>"/><a onclick="return Popup(66,1);" href="#"><?php echo U66; ?></a></div></td><td class="cond"><a href="#" onclick="return Popup(22,4);"><?php echo ACADEMY;?></a> <span><?php echo LEVEL;?> 15</span><br><a href="#" onclick="return Popup(20,4);"><?php echo STABLE;?></a> <span><?php echo LEVEL;?> 10</span></td></tr>
        <?php endif;?>
        <?php if (!$technology->meetRRequirement(67) &&!$technology->getTech(67)):?>
        <tr><td class="desc"><div class="tit"><img class="unit u67" src="img/x.gif" alt="<?php echo U67; ?>"/><a onclick="return Popup(67,1);" href="#"><?php echo U67; ?></a></div></td><td class="cond"><a href="#" onclick="return Popup(22,4);"><?php echo ACADEMY;?></a> <span><?php echo LEVEL;?> 10</span><br><a href="#" onclick="return Popup(21,4);"><?php echo WORKSHOP;?></a> <span><?php echo LEVEL;?> 1</span></td></tr>
        <?php endif;?>
        <?php if (!$technology->meetRRequirement(68) &&!$technology->getTech(68)):?>
        <tr><td class="desc"><div class="tit"><img class="unit u68" src="img/x.gif" alt="<?php echo U68; ?>"/><a onclick="return Popup(68,1);" href="#"><?php echo U68; ?></a></div></td><td class="cond"><a href="#" onclick="return Popup(22,4);"><?php echo ACADEMY;?></a> <span><?php echo LEVEL;?> 15</span><br><a href="#" onclick="return Popup(21,4);"><?php echo WORKSHOP;?></a> <span><?php echo LEVEL;?> 10</span></td></tr>
        <?php endif;?>
        <?php if (!$technology->meetRRequirement(69) &&!$technology->getTech(69)):?>
        <tr><td class="desc"><div class="tit"><img class="unit u69" src="img/x.gif" alt="<?php echo U69; ?>"/><a onclick="return Popup(69,1);" href="#"><?php echo U69; ?></a></div></td><td class="cond"><a href="#" onclick="return Popup(16,4);"><?php echo RALLYPOINT;?></a> <span><?php echo LEVEL;?> 10</span><br><a href="#" onclick="return Popup(22,4);"><?php echo ACADEMY;?></a> <span><?php echo LEVEL;?> 20</span></td></tr>
        <?php endif;?>
    </tbody>
</table>
<?php endif;?>

<?php if (count($acares)>0):?>
<table cellpadding="1" cellspacing="1" class="under_progress">
    <thead><tr><td><?php echo RESEARCHING;?></td><td><?php echo DURATION;?></td><td><?php echo COMPLETE;?></td></tr></thead>
    <tbody>
    <?php foreach ($acares as $aca): $unit=(int)substr($aca['tech'],1,2); $name=$technology->getUnitName($unit); $date=$generator->procMtime($aca['timestamp']);?>
        <tr><td class="desc"><img class="unit u<?php echo $unit;?>" src="img/x.gif" alt="<?php echo htmlspecialchars($name);?>"/><?php echo htmlspecialchars($name);?></td><td class="dur"><span id="timer<?php echo ++$session->timer;?>"><?php echo $generator->getTimeFormat($aca['timestamp']-time());?></span></td><td class="fin"><span><?php echo $date[1];?></span><span> <?php echo TZ_HRS; ?></span></td></tr>
    <?php endforeach;?>
    </tbody>
</table>
<?php endif;?>