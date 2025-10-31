<?php
// ABOUTME: Cron script to run game automation when no players are online
// ABOUTME: This ensures villages generate resources and game events process 24/7

// Tell Automation.php that this is a manual run from cron
define('AUTOMATION_MANUAL_RUN', true);

// Find and include autoloader
$autoloader_found = false;
for ($i = 0; $i < 5; $i++) {
    $autoprefix = str_repeat('../', $i);
    if (file_exists($autoprefix.'autoloader.php')) {
        $autoloader_found = true;
        include_once $autoprefix.'autoloader.php';
        break;
    }
}

if (!$autoloader_found) {
    die('Could not find autoloader.php');
}

// Include configuration
include_once($autoprefix.'GameEngine/config.php');

// Run automation - this handles game mechanics like:
// - Building completion
// - Troop training/movement completion
// - Market trades
// - Loyalty regeneration
// - Celebrations
// - And more
include_once($autoprefix.'GameEngine/Automation.php');

echo "Cron completed at " . date('Y-m-d H:i:s') . "\n";
