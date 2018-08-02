<?php 
class Artifacts
{

    const 
    
    /**
     * @var int Default Natars' uid
     */
    
    NATARS_UID = 3,
    
    /**
     * @var int Default Natars' tribe
     */
    
    NATARS_TRIBE = 5,
    
    /**
     * @var string Default Natars' email
     */
    
    NATARS_EMAIL = TRIBE5."@noreply.com",
    
    /**
     * @var string Default Natars' description
     */
    
    NATARS_DESC = "**************************
				[#natars]
			**************************",
    
    /**
     * @var array Possible Natars' capital locations
     */
    
    NATARS_CAPITAL_COORDINATES = [[WORLD_MAX, WORLD_MAX],
                                       [WORLD_MAX, 0],
                                       [WORLD_MAX, -WORLD_MAX],
                                       [0, -WORLD_MAX],
                                       [-WORLD_MAX, -WORLD_MAX],
                                       [-WORLD_MAX, 0],
                                       [-WORLD_MAX, WORLD_MAX],
                                       [0, WORLD_MAX],
                                       [WORLD_MAX / 10, WORLD_MAX / 20],
                                       [WORLD_MAX / 10, -WORLD_MAX / 10],
                                       [-WORLD_MAX / 20, -WORLD_MAX / 10],
                                       [-WORLD_MAX / 10, 0],
                                       [-WORLD_MAX / 20, WORLD_MAX / 10]],
    
    /**
     * @var array Normal Natars' artifacts
     */
    
    NATARS_ARTIFACTS = [ARCHITECTS_DESC => [["type" => 1, "size" => 1, "name" => ARCHITECTS_SMALL, "vname" => ARCHITECTS_SMALLVILLAGE, "effect" => "(4x)", "quantity" => 6, "img" => 2],
                                                  ["type" => 1, "size" => 2, "name" => ARCHITECTS_LARGE, "vname" => ARCHITECTS_LARGEVILLAGE, "effect" => "(3x)", "quantity" => 4, "img" => 2],
                                                  ["type" => 1, "size" => 3, "name" => ARCHITECTS_UNIQUE,"vname" => ARCHITECTS_UNIQUEVILLAGE, "effect" => "(5x)", "quantity" => 1, "img" => 2]],
        
                                   HASTE_DESC => [["type" => 2, "size" => 1, "name" => HASTE_SMALL, "vname" => HASTE_SMALLVILLAGE, "effect" => "(2x)", "quantity" => 6, "img" => 4],
                                                  ["type" => 2, "size" => 2, "name" => HASTE_LARGE, "vname" => HASTE_LARGEVILLAGE, "effect" => "(1.5x)", "quantity" => 4, "img" => 4],
                                                  ["type" => 2, "size" => 3, "name" => HASTE_UNIQUE, "vname" => HASTE_UNIQUEVILLAGE, "effect" => "(3x)", "quantity" => 1, "img" => 4]],
        
                                EYESIGHT_DESC => [["type" => 3, "size" => 1, "name" => EYESIGHT_SMALL, "vname" => EYESIGHT_SMALLVILLAGE, "effect" => "(5x)", "quantity" => 6, "img" => 5],
                                                  ["type" => 3, "size" => 2, "name" => EYESIGHT_LARGE, "vname" => EYESIGHT_LARGEVILLAGE, "effect" => "(3x)", "quantity" => 4, "img" => 5],
                                                  ["type" => 3, "size" => 3, "name" => EYESIGHT_UNIQUE, "vname" => EYESIGHT_UNIQUEVILLAGE, "effect" => "(10x)", "quantity" => 1, "img" => 5]],
        
                                    DIET_DESC => [["type" => 4, "size" => 1, "name" => DIET_SMALL, "vname" => DIET_SMALLVILLAGE, "effect" => "(50%)", "quantity" => 6, "img" => 6],
                                                  ["type" => 4, "size" => 2, "name" => DIET_LARGE, "vname" => DIET_LARGEVILLAGE, "effect" => "(25%)", "quantity" => 4, "img" => 6],
                                                  ["type" => 4, "size" => 3, "name" => DIET_UNIQUE, "vname" => DIET_UNIQUEVILLAGE, "effect" => "(50%)", "quantity" => 1, "img" => 6]],
        
                                ACADEMIC_DESC => [["type" => 5, "size" => 1, "name" => ACADEMIC_SMALL, "vname" => ACADEMIC_SMALLVILLAGE, "effect" => "(50%)", "quantity" => 6, "img" => 8],
                                                  ["type" => 5, "size" => 2, "name" => ACADEMIC_LARGE, "vname" => ACADEMIC_LARGEVILLAGE, "effect" => "(25%)", "quantity" => 4, "img" => 8],
                                                  ["type" => 5, "size" => 3, "name" => ACADEMIC_UNIQUE, "vname" => ACADEMIC_UNIQUEVILLAGE, "effect" => "(50%)", "quantity" => 1, "img" => 8]],
        
                                 STORAGE_DESC => [["type" => 6, "size" => 1, "name" => STORAGE_SMALL, "vname" => STORAGE_SMALLVILLAGE, "effect" => "(50%)", "quantity" => 6, "img" => 9],
                                                  ["type" => 6, "size" => 2, "name" => STORAGE_LARGE, "vname" => STORAGE_LARGEVILLAGE, "effect" => "(25%)", "quantity" => 4, "img" => 9]],
        
                               CONFUSION_DESC => [["type" => 7, "size" => 1, "name" => CONFUSION_SMALL, "vname" => CONFUSION_SMALLVILLAGE, "effect" => "(200)", "quantity" => 6, "img" => 10],
                                                  ["type" => 7, "size" => 2, "name" => CONFUSION_LARGE, "vname" => CONFUSION_LARGEVILLAGE, "effect" => "(100)", "quantity" => 4, "img" => 10],
                                                  ["type" => 7, "size" => 3, "name" => CONFUSION_UNIQUE, "vname" => CONFUSION_UNIQUEVILLAGE, "effect" => "(500)", "quantity" => 1, "img" => 10]],
        
                                    FOOL_DESC => [["type" => 8, "size" => 1, "name" => FOOL_SMALL, "vname" => FOOL_SMALLVILLAGE, "effect" => "", "quantity" => 10, "img" => "fool"],
                                                  2 => ["type" => 8, "size" => 3, "name" => FOOL_UNIQUE, "vname" => FOOL_UNIQUEVILLAGE, "effect" => "", "quantity" => 1, "img" => "fool"]]],
    
    /**
     * @var array WW building plans Natars' artifacts
     */
    
    NATARS_WW_BUILDING_PLANS =  [PLAN_DESC => [["type" => 11, "size" => 1, "name" => PLAN, "vname" => PLANVILLAGE, "effect" => "", "quantity" => 13, "img" => 1]]],
                                    
    /**
     * @var array Natars' normal artifacts buildings
     */
    
    NATARS_ARTIFACTS_BUILDINGS = [
                                        //Treasury of the 20th level, Residence of the 10th level, Rally Point of the 1th level
                                        "f22t" => 27, "f22" => 20, "f28t" => 25, "f28" => 10, "f39t" => 16, "f39" => 1,
                                        //18 Cranny of the 10th level
                                        "f19t" => 23, "f19" => 10, "f20t" => 23, "f20" => 10, "f21t" => 23, "f21" => 10,
                                        "f23t" => 23, "f23" => 10, "f24t" => 23, "f24" => 10, "f25t" => 23, "f25" => 10,
                                        "f26t" => 23, "f26" => 10, "f27t" => 23, "f27" => 10, "f29t" => 23, "f29" => 10,
                                        "f30t" => 23, "f30" => 10, "f31t" => 23, "f31" => 10, "f32t" => 23, "f32" => 10,
                                        "f33t" => 23, "f33" => 10, "f34t" => 23, "f34" => 10, "f35t" => 23, "f35" => 10,
                                        "f36t" => 23, "f36" => 10, "f37t" => 23, "f37" => 10, "f38t" => 23, "f38" => 10],
    
                                        
    /**
     * @var array Natars' WW villages buildings
     */
    
    NATARS_WW_VILLAGES_BUILDINGS = [
        //WW of the 0th level, Main Building of the 10th level, Marketplace of the 1th level
        "f99t" => 40, "f99" => 0, "f22t" => 15, "f22" => 10, "f34t" => 17, "f34" => 1,
        //Warehouse of the 20th & 10th level, Granary of the 20th & 10th level
        "f20t" => 10, "f20" => 20, "f19t" => 10, "f19" => 10, "f23t" => 11, "f23" => 20, "f27t" => 11, "f27" => 10,
        //All Woodcutter of the 5th level
        "f1" => 5, "f3" => 5, "f14" => 5, "f17" => 5,
        //All Clay Pit of the 5th level
        "f5" => 5, "f6" => 5, "f16" => 5, "f18" => 5,
        //All Iron Mine of the 5th level
        "f4" => 5, "f7" => 5, "f10" => 5, "f11" => 5,
        //All Cropland of the 6th level
        "f2" => 6, "f8" => 6, "f9" => 6, "f12" => 6, "f13" => 6, "f15" => 6],
    
    /**
     * @var int The base amount of Natars' spying units, used when Natars account is created
     */
     
    NATARS_BASE_SPY = 1500,

    /**
     * @var int the base amount of Natars' WW villages 
     */
    
    NATARS_BASE_WW_VILLAGES = 13;
    
    public 
    
    /**
     * @var funct Natars' troops for normal artifact
     */
    
    $natarsArtifactsUnits,
    
    /**
     * @var funct WW villages Natars' troops
     */
    
    $natarsWWVillagesUnits;
    
    public function __construct(){
        
        $this->natarsArtifactsUnits = function($multiplier){
            return [41 => rand(1000 * $multiplier, 2000 * $multiplier) * NATARS_UNITS,
                    42 => rand(1500 * $multiplier, 2000 * $multiplier) * NATARS_UNITS,
                    43 => rand(2300 * $multiplier, 2800 * $multiplier) * NATARS_UNITS,
                    44 => rand(25 * $multiplier, 75 * $multiplier) * NATARS_UNITS,
                    45 => rand(1200 * $multiplier, 1900 * $multiplier) * NATARS_UNITS,
                    46 => rand(1500 * $multiplier, 2000 * $multiplier) * NATARS_UNITS,
                    47 => rand(500 * $multiplier, 900 * $multiplier) * NATARS_UNITS,
                    48 => rand(100 * $multiplier, 300 * $multiplier) * NATARS_UNITS,
                    49 => rand(1 * $multiplier, 5 * $multiplier) * NATARS_UNITS,
                    50 => rand(1 * $multiplier, 5 * $multiplier) * NATARS_UNITS];
        };
        
        $this->natarsWWVillagesUnits =  function(){
            return [41 => rand(500, 12000) * NATARS_UNITS,
                    42 => rand(1000 , 14000) * NATARS_UNITS,
                    43 => rand(2000, 16000) * NATARS_UNITS,
                    44 => rand(100, 500) * NATARS_UNITS,
                    45 => rand(480, 17000) * NATARS_UNITS,
                    46 => rand(600, 18000) * NATARS_UNITS,
                    47 => rand(2000, 16000) * NATARS_UNITS,
                    48 => rand(400, 2000) * NATARS_UNITS,
                    49 => rand(40, 200) * NATARS_UNITS,
                    50 => rand(50, 250) * NATARS_UNITS];
        };
                                        
    }
    
    /**
     * Called when Natars account needs to be created, creates his account and capital village
     *
     */
    
    public function createNatars(){
        global $database;
        
        //Register the Natars account, the Natars' password is the same as the MH's one
        $password = $database->getUserField(5, 'password', 0);
        $database->register(TRIBE5, $password, self::NATARS_EMAIL, self::NATARS_TRIBE, null, self::NATARS_UID, self::NATARS_DESC);
        
        //Convert from coordinates to village IDs
        $possibleWids = $database->getVilWrefs(self::NATARS_CAPITAL_COORDINATES);
        
        //Check if the villages aren't already taken
        $wid = $database->getFreeVillage($possibleWids);

        //Generate the Natars' capital
        $wid = $database->generateVillages([['wid' => $wid, 'mode' => 2, 'type' => 3, 'kid' => 0, 'capital' => 1, 'pop' => 834, 'name' => null, 'natar' => 0]], self::NATARS_UID, TRIBE5);

        //Scouts all players
        $this->scoutAllPlayers($wid);
        
        //Add artifacts
        $this->addArtifactVillages(self::NATARS_ARTIFACTS);
    }
    
    /**
     * Called when Natars account has been created
     *
     * @param int $wid The village ID of the Natars' capital
     */
    
    public function scoutAllPlayers($wid){
        global $database;
        
        $array = $database->getProfileVillages(0, 1);
        $refs = [];
        $vils = [];
        
        foreach($array as $vill){
            $refs[] = $database->addAttack($wid, 0, 0, 0, self::NATARS_BASE_SPY * NATARS_UNITS, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 1, 0, 0, 0, 20, 0, 0, 0, 0);
            $vils[] = $vill['wref'];
        }
        
        $type = [];
        $from = [];
        $to = [];
        $ref = [];
        $time = [];
        $timeValue = time();
        $endtime = [];
        $endtimeValue = $timeValue + round(10000 / SPEED);
        $counter = 0;
        
        foreach ($refs as $index => $refID) {
            $type[] = 3;
            $from[] = $wid;
            $to[] = $vils[$index];
            $ref[] = $refID;
            $time[] = $timeValue;
            $endtime[] = $endtimeValue;
            
            // limit the insert, so it can push through any reasonable network limits imposed
            if (++$counter > 25) {
                $database->addMovement($type, $from, $to, $ref, $time, $endtime);
                
                $type = [];
                $from = [];
                $to = [];
                $ref = [];
                $time = [];
                $endtime = [];
                $counter = 0;
            }
        }
        
        if ($counter > 0) $database->addMovement($type, $from, $to, $ref, $time, $endtime);
    }
    
    /**
     * Creates villages and puts the desired artifacts in it
     *
     * @param array $artifactArrays The array containing the artifacts to insert
     * @param int $uid The owner's user ID (Natars)
     * @param bool $addTroops Add troops to the village if true, and vice versa if false
     */
    
    public function addArtifactVillages($artifactArrays, $uid = self::NATARS_UID, $addTroops = true) {
        global $database;

        //Variables initialization
        $artifactNumber = 0;
        $artifactVillages = $artifactTroops = $artifactBuildings = $artifactsToAdd = $wids = [];
        
        //Create the artifact villages array
        foreach($artifactArrays as $desc => $artifactType){
            foreach($artifactType as $artifact){
                for($i = 0; $i < $artifact['quantity']; $i++){
                    //Generate the villages array
                    $artifactVillages[] = ['wid' => 0, 'mode' => $artifact['size'] + 1, 'type' => 3, 'kid' => rand(1, 4), 'capital' => 0, 'pop' => 163, 'name' => $artifact['vname'], 'natar' => 0];
                    
                    //Set the unit arrays (1, 2 or 4)
                    $multiplier = $artifact['size'] == 3 ? 4 : $artifact['size'];
                    $unitArrays = ($this->natarsArtifactsUnits)($multiplier);
                    
                    //Generate the unit arrays
                    if($addTroops) $artifactTroops[1][] = array_values($unitArrays);
                    $artifactBuildings[1][] = array_values(self::NATARS_ARTIFACTS_BUILDINGS);
                    
                    //Generate the artifacts array
                    $artifactsToAdd[] = ['owner' => $uid, 'type' => $artifact['type'], 'size' => $artifact['size'], 
                                         'name' => $artifact['name'], 'desc' => $desc, 'effect' => $artifact['effect'],
                                         'img' => "type".$artifact['img'].".gif"];
                }             
            }
        }    
        
        //Set the unit types by using the last $unitArrays
        if($addTroops) $artifactTroops[0] = array_keys($unitArrays);
        $artifactBuildings[0] = array_keys(self::NATARS_ARTIFACTS_BUILDINGS);
        
        //Generate the wids
        $wids = array_merge($wids, (array)$database->generateVillages($artifactVillages, $uid, TRIBE5, $addTroops ? $artifactTroops : null, $artifactBuildings));
        
        //Create the artifacts for the generated wids
        $database->addArtefacts($wids, $artifactsToAdd);
    }
    
    /**
     * Called when WW villages need to be created
     * 
     * @param int $numberOfVillages The number of villages that have to be added
     * @param int $uid The player ID
     * @param bool $addTroops Add troops to the village if true, and vice versa if false
     */
    
    public function createWWVillages($numberOfVillages = self::NATARS_BASE_WW_VILLAGES, $uid = self::NATARS_UID, $addTroops = true){
        global $database;
        
        $villageArrays = $troopArrays = $buildingArrays = $wids = [];
        for($i = 1; $i <= $numberOfVillages; $i++){
            $villageArrays[] = ['wid' => 0, 'mode' => 5, 'type' => 3, 'kid' => ($i == $numberOfVillages ? rand(1, 4) : ($i % 4) + 1), 'capital' => 0, 'pop' => 233, 'name' => WWVILLAGE, 'natar' => 1];
            if($addTroops) $troopArrays[1][] = array_values(($this->natarsWWVillagesUnits)());
            $buildingArrays[1][] = array_values(self::NATARS_WW_VILLAGES_BUILDINGS);
        }

        if($addTroops) $troopArrays[0] = array_keys(($this->natarsWWVillagesUnits)());
        $buildingArrays[0] = array_keys(self::NATARS_WW_VILLAGES_BUILDINGS);
        
        $wids = $database->generateVillages($villageArrays, $uid, null, $addTroops ? $troopArrays : null, $buildingArrays);
    }
    
    /**
     * Called when WW building plans need to be created
     *
     */
    
    public function createWWBuildingPlans(){
        
        //Add the artifacts and villages
        $this->addArtifactVillages(self::NATARS_WW_BUILDING_PLANS);
    }
    
    /**
     * Automatically activate all artifacts that need to be activated
     *
     */
    
    public function activateArtifacts(){
        global $database;
        
        //Get all inactive artifacts that have to be activated --> (24 hours / Speed of the server)
        $time = time();
        $artifacts = $database->getInactiveArtifacts(round($time - (86400 / (SPEED == 2 ? 1.5 : (SPEED == 3 ? 2 : SPEED)))));
        
        if(!empty($artifacts)){
            
            //Cache inactive artifacts by owner
            $inactiveArtifactsCache = [];
            foreach($artifacts as $artifact) $inactiveArtifactsCache[$artifact['owner']][] = $artifact;
            
            foreach($inactiveArtifactsCache as $owner => $inactiveArtifacts){
                
                //Initialize the array
                $activeArtifacts = [];
                
                //Get cached active artifacts
                $ownArtifacts = $database->getOwnArtifactsSum($owner, true);
                
                //Activate activable artifacts
                foreach($inactiveArtifacts as $artifact){
                    if($ownArtifacts['totals'] < 3){
                        if($artifact['size'] == 1){ //Village effect
                            $database->activateArtifact($artifact['id']);
                            $ownArtifacts['totals']++;
                            $ownArtifacts['small']++;
                        }elseif($artifact['size'] == 2 && !$ownArtifacts['unique'] && !$ownArtifacts['great']){ //Account effect
                            $database->activateArtifact($artifact['id']);
                            $ownArtifacts['totals']++;
                            $ownArtifacts['great']++;
                        }elseif($artifact['size'] == 3 && !$ownArtifacts['unique'] && !$ownArtifacts['great']){ //Unique effect
                            $database->activateArtifact($artifact['id']);
                            $ownArtifacts['totals']++;
                            $ownArtifacts['unique']++;
                        }
                    }elseif($ownArtifacts['small'] == 3 && $artifact['size'] > 1){
                        //If we've 3 village effect artifacts activated and at least one account/unique effect not activated
                        //then we need to deactivate the most recent village effect artifact and activate the oldest account
                        //or unique effect artifact
                        
                        //Deactivate the most recent village effect artifact
                        $database->activateArtifact($database->getNewestArtifactBySize($owner, 1)['id'], 0);
                        
                        //Activate the great/unique artifact
                        $database->activateArtifact($artifact['id']);
                        
                        $ownArtifacts['small']--;
                        $ownArtifacts['totals']++;
                        if($artifact['size'] == 2) $ownArtifacts['great']++;
                        else $ownArtifacts['unique']++;
                    }
                }
            }
        }
    }
    /**
     * Return the selected artifact, to the Natars account, by creating a new village and
     * by moving the artifact into it
     * 
     * @param array $artifact The artifact array
     */
     
    public function returnArtifactToNatars($artifactArray){
        global $database;
        
        //Set the village arrays
        $artifactArrays = array_merge(self::NATARS_ARTIFACTS, self::NATARS_WW_BUILDING_PLANS);
        $villageArrays = [['wid' => 0, 'mode' => $artifactArray['size'] + 1, 'type' => 3,
            'kid' => rand(1, 4), 'capital' => 0, 'pop' => 163,
            'name' => $artifactArrays[$artifactArray['desc']][$artifactArray['size'] - 1]['vname'],
            'natar' => 0]];
        
        //Set the unit arrays
        $multiplier = $artifactArray['size'] == 3 ? 4 : $artifactArray['size'];
        $unitsArray = ($this->natarsArtifactsUnits)($multiplier);
        
        //Set the unit types
        $artifactTroops[1][] = array_values($unitsArray);
        $artifactTroops[0] = array_keys($unitsArray);
        
        //Set the buildings array
        $artifactBuildings[1][] = array_values(self::NATARS_ARTIFACTS_BUILDINGS);
        $artifactBuildings[0] = array_keys(self::NATARS_ARTIFACTS_BUILDINGS);

        //Generate the village
        $wid = $database->generateVillages($villageArrays, self::NATARS_UID, TRIBE5, $artifactTroops, $artifactBuildings);
        
        //Update the artifact with the new village id and owner
        $database->updateArtifactDetails($artifactArray['id'], ['vref' => $wid, 'owner' => self::NATARS_UID, 'active' => 0, 'del' => 0]);
    }
    
    /**
     * Gets the artifact informations in plain text
     * 
     * @param int $artifact The artifact
     * @return array Returns the information of the artifacts
     */
    
    public static function getArtifactInfo($artifact){
        
        $activationTime = 86400 / (SPEED == 2 ? 1.5 : (SPEED == 3 ? 2 : SPEED));
        $time = time();
        $nextEffect = "-";
        
        if($artifact['size'] == 1 && $artifact['type'] != 11){
            $requiredLevel = 10;
            $effectInfluence = VILLAGE;
        }else{
            $requiredLevel = $artifact['type'] != 11 ? 20 : 10;
            $effectInfluence = ACCOUNT;
        }
  
        if($artifact['owner'] == 3) $active = "-";
        elseif(!$artifact['active'] && $artifact['conquered'] < $time - $activationTime) $active = "<b>Can't be activated</b>";
        elseif (!$artifact['active']) $active = date("d.m.Y H:i:s", $artifact['conquered'] + $activationTime);
        else
        {
            $active = "<b>".ACTIVE."</b>";
            $nextEffect = date("d.m.Y H:i:s", $artifact['lastupdate'] + (86400 / (SPEED == 2 ? 1.5 : (SPEED == 3 ? 2 : SPEED))));
        }
        
        //// Added by brainiac - thank you
        if ($artifact['type'] == 8)
        {
            $kind = $artifact['kind'];
            $effect = $artifact['effect2'];
        }else{
            $kind = $artifact['type'];
            $effect = $artifact['effect'];
        }
        
        $artifactBadEffect = $artifact['type'] == 8 && $artifact['bad_effect'] == 1;
        switch($kind){
            case 1:
                $betterorbadder = $artifactBadEffect ? BUILDING_WEAKER : BUILDING_STRONGER;
                break;
            case 2:
                $betterorbadder = $artifactBadEffect ? TROOPS_SLOWEST : TROOPS_FASTER;
                break;
            case 3:
                $betterorbadder = $artifactBadEffect ? SPIES_DECRESE : SPIES_INCREASE;
                break;
            case 4:
                $betterorbadder = $artifactBadEffect ? CONSUME_HIGH : CONSUME_LESS;
                break;
            case 5:
                $betterorbadder = $artifactBadEffect ? TROOPS_MAKE_SLOWEST : TROOPS_MAKE_FASTER;
                break;
            case 6:
                $betterorbadder = $artifactBadEffect ? YOU_CONSTRUCT : YOU_CONSTRUCT;
                break;
            case 7:
                $betterorbadder = $artifactBadEffect ? CRANNY_DECRESE : CRANNY_INCREASED;
                break;
            case 8:
                $betterorbadder = $artifactBadEffect ? SPIES_INCREASE : SPIES_DECRESE;
                break;
        }
        $bonus = isset($betterorbadder) ? $betterorbadder." (<b>".str_replace(["(", ")"], "" , $effect)."</b>)" : (($kind == 11 && $artifact['active']) ? "<b>".WW_BUILDING_PLAN."</b>" : "<b>Not yet active</b>");
        
        return ["requiredLevel" => $requiredLevel, "active" => $active,
                "bonus" => $bonus, "effectInfluence" => $effectInfluence,
                "nextEffect" => $nextEffect];
    }
}

?>