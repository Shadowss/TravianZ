<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : cron.php                                                  ##
##  Type           : Standalone automation runner (P2 - Performance)           ##
## --------------------------------------------------------------------------- ##
##  Purpose        : Runs Automation.php independently from player requests    ##
##                   so processing (battles, troop movements, training, etc.)  ##
##                   is no longer handled by a player's page request.          ##
## --------------------------------------------------------------------------- ##
##  WHY AN INTERNAL LOOP:                                                      ##
##    Automation is designed to run approximately every 60 seconds (its        ##
##    internal guard checks "time() - filemtime > 60"). Many cPanel hosting    ##
##    providers do not allow 1-minute cron jobs, only a minimum interval of    ##
##    5 minutes. If Automation were executed only once every 5 minutes,        ##
##    attacks and building completions could be delayed by up to 5 minutes.    ##
##    For this reason, a single cron invocation performs one TICK every 60     ##
##    seconds for approximately 5 minutes, then exits and waits for the next   ##
##    scheduled cron execution.                                                ##
##                                                                             ##
##    Each tick rewrites Prevention/cron_active.txt, keeping the marker file   ##
##    fresh so player page requests will no longer trigger Automation at all.  ##
## --------------------------------------------------------------------------- ##
##  cPanel Cron Installation (every 5 minutes - recommended with the           ##
##  internal loop):                                                            ##
##*/5 * * * * /usr/local/bin/php /home/USER/public_html/cron.php>/dev/null 2>&1##
##                                                                             ##
##  If your hosting provider allows a 1-minute cron, set the Minute field to   ##
##  "*" and add the following to GameEngine/config.php:                        ##
##      define('CRON_LOOP_SECONDS', 0);                                        ##
##  (0 = a single tick per invocation, without the internal loop)              ##
## --------------------------------------------------------------------------- ##
##  Optional configuration in GameEngine/config.php:                           ##
##    define('CRON_LOOP_SECONDS', 300); // Duration of one invocation          ##
##                                      // (0 = single tick)                   ##
##    define('CRON_TICK_SECONDS', 60);  // Tick interval inside the loop       ##
##    define('CRON_KEY', 'secret');     // Required only for HTTP execution    ##
## --------------------------------------------------------------------------- ##
##  Contact        : cata7007@gmail.com                                        ##
##  Project        : TravianZ                                                  ##
##  GitHub         : https://github.com/Shadowss/TravianZ                      ##
#################################################################################

// -----------------------------------------------------------------------------
// 1. Execution Mode
//    - CLI (php cron.php): Invoked by the server's cron scheduler and always
//      allowed.
//    - HTTP (wget/curl): Allowed ONLY when the correct CRON_KEY is provided,
//      preventing anyone on the Internet from triggering Automation.
//    - "--once" / "?once=1": Executes a single tick without the internal loop
//      (useful for a "Force Run" button in the admin panel).
// -----------------------------------------------------------------------------
$isCli = (PHP_SAPI === 'cli');

if ($isCli) {
    $forceSingleTick = isset($argv) && in_array('--once', $argv, true);
} else {
    $forceSingleTick = isset($_GET['once']);
}

// -----------------------------------------------------------------------------
// 1b. IMPORTANT: The server's cron launches this script with the current working
//     directory set to the account's HOME directory (e.g. /home/user), NOT the
//     game's directory. Without the line below, the relative lookups in step 2
//     (file_exists('autoloader.php'), etc.) fail, the script exits with exit(1),
//     and the error message is swallowed by ">/dev/null"—making it appear that
//     the cron job "does nothing" with no trace in the logs.
//     This problem does not occur when accessed via HTTP (where the current
//     working directory is the script's directory), which is why running it from
//     the browser works while the cron job does not.
// -----------------------------------------------------------------------------
if (@chdir(__DIR__) === false) {
    if ($isCli) { fwrite(STDERR, "cron: unable to change to directory " . __DIR__ . "\n"); }
    exit(1);
}

// -----------------------------------------------------------------------------
// 2. Minimal Bootstrap
//    - We do NOT include Session.php, as it starts a session and is tied to
//      HTTP requests and authenticated users.
//    - Automation.php loads everything else it needs on its own
//      (buidata, unitdata, Units, Battle, etc.).
// -----------------------------------------------------------------------------
$autoprefix = '';
for ($i = 0; $i < 5; $i++) {
    $autoprefix = str_repeat('../', $i);
    if (file_exists($autoprefix . 'autoloader.php')) {
        break;
    }
}

require_once($autoprefix . 'autoloader.php');

if (!file_exists($autoprefix . 'GameEngine/config.php')) {
	// Installation is not yet complete - there is nothing to run.
    if ($isCli) { fwrite(STDERR, "cron: config.php lipseste, jocul nu e instalat\n"); }
    exit(1);
}

include_once($autoprefix . 'GameEngine/config.php');

// -----------------------------------------------------------------------------
// 3. Verify the access key for HTTP requests (not applicable in CLI mode)
// -----------------------------------------------------------------------------
if (!$isCli) {
    $providedKey = isset($_GET['key']) ? (string)$_GET['key'] : '';

    if (!defined('CRON_KEY') || CRON_KEY === '' || !hash_equals(CRON_KEY, $providedKey)) {
        header('HTTP/1.1 403 Forbidden');
        exit('Forbidden');
    }
	// Do not keep the client connection open - send the response immediately and continue processing in the background.
    ignore_user_abort(true);
    @set_time_limit(0);
    header('Content-Type: text/plain');
    echo "OK\n";

    if (function_exists('fastcgi_finish_request')) {
        fastcgi_finish_request();
    }

	// When executed via HTTP, we do not keep the process running for 5 minutes
	// (PHP-FPM has its own execution timeouts).
	// An HTTP request performs only a single tick.
	// The internal loop is intended for CLI execution only.
    $forceSingleTick = true;
}

// -----------------------------------------------------------------------------
// 4. Loop Parameters
// -----------------------------------------------------------------------------
$loopSeconds = defined('CRON_LOOP_SECONDS') ? (int)CRON_LOOP_SECONDS : 300;
$tickSeconds = defined('CRON_TICK_SECONDS') ? (int)CRON_TICK_SECONDS : 60;

if ($tickSeconds < 15) { $tickSeconds = 15; }  // sub 15s nu aduce nimic, doar incarca serverul
if ($loopSeconds < 0)  { $loopSeconds = 0; }
if ($forceSingleTick)  { $loopSeconds = 0; }

// -----------------------------------------------------------------------------
// 5. Overlap Lock
//    If the previous invocation is still running its loop (e.g., on a slow
//    server), the next invocation exits immediately instead of processing
//    everything twice. The flock() lock is automatically released, even if
//    the process terminates unexpectedly.
// -----------------------------------------------------------------------------
$runLockPath   = $autoprefix . 'GameEngine/Prevention/cron_running.lock';
$runLockHandle = @fopen($runLockPath, 'c');

if ($runLockHandle === false) {
    if ($isCli) { fwrite(STDERR, "cron: cannot open lock ($runLockPath)\n"); }
    exit(1);
}

if (!flock($runLockHandle, LOCK_EX | LOCK_NB)) {
    fclose($runLockHandle);
    if ($isCli) { echo "cron: A previous invocation is still running. Exiting.\n"; }
    exit(0);
}

// -----------------------------------------------------------------------------
// 6. Database Connection
//    Initializes the database connection ($database), which is accessed by
//    Automation.php through the global scope.
// -----------------------------------------------------------------------------
include_once($autoprefix . 'GameEngine/Database.php');

if (!isset($database) || !$database) {
    if ($isCli) { fwrite(STDERR, "cron: conexiunea la baza de date a esuat\n"); }
    flock($runLockHandle, LOCK_UN);
    fclose($runLockHandle);
    exit(1);
}

// AUTOMATION_MANUAL_RUN tells Automation.php to bypass its own lock-file guard.
// That guard is designed to coordinate concurrent player requests, whereas
// this script is the only execution source and is already protected by the
// overlap lock implemented above.
if (!defined('AUTOMATION_MANUAL_RUN')) {
    define('AUTOMATION_MANUAL_RUN', true);
}

$cronMarkerPath = $autoprefix . 'GameEngine/Prevention/cron_active.txt';

/**
 * Clears the request-scoped caches of the database class.
 *
 * The static caches in MYSQLi_DB are designed to live only for the duration of
 * a single request. In a long-running process that executes multiple ticks,
 * they would remain populated, causing subsequent ticks to operate on stale
 * data (e.g. building levels already modified by the previous tick).
 * We therefore reset them between ticks so that each tick starts as cleanly as
 * a fresh request.
 *
 * Only static array properties whose names contain "cache" are reset.
 */
function cron_reset_db_caches()
{
    if (!class_exists('MYSQLi_DB')) {
        return;
    }

    try {
        $ref = new ReflectionClass('MYSQLi_DB');

        foreach ($ref->getProperties(ReflectionProperty::IS_STATIC) as $prop) {
            if (stripos($prop->getName(), 'cache') === false) {
                continue;
            }

            $prop->setAccessible(true);

            if (is_array($prop->getValue())) {
                $prop->setValue(null, []);
            }
        }
    } catch (Throwable $e) {
        // If reflection fails, it's better to continue than to stop the automation.
    }
}

// NOTE (bug fixed): Automation.php MUST NOT be included from inside a function.
// Automation.php, in turn, includes Ranking.php, Units.php, Battle.php, and
// Technology.php. Those files instantiate their objects at file scope
// ($ranking = new Ranking; etc.). If the include is performed from within a
// function, those assignments end up in the function's LOCAL scope instead of
// the global scope. As a result, methods using "global $ranking" receive null,
// causing errors such as:
//   Fatal error: Call to a member function procRankArray() on null
//
// For this reason, the first tick is executed below at global scope, while
// subsequent ticks simply instantiate the already-loaded class with
// new Automation().

// -----------------------------------------------------------------------------
// 7. Execution
// -----------------------------------------------------------------------------
$startedAt = time();
$tickStart = time();
$ticks     = 0;

// First tick: the include is performed HERE, at global scope, so that
// $ranking, $units, $battle, $technology, and the other objects created by the
// files included by Automation.php are truly global. The file ends with
// "new Automation", so including it automatically starts the first processing
// cycle.
@file_put_contents($cronMarkerPath, (string) time(), LOCK_EX);
include_once($autoprefix . 'GameEngine/Automation.php');
$ticks++;

// Subsequent ticks: the class is already loaded, so we simply instantiate it again.
while ($loopSeconds > 0) {

    // Is there enough time left in the invocation budget for another complete tick?
    $elapsed = time() - $startedAt;
    if (($elapsed + $tickSeconds) >= $loopSeconds) {
        break;
    }

    // Sleep until the next tick, subtracting the time taken by the current tick.
    $spent = time() - $tickStart;
    $sleep = $tickSeconds - $spent;

    if ($sleep > 0) {
        sleep($sleep);
    }

    $tickStart = time();

    cron_reset_db_caches();
    @file_put_contents($cronMarkerPath, (string) time(), LOCK_EX);

    new Automation();
    $ticks++;
}

// -----------------------------------------------------------------------------
// 8. Release the lock
// -----------------------------------------------------------------------------
flock($runLockHandle, LOCK_UN);
fclose($runLockHandle);

if ($isCli) {
    echo "cron: " . $ticks . " tick(uri) in " . (time() - $startedAt) . "s, terminat la " . date('Y-m-d H:i:s') . "\n";
}
