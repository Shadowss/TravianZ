<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ                                                    ##
##  Filename       multi.php                                                   ##
##  Type           : Multi-instance installation manager                       ##
##  Project        : TravianZ                                                  ##
##  Source code    : https://github.com/Shadowss/TravianZ                      ##
#################################################################################

// Multi-instance installer manager.
//
// The normal TravianZ installer remains available for the legacy/default world.
// This page manages isolated worlds from one code installation. Each world gets
// its own config.php, database target, runtime directory and installed marker.

@set_time_limit(0);
@session_start();

$root = dirname(__DIR__);
$instancesDir = $root . DIRECTORY_SEPARATOR . 'instances';
$registryFile = $instancesDir . DIRECTORY_SEPARATOR . 'registry.json';

if (!is_dir($instancesDir)) {
    @mkdir($instancesDir, 0775, true);
}

function tz_multi_registry_read($file) {
    if (!is_file($file)) {
        return [];
    }

    $data = json_decode((string) @file_get_contents($file), true);
    return is_array($data) ? $data : [];
}

function tz_multi_registry_write($file, array $data) {
    $tmp = $file . '.tmp';
    $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

    if ($json === false || @file_put_contents($tmp, $json . PHP_EOL, LOCK_EX) === false) {
        return false;
    }

    if (!@rename($tmp, $file)) {
        @unlink($tmp);
        return false;
    }

    return true;
}

$registry = tz_multi_registry_read($registryFile);
$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_definitions'])) {
    $count = isset($_POST['server_count']) ? (int) $_POST['server_count'] : 1;
    $count = max(1, min(100, $count));

    $newRegistry = $registry;
    $usedIds = [];

    for ($i = 1; $i <= $count; $i++) {
        $id = strtolower(trim((string) ($_POST['instance_id'][$i] ?? '')));
        $name = trim((string) ($_POST['instance_name'][$i] ?? ''));
        $host = trim((string) ($_POST['instance_host'][$i] ?? ''));
        $db = trim((string) ($_POST['instance_db'][$i] ?? ''));
        $prefix = trim((string) ($_POST['instance_prefix'][$i] ?? ''));

        if ($id === '') {
            $id = 's' . $i;
        }
        if (!preg_match('/^[a-z0-9][a-z0-9_-]{0,31}$/', $id)) {
            $error = 'Instance ID invalid la serverul ' . $i . '. Foloseste doar litere mici, cifre, _ sau -.';
            break;
        }
        if (isset($usedIds[$id])) {
            $error = 'Instance ID duplicat: ' . htmlspecialchars($id, ENT_QUOTES, 'UTF-8');
            break;
        }
        $usedIds[$id] = true;
        if ($name === '') $name = 'TravianZ ' . strtoupper($id);
        if ($db === '') $db = 'travian_' . preg_replace('/[^a-zA-Z0-9_]/', '_', $id);
        if ($prefix === '') $prefix = $id . '_';
        if (!preg_match('/^[A-Za-z0-9_$]+_$/', $prefix)) {
            $error = 'Prefix invalid la serverul ' . $i . '.';
            break;
        }

        $instancePath = $instancesDir . DIRECTORY_SEPARATOR . $id;
        if (!is_dir($instancePath) && !@mkdir($instancePath, 0775, true)) {
            $error = 'Nu pot crea directorul instanței ' . $id . '.';
            break;
        }
        $runtimePath = $instancePath . DIRECTORY_SEPARATOR . 'runtime';
        if (!is_dir($runtimePath)) @mkdir($runtimePath, 0775, true);

        $newRegistry[$id] = [
            'id' => $id,
            'name' => $name,
            'host' => $host,
            'database' => $db,
            'prefix' => $prefix,
            'status' => $newRegistry[$id]['status'] ?? 'defined',
            'created_at' => $newRegistry[$id]['created_at'] ?? date('c'),
        ];
    }

    if ($error === '') {
        if (!tz_multi_registry_write($registryFile, $newRegistry)) {
            $error = 'Nu pot scrie registry.json. Verifica permisiunile directorului instances/.';
        } else {
            $registry = $newRegistry;
            $message = 'Instanțele au fost definite. Acum configurează fiecare server și pornește pașii de instalare.';
        }
    }
}

$serverCount = isset($_POST['server_count']) ? max(1, min(100, (int) $_POST['server_count'])) : max(1, count($registry));
if ($serverCount < 1) $serverCount = 1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>TravianZ Multi-Instance Installer</title>
    <style>
        body{font-family:Arial,sans-serif;background:#eee;margin:0;padding:30px;color:#333}
        .wrap{max-width:1200px;margin:auto;background:#fff;padding:25px;border-radius:8px}
        h1{margin-top:0}.notice{padding:12px;margin:15px 0;background:#e8f5e9}.error{padding:12px;margin:15px 0;background:#ffebee}
        .toolbar{display:flex;gap:12px;align-items:center;margin:20px 0}.toolbar input{width:80px;padding:8px}
        .server{border:1px solid #ccc;padding:18px;margin:12px 0;border-radius:6px;background:#fafafa}
        .grid{display:grid;grid-template-columns:repeat(5,1fr);gap:12px}.field label{display:block;font-weight:bold;margin-bottom:5px}.field input{width:100%;box-sizing:border-box;padding:9px}
        button,.btn{padding:9px 15px;cursor:pointer;text-decoration:none;border:1px solid #aaa;background:#f6f6f6;color:#222;border-radius:4px;display:inline-block}
        .btn-primary{background:#2d6cdf;color:#fff;border-color:#2d6cdf}.btn-success{background:#2e7d32;color:#fff;border-color:#2e7d32}.btn-warning{background:#ef6c00;color:#fff;border-color:#ef6c00}
        .muted{color:#666;font-size:13px}.status{font-weight:bold}.actions{display:flex;flex-wrap:wrap;gap:8px;margin-top:15px}
        code{background:#f1f1f1;padding:2px 5px}.step{padding:4px 8px;border-radius:4px;background:#eee;margin-right:5px;font-size:12px}
        @media(max-width:900px){.grid{grid-template-columns:1fr 1fr}.wrap{padding:15px}}
    </style>
    <script>
        function buildServers() {
            const count = Math.max(1, Math.min(100, parseInt(document.getElementById('server_count').value || '1', 10)));
            document.getElementById('server_count_post').value = count;
            const box = document.getElementById('servers');
            const existing = {};
            Array.from(box.querySelectorAll('.server')).forEach(function(el){
                const id = el.querySelector('[data-field="id"]');
                if (id) existing[el.dataset.index] = {
                    id: id.value,
                    name: el.querySelector('[data-field="name"]').value,
                    host: el.querySelector('[data-field="host"]').value,
                    db: el.querySelector('[data-field="db"]').value,
                    prefix: el.querySelector('[data-field="prefix"]').value
                };
            });
            box.innerHTML = '';
            for (let i = 1; i <= count; i++) {
                const old = existing[i] || {};
                const id = old.id || ('s' + i);
                const div = document.createElement('div');
                div.className = 'server';
                div.dataset.index = i;
                div.innerHTML = '<h3>Server ' + i + '</h3>' +
                    '<div class="grid">' +
                    '<div class="field"><label>Instance ID</label><input data-field="id" name="instance_id['+i+']" value="'+escapeHtml(id)+'" required></div>' +
                    '<div class="field"><label>Server name</label><input data-field="name" name="instance_name['+i+']" value="'+escapeHtml(old.name || ('TravianZ '+id.toUpperCase()))+'" required></div>' +
                    '<div class="field"><label>Hostname / domain</label><input data-field="host" name="instance_host['+i+']" value="'+escapeHtml(old.host || '')+'"></div>' +
                    '<div class="field"><label>Database name</label><input data-field="db" name="instance_db['+i+']" value="'+escapeHtml(old.db || ('travian_'+id))+'" required></div>' +
                    '<div class="field"><label>Table prefix</label><input data-field="prefix" name="instance_prefix['+i+']" value="'+escapeHtml(old.prefix || (id+'_'))+'" required></div>' +
                    '</div>';
                box.appendChild(div);
            }
        }
        function escapeHtml(value) { return String(value).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;'); }
        window.addEventListener('DOMContentLoaded', function(){
            if (!document.querySelector('#servers .server')) buildServers();
        });
    </script>
</head>
<body>
<div class="wrap">
    <h1>TravianZ Multi-Instance Installer</h1>
    <p class="muted">O singură instalare TravianZ, mai multe lumi izolate. Fiecare instanță are propriul config.php, database, runtime și marker <code>installed</code>.</p>

    <?php if ($message !== ''): ?><div class="notice"><?=htmlspecialchars($message, ENT_QUOTES, 'UTF-8')?></div><?php endif; ?>
    <?php if ($error !== ''): ?><div class="error"><?=htmlspecialchars($error, ENT_QUOTES, 'UTF-8')?></div><?php endif; ?>

    <h2>1. Definește serverele</h2>
    <div class="toolbar">
        <label for="server_count"><strong>Număr servere:</strong></label>
        <input id="server_count" name="server_count_ui" type="number" min="1" max="100" value="<?=$serverCount?>" onchange="buildServers()" oninput="buildServers()">
    </div>

    <form method="post">
        <input type="hidden" name="server_count" id="server_count_post" value="<?=$serverCount?>">
        <input type="hidden" name="create_definitions" value="1">
        <div id="servers">
<?php $i = 0; foreach ($registry as $instance): $i++; ?>
            <div class="server" data-index="<?=$i?>">
                <h3>Server <?=$i?></h3>
                <div class="grid">
                    <div class="field"><label>Instance ID</label><input data-field="id" name="instance_id[<?=$i?>]" value="<?=htmlspecialchars($instance['id'], ENT_QUOTES, 'UTF-8')?>" required></div>
                    <div class="field"><label>Server name</label><input data-field="name" name="instance_name[<?=$i?>]" value="<?=htmlspecialchars($instance['name'], ENT_QUOTES, 'UTF-8')?>" required></div>
                    <div class="field"><label>Hostname / domain</label><input data-field="host" name="instance_host[<?=$i?>]" value="<?=htmlspecialchars($instance['host'] ?? '', ENT_QUOTES, 'UTF-8')?>"></div>
                    <div class="field"><label>Database name</label><input data-field="db" name="instance_db[<?=$i?>]" value="<?=htmlspecialchars($instance['database'], ENT_QUOTES, 'UTF-8')?>" required></div>
                    <div class="field"><label>Table prefix</label><input data-field="prefix" name="instance_prefix[<?=$i?>]" value="<?=htmlspecialchars($instance['prefix'], ENT_QUOTES, 'UTF-8')?>" required></div>
                </div>
            </div>
<?php endforeach; ?>
        </div>
        <button class="btn-primary" type="submit">Save server definitions</button>
    </form>

    <h2 style="margin-top:35px">2. Install each world</h2>
<?php if (!$registry): ?>
    <p class="muted">Nu există încă instanțe. Definește cel puțin un server mai sus.</p>
<?php else: ?>
<?php foreach ($registry as $id => $instance): ?>
    <div class="server">
        <h3><?=htmlspecialchars($instance['name'], ENT_QUOTES, 'UTF-8')?> <small>(<?=htmlspecialchars($id, ENT_QUOTES, 'UTF-8')?>)</small></h3>
        <p>
            <span class="step">DB: <?=htmlspecialchars($instance['database'], ENT_QUOTES, 'UTF-8')?></span>
            <span class="step">Prefix: <?=htmlspecialchars($instance['prefix'], ENT_QUOTES, 'UTF-8')?></span>
            <span class="status">Status: <?=htmlspecialchars($instance['status'] ?? 'defined', ENT_QUOTES, 'UTF-8')?></span>
        </p>
        <div class="actions">
            <?php if (($instance['status'] ?? '') !== 'installed'): ?><a class="btn btn-primary" href="config_instance.php?instance=<?=rawurlencode($id)?>">Configure server</a><?php endif; ?>
<?php if (($instance['status'] ?? '') === 'configured'): ?>
            <form method="post" action="process_instance.php" style="display:inline"><input type="hidden" name="instance_id" value="<?=htmlspecialchars($id, ENT_QUOTES, 'UTF-8')?>"><input type="hidden" name="action" value="structure"><button class="btn-warning" type="submit">Create database structure</button></form>
<?php elseif (($instance['status'] ?? '') === 'structure_created'): ?>
            <form method="post" action="process_instance.php" style="display:inline"><input type="hidden" name="instance_id" value="<?=htmlspecialchars($id, ENT_QUOTES, 'UTF-8')?>"><input type="hidden" name="action" value="world"><button class="btn-warning" type="submit">Create world data</button></form>
<?php elseif (($instance['status'] ?? '') === 'world_created'): ?>
            <a class="btn btn-success" href="accounts_instance.php?instance=<?=rawurlencode($id)?>">Create admin / MultiHunter / Support accounts</a>
<?php elseif (($instance['status'] ?? '') === 'installed'): ?>
            <span class="btn btn-success">Installed</span>
<?php endif; ?>
        </div>
    </div>
<?php endforeach; ?>
<?php endif; ?>

    <p style="margin-top:30px"><a href="index.php">← Back to normal installer</a></p>
</div>
</body>
</html>
