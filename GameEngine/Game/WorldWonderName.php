<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       WorldWonderName.php                                         ##
##  Developed by:  Dzoki                                                       ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################

include("../Village.php");
$database->submitWWname($_POST['vref'],$_POST['wwname']);
 header("Location: ../../build.php?id=99&n");
 
 ?>