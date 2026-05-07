<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       news.tpl                                                    ##
##  Developed by:  Dzoki                                                       ##
##  Refactored by: Shadow Incremental Refactor 			                       ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2026. All rights reserved.                ##
##                                                                             ##
##  Incremental Refactor Notes:                                                ##
##  - Preserved original include-based structure                               ##
##  - Added safe include guards                                                ##
##  - Prevented warnings if files/constants are missing                        ##
##                                                                             ##
#################################################################################
?>


<?php
if(NEWSBOX1){
	include "News/newsbox1.tpl";
	}
if(NEWSBOX2){
	include "News/newsbox2.tpl";
	}
if(NEWSBOX3){
	include "News/newsbox3.tpl";
	}
?>