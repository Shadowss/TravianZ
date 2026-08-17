<?php

/**
 * Convert an existing TravianZ database after upgrading to utf8mb4 support.
 * Run with --apply only after taking a database backup; without it, this
 * prints the exact ALTER statements and changes nothing.
 */
if (PHP_SAPI !== 'cli') {
    fwrite(STDERR, "CLI only.\n");
    exit(1);
}

require dirname(__DIR__) . '/GameEngine/config.php';

$apply = in_array('--apply', $argv, true);
$db = new mysqli(SQL_SERVER, SQL_USER, SQL_PASS, SQL_DB, defined('SQL_PORT') ? SQL_PORT : 3306);
if ($db->connect_errno) {
    fwrite(STDERR, "Connection failed: {$db->connect_error}\n");
    exit(1);
}

$databaseName = (string) SQL_DB;
$database = $db->real_escape_string($databaseName);
$databaseIdentifier = str_replace('`', '``', $databaseName);
$tables = $db->query("SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_SCHEMA = '{$database}' AND TABLE_TYPE = 'BASE TABLE'");
if (!$tables) {
    fwrite(STDERR, "Could not enumerate tables: {$db->error}\n");
    exit(1);
}

$statements = ["ALTER DATABASE `{$databaseIdentifier}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci"];
while ($table = $tables->fetch_assoc()) {
    $name = str_replace('`', '``', $table['TABLE_NAME']);
    $statements[] = "ALTER TABLE `{$name}` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
}

foreach ($statements as $statement) {
    echo $statement . ";\n";
    if ($apply && !$db->query($statement)) {
        fwrite(STDERR, "Failed: {$db->error}\n");
        exit(1);
    }
}

if (!$apply) {
    echo "Dry run only. Re-run with --apply after taking a backup.\n";
}
