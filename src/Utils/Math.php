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
 * Mathematics-related helpers.
 *
 * @author martinambrus
 *
 */
class Math
{

    /**
     * Determines if a number is integer
     * 
     * @param mixed $val
     * @return bool
     */
    public static function isInt($val): bool
    {
        return (is_numeric($val) && intval($val) == $val);
    }

    /**
     * Determines if a number is float
     * 
     * @param mixed $val
     * @return bool
     */
    public static function isFloat($val): bool
    {
        return (is_numeric($val) && floatval($val) == $val);
    }
    
    /**
     * Round a number to the nearest integer precision
     *
     * @param number $number The number
     * @param int $precision The precision
     * @return int Returns the rounded number
     */
    public static function roundWithPrecision($number, int $precision): int
    {
        return (int) ($precision * round($number / $precision));
    }
}