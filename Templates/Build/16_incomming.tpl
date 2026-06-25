<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : RALLY POINT INCOMMING TROOPS                              ##
##  Type           : BUILDING TEMPLATE                                         ##
## --------------------------------------------------------------------------- ##
##  Refactored by  : Shadow                                                    ##
##  Redesign by    : Shadow                                                    ##
## --------------------------------------------------------------------------- ##
##  Contact        : cata7007@gmail.com                                        ##
##  Project        : TravianZ                                                  ##
##  Test Server    : https://travianz.org                                      ##
##  GitHub         : https://github.com/Shadowss/TravianZ                      ##
## --------------------------------------------------------------------------- ##
##  License        : TravianZ Project                                          ##
##  Copyright      : TravianZ (c) 2010-2026. All rights reserved.              ##
## --------------------------------------------------------------------------- ##
#################################################################################

include_once 'GameEngine/Data/unitdata.php';

$units = $database->getMovement(34, $village->wid, 1);
$artifactsSum = $database->getArtifactsSumByKind($session->uid, $village->wid, 3);
// Rally-point indicator (issue #249): the incoming count is never revealed; an
// incoming unit type whose stack is smaller than this village's rally point
// (gid 16) level is flagged with a bold "?" instead of a plain one.
$rpLevel = (int) $database->getFieldLevelInVillage($village->wid, 16);
?>

<style>
.atk_marker{position:relative;float:right;width:14px;height:14px;border-radius:50%;border:1px solid #666;margin:0 0 0 6px;cursor:pointer;box-shadow:inset 0 0 0 2px rgba(255,255,255,.55)}
.atk_marker.marker0{background:#dddddd}
.atk_marker.marker1{background:#3cb043}
.atk_marker.marker2{background:#f2c200}
.atk_marker.marker3{background:#e23b3b}
.atk_marker:hover{box-shadow:inset 0 0 0 2px rgba(255,255,255,.55),0 0 0 1px #333}
</style>
<script type="text/javascript">
function cycleMarker(moveid, el){
    var cur = parseInt(el.getAttribute('data-marker') || '0', 10);
    var next = (cur + 1) % 4;
    var body = 'moveid=' + encodeURIComponent(moveid) + '&marker=' + encodeURIComponent(next);
    fetch('ajax.php?f=marker', {
        method: 'POST',
        credentials: 'same-origin',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: body
    }).then(function(r){ return r.json(); }).then(function(d){
        if (d && d.ok) {
            el.setAttribute('data-marker', next);
            el.className = 'atk_marker marker' + next;
        }
    });
}
</script>

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
        // Issue #267: reveal the hero column whenever the incoming movement
        // carries a hero, not only for our own movements. For enemy attacks the
        // count stays hidden ("?") via the troops-row logic below, but the hero
        // icon column must still be shown so the defender sees an incoming hero.
        $colspan = ($u['t11'] > 0)? 11 : 10;
        $tribe = $isElders? 4 : $database->getUserField($owner, 'tribe', 0);
        $start = ($tribe - 1) * 10 + 1;
        $end = $tribe * 10;
        $dt = $generator->procMtime($u['endtime']);
        // Base travel time per troop type (issue #245): distance / unit speed,
        // WITHOUT tournament square or artefact effects. INCREASE_SPEED is the
        // server speed multiplier, matching MyGenerator::procDistanceTime().
        $mtimes = [];
        if (!$isElders) {
            $fromInfo = $database->getMInfo($from);
            $toInfo = $database->getMInfo($u['to']);
            $dist = $database->getDistance($fromInfo['x'], $fromInfo['y'], $toInfo['x'], $toInfo['y']);
            for ($i = $start; $i <= $end; $i++) {
                $spd = isset($GLOBALS['u'.$i]['speed']) ? $GLOBALS['u'.$i]['speed'] : 0;
                $mtimes[$i] = $spd > 0 ? $generator->getTimeFormat((int) round(($dist / $spd) * 3600 / INCREASE_SPEED)) : '-';
            }
        }
?>
<table class="troop_details" cellpadding="1" cellspacing="1">
    <thead><tr>
        <td class="role">
            <?php if (!$isElders):?>
                <a href="karte.php?d=<?= $from?>&c=<?= $generator->getMapCheck($from)?>"><?= $database->getVillageField($from,'name')?></a>
            <?php else:?><a><?php echo VILLAGE_OF_THE_ELDERS; ?></a><?php endif;?>
        </td>
        <td colspan="<?= $colspan?>">
            <?php if (($atk == 3 || $atk == 4) && !$isElders): $marker = (int)($u['marker'] ?? 0); $mid = (int)$u['moveid'];?>
            <span class="atk_marker marker<?= $marker?>" data-marker="<?= $marker?>" title="<?= MARK_ATTACK?>" onclick="cycleMarker(<?= $mid?>,this)"></span>
            <?php endif;?>
            <?php if (!$isElders):?>
                <a href="karte.php?d=<?= $u['to']?>&c=<?= $generator->getMapCheck($u['to'])?>"><?= $action?> <?= $database->getVillageField($u['to'],'name')?></a>
            <?php else:?><a><?= VILLAGE_OF_THE_ELDERS_TROOPS?></a><?php endif;?>
        </td>
    </tr></thead>
    <tbody class="units">
        <tr><th>&nbsp;</th>
            <?php for ($i=$start;$i<=$end;$i++):?><td><img src="img/x.gif" class="unit u<?= $i?>" title="<?= $technology->getUnitName($i)?><?= isset($mtimes[$i])? ': '.$mtimes[$i] : ''?>"></td><?php endfor;?>
            <?php if ($u['t11']):?><td><img src="img/x.gif" class="unit uhero" title="<?php echo U0; ?>"></td><?php endif;?>
        </tr>
        <tr><th><?= TROOPS?></th>
            <?php for ($i=1;$i<=$colspan;$i++):
                $val = isset($u['t'.$i])? $u['t'.$i] : 0;
                if ($isElders) { echo '<td class="none">?</td>'; continue; }
                if ($atk == 2) {
                    if (!$isMine) echo '<td class="none">?</td>';
                    else echo '<td class="'.($val==0?'none':'').'">'.($val==0?'0':$val).'</td>';
                } else {
                    // Issue #249: the incoming count is never revealed, it is
                    // always a "?". That "?" is shown in bold when the stack of
                    // this unit type is smaller than the defender's rally point
                    // level. The eyesight artifact still reveals which troop
                    // types are present (0 for the absent ones).
                    if ($val == 0) echo '<td class="none">'.($artifactsSum['totals']==0?'?':'0').'</td>';
                    elseif ($rpLevel > 0 && $val < $rpLevel) echo '<td><b style="color:#000">?</b></td>';
                    else echo '<td class="none">?</td>';
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
        $colspan=($m['t11'])?11:10; $tribe=$database->getUserField($owner,'tribe',0); $start=($tribe-1)*10+1; // #267: show hero column for incoming attacks too
        $action=($m['attack_type']==2?REINFORCEMENTFOR:($m['attack_type']==3?ATTACK_ON:RAID_ON)); $dt=$generator->procMtime($m['endtime']);
?>
<table class="troop_details" cellpadding="1" cellspacing="1">
    <thead><tr>
        <td class="role"><a href="karte.php?d=<?= $m['from']?>&c=<?= $generator->getMapCheck($m['from'])?>"><?= $database->getVillageField($m['from'],'name')?></a></td>
        <td colspan="<?= $colspan?>"><a href="karte.php?d=<?= $m['to']?>&c=<?= $generator->getMapCheck($m['to'])?>"><?= $action?> <?= $database->getOMInfo($m['to'])['name']?></a></td>
    </tr></thead>
    <tbody class="units">
        <tr><th>&nbsp;</th><?php for($i=$start;$i<$start+10;$i++):?><td><img src="img/x.gif" class="unit u<?= $i?>"></td><?php endfor;?><?php if($m['t11']):?><td><img src="img/x.gif" class="unit uhero"></td><?php endif;?></tr>
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