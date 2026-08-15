<?php

#################################################################################
##              TravianZ - Multi-instance bootstrap                            ##
##  Filename       : Resolver.php                                              ##
##  Purpose        : Resolve the TravianZ world used by the current request.   ##
##  License        : TravianZ Project                                          ##
#################################################################################

/**
 * Resolves the TravianZ instance (world) that must be used for the current
 * request.
 *
 * The resolver deliberately knows nothing about the database or gameplay. Its
 * only responsibility is to turn the execution context into a safe instance
 * identifier such as "s1" or "s2" and provide the paths belonging to it.
 *
 * Resolution order:
 *   1. CLI argument:         --instance=s1
 *   2. TRAVIAN_INSTANCE env: s1
 *   3. Local path selection: /s1/
 *   4. Query selection:      $_SESSION['travian_instance']
 *   5. HTTP hostname:        first DNS label (s1.example.com -> s1)
 *   6. Session exist:        $_SESSION['travian_instance']
 *   7. Installer session:    $_SESSION['install_instance']
 *   8. Development fallback: s1
 *
 * The instance identifier is never used as an arbitrary filesystem path. It
 * is restricted to [a-zA-Z0-9_-] and is always resolved below /instances/.
 */
class InstanceResolver
{
    /**
     * Return the TravianZ project root directory.
     */
    public static function rootPath()
    {
        return dirname(__DIR__, 2);
    }

    /**
     * Validate and normalize an instance identifier.
     *
     * We intentionally keep the allowed syntax conservative because the value
     * eventually participates in a filesystem path and is also used as the
     * instance identity throughout the application.
     */
    public static function sanitize($instance)
    {
        $instance = strtolower(trim((string) $instance));

        if ($instance === '' || !preg_match('/^[a-z0-9][a-z0-9_-]{0,31}$/', $instance)) {
            return null;
        }

        return $instance;
    }

    /**
     * Resolve the current instance.
     *
     * The optional $allowDefault argument is kept for installer/development
     * contexts where there is no hostname yet. Normal web requests still use
     * the same deterministic fallback when running on localhost.
     */
    public static function resolve($allowDefault = true)
    {
        /*
         * IMPORTANT:
         * The PHP session cookie is instance-specific. On a shared host such
         * as localhost, S1 and S2 cannot safely use the default PHPSESSID:
         * whichever instance starts the session last would overwrite the
         * other instance's authentication state.
         *
         * Therefore we resolve the instance from an explicit source BEFORE
         * starting a PHP session whenever possible, then use a cookie name
         * derived from that instance (TZSESSID_S1, TZSESSID_S2, ...).
         */

        // 1. CLI argument: canonical for cron.php.
        if (PHP_SAPI === 'cli' && isset($GLOBALS['argv']) && is_array($GLOBALS['argv'])) {
            foreach ($GLOBALS['argv'] as $argument) {
                if (strpos($argument, '--instance=') === 0) {
                    $instance = self::sanitize(substr($argument, 11));
                    if ($instance !== null) {
                        return $instance;
                    }
                }
            }
        }

        // 2. Explicit environment variable.
        $environmentInstance = getenv('TRAVIAN_INSTANCE');
        $environmentInstance = self::sanitize($environmentInstance === false ? '' : $environmentInstance);
        if ($environmentInstance !== null) {
            return $environmentInstance;
        }

        // 3. Explicit local path selection.
        //
        // The local installation does not require hosts/DNS changes. The
        // shared .htaccess maps /s1/..., /s2/... back to the same source tree
        // and carries the selected instance internally. We inspect REQUEST_URI
        // as an additional safeguard so the resolver also understands the
        // visible /s1/ or /s2/ URL before PHP receives the rewritten request.
        $pathInstance = self::instanceFromPath();
        if ($pathInstance !== null) {
            self::startInstanceSession($pathInstance);
            $_SESSION['travian_instance'] = $pathInstance;
            return $pathInstance;
        }

        // 4. Explicit query selection. This remains the installation and
        // compatibility mechanism: /install/?instance=s2 and legacy URLs can
        // still select an instance without requiring the /s2/ path form.
        if (isset($_GET['instance'])) {
            $queryInstance = self::sanitize($_GET['instance']);
            if ($queryInstance !== null) {
                self::startInstanceSession($queryInstance);
                $_SESSION['travian_instance'] = $queryInstance;
                return $queryInstance;
            }
        }

        // 5. Hostname selection. Production should use distinct hostnames,
        // e.g. travianz.example.com and travianz2.example.com. This gives us
        // an unambiguous instance identity and therefore an unambiguous
        // session cookie name.
        $hostInstance = self::instanceFromHost();
        if ($hostInstance !== null) {
            self::startInstanceSession($hostInstance);
            $_SESSION['travian_instance'] = $hostInstance;
            return $hostInstance;
        }

        // 6. If no explicit path/query/hostname was supplied, use the
        // already active instance session as a legacy fallback.
        //
        // We deliberately do NOT inspect arbitrary TZSESSID_* cookies here.
        // On localhost several instance cookies can coexist, and cookie order
        // cannot tell us which browser tab generated the current request. The
        // path-based local URL (/s1/, /s2/, ...) is the authoritative selector.
        if (PHP_SAPI !== 'cli' && session_status() === PHP_SESSION_ACTIVE
            && isset($_SESSION['travian_instance'])) {
            $sessionInstance = self::sanitize($_SESSION['travian_instance']);
            if ($sessionInstance !== null) {
                return $sessionInstance;
            }
        }

        // 7. Installer session is kept for backwards compatibility. The
        // installer itself explicitly chooses the instance on every step.
        if (PHP_SAPI !== 'cli') {
            // The installer may already have started its own session.
            if (session_status() === PHP_SESSION_ACTIVE && isset($_SESSION['install_instance'])) {
                $sessionInstance = self::sanitize($_SESSION['install_instance']);
                if ($sessionInstance !== null) {
                    return $sessionInstance;
                }
            }
        }

        // 8. Local development fallback.
        if ($allowDefault) {
            // Prefer the first installed world. In the normal case this is S1,
            // but this also keeps a deployment usable when S1 was deliberately
            // removed and S2 is the first remaining world.
            $default = self::firstInstalledInstance();
            if ($default === null) {
                $default = 's1';
            }
            if (PHP_SAPI !== 'cli') {
                self::startInstanceSession($default);
                $_SESSION['travian_instance'] = $default;
            }
            return $default;
        }

        throw new RuntimeException('Unable to resolve the TravianZ instance.');
    }

    /**
     * Return the instance encoded by the local URL path.
     *
     * Examples:
     *   /s1/             -> s1
     *   /s2/anmelden.php -> s2
     *
     * Only installed/generated instances are accepted. This prevents ordinary
     * application directories such as /img/ or /install/ from becoming an
     * accidental instance selector.
     */
    private static function instanceFromPath()
    {
        if (!isset($_SERVER['REQUEST_URI'])) {
            return null;
        }

        $requestPath = parse_url((string) $_SERVER['REQUEST_URI'], PHP_URL_PATH);
        if (!is_string($requestPath) || $requestPath === '') {
            return null;
        }

        // REQUEST_URI includes the project directory when TravianZ is installed
        // below a local web root, for example:
        // /TravianZ-MI%20-%20Copie/s2/anmelden.php
        // Therefore we inspect every path segment and accept only a segment
        // that corresponds to an existing instance configuration.
        $segments = explode('/', trim(rawurldecode($requestPath), '/'));
        foreach ($segments as $segment) {
            $candidate = self::sanitize($segment);
            if ($candidate === null) {
                continue;
            }

            $configFile = self::rootPath() . DIRECTORY_SEPARATOR . 'instances'
                . DIRECTORY_SEPARATOR . $candidate . DIRECTORY_SEPARATOR . 'config.php';

            if (is_file($configFile)) {
                return $candidate;
            }
        }

        return null;
    }

    /**
     * Return the instance encoded by the current HTTP host.
     */
    private static function instanceFromHost()
    {
        if (!isset($_SERVER['HTTP_HOST'])) {
            return null;
        }

        $host = strtolower(trim((string) $_SERVER['HTTP_HOST']));
        $host = preg_replace('/:\d+$/', '', $host);

        if ($host === '' || $host === 'localhost' || filter_var($host, FILTER_VALIDATE_IP) !== false) {
            return null;
        }

        /*
         * The instance directory name (s1, s2, ...) is an internal identifier.
         * It must NOT be assumed to be the public hostname. A server may be
         * called "TravianZ" while its instance remains "s1", for example:
         *
         *     travianz.example.test  -> s1
         *     travianz2.example.test -> s2
         *
         * We therefore inspect the already-generated instance configurations
         * without executing them. The public hostname can be matched against
         * the configured DOMAIN/HOMEPAGE/SERVER host or, as a convenient local
         * fallback, against SERVER_NAME (TravianZ -> travianz).
         *
         * This keeps the mapping in the generated configuration itself instead
         * of introducing a second hand-maintained host-to-instance registry.
         */
        $instancesRoot = self::rootPath() . DIRECTORY_SEPARATOR . 'instances';
        if (!is_dir($instancesRoot)) {
            return null;
        }

        $directories = @scandir($instancesRoot);
        if (!is_array($directories)) {
            return null;
        }

        foreach ($directories as $directory) {
            if ($directory === '.' || $directory === '..') {
                continue;
            }

            $instance = self::sanitize($directory);
            if ($instance === null) {
                continue;
            }

            $configFile = $instancesRoot . DIRECTORY_SEPARATOR . $instance . DIRECTORY_SEPARATOR . 'config.php';
            if (!is_file($configFile)) {
                continue;
            }

            $config = @file_get_contents($configFile);
            if ($config === false) {
                continue;
            }

            foreach (array('DOMAIN', 'HOMEPAGE', 'SERVER') as $constant) {
                $configuredUrl = self::readStringConstant($config, $constant);
                $configuredHost = self::hostFromUrl($configuredUrl);

                if ($configuredHost !== null && self::hostMatches($host, $configuredHost)) {
                    return $instance;
                }
            }

            $serverName = self::readStringConstant($config, 'SERVER_NAME');
            if ($serverName !== null) {
                $serverSlug = self::slugifyHostLabel($serverName);
                $hostLabel = self::slugifyHostLabel(explode('.', $host)[0]);

                if ($serverSlug !== '' && $serverSlug === $hostLabel) {
                    return $instance;
                }
            }
        }

        return null;
    }

    /**
     * Extract a simple define("CONSTANT", "value") from a generated
     * configuration file. The file is parsed as text and NEVER included, so
     * database credentials or other executable configuration cannot run while
     * the resolver is only trying to identify an instance.
     */
    private static function readStringConstant($config, $constant)
    {
        $pattern = '/define\s*\(\s*[\"\\\']' . preg_quote($constant, '/') . '[\"\\\']\s*,\s*[\"\\\']([^\"\\\']*)[\"\\\']\s*\)/i';

        if (preg_match($pattern, $config, $matches)) {
            return trim($matches[1]);
        }

        return null;
    }

    /** Return the hostname portion of an HTTP(S) URL. */
    private static function hostFromUrl($url)
    {
        if (!is_string($url) || trim($url) === '') {
            return null;
        }

        $parts = @parse_url(trim($url));
        if (!is_array($parts) || empty($parts['host'])) {
            return null;
        }

        $configuredHost = strtolower(trim($parts['host']));
        return $configuredHost !== '' ? $configuredHost : null;
    }

    /**
     * Match a request host against a configured host, including a harmless
     * optional www prefix. Ports have already been removed from HTTP_HOST.
     */
    private static function hostMatches($requestHost, $configuredHost)
    {
        $requestHost = strtolower(trim($requestHost));
        $configuredHost = strtolower(trim($configuredHost));

        return $requestHost === $configuredHost
            || ('www.' . $configuredHost) === $requestHost
            || ('www.' . $requestHost) === $configuredHost;
    }

    /** Normalize a server name into a hostname-friendly comparison label. */
    private static function slugifyHostLabel($value)
    {
        $value = strtolower((string) $value);
        return preg_replace('/[^a-z0-9]+/', '', $value);
    }

    /**
     * Start the PHP session with a cookie name unique to the TravianZ world.
     *
     * Example:
     *   S1 -> TZSESSID_S1
     *   S2 -> TZSESSID_S2
     *
     * This is what allows S1 and S2 to stay logged in independently in the
     * same browser, even when both are served from localhost.
     */
    public static function startInstanceSession($instance)
    {
        $instance = self::sanitize($instance);
        if ($instance === null || PHP_SAPI === 'cli') {
            return;
        }

        if (session_status() === PHP_SESSION_ACTIVE) {
            return;
        }

        /*
         * session_name(), session_set_cookie_params() and session_start() all
         * need headers to be still available. The normal TravianZ bootstrap
         * reaches this method before page output; legacy installer templates
         * may not. In that case the caller must have started the appropriate
         * session earlier, so fail safely instead of emitting PHP warnings.
         */
        if (headers_sent()) {
            return;
        }

        $cookieName = 'TZSESSID_' . strtoupper($instance);

        session_name($cookieName);
        session_set_cookie_params(array(
            'lifetime' => 0,
            'path'     => '/',
            'secure'   => !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
            'httponly' => true,
            'samesite' => 'Lax',
        ));

        session_start();
    }

    /** Return the first installed instance in deterministic order. */
    private static function firstInstalledInstance()
    {
        $root = self::rootPath() . DIRECTORY_SEPARATOR . 'instances';
        if (!is_dir($root)) {
            return null;
        }

        $items = [];
        foreach ((array) @scandir($root) as $directory) {
            if ($directory === '.' || $directory === '..') {
                continue;
            }
            $instance = self::sanitize($directory);
            if ($instance === null || !self::isInstalled($instance)) {
                continue;
            }
            $items[] = $instance;
        }

        if (!$items) {
            return null;
        }

        usort($items, static function ($a, $b) {
            return strnatcasecmp($a, $b);
        });

        return $items[0];
    }

    /**
     * Return the directory dedicated to an instance.
     */
    public static function instancePath($instance = null)
    {
        $instance = self::sanitize($instance === null ? self::resolve() : $instance);
        if ($instance === null) {
            throw new InvalidArgumentException('Invalid TravianZ instance identifier.');
        }

        return self::rootPath() . DIRECTORY_SEPARATOR . 'instances' . DIRECTORY_SEPARATOR . $instance;
    }

    /**
     * Return the generated configuration path for an instance.
     */
    public static function configPath($instance = null)
    {
        return self::instancePath($instance) . DIRECTORY_SEPARATOR . 'config.php';
    }

    /**
     * Return the per-instance installation marker path.
     */
    public static function installedPath($instance = null)
    {
        return self::instancePath($instance) . DIRECTORY_SEPARATOR . 'installed';
    }

    /**
     * Return the per-instance runtime directory.
     */
    public static function runtimePath($instance = null)
    {
        return self::instancePath($instance) . DIRECTORY_SEPARATOR . 'runtime';
    }

    /**
     * Return the configuration path used by administrative configuration mods.
     *
     * This method exists so admin modules never accidentally overwrite the
     * shared GameEngine/config.php bootstrap file.
     */
    public static function adminConfigPath($instance = null)
    {
        return self::configPath($instance);
    }

    /**
     * Test whether a particular instance has completed installation.
     */
    public static function isInstalled($instance = null)
    {
        return is_file(self::installedPath($instance));
    }
}
