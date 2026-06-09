<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ      					       		 		  	   ##
##  Version:       01.09.2013 						       	 				   ##
##  Filename       general.tpl                                                 ##
##  Refactored by  Shadow					                                   ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2013. All rights reserved.                ##
##  URLs:          http://travian.shadowss.ro 				       	 		   ##
##  Source code:   http://github.com/Shadowss/TravianZ/         	       	   ##
##                                                                             ##
#################################################################################

// =========================
// TRIBES COUNT (optimized)
// =========================
$tribesRes = mysqli_query(
    $database->dblink,
    "SELECT tribe, COUNT(*) AS Total 
     FROM ".TB_PREFIX."users 
     WHERE tribe BETWEEN 1 AND 3 
     GROUP BY tribe"
);

$tribes = [0, 0, 0];

if ($tribesRes) {
    while ($row = mysqli_fetch_assoc($tribesRes)) {
        $tribeId = (int)$row['tribe'] - 1;
        if (isset($tribes[$tribeId])) {
            $tribes[$tribeId] = (int)$row['Total'];
        }
    }
}

// total users
$userRes = mysqli_query(
    $database->dblink,
    "SELECT COUNT(*) AS Total 
     FROM ".TB_PREFIX."users 
     WHERE tribe BETWEEN 1 AND 3"
);

$users = ($userRes) ? (int)mysqli_fetch_assoc($userRes)['Total'] : 0;


// =========================
// VILLAGES + POPULATION
// =========================
$villageRes = mysqli_query($database->dblink, "SELECT COUNT(*) AS Total FROM ".TB_PREFIX."vdata");
$num_villages = ($villageRes) ? (int)mysqli_fetch_assoc($villageRes)['Total'] : 0;

$popRes = mysqli_query($database->dblink, "SELECT SUM(pop) AS totalpop FROM ".TB_PREFIX."vdata");
$total_pop = ($popRes) ? (int)mysqli_fetch_assoc($popRes)['totalpop'] : 0;


// =========================
// ONLINE / ACTIVE USERS
// =========================
$activeRes = mysqli_query(
    $database->dblink,
    "SELECT COUNT(*) AS Total 
     FROM ".TB_PREFIX."users 
     WHERE timestamp > ".(time() - 86400)." 
     AND tribe BETWEEN 1 AND 3"
);
$active = ($activeRes) ? (int)mysqli_fetch_assoc($activeRes)['Total'] : 0;

$onlineRes = mysqli_query(
    $database->dblink,
    "SELECT COUNT(*) AS Total 
     FROM ".TB_PREFIX."users 
     WHERE timestamp > ".(time() - 600)." 
     AND tribe BETWEEN 1 AND 3"
);
$online = ($onlineRes) ? (int)mysqli_fetch_assoc($onlineRes)['Total'] : 0;


// =========================
// GOLD TOTAL
// =========================
$goldRes = mysqli_query($database->dblink, "SELECT SUM(gold) AS totalgold FROM ".TB_PREFIX."users");
$total_gold = ($goldRes) ? (int)mysqli_fetch_assoc($goldRes)['totalgold'] : 0;
?>

<!-- ================= WORLD STATS ================= -->
<table cellpadding="1" cellspacing="1" id="world_player" class="world">
<thead>
<tr><th colspan="2"><?php echo TZ_WORLD_STATS; ?></th></tr>
<tr><td><?php echo TZ_TOTAL_VILLAGES; ?></td><td><?php echo TZ_TOTAL_POPULATION; ?></td></tr>
</thead>
<tbody>
<tr>
<td><?= $num_villages ?></td>
<td><?= $total_pop ?></td>
</tr>
</tbody>
</table>

<br />

<!-- ================= PLAYERS ================= -->
<table cellpadding="1" cellspacing="1" class="world">
<thead>
<tr><th colspan="2"><?php echo PLAYERS; ?></th></tr>
</thead>
<tbody>
<tr><th><?php echo TZ_REGISTERED_PLAYERS; ?></th><td><?= $users ?></td></tr>
<tr><th><?php echo ACTIVE_PLAYERS; ?></th><td><?= $active ?></td></tr>
<tr><th>Players online</th><td><?= $online ?></td></tr>
</tbody>
</table>
<br />
<!-- ================= TRIBES ================= -->
<table cellpadding="1" cellspacing="1" class="world">
<thead>
<tr><th colspan="3"><?php echo TZ_TRIBES; ?></th></tr>
<tr><td><?php echo TRIBE; ?></td><td><?php echo TZ_REGISTERED; ?></td><td><?php echo PERCENT; ?></td></tr>
</thead>
<tbody>

<?php
$roman = $tribes[0];
$teuton = $tribes[1];
$gaul = $tribes[2];

$romanPct = ($users > 0) ? round(100 * $roman / $users, 2) : 0;
$teutonPct = ($users > 0) ? round(100 * $teuton / $users, 2) : 0;
$gaulPct = ($users > 0) ? round(100 - $romanPct - $teutonPct, 2) : 0;
?>

<tr><td><?php echo TRIBE1; ?></td><td><?= $roman ?></td><td><?= $users ? $romanPct.'%' : '---' ?></td></tr>
<tr><td><?php echo TRIBE2; ?></td><td><?= $teuton ?></td><td><?= $users ? $teutonPct.'%' : '---' ?></td></tr>
<tr><td><?php echo TRIBE3; ?></td><td><?= $gaul ?></td><td><?= $users ? $gaulPct.'%' : '---' ?></td></tr>

</tbody>
</table>
<br />
<!-- ================= GOLD ================= -->
<table cellpadding="1" cellspacing="1" class="world">
<thead>
<tr>
<th colspan="2">
Total <?= SERVER_NAME ?> <img src="./<?= GP_LOCATE ?>img/a/gold.gif">
Gold
</th>
</tr>
</thead>
<tbody>
<tr>
<td><?php echo GOLD; ?></td>
<td><?= $total_gold ?></td>
</tr>
</tbody>
</table>
<br />

<!-- ================= TROOPS ================= -->
<table cellpadding="1" cellspacing="1" class="world">
<thead>
<tr>
    <th colspan="6"><?php echo TROOPS; ?></th>
</tr>
<tr>
    <td><img src="img/romenai.png"></td><td><?php echo TZ_TOTAL; ?></td>
    <td><img src="img/germanai.png"></td><td><?php echo TZ_TOTAL; ?></td>
    <td><img src="img/galai.png"></td><td><?php echo TZ_TOTAL; ?></td>
</tr>
</thead>

<tbody>

<?php
// preload all troop sums once
$units = array();

$result = mysqli_query($database->dblink, "
    SELECT 
        SUM(u1) AS u1,
        SUM(u2) AS u2,
        SUM(u3) AS u3,
        SUM(u4) AS u4,
        SUM(u5) AS u5,
        SUM(u6) AS u6,
        SUM(u7) AS u7,
        SUM(u8) AS u8,
        SUM(u9) AS u9,
        SUM(u10) AS u10,

        SUM(u11) AS u11,
        SUM(u12) AS u12,
        SUM(u13) AS u13,
        SUM(u14) AS u14,
        SUM(u15) AS u15,
        SUM(u16) AS u16,
        SUM(u17) AS u17,
        SUM(u18) AS u18,
        SUM(u19) AS u19,
        SUM(u20) AS u20,

        SUM(u21) AS u21,
        SUM(u22) AS u22,
        SUM(u23) AS u23,
        SUM(u24) AS u24,
        SUM(u25) AS u25,
        SUM(u26) AS u26,
        SUM(u27) AS u27,
        SUM(u28) AS u28,
        SUM(u29) AS u29,
        SUM(u30) AS u30

    FROM ".TB_PREFIX."units
");

if ($result) {
    $units = mysqli_fetch_assoc($result);
}

// helper safe output
function u($units, $key) {
    return isset($units[$key]) ? (int)$units[$key] : 0;
}
?>

<!-- ROW 1 -->
<tr>
    <td><img src="img/x.gif" class="unit u1"></td>
    <td><?= u($units, 'u1') ?></td>

    <td><img src="img/x.gif" class="unit u11"></td>
    <td><?= u($units, 'u11') ?></td>

    <td><img src="img/x.gif" class="unit u21"></td>
    <td><?= u($units, 'u21') ?></td>
</tr>

<!-- ROW 2 -->
<tr>
    <td><img src="img/x.gif" class="unit u2"></td>
    <td><?= u($units, 'u2') ?></td>

    <td><img src="img/x.gif" class="unit u12"></td>
    <td><?= u($units, 'u12') ?></td>

    <td><img src="img/x.gif" class="unit u22"></td>
    <td><?= u($units, 'u22') ?></td>
</tr>

<!-- ROW 3 -->
<tr>
    <td><img src="img/x.gif" class="unit u3"></td>
    <td><?= u($units, 'u3') ?></td>

    <td><img src="img/x.gif" class="unit u13"></td>
    <td><?= u($units, 'u13') ?></td>

    <td><img src="img/x.gif" class="unit u23"></td>
    <td><?= u($units, 'u23') ?></td>
</tr>

<!-- ROW 4 -->
<tr>
    <td><img src="img/x.gif" class="unit u4"></td>
    <td><?= u($units, 'u4') ?></td>

    <td><img src="img/x.gif" class="unit u14"></td>
    <td><?= u($units, 'u14') ?></td>

    <td><img src="img/x.gif" class="unit u24"></td>
    <td><?= u($units, 'u24') ?></td>
</tr>

<!-- ROW 5 -->
<tr>
    <td><img src="img/x.gif" class="unit u5"></td>
    <td><?= u($units, 'u5') ?></td>

    <td><img src="img/x.gif" class="unit u15"></td>
    <td><?= u($units, 'u15') ?></td>

    <td><img src="img/x.gif" class="unit u25"></td>
    <td><?= u($units, 'u25') ?></td>
</tr>

<!-- ROW 6 -->
<tr>
    <td><img src="img/x.gif" class="unit u6"></td>
    <td><?= u($units, 'u6') ?></td>

    <td><img src="img/x.gif" class="unit u16"></td>
    <td><?= u($units, 'u16') ?></td>

    <td><img src="img/x.gif" class="unit u26"></td>
    <td><?= u($units, 'u26') ?></td>
</tr>

<!-- ROW 7 -->
<tr>
    <td><img src="img/x.gif" class="unit u7"></td>
    <td><?= u($units, 'u7') ?></td>

    <td><img src="img/x.gif" class="unit u17"></td>
    <td><?= u($units, 'u17') ?></td>

    <td><img src="img/x.gif" class="unit u27"></td>
    <td><?= u($units, 'u27') ?></td>
</tr>

<!-- ROW 8 -->
<tr>
    <td><img src="img/x.gif" class="unit u8"></td>
    <td><?= u($units, 'u8') ?></td>

    <td><img src="img/x.gif" class="unit u18"></td>
    <td><?= u($units, 'u18') ?></td>

    <td><img src="img/x.gif" class="unit u28"></td>
    <td><?= u($units, 'u28') ?></td>
</tr>

<!-- ROW 9 -->
<tr>
    <td><img src="img/x.gif" class="unit u9"></td>
    <td><?= u($units, 'u9') ?></td>

    <td><img src="img/x.gif" class="unit u19"></td>
    <td><?= u($units, 'u19') ?></td>

    <td><img src="img/x.gif" class="unit u29"></td>
    <td><?= u($units, 'u29') ?></td>
</tr>

<!-- ROW 10 -->
<tr>
    <td><img src="img/x.gif" class="unit u10"></td>
    <td><?= u($units, 'u10') ?></td>

    <td><img src="img/x.gif" class="unit u20"></td>
    <td><?= u($units, 'u20') ?></td>

    <td><img src="img/x.gif" class="unit u30"></td>
    <td><?= u($units, 'u30') ?></td>
</tr>

</tbody>
</table>

<br />
<!-- ================= MISC ================= -->
<table cellpadding="1" cellspacing="1" class="world">
<thead>
<tr><th colspan="3"><?php echo TZ_MISCELLANEOUS; ?></th></tr>
<tr><td><?php echo TZ_ATTACKS; ?></td><td><?php echo CASUALTIES; ?></td><td><?php echo DATE; ?></td></tr>
</thead>
<tbody>

<?php for($d=0;$d<=6;$d++): ?>
<tr>
<td><?= $database->getAttackByDate(time()-(86400*$d)) ?></td>
<td><?= $database->getAttackCasualties(time()-(86400*$d)) ?></td>
<td><?= date("j. M", time()-(86400*$d)) ?></td>
</tr>
<?php endfor; ?>
</tbody>
</table>
<?php  ?>  
<table cellpadding="1" cellspacing="1" id="search_navi"> <?php //fix the problem with footer.php, don't change or remove it ?>
