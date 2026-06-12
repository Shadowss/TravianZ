<div id="content" class="map">
<?php
// ---------- 0. SETUP ----------
$d = isset($_GET['d'])? (int)$_GET['d'] : 0;
$basearray = $database->getMInfo($d);
$baseId = isset($basearray['id'])? $basearray['id'] : 0;
$uinfo = $database->getVillage($baseId);
$isOasis = ($basearray['fieldtype'] == 0);

$oasis = array('conqured'=>0,'owner'=>0);
if ($isOasis) {
    $q = $database->dblink->query('SELECT conqured, owner FROM `'.TB_PREFIX.'odata` WHERE wref='.(int)$d);
    if($q) $oasis = $q->fetch_assoc();
}
$access = $session->access;
$oasislink = '';
$coords = "(".$basearray['x']."|".$basearray['y'].")";
$otext = $isOasis? ($oasis['conqured']? OCCUOASIS : UNOCCUOASIS) : '';

// ---------- 1. FIELD ----------
$fieldMap = array(
    1=>'3-3-3-9', 2=>'3-4-5-6', 3=>'4-4-4-6', 4=>'4-5-3-6',
    5=>'5-3-4-6', 6=>'1-1-1-15', 7=>'4-4-3-7', 8=>'3-4-4-7',
    9=>'4-3-4-7', 10=>'3-5-4-6', 11=>'4-3-5-6', 12=>'5-4-3-6'
);
$tt = $isOasis? '' : (isset($fieldMap[$basearray['fieldtype']])? $fieldMap[$basearray['fieldtype']] : '');
$landd = $isOasis? array() : explode('-', $tt);

// ---------- 2. OASIS BONUS ----------
$oasisBonus = array(
    1=>array(array('r1',LUMBER,25)), 2=>array(array('r1',LUMBER,25)),
    3=>array(array('r1',LUMBER,25),array('r4',CROP,25)),
    4=>array(array('r2',CLAY,25)), 5=>array(array('r2',CLAY,25)),
    6=>array(array('r2',CLAY,25),array('r4',CROP,25)),
    7=>array(array('r3',IRON,25)), 8=>array(array('r3',IRON,25)),
    9=>array(array('r3',IRON,25),array('r4',CROP,25)),
    10=>array(array('r4',CROP,25)), 11=>array(array('r4',CROP,25)),
    12=>array(array('r4',CROP,50))
);
$bonusData = $isOasis? (isset($oasisBonus[$basearray['oasistype']])? $oasisBonus[$basearray['oasistype']] : array()) : array();
if ($isOasis) {
    $parts = array_map(function($b){ return "+".$b[2]."% ".$b[1]; }, $bonusData);
    $tt = implode(' and ', $parts).' '.PERHOUR;
}

// ---------- 3. HELPERE ----------
function tribeName($t){
    $m = array(1=>TRIBE1,2=>TRIBE2,3=>TRIBE3,4=>TRIBE4,5=>TRIBE5);
    return isset($m[$t])? $m[$t] : '';
}
function renderBonus($bonusData){
    foreach($bonusData as $b){
        $cls=$b[0]; $res=$b[1]; $pct=$b[2];
        echo '<tr><td class="ico"><img class="'.$cls.'" src="img/x.gif" title="'.$res.'"> '.$pct.'% '.$res.'</td></tr>';
    }
}
function renderReports($database,$generator,$session,$d,$limit,$typeMap=null){
    $where = $session->alliance? 'ally = '.(int)$session->alliance : 'uid = '.(int)$session->uid;
    $sql = 'SELECT ntype,id,topic,time FROM '.TB_PREFIX.'ndata WHERE ('.$limit.') AND '.$where.' AND toWref = '.(int)$d.' ORDER BY time DESC LIMIT 5';
    $res = $database->dblink->query($sql);
    if(!$res ||!$res->num_rows){ echo '<tr><td>'.THERENOINFO.'</td></tr>'; return; }
    while($row=$res->fetch_assoc()){
        $type = $row['ntype'];
        if($typeMap && isset($typeMap[$type])) $type = $typeMap[$type];
        if($type>=18 && $type<=22){
            $icon = '<img src="gpack/travian_default/img/scouts/'.$type.'.gif" alt="'.$row['topic'].'" title="'.$row['topic'].'">';
        } else {
            $icon = '<img src="img/x.gif" class="iReport iReport'.$row['ntype'].'" title="'.$row['topic'].'">';
        }
        $date = $generator->procMtime($row['time']);
        echo '<tr><td>'.$icon.' <a href="berichte.php?id='.$row['id'].'">'.$date[0].' '.substr($date[1],0,5).'</a></td></tr>';
    }
}
?>

<h1><?php
if(!$isOasis){
    echo!$basearray['occupied']? ABANDVALLEY : $basearray['name'];
} else {
    echo $oasis['conqured']? OCCUOASIS : UNOCCUOASIS;
}
echo ' '.$coords;
?></h1>

<?php if($basearray['occupied'] && $basearray['capital']) echo '<div id="dmain">(capital)</div>';?>

<?php if($uinfo && $uinfo['owner']==3 && $uinfo['name']==PLANVILLAGE){?>
<img src="img/x.gif" id="detailed_map" class="f99" alt="<?php echo PLANVILLAGE;?>">
<?php } else {
    $mapClass = $isOasis? 'w'.$basearray['oasistype'] : 'f'.$basearray['fieldtype'];
?>
<img src="img/x.gif" id="detailed_map" class="<?php echo $mapClass;?>" alt="<?php echo htmlspecialchars($tt);?>" title="<?php echo htmlspecialchars($tt);?>">
<?php }?>

<div id="map_details">
<?php if($isOasis){?>
    <?php if($oasis['owner']==2){?>
        <table id="bonus" class="tableNone bonus"><thead><tr><th><?php echo BONUS;?></th></tr></thead><tbody>
            <?php renderBonus($bonusData);?>
        </tbody></table>

        <table id="troop_info" class="tableNone"><thead><tr><th colspan="3"><?php echo TROOPS;?>:</th></tr></thead><tbody>
        <?php
        $unit = $database->getUnit($d);
        $unames = array(31=>U31,32=>U32,33=>U33,34=>U34,35=>U35,36=>U36,37=>U37,38=>U38,39=>U39,40=>U40);
        $has=false;
        for($i=31;$i<=40;$i++) if($unit['u'.$i]>0){
            $has=true;
            if(!$oasislink) $oasislink = rtrim(HOMEPAGE,'/').'/warsim.php?target=4';
            $oasislink.= '&amp;u'.$i.'='.$unit['u'.$i];
            echo '<tr><td class="ico"><img class="unit u'.$i.'" src="img/x.gif" alt="'.$unames[$i].'"></td><td class="val">'.$unit['u'.$i].'</td><td class="desc">'.$unames[$i].'</td></tr>';
        }
        if(!$has) echo '<tr><td>'.NOTROOP.'</td></tr>';
       ?>
        </tbody></table>

        <table class="tableNone rep"><thead><tr><th><?php echo REPORT;?>:</th></tr></thead><tbody>
        <?php
        $tmp = $database->getVillage($d);
        $isOwner = $session->uid == (isset($tmp['owner'])? $tmp['owner'] : 0);
        $limit = $isOwner? 'ntype > 3 AND ntype < 8' : 'ntype < 8 OR ntype > 17';
        renderReports($database,$generator,$session,$d,$limit);
       ?>
        </tbody></table>

    <?php } else { $u = $database->getUserArray($oasis['owner'],1);?>
        <table id="village_info" class="tableNone"><tbody>
            <tr><th><?php echo TRIBE;?></th><td><?php echo tribeName($u['tribe']);?></td></tr>
            <tr><th><?php echo ALLIANCE;?></th><td><?php echo $u['alliance']? '<a href="allianz.php?aid='.$u['alliance'].'">'.$database->getUserAlliance($oasis['owner']).'</a>' : '-';?></td></tr>
            <tr><th><?php echo OWNER;?></th><td><a href="spieler.php?uid=<?php echo $oasis['owner'];?>"><?php echo $database->getUserField($oasis['owner'],'username',0);?></a></td></tr>
            <tr><th><?php echo VILLAGE;?></th><td><a href="karte.php?d=<?php echo $oasis['conqured'];?>&c=<?php echo $generator->getMapCheck($oasis['conqured']);?>"><?php echo $database->getVillageField($oasis['conqured'],'name');?></a></td></tr>
        </tbody></table>
        <table id="bonus" class="tableNone bonus"><thead><tr><th><?php echo BONUS;?></th></tr></thead><tbody><?php renderBonus($bonusData);?></tbody></table>
        <table class="tableNone rep"><thead><tr><th><?php echo REPORT;?></th></tr></thead><tbody>
        <?php
        $tmp = $database->getVillage($d);
        $isOwner = $session->uid == (isset($tmp['owner'])? $tmp['owner'] : 0);
        $limit = $isOwner? '(ntype > 3 AND ntype < 8) OR ntype = 20 OR ntype = 21' : 'ntype < 8 OR ntype > 17';
        renderReports($database,$generator,$session,$d,$limit);
       ?>
        </tbody></table>
    <?php }?>

<?php } elseif(!$basearray['occupied']){?>
    <table id="distribution" class="tableNone"><thead><tr><th colspan="3"><?php echo LANDDIST;?></th></tr></thead><tbody>
        <tr><td class="ico"><img class="r1" src="img/x.gif"></td><td class="val"><?php echo $landd[0];?></td><td class="desc"><?php echo WOODCUTTER;?></td></tr>
        <tr><td class="ico"><img class="r2" src="img/x.gif"></td><td class="val"><?php echo $landd[1];?></td><td class="desc"><?php echo CLAYPIT;?></td></tr>
        <tr><td class="ico"><img class="r3" src="img/x.gif"></td><td class="val"><?php echo $landd[2];?></td><td class="desc"><?php echo IRONMINE;?></td></tr>
        <tr><td class="ico"><img class="r4" src="img/x.gif"></td><td class="val"><?php echo $landd[3];?></td><td class="desc"><?php echo CROPLAND;?></td></tr>
    </tbody></table>

<?php } else { $u = $database->getUserArray($basearray['owner'],1);?>
    <table id="village_info" class="tableNone"><tbody>
        <tr><th><?php echo TRIBE;?></th><td><?php echo tribeName($u['tribe']);?></td></tr>
        <tr><th><?php echo ALLIANCE;?></th><td><?php echo $u['alliance']? '<a href="allianz.php?aid='.$u['alliance'].'">'.$database->getUserAlliance($basearray['owner']).'</a>' : '-';?></td></tr>
        <tr><th><?php echo OWNER;?></th><td><a href="spieler.php?uid=<?php echo $basearray['owner'];?>"><?php echo $database->getUserField($basearray['owner'],'username',0);?></a></td></tr>
        <tr><th><?php echo POP;?></th><td><?php echo $basearray['pop'];?></td></tr>
    </tbody></table>
    <table class="tableNone rep"><thead><tr><th><?php echo REPORT;?>:</th></tr></thead><tbody>
    <?php
    $isOwner = $session->uid == $basearray['owner'];
    $limit = $isOwner? '(ntype > 3 AND ntype < 8) OR ntype = 23' : '(ntype < 8 OR (ntype > 17 AND ntype < 22)) OR ntype = 22';
    renderReports($database,$generator,$session,$d,$limit,array(23=>22));
   ?>
    </tbody></table>
<?php }?>
</div>

<table id="options" class="tableNone"><thead><tr><th><?php echo OPTION;?></th></tr></thead><tbody>
<tr><td><a href="karte.php?z=<?php echo $d;?>">&raquo; <?php echo CENTREMAP;?>.</a></td></tr>
<?php if(!$basearray['occupied']){?>
<tr><td class="none">
<?php
if($isOasis){
    $canRaid = $village->resarray['f39']>0;
    if($canRaid){
        echo '<a href="a2b.php?z='.$d.'&o">&raquo; '.RAID.' '.$otext.'</a>';
    } else {
        echo '&raquo; '.RAID.' '.$otext.' ('.BUILDRALLY.')';
    }
    if($oasislink) echo '</td></tr><tr><td><a href="'.$oasislink.'">&raquo; Combat Simulator</a>';
} else {
    $total = count($database->getProfileVillages($session->uid));
    $need = ${'cp'.CP}[$total+1];
    $have = floor($database->getUserField($session->uid,'cp',0));
    $settlers = $village->unitarray['u'.$session->tribe.'0'];
    if($settlers>=3 && $have>=$need && $village->resarray['f39']>0){
        echo '<a href="a2b.php?id='.$d.'&s=1">&raquo; '.FNEWVILLAGE.'</a>';
    } elseif($settlers>=3 && $have<$need){
        echo '&raquo; '.FNEWVILLAGE.' ('.$have.'/'.$need.' '.CULTUREPOINT.')';
    } elseif(!$village->resarray['f39']){
        echo '&raquo; '.FNEWVILLAGE.' ('.BUILDRALLY.')';
    } else {
        echo '&raquo; '.FNEWVILLAGE.' ('.$settlers.'/3 '.SETTLERSAVAIL.')';
    }
}
?>
</td></tr>
<?php } elseif($basearray['occupied'] && $basearray['wref']!= $_SESSION['wid']){
    $tbl = $isOasis? 'odata' : 'vdata';
    $qr = $database->dblink->query('SELECT owner FROM `'.TB_PREFIX.$tbl.'` WHERE wref='.(int)$d);
    $ownerId = $qr? $qr->fetch_assoc() : array('owner'=>0);
    $ownerId = $ownerId['owner'];
    $tUser = $database->dblink->query('SELECT access,id,vac_mode,protect FROM `'.TB_PREFIX.'users` WHERE id='.(int)$ownerId)->fetch_assoc();
    $banned = $tUser['access']==0 || ($tUser['access']==MULTIHUNTER && $tUser['id']==5) || (!ADMIN_ALLOW_INCOMING_RAIDS && $tUser['access']==9);
?>
<tr><td class="none">
<?php
if($banned) echo '&raquo; '.SENDTROOP.' ('.BAN.')';
elseif($tUser['vac_mode']=='1') echo '&raquo; Send troops. (Vacation mode on)';
elseif($tUser['protect'] < time()) echo $village->resarray['f39']>0? '<a href="a2b.php?s=2&z='.$d.'">&raquo; '.SENDTROOP.'</a>' : '&raquo; '.SENDTROOP.' ('.BUILDRALLY.')';
else echo '&raquo; '.SENDTROOP.' ('.BEGINPRO.')';
?>
</td></tr>
<tr><td class="none">
<?php
if($banned) echo '&raquo; '.SENDMERC.' ('.BAN.')';
elseif($tUser['vac_mode']=='1') echo '&raquo; Send merchant(s). (Vacation mode on)';
else echo $building->getTypeLevel(17)? '<a href="build.php?z='.$d.'&id='.$building->getTypeField(17).'">&raquo; '.SENDMERC.'</a>' : '&raquo; '.SENDMERC.' ('.BUILDMARKET.')';
?>
</td></tr>
<?php }?>
</tbody></table>
</div>