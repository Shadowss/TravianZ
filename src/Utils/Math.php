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
 * Mathematics-related helpers.
 *
 * @author martinambrus
 *
 */
class Math {

    public static function isInt($val) {
        return (is_numeric($val) && intval($val) === $val);
    }

    public static function isFloat($val) {
        return (is_numeric($val) && floatval($val) === $val);
    }

}