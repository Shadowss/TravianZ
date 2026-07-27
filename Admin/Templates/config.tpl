<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : config.tpl                                                ##
##  Type           : Admin Panel Frontend                                      ##
## --------------------------------------------------------------------------- ##
##  Developed by   : Dzoki (Original)                                          ##
##  Rework by      : ronix                                                     ##
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
if(!isset($_SESSION)) session_start();
if($_SESSION['access'] < 9) die(ACCESS_DENIED_ADMIN);

$editIcon = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#93c5fd" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>';
?>
<style>
.config-wrap{max-width:1100px;margin:0 auto;font-family:system-ui,-apple-system,Segoe UI,Roboto}
.config-title{text-align:center;font-size:20px;font-weight:800;margin:8px 0 12px;color:#ffffff}
.config-card{background:#fff;border:1px solid #e5e7eb;border-radius:8px;margin-bottom:10px;overflow:hidden;box-shadow:0 1px 2px rgba(0,0,0,.04)}
.config-head{display:flex;justify-content:space-between;align-items:center;padding:7px 10px;background:#0f172a;color:#fff;font-weight:600;font-size:13px;line-height:1}
.edit-btn{display:inline-flex;align-items:center;justify-content:center;width:22px;height:22px;border-radius:4px;transition:.15s}
.edit-btn:hover{background:rgba(255,255,255,.12)}
.edit-btn svg{width:14px;height:14px;transition:.15s}
.edit-btn:hover svg{stroke:#fff;transform:scale(1.05)}
.config-table{width:100%;border-collapse:collapse}
.config-table tr{border-top:1px solid #f1f5f9}
.config-table tr:first-child{border-top:0}
.config-table td{padding:5px 8px;vertical-align:middle;font-size:13px;line-height:1.25}
.config-table td.b{background:#f8fafc;font-weight:700;color:#334155;text-transform:uppercase;font-size:11px;letter-spacing:.3px;padding:4px 8px}
.config-table td:first-child{color:#475569;width:60%}
.config-table td:last-child{color:#0f172a;font-weight:500}
.badge.green{background:#dcfce7;color:#166534}
.badge.red{background:#fee2e2;color:#991b1b}
.badge.blue{background:#dbeafe;color:#1e40af}
.badge.gray{background:#f1f5f9;color:#475569}
</style>

<div class="config-wrap">
<h2 class="config-title"><?php echo SERV_CONFIG ?></h2>

<!-- SERVER SETTINGS -->
<div class="config-card">
  <div class="config-head">
    <span><?php echo SERV_SETT ?></span>
    <a href="admin.php?p=editServerSet" title="<?php echo EDIT_SERV_SETT ?>" class="edit-btn"><?php echo $editIcon; ?></a>
  </div>
  <table class="config-table">
    <tr><td class="b"><?php echo SERV_VARIABLE ?></td><td class="b"><?php echo SERV_VALUE ?></td></tr>
    <tr><td><?php echo CONF_SERV_NAME ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_NAME_TOOLTIP ?></span></em></td><td><?php echo SERVER_NAME;?></td></tr>
    <tr><td><?php echo CONF_SERV_STARTED ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_STARTED_TOOLTIP ?></span></em></td><td><?php echo "Date:".START_DATE." Time:".START_TIME;?></td></tr>
    <tr><td><?php echo CONF_SERV_TIMEZONE ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_TIMEZONE_TOOLTIP ?></span></em></td><td><?php echo TIMEZONE;?></td></tr>
    <tr><td><?php echo CONF_SERV_LANG ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_LANG_TOOLTIP ?></span></em></td><td><?php if((defined('SERVER_LANG') ? SERVER_LANG : LANG) == 'en') echo "English"; elseif((defined('SERVER_LANG') ? SERVER_LANG : LANG) == 'fr') echo "French"; elseif((defined('SERVER_LANG') ? SERVER_LANG : LANG) == 'it') echo "Italian"; elseif((defined('SERVER_LANG') ? SERVER_LANG : LANG) == 'ro') echo "Romanian"; elseif((defined('SERVER_LANG') ? SERVER_LANG : LANG) == 'zh') echo "Chinese"; ?></td></tr>
    <tr><td><?php echo CONF_SERV_SERVSPEED ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_SERVSPEED_TOOLTIP ?></span></em></td><td><?php echo ''.SPEED.'x';?></td></tr>
    <tr><td><?php echo CONF_SERV_TROOPSPEED ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_TROOPSPEED_TOOLTIP ?></span></em></td><td><?php echo INCREASE_SPEED;?>x</td></tr>
    <tr><td><?php echo CONF_SERV_EVASIONSPEED ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_EVASIONSPEED_TOOLTIP ?></span></em></td><td><?php echo EVASION_SPEED;?></td></tr>
    <tr><td><?php echo CONF_SERV_STORMULTIPLER ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_STORMULTIPLER_TOOLTIP ?></span></em></td><td><?php echo STORAGE_MULTIPLIER;?></td></tr>
    <tr><td><?php echo CONF_SERV_TRADCAPACITY ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_TRADCAPACITY_TOOLTIP ?></span></em></td><td><?php echo TRADER_CAPACITY;?></td></tr>
    <tr><td><?php echo CONF_SERV_CRANCAPACITY ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_CRANCAPACITY_TOOLTIP ?></span></em></td><td><?php echo CRANNY_CAPACITY;?></td></tr>
    <tr><td><?php echo CONF_SERV_TRAPCAPACITY ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_TRAPCAPACITY_TOOLTIP ?></span></em></td><td><?php echo TRAPPER_CAPACITY;?></td></tr>
    <tr><td><?php echo CONF_SERV_NATUNITSMULTIPLIER ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_NATUNITSMULTIPLIER_TOOLTIP ?></span></em></td><td><?php echo NATARS_UNITS;?></td></tr>
    <tr><td><?php echo CONF_SERV_NATARS_SPAWN_TIME ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_NATARS_SPAWN_TIME_TOOLTIP ?></span></em></td><td><?php echo NATARS_SPAWN_TIME;?></td></tr>
    <tr><td><?php echo CONF_SERV_NATARS_WW_SPAWN_TIME ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_NATARS_WW_SPAWN_TIME_TOOLTIP ?></span></em></td><td><?php echo NATARS_WW_SPAWN_TIME;?></td></tr>
    <tr><td><?php echo CONF_SERV_NATARS_WW_BUILDING_PLAN_SPAWN_TIME ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_NATARS_WW_BUILDING_PLAN_SPAWN_TIME_TOOLTIP ?></span></em></td><td><?php echo NATARS_WW_BUILDING_PLAN_SPAWN_TIME;?></td></tr>
    <tr><td><?php echo CONF_SERV_MAPSIZE ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_MAPSIZE_TOOLTIP ?></span></em></td><td><?php echo WORLD_MAX;?>x<?php echo WORLD_MAX;?></td></tr>
    <tr><td><?php echo CONF_SERV_VILLEXPSPEED ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_VILLEXPSPEED_TOOLTIP ?></span></em></td><td><?php echo CP == 0 ? "Fast" : "Slow"; ?></td></tr>
    <tr><td><?php echo CONF_SERV_BEGINPROTECT ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_BEGINPROTECT_TOOLTIP ?></span></em></td><td><?php echo (PROTECTION / 3600);?> hour/s</td></tr>
    <tr><td><?php echo CONF_SERV_REGOPEN ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_REGOPEN_TOOLTIP ?></span></em></td><td><?php echo REG_OPEN ? "<span class='badge blue'>True</span>" : "<span class='badge red'>False</span>"; ?></td></tr>
    <tr><td><?php echo CONF_SERV_ACTIVMAIL ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_ACTIVMAIL_TOOLTIP ?></span></em></td><td><?php echo AUTH_EMAIL ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
    <tr><td><?php echo CONF_SERV_QUEST ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_QUEST_TOOLTIP ?></span></em></td><td><?php echo QUEST ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
    <tr><td><?php echo CONF_SERV_QTYPE ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_QTYPE_TOOLTIP ?></span></em></td><td><?php echo QTYPE == 25 ? "<span class='badge blue'>Travian Official</span>" : "<span class='badge blue'>TravianZ Extended</span>"; ?></td></tr>
    <tr><td><?php echo CONF_SERV_DLR ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_DLR_TOOLTIP ?></span></em></td><td><?php echo DEMOLISH_LEVEL_REQ; ?></td></tr>
    <tr><td><?php echo CONF_SERV_WWSTATS ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_WWSTATS_TOOLTIP ?></span></em></td><td><?php echo WW ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
    <tr><td><?php echo CONF_SERV_NTRTIME ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_NTRTIME_TOOLTIP ?></span></em></td><td><?php echo NATURE_REGTIME >= 86400 ? (NATURE_REGTIME/86400).' Days' : (NATURE_REGTIME/3600).' Hours'; ?></td></tr>
    <tr><td><?php echo CONF_SERV_OASIS_WOOD_PROD_MULT ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_OASIS_WOOD_PROD_MULT_TOOLTIP ?></span></em></td><td><?php echo OASIS_WOOD_MULTIPLIER ?></td></tr>
    <tr><td><?php echo CONF_SERV_OASIS_CLAY_PROD_MULT ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_OASIS_CLAY_PROD_MULT_TOOLTIP ?></span></em></td><td><?php echo OASIS_CLAY_MULTIPLIER ?></td></tr>
    <tr><td><?php echo CONF_SERV_OASIS_IRON_PROD_MULT ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_OASIS_IRON_PROD_MULT_TOOLTIP ?></span></em></td><td><?php echo OASIS_IRON_MULTIPLIER ?></td></tr>
    <tr><td><?php echo CONF_SERV_OASIS_CROP_PROD_MULT ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_OASIS_CROP_PROD_MULT_TOOLTIP ?></span></em></td><td><?php echo OASIS_CROP_MULTIPLIER ?></td></tr>
    <tr><td><?php echo CONF_SERV_MEDALINTERVAL ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_MEDALINTERVAL_TOOLTIP ?></span></em></td><td><?php echo MEDALINTERVAL >= 86400 ? (MEDALINTERVAL/86400).' Days' : (MEDALINTERVAL/3600).' Hours'; ?></td></tr>
    <tr><td><?php echo CONF_SERV_TOURNTHRES ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_TOURNTHRES_TOOLTIP ?></span></em></td><td><?php echo TS_THRESHOLD;?></td></tr>
    <tr><td><?php echo CONF_SERV_GWORKSHOP ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_GWORKSHOP_TOOLTIP ?></span></em></td><td><?php echo GREAT_WKS ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
    <tr><td><?php echo CONF_SERV_NATARSTAT ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_NATARSTAT_TOOLTIP ?></span></em></td><td><?php echo SHOW_NATARS ? "<span class='badge blue'>True</span>" : "<span class='badge red'>False</span>"; ?></td></tr>
    <tr><td><?php echo CONF_SERV_PEACESYST ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_PEACESYST_TOOLTIP ?></span></em></td><td><?php echo (["None", "Normal", "Christmas", "New Year", "Easter"])[PEACE]; ?></td></tr>
    <tr><td><?php echo CONF_SERV_GRAPHICPACK ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_GRAPHICPACK_TOOLTIP ?></span></em></td><td><?php echo GP_ENABLE ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
    <tr><td><?php echo CONF_SERV_ERRORREPORT ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SERV_ERRORREPORT_TOOLTIP ?></span></em></td><td><b><?php echo (ERROR_REPORT=="error_reporting (0);")? "No": "Yes";?></b></td></tr>
    <tr>
      <td><?php echo ADM_SERVER_GRAPHIC_PACK; ?> <em class="tooltip">?<span class="classic"><?php echo ADM_SERVER_GRAPHIC_PACK_TIP; ?></span></em></td>
      <td><b><?php echo defined('GP_LOCATE') ? GP_LOCATE : 'gpack/travian_default/'; ?></b></td>
    </tr>
    <tr>
      <td><?php echo ADM_PLAYER_GRAPHIC_PACKS; ?> <em class="tooltip">?<span class="classic"><?php echo ADM_PLAYER_GRAPHIC_PACKS_TIP; ?></span></em></td>
      <td><b><?php echo (defined('GP_ENABLE') && GP_ENABLE) ? 'Yes' : 'No'; ?></b></td>
    </tr>
    <tr>
      <td><?php echo ADM_HERO_BASE_REGENERATION; ?><em class="tooltip">?<span class="classic"><?php echo ADM_HIT_POINTS_THE_HERO_RECOVERS_PER_DAY_INDEPEN; ?></span></em></td>
      <td><b><?php echo defined('HERO_BASE_REGEN') ? (int) HERO_BASE_REGEN : 10; ?></b><?php echo ADM_HP_DAY; ?></td>
    </tr>
    <tr>
      <td><?php echo ADM_HERO_EXCHANGE_RATES; ?><em class="tooltip">?<span class="classic"><?php echo ADM_RATES_OF_THE_EXCHANGE_OFFICE_IN_THE_AUCTION; ?></span></em></td>
      <td><?php echo ADM_1_GOLD; ?><b><?php echo defined('HERO_SILVER_PER_GOLD') ? (int) HERO_SILVER_PER_GOLD : 10; ?></b><?php echo ADM_SILVER_2; ?><b><?php echo defined('HERO_SILVER_TO_GOLD') ? (int) HERO_SILVER_TO_GOLD : 25; ?></b><?php echo ADM_SILVER_1_GOLD; ?></td>
    </tr>
    <tr>
      <td><?php echo ADM_HERO_RESOURCE_PRODUCTION; ?><em class="tooltip">?<span class="classic"><?php echo ADM_HOURLY_RESOURCES_PRODUCED_BY_EACH_POINT_THE; ?></span></em></td>
      <td><b><?php echo defined('HERO_RES_PER_POINT_ALL') ? (int) HERO_RES_PER_POINT_ALL : 3; ?></b><?php echo ADM_OF_EACH; ?><b><?php echo defined('HERO_RES_PER_POINT_ONE') ? (int) HERO_RES_PER_POINT_ONE : 10; ?></b><?php echo ADM_OF_ONE_TYPE; ?></td>
    </tr>
  </table>
</div>

<!-- CRON / AUTOMATION -->
<?php
// Starea reala a cron-ului, citita din markerul scris de cron.php la fiecare tick.
// Pragul de 90s e acelasi cu cel din GameEngine/Village.php: sub el, paginile
// jucatorilor NU mai declanseaza automation (il face cron-ul); peste el, paginile
// preiau automat ca fallback.
$cronMarkerFile = __DIR__ . '/../../GameEngine/Prevention/cron_active.txt';
$cronLastRun    = @is_file($cronMarkerFile) ? (int) @file_get_contents($cronMarkerFile) : 0;
$cronAge        = $cronLastRun > 0 ? (time() - $cronLastRun) : -1;
$cronActive     = ($cronAge >= 0 && $cronAge < 90);

$cronLoop = defined('CRON_LOOP_SECONDS') ? (int) CRON_LOOP_SECONDS : 300;
$cronTick = defined('CRON_TICK_SECONDS') ? (int) CRON_TICK_SECONDS : 60;
$cronKey  = defined('CRON_KEY') ? (string) CRON_KEY : '';

$cronBase = defined('HOMEPAGE') ? rtrim(HOMEPAGE, '/') : '';
$cronUrl  = ($cronBase !== '' && $cronKey !== '') ? $cronBase . '/cron.php?key=' . $cronKey : '';

$cleanReports  = defined('CLEANUP_REPORTS_DAYS')  ? (int) CLEANUP_REPORTS_DAYS  : 14;
$cleanChat     = defined('CLEANUP_CHAT_DAYS')     ? (int) CLEANUP_CHAT_DAYS     : 7;
$cleanMessages = defined('CLEANUP_MESSAGES_DAYS') ? (int) CLEANUP_MESSAGES_DAYS : 0;
$cleanupMarker = __DIR__ . '/../../GameEngine/Prevention/cleanup_last.txt';
$cleanupInfo   = @is_file($cleanupMarker) ? @json_decode((string) @file_get_contents($cleanupMarker), true) : null;

$cronPath = realpath(__DIR__ . '/../../cron.php');
$cronCmd  = $cronPath ? '*/5 * * * * /usr/local/bin/php ' . $cronPath . ' >/dev/null 2>&1' : '';

// cheia afisata mascat; se dezvaluie la cerere (evita expunerea in screenshot-uri)
$cronKeyMasked = ($cronKey === '')
    ? ''
    : (strlen($cronKey) > 12 ? substr($cronKey, 0, 6) . str_repeat('&bull;', 8) . substr($cronKey, -4) : str_repeat('&bull;', 8));
?>
<div class="config-card">
  <div class="config-head"><span><?php echo ADM_CRON_AUTOMATION; ?></span><a href="admin.php?p=editCronSet" title="<?php echo ADM_EDIT_CRON_AUTOMATION; ?>" class="edit-btn"><?php echo $editIcon; ?></a></div>
  <table class="config-table">
    <tr><td class="b"><?php echo SERV_VARIABLE ?></td><td class="b"><?php echo SERV_VALUE ?></td></tr>

    <tr>
      <td><?php echo ADM_AUTOMATION_SOURCE; ?><em class="tooltip">?<span class="classic"><?php echo ADM_WHERE_THE_GAME_TICK_BATTLES_MOVEMENTS_TRAINI; ?></span></em></td>
      <td><?php echo $cronActive
            ? "<span class='badge green'>Cron job</span>"
            : "<span class='badge red'>Page loads (fallback)</span>"; ?></td>
    </tr>

    <tr>
      <td><?php echo ADM_LAST_CRON_TICK; ?><em class="tooltip">?<span class="classic"><?php echo ADM_WRITTEN_BY_CRON_PHP_ON_EVERY_TICK_INTO_GAMEE; ?></span></em></td>
      <td><?php
            if ($cronLastRun > 0) {
                echo date('d.m.Y H:i:s', $cronLastRun) . ' <span style="color:#777">(' . $cronAge . 's ago)</span>';
            } else {
                echo "<span class='badge red'>Never</span>";
            }
          ?></td>
    </tr>

    <tr>
      <td><?php echo ADM_INVOCATION_LENGTH; ?><em class="tooltip">?<span class="classic"><?php echo ADM_CRON_LOOP_SECONDS_HOW_LONG_ONE_CRON_PHP_INVO; ?></span></em></td>
      <td><?php echo $cronLoop > 0
            ? $cronLoop . ' s <span style="color:#777">(' . (int) floor($cronLoop / max($cronTick, 1)) . ' ticks per invocation)</span>'
            : "<span class='badge blue'>Single tick</span>"; ?></td>
    </tr>

    <tr>
      <td><?php echo ADM_TICK_INTERVAL; ?><em class="tooltip">?<span class="classic"><?php echo ADM_CRON_TICK_SECONDS_HOW_OFTEN_AUTOMATION_RUNS; ?></span></em></td>
      <td><?php echo $cronTick; ?> s</td>
    </tr>

    <tr>
      <td><?php echo ADM_HTTP_TRIGGER_KEY; ?><em class="tooltip">?<span class="classic"><?php echo ADM_CRON_KEY_ONLY_NEEDED_TO_CALL_CRON_PHP_OVER_H; ?></span></em></td>
      <td><?php if ($cronKey === '') { ?>
            <span class='badge red'><?php echo ADM_NOT_SET; ?></span>
          <?php } else { ?>
            <span id="cronKeyMask"><?php echo $cronKeyMasked; ?></span>
            <span id="cronKeyFull" style="display:none;word-break:break-all"><?php echo htmlspecialchars($cronKey, ENT_QUOTES, 'UTF-8'); ?></span>
            <a href="#" style="margin-left:6px" onclick="var m=document.getElementById('cronKeyMask'),f=document.getElementById('cronKeyFull'),u=document.getElementById('cronUrlFull');var hidden=(f.style.display==='none');m.style.display=hidden?'none':'';f.style.display=hidden?'':'none';if(u){u.style.display=hidden?'':'none';}this.textContent=hidden?'hide':'show';return false;"><?php echo ADM_SHOW; ?></a>
          <?php } ?></td>
    </tr>

    <?php if ($cronUrl !== '') { ?>
    <tr>
      <td><?php echo ADM_HTTP_TRIGGER_URL; ?><em class="tooltip">?<span class="classic"><?php echo ADM_OPTIONAL_USE_THIS_WITH_AN_EXTERNAL_CRON_SERV; ?></span></em></td>
      <td><span style="color:#777"><?php echo ADM_HIDDEN_USE_SHOW_ABOVE; ?></span>
          <span id="cronUrlFull" style="display:none;word-break:break-all"><?php echo htmlspecialchars($cronUrl, ENT_QUOTES, 'UTF-8'); ?></span></td>
    </tr>
    <?php } ?>

    <tr>
      <td><?php echo ADM_DATABASE_CLEANUP; ?><em class="tooltip">?<span class="classic"><?php echo ADM_AUTOMATION_TRIMS_TABLES_THAT_WOULD_OTHERWISE; ?></span></em></td>
      <td><?php
            $parts = array();
            $parts[] = 'reports: ' . ($cleanReports > 0 ? $cleanReports . 'd' : 'off');
            $parts[] = 'chat: '    . ($cleanChat > 0 ? $cleanChat . 'd' : 'off');
            $parts[] = 'deleted messages: ' . ($cleanMessages > 0 ? $cleanMessages . 'd' : 'off');
            echo implode(' &nbsp;|&nbsp; ', $parts);
          ?></td>
    </tr>

    <tr>
      <td><?php echo ADM_LAST_CLEANUP_RUN; ?><em class="tooltip">?<span class="classic"><?php echo ADM_CLEANUP_RUNS_ONCE_PER_HOUR_FROM_AUTOMATION_A; ?></span></em></td>
      <td><?php
            if (is_array($cleanupInfo) && !empty($cleanupInfo['time'])) {
                $r = isset($cleanupInfo['removed']) ? $cleanupInfo['removed'] : array();
                echo date('d.m.Y H:i:s', (int) $cleanupInfo['time'])
                   . ' <span style="color:#777">(' . (int) ($r['reports'] ?? 0) . ' reports, '
                   . (int) ($r['chat'] ?? 0) . ' chat, '
                   . (int) ($r['messages'] ?? 0) . ' messages)</span>';
            } else {
                echo "<span class='badge blue'>Not run yet</span>";
            }
          ?></td>
    </tr>

    <?php if ($cronCmd !== '') { ?>
    <tr>
      <td><?php echo ADM_CRON_JOB_COMMAND; ?><em class="tooltip">?<span class="classic"><?php echo ADM_ADD_THIS_IN_CPANEL_CRON_JOBS_THE_PATH_IS_DET; ?></span></em></td>
      <td style="word-break:break-all"><code><?php echo htmlspecialchars($cronCmd, ENT_QUOTES, 'UTF-8'); ?></code></td>
    </tr>
    <?php } ?>
  </table>
</div>

<!-- NEW FUNCTIONS -->
<div class="config-card">
  <div class="config-head"><span><?php echo ADM_NEW_MECHANICS_AND_FUNCTIONS; ?></span><a href="admin.php?p=editNewFunctions" title="<?php echo ADM_EDIT_NEW_MECHANICS_AND_FUNCTIONS; ?>" class="edit-btn"><?php echo $editIcon; ?></a></div>
  <table class="config-table">
    <tr><td class="b"><?php echo SERV_VARIABLE ?></td><td class="b"><?php echo SERV_VALUE ?></td></tr>
    <tr><td><?php echo ADM_DISPLAY_OASIS_IN_PROFILE; ?><em class="tooltip">?<span class="classic"><?php echo ADM_ENABLE_DISABLE_THE_DISPLAY_OF_OASES_OF_EACH; ?></span></em></td><td><?php echo NEW_FUNCTIONS_OASIS ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
    <tr><td><?php echo ADM_ALLIANCE_INVITATION_MESSAGE; ?><em class="tooltip">?<span class="classic"><?php echo ADM_ENABLE_DISABLE_SENDING_AN_IN_GAME_MESSAGE_TO; ?></span></em></td><td><?php echo NEW_FUNCTIONS_ALLIANCE_INVITATION ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
    <tr><td><?php echo ADM_NEW_ALLIANCE_EMBASSY_MECHANICS; ?><em class="tooltip">?<span class="classic">https://github.com/Shadowss/TravianZ/wiki/New-Alliance-&-Embassy-Mechanics</span></em></td><td><?php echo NEW_FUNCTIONS_EMBASSY_MECHANICS ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
    <tr><td><?php echo ADM_NEW_FORUM_POST_MESSAGE; ?><em class="tooltip">?<span class="classic"><?php echo ADM_ENABLE_DISABLE_FORUM_SUBSCRIPTION_MESSAGES; ?></span></em></td><td><?php echo NEW_FUNCTIONS_FORUM_POST_MESSAGE ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
    <tr><td><?php echo ADM_TRIBES_IMAGES_IN_PROFILE; ?><em class="tooltip">?<span class="classic"><?php echo ADM_ENABLE_DISABLE_DISPLAYING_IMAGES_OF_TRIBES; ?></span></em></td><td><?php echo NEW_FUNCTIONS_TRIBE_IMAGES ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
    <tr><td><?php echo ADM_NEW_TRIBE_HUNS; ?><em class="tooltip">?<span class="classic"><?php echo ADM_ENABLE_DISABLE_THE_HUNS_TRIBE; ?></span></em></td><td><?php echo (defined('NEW_FUNCTION_TRIBE_HUNS') && NEW_FUNCTION_TRIBE_HUNS) ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
    <tr><td><?php echo ADM_NEW_TRIBE_EGYPTIANS; ?><em class="tooltip">?<span class="classic"><?php echo ADM_ENABLE_DISABLE_THE_EGYPTIANS_TRIBE; ?></span></em></td><td><?php echo (defined('NEW_FUNCTION_TRIBE_EGIPTEANS') && NEW_FUNCTION_TRIBE_EGIPTEANS) ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
    <tr><td><?php echo ADM_NEW_TRIBE_SPARTANS; ?><em class="tooltip">?<span class="classic"><?php echo ADM_ENABLE_DISABLE_THE_SPARTANS_TRIBE; ?></span></em></td><td><?php echo (defined('NEW_FUNCTION_TRIBE_SPARTANS') && NEW_FUNCTION_TRIBE_SPARTANS) ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
    <tr><td><?php echo ADM_NEW_TRIBE_VIKINGS; ?><em class="tooltip">?<span class="classic"><?php echo ADM_ENABLE_DISABLE_THE_VIKINGS_TRIBE; ?></span></em></td><td><?php echo (defined('NEW_FUNCTION_TRIBE_VIKINGS') && NEW_FUNCTION_TRIBE_VIKINGS) ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
    <tr><td><?php echo ADM_MHS_IMAGES_IN_PROFILE; ?><em class="tooltip">?<span class="classic"><?php echo ADM_ENABLE_DISABLE_DISPLAYING_IMAGES_OF_MULTIHUN; ?></span></em></td><td><?php echo NEW_FUNCTIONS_MHS_IMAGES ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
    <tr><td><?php echo ADM_DISPLAY_ARTIFACT_IN_PROFILE; ?><em class="tooltip">?<span class="classic"><?php echo ADM_ENABLE_DISABLE_THE_DISPLAY_OF_THE_ARTIFACT; ?></span></em></td><td><?php echo NEW_FUNCTIONS_DISPLAY_ARTIFACT ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
    <tr><td><?php echo ADM_DISPLAY_WOW_IN_PROFILE; ?><em class="tooltip">?<span class="classic"><?php echo ADM_ENABLE_DISABLE_THE_DISPLAY_OF_THE_WONDER; ?></span></em></td><td><?php echo NEW_FUNCTIONS_DISPLAY_WONDER ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
    <tr><td><?php echo ADM_VACATION_MODE; ?><em class="tooltip">?<span class="classic"><?php echo ADM_ENABLE_DISABLE_VACATION_MODE; ?></span></em></td><td><?php echo NEW_FUNCTIONS_VACATION ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
    <tr><td><?php echo ADM_CATAPULT_TARGETS; ?><em class="tooltip">?<span class="classic"><?php echo ADM_ENABLE_DISABLE_THE_DISPLAY_OF_CATAPULT_TARGE; ?></span></em></td><td><?php echo NEW_FUNCTIONS_DISPLAY_CATAPULT_TARGET ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
    <tr><td><?php echo ADM_MANUAL_ON_NATURE_AND_NATARS; ?><em class="tooltip">?<span class="classic"><?php echo ADM_ENABLE_DISABLE_MANUAL_INFO; ?></span></em></td><td><?php echo NEW_FUNCTIONS_MANUAL_NATURENATARS ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
    <tr><td><?php echo ADM_DIRECT_LINKS_PLACEMENT; ?><em class="tooltip">?<span class="classic"><?php echo ADM_LEFT_MENU_VS_RIGHT_MENU; ?></span></em></td><td><?php echo NEW_FUNCTIONS_DISPLAY_LINKS ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
    <tr><td><?php echo ADM_MEDAL_VETERAN_PLAYER; ?><em class="tooltip">?<span class="classic"><?php echo ADM_3_YEARS; ?></span></em></td><td><?php echo NEW_FUNCTIONS_MEDAL_3YEAR ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
    <tr><td><?php echo ADM_MEDAL_VETERAN_PLAYER_5A; ?><em class="tooltip">?<span class="classic"><?php echo ADM_5_YEARS; ?></span></em></td><td><?php echo NEW_FUNCTIONS_MEDAL_5YEAR ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
    <tr><td><?php echo ADM_MEDAL_VETERAN_PLAYER_10A; ?><em class="tooltip">?<span class="classic"><?php echo ADM_10_YEARS; ?></span></em></td><td><?php echo NEW_FUNCTIONS_MEDAL_10YEAR ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
	<tr><td><?php echo ADM_SPECIAL_MEDALS; ?><em class="tooltip">?<span class="classic"><?php echo ADM_SPECIAL_MEDALS; ?></span></em></td><td><?php echo NEW_FUNCTIONS_SPECIAL_MEDALS_SYSTEM ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
	<tr><td><?php echo ADM_SERVER_MILESTONES; ?><em class="tooltip">?<span class="classic"><?php echo ADM_SERVER_MILESTONES; ?></span></em></td><td><?php echo NEW_FUNCTIONS_MILESTONES ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
	<tr><td><?php echo ADM_SERVER_MEDAL_RESET_TIMER; ?><em class="tooltip">?<span class="classic"><?php echo ADM_SERVER_MEDAL_RESET_TIMER; ?></span></em></td><td><?php echo NEW_FUNCTIONS_MEDAL_RESET ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
	<tr><td><?php echo ADM_T4_HERO_ITEMS_ADVENTURES_AUCTION; ?><em class="tooltip">?<span class="classic"><?php echo ADM_T4_HERO_ITEMS_ADVENTURES_AUCTION; ?></span></em></td><td><?php echo NEW_FUNCTIONS_HERO_T4 ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
	<tr><td><?php echo ADM_REGISTRATION_BONUS_GOLD; ?><em class="tooltip">?<span class="classic"><?php echo ADM_GIVE_EVERY_NEWLY_REGISTERED_PLAYER_A_ONE_TIM; ?></span></em></td><td><?php echo (defined('NEW_FUNCTION_REGISTRATION_GOLD') && NEW_FUNCTION_REGISTRATION_GOLD) ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
	<tr><td><?php echo ADM_REGISTRATION_BONUS_GOLD_AMOUNT; ?><em class="tooltip">?<span class="classic"><?php echo ADM_HOW_MUCH_GOLD_EACH_NEW_PLAYER_RECEIVES_WHEN; ?></span></em></td><td><?php echo (defined('NEW_FUNCTION_REGISTRATION_GOLD_VALUE') ? (int) NEW_FUNCTION_REGISTRATION_GOLD_VALUE : 200); ?></td></tr>
	<tr><td><?php echo ADM_ALLIANCE_BONUSES; ?> <em class="tooltip">?<span class="classic"><?php echo ADM_ALLIANCE_BONUSES_TIP; ?></span></em></td><td><b><?php echo (defined('NEW_FUNCTIONS_ALLIANCE_BONUSES') && NEW_FUNCTIONS_ALLIANCE_BONUSES) ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></b></td></tr>
  </table>
</div>

<!-- PLUS -->
<div class="config-card">
  <div class="config-head"><span><?php echo PLUS_SETT ?></span><a href="admin.php?p=editPlusSet" title="<?php echo EDIT_PLUS_SETT1 ?>" class="edit-btn"><?php echo $editIcon; ?></a></div>
  <table class="config-table">
    <tr><td><?php echo CONF_PLUS_PAYPALEMAIL ?> <em class="tooltip">?<span class="classic"><?php echo CONF_PLUS_PAYPALEMAIL_TOOLTIP ?></span></em></td><td><?php echo (defined('PAYPAL_EMAIL') ? PAYPAL_EMAIL : 'martin@martinambrus.com'); ?></td></tr>
    <tr><td><?php echo CONF_PLUS_CURRENCY ?> <em class="tooltip">?<span class="classic"><?php echo CONF_PLUS_CURRENCY_TOOLTIP ?></span></em></td><td><?php echo (defined('PAYPAL_CURRENCY') ? PAYPAL_CURRENCY : 'EUR'); ?></td></tr>
    <tr><td><?php echo CONF_PLUS_PACKAGEGOLDA ?> <em class="tooltip">?<span class="classic"><?php echo CONF_PLUS_PACKAGEGOLDA_TOOLTIP ?></span></em></td><td><?php echo (defined('PLUS_PACKAGE_A_GOLD') ? PLUS_PACKAGE_A_GOLD : 60); ?></td></tr>
    <tr><td><?php echo CONF_PLUS_PACKAGEPRICEA ?> <em class="tooltip">?<span class="classic"><?php echo CONF_PLUS_PACKAGEPRICEA_TOOLTIP ?></span></em></td><td><?php echo (defined('PLUS_PACKAGE_A_PRICE') ? PLUS_PACKAGE_A_PRICE : '1,99') . ' ' . (defined('PAYPAL_CURRENCY') ? PAYPAL_CURRENCY : 'EUR'); ?></td></tr>
    <tr><td><?php echo CONF_PLUS_PACKAGEGOLDB ?> <em class="tooltip">?<span class="classic"><?php echo CONF_PLUS_PACKAGEGOLDB_TOOLTIP ?></span></em></td><td><?php echo (defined('PLUS_PACKAGE_B_GOLD') ? PLUS_PACKAGE_B_GOLD : 120); ?></td></tr>
    <tr><td><?php echo CONF_PLUS_PACKAGEPRICEB ?> <em class="tooltip">?<span class="classic"><?php echo CONF_PLUS_PACKAGEPRICEB_TOOLTIP ?></span></em></td><td><?php echo (defined('PLUS_PACKAGE_B_PRICE') ? PLUS_PACKAGE_B_PRICE : '4,99') . ' ' . (defined('PAYPAL_CURRENCY') ? PAYPAL_CURRENCY : 'EUR'); ?></td></tr>
    <tr><td><?php echo CONF_PLUS_PACKAGEGOLDC ?> <em class="tooltip">?<span class="classic"><?php echo CONF_PLUS_PACKAGEGOLDC_TOOLTIP ?></span></em></td><td><?php echo (defined('PLUS_PACKAGE_C_GOLD') ? PLUS_PACKAGE_C_GOLD : 360); ?></td></tr>
    <tr><td><?php echo CONF_PLUS_PACKAGEPRICEC ?> <em class="tooltip">?<span class="classic"><?php echo CONF_PLUS_PACKAGEPRICEC_TOOLTIP ?></span></em></td><td><?php echo (defined('PLUS_PACKAGE_C_PRICE') ? PLUS_PACKAGE_C_PRICE : '9,99') . ' ' . (defined('PAYPAL_CURRENCY') ? PAYPAL_CURRENCY : 'EUR'); ?></td></tr>
    <tr><td><?php echo CONF_PLUS_PACKAGEGOLDD ?> <em class="tooltip">?<span class="classic"><?php echo CONF_PLUS_PACKAGEGOLDD_TOOLTIP ?></span></em></td><td><?php echo (defined('PLUS_PACKAGE_D_GOLD') ? PLUS_PACKAGE_D_GOLD : 1000); ?></td></tr>
    <tr><td><?php echo CONF_PLUS_PACKAGEPRICED ?> <em class="tooltip">?<span class="classic"><?php echo CONF_PLUS_PACKAGEPRICED_TOOLTIP ?></span></em></td><td><?php echo (defined('PLUS_PACKAGE_D_PRICE') ? PLUS_PACKAGE_D_PRICE : '19,99') . ' ' . (defined('PAYPAL_CURRENCY') ? PAYPAL_CURRENCY : 'EUR'); ?></td></tr>
    <tr><td><?php echo CONF_PLUS_PACKAGEGOLDE ?> <em class="tooltip">?<span class="classic"><?php echo CONF_PLUS_PACKAGEGOLDE_TOOLTIP ?></span></em></td><td><?php echo (defined('PLUS_PACKAGE_E_GOLD') ? PLUS_PACKAGE_E_GOLD : 2000); ?></td></tr>
    <tr><td><?php echo CONF_PLUS_PACKAGEPRICEE ?> <em class="tooltip">?<span class="classic"><?php echo CONF_PLUS_PACKAGEPRICEE_TOOLTIP ?></span></em></td><td><?php echo (defined('PLUS_PACKAGE_E_PRICE') ? PLUS_PACKAGE_E_PRICE : '49,99') . ' ' . (defined('PAYPAL_CURRENCY') ? PAYPAL_CURRENCY : 'EUR'); ?></td></tr>
    <tr><td><?php echo CONF_PLUS_ACCDURATION ?> <em class="tooltip">?<span class="classic"><?php echo CONF_PLUS_ACCDURATION_TOOLTIP ?></span></em></td><td><?php echo PLUS_TIME >= 86400 ? (PLUS_TIME/86400).' Days' : (PLUS_TIME/3600).' Hours'; ?></td></tr>
    <tr><td><?php echo CONF_PLUS_PRODUCTDURATION ?> <em class="tooltip">?<span class="classic"><?php echo CONF_PLUS_PRODUCTDURATION_TOOLTIP ?></span></em></td><td><?php echo PLUS_PRODUCTION >= 86400 ? (PLUS_PRODUCTION/86400).' Days' : (PLUS_PRODUCTION/3600).' Hours'; ?></td></tr>
  </table>
</div>

<!-- LOG -->
<div class="config-card">
  <div class="config-head"><span><?php echo LOG_SETT ?></span><a href="admin.php?p=editLogSet" title="<?php echo EDIT_LOG_SETT ?>" class="edit-btn"><?php echo $editIcon; ?></a></div>
  <table class="config-table">
    <tr><td class="b"><?php echo SERV_VARIABLE ?></td><td class="b"><?php echo SERV_VALUE ?></td></tr>
    <tr><td><?php echo CONF_LOG_BUILD ?> <em class="tooltip">?<span class="classic"><?php echo CONF_LOG_BUILD_TOOLTIP ?></span></em></td><td><?php echo LOG_BUILD ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
    <tr><td><?php echo CONF_LOG_TECHNOLOGY ?> <em class="tooltip">?<span class="classic"><?php echo CONF_LOG_TECHNOLOGY_TOOLTIP ?></span></em></td><td><?php echo LOG_TECH ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
    <tr><td><?php echo CONF_LOG_LOGIN ?> <em class="tooltip">?<span class="classic"><?php echo CONF_LOG_LOGIN_TOOLTIP ?></span></em></td><td><?php echo LOG_LOGIN ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
    <tr><td><?php echo CONF_LOG_GOLD ?> <em class="tooltip">?<span class="classic"><?php echo CONF_LOG_GOLD_TOOLTIP ?></span></em></td><td><?php echo LOG_GOLD_FIN ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
    <tr><td><?php echo CONF_LOG_ADMIN ?> <em class="tooltip">?<span class="classic"><?php echo CONF_LOG_ADMIN_TOOLTIP ?></span></em></td><td><?php echo LOG_ADMIN ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
    <tr><td><?php echo CONF_LOG_WAR ?> <em class="tooltip">?<span class="classic"><?php echo CONF_LOG_WAR_TOOLTIP ?></span></em></td><td><?php echo LOG_WAR ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
    <tr><td><?php echo CONF_LOG_MARKET ?> <em class="tooltip">?<span class="classic"><?php echo CONF_LOG_MARKET_TOOLTIP ?></span></em></td><td><?php echo LOG_MARKET ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
    <tr><td><?php echo CONF_LOG_ILLEGAL ?> <em class="tooltip">?<span class="classic"><?php echo CONF_LOG_ILLEGAL_TOOLTIP ?></span></em></td><td><?php echo LOG_ILLEGAL ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
  </table>
</div>

<!-- NEWSBOX -->
<div class="config-card">
  <div class="config-head"><span><?php echo NEWSBOX_SETT ?></span><a href="admin.php?p=editNewsboxSet" title="<?php echo EDIT_NEWSBOX_SETT ?>" class="edit-btn"><?php echo $editIcon; ?></a></div>
  <table class="config-table">
    <tr><td class="b"><?php echo SERV_VARIABLE ?></td><td class="b"><?php echo SERV_VALUE ?></td></tr>
    <tr><td><?php echo EDIT_NEWSBOX1 ?> <em class="tooltip">?<span class="classic"><?php echo EDIT_NEWSBOX1_TOOLTIP ?></span></em></td><td><?php echo NEWSBOX1 ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
    <tr><td><?php echo EDIT_NEWSBOX2 ?> <em class="tooltip">?<span class="classic"><?php echo EDIT_NEWSBOX2_TOOLTIP ?></span></em></td><td><?php echo NEWSBOX2 ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
    <tr><td><?php echo EDIT_NEWSBOX3 ?> <em class="tooltip">?<span class="classic"><?php echo EDIT_NEWSBOX3_TOOLTIP ?></span></em></td><td><?php echo NEWSBOX3 ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
  </table>
</div>

<!-- SQL -->
<div class="config-card">
  <div class="config-head"><span><?php echo SQL_SETTINGS ?></span></div>
  <table class="config-table">
    <tr><td class="b"><?php echo SERV_VARIABLE ?></td><td class="b"><?php echo SERV_VALUE ?></td></tr>
    <tr><td><?php echo CONF_SQL_HOSTNAME ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SQL_HOSTNAME_TOOLTIP ?></span></em></td><td><?php echo SQL_SERVER;?></td></tr>
    <tr><td><?php echo CONF_SQL_PORT ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SQL_PORT_TOOLTIP ?></span></em></td><td><?php echo SQL_PORT;?></td></tr>
    <tr><td><?php echo CONF_SQL_DBUSER ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SQL_DBUSER_TOOLTIP ?></span></em></td><td><?php echo SQL_USER;?></td></tr>
    <tr><td><?php echo CONF_SQL_DBPASS ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SQL_DBPASS_TOOLTIP ?></span></em></td><td>*********</td></tr>
    <tr><td><?php echo CONF_SQL_DBNAME ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SQL_DBNAME_TOOLTIP ?></span></em></td><td><?php echo SQL_DB;?></td></tr>
    <tr><td><?php echo CONF_SQL_TBPREFIX ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SQL_TBPREFIX_TOOLTIP ?></span></em></td><td><?php echo TB_PREFIX;?></td></tr>
    <tr><td><?php echo CONF_SQL_DBTYPE ?> <em class="tooltip">?<span class="classic"><?php echo CONF_SQL_DBTYPE_TOOLTIP ?></span></em></td><td><?php echo DB_TYPE == 0 ? "MYSQL" : "MYSQLi"; ?></td></tr>
  </table>
</div>

<!-- EXTRA -->
<div class="config-card">
  <div class="config-head"><span><?php echo EXTRA_SETT ?></span><a href="admin.php?p=editExtraSet" title="<?php echo EDIT_EXTRA_SETT ?>" class="edit-btn"><?php echo $editIcon; ?></a></div>
  <table class="config-table">
    <tr><td class="b"><?php echo SERV_VARIABLE ?></td><td class="b"><?php echo SERV_VALUE ?></td></tr>
    <tr><td><?php echo CONF_EXTRA_LIMITMAIL ?> <em class="tooltip">?<span class="classic"><?php echo CONF_EXTRA_LIMITMAIL_TOOLTIP ?></span></em></td><td><?php echo LIMIT_MAILBOX ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
    <tr><td><?php echo CONF_EXTRA_MAXMAIL ?> <em class="tooltip">?<span class="classic"><?php echo CONF_EXTRA_MAXMAIL_TOOLTIP ?></span></em></td><td><?php echo LIMIT_MAILBOX ? MAX_MAIL : "<span class='badge gray'>Limit mailbox disabled</span>"; ?></td></tr>
  </table>
</div>

<!-- ADMIN INFO -->
<div class="config-card">
  <div class="config-head"><span><?php echo ADMIN_INFO ?></span><a href="admin.php?p=editAdminInfo" title="<?php echo EDIT_ADMIN_INFO ?>" class="edit-btn"><?php echo $editIcon; ?></a></div>
  <table class="config-table">
    <tr><td class="b"><?php echo SERV_VARIABLE ?></td><td class="b"><?php echo SERV_VALUE ?></td></tr>
    <tr><td><?php echo CONF_ADMIN_NAME ?> <em class="tooltip">?<span class="classic"><?php echo CONF_ADMIN_NAME_TOOLTIP ?></span></em></td><td><?php echo empty(ADMIN_NAME) ? "<span class='badge red'>No admin name defined!</span>" : ADMIN_NAME; ?></td></tr>
    <tr><td><?php echo CONF_ADMIN_EMAIL ?> <em class="tooltip">?<span class="classic"><?php echo CONF_ADMIN_EMAIL_TOOLTIP ?></span></em></td><td><?php echo empty(ADMIN_EMAIL) ? "<span class='badge red'>No admin email defined!</span>" : ADMIN_EMAIL; ?></td></tr>
    <tr><td><?php echo CONF_ADMIN_SHOWSTATS ?> <em class="tooltip">?<span class="classic"><?php echo CONF_ADMIN_SHOWSTATS_TOOLTIP ?></span></em></td><td><?php echo INCLUDE_ADMIN ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
    <tr><td><?php echo CONF_ADMIN_SUPPMESS ?> <em class="tooltip">?<span class="classic"><?php echo CONF_ADMIN_SUPPMESS_TOOLTIP ?></span></em></td><td><?php echo ADMIN_RECEIVE_SUPPORT_MESSAGES ? "<span class='badge green'>Enabled</span>" : "<span class='badge red'>Disabled</span>"; ?></td></tr>
    <tr><td><?php echo CONF_ADMIN_RAIDATT ?> <em class="tooltip">?<span class="classic"><?php echo CONF_ADMIN_RAIDATT_TOOLTIP ?></span></em></td><td><?php echo ADMIN_ALLOW_INCOMING_RAIDS ? "<span class='badge green'>Yes</span>" : "<span class='badge red'>No</span>"; ?></td></tr>
  </table>
</div>

</div>
<?php
function define_array($array, $keys = null){
	foreach($array as $key => $value){
		$keyname = ($keys ? $keys."_" : "").$key;
		if(is_array($array[$key])) define_array($array[$key], $keyname);
		else define($keyname, $value);
	}
}
?>