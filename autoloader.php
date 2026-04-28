<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ                                                    ##
##  Filename       autoloader.php                                              ##
##  Developed by:  Dzoki                                                       ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2026. All rights reserved.                ##
##  URLs:          http://travian.shadowss.ro                		           ##
##  Source code:   https://github.com/Shadowss/TravianZ		                   ##
##                                                                             ##
#################################################################################

    function autoloadClass($class) {
        // strip the App classname's namespace
        $clazz = str_replace(['App\\', '\\'], ['', '/'], $class);

        // search for class
        $class_found = false;
        // go max 5 levels up - we don't have folders that go deeper than that
        for ($i = 0; $i < 5; $i++) {
            $autoprefix = str_repeat('../', $i);
            if (file_exists($autoprefix.'src/' . $clazz . '.php')) {
                $class_found = true;
                include_once $autoprefix.'src/' . $clazz . '.php';
                break;
            }
        }

        if (!$class_found) {
            throw new Exception('Unable to find class ' . $clazz . '.');
        }
    }

    spl_autoload_register('autoloadClass');