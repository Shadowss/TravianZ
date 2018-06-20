<?php
//TODO: Reduce this file by a lot, by using arrays
$MyGold = mysqli_query($database->dblink, "SELECT * FROM " . TB_PREFIX . "users WHERE `id`='" . $session->uid . "'") or die(mysqli_error($database->dblink));
$golds = mysqli_fetch_array($MyGold);

include ("Templates/Plus/pmenu.tpl");

$MyGold = mysqli_query($database->dblink, "SELECT * FROM " . TB_PREFIX . "users WHERE `id`='" . $session->uid . "'") or die(mysqli_error($database->dblink));
$golds = mysqli_fetch_array($MyGold);

$today = date("mdHi");

if (mysqli_num_rows($MyGold)) {
    if ($session->gold == 0)
        echo "<p>You currently don't own gold.</p>";
    else
        echo "<p>You currently have <b> $session->gold </b>  gold</p>";
}

?>
<table class="plusFunctions" cellpadding="1" cellspacing="1">
	<thead>
		<tr>
			<th colspan="5">Plus function</th>
		</tr>
		<tr>
			<td></td>

			<td>Description</td>
			<td>Duration</td>
			<td>Gold</td>
			<td>Action</td>
		</tr>
	</thead>
	<tbody>

		<tr>
			<td class="man"><a href="#" onClick="return Popup(0,6);"><img
					class="help" src="img/x.gif" alt="" title="" /></a></td>
			<td class="desc"><b><font color="#71D000">P</font><font
					color="#FF6F0F">l</font><font color="#71D000">u</font><font
					color="#FF6F0F">s</font></b> Account<br /> <span class="run">
<?php
$datetimep = $golds['plus'];
$datetime1 = $golds['b1'];
$datetime2 = $golds['b2'];
$datetime3 = $golds['b3'];
$datetime4 = $golds['b4'];
$datetimeap = $golds['ap'];
$datetimedp = $golds['dp'];

// Retrieve the current date/time
$date2 = strtotime("NOW");

if ($datetimep == 0) echo "get PLUS<br>";
else 
{
    if ($datetimep <= $date2) {
        print "Your PLUS advantage has ended.<br>";
        mysqli_query($database->dblink, "UPDATE " . TB_PREFIX . "users set plus = '0' where `id`='" . $session->uid . "'") or die(mysqli_error($database->dblink));
    } else {
        
        $holdtotmin = (($datetimep - $date2) / 60);
        $holdtothr = (($datetimep - $date2) / 3600);
        $holdtotday = intval(($datetimep - $date2) / 86400);
        echo "<font color='#B3B3B3' size='1'>Remaining: <b>" . $holdtotday . "</b> days";
        
        $holdhr = intval($holdtothr - ($holdtotday * 24));
        echo " <b>" . ($holdhr) . "</b> hours ";
        
        $holdmr = intval($holdtotmin - (($holdhr * 60) + ($holdtotday * 1440)));
        echo "<b> " . ($holdmr) . "</b> mins</font>";
    }
}
    ?>
    </span></td>
			<td class="dur"><?php
    
if (PLUS_TIME >= 86400) {
        echo '' . (PLUS_TIME / 86400) . ' Days';
    } else if (PLUS_TIME < 86400) {
        echo '' . (PLUS_TIME / 3600) . ' Hours';
    }
    ?>
            </td>
			<td class="cost"><img src="img/x.gif" class="gold" alt="Gold"
				title="Gold" alt="Gold" title="Gold" />10</td>
			<td class="act">

<?php
    $MyGold = mysqli_query($database->dblink, "SELECT * FROM " . TB_PREFIX . "users WHERE `id`='" . $session->uid . "'") or die(mysqli_error($database->dblink));
    $golds = mysqli_fetch_array($MyGold);
    
    if (mysqli_num_rows($MyGold)) {
        if ($golds['gold'] > 9 && $datetimep < $date2) {
            echo '
                <a href="plus.php?id=8"><span>Activate';
        } elseif ($golds['gold'] > 9 && $datetimep > $date2) {
            echo '
                <a href="plus.php?id=8"><span>Extend';
        } else {
            echo '<a href="plus.php?s=1"><span class="none">too little gold';
        }
    }
?>
    </span></a>
			</td>
		</tr>

		<tr>
			<td colspan="5" class="empty"></td>

		</tr>
		<tr>
			<td class="man"><a href="#" onClick="return Popup(1,6);"><img
					class="help" src="img/x.gif" alt="" title="" /></a></td>
			<td class="desc">+<b>25</b>% <img class="r1" src="img/x.gif"
				alt="Lumber" title="Lumber" /> Production: Lumber<br /> <span
				class="run">
<?php

$tl_b1 = $golds['b1'];
if ($tl_b1 < $date2) {
    print " ";
} else {
    $holdtotmin1 = (($tl_b1 - $date2) / 60);
    $holdtothr1 = (($tl_b1 - $date2) / 3600);
    $holdtotday1 = intval(($tl_b1 - $date2) / 86400);
    $holdhr1 = intval($holdtothr1 - ($holdtotday1 * 24));
    $holdmr1 = intval($holdtotmin1 - (($holdhr1 * 60) + ($holdtotday1 * 1440)));
}

if ($tl_b1 < $date2) {
    print " ";
} else {
    
    echo "<font color='#B3B3B3' size='1'>Remaining <b> " . $holdtotday1 . "</b> days ";
    echo "<b>  " . ($holdhr1) . "</b> hours ";
    echo "<b>  " . ($holdmr1) . "</b> mins</font> ";
}
?>
&nbsp;    </span>

			</td>
			<td class="dur"><?php

if (PLUS_PRODUCTION >= 86400) {
    echo '' . (PLUS_PRODUCTION / 86400) . ' Days';
} else if (PLUS_PRODUCTION < 86400) {
    echo '' . (PLUS_PRODUCTION / 3600) . ' Hours';
}
?></td>
			<td class="cost"><img src="img/x.gif" class="gold" alt="Gold"
				title="Gold" />5</td>
			<td class="act"><span class="none">

<?php
if ($session->access != BANNED) {
    if (mysqli_num_rows($MyGold)) {
        if ($golds['gold'] > 4 && $tl_b1 < $date2) {
            echo '<a href="plus.php?id=9"><span>Activate';
        } elseif ($golds['gold'] > 4 && $datetime1 > $date2) {
            echo '        <a href="plus.php?id=9"><span>Extend';
        } else {
            echo '<a href="plus.php?s=1"><span class="none">too little gold';
        }
    }
} else {
    if (mysqli_num_rows($MyGold)) {
        if ($golds['gold'] > 4 && $tl_b1 < $date2) {
            echo '<a href="banned.php"><span>Activate';
        } elseif ($golds['gold'] > 4 && $datetime1 > $date2) {
            echo '        <a href="banned.php"><span>Extend';
        } else {
            echo '<a href="banned.php"><span class="none">too little gold';
        }
    }
}
?>
   </span></a></td>
		</tr>

		<tr>
			<td class="man"><a href="#" onClick="return Popup(2,6);"><img
					class="help" src="img/x.gif" alt="" title="" /></a></td>

			<td class="desc">+<b>25</b>% <img class="r2" src="img/x.gif"
				alt="Clay" title="Clay" /> Production: Clay<br /> <span class="run">
<?php

$tl_b2 = $golds['b2'];
if ($tl_b2 < $date2) {
    print " ";
} else {
    $holdtotmin2 = (($tl_b2 - $date2) / 60);
    $holdtothr2 = (($tl_b2 - $date2) / 3600);
    $holdtotday2 = intval(($tl_b2 - $date2) / 86400);
    $holdhr2 = intval($holdtothr2 - ($holdtotday2 * 24));
    $holdmr2 = intval($holdtotmin2 - (($holdhr2 * 60) + ($holdtotday2 * 1440)));
}

if ($tl_b2 < $date2) {
    print " ";
} else {
    
    echo "<font color='#B3B3B3' size='1'>Remaining: <b> " . $holdtotday2 . "</b> days ";
    echo "<b>  " . ($holdhr2) . "</b> hours ";
    echo "<b>  " . ($holdmr2) . "</b> mins<font>";
}
?>
&nbsp;    </span>
			</td>
			<td class="dur"><?php

if (PLUS_PRODUCTION >= 86400) {
    echo '' . (PLUS_PRODUCTION / 86400) . ' Days';
} else if (PLUS_PRODUCTION < 86400) {
    echo '' . (PLUS_PRODUCTION / 3600) . ' Hours';
}
?></td>
			<td class="cost"><img src="img/x.gif" class="gold" alt="Gold"
				title="Gold" />5</td>

			<td class="act"><span class="none">

<?php
if ($session->access != BANNED) {
    if (mysqli_num_rows($MyGold)) {
        if ($golds['gold'] > 4 && $tl_b2 < $date2) {
            echo '<a href="plus.php?id=10"><span>Activate';
        } elseif ($golds['gold'] > 4 && $tl_b2 > $date2) {
            echo '        <a href="plus.php?id=10"><span>Extend';
        } else {
            echo '<a href="plus.php?s=1"><span class="none">too little gold</span></a></td>';
        }
    }
} else {
    if (mysqli_num_rows($MyGold)) {
        if ($golds['gold'] > 4 && $tl_b2 < $date2) {
            echo '<a href="banned.php"><span>Activate';
        } elseif ($golds['gold'] > 4 && $tl_b2 > $date2) {
            echo '        <a href="banned.php"><span>Extend';
        } else {
            echo '<a href="banned.php"><span class="none">too little gold</span></a></td>';
        }
    }
}
?>

        
		
		</tr>

		<tr>
			<td class="man"><a href="#" onClick="return Popup(3,6);"><img
					class="help" src="img/x.gif" alt="" title="" /></a></td>
			<td class="desc">+<b>25</b>% <img class="r3" src="img/x.gif"
				alt="Iron" title="Iron" /> Production: Iron<br /> <span class="run">
<?php

$tl_b3 = $golds['b3'];
if ($tl_b3 < $date2) {
    print " ";
} else {
    $holdtotmin3 = (($tl_b3 - $date2) / 60);
    $holdtothr3 = (($tl_b3 - $date2) / 3600);
    $holdtotday3 = intval(($tl_b3 - $date2) / 86400);
    $holdhr3 = intval($holdtothr3 - ($holdtotday3 * 24));
    $holdmr3 = intval($holdtotmin3 - (($holdhr3 * 60) + ($holdtotday3 * 1440)));
}

if ($tl_b3 < $date2) {
    print " ";
} else {
    
    echo "<font color='#B3B3B3' size='1'>Remaining: <b> " . $holdtotday3 . "</b> days ";
    echo "<b>  " . ($holdhr3) . "</b> hours ";
    echo "<b>  " . ($holdmr3) . "</b> mins</font>";
}
?>
&nbsp;    </span>
			</td>
			<td class="dur"><?php

if (PLUS_PRODUCTION >= 86400) {
    echo '' . (PLUS_PRODUCTION / 86400) . ' Days';
} else if (PLUS_PRODUCTION < 86400) {
    echo '' . (PLUS_PRODUCTION / 3600) . ' Hours';
}
?></td>
			<td class="cost"><img src="img/x.gif" class="gold" alt="Gold"
				title="Gold" />5</td>
			<td class="act"><span class="none">

<?php
if ($session->access != BANNED) {
    if (mysqli_num_rows($MyGold)) {
        if ($golds['gold'] > 4 && $tl_b3 < $date2) {
            echo '<a href="plus.php?id=11"><span>Activate';
        } elseif ($golds['gold'] > 4 && $tl_b3 > $date2) {
            echo '        <a href="plus.php?id=11"><span>Extend';
        } else {
            echo '<a href="plus.php?s=1"><span class="none">too little gold';
        }
    }
} else {
    if (mysqli_num_rows($MyGold)) {
        if ($golds['gold'] > 4 && $tl_b3 < $date2) {
            echo '<a href="banned.php"><span>Activate';
        } elseif ($golds['gold'] > 4 && $tl_b3 > $date2) {
            echo '        <a href="banned.php"><span>Extend';
        } else {
            echo '<a href="banned.php"><span class="none">too little gold';
        }
    }
}
?>
&nbsp;    </span></a></td>
		</tr>

		<tr>

			<td class="man"><a href="#" onClick="return Popup(4,6);"><img
					class="help" src="img/x.gif" alt="" title="" /></a></td>
			<td class="desc">+<b>25</b>% <img class="r4" src="img/x.gif"
				alt="Crop" title="Crop" /> Production: Crop<br /> <span class="run">
<?php

$tl_b4 = $golds['b4'];
if ($tl_b4 < $date2) {
    print " ";
} else {
    $holdtotmin4 = (($tl_b4 - $date2) / 60);
    $holdtothr4 = (($tl_b4 - $date2) / 3600);
    $holdtotday4 = intval(($tl_b4 - $date2) / 86400);
    $holdhr4 = intval($holdtothr4 - ($holdtotday4 * 24));
    $holdmr4 = intval($holdtotmin4 - (($holdhr4 * 60) + ($holdtotday4 * 1440)));
}

if ($tl_b4 < $date2) {
    print " ";
} else {
    
    echo "<font color='#B3B3B3' size='1'>Remaining: <b> " . $holdtotday4 . "</b> days ";
    echo "<b>  " . ($holdhr4) . "</b> hours ";
    echo "<b>  " . ($holdmr4) . "</b> mins</font>";
}
?>
&nbsp;    </span>
			</td>
			<td class="dur"><?php

if (PLUS_PRODUCTION >= 86400) {
    echo '' . (PLUS_PRODUCTION / 86400) . ' Days';
} else if (PLUS_PRODUCTION < 86400) {
    echo '' . (PLUS_PRODUCTION / 3600) . ' Hours';
}
?></td>
			<td class="cost"><img src="img/x.gif" class="gold" alt="Gold"
				title="Gold" />5</td>
			<td><span class="none">
<?php
if ($session->access != BANNED) {
    if (mysqli_num_rows($MyGold)) {
        if ($golds['gold'] > 4 && $tl_b4 < $date2) {
            echo '<a href="plus.php?id=12"><span>Activate';
        } elseif ($golds['gold'] > 4 && $tl_b4 > $date2) {
            echo '        <a href="plus.php?id=12"><span>Extend';
        } else {
            echo '<a href="plus.php?s=1"><span class="none">too little gold';
        }
    }
} else {
    if (mysqli_num_rows($MyGold)) {
        if ($golds['gold'] > 4 && $tl_b4 < $date2) {
            echo '<a href="banned.php"><span>Activate';
        } elseif ($golds['gold'] > 4 && $tl_b4 > $date2) {
            echo '        <a href="banned.php"><span>Extend';
        } else {
            echo '<a href="banned.php"><span class="none">too little gold';
        }
    }
}
?>
</span></a></td>
		</tr>

		<tr>
			<td colspan="5" class="empty"></td>
		</tr>
		<tr>

			<td class="man"><a href="#" onClick="return Popup(7,6);"><img
					class="help" src="img/x.gif" alt="" title="" /></a></td>
			<td class="desc">Complete construction orders and researches in this
				village now (does not work for Palace and Residence).</td>
			<td class="dur">now</td>
			<td class="cost"><img src="img/x.gif" class="gold" alt="Gold"
				title="Gold" />2</td>
			<td class="act"><span class="none">

<?php
if ($session->access != BANNED) {
    if (mysqli_num_rows($MyGold)) {
        if ($golds['gold'] > 1) {
            echo '
                <a href="plus.php?id=7"><span>On';
        } else {
            echo '<a href="plus.php?s=1"><span class="none">too little gold';
        }
    }
} else {
    if (mysqli_num_rows($MyGold)) {
        if ($golds['gold'] > 1) {
            echo '
                <a href="banned.php"><span>On';
        } else {
            echo '<a href="banned.php"><span class="none">too little gold';
        }
    }
}
?>
</span></a></td>
		</tr>

		<tr>
			<td class="man"><a href="#" onClick="return Popup(8,6);"><img
					class="help" src="img/x.gif" alt="" title="" /></a></td>
			<td class="desc">1:1 Trade with the NPC merchant</td>
			<td class="dur">now</td>
			<td class="cost"><img src="img/x.gif" class="gold" alt="Gold"
				title="Gold" />3</td>

			<td class="act"><span class="none">

<?php
if ($session->access != BANNED) {
    if (mysqli_num_rows($MyGold)) {
        if ($golds['gold'] > 2) {
            echo ' <a href="build.php?gid=17&t=3"><span>NPC';
        } else {
            echo '<a href="plus.php?s=1"><span class="none">too little gold';
        }
    }
} else {
    if (mysqli_num_rows($MyGold)) {
        if ($golds['gold'] > 2) {
            echo ' <a href="banned.php"><span>NPC';
        } else {
            echo '<a href="banned.php"><span class="none">too little gold';
        }
    }
}
?>
</span></a></td>
		</tr>

	</tbody>
</table>
<table class="plusFunctions" cellpadding="1" cellspacing="1">
	<thead>
		<tr>
			<th colspan="5">Travian Gold Club</th>
		</tr>
		<tr>
			<td></td>

			<td>Description</td>
			<td>Duration</td>
			<td>Gold</td>
			<td>Action</td>
		</tr>
	</thead>
	<tbody>

		<tr>
			<td class="man"><a href="#" onClick="return Popup(9,6);"><img
					class="help" src="img/x.gif" alt="" title="" /></a></td>
			<td class="desc"><b>Gold Club</b></br> <span class="run"> </span></td>
			<td class="dur">Whole game round</td>
			<td class="cost"><img src="img/x.gif" class="gold" alt="Gold"
				title="Gold" alt="Gold" title="Gold" />100</td>
			<td class="act">

<?php
$MyGold = mysqli_query($database->dblink, "SELECT * FROM " . TB_PREFIX . "users WHERE `id`='" . $session->uid . "'") or die(mysqli_error($database->dblink));
$golds = mysqli_fetch_array($MyGold);

if (mysqli_num_rows($MyGold)) {
    if ($golds['goldclub'] == 0) {
        if ($golds['gold'] > 99) {
            echo '
                <a href="plus.php?id=15"><span>Activate';
        } else {
            echo '
                <a href="plus.php?s=1"><span class="none">too little gold';
        }
    } else {
        echo '<a href="plus.php?id=3"><span class="none">On';
    }
}
?>
    </span></a>
			</td>
		</tr>
	</tbody>
</table>
</div>
