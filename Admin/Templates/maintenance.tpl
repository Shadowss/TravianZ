<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : maintenance.tpl 		                                   ##
##  Type           : Admin Panel Frontend                                      ##
## --------------------------------------------------------------------------- ##
##  Developed by   : Shadow (Original)                                         ##
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

global $database;

$uid = 0;
if(isset($_SESSION['id'])) {
    $uid = (int)$_SESSION['id'];
} elseif(isset($GLOBALS['session']->uid)) {
    $uid = (int)$GLOBALS['session']->uid;
}

if(isset($_POST['startMaint'])) {
    $database->setMaintenance(1, $uid);
    $error = "Maintenance ON";
}
if(isset($_POST['removeMaint'])) {
    $database->setMaintenance(0, $uid);
    $error = "Maintenance OFF";
}
$maint = $database->getMaintenance();

$starterName = 'Unknow';
if($maint['started_by'] > 0){
    $u = $database->getUserArray($maint['started_by'], 1);
    $starterName = $u['username'] ?? 'UID '.$maint['started_by'];
}
?>
<style>
.maint-card{max-width:520px;margin:12px auto;background:#fff;border:1px solid #e5e7eb;border-radius:10px;overflow:hidden;font-family:system-ui}
.maint-head{background:#0f172a;color:#fff;padding:10px 14px;font-weight:600}
.maint-status{padding:14px;text-align:center;font-weight:600}
.maint-status.on{color:#dc2626;background:#fef2f2}
.maint-status.off{color:#16a34a;background:#f0fdf4}
.maint-row{display:grid;grid-template-columns:1fr 120px;padding:12px 14px;border-top:1px solid #f1f5f9;align-items:center}
.maint-btn{padding:8px;border:0;border-radius:6px;color:#fff;font-weight:500;cursor:pointer;width:100%}
.start{background:#16a34a}.stop{background:#dc2626}
.maint-info{font-size:12px;color:#64748b;padding:0 14px 10px}
.msg{padding:8px 12px;margin:8px auto;max-width:520px;background:#f0fdf4;border:1px solid #bbf7d0;color:#166534;border-radius:6px;font-weight:600}
</style>

<?php if(!empty($error)) echo '<div class="msg">'.$error.'</div>'; ?>

<form method="POST">
<div class="maint-card">
  <div class="maint-head">Server Maintenance</div>
  <div class="maint-status <?= $maint['active'] ? 'on' : 'off' ?>">
    <?= $maint['active'] ? 'ACTIVE since '.($maint['started_at'] ? date('H:i d.m.Y',$maint['started_at']) : '-') : 'INACTIVE – server open' ?>
  </div>
  <?php if($maint['active']){ ?>
    <div class="maint-info">Started by: <b><?= htmlspecialchars($starterName) ?></b> (UID: <?= (int)$maint['started_by'] ?>)</div>
  <?php } ?>
  <div class="maint-row">
    <div>Enable maintenance</div>
    <button type="submit" name="startMaint" class="maint-btn start">Start</button>
  </div>
  <div class="maint-row">
    <div>Disable maintenance</div>
    <button type="submit" name="removeMaint" class="maint-btn stop">Stop</button>
  </div>
</div>
</form>