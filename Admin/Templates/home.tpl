<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : home.tpl                                                  ##
##  Type           : Admin Panel Frontend                                      ##
## --------------------------------------------------------------------------- ##
##  Developed by   : Dzoki (Original)                                          ##
##  Refactored by  : Shadow                                                    ##
##  Redesign by    : Shadow                                                    ##
## --------------------------------------------------------------------------- ##
##  Contact        : cata7007@gmail.com                                        ##
##  Project        : TravianZ                                                  ##
##  GitHub         : https://github.com/Shadowss/TravianZ                      ##
## --------------------------------------------------------------------------- ##
##  License        : TravianZ Project                                          ##
##  Copyright      : TravianZ (c) 2010-2025. All rights reserved.              ##
## --------------------------------------------------------------------------- ##
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

$plans = 0; $plansDate = null;
if($database->dblink->query("SHOW TABLES LIKE '".TB_PREFIX."artefacts'")->num_rows){
    $p = $database->query("SELECT COUNT(*) as c, MIN(conquered) as d FROM ".TB_PREFIX."artefacts WHERE type=11")->fetch_assoc();
    $plans = $p['c']; $plansDate = $p['d'];
}
$plansStatus = $plans > 0 ? "Launched ($plans) - ".($plansDate ? date('d.m.Y',$plansDate) : '') : "Not launched";

$role = $_SESSION['access'] == ADMIN ? 'Administrator' : 'MultiHunter';
?>
<style>
/* === HOME.TPL — dark dashboard === */
.dashboard { max-width:1150px; margin:0 auto; font-family:system-ui, Verdana, Arial, sans-serif; color:#e2e8f0; }
.dash-head { text-align:center; margin-bottom:22px; }
.dash-head h1 { font-size:24px !important; margin:0 !important; color:#f1f5f9 !important; font-weight:800 !important; letter-spacing:-0.3px; }
.dash-head .sub { color:#94a3b8 !important; font-size:13px !important; margin-top:6px !important; }
.dash-head .sub b{color:#f59e0b !important;}

/* CARDS — clean auto-fit grid */
.cards {
    display:grid !important;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)) !important;
    gap:14px !important;
    margin:0 auto 22px !important;
}
.card {
    background:#0b1220 !important;
    border:1px solid #1f2937 !important;
    border-radius:12px !important;
    padding:14px 12px !important;
    box-shadow:0 2px 8px rgba(0,0,0,.25) !important;
    text-align:center !important;
    transition:transform .15s, border-color .15s;
}
.card:hover { transform:translateY(-3px); border-color:#334155 !important; }
.card h3 { margin:0 0 8px !important; font-size:10px !important; text-transform:uppercase !important; color:#94a3b8 !important; font-weight:700 !important; letter-spacing:.5px; }
.card .val { font-size:24px !important; font-weight:800 !important; color:#f1f5f9 !important; line-height:1.2; }
.card .subv { font-size:11px !important; color:#64748b !important; margin-top:6px !important; }
.card.green .val{color:#4ade80 !important}
.card.red .val{color:#f87171 !important}
.card.blue .val{color:#60a5fa !important}
.card.orange .val{color:#fb923c !important}
.card .subv a{color:#7dd3fc !important; text-decoration:none !important; font-weight:600 !important;}

/* PANELS */
.panel { background:#0b1220 !important; border:1px solid #1f2937 !important; border-radius:12px !important; padding:16px !important; margin-bottom:18px !important; }
.panel h2 { margin:0 0 12px !important; font-size:14px !important; color:#f1f5f9 !important; border-bottom:1px solid #1f2937 !important; padding-bottom:8px !important; font-weight:700 !important; }

.timeline { display:grid !important; grid-template-columns: repeat(auto-fit, minmax(150px,1fr)) !important; gap:10px !important; }
.timeline div { padding:10px !important; background:#0f172a !important; border-radius:8px !important; font-size:12px !important; color:#cbd5e1 !important; border:1px solid #1f2937 !important; }
.timeline b { color:#f59e0b !important; font-weight:700 !important; display:block; margin-bottom:3px; }

.grid2 { display:grid !important; grid-template-columns:2fr 1fr !important; gap:16px !important; }
.logmini { font-size:12px !important; }
.logmini div { padding:6px 0 !important; border-bottom:1px dotted #1f2937 !important; color:#cbd5e1 !important; }
.logmini b{color:#f1f5f9 !important;}

.quick a { display:block !important; padding:9px 12px !important; background:#0f172a !important; margin-bottom:6px !important; text-decoration:none !important; color:#cbd5e1 !important; border-radius:8px !important; font-size:12px !important; border:1px solid #1f2937 !important; font-weight:500 !important; transition:all .15s; }
.quick a:hover { background:#f59e0b !important; color:#1a1a2e !important; border-color:#f59e0b !important; transform:translateX(3px); }

/* compact footer (replaces the heavy animated credits block) */
.credits { margin-top:6px !important; padding:12px 16px !important; text-align:center !important;
    background:#0b1220 !important; border:1px solid #1f2937 !important; border-radius:10px !important; }
.credits .shadow-main { font-size:12px !important; font-weight:700 !important; color:#cbd5e1 !important; }
.credits .shadow-main span { color:#f59e0b !important; }
.credits .shadow-sub { font-size:11px !important; color:#64748b !important; margin-top:3px !important; }
.credits .shadow-old { font-size:10px !important; color:#475569 !important; margin-top:4px !important; }
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
    <div class="card"><h3>Last Registration</h3><div class="val" style="font-size:15px !important"><a href="admin.php?p=player&uid=<?php echo $lastReg['id']; ?>" style="color:#2563eb !important"><?php echo htmlspecialchars($lastReg['username']); ?></a></div><div class="subv">ID #<?php echo $lastReg['id']; ?></div></div>
    <div class="card"><h3>PHP / MySQL</h3><div class="val" style="font-size:15px !important"><?php echo PHP_VERSION; ?></div><div class="subv"><?php echo $database->dblink->server_info; ?></div></div>
    <div class="card"><h3>Server Clock</h3><div class="val" style="font-size:15px !important"><?php echo date('H:i:s'); ?></div><div class="subv">Uptime: <?php echo @exec('uptime -p') ?: 'n/a'; ?></div></div>
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
      <div style="margin-top:10px"><a href="admin.php?p=admin_log" style="color:#2563eb !important;font-weight:600">view full log →</a></div>
    </div>

    <div class="panel quick">
      <h2>Quick Actions</h2>
      <a href="admin.php?p=search">🔍 Search Player</a>
      <a href="admin.php?p=ban">🔨 Ban Manager</a>
      <a href="admin.php?p=map">🗺 Map</a>
      <a href="admin.php?p=natars">🏰 Natars</a>
      <a href="admin.php?p=addUser">👤 Add User</a>
      <a href="admin.php?p=server_info">⚙ Server Info</a>
    </div>
  </div>

	<div class="credits">
		<div class="shadow-main">⚡ ADMIN PANEL 100% REBUILT BY Shadow</div>
		<div class="shadow-sub">Dashboard v5.0 • TravianZ 2025 • Full code, design & optimization</div>
		<div class="shadow-old">Based on: Akakori & Elmar | Fixed by: Dzoki | Reworked by: aggenkeech</div>
	</div>
</div>