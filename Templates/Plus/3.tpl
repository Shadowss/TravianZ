<?php
// TODO: Reduce this file by a lot, by using arrays
$MyGold = mysqli_query($database->dblink, "SELECT * FROM " . TB_PREFIX . "users WHERE id='".$session->uid."'") or die(mysqli_error($database->dblink));
$golds = mysqli_fetch_assoc($MyGold);

include ("Templates/Plus/pmenu.tpl");

$date2 = time();

if ($golds) {
    if ($golds['gold'] == 0)
        echo "<p>You currently don't own gold.</p>";
    else
        echo "<p>".CURRENT_HAVE." <b>".$golds['gold']."</b> ".GOLD."</p>";
}

$datetimep = $golds['plus'];
$datetime1 = $golds['b1'];
$datetime2 = $golds['b2'];
$datetime3 = $golds['b3'];
$datetime4 = $golds['b4'];

function formatRemainingTime($endTimestamp, $nowTimestamp) {
    $remaining = (int)$endTimestamp - (int)$nowTimestamp;
    if ($remaining <= 0) return '';
    $days = intdiv($remaining, 86400); $remaining %= 86400;
    $hours = intdiv($remaining, 3600); $remaining %= 3600;
    $mins = intdiv($remaining, 60); $secs = $remaining % 60;
    return 'Remaining: <b>'.$days.'</b> '.DAYS.' <b>'.$hours.'</b> '.HOURS.' <b>'.$mins.'</b> '.MINS.' <b>'.$secs.'</b> secs (until '.date('H:i:s', (int)$endTimestamp).')';
}
?>
<table class="plusFunctions" cellpadding="1" cellspacing="1">
	<thead>
		<tr><th colspan="5">Plus function</th></tr>
		<tr><td></td><td><?php echo DESCRIPTION; ?></td><td><?php echo DURATION; ?></td><td><?php echo GOLD; ?></td><td><?php echo ACTION; ?></td></tr>
	</thead>
	<tbody>
		<tr>
			<td class="man"><a href="#" onClick="return Popup(0,6);"><img class="help" src="img/x.gif" alt="" /></a></td>
			<td class="desc"><b><font color="#71D000">P</font><font color="#FF6F0F">l</font><font color="#71D000">u</font><font color="#FF6F0F">s</font></b> <?php echo ACCOUNT; ?><br />
            <span class="run"><?php
            if ($datetimep == 0) echo "get PLUS<br>";
            else {
                if ($datetimep <= $date2) {
                    echo "Your PLUS advantage has ended.<br>";
                    mysqli_query($database->dblink, "UPDATE ".TB_PREFIX."users SET plus='0' WHERE id='".$session->uid."'");
                } else {
                    echo "<font color='#B3B3B3' size='1'>".formatRemainingTime($datetimep, $date2)."</font>";
                }
            }
            ?></span></td>
			<td class="dur"><?php echo (PLUS_TIME >= 86400) ? (PLUS_TIME/86400).' Days' : (PLUS_TIME/3600).' Hours'; ?></td>
			<td class="cost"><img src="img/x.gif" class="gold" />10</td>
			<td class="act"><?php
                if ($golds['gold'] > 9 && $datetimep < $date2) {
                    echo '<a href="plus.php?id=8" onclick="if(this.dataset.c) return false; this.dataset.c=1; this.style.pointerEvents=\'none\'; this.style.opacity=\'0.5\';"><span>'.ACTIVATE.'</span></a>';
                } elseif ($golds['gold'] > 9 && $datetimep > $date2) {
                    echo '<a href="plus.php?id=8" onclick="if(this.dataset.c) return false; this.dataset.c=1; this.style.pointerEvents=\'none\'; this.style.opacity=\'0.5\';"><span>'.EXTEND.'</span></a>';
                } else {
                    echo '<a href="plus.php?s=1"><span class="none">'.TOO_LITTLE_GOLD.'</span></a>';
                }
            ?></td>
		</tr>

		<tr><td colspan="5" class="empty"></td></tr>

		<!-- LUMBER -->
		<tr>
			<td class="man"><a href="#" onClick="return Popup(1,6);"><img class="help" src="img/x.gif" /></a></td>
			<td class="desc">+<b>25</b>% <img class="r1" src="img/x.gif" /> <?php echo TZ_PRODUCTION_LUMBER; ?><br />
            <span class="run"><?php $tl_b1=$golds['b1']; if($tl_b1>=$date2) echo "<font color='#B3B3B3' size='1'>".formatRemainingTime($tl_b1,$date2)."</font>"; ?></span></td>
			<td class="dur"><?php echo (PLUS_PRODUCTION>=86400)?(PLUS_PRODUCTION/86400).' Days':(PLUS_PRODUCTION/3600).' Hours'; ?></td>
			<td class="cost"><img src="img/x.gif" class="gold" />5</td>
			<td class="act"><span class="none"><?php
                if($session->access!=BANNED){
                    if($golds['gold']>4 && $tl_b1<$date2){
                        echo '<a href="plus.php?id=9" onclick="if(this.dataset.c) return false; this.dataset.c=1; this.style.pointerEvents=\'none\'; this.style.opacity=\'0.5\';"><span>'.ACTIVATE.'</span></a>';
                    } elseif($golds['gold']>4 && $datetime1>$date2){
                        echo '<a href="plus.php?id=9" onclick="if(this.dataset.c) return false; this.dataset.c=1; this.style.pointerEvents=\'none\'; this.style.opacity=\'0.5\';"><span>'.EXTEND.'</span></a>';
                    } else echo '<a href="plus.php?s=1"><span class="none">'.TOO_LITTLE_GOLD.'</span></a>';
                } else {
                    echo '<a href="banned.php"><span class="none">'.TOO_LITTLE_GOLD.'</span></a>';
                }
            ?></span></td>
		</tr>

		<!-- CLAY -->
		<tr>
			<td class="man"><a href="#" onClick="return Popup(2,6);"><img class="help" src="img/x.gif" /></a></td>
			<td class="desc">+<b>25</b>% <img class="r2" src="img/x.gif" /> <?php echo TZ_PRODUCTION_CLAY; ?><br />
            <span class="run"><?php $tl_b2=$golds['b2']; if($tl_b2>=$date2) echo "<font color='#B3B3B3' size='1'>".formatRemainingTime($tl_b2,$date2)."</font>"; ?></span></td>
			<td class="dur"><?php echo (PLUS_PRODUCTION>=86400)?(PLUS_PRODUCTION/86400).' Days':(PLUS_PRODUCTION/3600).' Hours'; ?></td>
			<td class="cost"><img src="img/x.gif" class="gold" />5</td>
			<td class="act"><span class="none"><?php
                if($session->access!=BANNED){
                    if($golds['gold']>4 && $tl_b2<$date2){
                        echo '<a href="plus.php?id=10" onclick="if(this.dataset.c) return false; this.dataset.c=1; this.style.pointerEvents=\'none\'; this.style.opacity=\'0.5\';"><span>'.ACTIVATE.'</span></a>';
                    } elseif($golds['gold']>4 && $tl_b2>$date2){
                        echo '<a href="plus.php?id=10" onclick="if(this.dataset.c) return false; this.dataset.c=1; this.style.pointerEvents=\'none\'; this.style.opacity=\'0.5\';"><span>'.EXTEND.'</span></a>';
                    } else echo '<a href="plus.php?s=1"><span class="none">'.TOO_LITTLE_GOLD.'</span></a>';
                } else echo '<a href="banned.php"><span class="none">'.TOO_LITTLE_GOLD.'</span></a>';
            ?></span></td>
		</tr>

		<!-- IRON -->
		<tr>
			<td class="man"><a href="#" onClick="return Popup(3,6);"><img class="help" src="img/x.gif" /></a></td>
			<td class="desc">+<b>25</b>% <img class="r3" src="img/x.gif" /> <?php echo TZ_PRODUCTION_IRON; ?><br />
            <span class="run"><?php $tl_b3=$golds['b3']; if($tl_b3>=$date2) echo "<font color='#B3B3B3' size='1'>".formatRemainingTime($tl_b3,$date2)."</font>"; ?></span></td>
			<td class="dur"><?php echo (PLUS_PRODUCTION>=86400)?(PLUS_PRODUCTION/86400).' Days':(PLUS_PRODUCTION/3600).' Hours'; ?></td>
			<td class="cost"><img src="img/x.gif" class="gold" />5</td>
			<td class="act"><span class="none"><?php
                if($session->access!=BANNED){
                    if($golds['gold']>4 && $tl_b3<$date2){
                        echo '<a href="plus.php?id=11" onclick="if(this.dataset.c) return false; this.dataset.c=1; this.style.pointerEvents=\'none\'; this.style.opacity=\'0.5\';"><span>'.ACTIVATE.'</span></a>';
                    } elseif($golds['gold']>4 && $tl_b3>$date2){
                        echo '<a href="plus.php?id=11" onclick="if(this.dataset.c) return false; this.dataset.c=1; this.style.pointerEvents=\'none\'; this.style.opacity=\'0.5\';"><span>'.EXTEND.'</span></a>';
                    } else echo '<a href="plus.php?s=1"><span class="none">'.TOO_LITTLE_GOLD.'</span></a>';
                } else echo '<a href="banned.php"><span class="none">'.TOO_LITTLE_GOLD.'</span></a>';
            ?></span></td>
		</tr>

		<!-- CROP -->
		<tr>
			<td class="man"><a href="#" onClick="return Popup(4,6);"><img class="help" src="img/x.gif" /></a></td>
			<td class="desc">+<b>25</b>% <img class="r4" src="img/x.gif" /> <?php echo TZ_PRODUCTION_CROP; ?><br />
            <span class="run"><?php $tl_b4=$golds['b4']; if($tl_b4>=$date2) echo "<font color='#B3B3B3' size='1'>".formatRemainingTime($tl_b4,$date2)."</font>"; ?></span></td>
			<td class="dur"><?php echo (PLUS_PRODUCTION>=86400)?(PLUS_PRODUCTION/86400).' Days':(PLUS_PRODUCTION/3600).' Hours'; ?></td>
			<td class="cost"><img src="img/x.gif" class="gold" />5</td>
			<td class="act"><span class="none"><?php
                if($session->access!=BANNED){
                    if($golds['gold']>4 && $tl_b4<$date2){
                        echo '<a href="plus.php?id=12" onclick="if(this.dataset.c) return false; this.dataset.c=1; this.style.pointerEvents=\'none\'; this.style.opacity=\'0.5\';"><span>'.ACTIVATE.'</span></a>';
                    } elseif($golds['gold']>4 && $tl_b4>$date2){
                        echo '<a href="plus.php?id=12" onclick="if(this.dataset.c) return false; this.dataset.c=1; this.style.pointerEvents=\'none\'; this.style.opacity=\'0.5\';"><span>'.EXTEND.'</span></a>';
                    } else echo '<a href="plus.php?s=1"><span class="none">'.TOO_LITTLE_GOLD.'</span></a>';
                } else echo '<a href="banned.php"><span class="none">'.TOO_LITTLE_GOLD.'</span></a>';
            ?></span></td>
		</tr>

		<tr><td colspan="5" class="empty"></td></tr>

		<tr>
			<td class="man"><a href="#" onClick="return Popup(7,6);"><img class="help" src="img/x.gif" /></a></td>
			<td class="desc"><?php echo TZ_COMPLETE_CONSTRUCTION_ORDERS_AND_R; ?></td>
			<td class="dur"><?php echo NOW; ?></td>
			<td class="cost"><img src="img/x.gif" class="gold" />2</td>
			<td class="act"><span class="none"><?php
                echo ($golds['gold']>1) ? '<a href="plus.php?id=7" onclick="if(this.dataset.c) return false; this.dataset.c=1; this.style.pointerEvents=\'none\';"><span>'.ON.'</span></a>' : '<a href="plus.php?s=1"><span class="none">'.TOO_LITTLE_GOLD.'</span></a>';
            ?></span></td>
		</tr>

		<tr>
			<td class="man"><a href="#" onClick="return Popup(8,6);"><img class="help" src="img/x.gif" /></a></td>
			<td class="desc"><?php echo TZ_N_1_1_TRADE_WITH_THE_NPC_MERCHANT; ?></td>
			<td class="dur"><?php echo NOW; ?></td>
			<td class="cost"><img src="img/x.gif" class="gold" />3</td>
			<td class="act"><span class="none"><?php
                echo ($golds['gold']>2) ? '<a href="build.php?gid=17&t=3"><span>'.NPC.'</span></a>' : '<a href="plus.php?s=1"><span class="none">'.TOO_LITTLE_GOLD.'</span></a>';
            ?></span></td>
		</tr>
	</tbody>
</table>

<table class="plusFunctions" cellpadding="1" cellspacing="1">
	<thead><tr><th colspan="5"><?php echo TZ_TRAVIAN_GOLD_CLUB; ?></th></tr>
	<tr><td></td><td><?php echo DESCRIPTION; ?></td><td><?php echo DURATION; ?></td><td><?php echo GOLD; ?></td><td><?php echo ACTION; ?></td></tr></thead>
	<tbody>
		<tr>
			<td class="man"><a href="#" onClick="return Popup(9,6);"><img class="help" src="img/x.gif" /></a></td>
			<td class="desc"><b><?php echo GOLD_CLUB; ?></b></td>
			<td class="dur"><?php echo FOR_GAME_SERVER; ?></td>
			<td class="cost"><img src="img/x.gif" class="gold" />100</td>
			<td class="act"><?php
                if($golds['goldclub']==0){
                    if($golds['gold']>99){
                        echo '<a href="plus.php?id=15" onclick="if(this.dataset.c) return false; this.dataset.c=1; this.style.pointerEvents=\'none\'; this.style.opacity=\'0.5\';"><span>'.ACTIVATE.'</span></a>';
                    } else echo '<a href="plus.php?s=1"><span class="none">'.TOO_LITTLE_GOLD.'</span></a>';
                } else echo '<a href="plus.php?id=3"><span class="none">'.ON.'</span></a>';
            ?></td>
		</tr>
	</tbody>
</table>
</div>