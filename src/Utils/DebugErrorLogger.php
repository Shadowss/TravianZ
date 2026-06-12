<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ                                                    ##
##  Filename       DebugErrorLogger.php                                        ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2026. All rights reserved.               ##
##  Source code:   https://github.com/Shadowss/TravianZ                       ##
##                                                                             ##
#################################################################################

namespace App\Utils;

/**
 * Admin-controlled PHP error capture (issue: in-game debug log).
 *
 * When the admin turns the debug mode on, this logger registers a custom
 * error handler (plus a shutdown handler for fatals) that writes every
 * selected PHP error into a dedicated file. It is completely transparent to
 * players: nothing is ever displayed, the game behaviour is unchanged, and a
 * custom error handler is invoked even when the php.ini `error_reporting`
 * masks warnings/notices — so we capture everything without rebuilding Docker.
 *
 * The file is size-capped: once it exceeds the configured limit it is rotated
 * to a single ".1" backup, so the total volume stays bounded (~2x the cap).
 */
class DebugErrorLogger {

    /** @var string Absolute/relative path to the active log file. */
    private static $file;

    /** @var int Size cap in bytes before rotation. */
    private static $maxBytes;

    /** @var array<int,bool> Which severities to capture. */
    private static $capture = [];

    /** @var string Per-request context appended to every line. */
    private static $context = '';

    /** @var bool Guards against double registration. */
    private static $registered = false;

    /**
     * Turn the capture on for the current request.
     *
     * @param array $cfg     The debug_log config row (levels + max_size_mb).
     * @param int   $uid     Current player id (0 when not logged in).
     * @param string $name   Current player username (for context).
     */
    public static function enable(array $cfg, $uid = 0, $name = '') {
        if (self::$registered) {
            return;
        }
        self::$registered = true;

        // Resolve the project root (max 5 levels up), like AccessLogger.
        $autoprefix = '';
        for ($i = 0; $i < 5; $i++) {
            $autoprefix = str_repeat('../', $i);
            if (file_exists($autoprefix . 'autoloader.php')) {
                break;
            }
        }

        self::$file     = $autoprefix . 'var/log/debug-players.log';
        self::$maxBytes = max(1, (int)($cfg['max_size_mb'] ?? 5)) * 1024 * 1024;

        self::$capture = [
            'WARNING'    => !empty($cfg['lvl_warning']),
            'NOTICE'     => !empty($cfg['lvl_notice']),
            'DEPRECATED' => !empty($cfg['lvl_deprecated']),
            'FATAL'      => !empty($cfg['lvl_fatal']),
        ];

        $page = $_SERVER['PHP_SELF'] ?? 'cli';
        self::$context = 'uid=' . (int)$uid
            . ($name !== '' ? ' (' . $name . ')' : '')
            . ' | page=' . $page;

        set_error_handler([self::class, 'handleError']);
        register_shutdown_function([self::class, 'handleShutdown']);
    }

    /**
     * Map a PHP error constant to one of our four severity buckets.
     */
    private static function bucket($errno) {
        switch ($errno) {
            case E_WARNING:
            case E_USER_WARNING:
            case E_CORE_WARNING:
            case E_COMPILE_WARNING:
                return 'WARNING';
            case E_NOTICE:
            case E_USER_NOTICE:
                return 'NOTICE';
            case E_DEPRECATED:
            case E_USER_DEPRECATED:
                return 'DEPRECATED';
            default:
                // E_ERROR, E_PARSE, E_RECOVERABLE_ERROR, E_USER_ERROR, ...
                return 'FATAL';
        }
    }

    /**
     * Runtime error handler. Returns false so PHP's default handling still
     * runs (respecting display_errors/error_reporting), keeping behaviour
     * unchanged. Suppressed errors (the @ operator) are ignored on purpose.
     */
    public static function handleError($errno, $errstr, $errfile = '', $errline = 0) {
        // Respect the @ operator: in PHP 8 error_reporting() returns 0 inside
        // the handler for a suppressed error.
        if (error_reporting() === 0) {
            return false;
        }

        $bucket = self::bucket($errno);
        if (!empty(self::$capture[$bucket])) {
            self::write($bucket, $errstr, $errfile, $errline);
        }

        return false;
    }

    /**
     * Shutdown handler: catches fatal errors that the error handler cannot
     * (E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR).
     */
    public static function handleShutdown() {
        if (empty(self::$capture['FATAL'])) {
            return;
        }

        $err = error_get_last();
        if ($err === null) {
            return;
        }

        $fatal = E_ERROR | E_PARSE | E_CORE_ERROR | E_COMPILE_ERROR;
        if (($err['type'] & $fatal) === 0) {
            return;
        }

        self::write('FATAL', $err['message'], $err['file'], $err['line']);
    }

    /**
     * Append one formatted line, rotating the file first if it grew past the
     * size cap. Never throws — logging must not break the game.
     */
    private static function write($severity, $message, $file, $line) {
        try {
            if (self::$file === null) {
                return;
            }

            // Size-cap rotation: keep one ".1" backup, then start fresh.
            if (@file_exists(self::$file) && @filesize(self::$file) >= self::$maxBytes) {
                @rename(self::$file, self::$file . '.1');
            }

            $message = str_replace(["\r", "\n"], ' ', (string)$message);
            $entry = '[' . date('Y-m-d H:i:s') . '] '
                . $severity . ': ' . $message
                . ' in ' . $file . ':' . $line
                . ' | ' . self::$context . "\n";

            @file_put_contents(self::$file, $entry, FILE_APPEND | LOCK_EX);
        } catch (\Throwable $e) {
            // swallow: a logging failure must never surface to players
        }
    }
}
