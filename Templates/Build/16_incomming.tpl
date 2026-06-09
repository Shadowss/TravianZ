<?php

// RALLY POINT INCOMMING TROOPS

include_once 'GameEngine/Data/unitdata.php';

$units = $database->getMovement(34, $village->wid, 1);
$artifactsSum = $database->getArtifactsSumByKind($session->uid, $village->wid, 3);
?>

<?php foreach ($units as $u):
    $session->timer++;
    $sort = (int)$u['sort_type'];
    $atk = (int)$u['attack_type'];

    if ($sort === 3 && $atk!= 1):
        $action = ($atk == 2? REINFORCEMENTFOR : ($atk == 3? ATTACK_ON : RAID_ON));
        $from = (int)$u['from'];
        $isElders = ($from === 0);
        $owner = $isElders? 0 : $database->getVillageField($from, 'owner');
        $isMine = ($owner == $session->uid);
        $colspan = ($u['t11'] > 0 && $isMine)? 11 : 10;
        $tribe = $isElders? 4 : $database->getUserField($owner, 'tribe', 0);
        $start = ($tribe - 1) * 10 + 1;
        $end = $tribe * 10;
        $dt = $generator->procMtime($u['endtime']);
?>
<table class="troop_details" cellpadding="1" cellspacing="1">
    <thead><tr>
        <td class="role">
            <?php if (!$isElders):?>
                <a href="karte.php?d=<?= $from?>&c=<?= $generator->getMapCheck($from)?>"><?= $database->getVillageField($from,'name')?></a>
            <?php else:?><a><?php echo VILLAGE_OF_THE_ELDERS; ?></a><?php endif;?>
        </td>
        <td colspan="<?= $colspan?>">
            <?php if (!$isElders):?>
                <a href="karte.php?d=<?= $u['to']?>&c=<?= $generator->getMapCheck($u['to'])?>"><?= $action?> <?= $database->getVillageField($u['to'],'name')?></a>
            <?php else:?><a><?= VILLAGE_OF_THE_ELDERS_TROOPS?></a><?php endif;?>
        </td>
    </tr></thead>
    <tbody class="units">
        <tr><th>&nbsp;</th>
            <?php for ($i=$start;$i<=$end;$i++):?><td><img src="img/x.gif" class="unit u<?= $i?>" title="<?= $technology->getUnitName($i)?>"></td><?php endfor;?>
            <?php if ($u['t11'] && $isMine):?><td><img src="img/x.gif" class="unit uhero" title="<?php echo U0; ?>"></td><?php endif;?>
        </tr>
        <tr><th><?= TROOPS?></th>
            <?php for ($i=1;$i<=$colspan;$i++):
                $val = isset($u['t'.$i])? $u['t'.$i] : 0;
                if ($isElders) { echo '<td class="none">?</td>'; continue; }
                if ($atk == 2) {
                    if (!$isMine) echo '<td class="none">?</td>';
                    else echo '<td class="'.($val==0?'none':'').'">'.($val==0?'0':$val).'</td>';
                } else {
                    if ($artifactsSum['totals']==0) echo '<td class="none">?</td>';
                    else echo '<td class="'.($val==0?'none':'').'">'.($val==0?'0':'?').'</td>';
                }
            endfor;?>
        </tr>
    </tbody>
    <tbody class="infos"><tr>
        <th><?= ARRIVAL?></th>
        <td colspan="<?= $colspan?>">
            <div class="in small"><span id="timer<?= $session->timer?>"><?= $generator->getTimeFormat($u['endtime']-time())?></span> h</div>
            <div class="at small"><?= $dt[0]!='today'? ON.' '.$dt[0].' ' : ''?><?= AT?> <?= $dt[1]?> <?= HRS?></div>
        </td>
    </tr></tbody>
</table>

<?php elseif ($sort === 4):
    $fromInfo = $database->isVillageOases($u['from'])? $database->getOMInfo($u['from']) : $database->getMInfo($u['from']);
    $colspan = $u['t11']? 11 : 10;
    $tribe = $session->tribe; $start=($tribe-1)*10+1;
    $totalRes = $u['wood']+$u['clay']+$u['iron']+$u['crop'];
    $carry = 0; for($i=0;$i<10;$i++) { $t = isset($u['t'.($i+1)])? $u['t'.($i+1)] : 0; $carry += $t * ${'u'.($start+$i)}['cap']; }
    $dt = $generator->procMtime($u['endtime']);
?>
<table class="troop_details" cellpadding="1" cellspacing="1">
    <thead><tr>
        <td class="role"><a href="karte.php?d=<?= $village->wid?>&c=<?= $generator->getMapCheck($village->wid)?>"><?= $village->vname?></a></td>
        <td colspan="<?= $colspan?>"><a href="karte.php?d=<?= $fromInfo['wref']?>&c=<?= $generator->getMapCheck($fromInfo['wref'])?>"><?= RETURNFROM?> <?= $fromInfo['name']?></a></td>
    </tr></thead>
    <tbody class="units">
        <tr><th>&nbsp;</th><?php for($i=$start;$i<$start+10;$i++):?><td><img src="img/x.gif" class="unit u<?= $i?>"></td><?php endfor;?><?php if($u['t11']):?><td><img src="img/x.gif" class="unit uhero"></td><?php endif;?></tr>
        <tr><th><?= TROOPS?></th><?php for($i=1;$i<($u['t11']?12:11);$i++): $v = isset($u['t'.$i])? $u['t'.$i] : 0;?><td class="<?= $v==0?'none':''?>"><?= $v?></td><?php endfor;?></tr>
    </tbody>
    <?php if ($totalRes>0 && $atk!=1 && $atk!=2):?>
    <tbody class="goods"><tr><th><?= BOUNTY?></th><td colspan="<?= $colspan?>">
        <div class="res"><img class="r1" src="img/x.gif"> <?= $u['wood']?> | <img class="r2" src="img/x.gif"> <?= $u['clay']?> | <img class="r3" src="img/x.gif"> <?= $u['iron']?> | <img class="r4" src="img/x.gif"> <?= $u['crop']?></div>
        <div class="carry"><img class="car" src="img/x.gif"> <?= $totalRes?>/<?= $carry?></div>
    </td></tr></tbody>
    <?php endif;?>
    <tbody class="infos"><tr><th><?= ARRIVAL?></th><td colspan="<?= $colspan?>">
        <div class="in small"><span id="timer<?= $session->timer?>"><?= $generator->getTimeFormat($u['endtime']-time())?></span> h</div>
        <div class="at"><?= $dt[0]!='today'? ON.' '.$dt[0].' ' : ''?><?= AT?> <?= $dt[1]?></div>
    </td></tr></tbody>
</table>
<?php endif; endforeach;?>

<?php foreach ($database->getOasis($village->wid) as $o):
    foreach ($database->getMovement(6,$o['wref'],0) as $m):
        $session->timer++; $owner=$database->getVillageField($m['from'],'owner'); $isMine=($owner==$session->uid);
        $colspan=($m['t11']&&$isMine)?11:10; $tribe=$database->getUserField($owner,'tribe',0); $start=($tribe-1)*10+1;
        $action=($m['attack_type']==2?REINFORCEMENTFOR:($m['attack_type']==3?ATTACK_ON:RAID_ON)); $dt=$generator->procMtime($m['endtime']);
?>
<table class="troop_details" cellpadding="1" cellspacing="1">
    <thead><tr>
        <td class="role"><a href="karte.php?d=<?= $m['from']?>&c=<?= $generator->getMapCheck($m['from'])?>"><?= $database->getVillageField($m['from'],'name')?></a></td>
        <td colspan="<?= $colspan?>"><a href="karte.php?d=<?= $m['to']?>&c=<?= $generator->getMapCheck($m['to'])?>"><?= $action?> <?= $database->getOMInfo($m['to'])['name']?></a></td>
    </tr></thead>
    <tbody class="units">
        <tr><th>&nbsp;</th><?php for($i=$start;$i<$start+10;$i++):?><td><img src="img/x.gif" class="unit u<?= $i?>"></td><?php endfor;?><?php if($m['t11']&&$isMine):?><td><img src="img/x.gif" class="unit uhero"></td><?php endif;?></tr>
        <tr><th><?= TROOPS?></th><?php for($i=1;$i<=$colspan;$i++): $v = isset($m['t'.$i])? $m['t'.$i] : 0;
            if($m['attack_type']==2){ echo $isMine? '<td class="'.($v==0?'none':'').'">'.($v?$v:'0').'</td>' : '<td class="none">?</td>'; }
            else { echo $artifactsSum['totals']==0? '<td class="none">?</td>' : '<td class="'.($v==0?'none':'').'">'.($v==0?'0':'?').'</td>'; }
        endfor;?></tr>
    </tbody>
    <tbody class="infos"><tr><th><?= ARRIVAL?></th><td colspan="<?= $colspan?>">
        <div class="in small"><span id="timer<?= $session->timer?>"><?= $generator->getTimeFormat($m['endtime']-time())?></span> h</div>
        <div class="at"><?= $dt[0]!='today'? ON.' '.$dt[0].' ' : ''?><?= AT?> <?= $dt[1]?> <?= HRS?></div>
    </td></tr></tbody>
</table>
<?php endforeach; endforeach;?>

<?php foreach ($database->getMovement(7,$village->wid,1) as $s):
    $session->timer++; $tribe=$session->tribe; $start=($tribe-1)*10+1; $dt=$generator->procMtime($s['endtime']);
?>
<table class="troop_details" cellpadding="1" cellspacing="1">
    <thead><tr>
        <td class="role"><a href="karte.php?d=<?= $village->wid?>&c=<?= $generator->getMapCheck($village->wid)?>"><?= $village->vname?></a></td>
        <td colspan="10"><a href="karte.php?d=<?= $s['to']?>&c=<?= $generator->getMapCheck($s['to'])?>"><?= $database->getMInfo($s['to'])['name']?></a></td>
    </tr></thead>
    <tbody class="units">
        <tr><th>&nbsp;</th><?php for($i=$start;$i<$start+10;$i++):?><td><img src="img/x.gif" class="unit u<?= $i?>"></td><?php endfor;?></tr>
        <tr><th><?= TROOPS?></th><?php for($i=1;$i<=10;$i++): $v=($i==10?3:0);?><td class="<?= $v==0?'none':''?>"><?= $v?></td><?php endfor;?></tr>
    </tbody>
    <tbody class="infos"><tr><th><?= ARRIVAL?></th><td colspan="10">
        <div class="in small"><span id="timer<?= $session->timer?>"><?= $generator->getTimeFormat($s['endtime']-time())?></span> h</div>
        <div class="at"><?= $dt[0]!='today'? ON.' '.$dt[0].' ' : ''?><?= AT?> <?= $dt[1]?></div>
    </td></tr></tbody>
</table>
<?php endforeach;?>