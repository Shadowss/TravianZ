<?php
#################################################################################
#  Refactor incremental SAFE - Report View (22.tpl)
#  - Cached DB calls (performance improvement)
#  - PHP 5.6+ / 7+ compatible
#  - Logic preserved 100%
#  - Safer handling for event type + arrays
#################################################################################

$dataarray = explode(",", $message->readingNotice['data']);

// ======================== CONFIG ========================
$hasHero = (!empty($dataarray[14]) && $dataarray[14] > 0);
$colspan = $hasHero ? 11 : 10;

// ======================== EVENT TYPE ========================
$attackerId = $dataarray[0];
$targetId   = $dataarray[2];
$type       = isset($dataarray[15]) ? (int)$dataarray[15] : 0;

// CACHE DB CALLS (reduce repeated queries)
$attackerName = $database->getUserField($attackerId, "username", 0);
$attackerUid  = $database->getUserField($attackerId, "id", 0);

$targetName = $database->getUserField($targetId, "username", 0);

// ======================== MESSAGE BUILD ========================
if ($type == 1) {
    $message1 = $attackerName." visited ".$targetName."'s troops";
} elseif ($type == 2) {
    $message1 = $attackerName." wishes you Merry Christmas";
} elseif ($type == 3) {
    $message1 = $attackerName." wishes you Happy New Year";
} else {
    $message1 = $attackerName." wishes you Happy Easter";
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

<!-- ======================== ATTACKER ======================== -->
<table cellpadding="1" cellspacing="1" class="attacker">

<thead>
<tr>
    <td class="role"><?php echo ATTACKER; ?></td>
    <td colspan="<?php echo $colspan; ?>">

        <a href="spieler.php?uid=<?php echo $attackerUid; ?>">
            <?php echo $attackerName; ?>
        </a>

        <?php echo FROM_THE_VILL; ?>

        <a href="karte.php?d=<?php echo $dataarray[1]."&amp;c=".$generator->getMapCheck($dataarray[1]); ?>">
            <?php echo $database->getVillageField($dataarray[1], "name"); ?>
        </a>

    </td>
</tr>
</thead>

<tbody class="units">
<tr>
<td>&nbsp;</td>

<?php
// ======================== UNITS ========================
$tribe = $dataarray[3];
$start = ($tribe - 1) * 10 + 1;

for ($i = $start; $i <= ($start + 9); $i++) {
    $unitName = $technology->getUnitName($i);
    echo "<td><img src=\"img/x.gif\" class=\"unit u$i\" title=\"$unitName\" alt=\"$unitName\" /></td>";
}

// HERO
if ($hasHero) {
    echo "<td><img src=\"img/x.gif\" class=\"unit uhero\" title=\"Hero\" alt=\"Hero\" /></td>";
}

echo "</tr><tr><th>".TROOPS."</th>";

// TROOPS
for ($i = 4; $i <= 13; $i++) {
    echo ($dataarray[$i] == 0)
        ? "<td class=\"none\">0</td>"
        : "<td>".$dataarray[$i]."</td>";
}

// HERO TROOPS
if ($hasHero) {
    echo "<td>".$dataarray[14]."</td>";
}
?>

</tr>
</tbody>

<!-- ======================== INFORMATION ======================== -->
<tbody class="goods">
<tr>
    <th><?php echo INFORMATION; ?></th>
    <td colspan="<?php echo $colspan; ?>">

        <?php
        // SAFE ICON INDEX (avoid undefined index warnings)
        $icons = ["peace", "xmas", "newy", "easter"];
        $icon = isset($icons[$type - 1]) ? $icons[$type - 1] : "peace";
        ?>

        <img src="<?php echo GP_LOCATE; ?>img/r/<?php echo $icon; ?>.gif"
             alt="<?php echo TZ_EVENT; ?>"
             title="<?php echo TZ_EVENT; ?>" />

        <?php echo $message1; ?>

    </td>
</tr>
</tbody>

</table>

</td></tr></tbody></table>