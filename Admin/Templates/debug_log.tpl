<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<head>
  <link rel="shortcut icon" href="favicon.ico"/>
  <title><?php echo ($_SESSION['access'] == ADMIN ? 'Admin Control Panel' : 'Multihunter Control Panel'); ?> - TravianZ</title>
  <link rel="stylesheet" type="text/css" href="../img/admin/admin.css">
  <link rel="stylesheet" type="text/css" href="../img/admin/acp.css">
  <link rel="stylesheet" type="text/css" href="../img/../img.css">
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta http-equiv="imagetoolbar" content="no">
  <style>
    .dbg-wrap{max-width:100%;margin:12px;font-family:Tahoma,Verdana,Arial,sans-serif;color:#222}
    .dbg-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:8px}
    .dbg-head h2{margin:0;font-size:16px;color:#ffffff}
    .dbg-state{font-weight:700;padding:3px 10px;border-radius:14px;color:#fff;font-size:11px}
    .dbg-on{background:#16a34a}.dbg-off{background:#dc2626}
    .dbg-card{background:#fff;border:1px solid #bbb;border-radius:6px;padding:12px;margin-bottom:12px}
    .dbg-card h3{margin:0 0 10px;font-size:13px;color:#0f172a;border-bottom:1px solid #eee;padding-bottom:6px}
    .dbg-row{display:flex;flex-wrap:wrap;gap:18px;align-items:center;margin-bottom:8px;font-size:12px}
    .dbg-row label{display:flex;align-items:center;gap:5px;cursor:pointer}
    .dbg-row input[type=number]{width:70px;padding:3px 5px;border:1px solid #bbb;border-radius:4px}
    .dbg-btn{padding:6px 14px;font-size:12px;border:1px solid #bbb;border-radius:6px;background:#f5f5f5;cursor:pointer;text-decoration:none;color:#222;display:inline-block}
    .dbg-btn.primary{background:#2563eb;color:#fff;border-color:#2563eb}
    .dbg-btn.green{background:#16a34a;color:#fff;border-color:#16a34a}
    .dbg-btn.red{background:#dc2626;color:#fff;border-color:#dc2626}
    .dbg-actions{display:flex;gap:8px;flex-wrap:wrap;margin-top:8px}
    .dbg-log{background:#0f172a;color:#d1fae5;font-family:Consolas,Monaco,monospace;font-size:11px;line-height:15px;
             padding:10px;border-radius:6px;max-height:480px;overflow:auto;white-space:pre-wrap;word-break:break-word}
    .dbg-note{font-size:11px;color:#64748b;margin-top:6px}
  </style>
</head>
<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : debug_log.tpl                                             ##
##  Type           : Admin Panel Frontend (Debug Error Log)                   ##
##  Project        : TravianZ                                                  ##
##  GitHub         : https://github.com/Shadowss/TravianZ                      ##
##  License        : TravianZ Project                                          ##
##  Copyright      : TravianZ (c) 2010-2026. All rights reserved.             ##
## --------------------------------------------------------------------------- ##
#################################################################################

if($_SESSION['access'] < ADMIN) die("Access Denied: You are not Admin!");

$cfg = $database->getDebugMode();
$isOn = !empty($cfg['active']);

// Resolve project root (max 5 levels up) to find the log file.
$autoprefix = '';
for ($i = 0; $i < 5; $i++) {
    $autoprefix = str_repeat('../', $i);
    if (file_exists($autoprefix . 'autoloader.php')) {
        break;
    }
}
$logFile = $autoprefix . 'var/log/debug-players.log';

// Read the last lines for the on-screen viewer.
$maxLines = 400;
$lines = [];
$logSize = 0;
if (is_file($logFile)) {
    $logSize = filesize($logFile);
    $all = file($logFile, FILE_IGNORE_NEW_LINES);
    if ($all !== false) {
        $lines = array_slice($all, -$maxLines);
    }
}

// Active-since label + auto-off info.
$since = !empty($cfg['started_at']) ? date('d.m.Y H:i', $cfg['started_at']) : '-';
$autoOff = (int)($cfg['auto_off_hours'] ?? 0);
?>
<div class="dbg-wrap">

  <div class="dbg-head">
    <h2><?php echo ADM_DEBUG_ERROR_LOG; ?></h2>
    <span class="dbg-state <?php echo $isOn ? 'dbg-on' : 'dbg-off'; ?>">
      <?php echo $isOn ? 'CAPTURE ON' : 'CAPTURE OFF'; ?>
    </span>
  </div>

  <div class="dbg-card">
    <h3><?php echo ADM_STATUS; ?></h3>
    <div class="dbg-row">
      <span><?php echo ADM_CAPTURE_IS; ?><b><?php echo $isOn ? 'ON' : 'OFF'; ?></b><?php echo $isOn ? ' since '.$since : ''; ?>.</span>
      <span><?php echo ADM_AUTO_OFF; ?><b><?php echo $autoOff > 0 ? $autoOff.' h' : 'never'; ?></b></span>
      <span><?php echo ADM_LOG_SIZE; ?><b><?php echo number_format($logSize / 1024, 1); ?> KB</b></span>
    </div>
    <form action="../GameEngine/Admin/Mods/debugLog.php" method="POST" style="display:inline">
      <?php echo csrf_field(); ?>
      <input type="hidden" name="do" value="toggle">
      <input type="hidden" name="active" value="<?php echo $isOn ? 0 : 1; ?>">
      <button type="submit" class="dbg-btn <?php echo $isOn ? 'red' : 'green'; ?>">
        <?php echo $isOn ? 'Turn capture OFF' : 'Turn capture ON'; ?>
      </button>
    </form>
    <p class="dbg-note"><?php echo ADM_TRANSPARENT_TO_PLAYERS_ERRORS_ARE_ONLY_WRITT; ?></p>
  </div>

  <div class="dbg-card">
    <h3><?php echo ADM_CAPTURE_SETTINGS; ?></h3>
    <form action="../GameEngine/Admin/Mods/debugLog.php" method="POST">
      <?php echo csrf_field(); ?>
      <input type="hidden" name="do" value="save">
      <div class="dbg-row">
        <label><input type="checkbox" name="lvl_warning"    <?php echo !empty($cfg['lvl_warning'])    ? 'checked' : ''; ?>><?php echo ADM_WARNINGS; ?></label>
        <label><input type="checkbox" name="lvl_notice"     <?php echo !empty($cfg['lvl_notice'])     ? 'checked' : ''; ?>><?php echo ADM_NOTICES; ?></label>
        <label><input type="checkbox" name="lvl_deprecated" <?php echo !empty($cfg['lvl_deprecated']) ? 'checked' : ''; ?>><?php echo ADM_DEPRECATED; ?></label>
        <label><input type="checkbox" name="lvl_fatal"      <?php echo !empty($cfg['lvl_fatal'])      ? 'checked' : ''; ?>><?php echo ADM_FATAL_ERRORS; ?></label>
      </div>
      <div class="dbg-row">
        <label><?php echo ADM_MAX_FILE_SIZE_MB; ?><input type="number" name="max_size_mb" min="1" max="200" value="<?php echo (int)($cfg['max_size_mb'] ?? 5); ?>">
        </label>
        <label><?php echo ADM_AUTO_OFF_AFTER_HOURS_0_NEVER; ?><input type="number" name="auto_off_hours" min="0" max="168" value="<?php echo (int)($cfg['auto_off_hours'] ?? 6); ?>">
        </label>
        <button type="submit" class="dbg-btn primary"><?php echo ADM_SAVE_SETTINGS; ?></button>
      </div>
      <p class="dbg-note"><?php echo ADM_BEYOND_THE_SIZE_CAP_THE_FILE_IS_ROTATED_TO_A; ?><code>.log.1</code><?php echo ADM_BACKUP_SO_THE_TOTAL_VOLUME_STAYS_BOUNDED; ?></p>
    </form>
  </div>

  <div class="dbg-card">
    <h3>Last <?php echo $maxLines; ?> lines</h3>
    <div class="dbg-actions">
      <a class="dbg-btn" href="../GameEngine/Admin/Mods/debugLog.php?do=download"><?php echo ADM_DOWNLOAD_FULL_LOG; ?></a>
      <form action="../GameEngine/Admin/Mods/debugLog.php" method="POST" style="display:inline"
            onsubmit="return confirm('Clear the debug log file?');">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="do" value="clear">
        <button type="submit" class="dbg-btn red"><?php echo ADM_CLEAR_LOG; ?></button>
      </form>
      <a class="dbg-btn" href="?p=debug_log"><?php echo ADM_REFRESH; ?></a>
    </div>
    <div class="dbg-log" style="margin-top:8px"><?php
      if (empty($lines)) {
          echo "(log is empty)";
      } else {
          foreach ($lines as $l) {
              echo htmlspecialchars($l) . "\n";
          }
      }
    ?></div>
  </div>

</div>
