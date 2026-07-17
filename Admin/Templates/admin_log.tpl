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
 .log-wrap{max-width:100%;margin:12px;font-family:Tahoma,Verdana,Arial,sans-serif;color:#e2e8f0}
.log-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:10px}
.log-head h2{margin:0;font-size:16px;display:flex;align-items:center;gap:6px;color:#f1f5f9}
.log-filters{display:flex;gap:5px;flex-wrap:wrap;margin-bottom:10px}
.log-filters a{padding:4px 11px;font-size:11px;border:1px solid #334155;border-radius:14px;background:#111827;cursor:pointer;color:#cbd5e1;text-decoration:none;line-height:15px}
.log-filters a:hover{border-color:#f59e0b;color:#fde68a}
.log-filters a.active{background:#f59e0b;color:#1a1a2e;border-color:#f59e0b;font-weight:bold}
.log-card{background:#0b1220;border:1px solid #1f2937;border-radius:8px;overflow:hidden;color:#e2e8f0}
.log-scroll{overflow-x:auto}
.logTable{width:100%;border-collapse:collapse;font-size:11px;color:#cbd5e1}
.logTable th{background:#111827;color:#94a3b8;padding:7px 8px;text-align:left;font-weight:bold;font-size:9px;white-space:nowrap;text-transform:uppercase;letter-spacing:.3px;border-bottom:1px solid #1f2937}
.logTable td{padding:6px 8px;border-bottom:1px solid #14203a;vertical-align:top;line-height:16px;color:#cbd5e1}
.logTable tr:hover td{background:#0f1a30}
.logTable a{color:#7dd3fc;text-decoration:none}
.logTable a:hover{text-decoration:underline}
.logCat{font-weight:bold;padding:2px 7px;border-radius:4px;color:#fff;font-size:10px;white-space:nowrap}
.cat-ban{background:#dc2626}
.cat-unban{background:#16a34a}
.cat-gold{background:#d97706;color:#fff}
.cat-plus{background:#0891b2;color:#fff}
.cat-maint{background:#475569}
.cat-village{background:#2563eb;color:#fff}
.cat-msg{background:#ea580c}
.cat-other{background:#64748b;color:#fff}
.log-page a{padding:3px 9px;border:1px solid #334155;background:#111827;color:#cbd5e1;text-decoration:none;margin:0 2px;border-radius:4px}
.log-page a:hover{border-color:#f59e0b;color:#fde68a}
.log-page .cur{padding:3px 9px;background:#f59e0b;color:#1a1a2e;margin:0 2px;border-radius:4px;font-weight:bold}
</style>
</head>
<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : ademin_log.tpl                                            ##
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

// Server-side category filter (applies across ALL entries, not just current page)
$catFilter = isset($_GET['cat']) ? strtoupper(preg_replace('/[^A-Za-z]/','',$_GET['cat'])) : 'ALL';
if ($catFilter !== '' && $catFilter !== 'ALL') {
    $unified = array_values(array_filter($unified, function($e) use ($catFilter) {
        $c = logCategory($e); return $c[0] === $catFilter;
    }));
}

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
    <h2>📋 Unified Admin Log – last 300 actions</h2>
  </div>

  <div class="log-filters" id="logFilters">
    <?php
    $cats = [
        'all'=>'All','BAN'=>'🔨 Ban','UNBAN'=>'🔓 Unban','GOLD'=>'💰 Gold',
        'PLUS'=>'⭐ Plus','BONUS'=>'📈 Bonus','VILLAGE'=>'🏘 Village',
        'MESSAGE'=>'✉ Message','RESET'=>'⚙ Reset','OTHER'=>'📝 Other'
    ];
    $curCat = ($catFilter === '' ? 'ALL' : $catFilter);
    foreach ($cats as $key=>$label):
        $isAll = ($key === 'all');
        $active = ($isAll && $curCat === 'ALL') || (!$isAll && $curCat === $key);
        $href = 'admin.php?p=admin_log' . ($isAll ? '' : '&cat=' . $key);
    ?>
        <a href="<?php echo $href; ?>" class="<?php echo $active ? 'active' : ''; ?>"><?php echo $label; ?></a>
    <?php endforeach; ?>
  </div>

<div class="log-card">
<div class="log-scroll">
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
</div>
<?php $catQS = ($catFilter !== '' && $catFilter !== 'ALL') ? '&cat='.$catFilter : ''; ?>
<div class="log-page" style="text-align:center;margin:10px 0;font-size:11px">
<?php if($page>1){ ?><a href="admin.php?p=admin_log&pg=<?php echo $page-1;?><?php echo $catQS;?>">« Prev</a><?php } ?>
<span class="cur"><?php echo $page;?> / <?php echo max(1,$totalPages);?></span>
<?php if($page<$totalPages){ ?><a href="admin.php?p=admin_log&pg=<?php echo $page+1;?><?php echo $catQS;?>">Next »</a><?php } ?>
</div>
</div>
</div>
