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

ini_set('max_execution_time', 30000);

include ("../../Database.php"); 
include ("../../Admin/database.php"); 
include ("../../config.php");

$database->populateOasisdata();  
$database->populateOasis();
$database->populateOasisUnits2();

header("Location: ../../../Admin/admin.php?p=server_info");
?>