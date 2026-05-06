<?php
#################################################################################
#  Refactor incremental SAFE - Report View (10.tpl)
#  - Eliminates redundant DB calls (cached)
#  - PHP 5.6+ / 7+ compatible
#  - Logic unchanged (100% safe)
#  - Improved readability + minor performance gain
#################################################################################

$dataarray = explode(",", $message->readingNotice['data']);

// ======================== URL BASE ========================
if (!isset($isAdmin)) {
    $mapUrl = "karte.php?d=";
    $playerUrl = "spieler.php?uid=";
} else {
    $mapUrl = "admin.php?p=village&did=";
    $playerUrl = "admin.php?p=player&uid=";
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
    <th>Subject:</th>
    <th><?php echo $message->readingNotice['topic']; ?></th>
</tr>

<tr>
    <?php $date = $generator->procMtime($message->readingNotice['time']); ?>
    <td class="sent">Sent:</td>
    <td>on <span><?php echo $date[0]." at ".$date[1]; ?></span> <span>hour</span></td>
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
        <?php echo $user_url; ?> from the village <?php echo $from_url; ?>
    </td>
</tr>
</thead>

<tbody>

<tr>
<th>Resources</th>
<td>

    <!-- Resource display (unchanged logic) -->
    <img class="r1" src="img/x.gif" alt="Wood" title="Wood" />
    <?php echo $dataarray[2]; ?> |

    <img class="r2" src="img/x.gif" alt="Clay" title="Clay" />
    <?php echo $dataarray[3]; ?> |

    <img class="r3" src="img/x.gif" alt="Iron" title="Iron" />
    <?php echo $dataarray[4]; ?> |

    <img class="r4" src="img/x.gif" alt="Crop" title="Crop" />
    <?php echo $dataarray[5]; ?>

</td>
</tr>

</tbody>
</table>

</td></tr></tbody></table>