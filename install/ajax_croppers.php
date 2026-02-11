<?php
// install/ajax_croppers.php
// Streams croppers build progress via SSE

// --- Includes ---
require_once __DIR__ . '/../GameEngine/config.php';
require_once __DIR__ . '/../GameEngine/Database.php';
require_once __DIR__ . '/../GameEngine/Admin/database.php';

// --- Headers for SSE and no buffering ---
header('Content-Type: text/event-stream; charset=utf-8');
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');
header('Connection: keep-alive');
// Disable nginx proxy buffering if present
header('X-Accel-Buffering: no');

@ini_set('zlib.output_compression', '0');
@ini_set('output_buffering', 'off');
@ini_set('implicit_flush', '1');
@set_time_limit(0);

// Kill any output buffers
while (ob_get_level() > 0) { @ob_end_flush(); }
ob_implicit_flush(true);

// If any installer/session code might lock the session, release it
if (session_status() === PHP_SESSION_ACTIVE) {
    @session_write_close();
}

function sse_send(array $payload) {
    echo "data: " . json_encode($payload, JSON_UNESCAPED_SLASHES) . "\n\n";
    @flush();
    @ob_flush();
}

function sse_ping() {
    // Comment line per SSE spec, keeps connection alive
    echo ":\n\n";
    @flush();
    @ob_flush();
}

global $database;

// 1) Count total croppers
try {
    $total = $database->TotalCroppers();
} catch (Throwable $e) {
    sse_send(['pct'=>0,'done'=>0,'total'=>0,'msg'=>'Count failed: '.$e->getMessage()]);
    exit;
}

sse_send(['pct'=>0,'done'=>0,'total'=>$total,'msg'=>"Starting croppers build (found $total tiles)…"]);

// 2) Build with live reporter (pings to keep proxies happy)
$lastPing = time();
$reporter = function($done, $target, $pct) use (&$lastPing) {
    sse_send(['pct'=>(int)$pct,'done'=>(int)$done,'total'=>(int)$target]);
    // send keep-alive every ~10s
    if (time() - $lastPing >= 10) {
        sse_ping();
        $lastPing = time();
    }
    if (connection_aborted()) { exit; } // client left
};

// Run it (fresh world => truncateFirst=true; big batch on dedicated server)
$out = $database->populateCroppers($total, true, 20000, $reporter);

if (!empty($out['ok'])) {
    sse_send([
        'pct'=>100,
        'done'=>(int)$out['processed'],
        'total'=>(int)$out['target'],
        'msg'=>'Done building croppers.'
    ]);
} else {
    sse_send([
        'pct'=>0,
        'done'=>0,
        'total'=>(int)$total,
        'msg'=>'Error: '.($out['msg'] ?? 'unknown')
    ]);
}
exit;
