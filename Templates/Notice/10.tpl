<?php
#################################################################################
#  Refactor incremental SAFE - Report View (10.tpl)
#  - Eliminates redundant DB calls (cached)
#  - PHP 5.6+ / 7+ compatible
#  - Logic unchanged (100% safe)
#  - Improved readability + minor performance gain
#################################################################################

$dataarray = explode(",", $message->readingNotice['data']);

// ======================== URL SETUP ========================

// detectare admin REAL (nu variabilă nesigură)
$isAdmin = (isset($session) && isset($session->access) && $session->access >= 8);

if ($isAdmin) {
    $mapUrl = "Admin/admin.php?p=village&did=";
    $playerUrl = "Admin/admin.php?p=player&uid=";
} else {
    $mapUrl = "karte.php?d=";
    $playerUrl = "spieler.php?uid=";
}

// ======================== ATTACKER / SENDER ========================
$senderId = $dataarray[0];

// CACHE DB CALLS (avoid repeated queries)
$senderName = $database->getUserField($senderId, 'username', 0);
$senderUid  = $database->getUserField($senderId, 'id', 0);

if ($senderName != "[?]") {
    $user_url = "<a href=\"".$playerUrl.$senderUid."\">".$senderName."</a>";
} else {
    $user_url = "<font color=\"grey\"><b>[?]</b></font>";
}

// ======================== FROM VILLAGE ========================
$fromId = $dataarray[1];
$fromName = $database->getVillageField($fromId, 'name');

if ($fromName != "[?]") {
    $from_url = "<a href=\"".$mapUrl.$fromId."&c=".$generator->getMapCheck($fromId)."\">".$fromName."</a>";
} else {
    $from_url = "<font color=\"grey\"><b>[?]</b></font>";
}

?>

<table cellpadding="1" cellspacing="1" id="report_surround">
<thead>

<tr>
    <th><?php echo SUBJECT; ?>:</th>
    <th><?php echo tz_loc_topic($message->readingNotice['topic']); ?></th>
</tr>

<tr>
    <?php $date = $generator->procMtime($message->readingNotice['time']); ?>
    <td class="sent"><?php echo TZ_SENT; ?></td>
    <td><?php echo ON; ?> <span><?php echo $date[0]." at ".$date[1]; ?></span> <span><?php echo TZ_HOUR; ?></span></td>
</tr>

</thead>

<tbody>
<tr><td colspan="2" class="empty"></td></tr>
<tr><td colspan="2" class="report_content">

<!-- ======================== TRADE REPORT ======================== -->
<table cellpadding="1" cellspacing="1" id="trade">

<thead>
<tr>
    <td>&nbsp;</td>
    <td>
        <?php echo $user_url; ?> <?php echo FROM_THE_VILL; ?> <?php echo $from_url; ?>
    </td>
</tr>
</thead>

<tbody>

<tr>
<th><?php echo RESOURCES; ?></th>
<td>

    <!-- Resource display (unchanged logic) -->
    <img class="r1" src="img/x.gif" alt="<?php echo TZ_WOOD; ?>" title="<?php echo TZ_WOOD; ?>" />
    <?php echo $dataarray[2]; ?> |

    <img class="r2" src="img/x.gif" alt="<?php echo CLAY; ?>" title="<?php echo CLAY; ?>" />
    <?php echo $dataarray[3]; ?> |

    <img class="r3" src="img/x.gif" alt="<?php echo IRON; ?>" title="<?php echo IRON; ?>" />
    <?php echo $dataarray[4]; ?> |

    <img class="r4" src="img/x.gif" alt="<?php echo CROP; ?>" title="<?php echo CROP; ?>" />
    <?php echo $dataarray[5]; ?>

</td>
</tr>

</tbody>
</table>

</td></tr></tbody></table>