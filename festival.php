<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : festival.php                                              ##
##  Type           : In Game Mead-Festival Page for Brewery                    ##
## --------------------------------------------------------------------------- ##
##  Refactored by  : Shadow                                                    ##
##  Redesign by    : Shadow                                                    ##
## --------------------------------------------------------------------------- ##
##  Contact        : cata7007@gmail.com                                        ##
##  Project        : TravianZ                                                  ##
##  Test Server    : https://travianz.org                                      ##
##  GitHub         : https://github.com/Shadowss/TravianZ                      ##
## --------------------------------------------------------------------------- ##
##  License        : TravianZ Project                                          ##
##  Copyright      : TravianZ (c) 2010-2026. All rights reserved.              ##
## --------------------------------------------------------------------------- ##
#################################################################################

use App\Utils\AccessLogger;

include_once("GameEngine/Village.php");
AccessLogger::logRequest();

if(isset($_GET['newdid'])){
	$_SESSION['wid'] = $_GET['newdid'];
	header("Location: ".$_SERVER['PHP_SELF']);
	exit;
}

// Brewery (35) can only be built in the capital, and the Mead-Festival can
// only ever be started there too. Enforced both here (defense in depth) and
// already at construction time (GameEngine/Building.php, case 35:
// $village->capital != 0), so the Brewery itself can never exist outside it.
if($village->capital == 1 && $village->resarray['f'.$_GET['id'].'t'] == 35 && $session->tribe == 2 && $village->currentfestival == 0){
	if($festival['wood'] <= $village->awood && $festival['clay'] <= $village->aclay && $festival['iron'] <= $village->airon && $festival['crop'] <= $village->acrop){
		$endtime = round($festival['time'] / SPEED) + time();
		$wood = $festival['wood'];
		$clay = $festival['clay'];
		$iron = $festival['iron'];
		$crop = $festival['crop'];
		$database->modifyResource($village->resarray['vref'],$wood,$clay,$iron,$crop,$mode);
		$database->addFestival($village->resarray['vref'],$endtime);
	}
}
header("Location: build.php?id=".$_GET['id']);
exit;
?>