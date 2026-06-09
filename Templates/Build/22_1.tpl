<?php
// 22_1.tpl - ACADEMY - ROMAN UNITS
global $technology, $generator, $village, $session, $building, $bid22, $id;

$acares = $technology->grabAcademyRes();
$success = $fail = 0;
$level = (int)$village->resarray['f'.$id];
?>
<table cellpadding="1" cellspacing="1" class="build_details">
    <thead><tr><td><?php echo ACADEMY;?></td><td><?php echo ACTION;?></td></tr></thead>
    <tbody>
    <?php for ($i = 2; $i <= 9; $i++):
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
        <?php if (!$technology->meetRRequirement(2) &&!$technology->getTech(2)):?>
        <tr><td class="desc"><div class="tit"><img class="unit u2" src="img/x.gif" alt="<?php echo U2; ?>"/><a onclick="return Popup(2,1);" href="#"><?php echo U2; ?></a></div></td><td class="cond"><a href="#" onclick="return Popup(22,1);"><?php echo ACADEMY;?></a> <span><?php echo LEVEL;?> 1</span><br><a href="#" onclick="return Popup(13,4);"><?php echo ARMOURY;?></a> <span><?php echo LEVEL;?> 1</span></td></tr>
        <?php endif;?>
        <?php if (!$technology->meetRRequirement(3) &&!$technology->getTech(3)):?>
        <tr><td class="desc"><div class="tit"><img class="unit u3" src="img/x.gif" alt="<?php echo U3; ?>"/><a onclick="return Popup(3,1);" href="#"><?php echo U3; ?></a></div></td><td class="cond"><a href="#" onclick="return Popup(22,4);"><?php echo ACADEMY;?></a> <span><?php echo LEVEL;?> 5</span><br><a href="#" onclick="return Popup(12,4);"><?php echo BLACKSMITH;?></a> <span><?php echo LEVEL;?> 1</span></td></tr>
        <?php endif;?>
        <?php if (!$technology->meetRRequirement(4) &&!$technology->getTech(4)):?>
        <tr><td class="desc"><div class="tit"><img class="unit u4" src="img/x.gif" alt="<?php echo U4; ?>"/><a onclick="return Popup(4,1);" href="#"><?php echo U4; ?></a></div></td><td class="cond"><a href="#" onclick="return Popup(22,4);"><?php echo ACADEMY;?></a> <span><?php echo LEVEL;?> 5</span><br><a href="#" onclick="return Popup(20,4);"><?php echo STABLE;?></a> <span><?php echo LEVEL;?> 1</span></td></tr>
        <?php endif;?>
        <?php if (!$technology->meetRRequirement(5) &&!$technology->getTech(5)):?>
        <tr><td class="desc"><div class="tit"><img class="unit u5" src="img/x.gif" alt="<?php echo U5; ?>"/><a onclick="return Popup(5,1);" href="#"><?php echo U5; ?></a></div></td><td class="cond"><a href="#" onclick="return Popup(22,4);"><?php echo ACADEMY;?></a> <span><?php echo LEVEL;?> 5</span><br><a href="#" onclick="return Popup(20,4);"><?php echo STABLE;?></a> <span><?php echo LEVEL;?> 5</span></td></tr>
        <?php endif;?>
        <?php if (!$technology->meetRRequirement(6) &&!$technology->getTech(6)):?>
        <tr><td class="desc"><div class="tit"><img class="unit u6" src="img/x.gif" alt="<?php echo U6; ?>"/><a onclick="return Popup(6,1);" href="#"><?php echo U6; ?></a></div></td><td class="cond"><a href="#" onclick="return Popup(22,4);"><?php echo ACADEMY;?></a> <span><?php echo LEVEL;?> 15</span><br><a href="#" onclick="return Popup(20,4);"><?php echo STABLE;?></a> <span><?php echo LEVEL;?> 10</span></td></tr>
        <?php endif;?>
        <?php if (!$technology->meetRRequirement(7) &&!$technology->getTech(7)):?>
        <tr><td class="desc"><div class="tit"><img class="unit u7" src="img/x.gif" alt="<?php echo U7; ?>"/><a onclick="return Popup(7,1);" href="#"><?php echo U7; ?></a></div></td><td class="cond"><a href="#" onclick="return Popup(22,4);"><?php echo ACADEMY;?></a> <span><?php echo LEVEL;?> 10</span><br><a href="#" onclick="return Popup(21,4);"><?php echo WORKSHOP;?></a> <span><?php echo LEVEL;?> 1</span></td></tr>
        <?php endif;?>
        <?php if (!$technology->meetRRequirement(8) &&!$technology->getTech(8)):?>
        <tr><td class="desc"><div class="tit"><img class="unit u8" src="img/x.gif" alt="<?php echo U8; ?>"/><a onclick="return Popup(8,1);" href="#"><?php echo U8; ?></a></div></td><td class="cond"><a href="#" onclick="return Popup(21,4);"><?php echo WORKSHOP;?></a> <span><?php echo LEVEL;?> 10</span><br><a href="#" onclick="return Popup(22,4);"><?php echo ACADEMY;?></a> <span><?php echo LEVEL;?> 15</span></td></tr>
        <?php endif;?>
        <?php if (!$technology->meetRRequirement(9) &&!$technology->getTech(9)):?>
        <tr><td class="desc"><div class="tit"><img class="unit u9" src="img/x.gif" alt="<?php echo U9; ?>"/><a onclick="return Popup(9,1);" href="#"><?php echo U9; ?></a></div></td><td class="cond"><a href="#" onclick="return Popup(16,4);"><?php echo RALLYPOINT;?></a> <span><?php echo LEVEL;?> 10</span><br><a href="#" onclick="return Popup(22,4);"><?php echo ACADEMY;?></a> <span><?php echo LEVEL;?> 20</span></td></tr>
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