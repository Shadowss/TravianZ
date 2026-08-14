<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ                                                    ##
##  Filename       config_instance.php                                         ##
##  Type           : Multi-instance configuration frontend                     ##
## --------------------------------------------------------------------------- ##
##  Project        : TravianZ                                                  ##
##  Source code    : https://github.com/Shadowss/TravianZ                      ##
#################################################################################

@set_time_limit(0);
@session_start();

require_once dirname(__DIR__) . '/GameEngine/Instance/InstanceResolver.php';
require_once dirname(__DIR__) . '/GameEngine/Instance/Instance.php';

$instanceId = strtolower(trim((string) ($_GET['instance'] ?? '')));
if (!TravianZInstanceResolver::isValid($instanceId)) {
    http_response_code(400);
    exit('Invalid instance ID.');
}

$root = dirname(__DIR__);
$registryFile = $root . '/instances/registry.json';
$registry = [];
if (is_file($registryFile)) {
    $data = json_decode((string) file_get_contents($registryFile), true);
    if (is_array($data)) $registry = $data;
}

if (!isset($registry[$instanceId]) || !is_array($registry[$instanceId])) {
    http_response_code(404);
    exit('Instance not found.');
}

$instance = $registry[$instanceId];

// The existing installer template is the canonical source for all settings.
// We reuse it instead of maintaining a second copy of the very large form.
// Values controlled by the instance definition are injected into the rendered
// form so every world gets its own DB/name/prefix while all other settings stay
// exactly the same as the normal TravianZ installer.
$_SESSION['install_random_prefix'] = (string) ($instance['prefix'] ?? ($instanceId . '_'));

ob_start();
include $root . '/install/templates/config.tpl';
$html = ob_get_clean();

$html = str_replace('action="process.php"', 'action="process_instance.php"', $html);
$html = preg_replace(
    '/(<form\s+action="process_instance\.php"[^>]*>)/i',
    '$1\n<input type="hidden" name="instance_id" value="' . htmlspecialchars($instanceId, ENT_QUOTES, 'UTF-8') . '">\n<input type="hidden" name="action" value="config">',
    $html,
    1
);

$dbName = (string) ($instance['database'] ?? ('travian_' . $instanceId));
$prefix = (string) ($instance['prefix'] ?? ($instanceId . '_'));
$name = (string) ($instance['name'] ?? ('TravianZ ' . strtoupper($instanceId)));

$html = preg_replace('/(<input[^>]+name="servername"[^>]+value=")[^"]*("[^>]*>)/i', '$1' . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . '$2', $html, 1);
$html = preg_replace('/(<input[^>]+name="sdb"[^>]+value=")[^"]*("[^>]*>)/i', '$1' . htmlspecialchars($dbName, ENT_QUOTES, 'UTF-8') . '$2', $html, 1);
$html = preg_replace('/(<input[^>]+name="prefix"[^>]+value=")[^"]*("[^>]*>)/i', '$1' . htmlspecialchars($prefix, ENT_QUOTES, 'UTF-8') . '$2', $html, 1);

$header = '<div style="margin:15px auto;max-width:1100px;padding:14px;background:#e8f5e9;border:1px solid #b7d7b9;font-family:Arial,sans-serif;">'
    . '<strong>Configuring instance ' . htmlspecialchars($instanceId, ENT_QUOTES, 'UTF-8') . '</strong>'
    . ' — ' . htmlspecialchars($name, ENT_QUOTES, 'UTF-8')
    . ' — database: <code>' . htmlspecialchars($dbName, ENT_QUOTES, 'UTF-8') . '</code>'
    . '<br><a href="multi.php">← Back to multi-instance installer</a>'
    . '</div>';

$html = preg_replace('/<body([^>]*)>/i', '<body$1>' . $header, $html, 1);

echo $html;
