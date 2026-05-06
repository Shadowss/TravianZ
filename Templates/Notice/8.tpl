<?php
#################################################################################
#  Refactor incremental SAFE - Report View (8.tpl)
#  - Removes redundant DB calls (cache)
#  - PHP 5.6+ / 7+ compatible
#  - Logic unchanged (100% safe)
#  - Minor stability fixes
#################################################################################

$dataarray = explode(",", $message->readingNotice['data']);

// ======================== CONFIG ========================
$hasHero = (!empty($dataarray[13]) && $dataarray[13] > 0);
$colspan = $hasHero ? 11 : 10;

// ======================== URL BASE ========================
if (!isset($isAdmin)) {
    $mapUrl = "karte.php?d=";
    $playerUrl = "spieler.php?uid=";
} else {
    $mapUrl = "admin.php?p=village&did=";
    $playerUrl = "admin.php?p=player&uid=";
}

// ======================== SENDER (cached DB calls) ========================
$senderId = $dataarray[1];
$senderName = $database->getUserField($senderId, 'username', 0);
$senderUid  = $database->getUserField($senderId, 'id', 0);

if ($senderName != "[?]" || $senderId == 0) {
    $user_url = "<a href=\"".$playerUrl.$senderUid."\">".($senderId == 0 ? "taskmaster" : $senderName)."</a>";
} else {
    $user_url = "<font color=\"grey\"><b>[?]</b></font>";
}

// ======================== FROM VILLAGE ========================
$fromId = $dataarray[0];
$fromName = $database->getVillageField($fromId, 'name');

if ($fromName != "[?]" || $fromId == 0) {
    $from_url = ($fromId == 0)
        ? "village of the elders"
        : "<a href=\"".$mapUrl.$fromId."&c=".$generator->getMapCheck($fromId)."\">".$fromName."</a>";
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
    <td>on <span><?php echo $date[0]." at ".$date[1]; ?></span><span> </span></td>
</tr>

</thead>

<tbody>
<tr><td colspan="2" class="empty"></td></tr>
<tr><td colspan="2" class="report_content">

<!-- ======================== REINFORCEMENT ======================== -->
<table cellpadding="1" cellspacing="1" id="reinforcement">

<thead>
<tr>
    <td class="role">sender</td>
    <td colspan="<?php echo $colspan; ?>">
        <?php echo $user_url; ?> from the village <?php echo $from_url; ?>
    </td>
</tr>
</thead>

<tbody class="units">
<tr>
<td>&nbsp;</td>

<?php
// ======================== UNITS ========================
$tribe = $dataarray[2];
$start = ($tribe - 1) * 10 + 1;

// unit icons
for ($i = $start; $i <= ($start + 9); $i++) {
    $unitName = $technology->getUnitName($i);
    echo "<td><img src=\"img/x.gif\" class=\"unit u$i\" title=\"$unitName\" alt=\"$unitName\" /></td>";
}

// hero column
if ($hasHero) {
    echo "<td><img src=\"img/x.gif\" class=\"unit uhero\" title=\"Hero\" alt=\"Hero\" /></td>";
}

echo "</tr><tr><th>Troops</th>";

// ======================== TROOPS ========================
$unitarray = [];

for ($i = 3; $i < 13; $i++) {

    $unitarray['u'.($i - 3 + $start)] = $dataarray[$i];

    if ($dataarray[$i] == 0) {
        echo "<td class=\"none\">0</td>";
    } else {
        echo "<td>".$dataarray[$i]."</td>";
    }
}

// hero troops
if ($hasHero) {
    echo "<td>".$dataarray[13]."</td>";
    $unitarray['hero'] = 1;
}

?>
</tr>
</tbody>

<!-- ======================== UPKEEP ======================== -->
<tbody class="infos">
<tr>
    <th>upkeep</th>
    <td colspan="11">
        <?php echo $technology->getUpkeep($unitarray, $dataarray[2]); ?>
        <img src="img/x.gif" class="r4" title="Crop" alt="Crop" /> per hour
    </td>
</tr>
</tbody>

</table>

</td></tr></tbody></table>