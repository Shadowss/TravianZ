<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       WorldWonderName.php                                         ##
##  Developed by:  Dzoki                                                       ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2025. All rights reserved.                ##
##                                                                             ##
#################################################################################

include("../Village.php");
if(isset($_POST['wwname']) && !empty($_POST['wwname']) && $village->natar){
    $database->submitWWname($village->wid,$_POST['wwname']);
    header("Location: ../../build.php?id=99&n");
}else{
    header("Location: ../../dorf2.php");
}


?>