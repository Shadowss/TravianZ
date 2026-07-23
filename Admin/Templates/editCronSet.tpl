<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : editCronSet.tpl                                           ##
##  Type           : Admin Panel Frontend                                      ##
## --------------------------------------------------------------------------- ##
##  Contact        : cata7007@gmail.com                                        ##
##  Project        : TravianZ                                                  ##
##  GitHub         : https://github.com/Shadowss/TravianZ                      ##
## --------------------------------------------------------------------------- ##
##  License        : TravianZ Project                                          ##
##  Copyright      : TravianZ (c) 2010-2026. All rights reserved.              ##
## --------------------------------------------------------------------------- ##
#################################################################################
if (!isset($_SESSION)) {
    session_start();
}
if ($_SESSION['access'] < 9) die(ACCESS_DENIED_ADMIN);

$cronMarkerFile = __DIR__ . '/../../GameEngine/Prevention/cron_active.txt';
$cronLastRun    = @is_file($cronMarkerFile) ? (int) @file_get_contents($cronMarkerFile) : 0;
$cronAge        = $cronLastRun > 0 ? (time() - $cronLastRun) : -1;
$cronActive     = ($cronAge >= 0 && $cronAge < 90);

$cronLoop = defined('CRON_LOOP_SECONDS') ? (int) CRON_LOOP_SECONDS : 300;
$cronTick = defined('CRON_TICK_SECONDS') ? (int) CRON_TICK_SECONDS : 60;
$cronKey  = defined('CRON_KEY') ? (string) CRON_KEY : '';

$cleanReports  = defined('CLEANUP_REPORTS_DAYS')  ? (int) CLEANUP_REPORTS_DAYS  : 14;
$cleanChat     = defined('CLEANUP_CHAT_DAYS')     ? (int) CLEANUP_CHAT_DAYS     : 7;
$cleanMessages = defined('CLEANUP_MESSAGES_DAYS') ? (int) CLEANUP_MESSAGES_DAYS : 0;

$cleanupMarker = __DIR__ . '/../../GameEngine/Prevention/cleanup_last.txt';
$cleanupInfo   = @is_file($cleanupMarker) ? @json_decode((string) @file_get_contents($cleanupMarker), true) : null;

$cronPath = realpath(__DIR__ . '/../../cron.php');
$cronCmd  = $cronPath ? '*/5 * * * * /usr/local/bin/php ' . $cronPath . ' >> ' . dirname(dirname($cronPath)) . '/cron.log 2>&1' : '';
?>
<style>
.config-wrap{max-width:1100px;margin:0 auto;font-family:system-ui,-apple-system,Segoe UI,Roboto}
.config-title{text-align:center;font-size:20px;font-weight:800;margin:8px 0 12px;color:#ffffff}
.config-card{background:#fff;border:1px solid #e5e7eb;border-radius:8px;margin-bottom:10px;overflow:hidden;box-shadow:0 1px 2px rgba(0,0,0,.04)}
.config-head{display:flex;justify-content:space-between;align-items:center;padding:7px 10px;background:#0f172a;color:#fff;font-weight:600;font-size:13px;line-height:1}
.config-table{width:100%;border-collapse:collapse}
.config-table tr{border-top:1px solid #f1f5f9}
.config-table tr:first-child{border-top:0}
.config-table td{padding:6px 8px;vertical-align:middle;font-size:13px;line-height:1.3}
.config-table td.b{background:#f8fafc;font-weight:700;color:#334155;width:45%}
.config-table td:last-child{color:#0f172a}
.fm{border:1px solid #cbd5e1;border-radius:5px;padding:5px 7px;font-size:13px}
.hint{display:block;color:#64748b;font-size:11px;margin-top:3px;font-weight:400}
.badge{display:inline-block;padding:2px 7px;border-radius:10px;font-size:11px;font-weight:700}
.badge.green{background:#dcfce7;color:#166534}
.badge.red{background:#fee2e2;color:#991b1b}
.badge.blue{background:#dbeafe;color:#1e40af}
.tooltip{position:relative;cursor:help;color:#64748b;border:1px solid #cbd5e1;border-radius:50%;padding:0 5px;font-size:10px;font-style:normal}
.tooltip span{display:none;position:absolute;left:20px;top:-4px;width:280px;background:#0f172a;color:#fff;padding:7px 9px;border-radius:6px;font-size:11px;z-index:9;line-height:1.4}
.tooltip:hover span{display:block}
.config-actions{display:flex;justify-content:space-between;align-items:center;margin-top:12px}
.btn-back,.btn-save{display:inline-flex;align-items:center;gap:6px;padding:7px 14px;border-radius:6px;font-weight:600;font-size:13px;text-decoration:none;cursor:pointer;transition:.15s;border:1px solid transparent}
.btn-back{background:#f1f5f9;color:#0f172a;border-color:#e5e7eb}
.btn-back:hover{background:#e2e8f0}
.btn-save{background:#0f172a;color:#fff;box-shadow:0 1px 2px rgba(0,0,0,.08)}
.btn-save:hover{background:#1e293b;transform:translateY(-1px)}
.btn-save svg{width:14px;height:14px}
code{background:#f1f5f9;padding:2px 5px;border-radius:4px;font-size:11px;word-break:break-all}
</style>

<div class="config-wrap">
    <div class="config-title">Cron &amp; Automation</div>

    <form action="../GameEngine/Admin/Mods/editCronSet.php" method="POST">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="id" id="id" value="<?php echo $_SESSION['id']; ?>">

        <div class="config-card">
            <div class="config-head"><span>Current status</span></div>
            <table class="config-table">
                <tr>
                    <td class="b">Automation source</td>
                    <td><?php echo $cronActive
                            ? "<span class='badge green'>Cron job</span>"
                            : "<span class='badge red'>Page loads (fallback)</span>"; ?>
                        <span class="hint">When the cron job is not running, the game still works: players' page loads process the tick, exactly as before the cron was introduced.</span></td>
                </tr>
                <tr>
                    <td class="b">Last cron tick</td>
                    <td><?php
                        if ($cronLastRun > 0) {
                            echo date('d.m.Y H:i:s', $cronLastRun) . ' <span style="color:#777">(' . $cronAge . 's ago)</span>';
                        } else {
                            echo "<span class='badge red'>Never</span>";
                        }
                        ?></td>
                </tr>
                <?php if ($cronCmd !== '') { ?>
                <tr>
                    <td class="b">Cron job command</td>
                    <td><code><?php echo htmlspecialchars($cronCmd, ENT_QUOTES, 'UTF-8'); ?></code>
                        <span class="hint">Add this in cPanel &rarr; Cron Jobs. Writing to cron.log instead of /dev/null lets you see errors if it fails to start.</span></td>
                </tr>
                <?php } ?>
            </table>
        </div>

        <div class="config-card">
            <div class="config-head"><span>Settings</span></div>
            <table class="config-table">
                <tr>
                    <td class="b">Invocation length (seconds)
                        <em class="tooltip">?<span>How long one cron.php invocation keeps working. Most shared hosts only allow a cron every 5 minutes, while Automation expects to run about every minute &mdash; so one invocation runs several ticks in a row. Use 300 for a "*/5" cron. Set 0 only if your host allows a cron every minute.</span></em>
                    </td>
                    <td><input class="fm" type="number" name="cron_loop" min="0" max="3300" value="<?php echo $cronLoop; ?>" style="width:120px">
                        <span class="hint">0 = a single tick per invocation. Maximum 3300 (55 minutes).</span></td>
                </tr>
                <tr>
                    <td class="b">Tick interval (seconds)
                        <em class="tooltip">?<span>How often Automation runs inside one invocation. Automation's own guard expects roughly 60 seconds; going lower mostly adds load without processing anything new.</span></em>
                    </td>
                    <td><input class="fm" type="number" name="cron_tick" min="15" max="900" value="<?php echo $cronTick; ?>" style="width:120px">
                        <span class="hint">Recommended: 60. Allowed range 15&ndash;900.</span></td>
                </tr>
                <tr>
                    <td class="b">HTTP trigger key
                        <em class="tooltip">?<span>Only needed when calling cron.php over HTTP (for example from an external cron service). The server's own cron job does not use it. Regenerating invalidates any URL you configured elsewhere.</span></em>
                    </td>
                    <td>
                        <?php if ($cronKey === '') { ?>
                            <span class="badge red">Not set</span> &ndash; one will be generated on save.
                        <?php } else { ?>
                            <span id="k1"><?php echo htmlspecialchars(substr($cronKey, 0, 6), ENT_QUOTES, 'UTF-8'); ?>&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;<?php echo htmlspecialchars(substr($cronKey, -4), ENT_QUOTES, 'UTF-8'); ?></span>
                            <span id="k2" style="display:none;word-break:break-all"><?php echo htmlspecialchars($cronKey, ENT_QUOTES, 'UTF-8'); ?></span>
                            <a href="#" style="margin-left:6px" onclick="var a=document.getElementById('k1'),b=document.getElementById('k2');var h=(b.style.display==='none');a.style.display=h?'none':'';b.style.display=h?'':'none';this.textContent=h?'hide':'show';return false;">show</a>
                        <?php } ?>
                        <span class="hint"><label><input type="checkbox" name="regenerate_key" value="1"> Generate a new key on save</label></span>
                    </td>
                </tr>
            </table>
        </div>

        <div class="config-card">
            <div class="config-head"><span>Database cleanup</span></div>
            <table class="config-table">
                <tr>
                    <td class="b">Last cleanup run</td>
                    <td><?php
                        if (is_array($cleanupInfo) && !empty($cleanupInfo['time'])) {
                            $r = isset($cleanupInfo['removed']) ? $cleanupInfo['removed'] : array();
                            echo date('d.m.Y H:i:s', (int) $cleanupInfo['time']);
                            echo ' <span style="color:#777">(removed: '
                               . (int) ($r['reports'] ?? 0) . ' reports, '
                               . (int) ($r['chat'] ?? 0) . ' chat, '
                               . (int) ($r['messages'] ?? 0) . ' messages)</span>';
                        } else {
                            echo "<span class='badge blue'>Not run yet</span>";
                        }
                        ?>
                        <span class="hint">Runs from Automation once per hour. Rows are removed in batches, so the first run on an old server catches up over several passes.</span></td>
                </tr>
                <tr>
                    <td class="b">Battle reports (days)
                        <em class="tooltip">?<span>Unarchived reports older than this are deleted. Reports a player archived are never touched. 0 disables the rule.</span></em>
                    </td>
                    <td><input class="fm" type="number" name="cleanup_reports" min="0" max="3650" value="<?php echo $cleanReports; ?>" style="width:100px">
                        <span class="hint">0 = keep forever.</span></td>
                </tr>
                <tr>
                    <td class="b">Chat messages (days)
                        <em class="tooltip">?<span>The chat window only ever shows the last 13 messages per alliance, so older history is not used anywhere in the game.</span></em>
                    </td>
                    <td><input class="fm" type="number" name="cleanup_chat" min="0" max="3650" value="<?php echo $cleanChat; ?>" style="width:100px">
                        <span class="hint">0 = keep forever.</span></td>
                </tr>
                <tr>
                    <td class="b">Deleted messages (days)
                        <em class="tooltip">?<span>Only messages deleted by BOTH the sender and the recipient are removed &mdash; they are no longer visible to anyone in the game. Disabled by default.</span></em>
                    </td>
                    <td><input class="fm" type="number" name="cleanup_messages" min="0" max="3650" value="<?php echo $cleanMessages; ?>" style="width:100px">
                        <span class="hint">0 = disabled (default).</span></td>
                </tr>
            </table>
        </div>

        <div class="config-actions">
            <a href="../Admin/admin.php?p=config" class="btn-back">&lsaquo; <?php echo EDIT_BACK ?></a>
            <button type="submit" class="btn-save">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                    <polyline points="17 21 17 13 7 13 7 21"/>
                </svg>
                SAVE
            </button>
        </div>
    </form>
</div>
