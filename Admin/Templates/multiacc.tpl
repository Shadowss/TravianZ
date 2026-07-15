<?php
#################################################################################
##  Filename       : Admin/Templates/multiacc.tpl                             ##
##  Type           : Admin page - Multi-Account Detection                     ##
##  Project        : TravianZ                                                 ##
##  License        : TravianZ Project                                         ##
#################################################################################

// Access: admins (9) and multihunters (8) only.
if (!isset($_SESSION['access']) || $_SESSION['access'] < MULTIHUNTER) {
    echo '<p style="color:#f87171;padding:16px;">Access denied.</p>';
    return;
}

// Filters (GET). All optional.
$days     = isset($_GET['days'])     && ctype_digit((string)$_GET['days'])     ? max(1, min(365, (int)$_GET['days']))     : MultiAccount::WINDOW_DAYS;
$minScore = isset($_GET['min'])      && ctype_digit((string)$_GET['min'])      ? max(0, min(100, (int)$_GET['min']))      : MultiAccount::MIN_REPORT_SCORE;
$focusUid = isset($_GET['focus'])    && ctype_digit((string)$_GET['focus'])    ? (int)$_GET['focus']                       : 0;

$data  = MultiAccount::riskPairs(['days' => $days, 'min_score' => $minScore, 'focus_uid' => $focusUid]);
$pairs = $data['pairs'];
?>
<style>
.mad-wrap{color:#e2e8f0;font-family:Verdana,Arial,sans-serif;font-size:12px;padding:6px 4px 26px;}
.mad-wrap h2{font-size:18px;margin:0 0 4px;color:#fff;}
.mad-wrap h2 span{color:#f59e0b;}
.mad-intro{color:#94a3b8;font-size:11px;margin:0 0 14px;max-width:820px;line-height:1.5;}
.mad-filter{background:#111827;border:1px solid #1f2937;border-radius:8px;padding:12px 14px;display:flex;flex-wrap:wrap;gap:14px;align-items:flex-end;margin-bottom:16px;}
.mad-filter label{display:block;font-size:10px;text-transform:uppercase;letter-spacing:.6px;color:#94a3b8;margin-bottom:4px;}
.mad-filter input{background:#0b1220;border:1px solid #334155;border-radius:6px;color:#e2e8f0;padding:6px 8px;width:110px;}
.mad-filter button{background:#f59e0b;color:#111827;font-weight:bold;border:0;border-radius:6px;padding:8px 16px;cursor:pointer;}
.mad-filter a.reset{color:#94a3b8;font-size:11px;text-decoration:none;padding:8px 4px;}
.mad-meta{color:#64748b;font-size:11px;margin-bottom:10px;}
.mad-warn{background:#422006;border:1px solid #92400e;color:#fbbf24;border-radius:6px;padding:8px 12px;font-size:11px;margin-bottom:12px;}
.mad-table{width:100%;border-collapse:collapse;background:#0b1220;border:1px solid #1f2937;border-radius:8px;overflow:hidden;}
.mad-table th{background:#111827;text-align:left;padding:9px 10px;font-size:10px;text-transform:uppercase;letter-spacing:.5px;color:#94a3b8;border-bottom:1px solid #1f2937;}
.mad-table td{padding:9px 10px;border-bottom:1px solid #14203a;vertical-align:top;}
.mad-table tr:hover td{background:#0f1a30;}
.mad-acc a{color:#e2e8f0;text-decoration:none;font-weight:bold;}
.mad-acc a:hover{color:#f59e0b;}
.mad-acc .uid{color:#475569;font-weight:normal;font-size:10px;}
.mad-acc .sub{display:block;margin-top:2px;}
.mad-acc .sub a{font-size:10px;color:#64748b;font-weight:normal;margin-right:8px;}
.mad-score{font-weight:bold;font-size:14px;}
.badge{display:inline-block;padding:2px 8px;border-radius:10px;font-size:10px;font-weight:bold;text-transform:uppercase;letter-spacing:.5px;}
.b-high{background:#7f1d1d;color:#fecaca;}
.b-med{background:#78350f;color:#fde68a;}
.b-low{background:#1e3a5f;color:#bfdbfe;}
.chips span{display:inline-block;background:#1e293b;color:#cbd5e1;border-radius:4px;padding:2px 7px;margin:2px 3px 0 0;font-size:10px;}
.mad-empty{padding:26px;text-align:center;color:#64748b;}
.mad-bar{height:6px;background:#1e293b;border-radius:3px;margin-top:4px;overflow:hidden;}
.mad-bar i{display:block;height:100%;}
</style>

<div class="mad-wrap">
    <h2>Multi-Account <span>Detection</span></h2>
    <p class="mad-intro">
        Heuristic correlation of account pairs by shared IP, subnet, device/browser
        fingerprint (User-Agent), overlapping login times, and resource-transfer flow.
        This is a <b>risk score, not proof</b> &mdash; use it to prioritise which
        pairs a human should investigate. Nothing is banned automatically.
    </p>

    <form method="get" action="admin.php" class="mad-filter">
        <input type="hidden" name="p" value="multiacc">
        <div>
            <label>Window (days)</label>
            <input type="number" name="days" min="1" max="365" value="<?php echo (int)$days; ?>">
        </div>
        <div>
            <label>Min score</label>
            <input type="number" name="min" min="0" max="100" value="<?php echo (int)$minScore; ?>">
        </div>
        <div>
            <label>Focus on UID (optional)</label>
            <input type="number" name="focus" min="0" value="<?php echo $focusUid ?: ''; ?>">
        </div>
        <button type="submit">Analyse</button>
        <?php if ($focusUid || $days != MultiAccount::WINDOW_DAYS || $minScore != MultiAccount::MIN_REPORT_SCORE): ?>
            <a class="reset" href="admin.php?p=multiacc">reset</a>
        <?php endif; ?>
    </form>

    <?php if ($data['truncated']): ?>
        <div class="mad-warn">
            Row cap reached while scanning login history (window is large / very busy server).
            Results still valid but may be incomplete &mdash; narrow the window for full coverage.
        </div>
    <?php endif; ?>

    <div class="mad-meta">
        Window: last <?php echo (int)$data['window_days']; ?> days &nbsp;|&nbsp;
        scanned <?php echo (int)$data['scanned']['login_log']; ?> login-log +
        <?php echo (int)$data['scanned']['mad_session']; ?> fingerprint rows &nbsp;|&nbsp;
        <?php echo count($pairs); ?> suspicious pair<?php echo count($pairs) == 1 ? '' : 's'; ?>
        <?php if ($focusUid): ?>&nbsp;|&nbsp;focused on UID <?php echo (int)$focusUid; ?><?php endif; ?>
    </div>

    <?php if (empty($pairs)): ?>
        <div class="mad-table"><div class="mad-empty">
            No account pairs at or above the current score threshold.<br>
            <?php if ((int)$data['scanned']['mad_session'] === 0): ?>
                Tip: the User-Agent signal starts filling in only after players log in
                once with this feature deployed. IP &amp; login-time signals work on
                existing history immediately.
            <?php else: ?>
                Try lowering the minimum score or widening the window.
            <?php endif; ?>
        </div></div>
    <?php else: ?>
        <table class="mad-table">
            <thead>
                <tr>
                    <th style="width:80px;">Risk</th>
                    <th>Account A</th>
                    <th>Account B</th>
                    <th style="width:44%;">Why</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($pairs as $p):
                $cls = $p['label'] === 'High' ? 'b-high' : ($p['label'] === 'Medium' ? 'b-med' : 'b-low');
                $barColor = $p['label'] === 'High' ? '#ef4444' : ($p['label'] === 'Medium' ? '#f59e0b' : '#3b82f6');
            ?>
                <tr>
                    <td>
                        <div class="mad-score" style="color:<?php echo $barColor; ?>;"><?php echo (int)$p['score']; ?></div>
                        <span class="badge <?php echo $cls; ?>"><?php echo e($p['label']); ?></span>
                        <div class="mad-bar"><i style="width:<?php echo (int)$p['score']; ?>%;background:<?php echo $barColor; ?>;"></i></div>
                    </td>
                    <td class="mad-acc">
                        <a href="admin.php?p=player&uid=<?php echo (int)$p['uid_a']; ?>"><?php echo e($p['name_a']); ?></a>
                        <span class="uid">#<?php echo (int)$p['uid_a']; ?></span>
                        <span class="sub">
                            <a href="admin.php?p=userlogin&uid=<?php echo (int)$p['uid_a']; ?>">login log</a>
                            <a href="admin.php?p=multiacc&focus=<?php echo (int)$p['uid_a']; ?>">focus</a>
                        </span>
                    </td>
                    <td class="mad-acc">
                        <a href="admin.php?p=player&uid=<?php echo (int)$p['uid_b']; ?>"><?php echo e($p['name_b']); ?></a>
                        <span class="uid">#<?php echo (int)$p['uid_b']; ?></span>
                        <span class="sub">
                            <a href="admin.php?p=userlogin&uid=<?php echo (int)$p['uid_b']; ?>">login log</a>
                            <a href="admin.php?p=multiacc&focus=<?php echo (int)$p['uid_b']; ?>">focus</a>
                        </span>
                    </td>
                    <td class="chips">
                        <?php foreach ($p['reasons'] as $r): ?>
                            <span><?php echo e($r); ?></span>
                        <?php endforeach; ?>
                        <?php if (!empty($p['shared_ip_list'])): ?>
                            <div style="margin-top:5px;color:#475569;font-size:10px;">
                                IPs: <?php echo e(implode(', ', $p['shared_ip_list'])); ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($p['trade_gross'] > 0): ?>
                            <div style="margin-top:3px;color:#475569;font-size:10px;">
                                transfer volume: <?php echo number_format((int)$p['trade_gross']); ?> res
                                <?php echo $p['trade_dir'] ? '(one-directional)' : '(two-way)'; ?>
                            </div>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
