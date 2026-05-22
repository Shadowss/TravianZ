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
    .logTable { width:100%; border-collapse:collapse; margin-top:10px; }
    .logTable th { background:#222; color:#fff; padding:6px; text-align:left; font-size:12px; }
    .logTable td { padding:6px; border-bottom:1px solid #ddd; font-size:12px; vertical-align:top; }
    .logTable tr:hover { background:#f5f5f5; }
    .logCat { font-weight:bold; padding:2px 6px; border-radius:3px; color:#fff; font-size:11px; }
    .cat-gold { background:#d4af37; } .cat-plus { background:#6a5acd; }
    .cat-ban { background:#c00; } .cat-unban { background:#090; }
    .cat-maint { background:#555; } .cat-village { background:#0073aa; }
    .cat-msg { background:#ff8800; } .cat-other { background:#888; }
  </style>
</head>
<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       admin_log.tpl                                               ##
##  Developed by:  Dzoki                                                       ##
##  Refactored by: aggenkeech (2025)                                           ##
##  Remake by:     Shadow	  (2026)                                           ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2026. All rights reserved.                ##
##                                                                             ##
#################################################################################

if($_SESSION['access'] < ADMIN) die("Access Denied: You are not Admin!");

// 1. Log-uri normale
$adminLogs = $database->getAdminLog();
$unified = [];

foreach($adminLogs as $l) {
    $unified[] = [
        'id' => $l['id'],
        'time' => $l['time'],
        'user' => $l['user'],
        'type' => 'admin',
        'text' => $l['log']
    ];
}

// 2. Ban-uri și Unban-uri din banlist
$banQ = mysqli_query($GLOBALS["link"], "
    SELECT id, uid, name, reason, time, end, admin, active 
    FROM ".TB_PREFIX."banlist 
    ORDER BY time DESC 
    LIMIT 300
");
while($b = mysqli_fetch_assoc($banQ)) {
    // BAN
    $unified[] = [
        'id' => 1000000 + $b['id'], // offset ca să nu se amestece ID-urile
        'time' => $b['time'],
        'user' => $b['admin'] ?: 1,
        'type' => 'ban',
        'text' => "Banned user <a href='admin.php?p=player&uid={$b['uid']}'>{$b['name']}</a> (Reason: {$b['reason']})",
        'active' => $b['active']
    ];
    // UNBAN - dacă e inactiv, folosim end ca timp de unban
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

// 3. Sortează tot după timp DESC
usort($unified, function($a,$b){ return $b['time'] <=> $a['time']; });
$unified = array_slice($unified, 0, 300);

function logCategory($entry) {
    if($entry['type']=='ban') return ['BAN','cat-ban','🔨'];
    if($entry['type']=='unban') return ['UNBAN','cat-unban','🔓'];
    $t = strtolower(strip_tags($entry['text']));
    if (strpos($t,'mass ban')!==false) return ['BAN','cat-ban','🔨'];
    if (strpos($t,'mass unban')!==false) return ['UNBAN','cat-unban','🔓'];
    if (strpos($t,'gold')!==false) return ['GOLD','cat-gold','💰'];
    if (strpos($t,'plus')!==false && strpos($t,'bonus')===false) return ['PLUS','cat-plus','⭐'];
    if (strpos($t,'bonus')!==false) return ['BONUS','cat-plus','📈'];
    if (strpos($t,'reset')!==false) return ['RESET','cat-maint','⚙️'];
    if (strpos($t,'village')!==false || strpos($t,'buildings')!==false || strpos($t,'renamed')!==false) return ['VILLAGE','cat-village','🏘️'];
    if (strpos($t,'message')!==false) return ['MESSAGE','cat-msg','✉️'];
    return ['OTHER','cat-other','📝'];
}
?>
<h2>Admin Log Unificat - ultimele 300 acțiuni</h2>

<table class="logTable">
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
foreach($unified as $e) {
    $admid = (int)$e['user'];
    $username = $database->getUserField($admid, "username", 0);
    $adminLink = $username ? '<a href="admin.php?p=player&uid='.$admid.'">'.htmlspecialchars($username).'</a>' : '<b>SYSTEM</b>';
    if($username == 'Multihunter') $adminLink = '<b style="color:#c00">CONTROL PANEL</b>';
    
    list($cat,$class,$icon) = logCategory($e);
    $date = date("d.m.Y H:i:s", $e['time'] + 3600*2);
    $details = $e['text'];
?>
<tr>
  <td>#<?php echo $e['id'] % 1000000; ?></td>
  <td><?php echo $adminLink; ?></td>
  <td><span class="logCat <?php echo $class; ?>"><?php echo $icon.' '.$cat; ?></span></td>
  <td><?php echo $details; ?></td>
  <td><?php echo $date; ?></td>
</tr>
<?php } ?>
</tbody>
</table>

<?php if($total > $limit) { ?>
<p style="margin-top:10px;color:#777">Afișate doar ultimele <?php echo $limit; ?>. Pentru istoric complet, exportă din phpMyAdmin tabelul <code>s1_admin_log</code>.</p>
<?php } ?>