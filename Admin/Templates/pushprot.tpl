<?php
#################################################################################
##  Filename       : Admin/Templates/pushprot.tpl                             ##
##  Type           : Admin page - Push Protection dashboard                   ##
##  Project        : TravianZ                                                 ##
##  License        : TravianZ Project                                         ##
#################################################################################

if (!isset($_SESSION['access']) || $_SESSION['access'] < MULTIHUNTER) {
    echo '<p style="color:#f87171;padding:16px;">Access denied.</p>';
    return;
}

$days  = isset($_GET['days'])  && ctype_digit((string)$_GET['days'])  ? max(1, min(30, (int)$_GET['days']))  : PushProtection::WINDOW_DAYS;
$hours = isset($_GET['hours']) && ctype_digit((string)$_GET['hours']) ? max(1, min(168, (int)$_GET['hours'])): PushProtection::HOURS_ALLOWED;
$only  = isset($_GET['only']) && in_array($_GET['only'], ['all','over','flagged'], true) ? $_GET['only'] : 'all';

$data = PushProtection::dashboard(['days' => $days, 'hours' => $hours, 'only' => $only]);
$rows = $data['rows'];

function pp_num($n) { return number_format((int)$n); }
?>
<style>
.pp-wrap{color:#e2e8f0;font-family:Verdana,Arial,sans-serif;font-size:12px;padding:6px 4px 26px;}
.pp-wrap h2{font-size:18px;margin:0 0 4px;color:#fff;}
.pp-wrap h2 span{color:#f59e0b;}
.pp-intro{color:#94a3b8;font-size:11px;margin:0 0 14px;max-width:860px;line-height:1.5;}
.pp-filter{background:#111827;border:1px solid #1f2937;border-radius:8px;padding:12px 14px;display:flex;flex-wrap:wrap;gap:14px;align-items:flex-end;margin-bottom:14px;}
.pp-filter label{display:block;font-size:10px;text-transform:uppercase;letter-spacing:.6px;color:#94a3b8;margin-bottom:4px;}
.pp-filter input,.pp-filter select{background:#0b1220;border:1px solid #334155;border-radius:6px;color:#e2e8f0;padding:6px 8px;}
.pp-filter input{width:90px;}
.pp-filter button{background:#f59e0b;color:#111827;font-weight:bold;border:0;border-radius:6px;padding:8px 16px;cursor:pointer;}
.pp-meta{color:#64748b;font-size:11px;margin-bottom:10px;}
.pp-table{width:100%;border-collapse:collapse;background:#0b1220;border:1px solid #1f2937;border-radius:8px;overflow:hidden;}
.pp-table th{background:#111827;text-align:left;padding:9px 10px;font-size:10px;text-transform:uppercase;letter-spacing:.5px;color:#94a3b8;border-bottom:1px solid #1f2937;}
.pp-table td{padding:9px 10px;border-bottom:1px solid #14203a;vertical-align:top;}
.pp-table tr:hover td{background:#0f1a30;}
.pp-acc a{color:#e2e8f0;text-decoration:none;font-weight:bold;}
.pp-acc a:hover{color:#f59e0b;}
.pp-acc .uid{color:#475569;font-weight:normal;font-size:10px;display:block;}
.badge{display:inline-block;padding:2px 8px;border-radius:10px;font-size:10px;font-weight:bold;text-transform:uppercase;letter-spacing:.4px;}
.s-over{background:#7f1d1d;color:#fecaca;}
.s-near{background:#78350f;color:#fde68a;}
.s-ok{background:#14532d;color:#bbf7d0;}
.s-exempt{background:#1e3a5f;color:#bfdbfe;}
.flag{display:inline-block;background:#334155;color:#e2e8f0;border-radius:4px;padding:1px 6px;font-size:9px;margin:2px 3px 0 0;text-transform:uppercase;letter-spacing:.4px;}
.flag.ww{background:#5b21b6;color:#ede9fe;}
.flag.arte{background:#0e7490;color:#cffafe;}
.pp-bar{height:6px;background:#1e293b;border-radius:3px;margin-top:4px;overflow:hidden;width:120px;}
.pp-bar i{display:block;height:100%;}
.pp-ov{display:flex;gap:5px;align-items:center;flex-wrap:wrap;}
.pp-ov select,.pp-ov input{background:#0b1220;border:1px solid #334155;border-radius:5px;color:#e2e8f0;padding:4px 6px;font-size:11px;}
.pp-ov input.lim{width:90px;}
.pp-ov input.note{width:120px;}
.pp-ov button{background:#334155;color:#fff;border:0;border-radius:5px;padding:5px 10px;font-size:11px;cursor:pointer;}
.pp-ov button:hover{background:#f59e0b;color:#111827;}
.pp-cur{font-size:10px;color:#94a3b8;display:block;margin-bottom:3px;}
.pp-empty{padding:26px;text-align:center;color:#64748b;}
.num{font-variant-numeric:tabular-nums;}
</style>

<div class="pp-wrap">
    <h2><?php echo ADMIN_PUSH_PROTECTION; ?><span><?php echo ADM_DASHBOARD; ?></span></h2>
    <p class="pp-intro"><?php echo ADM_PER_PLAYER; ?><b><?php echo ADM_7_DAY_RESOURCE_BALANCE; ?></b><?php echo ADM_RECEIVED_FROM_OTHER_PLAYERS_VERSUS_AN_AUTOMA; ?><span class="num"><?php echo (int)$data['hours_allowed']; ?>h</span><?php echo ADM_OF_PRODUCTION_PER_WINDOW_WW_VILLAGES_AND_ART; ?></p>

    <form method="get" action="admin.php" class="pp-filter">
        <input type="hidden" name="p" value="pushprot">
        <div>
            <label><?php echo ADM_WINDOW_DAYS; ?></label>
            <input type="number" name="days" min="1" max="30" value="<?php echo (int)$days; ?>">
        </div>
        <div>
            <label><?php echo ADM_HOURS_OF_PROD_ALLOWED; ?></label>
            <input type="number" name="hours" min="1" max="168" value="<?php echo (int)$hours; ?>">
        </div>
        <div>
            <label><?php echo ADM_SHOW_2; ?></label>
            <select name="only">
                <option value="all"     <?php echo $only==='all'?'selected':''; ?>><?php echo ADM_ALL_WITH_ACTIVITY; ?></option>
                <option value="over"    <?php echo $only==='over'?'selected':''; ?>><?php echo ADM_OVER_LIMIT_ONLY; ?></option>
                <option value="flagged" <?php echo $only==='flagged'?'selected':''; ?>><?php echo ADM_WW_ARTEFACT_OVERRIDDEN; ?></option>
            </select>
        </div>
        <button type="submit"><?php echo ADM_REFRESH_2; ?></button>
    </form>

    <div class="pp-meta">
        Window: last <?php echo (int)$data['window_days']; ?> days &nbsp;|&nbsp;
        limit = <?php echo (int)$data['hours_allowed']; ?>h &times; hourly production &nbsp;|&nbsp;
        <?php echo count($rows); ?> player<?php echo count($rows)==1?'':'s'; ?> shown
    </div>

    <?php if (empty($rows)): ?>
        <div class="pp-table"><div class="pp-empty"><?php echo ADM_NO_INTER_PLAYER_TRANSFERS_RECORDED_IN_THIS_W; ?><br><?php echo ADM_THE_7_DAY_BALANCE_FILLS_IN_AS_MERCHANT_DELIV; ?></div></div>
    <?php else: ?>
        <table class="pp-table">
            <thead>
                <tr>
                    <th><?php echo ADM_PLAYER_2; ?></th>
                    <th><?php echo ADM_VILLAGES_POP; ?></th>
                    <th><?php echo ADM_PROD_H; ?></th>
                    <th><?php echo ADM_RECEIVED_7D; ?></th>
                    <th><?php echo ADM_LIMIT; ?></th>
                    <th><?php echo ADM_USAGE; ?></th>
                    <th style="width:26%;"><?php echo ADM_OVERRIDE; ?></th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($rows as $r):
                $sCls = $r['status']==='Over' ? 's-over' : ($r['status']==='Near' ? 's-near' : ($r['status']==='Exempt' ? 's-exempt' : 's-ok'));
                $barCol = $r['status']==='Over' ? '#ef4444' : ($r['status']==='Near' ? '#f59e0b' : ($r['status']==='Exempt' ? '#3b82f6' : '#22c55e'));
                $barW = $r['eff_limit']==-1 ? 100 : min(100, (int)$r['pct']);
            ?>
                <tr>
                    <td class="pp-acc">
                        <a href="admin.php?p=player&uid=<?php echo (int)$r['uid']; ?>"><?php echo e($r['name']); ?></a>
                        <span class="uid">#<?php echo (int)$r['uid']; ?></span>
                        <?php foreach ($r['flags'] as $fl): ?>
                            <span class="flag <?php echo stripos($fl,'WW')!==false?'ww':'arte'; ?>"><?php echo e($fl); ?></span>
                        <?php endforeach; ?>
                    </td>
                    <td class="num"><?php echo (int)$r['villages']; ?> / <?php echo pp_num($r['pop']); ?></td>
                    <td class="num"><?php echo pp_num($r['prod_h']); ?></td>
                    <td class="num">
                        <?php echo pp_num($r['received']); ?>
                        <span style="color:#64748b;font-size:10px;">from <?php echo (int)$r['senders']; ?></span>
                    </td>
                    <td class="num">
                        <?php echo $r['eff_limit']==-1 ? '<span style="color:#93c5fd;">unlimited</span>' : pp_num($r['eff_limit']); ?>
                        <?php if ($r['ov_label']): ?><span style="color:#64748b;font-size:10px;display:block;"><?php echo e($r['ov_label']); ?></span><?php endif; ?>
                    </td>
                    <td>
                        <span class="badge <?php echo $sCls; ?>"><?php echo e($r['status']); ?></span>
                        <?php if ($r['eff_limit']!=-1): ?>
                            <div style="font-size:10px;color:#94a3b8;margin-top:3px;"><?php echo (int)$r['pct']; ?>%</div>
                        <?php endif; ?>
                        <div class="pp-bar"><i style="width:<?php echo (int)$barW; ?>%;background:<?php echo $barCol; ?>;"></i></div>
                    </td>
                    <td>
                        <?php if ($r['ov_note']): ?><span class="pp-cur">note: <?php echo e($r['ov_note']); ?></span><?php endif; ?>
                        <form method="post" action="../GameEngine/Admin/Mods/pushOverride.php" class="pp-ov">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="uid" value="<?php echo (int)$r['uid']; ?>">
                            <select name="mode">
                                <option value="0" <?php echo $r['ov_mode']==0?'selected':''; ?>><?php echo ADM_AUTO; ?></option>
                                <option value="1" <?php echo $r['ov_mode']==1?'selected':''; ?>>Exempt<?php echo $r['is_ww']?' (WW)':''; ?></option>
                                <option value="3" <?php echo $r['ov_mode']==3?'selected':''; ?>><?php echo ADM_CUSTOM_CAP; ?></option>
                            </select>
                            <input class="lim num" type="number" min="0" name="custom_limit" placeholder="cap" value="<?php echo $r['ov_mode']==3 && $r['eff_limit']>0 ? (int)$r['eff_limit'] : ''; ?>">
                            <input class="note" type="text" name="note" maxlength="255" placeholder="note" value="<?php echo e($r['ov_note']); ?>">
                            <button type="submit"><?php echo ADM_SAVE_3; ?></button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
