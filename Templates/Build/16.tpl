<?php

// RALLY POINT

if (isset($_GET['refresh'])) {
    $village->unitarray = $database->getUnit($village->wid, false);
}
$hasRally = $village->resarray['f39'] > 0;
?>
<div id="build" class="gid16">
    <a href="#" onclick="return Popup(16,4);" class="build_logo">
        <img class="g16" src="img/x.gif" alt="<?php echo RALLYPOINT; ?>" title="<?= RALLYPOINT ?>">
    </a>
    <h1><?= RALLYPOINT ?> <span class="level"><?= LEVEL ?> <?= $village->resarray['f'.$id] ?></span></h1>
    <p class="build_desc"><?= RALLYPOINT_DESC ?></p>

<?php if ($hasRally): ?>
    <?php include_once '16_menu.tpl'; ?>

    <?php
    // --- INCOMING ---
    $units_type = $database->getMovement(34, $village->wid, 1);
    $settlers = $database->getMovement(7, $village->wid, 1);
    $oasis_incoming = 0;
    foreach ($database->getOasis($village->wid) as $o) {
        $oasis_incoming += count($database->getMovement(6, $o['wref'], 0));
    }
    $units_incoming = count($units_type);
    foreach ($units_type as $u) if ($u['attack_type'] == 1 && $u['sort_type'] == 3) $units_incoming--;
    $totalIncoming = $units_incoming + count($settlers) + $oasis_incoming;
    ?>

    <?php if ($totalIncoming > 0): ?>
        <h4><?= INCOMING_TROOPS ?> (<?= $totalIncoming ?>)</h4>
        <?php include '16_incomming.tpl'; ?>
    <?php endif; ?>

    <!-- OWN TROOPS -->
    <h4><?= TROOPS_IN_THE_VILLAGE ?></h4>
    <table class="troop_details" cellpadding="1" cellspacing="1">
        <thead>
            <tr>
                <td class="role"><a href="karte.php?d=<?= $village->wid ?>&c=<?= $generator->getMapCheck($village->wid) ?>"><?= $village->vname ?></a></td>
                <td colspan="<?= $village->unitarray['hero'] ? 11 : 10 ?>"><a href="spieler.php?uid=<?= $session->uid ?>"><?= OWN_TROOPS ?></a></td>
            </tr>
        </thead>
        <tbody class="units"><?php include '16_troops.tpl'; ?></tbody>
    </table>

    <!-- REINFORCEMENTS TO ME -->
    <?php foreach ($village->enforcetome as $e):
        $isTaskmaster = $e['from'] == 0;
        $colspan = 10 + $e['hero'];
        $tribe = $isTaskmaster ? 4 : $database->getUserField($database->getVillageField($e['from'],'owner'),'tribe',0);
        $start = ($tribe-1)*10+1;
    ?>
    <table class="troop_details" cellpadding="1" cellspacing="1">
        <thead><tr>
            <td class="role">
                <?php if (!$isTaskmaster): ?>
                    <a href="karte.php?d=<?= $e['from'] ?>&c=<?= $generator->getMapCheck($e['from']) ?>"><?= $database->getVillageField($e['from'],'name') ?></a>
                <?php else: ?><a><?= TASKMASTER ?></a><?php endif; ?>
            </td>
            <td colspan="<?= $colspan ?>">
                <?php if (!$isTaskmaster):
                    $owner = $database->getVillageField($e['from'],'owner');
                    $uname = $database->getUserField($owner,'username',0);
                ?>
                    <a href="spieler.php?uid=<?= $owner ?>"><?= LANG=='es' ? TROOPS.' '.$uname : $uname.' '.TROOPS ?></a>
                <?php else: ?><a><?= VILLAGE_OF_THE_ELDERS_TROOPS ?></a><?php endif; ?>
            </td>
        </tr></thead>
        <tbody class="units">
            <tr><th>&nbsp;</th><?php for($i=$start;$i<$start+10;$i++): ?><td><img src="img/x.gif" class="unit u<?= $i ?>" title="<?= $technology->getUnitName($i) ?>"></td><?php endfor; ?><?php if($e['hero']): ?><td><img src="img/x.gif" class="unit uhero" title="<?php echo U0; ?>"></td><?php endif; ?></tr>
            <tr><th><?= TROOPS ?></th><?php for($i=$start;$i<$start+10;$i++): ?><td class="<?= $e['u'.$i]==0?'none':'' ?>"><?= $e['u'.$i] ?></td><?php endfor; ?><?php if($e['hero']): ?><td><?= $e['hero'] ?></td><?php endif; ?></tr>
        </tbody>
        <tbody class="infos"><tr><th><?= UPKEEP ?></th><td colspan="<?= $colspan ?>">
            <div class="sup"><?= $technology->getUpkeep($e,$tribe) ?><img class="r4" src="img/x.gif"> <?= PER_HR ?></div>
            <div class="sback"><?php if(!$isTaskmaster): ?><a href="a2b.php?w=<?= $e['id'] ?>"><?= SEND_BACK ?></a><?php else: ?><span class="none"><b><?= SEND_BACK ?></b></span><?php endif; ?></div>
        </td></tr></tbody>
    </table>
    <?php endforeach; ?>

    <?php
    // split my reinforcements
    $enforcevill = []; $enforceoasis = [];
    foreach ($village->enforcetoyou as $e) {
        $conq = (int)$database->getOasisField($e['vref'],'conqured');
        if ($conq>0) { $e['conqured']=$conq; $enforceoasis[]=$e; } else $enforcevill[]=$e;
    }
    foreach ($village->enforceoasis as $e) $enforceoasis[]=$e;
    ?>

    <!-- TROOPS IN OTHER VILLAGES -->
    <?php if ($enforcevill): ?>
        <h4><?= TROOPS_IN_OTHER_VILLAGE ?></h4>
        <?php foreach ($enforcevill as $e):
            $colspan=10+$e['hero']; $tribe=$database->getUserField($database->getVillageField($e['from'],'owner'),'tribe',0); $start=($tribe-1)*10+1;
        ?>
        <table class="troop_details" cellpadding="1" cellspacing="1">
            <thead><tr>
                <td class="role"><a href="karte.php?d=<?= $e['from'] ?>&c=<?= $generator->getMapCheck($e['from']) ?>"><?= $database->getVillageField($e['from'],'name') ?></a></td>
                <td colspan="<?= $colspan ?>"><a href="karte.php?d=<?= $e['vref'] ?>&c=<?= $generator->getMapCheck($e['vref']) ?>"><?= REINFORCEMENTFOR ?> <?= $database->getVillageField($e['vref'],'name') ?></a></td>
            </tr></thead>
            <tbody class="units">
                <tr><th>&nbsp;</th><?php for($i=$start;$i<$start+10;$i++): ?><td><img src="img/x.gif" class="unit u<?= $i ?>" title="<?= $technology->getUnitName($i) ?>"></td><?php endfor; ?><?php if($e['hero']): ?><td><img src="img/x.gif" class="unit uhero"></td><?php endif; ?></tr>
                <tr><th><?= TROOPS ?></th><?php for($i=$start;$i<$start+10;$i++): ?><td class="<?= $e['u'.$i]==0?'none':'' ?>"><?= $e['u'.$i] ?></td><?php endfor; ?><?php if($e['hero']): ?><td><?= $e['hero'] ?></td><?php endif; ?></tr>
            </tbody>
            <tbody class="infos"><tr><th><?= UPKEEP ?></th><td colspan="<?= $colspan ?>">
                <div class="sup"><?= $technology->getUpkeep($e,$tribe) ?><img class="r4" src="img/x.gif"> <?= PER_HR ?></div>
                <div class="sback"><a href="a2b.php?r=<?= $e['id'] ?>"><?= SEND_BACK ?></a></div>
            </td></tr></tbody>
        </table>
        <?php endforeach; ?>
    <?php endif; ?>

    <!-- TROOPS IN OASIS -->
    <?php if ($enforceoasis): ?>
        <h4><?= TROOPS_IN_OASIS ?></h4>
        <?php foreach ($enforceoasis as $e):
            $colspan=10+$e['hero']; $owner=$database->getVillageField($e['from'],'owner'); $tribe=$database->getUserField($owner,'tribe',0); $start=($tribe-1)*10+1;
        ?>
        <table class="troop_details" cellpadding="1" cellspacing="1">
            <thead><tr>
                <td class="role"><a href="karte.php?d=<?= $e['vref'] ?>&c=<?= $generator->getMapCheck($e['vref']) ?>"><?= $database->getVillageField($e['conqured'],'name') ?></a></td>
                <td colspan="<?= $colspan ?>">
                    <a href="spieler.php?uid=<?= $owner ?>"><?= $database->getUserField($owner,'username',0) ?> <?= TROOPS ?></a> <?= FROM ?> <a href="karte.php?d=<?= $e['from'] ?>&c=<?= $generator->getMapCheck($e['from']) ?>"><?= $database->getVillageField($e['from'],'name') ?></a>
                </td>
            </tr></thead>
            <tbody class="units">
                <tr><th>&nbsp;</th><?php for($i=$start;$i<$start+10;$i++): ?><td><img src="img/x.gif" class="unit u<?= $i ?>"></td><?php endfor; ?><?php if($e['hero']): ?><td><img src="img/x.gif" class="unit uhero"></td><?php endif; ?></tr>
                <tr><th><?= TROOPS ?></th><?php for($i=$start;$i<$start+10;$i++): ?><td class="<?= $e['u'.$i]==0?'none':'' ?>"><?= $e['u'.$i] ?></td><?php endfor; ?><?php if($e['hero']): ?><td><?= $e['hero'] ?></td><?php endif; ?></tr>
            </tbody>
            <tbody class="infos"><tr><th><?= UPKEEP ?></th><td colspan="<?= $colspan ?>">
                <div class="sup"><?= $technology->getUpkeep($e,$tribe) ?><img class="r4" src="img/x.gif"> <?= PER_HR ?></div>
                <div class="sback"><a href="a2b.php?r=<?= $e['id'] ?>"><?= SEND_BACK ?></a></div>
            </td></tr></tbody>
        </table>
        <?php endforeach; ?>
    <?php endif; ?>

    <!-- PRISONERS (held by me) -->
    <?php $p3 = $database->getPrisoners3($village->wid); if($p3): ?>
        <h4><?= PRISONERS ?></h4>
        <?php foreach($p3 as $p):
            $colspan=10+$p['t11']; $tribe=$database->getUserField($database->getVillageField($p['from'],'owner'),'tribe',0); $start=($tribe-1)*10+1;
        ?>
        <table class="troop_details" cellpadding="1" cellspacing="1">
            <thead><tr>
                <td class="role"><a href="karte.php?d=<?= $p['wref'] ?>&c=<?= $generator->getMapCheck($p['wref']) ?>"><?= $database->getVillageField($p['wref'],'name') ?></a></td>
                <td colspan="<?= $colspan ?>"><a href="karte.php?d=<?= $p['wref'] ?>"><?= PRISONERSIN ?> <?= $database->getVillageField($p['wref'],'name') ?></a></td>
            </tr></thead>
            <tbody class="units">
                <tr><th>&nbsp;</th><?php for($i=$start;$i<$start+10;$i++): ?><td><img src="img/x.gif" class="unit u<?= $i ?>"></td><?php endfor; ?><?php if($p['t11']): ?><td><img src="img/x.gif" class="unit uhero"></td><?php endif; ?></tr>
                <tr><th><?= TROOPS ?></th><?php for($i=1;$i<=10;$i++): ?><td class="<?= $p['t'.$i]==0?'none':'' ?>"><?= $p['t'.$i] ?></td><?php endfor; ?><?php if($p['t11']): ?><td><?= $p['t11'] ?></td><?php endif; ?></tr>
            </tbody>
            <tbody class="infos"><tr><th><?= UPKEEP ?></th><td colspan="<?= $colspan+1 ?>">
                <div class="sup"><?= $technology->getUpkeep($p,$tribe,0,1) ?><img class="r4" src="img/x.gif"> <?= PER_HR ?></div>
                <div class="sback"><a href="a2b.php?delprisoners=<?= $p['id'] ?>"><?= KILL ?></a></div>
            </td></tr></tbody>
        </table>
        <?php endforeach; ?>
    <?php endif; ?>

    <!-- PRISONERS (my troops captured) -->
    <?php $p = $database->getPrisoners($village->wid); if($p): ?>
        <h4><?= PRISONERS ?></h4>
        <?php foreach($p as $pr):
            $colspan=10+$pr['t11']; $tribe=$database->getUserField($database->getVillageField($pr['from'],'owner'),'tribe',0); $start=($tribe-1)*10+1;
        ?>
        <table class="troop_details" cellpadding="1" cellspacing="1">
            <thead><tr>
                <td class="role"><a href="karte.php?d=<?= $pr['from'] ?>&c=<?= $generator->getMapCheck($pr['from']) ?>"><?= $database->getVillageField($pr['from'],'name') ?></a></td>
                <td colspan="<?= $colspan ?>"><a href="karte.php?d=<?= $pr['from'] ?>"><?= PRISONERSFROM ?> <?= $database->getVillageField($pr['from'],'name') ?></a></td>
            </tr></thead>
            <tbody class="units">
                <tr><th>&nbsp;</th><?php for($i=$start;$i<$start+10;$i++): ?><td><img src="img/x.gif" class="unit u<?= $i ?>"></td><?php endfor; ?><?php if($pr['t11']): ?><td><img src="img/x.gif" class="unit uhero"></td><?php endif; ?></tr>
                <tr><th><?= TROOPS ?></th><?php for($i=1;$i<=10;$i++): ?><td class="<?= $pr['t'.$i]==0?'none':'' ?>"><?= $pr['t'.$i] ?></td><?php endfor; ?><?php if($pr['t11']): ?><td><?= $pr['t11'] ?></td><?php endif; ?></tr>
            </tbody>
            <tbody class="infos"><tr><td colspan="<?= $colspan+1 ?>">
                <div class="sup"><img class="r6" src="img/x.gif"></div>
                <div class="sback"><a href="a2b.php?delprisoners=<?= $pr['id'] ?>"><?= SEND_BACK ?></a></div>
            </td></tr></tbody>
        </table>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php
    $out = $database->getMovement(3,$village->wid,0);
    $set = $database->getMovement(5,$village->wid,0);
    $cnt = count($set);
    foreach($out as $u) if($u['vref']==$village->wid) $cnt++;
    ?>
    <?php if($cnt>=1): ?>
        <h4><?= TROOPS_ON_THEIR_WAY ?></h4>
        <?php include '16_walking.tpl'; ?>
    <?php endif; ?>

<?php else: ?>
    <b><?= RALLYPOINT_COMMENCE ?></b><br>
<?php endif; ?>

<?php include 'upgrade.tpl'; ?>
</div>