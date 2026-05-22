<?php
#################################################################################
## online.tpl - REDESIGN 2025 ##
#################################################################################
if($_SESSION['access'] < MULTIHUNTER) die("Access Denied!");
$active = $admin->getUserActive();
$count = count($active);

$tribeName = [1=>'Roman',2=>'Teuton',3=>'Gaul'];
$tribeColor = [1=>'#c0392b',2=>'#2980b9',3=>'#27ae60'];
$tribeImg = [1=>'',2=>'1',3=>'2'];
?>
<style>
.online-wrap{max-width:1100px;margin:20px auto;font-family:Verdana}
.online-head{display:flex;justify-content:space-between;align-items:center;margin-bottom:12px}
.online-head h1{margin:0;font-size:18px}
.online-head.count{background:#27ae60;color:#fff;padding:4px 8px;border-radius:12px;font-size:12px;font-weight:bold}
.online-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:10px}
.user-online{background:#fff;border:1px solid #ddd;border-left:4px solid #ccc;border-radius:6px;padding:10px;box-shadow:0 1px 2px rgba(0,0,0,.05);transition:.15s}
.user-online:hover{transform:translateY(-2px);box-shadow:0 3px 8px rgba(0,0,0,.08)}
.user-online.roman{border-left-color:#c0392b}
.user-online.teuton{border-left-color:#2980b9}
.user-online.gaul{border-left-color:#27ae60}
.uo-top{display:flex;justify-content:space-between;align-items:center;margin-bottom:6px}
.uo-name{font-weight:bold;font-size:13px}
.uo-name a{color:#222;text-decoration:none}
.uo-name a:hover{text-decoration:underline}
.uo-access{font-size:10px;color:#999;margin-left:4px}
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
        $class = strtolower($tribeName[$tribe]?? 'roman');
        $last = time() - $u['timestamp'];
        $mins = floor($last/60);
   ?>
    <div class="user-online <?php echo $class;?>">
      <div class="uo-top">
        <div class="uo-name">
          <a href="?p=player&uid=<?php echo $uid;?>"><?php echo htmlspecialchars($u['username']);?></a>
          <span class="uo-access">[<?php echo $u['access'];?>]</span>
        </div>
        <img src="../gpack/travian_default/img/u/<?php echo $tribeImg[$tribe];?>9.gif" title="<?php echo $tribeName[$tribe];?>" width="16">
      </div>
      <div class="uo-time">Last action: <?php echo $mins<1? 'just now' : $mins.' min ago';?> — <?php echo date("H:i:s",$u['timestamp']);?></div>
      <div class="uo-stats">
        <span class="uo-stat">👥 <?php echo number_format($totalpop);?></span>
        <span class="uo-stat">🏘 <?php echo count($varray);?></span>
        <span class="uo-stat">⚔️ <?php echo $tribeName[$tribe];?></span>
        <span class="uo-gold"><img src="../img/admin/gold.gif" style="vertical-align:-2px"> <?php echo $u['gold'];?></span>
      </div>
    </div>
    <?php }?>
  </div>
  <?php }?>
</div>

<script>
// auto-refresh la 30 secunde
setTimeout(()=>location.reload(), 30000);
</script>