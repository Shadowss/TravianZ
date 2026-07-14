<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : online.tpl 		   		                               ##
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
$active = $admin->getUserActive();
$count = count($active);

$tribeName = [1=>'Roman',2=>'Teuton',3=>'Gaul',6=>'Hun',7=>'Egyptian',8=>'Spartan',9=>'Viking'];
$tribeColor = [1=>'#c0392b',2=>'#2980b9',3=>'#27ae60',6=>'#8e44ad',7=>'#d4a017',8=>'#b03a2e',9=>'#16a085'];
$tribeImg = [1=>'',2=>'1',3=>'2',6=>'5',7=>'6',8=>'7',9=>'8'];

// MAPARE ACCES -> TEXT
$accessLabels = [
    2 => 'Normal User',
    8 => 'Multihunter',
    9 => 'Administrator'
];
$accessColors = [
    2 => '#7f8c8d',
    8 => '#2980b9',
    9 => '#c0392b'
];
?>
<style>
.online-wrap{max-width:1100px;margin:20px auto;font-family:Verdana}
.online-head{display:flex;justify-content:space-between;align-items:center;margin-bottom:12px}
.online-head h1{margin:0;font-size:18px}
.online-head .count{background:#27ae60;color:#fff;padding:4px 8px;border-radius:12px;font-size:12px;font-weight:bold}
.online-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:10px}
.user-online{background:#fff;border:1px solid #ddd;border-left:4px solid #ccc;border-radius:6px;padding:10px;box-shadow:0 1px 2px rgba(0,0,0,.05);transition:.15s}
.user-online:hover{transform:translateY(-2px);box-shadow:0 3px 8px rgba(0,0,0,.08)}
.uo-top{display:flex;justify-content:space-between;align-items:center;margin-bottom:6px}
.uo-name{font-weight:bold;font-size:13px}
.uo-name a{color:#222;text-decoration:none}
.uo-name a:hover{text-decoration:underline}
.uo-access{font-size:10px;margin-left:4px}
.uo-time{font-size:11px;color:#666}
.uo-stats{display:flex;gap:12px;margin-top:6px;font-size:11px;color:#555;flex-wrap:wrap}
.uo-stat{display:flex;align-items:center;gap:3px}
.uo-gold{margin-left:auto;font-weight:bold;color:#b8860b}
.empty-box{background:#fff;border:1px dashed #ccc;border-radius:6px;padding:40px;text-align:center;color:#999}
</style>

<div class="online-wrap">
  <div class="online-head">
    <h1>🟢 Online Users</h1>
    <div class="count"><?php echo $count;?> now</div>
  </div>

  <?php if(!$active){?>
    <div class="empty-box">No online users in last 5 minutes</div>
  <?php } else {?>
  <div class="online-grid">
    <?php foreach($active as $u){
        $uid = $database->getUserField($u['username'],'id',1);
        $varray = $database->getProfileVillages($uid);
        $totalpop = 0; foreach($varray as $v) $totalpop += $v['pop'];
        $tribe = (int)$u['tribe'];
        $color = $tribeColor[$tribe] ?? '#ccc';
        $access = (int)$u['access'];
        $accessText = $accessLabels[$access] ?? 'Level '.$access;
        $accessColor = $accessColors[$access] ?? '#999';
        $last = time() - $u['timestamp'];
        $mins = floor($last/60);
   ?>
    <div class="user-online" style="border-left:4px solid <?php echo $color;?> !important">
      <div class="uo-top">
        <div class="uo-name">
          <a href="?p=player&uid=<?php echo $uid;?>"><?php echo htmlspecialchars($u['username']);?></a>
          <span class="uo-access" style="color:<?php echo $accessColor;?> !important">[<?php echo $accessText;?>]</span>
        </div>
        <img src="../gpack/travian_default/img/u/<?php echo $tribeImg[$tribe];?>9.gif" title="<?php echo $tribeName[$tribe];?>" width="16">
      </div>
      <div class="uo-time">Last action: <?php echo $mins<1? 'just now' : $mins.' min ago';?> — <?php echo date("H:i:s",$u['timestamp']);?></div>
      <div class="uo-stats">
        <span class="uo-stat">👥 <?php echo number_format($totalpop);?></span>
        <span class="uo-stat">🏘 <?php echo count($varray);?></span>
        <span class="uo-stat" style="color:<?php echo $color;?> !important">⚔ <?php echo $tribeName[$tribe];?></span>
        <span class="uo-gold"><img src="../img/admin/gold.gif" style="vertical-align:-2px"> <?php echo $u['gold'];?></span>
      </div>
    </div>
    <?php }?>
  </div>
  <?php }?>
</div>

<script>setTimeout(()=>location.reload(),30000);</script>