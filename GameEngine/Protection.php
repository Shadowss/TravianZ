<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : Protection.php                    	                       ##
##  Type           : Protection System Backend                                 ##
## --------------------------------------------------------------------------- ##
##  Developed by   : SlimShady           			                           ##
##  Refactored by  : Shadow & Ferywir									       ##
##  Thanks to      : ronix, InCube, Akakori, Elmar & Kirilloid                 ##
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

//heef npc uitzondering omdat die met speciaal $_post werken
if(isset($_POST)){
	if(!isset($_POST['ft'])){
	//$_POST = @array_map('mysqli_real_escape_string', $_POST);
	$_POST = array_map('htmlspecialchars', $_POST);
	}
}
			$rsargs=$_GET['rsargs'];
//$_GET = array_map('mysqli_real_escape_string', $_GET);
$_GET = array_map('htmlspecialchars', $_GET);
			$_GET['rsargs']=$rsargs;
//$_COOKIE = array_map('mysqli_real_escape_string', $_COOKIE);
$_COOKIE = array_map('htmlspecialchars', $_COOKIE);
?>