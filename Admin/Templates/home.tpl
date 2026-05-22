<?php

#################################################################################
##              -= YOU MUST NOT REMOVE OR CHANGE THIS NOTICE =-                ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ                                                    ##
##  Version:       22.05.2026                                                  ##
##  Filename:      Admin\Templates\home.php     				               ##
##  Developed by:  Dzoki                                                       ##
##  Refactored by: Shadow                                                      ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2026. All rights reserved.                ##
##  URLs:          https://travianz.org                                        ##
##                 https://github.com/Shadowss/TravianZ                        ##
##                                                                             ##
#################################################################################
if($_SESSION['access'] < MULTIHUNTER) die("Access Denied!");

// ---- STATS ----
$totalUsers = $database->query("SELECT COUNT(*) as c FROM ".TB_PREFIX."users WHERE id > 5")->fetch_assoc()['c'];
$active24h = $database->query("SELECT COUNT(*) as c FROM ".TB_PREFIX."users WHERE timestamp > ".(time()-86400)." AND id > 5")->fetch_assoc()['c'];
$onlineNow = $database->query("SELECT COUNT(*) as c FROM ".TB_PREFIX."users WHERE timestamp > ".(time()-300)." AND id > 5")->fetch_assoc()['c'];
$totalVillages = $database->query("SELECT COUNT(*) as c FROM ".TB_PREFIX."vdata")->fetch_assoc()['c'];
$totalGold = $database->query("SELECT SUM(gold) as s FROM ".TB_PREFIX."users")->fetch_assoc()['s'];
$activePlus = $database->query("SELECT COUNT(*) as c FROM ".TB_PREFIX."users WHERE plus > ".time())->fetch_assoc()['c'];
$activeBans = $database->query("SELECT COUNT(*) as c FROM ".TB_PREFIX."banlist WHERE active=1")->fetch_assoc()['c'];
$lastReg = $database->query("SELECT username, id FROM ".TB_PREFIX."users WHERE id>5 ORDER BY id DESC LIMIT 1")->fetch_assoc();

// ---- TIMELINE ----
$startTime = $database->query("SELECT MIN(timestamp) as t FROM ".TB_PREFIX."users WHERE id>5")->fetch_assoc()['t'];
$serverStart = $startTime ? date('d.m.Y H:i', $startTime) : 'Unknown';

$natarsVillages = $database->query("SELECT COUNT(*) as c FROM ".TB_PREFIX."vdata WHERE owner=3")->fetch_assoc()['c'];
$natarsStatus = $natarsVillages > 0 ? "Launched ($natarsVillages villages)" : "Not launched";

$arteCount = 0; $arteDate = null;
if($database->dblink->query("SHOW TABLES LIKE '".TB_PREFIX."artefacts'")->num_rows){
    $a = $database->query("SELECT COUNT(*) as c, MIN(conquered) as d FROM ".TB_PREFIX."artefacts")->fetch_assoc();
    $arteCount = $a['c']; $arteDate = $a['d'];
}
$arteStatus = $arteCount > 0 ? "Launched ($arteCount) - ".date('d.m.Y',$arteDate) : "Not launched";

// PLANS din artefacts type=11
$plans = 0; $plansDate = null;
if($database->dblink->query("SHOW TABLES LIKE '".TB_PREFIX."artefacts'")->num_rows){
    $p = $database->query("SELECT COUNT(*) as c, MIN(conquered) as d FROM ".TB_PREFIX."artefacts WHERE type=11")->fetch_assoc();
    $plans = $p['c']; $plansDate = $p['d'];
}
$plansStatus = $plans > 0 ? "Launched ($plans) - ".($plansDate ? date('d.m.Y',$plansDate) : '') : "Not launched";

$role = $_SESSION['access'] == ADMIN ? 'Administrator' : 'MultiHunter';
?>
<style>
.dashboard { max-width:1150px; margin:20px auto; font-family:Verdana; }
.dash-head { text-align:center; margin-bottom:18px; }
.dash-head h1 { font-size:22px; margin:0; color:#222; }
.dash-head .sub { color:#666; font-size:12px; margin-top:4px; }
.cards { display:grid; grid-template-columns: repeat(4,1fr); gap:12px; margin-bottom:18px; }
.card { background:#fff; border:1px solid #ddd; border-radius:6px; padding:12px; box-shadow:0 1px 2px rgba(0,0,0,.05); }
.card h3 { margin:0 0 6px; font-size:11px; text-transform:uppercase; color:#777; }
.card .val { font-size:20px; font-weight:bold; color:#222; }
.card .subv { font-size:11px; color:#999; margin-top:4px; }
.card.green .val{color:#27ae60} .card.red .val{color:#c0392b} .card.blue .val{color:#2980b9} .card.orange .val{color:#e67e22}
.panel { background:#fff; border:1px solid #ddd; border-radius:6px; padding:12px; margin-bottom:18px; }
.panel h2 { margin:0 0 10px; font-size:14px; border-bottom:1px solid #eee; padding-bottom:6px; }
.timeline { display:grid; grid-template-columns: repeat(3,1fr); gap:10px; }
.timeline div { padding:6px; background:#f9f9f9; border-radius:4px; font-size:12px; }
.timeline b { color:#333; }
.grid2 { display:grid; grid-template-columns:2fr 1fr; gap:12px; }
.logmini { font-size:11px; } .logmini div { padding:4px 0; border-bottom:1px dotted #eee; }
.quick a { display:block; padding:7px; background:#f7f7f7; margin-bottom:5px; text-decoration:none; color:#333; border-radius:4px; font-size:12px; }
.quick a:hover { background:#eaeaea; }
.credits { margin-top:30px; padding:12px; border-top:1px solid #e5e5e5; text-align:center; color:#666; font-size:11px; }
</style>

<div class="dashboard">
  <div class="dash-head">
    <h1>WELCOME TO <?php echo strtoupper($role); ?> CONTROL PANEL</h1>
    <div class="sub">Hello <b><?php echo $_SESSION['admin_username']; ?></b> — <?php echo date('d.m.Y H:i'); ?> Server Time</div>
  </div>

  <!-- TOATE CARDURILE ORIGINALE -->
  <div class="cards">
    <div class="card blue"><h3>Total Players</h3><div class="val"><?php echo number_format($totalUsers); ?></div><div class="subv">+ <?php echo $active24h; ?> active 24h</div></div>
    <div class="card green"><h3>Online Now</h3><div class="val"><?php echo $onlineNow; ?></div><div class="subv">last 5 minutes</div></div>
    <div class="card"><h3>Villages</h3><div class="val"><?php echo number_format($totalVillages); ?></div><div class="subv">avg <?php echo $totalUsers ? round($totalVillages/$totalUsers,1) : 0; ?> / player</div></div>
    <div class="card orange"><h3>Gold in Game</h3><div class="val"><?php echo number_format($totalGold); ?></div><div class="subv"><?php echo $activePlus; ?> with Plus active</div></div>
    <div class="card red"><h3>Active Bans</h3><div class="val"><?php echo $activeBans; ?></div><div class="subv"><a href="admin.php?p=ban">manage</a></div></div>
    <div class="card"><h3>Last Registration</h3><div class="val" style="font-size:14px"><a href="admin.php?p=player&uid=<?php echo $lastReg['id']; ?>"><?php echo htmlspecialchars($lastReg['username']); ?></a></div><div class="subv">ID #<?php echo $lastReg['id']; ?></div></div>
    <div class="card"><h3>PHP / MySQL</h3><div class="val" style="font-size:14px"><?php echo PHP_VERSION; ?></div><div class="subv"><?php echo $database->dblink->server_info; ?></div></div>
    <div class="card"><h3>Server Load</h3><div class="val" style="font-size:14px"><?php echo date('H:i:s'); ?></div><div class="subv">Uptime: <?php echo @exec('uptime -p') ?: 'n/a'; ?></div></div>
  </div>

  <!-- TIMELINE NOU - IN PLUS -->
  <div class="panel">
    <h2>Server Timeline</h2>
    <div class="timeline">
      <div><b>Start Date:</b><br><?php echo $serverStart; ?></div>
      <div><b>Natars:</b><br><?php echo $natarsStatus; ?></div>
      <div><b>Artefacts:</b><br><?php echo $arteStatus; ?></div>
      <div><b>WW Plans:</b><br><?php echo $plansStatus; ?></div>
      <div><b>Server Age:</b><br><?php echo $startTime ? floor((time()-$startTime)/86400).' days' : '-'; ?></div>
      <div><b>Next Event:</b><br>—</div>
    </div>
  </div>

  <div class="grid2">
    <div class="panel">
      <h2>Last 5 Admin Actions</h2>
      <div class="logmini">
      <?php
      $logs = $database->query("SELECT * FROM ".TB_PREFIX."admin_log ORDER BY id DESC LIMIT 5");
      while($l = $logs->fetch_assoc()){
        $u = $database->getUserField($l['user'],'username',0);
        echo '<div>['.date('H:i',$l['time']).'] <b>'.$u.'</b> — '.strip_tags($l['log']).'</div>';
      }
      ?>
      </div>
      <div style="margin-top:8px"><a href="admin.php?p=admin_log">view full log →</a></div>
    </div>

    <div class="panel quick">
      <h2>Quick Actions</h2>
      <a href="admin.php?p=search">🔍 Search Player</a>
      <a href="admin.php?p=ban">🔨 Ban Manager</a>
      <a href="admin.php?p=map">🗺️ Map</a>
      <a href="admin.php?p=natars">🏰 Natars</a>
      <a href="admin.php?p=addUser">👤 Add User</a>
      <a href="admin.php?p=server_info">⚙️ Server Info</a>
    </div>
  </div>

  <div class="credits">
    Credits: Akakori & Elmar — Fixed by <b>Dzoki</b> — Reworked by <b>aggenkeech</b> — Dashboard v2.1 by <b>Shadow</b>
  </div>
</div>