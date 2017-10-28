<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ                                                    ##
##  Filename       AccessLogger.php                                            ##
##  Developed by:  martinambrus                                                ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2017. All rights reserved.                ##
##  URLs:          https://travian.martinambrus.com                		       ##
##  Source code:   https://github.com/Shadowss/TravianZ		                   ##
##                                                                             ##
#################################################################################

namespace App\Utils;

/** 
 * Logs all user access (URLs, REQUEST data, Cookies...)
 * into a file. Usually used in hostings that do not provide
 * web server access logs, let alone ones that include
 * POST data and Cookies.
 * 
 * @author martinambrus
 */
class AccessLogger {

    /**
     * Logs current request into a file defined via config constant.
     */
    public static function logRequest() {
        try {
            if (defined('LOG_PAGE_ACCESS') && LOG_PAGE_ACCESS) {
                // go max 5 levels up - we don't have folders that go deeper than that
                $autoprefix = '';
                for ($i = 0; $i < 5; $i++) {
                    $autoprefix = str_repeat('../', $i);
                    if (file_exists($autoprefix.'autoloader.php')) {
                        // we have our path, let's leave
                        break;
                    }
                }

                // determine log file name
                $fname = $autoprefix.'var/log/'.(defined('PAGE_ACCESS_LOG_FILENAME') ? PAGE_ACCESS_LOG_FILENAME : 'access.log');

                // prepare a prefix for the log record
                $prefix = [];

                // add date
                if (!defined('PAGE_ACCESS_LOG_DATE') || (defined('PAGE_ACCESS_LOG_DATE') && PAGE_ACCESS_LOG_DATE)) {
                    $prefix[] = date('j.m.Y H:i:s');
                }

                // add IP
                if (!defined('PAGE_ACCESS_LOG_IP') || (defined('PAGE_ACCESS_LOG_IP') && PAGE_ACCESS_LOG_IP)) {
                    $prefix[] = $_SERVER['REMOTE_ADDR'];
                }

                // add the actual file name
                $prefix[] = $_SERVER['PHP_SELF'];

                // make prefix a string
                $prefix = implode(" ", $prefix);

                // add cookie info
                if (count($_COOKIE)) {
                    $out = [];
                    foreach ($_COOKIE as $key => $value) {
                        $out[] = $key.'='.$value;
                    }

                    // write the log line
                    $cookie = implode("&", $out);
                } else {
                    $cookie = '';
                }

                // add GET info
                if (count($_GET)) {
                    $out = [];
                    foreach ($_GET as $key => $value) {
                        $out[] = $key.'='.$value;
                    }

                    $get_info = '?'.implode("&", $out);
                } else {
                    $get_info = '';
                }

                // write the log line
                file_put_contents($fname, $prefix . $get_info . "\t" . $cookie . "\n", FILE_APPEND);

                // add POST info
                if (count($_POST)) {
                    $out = [];
                    foreach ($_POST as $key => $value) {
                        $out[] = $key.'='.$value;
                    }

                    // write the log line
                    file_put_contents($fname, "[POSTDATA] " . implode("&", $out) . "\n", FILE_APPEND);
                }
            }

            return true;
        } catch (\Exception $e) {
            // we shouldn't raise exceptions if we can't log for some reason
            // but we definitelly should return false
            return false;
        }
    }
}