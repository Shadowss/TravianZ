<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : blockReg.tpl                                              ##
##  Type           : Admin Panel Frontend for block User Names                 ##
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

$blocks = RegBlock::all();
$msg    = isset($_GET['msg']) ? (string)$_GET['msg'] : '';

$typeLabel = [
    RegBlock::T_USERNAME => 'Username',
    RegBlock::T_EMAIL    => 'E-mail address',
    RegBlock::T_DOMAIN   => 'E-mail domain',
];
?>
<style>
.rb-wrap{color:#e2e8f0;font-family:Verdana,Arial,sans-serif;font-size:12px;padding:6px 4px 26px;}
.rb-wrap h2{font-size:18px;margin:0 0 4px;color:#fff;}
.rb-wrap h2 span{color:#f59e0b;}
.rb-intro{color:#94a3b8;font-size:11px;margin:0 0 14px;max-width:820px;line-height:1.5;}
.rb-msg{background:#14532d;border:1px solid #166534;color:#bbf7d0;border-radius:6px;padding:8px 12px;font-size:11px;margin-bottom:14px;}
.rb-card{background:#111827;border:1px solid #1f2937;border-radius:8px;padding:14px 16px;margin-bottom:18px;}
.rb-card h3{margin:0 0 10px;font-size:13px;color:#fff;font-weight:bold;}
.rb-add{display:flex;flex-wrap:wrap;gap:12px;align-items:flex-end;}
.rb-add label{display:block;font-size:10px;text-transform:uppercase;letter-spacing:.6px;color:#94a3b8;margin-bottom:4px;}
.rb-add select,.rb-add input{background:#0b1220;border:1px solid #334155;border-radius:6px;color:#e2e8f0;padding:7px 9px;}
.rb-add input.val{width:230px;}
.rb-add input.note{width:180px;}
.rb-add button{background:#f59e0b;color:#111827;font-weight:bold;border:0;border-radius:6px;padding:9px 18px;cursor:pointer;}
.rb-hint{color:#64748b;font-size:10px;margin-top:8px;}
.rb-table{width:100%;border-collapse:collapse;background:#0b1220;border:1px solid #1f2937;border-radius:8px;overflow:hidden;}
.rb-table th{background:#111827;text-align:left;padding:9px 10px;font-size:10px;text-transform:uppercase;letter-spacing:.5px;color:#94a3b8;border-bottom:1px solid #1f2937;}
.rb-table td{padding:9px 10px;border-bottom:1px solid #14203a;vertical-align:middle;}
.rb-table tr:hover td{background:#0f1a30;}
.rb-type{display:inline-block;padding:2px 8px;border-radius:10px;font-size:10px;font-weight:bold;text-transform:uppercase;letter-spacing:.4px;}
.t-username{background:#1e3a5f;color:#bfdbfe;}
.t-email{background:#4c1d95;color:#ede9fe;}
.t-domain{background:#0e7490;color:#cffafe;}
.rb-val{font-family:monospace;color:#e2e8f0;}
.rb-note{color:#94a3b8;font-size:11px;}
.rb-del{background:#7f1d1d;color:#fecaca;border:0;border-radius:5px;padding:5px 12px;font-size:11px;cursor:pointer;}
.rb-del:hover{background:#b91c1c;color:#fff;}
.rb-empty{padding:24px;text-align:center;color:#64748b;}
</style>

<div class="rb-wrap">
    <h2>Registration <span>Blocklist</span></h2>
    <p class="rb-intro">
        Block new registrations by a specific <b>username</b>, a specific <b>e-mail
        address</b>, or a whole <b>e-mail domain</b> (e.g. an obscene username, or the
        entire <span class="rb-val">yahoo.com</span> domain). Matching is exact and
        case-insensitive. Existing accounts are not affected &mdash; only new sign-ups.
    </p>

    <?php if ($msg !== ''): ?>
        <div class="rb-msg"><?php echo e($msg); ?></div>
    <?php endif; ?>

    <div class="rb-card">
        <h3>Add a block</h3>
        <form method="post" action="../GameEngine/Admin/Mods/blockReg.php" class="rb-add">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="do" value="add">
            <div>
                <label>Type</label>
                <select name="type">
                    <option value="<?php echo RegBlock::T_USERNAME; ?>">Username</option>
                    <option value="<?php echo RegBlock::T_EMAIL; ?>">E-mail address</option>
                    <option value="<?php echo RegBlock::T_DOMAIN; ?>">E-mail domain</option>
                </select>
            </div>
            <div>
                <label>Value</label>
                <input class="val" type="text" name="value" maxlength="255" placeholder="e.g. BadName / spam@x.com / yahoo.com" required>
            </div>
            <div>
                <label>Note (optional)</label>
                <input class="note" type="text" name="note" maxlength="255" placeholder="reason">
            </div>
            <button type="submit">Add block</button>
        </form>
        <div class="rb-hint">
            Domain: enter just the domain (<span class="rb-val">yahoo.com</span>), with or without the leading &ldquo;@&rdquo;.
            E-mail: the full address. Username: the exact name.
        </div>
    </div>

    <div class="rb-card" style="padding:0;overflow:hidden;">
        <?php if (empty($blocks)): ?>
            <div class="rb-empty">No registration blocks yet.</div>
        <?php else: ?>
            <table class="rb-table">
                <thead>
                    <tr>
                        <th style="width:130px;">Type</th>
                        <th>Value</th>
                        <th>Note</th>
                        <th style="width:150px;">Added</th>
                        <th style="width:90px;"></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($blocks as $b):
                    $t = $b['type'];
                    $tClass = $t === RegBlock::T_USERNAME ? 't-username' : ($t === RegBlock::T_EMAIL ? 't-email' : 't-domain');
                ?>
                    <tr>
                        <td><span class="rb-type <?php echo $tClass; ?>"><?php echo e($typeLabel[$t] ?? $t); ?></span></td>
                        <td class="rb-val"><?php echo e($b['value']); ?></td>
                        <td class="rb-note"><?php echo $b['note'] !== '' ? e($b['note']) : '&mdash;'; ?></td>
                        <td class="rb-note"><?php echo $b['time'] ? date('Y-m-d H:i', (int)$b['time']) : '&mdash;'; ?></td>
                        <td>
                            <form method="post" action="../GameEngine/Admin/Mods/blockReg.php" onsubmit="return confirm('Remove this block?');">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="do" value="remove">
                                <input type="hidden" name="id" value="<?php echo (int)$b['id']; ?>">
                                <button type="submit" class="rb-del">Remove</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>
