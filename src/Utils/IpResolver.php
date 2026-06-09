<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ                                                    ##
##  Filename       IpResolver.php                                              ##
##  Feature:       IP ban support (issue #185)                                 ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2026. All rights reserved.               ##
##  Source code:   https://github.com/Shadowss/TravianZ                       ##
##                                                                             ##
#################################################################################

namespace App\Utils;

/**
 * Resolves the real client IP address in a way that works for every
 * deployment style (direct, reverse-proxy, Cloudflare) WITHOUT opening a
 * spoofing hole, and enforces IP bans.
 *
 * Security model
 * --------------
 * By default only REMOTE_ADDR is trusted (it cannot be spoofed). Forwarded
 * headers (X-Forwarded-For / CF-Connecting-IP) are read ONLY when REMOTE_ADDR
 * belongs to a configured list of trusted proxies. This prevents an attacker
 * from bypassing an IP ban by simply sending a fake X-Forwarded-For header.
 *
 * Configuration constants (all optional, sane defaults apply):
 *   IP_TRUSTED_PROXIES   Comma-separated list (or array) of proxy IPs / CIDRs
 *                        that are allowed to set the forwarded header.
 *                        Examples:
 *                          - direct access:        "" (default, REMOTE_ADDR only)
 *                          - single reverse proxy: "10.0.0.1"
 *                          - Cloudflare:           the Cloudflare IP ranges
 *   IP_FORWARDED_HEADER  The $_SERVER key to read when behind a trusted proxy.
 *                        Default "HTTP_X_FORWARDED_FOR". For Cloudflare use
 *                        "HTTP_CF_CONNECTING_IP".
 *   BAN_IP_ENABLED       Set to false to disable IP-ban enforcement entirely.
 */
class IpResolver
{
    /**
     * Returns the validated client IP string, or null if none could be resolved.
     */
    public static function getClientIp()
    {
        $remote = isset($_SERVER['REMOTE_ADDR']) ? trim($_SERVER['REMOTE_ADDR']) : '';

        // Default & safe path: trust only the direct peer address.
        if (!self::remoteIsTrustedProxy($remote)) {
            return filter_var($remote, FILTER_VALIDATE_IP) ? $remote : null;
        }

        // We are behind a trusted proxy: read the forwarded header.
        $header = (defined('IP_FORWARDED_HEADER') && IP_FORWARDED_HEADER)
            ? IP_FORWARDED_HEADER
            : 'HTTP_X_FORWARDED_FOR';

        if (!empty($_SERVER[$header])) {
            // X-Forwarded-For may be a list: "client, proxy1, proxy2".
            // The left-most valid address is the original client.
            foreach (explode(',', $_SERVER[$header]) as $candidate) {
                $candidate = trim($candidate);
                if (filter_var($candidate, FILTER_VALIDATE_IP)) {
                    return $candidate;
                }
            }
        }

        // Header missing/invalid → fall back to the proxy address itself.
        return filter_var($remote, FILTER_VALIDATE_IP) ? $remote : null;
    }

    /**
     * Whether REMOTE_ADDR is in the configured trusted-proxy list.
     */
    private static function remoteIsTrustedProxy($remote)
    {
        if ($remote === '' || !defined('IP_TRUSTED_PROXIES') || !IP_TRUSTED_PROXIES) {
            return false;
        }

        $list = is_array(IP_TRUSTED_PROXIES)
            ? IP_TRUSTED_PROXIES
            : preg_split('/\s*,\s*/', trim(IP_TRUSTED_PROXIES));

        foreach ($list as $cidr) {
            if ($cidr !== '' && self::ipInCidr($remote, $cidr)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Returns true when $ip falls inside the $cidr range (IPv4 or IPv6).
     * A plain IP (no "/") is matched for equality.
     */
    public static function ipInCidr($ip, $cidr)
    {
        if (strpos($cidr, '/') === false) {
            return $ip === $cidr;
        }

        list($subnet, $bits) = explode('/', $cidr, 2);
        $bits = (int) $bits;

        $ipBin  = @inet_pton($ip);
        $subBin = @inet_pton($subnet);

        // Both must be valid and of the same family (4 or 16 bytes).
        if ($ipBin === false || $subBin === false || strlen($ipBin) !== strlen($subBin)) {
            return false;
        }

        $fullBytes = intdiv($bits, 8);
        $remBits   = $bits % 8;

        if ($fullBytes > 0 && substr($ipBin, 0, $fullBytes) !== substr($subBin, 0, $fullBytes)) {
            return false;
        }

        if ($remBits > 0) {
            $mask = chr((0xff << (8 - $remBits)) & 0xff);
            if ((ord($ipBin[$fullBytes]) & ord($mask)) !== (ord($subBin[$fullBytes]) & ord($mask))) {
                return false;
            }
        }

        return true;
    }

    /**
     * Converts an IP string to its packed binary form (for varbinary storage).
     * Returns null on invalid input.
     */
    public static function toBinary($ip)
    {
        $bin = @inet_pton($ip);
        return $bin === false ? null : $bin;
    }

    /**
     * Blocks the request if the resolved client IP is banned.
     * Renders a stand-alone 403 page and stops execution. Never throws.
     *
     * @param object $database The global Database instance (must expose ipBanActive()).
     */
    public static function enforce($database)
    {
        if (defined('BAN_IP_ENABLED') && !BAN_IP_ENABLED) {
            return;
        }

        $ip = self::getClientIp();
        if ($ip === null) {
            return;
        }

        $bin = self::toBinary($ip);
        if ($bin === null || !is_object($database) || !method_exists($database, 'ipBanActive')) {
            return;
        }

        $ban = $database->ipBanActive($bin);
        if (!$ban) {
            return;
        }

        if (!headers_sent()) {
            header('HTTP/1.1 403 Forbidden');
            header('Content-Type: text/html; charset=UTF-8');
        }

        $reason = (isset($ban['reason']) && $ban['reason'] !== '')
            ? htmlspecialchars($ban['reason'], ENT_QUOTES, 'UTF-8')
            : '';
        $until = !empty($ban['end']) ? date('Y-m-d H:i', (int) $ban['end']) : '&infin;';

        echo '<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8">'
            . '<meta name="viewport" content="width=device-width,initial-scale=1">'
            . '<title>Access blocked</title></head>'
            . '<body style="font-family:Verdana,Arial,sans-serif;background:#0f172a;color:#e2e8f0;text-align:center;padding:60px 20px">'
            . '<h1 style="color:#ef4444;margin-bottom:8px">Access blocked</h1>'
            . '<p>Your IP address has been banned from this server.</p>'
            . ($reason !== '' ? '<p>Reason: <b>' . $reason . '</b></p>' : '')
            . '<p style="opacity:.7;font-size:13px">Ban expires: ' . $until . '</p>'
            . '</body></html>';

        exit;
    }
}
