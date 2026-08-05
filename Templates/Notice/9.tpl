<?php

#################################################################################
##                -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-               ##
## --------------------------------------------------------------------------- ##
##  Filename       : 9.tpl                                                     ##
##  Type           : Report Loader - Archived Report Dispatcher                ##
## --------------------------------------------------------------------------- ##
##  Developed by   : Shadow                                                    ##
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

// ======================== SAFE INPUT ========================
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// If no valid ID, stop safely (prevents warnings / injection edge cases)
if ($id <= 0) {
    return;
}

// ======================== GET TEMPLATE ========================
// NOTE: archive field defines which tpl file is loaded
$template = $database->getNotice2($id, 'archive');

// Safety: ensure valid string before include
if (!empty($template)) {
    include($template . ".tpl");
}