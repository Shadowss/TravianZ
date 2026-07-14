<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : server_info.tpl 		                                   ##
##  Type           : Admin Panel Frontend                                      ##
## --------------------------------------------------------------------------- ##
##  Developed by   : Dzoki (Original)                                          ##
##  Refactored by  : Shadow                                                    ##
##  Redesign by    : Shadow                                                    ##
## --------------------------------------------------------------------------- ##
##  Contact        : cata7007@gmail.com                                        ##
##  Project        : TravianZ                                                  ##
##  GitHub         : https://github.com/Shadowss/TravianZ                      ##
## --------------------------------------------------------------------------- ##
##  License        : TravianZ Project                                          ##
##  Copyright      : TravianZ (c) 2010-2025. All rights reserved.              ##
## --------------------------------------------------------------------------- ##
#################################################################################

if($_SESSION['access'] < MULTIHUNTER) die("Access Denied!");

function formatNum($n) {
    $n = (int)$n;
    if ($n >= 1000000000) return round($n / 1000000000, 2).'B';
    if ($n >= 1000000) return round($n / 1000000, 2).'M';
    if ($n >= 1000) return round($n / 1000, 1).'K';
    return $n;
}
function q1($sql){ global $database; $r=$database->query($sql); return $r ? $r->fetch_assoc() : []; }

// ---- DATE ----
$users = (int)(q1("SELECT COUNT(*) c FROM ".TB_PREFIX."users WHERE tribe IN (1,2,3,6,7,8,9)")['c'] ?? 0);
$active = (int)(q1("SELECT COUNT(*) c FROM ".TB_PREFIX."active")['c'] ?? 0);
$online = (int)(q1("SELECT COUNT(*) c FROM ".TB_PREFIX."users WHERE timestamp > ".(time()-300)." AND tribe>0")['c'] ?? 0);
$banned = (int)(q1("SELECT COUNT(*) c FROM ".TB_PREFIX."users WHERE access=0")['c'] ?? 0);
$villages = (int)(q1("SELECT COUNT(*) c FROM ".TB_PREFIX."vdata")['c'] ?? 0);
$pop = (int)(q1("SELECT SUM(pop) s FROM ".TB_PREFIX."vdata")['s'] ?? 0);

$tribes = [1=>0,2=>0,3=>0,6=>0,7=>0,8=>0,9=>0];
foreach([1,2,3,6,7,8,9] as $t){ $tribes[$t] = (int)(q1("SELECT COUNT(*) c FROM ".TB_PREFIX."users WHERE tribe=$t")['c'] ?? 0); }

$gold = (int)(q1("SELECT SUM(gold) s FROM ".TB_PREFIX."users")['s'] ?? 0);

// ---- TRUPE ----
$cells = ['SUM(hero) as hero'];
for($i=1;$i<=90;$i++) $cells[] = "SUM(u$i) AS u$i";
$uv = q1("SELECT ".implode(',',$cells)." FROM ".TB_PREFIX."units");
$ue = q1("SELECT ".implode(',',$cells)." FROM ".TB_PREFIX."enforcement");
?>
<style>
.sinfo-wrap{max-width:1100px;margin:20px auto;font-family:Verdana;color:#222}
.sinfo-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:12px;margin-bottom:18px}
.scard{background:#fff;border:1px solid #ddd;border-radius:8px;padding:14px;box-shadow:0 1px 3px rgba(0,0,0,.05);color:#222}
.scard h3{margin:0 0 8px;font-size:13px;color:#111;border-bottom:1px solid #eee;padding-bottom:6px}
.scard .row{display:flex;justify-content:space-between;padding:4px 0;font-size:12px;border-bottom:1px dotted #f0f0f0;color:#444}
.scard .row:last-child{border:0}
.scard .val{font-weight:bold;color:#000}
.tribe-bar{height:8px;background:#eee;border-radius:4px;overflow:hidden;margin:4px 0}
.tribe-bar span{display:block;height:100%}
.romans{background:#c0392b}.teutons{background:#2980b9}.gauls{background:#27ae60}.huns{background:#8e44ad}.egyptians{background:#d4a017}.spartans{background:#b03a2e}.vikings{background:#16a085}
.troops-wrap{background:#fff;border:1px solid #ddd;border-radius:8px;padding:14px;color:#222}
.troops-grid{display:grid;grid-template-columns:repeat(5,1fr);gap:10px}
.tribe-box{border:1px solid #eee;border-radius:6px;padding:8px;background:#fff}
.tribe-box h4{margin:0 0 6px;font-size:12px;text-align:center;color:#111}
.unit{display:flex;align-items:center;justify-content:space-between;padding:3px 0;font-size:11px;border-bottom:1px dotted #f5f5f5;color:#444}
.unit img{width:16px;height:16px;margin-right:4px}
.unit .cnt{font-weight:bold;color:#000}
.unit svg{width:16px;height:16px;margin-right:4px;vertical-align:-3px}
@media(max-width:900px){.sinfo-grid{grid-template-columns:1fr}.troops-grid{grid-template-columns:repeat(2,1fr)}}
</style>

<div class="sinfo-wrap">

<div class="sinfo-grid">
  <div class="scard">
    <h3>🌍 World Information</h3>
    <div class="row"><span>Registered players</span><span class="val"><?php echo number_format($users); ?></span></div>
    <div class="row"><span>Active players</span><span class="val"><?php echo $active; ?></span></div>
    <div class="row"><span>Players online</span><span class="val" style="color:#27ae60"><?php echo $online; ?></span></div>
    <div class="row"><span>Players banned</span><span class="val" style="color:#c0392b"><?php echo $banned; ?></span></div>
    <div class="row"><span>Villages settled</span><span class="val"><?php echo number_format($villages); ?></span></div>
    <div class="row"><span>Total population</span><span class="val"><?php echo number_format($pop); ?></span></div>
  </div>

  <div class="scard">
    <h3>👥 Player Distribution</h3>
    <?php $names=[1=>'Romans',2=>'Teutons',3=>'Gauls',6=>'Huns',7=>'Egyptians',8=>'Spartans',9=>'Vikings']; $colors=[1=>'romans',2=>'teutons',3=>'gauls',6=>'huns',7=>'egyptians',8=>'spartans',9=>'vikings'];
    foreach($names as $id=>$name){
        $pct = $users ? round($tribes[$id]/$users*100,1) : 0;
        echo "<div class='row'><span>$name</span><span class='val'>{$tribes[$id]} ($pct%)</span></div>";
        echo "<div class='tribe-bar'><span class='$colors[$id]' style='width:$pct%'></span></div>";
    } ?>
  </div>

  <div class="scard">
    <h3>💰 Server Economy</h3>
    <div class="row"><span><img src="../<?php echo GP_LOCATE; ?>img/a/gold.gif"> Total Gold</span><span class="val"><?php echo number_format($gold); ?></span></div>
    <div class="row"><span>Avg Gold/player</span><span class="val"><?php echo $users ? number_format($gold/$users,0) : 0; ?></span></div>
    <div class="row"><span>Server started</span><span class="val"><?php echo defined('START_DATE') ? date('d.m.Y', strtotime(START_DATE)) : '-'; ?></span></div>
    <div class="row"><span>Uptime</span><span class="val"><?php echo defined('START_DATE') ? floor((time()-strtotime(START_DATE))/86400).' days' : '-'; ?></span></div>
  </div>
</div>

<div class="troops-wrap">
  <h3 style="margin:0 0 10px;font-size:14px">⚔️ Troops on Server (villages + reinforcements)</h3>
  <div class="troops-grid">
    <?php
    $tribesUnits = [
        'Romans' => range(1,10),
        'Teutons' => range(11,20),
        'Gauls' => range(21,30),
        'Nature' => range(31,40),
        'Natars' => range(41,50),
        'Huns' => range(51,60),
        'Egyptians' => range(61,70),
        'Spartans' => range(71,80),
        'Vikings' => range(81,90)
    ];
    foreach($tribesUnits as $tribe=>$ids){
        echo "<div class='tribe-box'><h4>$tribe</h4>";
        $has=false;
        foreach($ids as $u){
            $total = (int)($uv["u$u"] ?? 0) + (int)($ue["u$u"] ?? 0);
            if($total>0){ $has=true;
                echo "<div class='unit'><span><img src='../".GP_LOCATE."img/u/$u.gif'> u$u</span><span class='cnt' title='$total'>".formatNum($total)."</span></div>";
            }
        }
        if(!$has) echo "<div class='unit'><span style='color:#999'>No troops</span></div>";
        echo "</div>";
    }
	$heroTotal = (int)($uv['hero'] ?? 0) + (int)($ue['hero'] ?? 0);
	echo "<div class='tribe-box'><h4>Heroes</h4><div class='unit'><span><svg viewBox='0 0 24 24' fill='#f1c40f' xmlns='http://www.w3.org/2000/svg'><path d='M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z'/></svg> Hero</span><span class='cnt'>".formatNum($heroTotal)."</span></div></div>";
    ?>
  </div>
</div>

</div>