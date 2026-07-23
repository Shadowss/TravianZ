<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : Automation.php                      	                   ##
##  Type           : Automation Function for entire TravianZ Game              ##
## --------------------------------------------------------------------------- ##
##  Developed by   : Mr.php , Advocaite , brainiacX , yi12345 , Shadow , ronix ##
##  Refactored by  : Shadow & Ferywir									       ##
##  Thanks to      : InCube, Akakori, Elmar & Kirilloid                        ##
##  Split&Refactor : Shadow													   ##
##  Phase S2       : Methods split into 11 traits (GameEngine/Automation/)     ##
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

// make sure we only run the automation script once and wait until it's done,
// so concurrent AJAX calls from many different users won't overload the server
if ( !defined('AUTOMATION_MANUAL_RUN') ) {
    if(defined('AUTOMATION_LOCK_FILE_NAME')){
        if ( file_exists( AUTOMATION_LOCK_FILE_NAME ) ) {
            // check that the file is not too old, in which case our PHP script hung
            // and we need to remove the lock and run automation again
            $fileTime = filemtime( AUTOMATION_LOCK_FILE_NAME );
    
            // allow for 60 seconds of old automation script processing time, which is still way too plenty
            if ( ! $fileTime || time() - $fileTime > 60 ) {
                @unlink( AUTOMATION_LOCK_FILE_NAME );
            } else {
                // automation file exists and is valid, don't run another automation
                exit;
            }
        } else {
            // create automation lock file
            file_put_contents( AUTOMATION_LOCK_FILE_NAME, '' );
        }
    }
}

include_once("Database.php");
include_once("Data/buidata.php");
include_once("Data/unitdata.php");
include_once("Data/hero_full.php");
include_once("Data/cp.php");
include_once("Units.php");
include_once("Battle.php");
include_once("Technology.php");
include_once("Ranking.php");
include_once("Generator.php");
include_once("Multisort.php");
include_once("Building.php");
include_once("Artifacts.php");

// === Faza S2: clasa Automation este impartita in trait-uri pe domenii (GameEngine/Automation/) ===
// Trait-urile sunt in namespace global, deci sunt incluse explicit (autoloaderul mapeaza doar App\).
include_once __DIR__ . '/Automation/AutomationVillageUpkeep.php';
include_once __DIR__ . '/Automation/AutomationAccountMaintenance.php';
include_once __DIR__ . '/Automation/AutomationBuildQueue.php';
include_once __DIR__ . '/Automation/AutomationMarket.php';
include_once __DIR__ . '/Automation/AutomationBattleResolution.php';
include_once __DIR__ . '/Automation/AutomationTroopMovements.php';
include_once __DIR__ . '/Automation/AutomationTraining.php';
include_once __DIR__ . '/Automation/AutomationHero.php';
include_once __DIR__ . '/Automation/AutomationStarvation.php';
include_once __DIR__ . '/Automation/AutomationNatarsWW.php';
include_once __DIR__ . '/Automation/AutomationMedals.php';
include_once __DIR__ . '/Automation/AutomationCleanup.php';

class Automation {
    // === Faza S2: metodele clasei, grupate pe domenii ===
    use AutomationVillageUpkeep;
    use AutomationAccountMaintenance;
    use AutomationBuildQueue;
    use AutomationMarket;
    use AutomationBattleResolution;
    use AutomationTroopMovements;
    use AutomationTraining;
    use AutomationHero;
    use AutomationStarvation;
    use AutomationNatarsWW;
    use AutomationMedals;



    use AutomationCleanup;
    /**
     * @var object The artifacts class, used to create Natars, artifacts and obtaining info about them
     */
    
    private $artifacts;
    
    /**
     * Cache pentru utilizatori pentru a reduce query-urile duplicate
     * @var array
     */
    private $userCache = [];
    
    public function __construct() {
    	
        //Classes initialization
        $this->artifacts = new Artifacts();
        
    	$autoprefix = "";
    	for ($i = 0; $i < 5; $i++) {
    		$autoprefix = str_repeat('../', $i);
    		if (file_exists($autoprefix.'autoloader.php')) {
    			// we have our path, let's leave
    			break;
    		}
    	}
    	
        $this->procNewClimbers();
        $this->ClearUser();
        $this->ClearInactive();
        $this->pruneResource();
        $this->pruneOResource();
        $this->checkWWAttacks();
        $this->delTradeRoute();
        $this->TradeRoute();
        
        $methodsArrays = ["culturePoints", "updateHero", "clearDeleting", "buildComplete",
        				  "demolitionComplete", "marketComplete", "researchComplete",
        				  "trainingComplete", "healingComplete", "starvation", "celebrationComplete", "festivalComplete",
        				  "sendUnitsComplete", "loyaltyRegeneration", "sendreinfunitsComplete",
        				  "returnunitsComplete", "sendSettlersComplete", "spawnNatars",
        				  "spawnWWVillages", "spawnWWBuildingPlans", "activateArtifacts",
        				  "heroAdventureComplete",
        				  // P3: curatenie periodica (are interval propriu, nu ruleaza la fiecare tick)
        				  "cleanupOldData"];
        
        foreach($methodsArrays as $method){
        	$file = fopen($autoprefix."GameEngine/Prevention/".$method.".txt", "w");
        	if(flock($file, LOCK_EX)) {
        		call_user_func(array($this, $method));
        		flock($file, LOCK_UN);     		
        	}
        	fclose($file);
        }
        
        $this->MasterBuilder();
        $this->updateGeneralAttack();
        $this->checkInvitedPlayes();
        $this->updateStore();
        $this->CheckBan();
        $this->regenerateOasisTroops();
        $this->medals();
        $this->artefactOfTheFool();
    }

    /**
     * Retrieve user data using local cache.
    **/
	
    private function getCachedUser($uid, $mode = 1) {
        global $database;
        $uid = (int)$uid;
        if (!isset($this->userCache[$uid])) {
            $this->userCache[$uid] = $database->getUserArray($uid, $mode);
        }
        return $this->userCache[$uid];
    }
}
$automation = new Automation;

// remove automation lock file
@unlink( AUTOMATION_LOCK_FILE_NAME );
?>
