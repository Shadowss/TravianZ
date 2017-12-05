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