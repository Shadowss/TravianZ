<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       celebration.php                                             ##
##  Developed by:  Dzoki                                                       ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################
include("GameEngine/Village.php");
if(isset($_GET['newdid'])){
	$_SESSION['wid'] = $_GET['newdid'];
	header("Location: ".$_SERVER['PHP_SELF']);
}
if($village->resarray['f'.$_GET['id'].'t'] == 24 and $village->currentcel == 0){
	if(!empty($_GET['type']) && $_GET['type'] == 1){
		if(6400 < $village->awood || 6650 < $village->aclay || 5940 < $village->airon || 1340 < $village->acrop){
			$endtime = ($sc[$village->resarray['f'.$_GET['id']]]/ SPEED) + time();
			$wood = 6400;
			$clay = 6650;
			$iron = 5940;
			$crop = 1340;
			$database->modifyResource($village->resarray['vref'],$wood,$clay,$iron,$crop,$mode);
			$database->addCel($village->resarray['vref'],$endtime,$_GET['type']);
		}
	}
	elseif(!empty($_GET['type']) && $_GET['type'] == 2){
		if(29700 < $village->awood || 33250 < $village->aclay || 32000 < $village->airon || 6700 < $village->acrop){
			$endtime = ($gc[$village->resarray['f'.$_GET['id']]]/ SPEED) + time();
			$wood= 29700;
			$clay= 33250;
			$iron= 32000;
			$crop= 6700;
			$database->modifyResource($village->resarray['vref'],$wood,$clay,$iron,$crop,$mode);
			$database->addCel($village->resarray['vref'],$endtime,$_GET['type']);
		}
	}
}
header("Location: build.php?id=".$_GET['id']);