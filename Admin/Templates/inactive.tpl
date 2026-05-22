<?php
#################################################################################
##  inactive.tpl - FIXED 2025                                                 ##
#################################################################################
if($_SESSION['access'] < MULTIHUNTER) die("Access Denied!");
global $database;

function inactiveRange($daysMin, $daysMax = null){
    global $database;
    $now = time();
    $from = $now - ($daysMin * 86400);
    $to = $daysMax ? $now - ($daysMax * 86400) : 0;
    if($daysMax === null){
        $q = "SELECT * FROM ".TB_PREFIX."users WHERE timestamp < $from AND id>5 AND tribe BETWEEN 1 AND 3 ORDER BY timestamp ASC LIMIT 200";
    } else {
        $q = "SELECT * FROM ".TB_PREFIX."users WHERE timestamp <= $from AND timestamp > $to AND id>5 AND tribe BETWEEN 1 AND 3 ORDER BY timestamp ASC LIMIT 200";
    }
    $res = $database->query($q);
    return $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
}

$ranges = [
    '1-3 days' => inactiveRange(1,3),
    '3-7 days' => inactiveRange(3,7),
    '7+ days' => inactiveRange(7,null)
];

$tribeImg = [1=>'',2=>'1',3=>'2'];
$tribeName = [1=>'Roman',2=>'Teuton',3=>'Gaul'];
?>
<style>
.inactive-wrap{max-width:1100px;margin:20px auto;font-family:Verdana}
.inactive-head{display:flex;align-items:center;gap:8px;margin-bottom:12px}
.inactive-head h2{margin:0;font-size:18px}
.inactive-tabs{display:flex;gap:8px;margin-bottom:12px}
.inactive-tabs button{padding:8px 14px;border:1px solid #ddd;background:#f7f7;border-radius:6px 6px 0 0;cursor:pointer;font-size:12px}
.inactive-tabs button.active{background:#fff;border-bottom:1px solid #fff;font-weight:bold}
.inactive-panel{background:#fff;border:1px solid #ddd;border-radius:0 6px 6px 6px;padding:12px;display:none}
.inactive-panel.active{display:block}
.inactive-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:10px;align-items:stretch}
.user-card{border:1px solid #eee;border-radius:6px;padding:8px;background:#fafafa;display:flex;flex-direction:column;justify-content:space-between;height:100%;box-sizing:border-box}
.user-card .top{display:flex;justify-content:space-between;align-items:center}
.user-card .name{font-weight:bold;font-size:12px}
.user-card .name a{text-decoration:none;color:#222}
.user-card .meta{font-size:11px;color:#666;display:flex;gap:10px;flex-wrap:wrap;margin:4px 0}
.user-card .stats{display:flex;justify-content:space-between;font-size:11px;margin-top:6px;padding-top:4px;border-top:1px dotted #ddd}
.badge{font-size:10px;padding:2px 5px;border-radius:3px;background:#eee}
.badge.gold{background:#fff8e1}
</style>

<div class="inactive-wrap">
  <div class="inactive-head">
    <svg viewBox="0 0 24 24" width="22" height="22" fill="none"><circle cx="12" cy="8" r="4" fill="#777"/><path d="M4 20c0-3.3 3.6-6 8-6s8 2.7 8 6v1H4v-1z" fill="#777"/><circle cx="18" cy="18" r="4" fill="#e67e22"/><path d="M18 15v3l2 1" stroke="#fff" stroke-width="1.5" stroke-linecap="round"/></svg>
    <h2>Inactive Users</h2>
  </div>
  
  <div class="inactive-tabs">
    <?php $i=0; foreach($ranges as $label=>$list){ $i++; ?>
      <button class="<?php echo $i==1?'active':''; ?>" onclick="showTab(<?php echo $i; ?>)"><?php echo $label; ?> (<?php echo count($list); ?>)</button>
    <?php } ?>
  </div>

  <?php $i=0; foreach($ranges as $label=>$users){ $i++; ?>
  <div class="inactive-panel <?php echo $i==1?'active':''; ?>" id="tab<?php echo $i; ?>">
    <?php if(empty($users)){ echo "<div style='color:#999;padding:20px;text-align:center'>No users in this range</div>"; } else { ?>
    <div class="inactive-grid">
      <?php foreach($users as $u){
        $uid = $u['id'];
        $varray = $database->getProfileVillages($uid);
        $totalpop = 0; foreach($varray as $v) $totalpop += $v['pop'];
        $days = floor((time()-$u['timestamp'])/86400);
        $hours = floor(((time()-$u['timestamp'])%86400)/3600);
        $tribe = $u['tribe'];
      ?>
      <div class="user-card">
        <div>
          <div class="top">
            <div class="name"><a href="?p=player&uid=<?php echo $uid; ?>"><?php echo htmlspecialchars($u['username']); ?></a> <span style="color:#999">[<?php echo $u['access']; ?>]</span></div>
            <img src="../gpack/travian_default/img/u/<?php echo $tribeImg[$tribe]; ?>9.gif" title="<?php echo $tribeName[$tribe]; ?>" width="16">
          </div>
          <div class="meta">
            <span>⏱ <?php echo $days; ?>d <?php echo $hours; ?>h ago</span>
            <span>👥 <?php echo $totalpop; ?> pop</span>
            <span>🏘 <?php echo count($varray); ?> vil</span>
          </div>
        </div>
        <div class="stats">
          <span class="badge gold">💰 <?php echo $u['gold']; ?></span>
          <span><a href="?p=player&uid=<?php echo $uid; ?>&action=delete" onclick="return confirm('Delete?')" style="color:#c00;text-decoration:none">delete</a></span>
        </div>
      </div>
      <?php } ?>
    </div>
    <?php } ?>
  </div>
  <?php } ?>
</div>

<script>
function showTab(n){
  document.querySelectorAll('.inactive-tabs button').forEach((b,i)=>b.classList.toggle('active', i==n-1));
  document.querySelectorAll('.inactive-panel').forEach((p,i)=>p.classList.toggle('active', i==n-1));
}
</script>