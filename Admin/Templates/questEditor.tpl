<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : questEditor.tpl                                           ##
##  Type           : Admin Panel Frontend for edit Quest                       ##
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

$variant = (isset($_GET['variant']) && $_GET['variant'] === QuestConfig::V_EXTENDED)
    ? QuestConfig::V_EXTENDED : QuestConfig::V_STANDARD;

$rows = QuestConfig::all($variant);
$native = QuestConfig::nativeQuests($variant);
$msg  = isset($_GET['msg']) ? (string)$_GET['msg'] : '';
?>
<style>
.qe-wrap{color:#e2e8f0;font-family:Verdana,Arial,sans-serif;font-size:12px;padding:6px 4px 26px;}
.qe-wrap h2{font-size:18px;margin:0 0 4px;color:#fff;}
.qe-wrap h2 span{color:#f59e0b;}
.qe-intro{color:#94a3b8;font-size:11px;margin:0 0 14px;max-width:880px;line-height:1.5;}
.qe-msg{background:#14532d;border:1px solid #166534;color:#bbf7d0;border-radius:6px;padding:8px 12px;font-size:11px;margin-bottom:14px;}
.qe-warn{background:#422006;border:1px solid #92400e;color:#fbbf24;border-radius:6px;padding:8px 12px;font-size:11px;margin-bottom:14px;}
.qe-tabs{display:flex;gap:8px;margin-bottom:14px;}
.qe-tabs a{background:#1e293b;color:#cbd5e1;border:1px solid #334155;border-radius:6px;padding:8px 18px;text-decoration:none;font-size:12px;}
.qe-tabs a.active{background:#f59e0b;color:#111827;border-color:#f59e0b;font-weight:bold;}
.qe-scroll{overflow-x:auto;border-radius:8px;}
.qe-table{width:100%;border-collapse:collapse;background:#0b1220;border:1px solid #1f2937;border-radius:8px;}
.qe-table th{background:#111827;text-align:left;padding:7px 6px;font-size:9px;text-transform:uppercase;letter-spacing:.3px;color:#94a3b8;border-bottom:1px solid #1f2937;white-space:nowrap;}
.qe-table td{padding:4px 6px;border-bottom:1px solid #14203a;vertical-align:middle;}
.qe-table tr:hover td{background:#0f1a30;}
.qe-table input[type=number]{background:#0b1220;border:1px solid #334155;border-radius:5px;color:#e2e8f0;padding:4px 5px;width:58px;font-variant-numeric:tabular-nums;}
.qe-qname{color:#cbd5e1;cursor:help;border-bottom:1px dotted #475569;white-space:nowrap;}
.qe-qname:hover{color:#fde68a;}
.qe-qid{font-weight:bold;color:#fde68a;font-family:monospace;}
.qe-bar{display:flex;gap:10px;align-items:center;margin:14px 0;flex-wrap:wrap;}
.qe-save{background:#f59e0b;color:#111827;font-weight:bold;border:0;border-radius:6px;padding:10px 22px;cursor:pointer;font-size:13px;}
.qe-reset{background:#7f1d1d;color:#fecaca;border:0;border-radius:6px;padding:9px 16px;cursor:pointer;font-size:12px;}
.qe-note{color:#64748b;font-size:10px;}
</style>

<div class="qe-wrap">
    <h2>Quest <span>Editor</span></h2>
    <p class="qe-intro">
        Edit the reward each quest grants (wood / clay / iron / crop / gold / Plus days) and
        the requirement level (e.g. main-building level for building quests). Values are
        seeded from the shipped defaults, so nothing changes until you edit. The two quest
        variants have different quests and rewards &mdash; pick the one your server uses
        (players on <code>qtyp&nbsp;37</code> get <b>extended</b>, everyone else <b>standard</b>).
    </p>

    <?php if ($msg !== ''): ?><div class="qe-msg"><?php echo e($msg); ?></div><?php endif; ?>

    <div class="qe-warn">
        Reward values are live via <code>QuestConfig::grantReward()</code> in the quest
        templates. Quests marked <b>fixed</b> keep their original hardcoded logic
        (conditional rewards, atomic milestone claims, special mechanics) and are not
        affected by edits here. The reward numbers shown inside each quest's on-screen
        text are separate template strings &mdash; edits here change what is actually
        granted; update the quest language strings if you want the preview to match.
    </div>

    <div class="qe-tabs">
        <a href="admin.php?p=questEditor&variant=standard" class="<?php echo $variant===QuestConfig::V_STANDARD?'active':''; ?>">Standard (quest_core25)</a>
        <a href="admin.php?p=questEditor&variant=extended" class="<?php echo $variant===QuestConfig::V_EXTENDED?'active':''; ?>">Extended (quest_core)</a>
    </div>

    <form method="post" action="../GameEngine/Admin/Mods/questSave.php">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="do" value="save">
        <input type="hidden" name="variant" value="<?php echo e($variant); ?>">

        <div class="qe-scroll">
        <table class="qe-table">
            <thead>
                <tr>
                    <th style="width:44px;">Quest</th>
                    <th style="width:44px;">On</th>
                    <th>Wood</th><th>Clay</th><th>Iron</th><th>Crop</th>
                    <th>Gold</th><th>Plus (days)</th><th>Req.&nbsp;level</th>
                    <th>Quest (hover)</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($rows as $qid => $r): $isNative = in_array((int)$qid, $native, true); $dis = $isNative ? 'disabled' : ''; ?>
                <tr<?php echo $isNative ? ' style="opacity:.55;"' : ''; ?>>
                    <td class="qe-qid"><?php echo (int)$qid; ?><?php if ($isNative): ?><br><span style="font-size:9px;color:#f59e0b;font-family:Verdana;font-weight:normal;">fixed</span><?php endif; ?></td>
                    <td><input type="checkbox" name="q[<?php echo (int)$qid; ?>][enabled]" value="1" <?php echo ((int)$r['enabled']===1)?'checked':''; ?> <?php echo $dis; ?>></td>
                    <td><input type="number" name="q[<?php echo (int)$qid; ?>][wood]" value="<?php echo (int)$r['wood']; ?>" <?php echo $dis; ?>></td>
                    <td><input type="number" name="q[<?php echo (int)$qid; ?>][clay]" value="<?php echo (int)$r['clay']; ?>" <?php echo $dis; ?>></td>
                    <td><input type="number" name="q[<?php echo (int)$qid; ?>][iron]" value="<?php echo (int)$r['iron']; ?>" <?php echo $dis; ?>></td>
                    <td><input type="number" name="q[<?php echo (int)$qid; ?>][crop]" value="<?php echo (int)$r['crop']; ?>" <?php echo $dis; ?>></td>
                    <td><input type="number" name="q[<?php echo (int)$qid; ?>][gold]" value="<?php echo (int)$r['gold']; ?>" <?php echo $dis; ?>></td>
                    <td><input type="number" step="0.25" name="q[<?php echo (int)$qid; ?>][plus_days]" value="<?php echo rtrim(rtrim(number_format((float)$r['plus_days'],2,'.',''),'0'),'.') ?: '0'; ?>" <?php echo $dis; ?>></td>
                    <td><input type="number" name="q[<?php echo (int)$qid; ?>][req_level]" value="<?php echo (int)$r['req_level']; ?>" <?php echo $dis; ?>></td>
                    <td>
                        <?php $qi = QuestConfig::questInfo($variant, (int)$qid); ?>
                        <span class="qe-qname" title="<?php echo e($qi['name'] . ' — ' . $qi['desc']); ?>"><?php echo e($qi['name']); ?></span>
                        <input type="hidden" name="q[<?php echo (int)$qid; ?>][note]" value="<?php echo e($r['note']); ?>">
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        </div>

        <div class="qe-bar">
            <button type="submit" class="qe-save">Save all changes</button>
            <span class="qe-note">Saves every row for the <b><?php echo e($variant); ?></b> variant.</span>
        </div>
    </form>

    <form method="post" action="../GameEngine/Admin/Mods/questSave.php" onsubmit="return confirm('Reset ALL <?php echo e($variant); ?> quests to shipped defaults? Your edits for this variant will be lost.');">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="do" value="reset">
        <input type="hidden" name="variant" value="<?php echo e($variant); ?>">
        <button type="submit" class="qe-reset">Reset this variant to defaults</button>
    </form>
</div>
