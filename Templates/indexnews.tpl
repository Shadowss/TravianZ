<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       links.tpl                                                   ##
##  Developed by:  Slim, Manuel Mannhardt 							           ##
##  Refactored by: Shadow Incremental Refactor 			                       ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2025. All rights reserved.                ##
##                                                                             ##
##  Refactor notes:                                                            ##
##  - păstrată logica originală 100%                                           ##
##  - compatibil PHP 5.6+ / 7+                                                 ##
##  - redus cod duplicat                                                       ##
##  - securizare output HTML                                                   ##
##  - protecție basic URL                                                      ##
##  - comentarii adăugate                                                      ##
##                                                                             ##
#################################################################################

?>
<p class="date"><?php echo TZ_RELEASE_BY_TRAVIANZ; ?></p>
<p><?php echo TZ_THANK_YOU_FOR_USING_OUR_VERSION; ?></p>

<?php
// Multi-instance server status. The homepage already loads InstanceRegistry;
// the fallback include keeps this template safe when rendered independently.
if (!class_exists('InstanceRegistry')) {
    require_once __DIR__ . '/../GameEngine/Instance/Registry.php';
}
if (!isset($worlds) || !is_array($worlds)) {
    $worlds = InstanceRegistry::all();
}
?>

<div class="multi_instance_status">
<?php
// Render the world list as a compact monospace table.
// The column widths are calculated from the actual instances so the output
// remains aligned for S1 through S15 (and for longer status values).
$rows = [];
foreach ($worlds as $world) {
    $statusKey = isset($world['stats']['status']) ? $world['stats']['status'] : 'CLOSE';
    $statusText = ($statusKey === 'OPERATIONAL')
        ? SERVER_STATUS_OPERATIONAL
        : (($statusKey === 'IN MAINTENANCE') ? SERVER_STATUS_MAINTENANCE : SERVER_STATUS_CLOSED);
    $registerText = !empty($world['reg_open']) ? SERVER_REGISTER_OPEN : SERVER_REGISTER_CLOSED;

    $rows[] = [
        SERVER_LABEL . ' ' . (int) $world['number'],
        (string) $statusText,
        (string) $registerText,
        (int) $world['stats']['players'] . ' Players',
        (int) $world['stats']['online'],
    ];
}

$headers = [
    SERVER_LABEL,
    SERVER_STATUS_LABEL,
    SERVER_REGISTER_LABEL,
    SERVER_PLAYERS_LABEL,
    SERVER_ONLINE_LABEL,
];

$widths = array_map('strlen', $headers);
foreach ($rows as $row) {
    foreach ($row as $index => $value) {
        $widths[$index] = max($widths[$index], strlen((string) $value));
    }
}

$renderRow = static function ($cells) use ($widths) {
    $parts = [];
    foreach ($cells as $index => $cell) {
        $parts[] = str_pad((string) $cell, $widths[$index], ' ', STR_PAD_RIGHT);
    }
    return implode(' | ', $parts);
};

$separator = [];
foreach ($widths as $width) {
    $separator[] = str_repeat('-', $width);
}
?>
    <strong><?php echo SERVER_STATUS_TITLE; ?></strong>
    <pre class="server_status_table"><?php
echo htmlspecialchars($renderRow($headers), ENT_QUOTES, 'UTF-8') . "\n";
echo htmlspecialchars(implode('-|-', $separator), ENT_QUOTES, 'UTF-8') . "\n";
foreach ($rows as $row) {
    echo htmlspecialchars($renderRow($row), ENT_QUOTES, 'UTF-8') . "\n";
}
?></pre>
</div>
