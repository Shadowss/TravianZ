<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ                                                    ##
##  Filename       Math.php                                                    ##
##  Developed by:  martinambrus                                                ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2017. All rights reserved.                ##
##  URLs:          https://travian.martinambrus.com                		       ##
##  Source code:   https://github.com/Shadowss/TravianZ		                   ##
##                                                                             ##
#################################################################################

namespace App\Utils;

/**
 *
 * Date and Time related helpers.
 *
 * @author martinambrus
 *
 */
class DateTime {

    /**
     * Parse the configured game-world start using the server timezone.
     *
     * The installer writes START_DATE as d.m.Y and START_TIME as H:i. Parsing
     * them together avoids the month/year ordering bugs caused by comparing
     * the formatted values as strings.
     *
     * @return int|null Unix timestamp, or null when the configuration is invalid.
     */
    public static function getServerStartTimestamp($startDate, $startTime, $timezone = null)
    {
        if (!$timezone instanceof \DateTimeZone) {
            $timezone = new \DateTimeZone(date_default_timezone_get());
        }

        $value = trim((string) $startDate) . ' ' . trim((string) $startTime);

        try {
            $start = \DateTimeImmutable::createFromFormat('!d.m.Y H:i', $value, $timezone);
        } catch (\ValueError $exception) {
            return null;
        }

        $errors = \DateTimeImmutable::getLastErrors();

        if (
            $start === false
            || ($errors !== false && ($errors['warning_count'] > 0 || $errors['error_count'] > 0))
            || $start->format('d.m.Y H:i') !== $value
        ) {
            return null;
        }

        return $start->getTimestamp();
    }

    /**
     * Return true from the first second of the configured start minute.
     */
    public static function hasServerStarted($startDate, $startTime, $now = null, $timezone = null)
    {
        $start = self::getServerStartTimestamp($startDate, $startTime, $timezone);
        if ($start === null) {
            return false;
        }

        $now = $now === null ? time() : (int) $now;

        return $now >= $start;
    }

    public static function getTimeFormat($time)
    {
        $min = 0;
        $hr = 0;
        $days = 0;
        while ($time >= 60): $time -= 60; $min += 1; endwhile;
        while ($min  >= 60): $min  -= 60; $hr  += 1; endwhile;
        while ($hr   >= 24): $hr   -= 24; $days +=1; endwhile;
        if ($min < 10)
        {
            $min = "0".$min;
        }
        if($time < 10)
        {
            $time = "0".$time;
        }
        return $days ." day ".$hr."h ".$min."m ".$time."s";
    }

}
