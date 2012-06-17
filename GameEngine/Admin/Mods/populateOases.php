<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       populateOases.php                                           ##
##  Developed by:  aggenkeech                                                  ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2012. All rights reserved.                ##
##                                                                             ##
#################################################################################

include ("../../Database.php");
include ("../../Admin/database.php");
include ("../../config.php");

$database->populateOasisUnitsLow();

header("Location: ../../../Admin/admin.php?p=server_info");
?>