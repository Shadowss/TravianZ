<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       ajax.php                                                    ##
##  Developed by:  Dzoki                                                       ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################

switch($_GET['f']) {
	case 'k7':
		$x = $_GET['x'];
		$y = $_GET['y'];
		$xx = $_GET['xx'];
		$yy = $_GET['yy'];
		$howmany = $x - $xx;
		if($howmany == 12 || $howmany == -12) {
			include("Templates/Ajax/mapscroll2.tpl");
		}
		else {
		include("Templates/Ajax/mapscroll.tpl");
		}
		break;
	case 'kp':
		$z = $_GET['z'];
		//include("Templates/Ajax/plusmap.tpl");
		break;
	case 'qst':
	
	if (isset($_GET['qact'])){
	$qact=$_GET['qact'];
	}else {
	$qact=null;
	}
	if (isset($_GET['qact2'])){
	$qact2=$_GET['qact2'];
	}else {
	$qact2=null;
	}
		include("Templates/Ajax/quest_core.tpl");		
		break;
}
?>