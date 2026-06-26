<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : autoloader.php                      	                   ##
##  Type           : In Game Autoloader GameEngine                             ##
## --------------------------------------------------------------------------- ##
##  Developed by   : Dzoki 						                               ##
##  Refactored by  : Shadow                                                    ##
##  Redesign by    : Shadow                                                    ##
## --------------------------------------------------------------------------- ##
##  Contact        : cata7007@gmail.com                                        ##
##  Project        : TravianZ                                                  ##
##  URLs:          : https://travianz.org                                      ##
##  GitHub         : https://github.com/Shadowss/TravianZ                      ##
## --------------------------------------------------------------------------- ##
##  License        : TravianZ Project                                          ##
##  Copyright      : TravianZ (c) 2010-2026. All rights reserved.              ##
## --------------------------------------------------------------------------- ##
#################################################################################

	function autoloadClass($class) {

    $clazz = str_replace(['App\\', '\\'], ['', '/'], $class);

    $class_found = false;

    for ($i = 0; $i < 5; $i++) {
        $autoprefix = str_repeat('../', $i);

        // 1. default path (actual)
        $path1 = $autoprefix . 'src/' . $clazz . '.php';

        // 2. fallback GameEngine (YOUR CASE)
        $path2 = $autoprefix . 'GameEngine/' . $clazz . '.php';

        if (file_exists($path1)) {
            include_once $path1;
            $class_found = true;
            break;
        }

        if (file_exists($path2)) {
            include_once $path2;
            $class_found = true;
            break;
        }
    }

    if (!$class_found) {
        throw new Exception('Unable to find class ' . $clazz . '.');
    }
}

    spl_autoload_register('autoloadClass');