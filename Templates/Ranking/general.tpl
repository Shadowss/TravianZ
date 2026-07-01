<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ      					       		 		  	   ##
##  Version:       22.06.2026 						       	 				   ##
##  Filename       general.tpl                                                 ##
##  Refactored by  Shadow					                                   ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2026. All rights reserved.                ##
##  URLs:          http://travianz.org	     				       	 		   ##
##  Source code:   http://github.com/Shadowss/TravianZ/         	       	   ##
##                                                                             ##
#################################################################################

mysqli_report(MYSQLI_REPORT_OFF);

// =========================
// TRIBES COUNT
// =========================
$tribesRes = mysqli_query($database->dblink,
    "SELECT tribe, COUNT(*) AS Total FROM ".TB_PREFIX."users WHERE tribe BETWEEN 1 AND 3 GROUP BY tribe");
$tribes = [0, 0, 0];
if ($tribesRes) {
    while ($row = mysqli_fetch_assoc($tribesRes)) {
        $tribes[(int)$row['tribe']-1] = (int)$row['Total'];
    }
}

$userRes = mysqli_query($database->dblink,
    "SELECT COUNT(*) AS Total FROM ".TB_PREFIX."users WHERE tribe BETWEEN 1 AND 3");
$users = $userRes? (int)mysqli_fetch_assoc($userRes)['Total'] : 0;

// =========================
// VILLAGES + POPULATION
// =========================
$villageRes = mysqli_query($database->dblink, "SELECT COUNT(*) AS Total FROM ".TB_PREFIX."vdata");
$num_villages = $villageRes? (int)mysqli_fetch_assoc($villageRes)['Total'] : 0;

$popRes = mysqli_query($database->dblink, "SELECT SUM(pop) AS totalpop FROM ".TB_PREFIX."vdata");
$total_pop = $popRes? (int)mysqli_fetch_assoc($popRes)['totalpop'] : 0;

// =========================
// ONLINE / ACTIVE USERS
// =========================
$active = 0; 
$res = mysqli_query($database->dblink,
    "SELECT COUNT(*) AS Total FROM ".TB_PREFIX."users WHERE timestamp > ".(time()-86400)." AND tribe BETWEEN 1 AND 3");
if($res) 
	$active = (int)mysqli_fetch_assoc($res)['Total'];

$online = 0; 
$res = mysqli_query($database->dblink,
    "SELECT COUNT(*) AS Total FROM ".TB_PREFIX."users WHERE timestamp > ".(time()-600)." AND tribe BETWEEN 1 AND 3");
if($res) $online = (int)mysqli_fetch_assoc($res)['Total'];

// =========================
// GOLD TOTAL
// =========================
$goldRes = mysqli_query($database->dblink, "SELECT SUM(gold) AS totalgold FROM ".TB_PREFIX."users");
$total_gold = $goldRes? (int)mysqli_fetch_assoc($goldRes)['totalgold'] : 0;

// =========================
// 2026 - NEW STATISTICS
// =========================
$daysSinceStart = defined('COMMENCE')? floor((time()-COMMENCE)/86400) : 0;

// Natars
$natars = 0; 
$q = mysqli_query($database->dblink, "SELECT COUNT(*) AS n FROM ".TB_PREFIX."vdata WHERE natar=1");
if($q) 
	$natars = (int)mysqli_fetch_assoc($q)['n'];

// Occupied Oasis
$oasis = 0;
$q = mysqli_query($database->dblink,
    "SELECT COUNT(*) AS o 
     FROM ".TB_PREFIX."odata 
     WHERE owner <> 2 AND owner <> 0 AND owner IS NOT NULL");
if($q) $oasis = (int)mysqli_fetch_assoc($q)['o'];

// Alliances
$alliCount = 0; 
$q = mysqli_query($database->dblink, "SELECT COUNT(*) AS a FROM ".TB_PREFIX."alidata");
if($q) 
	$alliCount = (int)mysqli_fetch_assoc($q)['a'];

$topAlliances = [];
$q = mysqli_query($database->dblink,
    "SELECT a.tag, a.name, COUNT(u.id) AS members FROM ".TB_PREFIX."alidata a
     LEFT JOIN ".TB_PREFIX."users u ON u.alliance=a.id
     GROUP BY a.id ORDER BY members DESC LIMIT 5");
if($q) while($r=mysqli_fetch_assoc($q)) 
	$topAlliances[] = $r;

// New Players Today
$newToday = 0; 
$q = mysqli_query($database->dblink,
    "SELECT COUNT(*) AS n FROM ".TB_PREFIX."users WHERE regtime > ".(time()-86400)." AND tribe BETWEEN 1 AND 3");
if($q) 
	$newToday = (int)mysqli_fetch_assoc($q)['n'];

// Top 10
$topPop = [];
$q = mysqli_query($database->dblink,
    "SELECT u.username, COALESCE(SUM(v.pop),0) AS totalpop
     FROM ".TB_PREFIX."users u
     LEFT JOIN ".TB_PREFIX."vdata v ON v.owner = u.id
     WHERE u.tribe BETWEEN 1 AND 3
     GROUP BY u.id
     ORDER BY totalpop DESC
     LIMIT 10");
if($q) while($r = mysqli_fetch_assoc($q)) 
	$topPop[] = $r;

$topAtk = [];
$q = mysqli_query($database->dblink,
    "SELECT username, ap AS points 
     FROM ".TB_PREFIX."users 
     WHERE tribe BETWEEN 1 AND 3 
     ORDER BY ap DESC 
     LIMIT 10");
if($q) while($r = mysqli_fetch_assoc($q)) 
	$topAtk[] = $r;

$topDef = [];
$q = mysqli_query($database->dblink,
    "SELECT username, dp AS points 
     FROM ".TB_PREFIX."users 
     WHERE tribe BETWEEN 1 AND 3 
     ORDER BY dp DESC 
     LIMIT 10");
if($q) while($r = mysqli_fetch_assoc($q)) 
	$topDef[] = $r;

// WW
$wonders=[]; $q=mysqli_query($database->dblink,
    "SELECT v.name AS village, u.username, f.f99 AS level
     FROM ".TB_PREFIX."fdata f
     JOIN ".TB_PREFIX."vdata v ON f.vref=v.wref
     JOIN ".TB_PREFIX."users u ON v.owner=u.id
     WHERE f.f99t=40 AND f.f99>0 ORDER BY f.f99 DESC LIMIT 3");
if($q) while($r=mysqli_fetch_assoc($q)) 
	$wonders[]=$r;

// Artefacts
$artefacts=[]; 
$q=mysqli_query($database->dblink,
    "SELECT a.name, u.username FROM ".TB_PREFIX."artefacts a
     LEFT JOIN ".TB_PREFIX."users u ON a.owner=u.id WHERE a.active=1 LIMIT 5");
if($q) while($r=mysqli_fetch_assoc($q)) 
	$artefacts[]=$r;

// Troops
$units=[]; 
$result = mysqli_query($database->dblink, "SELECT " . implode(',', array_map(fn($i) => "SUM(u$i) AS u$i",range(1,30)))." FROM ".TB_PREFIX."units");
if($result) 
	$units=mysqli_fetch_assoc($result);
function u($units,$k){ 
return isset($units[$k])? (int)$units[$k] : 0; 
}
$isStaff = isset($session) && $session->access >= 8; // MH si Admin
?>

<!-- ================= WORLD STATS ================= -->
<table cellpadding="1" cellspacing="1" id="world_player" class="world">
<thead><tr><th colspan="2"><?php echo TZ_WORLD_STATS;?></th></tr>
<tr><td><?php echo TZ_TOTAL_VILLAGES;?></td><td><?php echo TZ_TOTAL_POPULATION;?></td></tr></thead>
<tbody><tr><td><?= $num_villages?></td><td><?= $total_pop?></td></tr></tbody>
</table>
<br />

<!-- ================= PLAYERS ================= -->
<table cellpadding="1" cellspacing="1" class="world">
<thead><tr><th colspan="2"><?php echo PLAYERS;?></th></tr></thead>
<tbody>
<tr><th><?php echo TZ_REGISTERED_PLAYERS;?></th><td><?= $users?></td></tr>
<tr><th><?php echo ACTIVE_PLAYERS;?></th><td><?= $active?></td></tr>
<tr><th>Players online</th><td><?= $online?></td></tr>
</tbody>
</table>
<br />

<!-- ================= SERVER 2026 ================= -->
<table cellpadding="1" cellspacing="1" class="world">
<thead><tr><th colspan="2">Server Information</th></tr></thead>
<tbody>
<tr><th>Days Since Start</th><td><?= $daysSinceStart?></td></tr>
<tr><th>Active Alliance</th><td><?= $alliCount?></td></tr>
<tr><th>Natars Villages</th><td><?= $natars?></td></tr>
<tr><th>Conquered Oasis</th><td><?= $oasis?></td></tr>
<tr><th>New Players Today</th><td><?= $newToday?></td></tr>
</tbody>
</table>
<br />

<!-- ================= TRIBES ================= -->
<table cellpadding="1" cellspacing="1" class="world">
<thead><tr><th colspan="3"><?php echo TZ_TRIBES;?></th></tr>
<tr><td><?php echo TRIBE;?></td><td><?php echo TZ_REGISTERED;?></td><td><?php echo PERCENT;?></td></tr></thead>
<tbody>
<?php
$roman=$tribes[0]; $teuton=$tribes[1]; $gaul=$tribes[2];
$romanPct=($users>0)?round(100*$roman/$users,2):0;
$teutonPct=($users>0)?round(100*$teuton/$users,2):0;
$gaulPct=($users>0)?round(100*$gaul/$users,2):0;
?>
<tr><td><?php echo TRIBE1;?></td><td><?= $roman?></td><td><?= $romanPct?>%</td></tr>
<tr><td><?php echo TRIBE2;?></td><td><?= $teuton?></td><td><?= $teutonPct?>%</td></tr>
<tr><td><?php echo TRIBE3;?></td><td><?= $gaul?></td><td><?= $gaulPct?>%</td></tr>
</tbody>
</table>
<br />

<?php if($isStaff): ?>
<!-- ================= GOLD ================= -->
<table cellpadding="1" cellspacing="1" class="world">
<thead><tr><th colspan="2">Total <?= SERVER_NAME?> <img src="./<?= GP_LOCATE?>img/a/gold.gif"> Gold</th></tr></thead>
<tbody><tr><td><?php echo GOLD;?></td><td><?= $total_gold?></td></tr></tbody>
</table>
<br />
<?php endif; ?>

<!-- ================= TOP ALLIANCES ================= -->
<table cellpadding="1" cellspacing="1" class="world">
<thead><tr><th colspan="3">Top 5 Alliances</th></tr>
<tr><td>Tag</td><td>Nume</td><td>Members</td></tr></thead>
<tbody>
<?php foreach($topAlliances as $a):?>
<tr><td><?=htmlspecialchars($a['tag'])?></td><td><?=htmlspecialchars($a['name'])?></td><td><?=(int)$a['members']?></td></tr>
<?php endforeach; if(empty($topAlliances)) echo '<tr><td colspan="3">-</td></tr>';?>
</tbody>
</table>
<br />

<?php if($isStaff): ?>
<!-- ================= TROOPS ================= -->
<table cellpadding="1" cellspacing="1" class="world">
<thead><tr><th colspan="6"><?php echo TROOPS;?></th></tr>
<tr><td><img src="img/romenai.png"></td><td><?php echo TZ_TOTAL;?></td>
<td><img src="img/germanai.png"></td><td><?php echo TZ_TOTAL;?></td>
<td><img src="img/galai.png"></td><td><?php echo TZ_TOTAL;?></td></tr></thead>
<tbody>
<?php for($i=1;$i<=10;$i++):?>
<tr>
<td><img src="img/x.gif" class="unit u<?=$i?>"></td><td><?=u($units,'u'.$i)?></td>
<td><img src="img/x.gif" class="unit u<?=$i+10?>"></td><td><?=u($units,'u'.($i+10))?></td>
<td><img src="img/x.gif" class="unit u<?=$i+20?>"></td><td><?=u($units,'u'.($i+20))?></td>
</tr>
<?php endfor;?>
</tbody>
</table>
<br />
<?php endif; ?>

<?php if($isStaff): ?>
<!-- ================= TOP PLAYERS ================= -->
<table cellpadding="1" cellspacing="1" class="world">
<thead>
<tr><th colspan="6">Top Players</th></tr>
<tr>
    <td>Population</td><td>Pct</td>
    <td>Attackers</td><td>Pct</td>
    <td>Defenders</td><td>Pct</td>
</tr>
</thead>
<tbody>
<?php for($i=0; $i<10; $i++):
    $p = $topPop[$i] ?? null;
    $a = $topAtk[$i] ?? null;
    $d = $topDef[$i] ?? null;
?>
<tr>
    <!-- Populatie -->
    <td><?= ($i+1).'. '.($p ? htmlspecialchars($p['username']) : '-') ?></td>
    <td><?= $p ? (int)($p['totalpop'] ?? 0) : 0 ?></td>

    <!-- Atacatori -->
    <td><?= ($i+1).'. '.($a ? htmlspecialchars($a['username']) : '-') ?></td>
    <td><?= $a ? (int)$a['points'] : 0 ?></td>

    <!-- Aparători -->
    <td><?= ($i+1).'. '.($d ? htmlspecialchars($d['username']) : '-') ?></td>
    <td><?= $d ? (int)$d['points'] : 0 ?></td>
</tr>
<?php endfor; ?>
</tbody>
</table>
<br />
<?php endif; ?>

<!-- ================= ENDGAME ================= -->
<table cellpadding="1" cellspacing="1" class="world">
<thead><tr><th colspan="3">Endgame</th></tr>
<tr><td>WW</td><td>Level</td><td>Artefacts</td></tr></thead>
<tbody><tr>
<td valign="top"><?php foreach($wonders as $w) echo htmlspecialchars($w['village'])." (".$w['level'].")<br>"; if(empty($wonders)) echo "-";?></td>
<td valign="top"><?php foreach($wonders as $w) echo $w['level']."<br>"; if(empty($wonders)) echo "-";?></td>
<td valign="top"><?php foreach($artefacts as $a) echo htmlspecialchars($a['name'])." - ".htmlspecialchars($a['username']??'Natars')."<br>"; if(empty($artefacts)) echo "-";?></td>
</tr></tbody>
</table>
<br />

<!-- ================= MISC ================= -->
<table cellpadding="1" cellspacing="1" class="world">
<thead><tr><th colspan="3"><?php echo TZ_MISCELLANEOUS;?></th></tr>
<tr><td><?php echo TZ_ATTACKS;?></td><td><?php echo CASUALTIES;?></td><td><?php echo DATE;?></td></tr></thead>
<tbody>
<?php for($d=0;$d<=6;$d++):?>
<tr>
<td><?= $database->getAttackByDate(time()-(86400*$d))?></td>
<td><?= $database->getAttackCasualties(time()-(86400*$d))?></td>
<td><?= date("j. M", time()-(86400*$d))?></td>
</tr>
<?php endfor;?>
</tbody>
</table>
<?php?>
<table cellpadding="1" cellspacing="1" id="search_navi">