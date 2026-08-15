<?php

#################################################################################
##              TravianZ - Multi-instance world registry                    ##
##  Filename       : Registry.php                                            ##
##  Purpose        : Discover worlds and expose homepage/server statistics.  ##
#################################################################################

/**
 * Read-only registry for the public TravianZ homepage.
 *
 * IMPORTANT:
 * - The registry never includes an instance config.php. It reads only the
 *   small set of generated constants required to identify the world.
 * - Each world keeps its own database connection, so the homepage can collect
 *   statistics from every installed instance without changing the active
 *   TravianZ database connection used by the current request.
 * - A missing/unreachable database is reported as CLOSED instead of making the
 *   complete homepage fail because one world is unavailable.
 */
require_once __DIR__ . '/Status.php';

class InstanceRegistry
{
    private static $instances = null;

    /** Return all installed instances sorted by their server number. */
    public static function all($forceRefresh = false)
    {
        if (self::$instances !== null && !$forceRefresh) {
            return self::$instances;
        }

        $root = dirname(__DIR__, 2);
        $instancesRoot = $root . DIRECTORY_SEPARATOR . 'instances';
        $found = [];

        if (!is_dir($instancesRoot)) {
            return self::$instances = [];
        }

        foreach ((array) @scandir($instancesRoot) as $directory) {
            if ($directory === '.' || $directory === '..') {
                continue;
            }

            if (!preg_match('/^s[0-9]+$/i', $directory)) {
                continue;
            }

            $instance = strtolower($directory);
            $configFile = $instancesRoot . DIRECTORY_SEPARATOR . $instance . DIRECTORY_SEPARATOR . 'config.php';
            $installedFile = $instancesRoot . DIRECTORY_SEPARATOR . $instance . DIRECTORY_SEPARATOR . 'installed';

            if (!is_file($configFile) || !is_file($installedFile)) {
                continue;
            }

            $config = @file_get_contents($configFile);
            if ($config === false) {
                continue;
            }

            $meta = self::parseConfig($config, $instance);
            $meta['path'] = $instancesRoot . DIRECTORY_SEPARATOR . $instance;
            $meta['server_url'] = self::serverUrl($meta);
            $meta['image'] = self::worldImage($root, $meta, false);
            $meta['image_grey'] = self::worldImage($root, $meta, true);
            $meta['stats'] = self::stats($meta);

            $found[] = $meta;
        }

        usort($found, static function ($a, $b) {
            return ((int) $a['number']) <=> ((int) $b['number']);
        });

        return self::$instances = $found;
    }

    /** Return the next conventional instance identifier: s1, s2, s3... */
    public static function nextInstanceId()
    {
        $used = [];
        foreach (self::all() as $instance) {
            $used[(int) $instance['number']] = true;
        }

        $number = 1;
        while (isset($used[$number])) {
            $number++;
        }

        return 's' . $number;
    }

    private static function parseConfig($config, $instance)
    {
        $number = (int) preg_replace('/\D+/', '', $instance);
        if ($number < 1) {
            $number = 1;
        }

        $meta = [
            'id'      => $instance,
            'number'  => $number,
            'name'    => $instance,
            'domain'  => '',
            'homepage'=> '',
            'server'  => '',
            'sql_server' => 'localhost',
            'sql_port'   => 3306,
            'sql_user'   => '',
            'sql_pass'   => '',
            'sql_db'     => '',
            'prefix'     => '',
            'classic'    => false,
            'speed_mode' => false,
            'enabled'    => true,
            'reg_open'   => false,
        ];

        $stringKeys = [
            'SERVER_NAME' => 'name',
            'DOMAIN'      => 'domain',
            'HOMEPAGE'    => 'homepage',
            'SERVER'      => 'server',
            'SQL_SERVER'  => 'sql_server',
            'SQL_USER'    => 'sql_user',
            'SQL_PASS'    => 'sql_pass',
            'SQL_DB'     => 'sql_db',
            'TB_PREFIX'  => 'prefix',
        ];

        foreach ($stringKeys as $constant => $key) {
            $value = self::readStringConstant($config, $constant);
            if ($value !== null) {
                $meta[$key] = $value;
            }
        }

        foreach (['SERVER_NUMBER' => 'number'] as $constant => $key) {
            $value = self::readScalarConstant($config, $constant);
            if ($value !== null && (int) $value > 0) {
                $meta[$key] = (int) $value;
            }
        }

        foreach ([
            'SERVER_CLASSIC' => 'classic',
            'SERVER_SPEED'   => 'speed_mode',
            'SERVER_ENABLED' => 'enabled',
            'REG_OPEN'       => 'reg_open',
        ] as $constant => $key) {
            $value = self::readScalarConstant($config, $constant);
            if ($value !== null) {
                $meta[$key] = in_array(strtolower((string) $value), ['1', 'true', 'yes', 'on'], true);
            }
        }

        $port = self::readScalarConstant($config, 'SQL_PORT');
        if ($port !== null && (int) $port > 0) {
            $meta['sql_port'] = (int) $port;
        }

        return $meta;
    }

    private static function readStringConstant($config, $constant)
    {
        $pattern = '/define\s*\(\s*["\']' . preg_quote($constant, '/') . '["\']\s*,\s*["\']([^"\']*)["\']\s*\)/i';
        return preg_match($pattern, $config, $m) ? trim($m[1]) : null;
    }

    private static function readScalarConstant($config, $constant)
    {
        $pattern = '/define\s*\(\s*["\']' . preg_quote($constant, '/') . '["\']\s*,\s*([^\)]+)\)/i';
        if (!preg_match($pattern, $config, $m)) {
            return null;
        }

        return trim(trim($m[1]), " \t\r\n\"'");
    }

    /** Build the public URL used by homepage links. */
    private static function serverUrl(array $meta)
    {
        $configured = trim((string) $meta['server']);
        $host = isset($_SERVER['HTTP_HOST']) ? preg_replace('/:\d+$/', '', strtolower($_SERVER['HTTP_HOST'])) : '';
        $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
        $basePath = self::localProjectPath($meta['id']);

        $isLocal = ($host === 'localhost' || $host === '' || filter_var($host, FILTER_VALIDATE_IP) !== false);
        if ($isLocal) {
            return $scheme . '://' . ($host !== '' ? $host : 'localhost') . $basePath . '/' . $meta['id'] . '/';
        }

        if ($configured !== '') {
            return rtrim($configured, '/') . '/';
        }

        return $scheme . '://' . $host . '/';
    }

    /**
     * Determine the local project path without requiring any Apache/hosts
     * configuration. This also works when /sN/ has been internally rewritten
     * to the shared root index.php.
     */
    private static function localProjectPath($instance)
    {
        $requestPath = isset($_SERVER['REQUEST_URI'])
            ? parse_url((string) $_SERVER['REQUEST_URI'], PHP_URL_PATH)
            : '';
        $requestPath = is_string($requestPath) ? rawurldecode($requestPath) : '';

        if ($requestPath !== '') {
            $segments = explode('/', trim($requestPath, '/'));
            foreach ($segments as $index => $segment) {
                // Any conventional /sN/ segment identifies the project root.
                // We intentionally do not require it to match the world being
                // rendered because the homepage lists all worlds at once.
                if (preg_match('/^s[0-9]+$/i', $segment)) {
                    $prefix = array_slice($segments, 0, $index);
                    return $prefix ? '/' . implode('/', $prefix) : '';
                }
            }
        }

        $script = isset($_SERVER['SCRIPT_NAME']) ? str_replace('\\', '/', $_SERVER['SCRIPT_NAME']) : '/index.php';
        $basePath = rtrim(dirname($script), '/');
        if ($basePath === '/.' || $basePath === '\\' || $basePath === '.') {
            $basePath = '';
        }
        $basePath = preg_replace('#/install$#', '', $basePath);
        return $basePath === '/' ? '' : $basePath;
    }

    /** Select the requested TravianZ world thumbnail, with safe fallbacks. */
    private static function worldImage($root, array $meta, $grey)
    {
        $dir = $root . '/img/en/welten/';
        $suffix = $grey ? '_g' : '';
        $number = (int) $meta['number'];

        if ($meta['speed_mode']) {
            $candidates = ['enx_big' . $suffix . '.jpg'];
        } elseif ($meta['classic']) {
            $candidates = [
                'en' . $number . '_big_classic' . $suffix . '.jpg',
                'en' . $number . '_big' . $suffix . '.jpg',
            ];
        } else {
            $candidates = [
                'en' . $number . '_big' . $suffix . '.jpg',
                'en' . $number . '_big_classic' . $suffix . '.jpg',
            ];
        }

        foreach ($candidates as $candidate) {
            if (is_file($dir . $candidate)) {
                return 'img/en/welten/' . $candidate;
            }
        }

        // The requested artwork may not exist for an unusually high server
        // number. Falling back to server 1 is preferable to a broken image.
        return 'img/en/welten/' . ($meta['speed_mode'] ? 'enx_big' . $suffix . '.jpg' : 'en1_big' . $suffix . '.jpg');
    }

    /**
     * Query one instance without changing the application's global $link.
     * A failure makes the world CLOSED, but never breaks the homepage.
     */
    private static function stats(array $meta)
    {
        $stats = [
            'reachable' => false,
            'status' => InstanceStatus::CLOSED,
            'maintenance' => false,
            'debug' => false,
            'players' => 0,
            'active' => 0,
            'online' => 0,
        ];

        if (empty($meta['enabled']) || !class_exists('mysqli')) {
            return $stats;
        }

        $db = @new mysqli(
            $meta['sql_server'],
            $meta['sql_user'],
            $meta['sql_pass'],
            $meta['sql_db'],
            (int) $meta['sql_port']
        );

        $status = InstanceStatus::inspectConnection($db, $meta);
        $stats = array_merge($stats, $status);

        if (!$status['reachable']) {
            if ($db instanceof mysqli) {
                @$db->close();
            }
            return $stats;
        }

        $prefix = $meta['prefix'];
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $prefix)) {
            @$db->close();
            $stats['status'] = InstanceStatus::CLOSED;
            $stats['reachable'] = false;
            return $stats;
        }

        $usersTable = '`' . $prefix . 'users`';
        $tribes = 'tribe IN (1,2,3,6,7,8,9)';
        $now = time();
        $queries = [
            'players' => "SELECT COUNT(*) AS total FROM {$usersTable} WHERE {$tribes}",
            'active' => "SELECT COUNT(*) AS total FROM {$usersTable} WHERE timestamp > " . ($now - 86400) . " AND {$tribes}",
            'online' => "SELECT COUNT(*) AS total FROM {$usersTable} WHERE timestamp > " . ($now - 600) . " AND {$tribes}",
        ];

        foreach ($queries as $key => $sql) {
            $result = @$db->query($sql);
            if ($result) {
                $row = $result->fetch_assoc();
                $stats[$key] = isset($row['total']) ? (int) $row['total'] : 0;
            }
        }

        @$db->close();
        return $stats;
    }
}
