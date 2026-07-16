<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : goldShop.tpl                                              ##
##  Type           : Admin Panel Frontend for redeem Gold Codes                ##
## --------------------------------------------------------------------------- ##
##  Developed by   : Shadow 		                                           ##
## --------------------------------------------------------------------------- ##
##  Contact        : cata7007@gmail.com                                        ##
##  Project        : TravianZ                                                  ##
##  GitHub         : https://github.com/Shadowss/TravianZ                      ##
## --------------------------------------------------------------------------- ##
##  License        : TravianZ Project                                          ##
##  Copyright      : TravianZ (c) 2010-2026. All rights reserved.              ##
## --------------------------------------------------------------------------- ##
#################################################################################

if (!isset($_SESSION['access']) || $_SESSION['access'] < ADMIN) {
    echo '<p style="color:#f87171;padding:16px;">Access denied.</p>';
    return;
}

$codes   = GoldShop::listCodes();
$redeems = GoldShop::recentRedemptions(25);
$msg     = isset($_GET['msg']) ? (string)$_GET['msg'] : '';
?>
<style>
.gs-wrap{color:#e2e8f0;font-family:Verdana,Arial,sans-serif;font-size:12px;padding:6px 4px 26px;}
.gs-wrap h2{font-size:18px;margin:0 0 4px;color:#fff;}
.gs-wrap h2 span{color:#f59e0b;}
.gs-intro{color:#94a3b8;font-size:11px;margin:0 0 14px;max-width:860px;line-height:1.5;}
.gs-msg{background:#14532d;border:1px solid #166534;color:#bbf7d0;border-radius:6px;padding:8px 12px;font-size:11px;margin-bottom:14px;}
.gs-card{background:#111827;border:1px solid #1f2937;border-radius:8px;padding:14px 16px;margin-bottom:18px;}
.gs-card h3{margin:0 0 10px;font-size:13px;color:#fff;}
.gs-add{display:flex;flex-wrap:wrap;gap:12px;align-items:flex-end;}
.gs-add label{display:block;font-size:10px;text-transform:uppercase;letter-spacing:.6px;color:#94a3b8;margin-bottom:4px;}
.gs-add input[type=text],.gs-add input[type=number]{background:#0b1220;border:1px solid #334155;border-radius:6px;color:#e2e8f0;padding:7px 9px;}
.gs-add input.code{width:150px;text-transform:uppercase;}
.gs-add input.num{width:90px;}
.gs-add input.note{width:170px;}
.gs-add .chk{display:flex;align-items:center;gap:6px;color:#cbd5e1;font-size:11px;padding-bottom:7px;}
.gs-add button{background:#f59e0b;color:#111827;font-weight:bold;border:0;border-radius:6px;padding:9px 18px;cursor:pointer;}
.gs-hint{color:#64748b;font-size:10px;margin-top:8px;}
.gs-table{width:100%;border-collapse:collapse;background:#0b1220;border:1px solid #1f2937;border-radius:8px;}
.gs-table th{background:#111827;text-align:left;padding:7px 7px;font-size:9px;text-transform:uppercase;letter-spacing:.3px;color:#94a3b8;border-bottom:1px solid #1f2937;white-space:nowrap;}
.gs-table td{padding:6px 7px;border-bottom:1px solid #14203a;vertical-align:middle;font-size:11px;}
.gs-table tr:hover td{background:#0f1a30;}
.gs-table td.note-col{max-width:120px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;}
.gs-scroll{overflow-x:auto;}
.gs-code{font-family:monospace;font-weight:bold;color:#fde68a;}
.badge{display:inline-block;padding:2px 8px;border-radius:10px;font-size:10px;font-weight:bold;text-transform:uppercase;letter-spacing:.4px;}
.st-active{background:#14532d;color:#bbf7d0;}
.st-disabled{background:#334155;color:#cbd5e1;}
.st-expired{background:#7f1d1d;color:#fecaca;}
.st-usedup{background:#78350f;color:#fde68a;}
.gs-actions{display:flex;gap:6px;}
.gs-actions button{border:0;border-radius:5px;padding:5px 10px;font-size:11px;cursor:pointer;}
.b-toggle{background:#334155;color:#fff;}
.b-toggle:hover{background:#f59e0b;color:#111827;}
.b-del{background:#7f1d1d;color:#fecaca;}
.b-del:hover{background:#b91c1c;color:#fff;}
.gs-empty{padding:22px;text-align:center;color:#64748b;}
.num{font-variant-numeric:tabular-nums;}
.gs-side-note{color:#64748b;font-size:11px;margin-top:4px;}
</style>

<div class="gs-wrap">
    <h2>Gold <span>Shop &amp; Promo Codes</span></h2>
    <p class="gs-intro">
        Create promo / voucher codes players redeem for gold on the Plus page. Set a fixed
        gold amount, an optional total use-limit, whether each player may redeem it once,
        and an optional expiry. For a one-off bug-hunter reward, create a code with
        max-uses&nbsp;1 &mdash; or use
        <a href="admin.php?p=usergold" style="color:#93c5fd;">Give Free Gold To Specific User</a> directly.
    </p>

    <?php if ($msg !== ''): ?>
        <div class="gs-msg"><?php echo e($msg); ?></div>
    <?php endif; ?>

    <div class="gs-card">
        <h3>Create a code</h3>
        <form method="post" action="../GameEngine/Admin/Mods/goldPromo.php" class="gs-add">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="do" value="create">
            <div>
                <label>Code</label>
                <input class="code" type="text" name="code" maxlength="64" placeholder="BUGHUNT2026" required>
            </div>
            <div>
                <label>Gold</label>
                <input class="num" type="number" name="gold" min="1" value="100" required>
            </div>
            <div>
                <label>Max uses (0 = &infin;)</label>
                <input class="num" type="number" name="max_uses" min="0" value="0">
            </div>
            <div>
                <label>Expires in (days, 0 = never)</label>
                <input class="num" type="number" name="expires_days" min="0" value="0">
            </div>
            <div class="chk">
                <input type="checkbox" name="per_user" id="per_user" checked>
                <label for="per_user" style="margin:0;text-transform:none;letter-spacing:0;">once per player</label>
            </div>
            <div>
                <label>Note (optional)</label>
                <input class="note" type="text" name="note" maxlength="255" placeholder="reason / campaign">
            </div>
            <button type="submit">Create</button>
        </form>
        <div class="gs-hint">Codes are case-insensitive; allowed characters: A-Z 0-9 . _ &ndash;</div>
    </div>

    <div class="gs-card" style="padding:0;">
        <?php if (empty($codes)): ?>
            <div class="gs-empty">No promo codes yet.</div>
        <?php else: ?>
            <div class="gs-scroll">
            <table class="gs-table">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Gold</th>
                        <th>Uses</th>
                        <th>Scope</th>
                        <th>Expires</th>
                        <th>Status</th>
                        <th>Note</th>
                        <th style="width:150px;"></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($codes as $cd):
                    $sc = strtolower(str_replace(' ', '', $cd['status']));
                    $sClass = 'st-active';
                    if ($cd['status'] === 'Disabled') $sClass = 'st-disabled';
                    elseif ($cd['status'] === 'Expired') $sClass = 'st-expired';
                    elseif ($cd['status'] === 'Used up') $sClass = 'st-usedup';
                ?>
                    <tr>
                        <td class="gs-code"><?php echo e($cd['code']); ?></td>
                        <td class="num"><?php echo number_format((int)$cd['gold']); ?></td>
                        <td class="num"><?php echo (int)$cd['uses']; ?><?php echo ((int)$cd['max_uses'] > 0) ? ' / ' . (int)$cd['max_uses'] : ''; ?></td>
                        <td><?php echo ((int)$cd['per_user'] === 1) ? 'once/player' : 'repeatable'; ?></td>
                        <td class="num"><?php echo ((int)$cd['expires'] > 0) ? date('Y-m-d', (int)$cd['expires']) : '&ndash;'; ?></td>
                        <td><span class="badge <?php echo $sClass; ?>"><?php echo e($cd['status']); ?></span></td>
                        <td class="note-col" style="color:#94a3b8;"><?php echo $cd['note'] !== '' ? e($cd['note']) : '&ndash;'; ?></td>
                        <td>
                            <div class="gs-actions">
                                <form method="post" action="../GameEngine/Admin/Mods/goldPromo.php">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="do" value="toggle">
                                    <input type="hidden" name="id" value="<?php echo (int)$cd['id']; ?>">
                                    <input type="hidden" name="active" value="<?php echo ((int)$cd['active'] === 1) ? 0 : 1; ?>">
                                    <button type="submit" class="b-toggle"><?php echo ((int)$cd['active'] === 1) ? 'Disable' : 'Enable'; ?></button>
                                </form>
                                <form method="post" action="../GameEngine/Admin/Mods/goldPromo.php" onsubmit="return confirm('Delete this code?');">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="do" value="delete">
                                    <input type="hidden" name="id" value="<?php echo (int)$cd['id']; ?>">
                                    <button type="submit" class="b-del">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            </div>
        <?php endif; ?>
    </div>

    <div class="gs-card">
        <h3>Recent redemptions</h3>
        <?php if (empty($redeems)): ?>
            <div class="gs-side-note">No redemptions yet.</div>
        <?php else: ?>
            <div class="gs-scroll">
            <table class="gs-table">
                <thead>
                    <tr><th>When</th><th>Player</th><th>Code</th><th>Gold</th></tr>
                </thead>
                <tbody>
                <?php foreach ($redeems as $rd): ?>
                    <tr>
                        <td class="num" style="color:#94a3b8;"><?php echo $rd['time'] ? date('Y-m-d H:i', (int)$rd['time']) : '&ndash;'; ?></td>
                        <td>
                            <?php if (!empty($rd['uid'])): ?>
                                <a href="admin.php?p=player&uid=<?php echo (int)$rd['uid']; ?>" style="color:#e2e8f0;text-decoration:none;"><?php echo e($rd['username'] ?? ('#' . $rd['uid'])); ?></a>
                            <?php else: ?>&ndash;<?php endif; ?>
                        </td>
                        <td class="gs-code"><?php echo e($rd['code'] ?? '(deleted)'); ?></td>
                        <td class="num"><?php echo number_format((int)$rd['gold']); ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            </div>
        <?php endif; ?>
    </div>
</div>
