<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : Automation.php                     	                   ##
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
##                 : https://github.com/Shadowss/TravianZ                      ##
## --------------------------------------------------------------------------- ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2026. All rights reserved.                ##
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

/**
 * Automation.php presupunea ca apelantul a inclus deja config.php. Cand nu era
 * asa (de exemplu inclus din alt context), Database.php dadea eroare fatala:
 *   Undefined constant \"SQL_SERVER\"
 *
 * Il incarcam noi daca lipseste. include_once nu-l aduce de doua ori.
 */
if (!defined('SQL_SERVER')) {
    $automationConfig = __DIR__ . '/config.php';

    if (is_file($automationConfig)) {
        include_once($automationConfig);
    } elseif (is_file(__DIR__ . '/../config.php')) {
        include_once(__DIR__ . '/../config.php');
    }
}

include_once("Database.php");
include_once("Data/buidata.php");
include_once("Data/unitdata.php");
include_once("Data/hero_full.php");
include_once("Data/cp.php");
include_once("Units.php");
include_once("Battle.php");
include_once("AllianceBonus.php");
include_once("Technology.php");
include_once("Ranking.php");
include_once("Generator.php");
include_once("Multisort.php");
include_once("Building.php");
include_once("Artifacts.php");

// === Faza S2: clasa Automation este impartita in trait-uri pe domenii (GameEngine/Automation/) ===
// Trait-urile sunt in namespace global, deci sunt incluse explicit (autoloaderul mapeaza doar App\\).
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
include_once __DIR__ . '/Automation/AutomationNatarsWWBuild.php';
include_once __DIR__ . '/Automation/AutomationMedals.php';
include_once __DIR__ . '/Automation/AutomationCleanup.php';
include_once __DIR__ . '/Automation/AutomationPlayerStatistics.php';

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
    use AutomationNatarsWWBuild;
    use AutomationMedals;



    use AutomationCleanup;
    use AutomationPlayerStatistics;
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
        $this->pruneResource();
        $this->pruneOResource();
        $this->checkWWAttacks();
        $this->delTradeRoute();
        $this->TradeRoute();
        
        $methodsArrays = ["culturePoints", "updateHero", "clearDeleting", "buildComplete",
        				  "demolitionComplete", "marketComplete", "researchComplete",
        				  "trainingComplete", "healingComplete", "starvation", "celebrationComplete", "festivalComplete",
        				  "sendUnitsCompleteSafe", "loyaltyRegeneration", "sendreinfunitsComplete",
        				  "returnunitsComplete", "sendSettlersComplete", "spawnNatars",
        				  "spawnWWVillages", "spawnWWBuildingPlans", "activateArtifacts",
        				  "heroAdventureComplete",
        				  "cleanupOldData",
        				  "recordPlayerStatistics",
        					  "buildNatarsWonder"];
        
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

        // Finalizeaza upgrade-urile de bonus de alianta ajunse la termen.
        if (class_exists('AllianceBonus') && AllianceBonus::enabled()) {
            $allianceBonus = new AllianceBonus();
            $allianceBonus->processUpgrades();
        }
        $this->CheckBan();
        $this->regenerateOasisTroops();
        $this->medals();
        $this->artefactOfTheFool();
    }

    /**
     * Process completed attacks only after removing battles whose village target
     * no longer has a valid owner/tribe. This prevents invalid tribe math in
     * AutomationBattleResolution (e.g. targettribe=0 -> unit range -9..0).
     *
     * The normal battle resolver remains untouched for valid targets.
     */
    private function sendUnitsCompleteSafe() {
        global $database, $units;

        $time = time();
        $prefix = TB_PREFIX;

        $q = "
            SELECT
                m.moveid,
                m.`from`,
                m.`to`,
                m.ref,
                m.endtime,
                a.t1, a.t2, a.t3, a.t4, a.t5, a.t6, a.t7, a.t8, a.t9, a.t10, a.t11,
                vf.owner AS attacker_owner,
                vf.wref AS attacker_wref,
                uf.tribe AS attacker_tribe
            FROM {$prefix}movement m
            INNER JOIN {$prefix}attacks a ON a.id = m.ref
            LEFT JOIN {$prefix}vdata vt ON vt.wref = m.`to`
            LEFT JOIN {$prefix}users ut ON ut.id = vt.owner
            LEFT JOIN {$prefix}vdata vf ON vf.wref = m.`from`
            LEFT JOIN {$prefix}users uf ON uf.id = vf.owner
            WHERE m.proc = 0
              AND m.sort_type = 3
              AND a.attack_type != 2
              AND m.endtime < {$time}
              AND (vt.wref IS NULL OR vt.owner <= 0 OR ut.id IS NULL OR ut.tribe < 1 OR ut.tribe > 9)
        ";

        $result = $database->query_return($q);

        if ($result && count($result)) {
            foreach ($result as $invalidAttack) {
                $moveid = (int)$invalidAttack['moveid'];
                $from   = (int)$invalidAttack['from'];
                $to     = (int)$invalidAttack['to'];
                $owner  = (int)$invalidAttack['attacker_owner'];
                $fromWref = (int)$invalidAttack['attacker_wref'];
                $tribe  = (int)$invalidAttack['attacker_tribe'];

                if ($moveid <= 0 || $from <= 0 || $to <= 0 || $owner <= 0 || $fromWref <= 0 || $tribe < 1 || $tribe > 9) {
                    // No valid attacker context: consume the broken movement so cron
                    // cannot loop forever on the same malformed battle record.
                    $database->setMovementProc($moveid);
                    continue;
                }

                // Claim this movement atomically. If another automation request got
                // it first, do not create a duplicate return movement.
                if (!$database->setMovementProc($moveid)) {
                    continue;
                }

                $returningTroops = [
                    't1' => (int)$invalidAttack['t1'],
                    't2' => (int)$invalidAttack['t2'],
                    't3' => (int)$invalidAttack['t3'],
                    't4' => (int)$invalidAttack['t4'],
                    't5' => (int)$invalidAttack['t5'],
                    't6' => (int)$invalidAttack['t6'],
                    't7' => (int)$invalidAttack['t7'],
                    't8' => (int)$invalidAttack['t8'],
                    't9' => (int)$invalidAttack['t9'],
                    't10' => (int)$invalidAttack['t10'],
                    't11' => (int)$invalidAttack['t11']
                ];

                $totalTroops = array_sum($returningTroops);
                if ($totalTroops <= 0) {
                    continue;
                }

                $troopsTime = $units->getWalkingTroopsTime(
                    $fromWref,
                    $to,
                    $owner,
                    $tribe,
                    $returningTroops,
                    1,
                    't'
                );

                $endtime = $database->getArtifactsValueInfluence(
                    $owner,
                    $fromWref,
                    2,
                    $troopsTime
                ) + $time;

                $database->addMovement(
                    4,
                    $to,
                    $fromWref,
                    (int)$invalidAttack['ref'],
                    $time,
                    $endtime
                );
            }
        }

        // Process all remaining valid completed battles through the original engine.
        $this->sendUnitsComplete();
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
