<?php

#################################################################################
##              TravianZ - Multi-instance server status                      ##
##  Filename       : Status.php                                               ##
##  Purpose        : Centralize the operational state of each world.         ##
#################################################################################

/**
 * Central source of truth for the public state of a TravianZ instance.
 *
 * Status rules:
 *   OPERATIONAL   : installed/enabled, database reachable, no maintenance,
 *                   and no debug mode active.
 *   IN MAINTENANCE: maintenance OR debug mode is active.
 *   CLOSE         : instance disabled or its database is unreachable.
 *
 * Registration is deliberately NOT part of the server status. REG_OPEN only
 * controls whether a player may register; a server can remain operational
 * while registrations are closed.
 */
class InstanceStatus
{
    const OPERATIONAL = 'OPERATIONAL';
    const MAINTENANCE = 'IN MAINTENANCE';
    const CLOSED = 'CLOSE';

    /**
     * Inspect an instance using a mysqli connection created by the registry.
     */
    public static function inspectConnection($db, array $meta)
    {
        $result = self::base($meta);

        if (empty($meta['enabled'])) {
            $result['status'] = self::CLOSED;
            return $result;
        }

        if (!$db || !empty($db->connect_errno)) {
            $result['status'] = self::CLOSED;
            return $result;
        }

        $result['reachable'] = true;
        $prefix = isset($meta['prefix']) ? (string) $meta['prefix'] : '';
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $prefix)) {
            $result['status'] = self::CLOSED;
            return $result;
        }

        $maintenance = self::readActive($db, '`' . $prefix . 'maintenance`');
        $debug = self::readActive($db, '`' . $prefix . 'debug_log`');

        $result['maintenance'] = $maintenance;
        $result['debug'] = $debug;
        $result['status'] = ($maintenance || $debug)
            ? self::MAINTENANCE
            : self::OPERATIONAL;

        return $result;
    }

    /**
     * Inspect the current world through the normal TravianZ Database object.
     * This keeps Session.php from implementing a second definition of status.
     */
    public static function inspectDatabase($database, $enabled = true)
    {
        $result = self::base(['enabled' => $enabled]);

        if (!$enabled) {
            $result['status'] = self::CLOSED;
            return $result;
        }

        try {
            $maintenance = $database->getMaintenance();
            $debug = $database->getDebugMode();

            $result['reachable'] = true;
            $result['maintenance'] = !empty($maintenance['active']);
            $result['debug'] = !empty($debug['active']);
            $result['status'] = ($result['maintenance'] || $result['debug'])
                ? self::MAINTENANCE
                : self::OPERATIONAL;
        } catch (Throwable $e) {
            $result['status'] = self::CLOSED;
        }

        return $result;
    }

    public static function isOperational(array $status)
    {
        return isset($status['status']) && $status['status'] === self::OPERATIONAL;
    }

    public static function isMaintenance(array $status)
    {
        return isset($status['status']) && $status['status'] === self::MAINTENANCE;
    }

    public static function isClosed(array $status)
    {
        return !isset($status['status']) || $status['status'] === self::CLOSED;
    }

    private static function base(array $meta)
    {
        return [
            'reachable' => false,
            'status' => self::CLOSED,
            'maintenance' => false,
            'debug' => false,
        ];
    }

    /**
     * Read a conventional single-row `active` flag. Missing tables are treated
     * as inactive so an older installation remains operational after upgrade.
     */
    private static function readActive($db, $table)
    {
        $query = @$db->query("SELECT active FROM {$table} WHERE id=1 LIMIT 1");
        if (!$query) {
            return false;
        }

        $row = $query->fetch_assoc();
        return !empty($row['active']);
    }
}
