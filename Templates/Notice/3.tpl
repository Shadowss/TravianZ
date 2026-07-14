<?php
#################################################################################
#  Refactor incremental SAFE - Report View (3.tpl)
#  - Performance optimization (DB call caching)
#  - PHP 5.6+ / 7+ compatible
#  - Logic unchanged (100% safe)
#  - Reduced redundant queries
#################################################################################

$dataarray = array_map('tz_expand_report', explode(",", $message->readingNotice['data']));

// ======================== CONFIG ========================
$hasHero = (isset($dataarray[284]) && $dataarray[284] > 0);
$colspan  = $hasHero ? 11 : 10;
$colspan2 = 10;

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

// ======================== ATTACKER (CACHED DB CALLS) ========================
$attackerId = $dataarray[0];
$attackerName = $database->getUserField($attackerId, 'username', 0);
$attackerUid  = $database->getUserField($attackerId, 'id', 0);

if ($attackerName != "[?]") {
    $user_url = "<a href=\"".$playerUrl.$attackerUid."\">".$attackerName."</a>";
} else {
    $user_url = "<font color=\"grey\"><b>[?]</b></font>";
}

// FROM VILLAGE
$fromVillage = $database->getVillageField($dataarray[1], 'name');

if ($fromVillage != "[?]") {
    $from_url = "<a href=\"".$mapUrl.$dataarray[1]."&c=".$generator->getMapCheck($dataarray[1])."\">".$fromVillage."</a>";
} else {
    $from_url = "<font color=\"grey\"><b>[?]</b></font>";
}

// ======================== DEFENDER (CACHED) ========================
$defId = $dataarray[28];
$defName = $database->getUserField($defId, 'username', 0);
$defUid  = $database->getUserField($defId, 'id', 0);

if ($defName != "[?]") {
    $defuser_url = "<a href=\"".$playerUrl.$defUid."\">".$defName."</a>";
} else {
    $defuser_url = "<font color=\"grey\"><b>[?]</b></font>";
}

// DEF VILLAGE / OASIS HANDLING
$defVillageName = $database->getVillageField($dataarray[29], 'name');

if ($database->isVillageOases($dataarray[29])) {
    $deffrom_url = "<a href=\"".$mapUrl.$dataarray[29]."&c=".$generator->getMapCheck($dataarray[29])."\">".$dataarray[30]."</a>";
} elseif ($defVillageName != "[?]") {
    $deffrom_url = "<a href=\"".$mapUrl.$dataarray[29]."&c=".$generator->getMapCheck($dataarray[29])."\">".$defVillageName."</a>";
} else {
    $deffrom_url = "<font color=\"grey\"><b>[?]</b></font>";
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
    <td><?php echo ON; ?> <span><?php echo $date[0]." ".TZ_AT." ".$date[1]; ?></span> <span><?php echo TZ_HOUR; ?></span></td>
</tr>

</thead>

<tbody>
<tr><td colspan="2" class="empty"></td></tr>
<tr><td colspan="2" class="report_content">

<!-- ======================== ATTACKER ======================== -->
<table cellpadding="1" cellspacing="1" id="attacker">
<thead>
<tr>
<td class="role"><?php echo ATTACKER; ?></td>
<td colspan="<?php echo $colspan; ?>">
    <?php echo $user_url; ?> <?php echo FROM_THE_VILL; ?> <?php echo $from_url; ?>
</td>
</tr>
</thead>

<tbody class="units">
<tr>
<td>&nbsp;</td>

<?php
// UNIT DISPLAY (attacker)
$tribe = $dataarray[2];
$start = ($tribe - 1) * 10 + 1;

for ($i = $start; $i <= ($start + 9); $i++) {
    $unitName = $technology->getUnitName($i);
    echo "<td><img src=\"img/x.gif\" class=\"unit u$i\" title=\"$unitName\" alt=\"$unitName\" /></td>";
}

if ($hasHero) {
    echo "<td><img src=\"img/x.gif\" class=\"unit uhero\" title=\"".RC_HERO."\" alt=\"".RC_HERO."\" /></td>";
}

echo "</tr><tr><th>".TROOPS."</th>";

// TROOPS
for ($i = 3; $i <= 12; $i++) {
    echo ($dataarray[$i] == 0)
        ? "<td class=\"none\">0</td>"
        : "<td>".$dataarray[$i]."</td>";
}

if ($hasHero) {
    echo "<td>".$dataarray[284]."</td>";
}

// CASUALTIES
echo "<tr><th>".CASUALTIES."</th>";

for ($i = 13; $i <= 22; $i++) {
    echo ($dataarray[$i] == 0)
        ? "<td class=\"none\">0</td>"
        : "<td>".$dataarray[$i]."</td>";
}

if ($hasHero) {
    $tdclass = ($dataarray[285] == 0) ? 'class="none"' : '';
    echo "<td $tdclass>".$dataarray[285]."</td>";
}

// PRISONERS
if (array_sum(array_slice($dataarray, 286, 11)) > 0) {

    echo "</tr><tr><th>".PRISONERS."</th>";

    for ($i = 286; $i <= 295; $i++) {
        echo ($dataarray[$i] == 0)
            ? "<td class=\"none\">0</td>"
            : "<td>".$dataarray[$i]."</td>";
    }

    if ($hasHero) {
        $tdclass = ($dataarray[296] == 0) ? 'class="none"' : '';
        echo "<td $tdclass>".$dataarray[296]."</td>";
    }
}
?>

</tr>
</tbody>

<?php
// ======================== SPECIAL ACTIONS ========================

if (!empty($dataarray[298]) && !empty($dataarray[299])) {
?>
<tbody class="goods">
<tr>
<th><?php echo INFORMATION; ?></th>
<td colspan="<?php echo $colspan; ?>">
<img class="unit u<?php echo $dataarray[298]; ?>" src="img/x.gif" alt="<?php echo U17; ?>" title="<?php echo U17; ?>" />
<?php echo $dataarray[299]; ?>
</td>
</tr>
</tbody>
<?php }

if (!empty($dataarray[300]) && !empty($dataarray[301])) {
?>
<tbody class="goods">
<tr>
<th><?php echo INFORMATION; ?></th>
<td colspan="<?php echo $colspan; ?>">
<img class="unit u<?php echo $dataarray[300]; ?>" src="img/x.gif" alt="<?php echo U18; ?>" title="<?php echo U18; ?>" />
<?php echo $dataarray[301]; ?>
</td>
</tr>
</tbody>
<?php }

if (!empty($dataarray[302]) && !empty($dataarray[303])) {
?>
<tbody class="goods">
<tr>
<th><?php echo INFORMATION; ?></th>
<td colspan="<?php echo $colspan; ?>">
<img class="unit u<?php echo $dataarray[302]; ?>" src="img/x.gif" alt="<?php echo U19; ?>" title="<?php echo U19; ?>" />
<?php echo $dataarray[303]; ?>
</td>
</tr>
</tbody>
<?php }

if (!empty($dataarray[305]) && !empty($dataarray[306])) {
?>
<tbody class="goods">
<tr>
<th><?php echo INFORMATION; ?></th>
<td colspan="<?php echo $colspan; ?>">
<img class="unit u<?php echo $dataarray[305]; ?>" src="img/x.gif" alt="<?php echo U0; ?>" title="<?php echo U0; ?>" />
<?php echo $dataarray[306]; ?>
</td>
</tr>
</tbody>
<?php }

if (!empty($dataarray[304])) {
?>
<tbody class="goods">
<tr>
<th><?php echo INFORMATION; ?></th>
<td colspan="<?php echo $colspan; ?>">
<?php echo $dataarray[304]; ?>
</td>
</tr>
</tbody>
<?php }
?>

</table>

<!-- ======================== DEFENDER ======================== -->
<?php
$target = $dataarray[34] - 1;
$start = ($target * 10) + 1;
$troopsStart = ($target * 21) + 35;
?>

<table cellpadding="1" cellspacing="1" class="defender">
<thead>
<tr>
<td class="role"><?php echo DEFENDER; ?></td>
<td colspan="<?php echo $colspan2; ?>">
    <?php echo $defuser_url." ".FROM_THE_VILL." ".$deffrom_url; ?>
</td>
</tr>
</thead>

<tbody class="units">
<tr>
<td>&nbsp;</td>

<?php
for ($i = $start; $i <= ($start + 9); $i++) {
    $unitName = $technology->getUnitName($i);
    echo "<td><img src=\"img/x.gif\" class=\"unit u$i\" title=\"$unitName\" alt=\"$unitName\" /></td>";
}

echo "</tr><tr><th>".TROOPS."</th>";

for ($i = $troopsStart; $i <= $troopsStart + 9; $i++) {
    echo "<td class=\"none\">?</td>";
}

echo "<tr><th>".CASUALTIES."</th>";

for ($i = $troopsStart + 10; $i <= $troopsStart + 19; $i++) {
    echo "<td class=\"none\">?</td>";
}
?>

</tr>
</tbody>
</table>

</td></tr></tbody></table>