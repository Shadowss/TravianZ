<?php

// RALLY POINT WALKING

$outgoing = $database->getMovement(3, $village->wid, 0);
?>

<?php foreach ($outgoing as $m):
    $session->timer++;
    $atk = (int)$m['attack_type'];
    if ($atk == 1) $action = SCOUTING;
    elseif ($atk == 2) $action = REINFORCEMENTFOR;
    elseif ($atk == 3) $action = ATTACK_ON;
    elseif ($atk == 4) $action = RAID_ON;
    else $action = '';

    $to = $database->isVillageOases($m['to'])? $database->getOMInfo($m['to']) : $database->getMInfo($m['to']);
    $colspan = $m['t11']? 11 : 10;
    $tribe = $session->tribe;
    $start = ($tribe-1)*10+1;
    $dt = $generator->procMtime($m['endtime']);
?>
<table class="troop_details" cellpadding="1" cellspacing="1">
    <thead><tr>
        <td class="role"><a href="karte.php?d=<?= $village->wid?>&c=<?= $generator->getMapCheck($village->wid)?>"><?= $village->vname?></a></td>
        <td colspan="<?= $colspan?>"><a href="karte.php?d=<?= $to['wref']?>&c=<?= $generator->getMapCheck($to['wref'])?>"><?= $action?> <?= $to['name']?></a></td>
    </tr></thead>
    <tbody class="units">
        <tr><th>&nbsp;</th>
            <?php for($i=$start;$i<$start+10;$i++):?><td><img src="img/x.gif" class="unit u<?= $i?>" title="<?= $technology->getUnitName($i)?>"></td><?php endfor;?>
            <?php if($m['t11']):?><td><img src="img/x.gif" class="unit uhero" title="<?php echo U0; ?>"></td><?php endif;?>
        </tr>
        <tr><th><?= TROOPS?></th>
            <?php for($i=1;$i<($m['t11']?12:11);$i++): $v = isset($m['t'.$i])? $m['t'.$i] : 0;?><td class="<?= $v==0?'none':''?>"><?= $v?></td><?php endfor;?>
        </tr>
    </tbody>

    <?php if (defined('NEW_FUNCTIONS_DISPLAY_CATAPULT_TARGET') && NEW_FUNCTIONS_DISPLAY_CATAPULT_TARGET && $m['t8']>0 && $atk==3 &&!$database->isVillageOases($m['to'])):?>
    <tbody><tr>
        <th><?= CATAPULT_TARGET?></th>
        <td style="text-align:center" colspan="5"><?= $m['ctar1']==0?'Random':Building::procResType($m['ctar1'])?></td>
        <td style="text-align:center" colspan="<?= $m['t11']?6:5?>"><?= $m['ctar2']==99?'Random':($m['ctar2']==0?'-':Building::procResType($m['ctar2']))?></td>
    </tr></tbody>
    <?php endif;?>

    <tbody class="infos"><tr>
        <th><?= ARRIVAL?></th>
        <td colspan="<?= $colspan?>">
            <div class="in small"><span id="timer<?= $session->timer?>"><?= $generator->getTimeFormat($m['endtime']-time())?></span> h</div>
            <div class="at"><?= $dt[0]!='today'?ON.' '.$dt[0].' ':''?><?= AT?> <?= $dt[1]?></div>
            <?php if(($m['starttime']+90)>time()):?>
                <div class="abort"><a href="build.php?id=<?= $_GET['id']?>&mode=troops&cancel=1&moveid=<?= $m['moveid']?>"><img src="img/x.gif" class="del"></a></div>
            <?php endif;?>
        </td>
    </tr></tbody>
</table>
<?php endforeach;?>

<?php $settlers = $database->getMovement(5, $village->wid, 0);
foreach ($settlers as $s):
    $session->timer++; $tribe=$session->tribe; $start=($tribe-1)*10+1; $dt=$generator->procMtime($s['endtime']);
?>
<table class="troop_details" cellpadding="1" cellspacing="1">
    <thead><tr>
        <td class="role"><a href="karte.php?d=<?= $village->wid?>&c=<?= $generator->getMapCheck($village->wid)?>"><?= $village->vname?></a></td>
        <td colspan="10"><a href="karte.php?d=<?= $s['to']?>&c=<?= $generator->getMapCheck($s['to'])?>"><?= FOUNDNEWVILLAGE?></a></td>
    </tr></thead>
    <tbody class="units">
        <tr><th>&nbsp;</th><?php for($i=$start;$i<$start+10;$i++):?><td><img src="img/x.gif" class="unit u<?= $i?>"></td><?php endfor;?></tr>
        <tr><th><?= TROOPS?></th><?php for($i=1;$i<=10;$i++): $v=($i==10?3:0);?><td class="<?= $v==0?'none':''?>"><?= $v?></td><?php endfor;?></tr>
    </tbody>
    <tbody class="infos"><tr>
        <th><?= ARRIVAL?></th><td colspan="10">
            <div class="in small"><span id="timer<?= $session->timer?>"><?= $generator->getTimeFormat($s['endtime']-time())?></span> h</div>
            <div class="at small"><?= $dt[0]!='today'?ON.' '.$dt[0].' ':''?><?= AT?> <?= $dt[1]?></div>
            <?php if(($s['starttime']+90)>time()):?>
                <div class="abort"><a href="build.php?id=<?= $_GET['id']?>&mode=troops&cancel=1&moveid=<?= $s['moveid']?>"><img src="img/x.gif" class="del"></a></div>
            <?php endif;?>
        </td>
    </tr></tbody>
</table>
<?php endforeach;?>