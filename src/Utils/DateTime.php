<?php

/*
 * This file is part of the TravianZ Project
 *
 * Source code: <https://github.com/Shadowss/TravianZ/>
 *
 * Author: martinambrus <https://github.com/martinambrus>
 *
 * License: GNU GPL-3.0 <https://github.com/Shadowss/TravianZ/blob/master/LICENSE>
 *
 * Copyright 2010-2018 TravianZ Team
 */

namespace TravianZ\Utils;

/**
 *
 * Date and Time related helpers.
 *
 * @author martinambrus
 *
 */
class DateTime 
{

    public static function getTimeFormat($time)
    {
        $min = 0;
        $hr = 0;
        $days = 0;
        while ($time >= 60) {
            $time -= 60;
            $min += 1;
        }
        
        while ($min >= 60) {
            $min -= 60;
            $hr += 1;
        }
        
        while ($hr >= 24) {
            $hr -= 24;
            $days += 1;
        }
        
        if ($min < 10) {
            $min = "0" . $min;
        }
        if ($time < 10) {
            $time = "0" . $time;
        }
        
        return $days . " day " . $hr . "h " . $min . "m " . $time . "s";
    }

}
