<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<head>
  <link rel="shortcut icon" href="favicon.ico"/>
  <title><?php echo ($_SESSION['access'] == ADMIN ? 'Admin Control Panel' : 'Multihunter Control Panel'); ?> - TravianZ</title>
  <link rel="stylesheet" type="text/css" href="../img/admin/admin.css">
  <link rel="stylesheet" type="text/css" href="../img/admin/acp.css">
  <link rel="stylesheet" type="text/css" href="../img/../img.css">
  <script src="mt-full.js?423cb" type="text/javascript"></script>
  <script src="ajax.js" type="text/javascript"></script>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta http-equiv="imagetoolbar" content="no">
  <style>
    .log-wrap{max-width:100%;margin:12px;font-family:Tahoma,Verdana,Arial,sans-serif}
    .log-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:8px}
    .log-head h2{margin:0;font-size:16px;display:flex;align-items:center;gap:6px;color:#222}
    .log-filters{display:flex;gap:5px;flex-wrap:wrap;margin-bottom:8px}
    .log-filters button{padding:4px 10px;font-size:11px;border:1px solid #bbb;border-radius:14px;background:#f5f5f5;cursor:pointer}
    .log-filters button.active{background:#2c3e50;color:#fff;border-color:#2c3e50}
    .log-card{background:#fff;border:1px solid #bbb;border-radius:6px;overflow:hidden}
    .logTable{width:100%;border-collapse:collapse;font-size:11px}
    .logTable th{background:#3a4f63;color:#fff;padding:5px 6px;text-align:left;font-weight:bold;font-size:10px;white-space:nowrap}
    .logTable td{padding:5px 6px;border-bottom:1px solid #eee;vertical-align:top;line-height:14px}
    .logTable tr:hover{background:#f5f9ff}
    .logTable a{color:#004a9f;text-decoration:none}
    .logTable a:hover{text-decoration:underline}
    .logCat{font-weight:bold;padding:2px 6px;border-radius:3px;color:#fff;font-size:10px;white-space:nowrap}
    .cat-ban{background:#c0392b} .cat-unban{background:#27ae60}
    .cat-gold{background:#b8860b} .cat-plus{background:#6a5acd}
    .cat-maint{background:#555} .cat-village{background:#0073aa}
    .cat-msg{background:#e67e22} .cat-other{background:#7f8c8d}
  </style>
</head>
<?php
#################################################################################
##  admin_log.tpl - FIX unban duplicat ##
#################################################################################

if($_SESSION['access'] < ADMIN) die("Access Denied: You are not Admin!");

$adminLogs = $database->getAdminLog();
$unified = [];

foreach($adminLogs as $l) {
    // FIX: sărim peste unban-urile din log-ul vechi, le luăm doar din banlist
    if(stripos($l['log'], 'unbanned') !== false || stripos($l['log'], 'unban') !== false) {
        continue;
    }
    $unified[] = [
        'id' => $l['id'],
        'time' => $l['time'],
        'user' => $l['user'],
        'type' => 'admin',
        'text' => $l['log']
    ];
}

// Ban-uri și Unban-uri din banlist
$banQ = mysqli_query($GLOBALS["link"], "
    SELECT id, uid, name, reason, time, end, admin, active 
    FROM ".TB_PREFIX."banlist 
    ORDER BY time DESC 
    LIMIT 300
");
while($b = mysqli_fetch_assoc($banQ)) {
    // BAN
    $unified[] = [
        'id' => 1000000 + $b['id'],
        'time' => $b['time'],
        'user' => $b['admin'] ?: 1,
        'type' => 'ban',
        'text' => "Banned user <a href='admin.php?p=player&uid={$b['uid']}'>{$b['name']}</a> (Reason: {$b['reason']})",
        'active' => $b['active']
    ];
    // UNBAN
    if($b['active'] == 0 && $b['end'] > $b['time']) {
        $unified[] = [
            'id' => 2000000 + $b['id'],
            'time' => $b['end'],
            'user' => $b['admin'] ?: 1,
            'type' => 'unban',
            'text' => "Unbanned user <a href='admin.php?p=player&uid={$b['uid']}'>{$b['name']}</a>",
            'active' => 0
        ];
    }
}

usort($unified, function($a,$b){ return $b['time'] <=> $a['time']; });
$unified = array_slice($unified, 0, 300);
$perPage = 20;
$page = isset($_GET['pg']) ? max(1,intval($_GET['pg'])) : 1;
$total = count($unified);
$totalPages = ceil($total / $perPage);
$offset = ($page-1) * $perPage;
$paged = array_slice($unified, $offset, $perPage);

function logCategory($entry) {
    if($entry['type']=='ban') return ['BAN','cat-ban','🔨'];
    if($entry['type']=='unban') return ['UNBAN','cat-unban','🔓'];
    $t = strtolower(strip_tags($entry['text']));
    // FIX: prinde orice unban din text
    if (strpos($t,'unban')!==false) return ['UNBAN','cat-unban','🔓'];
    if (strpos($t,'mass ban')!==false) return ['BAN','cat-ban','🔨'];
    if (strpos($t,'gold')!==false) return ['GOLD','cat-gold','💰'];
    if (strpos($t,'plus')!==false && strpos($t,'bonus')===false) return ['PLUS','cat-plus','⭐'];
    if (strpos($t,'bonus')!==false) return ['BONUS','cat-plus','📈'];
    if (strpos($t,'reset')!==false) return ['RESET','cat-maint','⚙'];
    if (strpos($t,'village')!==false || strpos($t,'buildings')!==false || strpos($t,'renamed')!==false) return ['VILLAGE','cat-village','🏘'];
    if (strpos($t,'message')!==false) return ['MESSAGE','cat-msg','✉'];
    return ['OTHER','cat-other','📝'];
}
?>
<div class="log-wrap">
  <div class="log-head">
    <h2>📋 Admin Log Unificat - ultimele 300 acțiuni</h2>
  </div>

  <div class="log-filters" id="logFilters">
    <button class="active" data-filter="all">All</button>
    <button data-filter="BAN">🔨 Ban</button>
    <button data-filter="UNBAN">🔓 Unban</button>
    <button data-filter="GOLD">💰 Gold</button>
    <button data-filter="PLUS">⭐ Plus</button>
    <button data-filter="BONUS">📈 Bonus</button>
    <button data-filter="VILLAGE">🏘 Village</button>
    <button data-filter="MESSAGE">✉ Message</button>
    <button data-filter="RESET">⚙ Reset</button>
    <button data-filter="OTHER">📝 Other</button>
  </div>

<div class="log-card">
<table class="logTable" id="logTable">
<thead>
<tr>
  <th width="50">ID</th>
  <th width="120">Admin</th>
  <th width="100">Categorie</th>
  <th>Detalii</th>
  <th width="140">Data</th>
</tr>
</thead>
<tbody>
<?php
foreach($paged as $e) {
    $admid = (int)$e['user'];
    $username = $database->getUserField($admid, "username", 0);
    $adminLink = $username ? '<a href="admin.php?p=player&uid='.$admid.'">'.htmlspecialchars($username).'</a>' : '<b>SYSTEM</b>';
    if($username == 'Multihunter') $adminLink = '<b style="color:#c00">CONTROL PANEL</b>';
    
    list($cat,$class,$icon) = logCategory($e);
    $date = date("d.m.Y H:i:s", $e['time'] + 3600*2);
    $details = $e['text'];
?>
<tr data-cat="<?php echo $cat; ?>">
  <td>#<?php echo $e['id'] % 1000000; ?></td>
  <td><?php echo $adminLink; ?></td>
  <td><span class="logCat <?php echo $class; ?>"><?php echo $icon.' '.$cat; ?></span></td>
  <td><?php echo $details; ?></td>
  <td><?php echo $date; ?></td>
</tr>
<?php } ?>
</tbody>
</table>
<div style="text-align:center;margin:8px 0;font-size:11px">
<?php if($page>1){ ?><a href="?p=admin_log&pg=<?php echo $page-1;?>" style="padding:3px 8px;border:1px solid #bbb;background:#f5f5f5;text-decoration:none;margin:0 2px">« Prev</a><?php } ?>
<span style="padding:3px 8px;background:#3a4f63;color:#fff;margin:0 2px"><?php echo $page;?> / <?php echo $totalPages;?></span>
<?php if($page<$totalPages){ ?><a href="?p=admin_log&pg=<?php echo $page+1;?>" style="padding:3px 8px;border:1px solid #bbb;background:#f5f5f5;text-decoration:none;margin:0 2px">Next »</a><?php } ?>
</div>
</div>
</div>

<script>
(function(){
  var btns = document.querySelectorAll('#logFilters button');
  var rows = document.querySelectorAll('#logTable tbody tr');
  btns.forEach(function(b){
    b.onclick = function(){
      btns.forEach(x=>x.classList.remove('active'));
      b.classList.add('active');
      var f = b.getAttribute('data-filter');
      rows.forEach(function(r){
        r.style.display = (f==='all' || r.getAttribute('data-cat')===f) ? '' : 'none';
      });
    };
  });
})();
</script>