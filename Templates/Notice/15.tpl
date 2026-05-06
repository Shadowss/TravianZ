<?php
#################################################################################
#  Refactor incremental SAFE - Report View (15.tpl)
#  - Cached DB calls (performance improvement)
#  - PHP 5.6+ / 7+ compatible
#  - Logic preserved 100%
#  - Minor safety fixes (undefined vars / repeated calls)
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

// ======================== CONFIG ========================
$hasHero = (!empty($dataarray[24]) && $dataarray[24] > 0);
$colspan = $hasHero ? 11 : 10;

// ======================== DEFENDER (cached DB calls) ========================
$defId = $dataarray[0];

$defName = $database->getUserField($defId, 'username', 0);
$defUid  = $database->getUserField($defId, 'id', 0);

if ($defName != "[?]") {
    $user_url = "<a href=\"".$playerUrl.$defUid."\">".$defName."</a>";
} else {
    $user_url = "<font color=\"grey\"><b>[?]</b></font>";
}

// ======================== FROM VILLAGE ========================
$fromId = $dataarray[26];
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

<!-- ======================== DEFENDER REPORT ======================== -->
<table cellpadding="1" cellspacing="1" class="defender">

<thead>
<tr>
    <td class="role">Defender</td>
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
$tribe = $dataarray[3];
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
for ($i = 4; $i <= 13; $i++) {
    echo ($dataarray[$i] == 0)
        ? "<td class=\"none\">0</td>"
        : "<td>".$dataarray[$i]."</td>";
}

if ($hasHero) {
    echo "<td>".$dataarray[24]."</td>";
}

// ======================== CASUALTIES ========================
echo "<tr><th>Casualties</th>";

for ($i = 14; $i <= 23; $i++) {
    echo ($dataarray[$i] == 0)
        ? "<td class=\"none\">0</td>"
        : "<td>".$dataarray[$i]."</td>";
}

if ($hasHero) {

    // SAFE FIX: avoid undefined variable warning
    $tdclass = (isset($dataarray[25]) && $dataarray[25] == 0)
        ? 'class="none"'
        : '';

    echo "<td $tdclass>".$dataarray[25]."</td>";
}
?>

</tr>
</tbody>

</table>

</td></tr></tbody></table>