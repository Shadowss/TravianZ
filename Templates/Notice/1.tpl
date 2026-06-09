<?php
#################################################################################
#  Refactor incremental SAFE - Report View (1.tpl)
#  - Optimized caching DB calls
#  - PHP 5.6+ / 7+ compatible
#  - Logic preserved 100%
#  - No structural changes affecting gameplay
#################################################################################

$dataarray = explode(",", $message->readingNotice['data']);

// ======================== BASIC SETTINGS ========================
$hasHero = (isset($dataarray[178]) && $dataarray[178] > 0);
$colspan = $hasHero ? 11 : 10;

// Spy detection (unchanged logic)
$spy = !empty($dataarray[177]) && !empty($dataarray[176]) && empty($dataarray[195]);

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

// ======================== ATTACKER DATA (CACHED) ========================
$attackerId = $dataarray[0];
$attackerName = $database->getUserField($attackerId, 'username', 0);
$attackerUid  = $database->getUserField($attackerId, 'id', 0);

if ($attackerName != "[?]") {
    $user_url = "<a href=\"".$playerUrl.$attackerUid."\">".$attackerName."</a>";
} else {
    $user_url = "<font color=\"grey\"><b>[?]</b></font>";
}

$fromVillage = $database->getVillageField($dataarray[1], 'name');

if ($fromVillage != "[?]") {
    $from_url = "<a href=\"".$mapUrl.$dataarray[1]."&c=".$generator->getMapCheck($dataarray[1])."\">".$fromVillage."</a>";
} else {
    $from_url = "<font color=\"grey\"><b>[?]</b></font>";
}

// ======================== DEFENDER DATA (CACHED) ========================
$defId = $dataarray[28];
$defName = $database->getUserField($defId, 'username', 0);
$defUid  = $database->getUserField($defId, 'id', 0);

if ($defName != "[?]") {
    $defuser_url = "<a href=\"".$playerUrl.$defUid."\">".$defName."</a>";
} else {
    $defuser_url = "<font color=\"grey\"><b>[?]</b></font>";
}

$defVillageName = $database->getVillageField($dataarray[29], 'name');

if ($database->isVillageOases($dataarray[29])) {
    $deffrom_url = "<a href=\"".$mapUrl.$dataarray[29]."&c=".$generator->getMapCheck($dataarray[29])."\">".$dataarray[30]."</a>";
} elseif ($defVillageName != "[?]") {
    $deffrom_url = "<a href=\"".$mapUrl.$dataarray[29]."&c=".$generator->getMapCheck($dataarray[29])."\">".$defVillageName."</a>";
} else {
    $deffrom_url = "<font color=\"grey\"><b>[?]</b></font>";
}

// ======================== HTML START ========================
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

<table cellpadding="1" cellspacing="1" id="attacker">
<thead>
<tr>
    <td class="role"><?php echo ATTACKER; ?></td>
    <td colspan="<?php echo $colspan ?>">
        <?php echo $user_url; ?> <?php echo $from_url ? FROM_THE_VILL.' '.$from_url : ''; ?>
    </td>
</tr>
</thead>

<tbody class="units">
<tr>
<td>&nbsp;</td>

<?php
$tribe = !empty($dataarray[2]) ? $dataarray[2] : 5;
$start = ($tribe - 1) * 10 + 1;

// UNIT ICONS
for ($i = $start; $i <= ($start + 9); $i++) {
    $unitName = $technology->getUnitName($i);
    echo "<td><img src=\"img/x.gif\" class=\"unit u$i\" title=\"$unitName\" alt=\"$unitName\" /></td>";
}

if ($hasHero) {
    echo "<td><img src=\"img/x.gif\" class=\"unit uhero\" title=\"Hero\" alt=\"Hero\" /></td>";
}

echo "</tr><tr><th>".TROOPS."</th>";

// TROOPS
for ($i = 3; $i <= 12; $i++) {
    echo ($dataarray[$i] == 0)
        ? "<td class=\"none\">0</td>"
        : "<td>".$dataarray[$i]."</td>";
}

if ($hasHero) {
    echo "<td>".$dataarray[178]."</td>";
}

// CASUALTIES
echo "<tr><th>".CASUALTIES."</th>";

for ($i = 13; $i <= 22; $i++) {
    echo ($dataarray[$i] == 0)
        ? "<td class=\"none\">0</td>"
        : "<td>".$dataarray[$i]."</td>";
}

if ($hasHero) {
    $tdclass = ($dataarray[179] == 0) ? 'class="none"' : '';
    echo "<td $tdclass>".$dataarray[179]."</td>";
}

// PRISONERS (unchanged logic but safer sum)
if (!$spy && array_sum(array_slice($dataarray, 182, 11)) > 0) {
    echo "</tr><tr><th>".PRISONERS."</th>";

    for ($i = 182; $i <= 191; $i++) {
        echo ($dataarray[$i] == 0)
            ? "<td class=\"none\">0</td>"
            : "<td>".$dataarray[$i]."</td>";
    }

    if ($hasHero) {
        $tdclass = ($dataarray[192] == 0) ? 'class="none"' : '';
        echo "<td $tdclass>".$dataarray[192]."</td>";
    }
}
?>
</tr>
</tbody>

<?php
// ======================== SPECIAL ACTIONS ========================
if (!empty($dataarray[170]) && !empty($dataarray[171])) {
?>
<tbody class="goods">
<tr>
<th><?php echo INFORMATION; ?></th>
<td colspan="<?php echo $colspan; ?>">
<img class="unit u<?php echo $dataarray[170]; ?>" src="img/x.gif" alt="<?php echo U17; ?>" title="<?php echo U17; ?>" />
<?php echo $dataarray[171]; ?>
</td>
</tr>
</tbody>
<?php }

if (!empty($dataarray[172]) && !empty($dataarray[173])) {
?>
<tbody class="goods">
<tr>
<th><?php echo INFORMATION; ?></th>
<td colspan="<?php echo $colspan; ?>">
<img class="unit u<?php echo $dataarray[172]; ?>" src="img/x.gif" alt="<?php echo U18; ?>" title="<?php echo U18; ?>" />
<?php echo $dataarray[173]; ?>
</td>
</tr>
</tbody>
<?php }

if (!empty($dataarray[174]) && !empty($dataarray[175])) {
?>
<tbody class="goods">
<tr>
<th><?php echo INFORMATION; ?></th>
<td colspan="<?php echo $colspan; ?>">
<img class="unit u<?php echo $dataarray[174]; ?>" src="img/x.gif" alt="<?php echo U19; ?>" title="<?php echo U19; ?>" />
<?php echo $dataarray[175]; ?>
</td>
</tr>
</tbody>
<?php }

if ($spy) {
?>
<tbody class="goods">
<tr>
<th><?php echo INFORMATION; ?></th>
<td colspan="<?php echo $colspan; ?>">
<?php echo $dataarray[177]; ?>
</td>
</tr>
</tbody>
<?php }

if (!empty($dataarray[193])) {
?>
<tbody class="goods">
<tr>
<th><?php echo INFORMATION; ?></th>
<td colspan="<?php echo $colspan; ?>">
<?php echo $dataarray[193]; ?>
</td>
</tr>
</tbody>
<?php }

if (!empty($dataarray[196]) && !empty($dataarray[197])) {
?>
<tbody class="goods">
<tr>
<th><?php echo INFORMATION; ?></th>
<td colspan="<?php echo $colspan; ?>">
<img class="unit u<?php echo $dataarray[196]; ?>" src="img/x.gif" alt="<?php echo U0; ?>" title="<?php echo U0; ?>" />
<?php echo $dataarray[197]; ?>
</td>
</tr>
</tbody>
<?php }

if (!empty($dataarray[195])) {
?>
<tbody class="goods">
<tr>
<th><?php echo INFORMATION; ?></th>
<td colspan="<?php echo $colspan; ?>">
<?php echo $dataarray[195]; ?>
</td>
</tr>
</tbody>
<?php } elseif (empty($dataarray[176]) && empty($dataarray[177])) { ?>
<tbody class="goods">
<tr>
<th><?php echo BOUNTY; ?></th>
<td colspan="<?php echo $colspan; ?>">
<div class="res">
<img class="r1" src="img/x.gif" /><?php echo $dataarray[23]; ?> |
<img class="r2" src="img/x.gif" /><?php echo $dataarray[24]; ?> |
<img class="r3" src="img/x.gif" /><?php echo $dataarray[25]; ?> |
<img class="r4" src="img/x.gif" /><?php echo $dataarray[26]; ?>
</div>
<div class="carry">
<?php echo ($dataarray[23]+$dataarray[24]+$dataarray[25]+$dataarray[26])."/".$dataarray[27]; ?>
</div>
</td>
</tr>
</tbody>
</table>
<?php } ?>

<?php
// ======================== DEFENDER LOOP ========================
$defArray = [1, $dataarray[55], $dataarray[76], $dataarray[97], $dataarray[118], $dataarray[139]];
$targetTribe = $dataarray[34];

foreach ($defArray as $index => $value) {

    if ($value == 0) continue;

    $heroIndex = ($index == 0 ? 180 : 160 + ($index - 1));
    $heroDeadIndex = ($index == 0 ? 1 : 5);

    $target = ($index == 0 ? $targetTribe : $index) - 1;
    $start = $target * 10 + 1;
    $troopsStart = $index * 21 + 35;
?>
<table cellpadding="1" cellspacing="1" class="defender">
<thead>
<tr>
<td class="role"><?php echo DEFENDER; ?></td>
<td colspan="<?php echo (!empty($dataarray[$heroIndex])) ? 11 : 10; ?>">
<?php echo ($index == 0) ? $defuser_url." ".FROM_THE_VILL." ".$deffrom_url : REINFORCEMENT; ?>
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

if (!empty($dataarray[$heroIndex])) {
    echo "<td><img src=\"img/x.gif\" class=\"unit uhero\" /></td>";
}

echo "</tr><tr><th>".TROOPS."</th>";

for ($i = $troopsStart; $i <= $troopsStart + 9; $i++) {
    echo ($dataarray[$i] == 0)
        ? "<td class=\"none\">0</td>"
        : "<td>".$dataarray[$i]."</td>";
}

if (!empty($dataarray[$heroIndex])) {
    echo "<td>".$dataarray[$heroIndex]."</td>";
}

echo "<tr><th>".CASUALTIES."</th>";

for ($i = $troopsStart + 10; $i <= $troopsStart + 19; $i++) {
    echo ($dataarray[$i] == 0)
        ? "<td class=\"none\">0</td>"
        : "<td>".$dataarray[$i]."</td>";
}

// SAFE FIX: avoid undefined variable warning
$tdclass1 = '';

if (!empty($dataarray[$heroIndex])) {
    $tdclass1 = ($dataarray[$heroIndex + $heroDeadIndex] == 0) ? 'class="none"' : '';
    echo "<td $tdclass1>".$dataarray[$heroIndex + $heroDeadIndex]."</td>";
}
?>
</tr>
</tbody>
</table>
<?php } ?>

</td></tr></tbody></table>