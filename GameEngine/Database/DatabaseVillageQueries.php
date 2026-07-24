<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ                                                    ##
##  Filename:      DatabaseVillageQueries.php                                  ##
##  Split&Refactor Shadow                                                      ##
##  Purpose:       Villages (vdata/fdata), oases, resources, fields,           ##
##                 celebrations                                                ##
##                                                                             ##
##  Phase S1: Trait extracted from GameEngine/Database.php                     ##
##            (MYSQLi_DB class).                                               ##
##  Methods were moved IDENTICALLY, with no logic changes.                     ##
##                                                                             ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2026. All rights reserved.                ##
##  URLs:          https://travianz.org                                        ##
##                 https://github.com/Shadowss/TravianZ                        ##
#################################################################################

use App\Utils\Math;

trait DatabaseVillageQueries {

	
	
    /***************************
    Function to calc oasis bonus
    References: lietuvis10
    ***************************/
	 
	public function getBestOasisCropBonus($x, $y) {
    $x = (int)$x;
    $y = (int)$y;

    // Adjust oasis type codes if your fork differs:
    //  - 50% crop only: type IN (12)
    //  - 25% crop (pure or mixed w/ wood/clay/iron): type IN (4,9,10,11)
    $sql = "SELECT COALESCE(SUM(bonus), 0) AS total FROM (SELECT CASE
            WHEN o.type IN (12) THEN 50 WHEN o.type IN (4,9,10,11) THEN 25 ELSE 0
            END AS bonus FROM " . TB_PREFIX . "wdata w JOIN " . TB_PREFIX . "odata o ON o.wref = w.id
            WHERE w.fieldtype = 0 AND ABS(w.x - $x) <= 3 AND ABS(w.y - $y) <= 3 AND o.type IN (12,4,9,10,11)
            ORDER BY bonus DESC LIMIT 3) t";

    $q = mysqli_query($this->dblink, $sql);
    $row = mysqli_fetch_assoc($q);
    $total = (int)($row['total'] ?? 0);
    if ($total > 150) $total = 150; // safety cap
    return $total;
}

	function updateResource($vid, $what, $number) {
	    $vid = (int) $vid;

	    if (!is_array($what)) {
	        $what = [$what];
	        $number = [$number];
        }

        $pairs = [];
        foreach ($what as $index => $whatValue) {
            $pairs[] = $this->escape($whatValue) . ' = ' . (Math::isInt($number[$index]) ? $number[$index] : '"'.$this->escape($number[$index]).'"');
        }

		$q = "UPDATE " . TB_PREFIX . "vdata SET ".implode(', ', $pairs)." WHERE wref = $vid";
		$result = mysqli_query($this->dblink,$q);
		return mysqli_query($this->dblink,$q);
	}
    
	//TODO: Remove this function to use the more general one
	// no need to cache this method
	function getVilWref($x, $y) {
	    list($x, $y) = $this->escape_input((int) $x, (int) $y);

		$q = "SELECT id FROM " . TB_PREFIX . "wdata where x = $x AND y = $y LIMIT 1";
		$result = mysqli_query($this->dblink,$q);
		$dbarray = mysqli_fetch_array($result);
		return $dbarray['id'];
	}
	
	/**
	 * Converts from coordinates to village IDs
	 * 
	 * @param array $coordinatesArray The coordinates array, containing the coordinates which need to be converted
	 * @return array Returns the converted coordinates
	 */
	
	function getVilWrefs($coordinatesArray) {
	    list($coordinatesArray) = $this->escape_input($coordinatesArray);
	    
	    if(!is_array($coordinatesArray[0])) $coordinatesArray = [$coordinatesArray];
	    
	    $conditions = [];
	    foreach($coordinatesArray as $coordinate){
	        $conditions[] = "(x = ".round($coordinate[0])." AND y = ".round($coordinate[1]).")";
	    }
	    
	    $q = "SELECT id FROM " . TB_PREFIX . "wdata WHERE ".implode(" OR ", $conditions);
	    $result = mysqli_query($this->dblink, $q);
	    
	    while($row = mysqli_fetch_assoc($result)) $wids[] = $row['id'];
	    return $wids;
	}

	function getVrefField($ref, $field, $use_cache = true) {
        return $this->getVillage($ref, 0, $use_cache)[$field];
	}

    // no need to cache this method
	function getVrefCapital($ref) {
	    $vdata = $this->getProfileVillages($ref);

	    foreach($vdata as $village){
	    	if($village['capital']) return $village;
        }
        return false;
	}

    // no need to cache this method
	function getStarvation() {
        return $this->getProfileVillages(0, 2);
	}

	/**
	 * Generates a list of "free to take" villages
	 * 
	 * @param int $sector The map sector, + | -, - | + , + | +, - | - (0 and > 3, 1, 2, 3)
	 * @param int $mode 0 if villages need be generated under certain filters, 1 if not
	 * @param bool $respect_gametime If is false, we generate user base really anywhere
	 * and that means we can generate farms closer to the middle of the map as well.
	 * Otherwise we'd only generate farms at corner edges in late game, which
	 * sucks for people in the middle who registered too soon
	 * @param int $numberOfVillages Number of villages which need to be generated
	 * @return array Return the generated villages 
	 */ 
	
	function generateBase($sector, $mode = 0, $numberOfVillages = 1) {
	    list($sector, $mode, $numberOfVillages) = $this->escape_input((int) $sector, (int) $mode, (int)$numberOfVillages);

        // don't let SQL time out when 30-500 seconds (depending on php.ini) is not enough
        @set_time_limit(0);
        $num_rows = $count = 0;
        $villages = [];
        $time = time();
        
        while ($numberOfVillages > 0) {
            switch($mode){
                case 0:
                    $daysPassedFromStart = ($time - strtotime(START_DATE) - strtotime(date('d.m.Y')) + strtotime(START_TIME)) / 86400;

                    $radiusMin = min(round(pow(2 * ($daysPassedFromStart / 5 * SPEED), 2)), round(pow(WORLD_MAX * 0.8, 2)) + round(pow(WORLD_MAX * 0.8, 2)));
                    $radiusMax = min(round(pow(4 * ($daysPassedFromStart / 5 * SPEED), 2)) + pow($count, 2), pow(WORLD_MAX, 2) + pow(WORLD_MAX, 2));
                    break;
                    
                case 1:
                default:
                    $radiusMin = 1;
                    $radiusMax = pow(WORLD_MAX, 2);
                    break;
                    
                case 2: //Small artifacts & WW building plans
                    $radiusMin = round(pow(WORLD_MAX * 0.50, 2));
                    $radiusMax = round(pow(WORLD_MAX * 0.75, 2));
                    break;
                
                case 3: //Large artifacts
                    $radiusMin = round(pow(WORLD_MAX * 0.35, 2));
                    $radiusMax = round(pow(WORLD_MAX * 0.55, 2));
                    break;
                
                case 4: //Unique artifacts
                    $radiusMin = round(pow(WORLD_MAX * 0.05, 2));
                    $radiusMax = round(pow(WORLD_MAX * 0.25, 2));
                    break;

                case 5: //WW villages
                    $radiusMin = round(pow(WORLD_MAX * 0.8, 2));
                    $radiusMax = round(pow(WORLD_MAX, 2));
                    break;
            }

            // The four sectors must be mutually exclusive: any tile sitting on an
            // axis (x = 0 or y = 0) used to satisfy two of the predicates below
            // (e.g. "x <= 0" and "x >= 0" both matched x = 0). When a batch was
            // spread over several sectors (WW villages, artifact villages),
            // occupied = 0 was only flipped at the very end by setFieldTaken(),
            // so two sectors could each pick the SAME axis tile and assign its
            // wref to two villages. The duplicate addVillage() insert then hit
            // the vdata PRIMARY KEY(wref) and aborted generateVillages() before
            // setFieldTaken() ran, leaving the villages in vdata (visible in the
            // Natars profile) but never marked on the map (issue #301). Using
            // strict bounds on one side of each axis partitions the plane so a
            // tile belongs to exactly one sector.
            switch($sector){
                case 1: $newSector = "x < 0 AND y >= 0"; break; // - | +
                case 2: $newSector = "x >= 0 AND y > 0"; break; // + | +
                case 3: $newSector = "x <= 0 AND y < 0"; break; // - | -
                default: $newSector = "x > 0 AND y <= 0"; // + | -
            }

            //Choose villages beetween two circumferences, by using their formula (x^2 + y^2 = r^2)
            $q = "SELECT id FROM ".TB_PREFIX."wdata WHERE fieldtype = 3 AND ($newSector) AND (POWER(x, 2) + POWER(y, 2) >= $radiusMin AND POWER(x, 2) + POWER(y, 2) <= $radiusMax) AND occupied = 0 ORDER BY RAND() LIMIT $numberOfVillages";
            $result = mysqli_query($this->dblink, $q);

            //Prevent an infinite loop
            $resultedRows = mysqli_num_rows($result);
            if($resultedRows == 0 && $count >= WORLD_MAX * 2) break;
            
            //Fill the villages array
            $villages = array_merge($villages, $this->mysqli_fetch_all($result));
            
            $num_rows += $resultedRows;
            $numberOfVillages -= $resultedRows;
            $count++;
            
        }

        foreach($villages as $village) $wids[] = $village['id'];

        return $num_rows == 1 ? $wids[0] : $wids;
    }

	function setFieldTaken($id) {
        if(empty($id)) return;
        if (!is_array($id)) {
            $id = [$id];
        }

        foreach ($id as $index => $idValue) {
            $id[$index] = (int) $idValue;
        }

		$q = "UPDATE " . TB_PREFIX . "wdata SET occupied = 1 WHERE id IN(". implode(', ', $id).")";
		return mysqli_query($this->dblink,$q);
	}

	/**
	 * Creates new villages
	 *
	 * @param array $villageArrays The array of the villages which have to be created
	 * @param int $uid The user ID
	 * @param string $username The username of the future owner
	 * @param array $troopsArray The troops that need to be added in the village(s)
	 * @param array $buildingsArray The buildings that need to be created in the village(s)
	 * @return array Returns the created villages ID
	 */
	
	function generateVillages($villageArrays, $uid, $username, $troopsArray = null, $buildingsArray = null){
		$uid = (int)$uid;
		$username = trim($username);
		
	    $wids = $takenWids = $countedWids = $generatedWids = $i = [];
	    
	    //Count each kid in its own array, to check how many villages must be created
	    foreach($villageArrays as $village){
	        if($village['wid'] == 0) $countedWids[$village['mode']][$village['kid']]++;
	    }
	    
	    //Generate the number of desired village for each kid
	    //and merge them with the more general "wids" array
	    foreach($countedWids as $mode => $totalCount){
	        foreach($totalCount as $sector => $count){
	            $generatedWids = $this->generateBase($sector, $mode, $count);
	            // Bug fix: previously merged every sector's wids into one flat
	            // $wids[$mode] list and consumed it with a single shared counter
	            // per mode, regardless of which sector a wid actually came from.
	            // As soon as a batch needed more than one sector (e.g. WW
	            // villages spread across all 4 quadrants), villages were handed
	            // wids strictly in array order, not matching their own kid — so
	            // most ended up in the wrong quadrant. Keying by [mode][sector]
	            // keeps each sector's wids separate.
	            $wids[$mode][$sector] = !is_array($generatedWids) ? [$generatedWids] : $generatedWids;
	            if(empty($i[$mode][$sector])) $i[$mode][$sector] = 0;
	        }
	    }
	    
	    //Create the villages
		foreach($villageArrays as $village){
		    
		    //Check if the village wid isn't already set and assing one among the generated ones
		    if($village['wid'] == 0) $village['wid'] = $wids[$village['mode']][$village['kid']][$i[$village['mode']][$village['kid']]++];
		    
		    //Merge the wids into an unique array
		    $takenWids[] = $village['wid'];
		    $villageTypes[] = $village['type'];
		    
		    //Add the village and its buildings		    
			$this->addVillage($village['wid'], $uid, $username, $village['capital'], $village['pop'], $village['name'], $village['natar']);
		}
		
        //Create tables for the just generated villages
		$this->addResourceFields($takenWids, $villageTypes, $buildingsArray);
		$this->setFieldTaken($takenWids);
		$this->addUnits($takenWids, $troopsArray);
		$this->addTech($takenWids);
		$this->addABTech($takenWids);

		return count($takenWids) > 1 ? $takenWids : $takenWids[0];
	}
	
	/**
	 * 
	 * Create a village
	 * 
	 * @param int $wid The village ID
	 * @param int $uid The User ID, the village's owner
	 * @param string $username The username
	 * @param int $capital 1 if it's a capital village, 0 otherwise
	 * @param int $pop The default village population
	 * @param string $villageName The default village name
	 * @return bool Returns true if the query was successful, false otherwise
	 */
	
	function addVillage($wid, $uid, $username, $capital, $pop = 2, $villageName = null, $isNatar = 0) {
    $wid = (int)$wid;
    $uid = (int)$uid;
    $capital = (int)$capital;
    $pop = (int)$pop;
    $isNatar = (int)$isNatar;
    $username = trim($username);

    $total = count($this->getVillagesID($uid));
    if (empty($villageName)) {
        // fără backslash, fără htmlentities – doar text curat
        $villageName = $username . "'s village" . ($total >= 1 ? " " . ($total + 1) : "");
    }

    $time = time();
    $storage = STORAGE_BASE;

    $stmt = $this->dblink->prepare(
        "INSERT INTO `".TB_PREFIX."vdata` 
        (wref, owner, name, capital, pop, cp, celebration, wood, clay, iron, maxstore, crop, maxcrop, lastupdate, created, natar) 
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)"
    );
    $cp = 1; $celebration = 0; $wood = 750; $clay = 750; $iron = 750; $crop = 750;
    $stmt->bind_param("iisiiiiiiiiiiiii", 
        $wid, $uid, $villageName, $capital, $pop, $cp, $celebration, 
        $wood, $clay, $iron, $storage, $crop, $storage, $time, $time, $isNatar
    );
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

	/**
	 * 
	 * Add the buildings tables to a specified village(s), and its relative buildings
	 * 
	 * @param mixed $vid The village ID(s)
	 * @param mixed $type int if there's only one village, array if there are multiple villages
	 * @param array $buildingsArray divided in two portion, which contains the types (unidimensional array) and the values of the
	 *              buildings that need to be added (bidimensional array)
	 * @return bool Return true if the query was successful, false otherwise
	 */
	
	function addResourceFields($vids, $types, $buildingsArray = null) {
	    list($vids, $types, $buildingsArray) = $this->escape_input($vids, $types, $buildingsArray);

	    if(!is_array($vids)){
	        $vids = [$vids];
	        $types = [$types];
	    }

	    //Set the default villages structure (resources fields and main building)
	    $defaultVillage = "vref,f1t,f2t,f3t,f4t,f5t,f6t,f7t,f8t,f9t,f10t,f11t,f12t,f13t,f14t,f15t,f16t,f17t,f18t"
	                       .($buildingsArray != null ? ",".implode(",",$buildingsArray[0]) : ",f26,f26t");
	    $defaultValues = [];
	    
		//Select the village type and assemble the building values
	    foreach($vids as $index => $vid){
	        $stringValues = "";
	        $stringValues .= "(".$vid.",";
	        switch($types[$index]) {            
	            case 1: $stringValues .= "4,4,1,4,4,2,3,4,4,3,3,4,4,1,4,2,1,2"; break;
	            case 2: $stringValues .= "3,4,1,3,2,2,3,4,4,3,3,4,4,1,4,2,1,2"; break;
	            case 3: $stringValues .= "1,4,1,3,2,2,3,4,4,3,3,4,4,1,4,2,1,2"; break;
	            case 4: $stringValues .= "1,4,1,2,2,2,3,4,4,3,3,4,4,1,4,2,1,2"; break;
	            case 5: $stringValues .= "1,4,1,3,1,2,3,4,4,3,3,4,4,1,4,2,1,2"; break;
	            case 6: $stringValues .= "4,4,1,3,4,4,4,4,4,4,4,4,4,4,4,2,4,4"; break;
	            case 7: $stringValues .= "1,4,4,1,2,2,3,4,4,3,3,4,4,1,4,2,1,2"; break;
	            case 8: $stringValues .= "3,4,4,1,2,2,3,4,4,3,3,4,4,1,4,2,1,2"; break;
	            case 9: $stringValues .= "3,4,4,1,1,2,3,4,4,3,3,4,4,1,4,2,1,2"; break;
	            case 10: $stringValues .= "3,4,1,2,2,2,3,4,4,3,3,4,4,1,4,2,1,2"; break;
	            case 11: $stringValues .= "3,1,1,3,1,4,4,3,3,2,2,3,1,4,4,2,4,4"; break;
	            case 12: $stringValues .= "1,4,1,1,2,2,3,4,4,3,3,4,4,1,4,2,1,2"; break;
	            default: $stringValues .= "4,4,1,4,4,2,3,4,4,3,3,4,4,1,4,2,1,2";
	        }
	        
	        $stringValues .= $buildingsArray != null ? ",".implode(",",$buildingsArray[1][$index]).")" : ",1,15)";
	        $defaultValues[] = $stringValues;
	    }
	
	    $q = "INSERT INTO " . TB_PREFIX . "fdata ($defaultVillage) values".implode(",",$defaultValues);
		return mysqli_query($this->dblink, $q);
	}

    function isVillageOases($wref, $use_cache = true) {
        // retirieve form cache
        return $this->getVillageByWorldID($wref, $use_cache)['oasistype'];
    }

	public function VillageOasisCount($vref, $use_cache = true) {
	    list($vref) = $this->escape_input((int) $vref);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$oasisCountCache, $vref)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

		$q = "SELECT count(*) FROM `".TB_PREFIX."odata` WHERE conqured=". $vref;
		$result = mysqli_query($this->dblink,$q);
		$row = mysqli_fetch_row($result);

        self::$oasisCountCache[$vref] = $row[0];
        return self::$oasisCountCache[$vref];
	}

	/**
	 * Calculates the distance from a village to another
	 * 
	 * @param int $coorx1 X coordinate of the first village
	 * @param int $coory1 Y coordinate of the second village
	 * @param int $coorx2 X coordinate of the first village
	 * @param int $coory2 Y coordinate of the second village
	 * @return int Returns the calculated distance
	 */
	
	public function getDistance($coorx1, $coory1, $coorx2, $coory2) {
		$max = 2 * WORLD_MAX + 1;
		$x1 = intval($coorx1);
		$y1 = intval($coory1);
		$x2 = intval($coorx2);
		$y2 = intval($coory2);
		$distanceX = min(abs($x2 - $x1), abs($max - abs($x2 - $x1)));
		$distanceY = min(abs($y2 - $y1), abs($max - abs($y2 - $y1)));
		return round(sqrt(pow($distanceX, 2) + pow($distanceY, 2)), 1);
	}
	
    public function canConquerOasis($vref, $wref, $use_cache = true) {
        list($vref,$wref) = $this->escape_input($vref,$wref);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$oasisConquerableCache, $vref.$wref)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

        $AttackerFields = $this->getResourceLevel( $vref, $use_cache );
        for ( $i = 19; $i <= 38; $i ++ ) {
            if ( $AttackerFields[ 'f' . $i . 't' ] == 37 ) {
                $HeroMansionLevel = $AttackerFields[ 'f' . $i ];
            }
        }
        if ( $this->VillageOasisCount( $vref ) < floor( ( $HeroMansionLevel - 5 ) / 5 ) ) {
            $OasisInfo = $this->getOasisInfo( $wref );
            //fix by ronix
            if (
                $OasisInfo['conqured'] == 0 ||
                $OasisInfo['conqured'] != 0 &&
                intval( $OasisInfo['loyalty'] ) < ( 99 / min(3, (4 - $this->VillageOasisCount($OasisInfo['conqured'], $use_cache))) )
            ) {
                $CoordsVillage = $this->getCoor( $vref );
                $CoordsOasis   = $this->getCoor( $wref );
                $max           = 2 * WORLD_MAX + 1;
                $x1            = intval( $CoordsOasis['x'] );
                $y1            = intval( $CoordsOasis['y'] );
                $x2            = intval( $CoordsVillage['x'] );
                $y2            = intval( $CoordsVillage['y'] );
                $distanceX     = min( abs( $x2 - $x1 ), abs( $max - abs( $x2 - $x1 ) ) );
                $distanceY     = min( abs( $y2 - $y1 ), abs( $max - abs( $y2 - $y1 ) ) );

                if ( $distanceX <= 3 && $distanceY <= 3 ) {
                    self::$oasisConquerableCache[ $vref . $wref ] = 1; //can
                } else {
                    self::$oasisConquerableCache[ $vref . $wref ] = 2; //can but not in 7x7 field
                }

            } else {
                self::$oasisConquerableCache[ $vref . $wref ] = 3; //loyalty >0
            }

        } else {
            self::$oasisConquerableCache[ $vref . $wref ] = 0; //req level hero mansion
        }

        return self::$oasisConquerableCache[ $vref . $wref ];
    }

	public function conquerOasis($vref,$wref) {
	    list($wref) = $this->escape_input((int) $wref);

		$vinfo = $this->getVillage($vref);
		$uid = (int) $vinfo['owner'];
		$q = "UPDATE `".TB_PREFIX."odata` SET conqured=".(int) $vref. ",loyalty=100,lastupdated=".time().",owner=$uid,name='Occupied Oasis' WHERE wref=".$wref;
		return mysqli_query($this->dblink,$q);
	}

    public function modifyOasisLoyalty($wref) {
        list($wref) = $this->escape_input((int) $wref);

        if($this->isVillageOases($wref) != 0) {
            $OasisInfo = $this->getOasisInfo($wref);
            if($OasisInfo['conqured'] != 0) {
                $LoyaltyAmendment = floor(100 / min(3,(4-$this->VillageOasisCount($OasisInfo['conqured']))));
                $q = "UPDATE `".TB_PREFIX."odata` SET loyalty=loyalty-$LoyaltyAmendment, lastupdated=".time()." WHERE wref=".$wref;
                $result=mysqli_query($this->dblink,$q);
                return $OasisInfo['loyalty']-$LoyaltyAmendment;
            }
        }
    }

	function regenerateOasisUnits($wid, $automation = false) {
	    global $autoprefix;

	    if (is_array($wid)) $wid = '(' . implode('),(', $wid) . ')';	        
	    else $wid = '(' . (int) $wid . ')';

	    // load the oasis regeneration (in-game) and units generation (during install) SQL file
	    // and replace village IDs for the given $wid
	    $str = file_get_contents($autoprefix."var/db/datagen-oasis-troops-regen.sql");
	    $str = preg_replace(["'%PREFIX%'", "'%VILLAGEID%'", "'%NATURE_REG_TIME%'"], [TB_PREFIX, $wid, ($automation ? NATURE_REGTIME : -1)], $str);
	    $result = $this->dblink->multi_query($str);

	    // fetch results of the multi-query in order to allow subsequent query() and multi_query() calls to work
	    while (mysqli_more_results($this->dblink) && mysqli_next_result($this->dblink)) {;}

	    if (!$result) return false;

	    return true;
	}

	/**
	 * Remove all oasis of a specified village if the mode is 1, if it's 0, then it'll remove only the selected oasis
	 *
	 * @param mixed $wref The village ID(s) (mode = 1)/oasis ID (mode = 0) of the oasis owner
	 * @return bool Returns true if the query was successful, false otherwise
	 */
	
	function removeOases($wref, $mode = 0) {
	    list($wref) = $this->escape_input((int) $wref);

	    if(!is_array($wref)) $wref = [$wref];
	    $wrefs = implode(",", $wref);
	    
		$q = "UPDATE ".TB_PREFIX."odata SET conqured = 0, owner = 2, name = 'Unoccupied Oasis' WHERE ".(!$mode ? "wref IN($wrefs)" : "conqured IN($wrefs)");
		return mysqli_query($this->dblink,$q);
	}

	/***************************
	Function to retrieve type of village via ID
	References: Village ID
	***************************/
	function getVillageType($wref, $use_cache = true) {
        // retrieve this value from the full village data cache
        return $this->getVillageByWorldID($wref, $use_cache)['fieldtype'];
	}

	/*****************************************
	Function to retrieve if is occupied via ID
	References: Village ID
	*****************************************/
	function getVillageState($wref, $use_cache = true) {
        // retrieve this value from the full village data cache
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$villageFieldsCacheByWorldID, $wref)) && !is_null($cachedValue)) {
            return (((int)($cachedValue['occupied'] ?? 0)) != 0 || ((int)($cachedValue['oasistype'] ?? 0)) != 0);
        } else {
            $vil = $this->getVillageByWorldID($wref, $use_cache);
            return (((int)($vil['occupied'] ?? 0)) != 0 || ((int)($vil['oasistype'] ?? 0)) != 0);
        }
	}
	
	/**
	 * Get the first free village, if there's one
	 * 
	 * @param array $wids The village IDs
	 * @return int Returns the wid of the first free village, if they're all taken, returns 0
	 */
	
	function getFreeVillage($wids){
	    list($wids) = $this->escape_input($wids);
	    
	    if(!is_array($wids)) $wids = [$wids];
	    
	    $q = "SELECT id FROM ".TB_PREFIX."wdata WHERE id IN(".implode(",", $wids).") AND occupied = 0 AND oasistype = 0 LIMIT 1";
	    $result = mysqli_query($this->dblink, $q);
	    return mysqli_num_rows($result) > 0 ? mysqli_fetch_array($result)[0] : 0;
	}

	function getVillageID($uid, $use_cache = true) {
	    // load cached value
	    return $this->getVillagesID($uid, $use_cache)[0];
	}

	function getVillagesID($uid, $use_cache = true) {
	    list($uid) = $this->escape_input((int) $uid);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$villageIDsCache, $uid)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

        $array = $this->getProfileVillages($uid, 0, $use_cache);
		$newarray = array();

		for($i = 0; $i < count($array); $i++) {
			array_push($newarray, $array[$i]['wref']);
		}

		self::$villageIDsCache[$uid] = $newarray;
		return self::$villageIDsCache[$uid];
	}

	function getVillagesID2($uid, $use_cache = true) {
	    list($uid) = $this->escape_input((int) $uid);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$villageIDsCacheSimple, $uid)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

        $array = $this->getProfileVillages($uid, 0, $use_cache);
        self::$villageIDsCacheSimple[$uid] = $array;

        return self::$villageIDsCacheSimple[$uid];
	}

	function findAlreadyCachedVillageData($vid, $mode) {
        // check if we don't actually have this data cached already in one of the other modes
        for ($i = 0; $i <= 4; $i++) {
            if ($mode !== $i && isset(self::$villageFieldsCache[$vid.$i])) {
                // loop through cached values
                foreach (self::$villageFieldsCache[$vid.$i] as $index => $value) {
                    // check for existing record with our requested ID/name/owner...
                    switch ($mode) {
                        case 0: if ($value['wref'] == $vid) {
                                    return $value;
                                }
                                break;

                        case 1: if ($value['name'] == $vid) {
                                    return $value;
                                }
                                break;

                        case 2: if ($value['owner'] == $vid) {
                                    return $value;
                                }
                                break;

                        case 3: if ((isset($value['owner']) && isset($value['capital'])) && $value['owner'] == $vid && $value['capital'] == 1) {
                                    return $value;
                                }
                                break;

                        case 4: if ($value['owner'] == 4) {
                                    return $value;
                                }
                                break;
                    }
                }
            }
        }

        return false;
    }

	function getVillage($vid, $mode = 0, $use_cache = true) {
	    // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$villageFieldsCache, ((int) $vid).$mode)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

        if ($use_cache && ($altCachedContentSearch = $this->findAlreadyCachedVillageData($vid, $mode))) {
            return $altCachedContentSearch;
        }

        switch ($mode) {
            // by WREF
            case 0: $vid = (int) $vid;
                    $q = "SELECT * FROM " . TB_PREFIX . "vdata WHERE wref = $vid LIMIT 1";
                    break;

            // by name
            case 1: $name = $this->escape($vid);
                    $q = "SELECT * FROM " . TB_PREFIX . "vdata WHERE `name` = '$name' LIMIT 1";
                    break;

            // by owner ID
            case 2: $vid = (int) $vid;
                    $q = "SELECT * FROM " . TB_PREFIX . "vdata WHERE owner = $vid LIMIT 1";
                    break;

            // by owner ID and capital = 1
            case 3: $vid = (int) $vid;
                    $q = "SELECT * FROM " . TB_PREFIX . "vdata WHERE owner = $vid AND capital = 1 LIMIT 1";
                    break;

            // by owner = Taskmaster
            case 4: $vid = (int) $vid;
                    $q = "SELECT * FROM " . TB_PREFIX . "vdata WHERE owner = 4 LIMIT 1";
                    break;
        }

		$result = mysqli_query($this->dblink,$q);

        self::$villageFieldsCache[$vid.$mode] = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return self::$villageFieldsCache[$vid.$mode];
	}

    function getProfileVillages($uid, $mode = 0, $use_cache = true) {
        $arrayPassed = is_array($uid);

        if (!$arrayPassed) {
            $uid = [(int) $uid];
        } else {
            foreach ($uid as $index => $uidValue) {
                $uid[$index] = (int) $uidValue;
            }
        }

        if (!count($uid)) {
            return [];
        }

        // first of all, check if we should be using cache
        if ($use_cache && !$arrayPassed && ($cachedValue = self::returnCachedContent(self::$userVillagesCache, $uid[0].$mode)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

        // if we've given a number of villages to preload, remove those that already are
        if ($use_cache && $arrayPassed) {
            $newIDs = [];
            foreach ($uid as $id) {
                if (!isset(self::$userVillagesCache[$id.$mode])) {
                    $newIDs[] = $id;
                }
            }
            $uid = $newIDs;
        }

        // nothing left to cache, return the full cache
        if (!count($uid)) {
            return self::$userVillagesCache;
        }

        switch ($mode) {
            // by owner ID
            case 0: $q = "SELECT * FROM " . TB_PREFIX . "vdata WHERE owner IN(".implode(', ', $uid).") ORDER BY pop DESC";
                    break;

            // capital villages where owner is a real player (i.e. not Natars etc.)
            case 1: $q = "SELECT * FROM " . TB_PREFIX . "vdata WHERE capital = 1 and owner > 5";
                    break;

            // villages with starvation data
            case 2: $q = "SELECT * FROM " . TB_PREFIX . "vdata WHERE starv != 0 and owner != 3";
                    break;

            // field distance calculator query
            case 3: $q = "SELECT * FROM " . TB_PREFIX . "vdata WHERE owner > 4 and wref != ".$uid[0];
                    break;

            // villages in need of celebration data update
            case 4: $q = "SELECT * FROM " . TB_PREFIX . "vdata WHERE celebration < ".$uid[0]." AND celebration != 0";
                    break;

            // by vref ID
            case 5: $q = "SELECT * FROM " . TB_PREFIX . "vdata WHERE wref IN(".implode(', ', $uid).")";
                    break;

            // by loyalty updates required
            case 6: $q = "SELECT * FROM " . TB_PREFIX . "vdata WHERE loyalty < 100";
                    break;
                    
            // villages without starvation data, Support, Nature, Natars, Taskmaster, Multihunter are all excluded
            case 7: $q = "SELECT * FROM " . TB_PREFIX . "vdata WHERE starv = 0 and owner > 5";
                    break;
        }

        $result = mysqli_query($this->dblink,$q);

        if (!$arrayPassed) {
            $result = $this->mysqli_fetch_all($result);
            self::$userVillagesCache[ $uid[0].$mode ] = $result;

            // cache each village individually into the fields cache as well
            foreach ($result as $v) {
                $amode = 0;
                self::$villageFieldsCache[((int) $v['wref']).$amode] = $v;
            }
        } else {
            // we're preloading, cache all the data individually
            if (mysqli_num_rows($result)) {
                $amode = 0;
                while ( $row = mysqli_fetch_array( $result, MYSQLI_ASSOC ) ) {
                    if ( ! isset( self::$userVillagesCache[ $row['owner'].$mode ] ) ) {
                        self::$userVillagesCache[ $row['owner'].$mode ] = [];
                    }

                    self::$userVillagesCache[ $row['owner'].$mode ][] = $row;
                    self::$villageFieldsCache[((int) $row['wref']).$amode] = $row;
                }

                // just return the full cache if we've given an array of IDs to load villages for
                $result = self::$userVillagesCache;
            }
        }

        return $result;
    }

    function cacheVillageByWorldIDs($uid, $mode = 0) {
	    if (!is_array($uid)) {
	        $uid = [(int) $uid];
        } else {
	        foreach ($uid as $index => $uidValue) {
	            $uid[$index] = (int) $uidValue;
            }
        }

        $result = mysqli_query($this->dblink, "
          SELECT
            *
          FROM
            " . TB_PREFIX . "wdata as wdata
            LEFT JOIN " . TB_PREFIX . "vdata as vdata ON wdata.id = vdata.wref
          WHERE vdata.owner IN(".implode('', $uid).")"
        );

	    if (mysqli_num_rows($result)) {
	        $result = $this->mysqli_fetch_all($result);

	        $amode = 0;
	        foreach ($result as $row) {
                self::$villageFieldsCacheByWorldID[$row['id']] = $row;

                // cache village fields by wref as well, for future use
                if (!isset(self::$villageFieldsCache[((int) $row['wref']).$amode])) {
                    self::$villageFieldsCache[ ( (int) $row['wref'] ) . $amode ] = $row;
                }
            }
        }
    }
    
    function getVillageByWorldID($vid, $use_cache = true) {
        $array_passed = is_array($vid);

        if (!$array_passed) {
            $vid = [(int) $vid];
        } else {
            foreach ($vid as $index => $ivdValue) {
                $vid[$index] = (int) $ivdValue;
            }
        }

        if (!count($vid)) {
            return [];
        }

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && !$array_passed && isset(self::$villageFieldsCacheByWorldID[$vid[0]]) && is_array(self::$villageFieldsCacheByWorldID[$vid[0]]) && !count(self::$villageFieldsCacheByWorldID[$vid[0]])) {
            return self::$villageFieldsCacheByWorldID[$vid[0]];
        } else if ($use_cache && $array_passed) {
            // check what we can return from cache
            $newVIDs = [];
            foreach ($vid as $key) {
                if (!isset(self::$villageFieldsCacheByWorldID[$key])) {
                    $newVIDs [] = $key;
                }
            }

            // everything's cached, just return the cache
            if (!count($newVIDs)) {
                return self::$villageFieldsCacheByWorldID;
            } else {
                // update remaining IDs to select and cache
                $vid = $newVIDs;
            }
        } else if ($use_cache && !$array_passed && ($cachedValue = self::returnCachedContent(self::$villageFieldsCacheByWorldID, $vid[0])) && !is_null($cachedValue)) {
            return $cachedValue;
        }

        $q = "SELECT * FROM " . TB_PREFIX . "wdata where id IN(".implode(', ', $vid).")";
        $result = $this->mysqli_fetch_all(mysqli_query($this->dblink,$q));

        // return a single value
        if (!$array_passed) {
            self::$villageFieldsCacheByWorldID[$vid[0]] = (isset($result[0]) && is_array($result[0])) ? $result[0] : [];
        } else {
            if ($result && count($result)) {
                foreach ( $result as $record ) {
                    self::$villageFieldsCacheByWorldID[$record['id']] = $record;
                }
            }

            // check for any missing IDs and fill them in with blanks,
            // since no reinforcements were found for these villages
            foreach ($vid as $key) {
                if (!isset(self::$villageFieldsCacheByWorldID[$key])) {
                    self::$villageFieldsCacheByWorldID[$key] = [];
                }
            }
        }

        return ($array_passed ? self::$villageFieldsCacheByWorldID : self::$villageFieldsCacheByWorldID[$vid[0]]);
    }

	public function getVillageBattleData($vid, $use_cache = true) {
	    list($vid) = $this->escape_input((int) $vid);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$villageBattleDataCache, $vid)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

		$q = "SELECT u.id,u.tribe,v.capital,f.f40 AS wall FROM ".TB_PREFIX."users u,".TB_PREFIX."fdata f,".TB_PREFIX."vdata v WHERE u.id=v.owner AND f.vref=v.wref AND v.wref=".$vid." LIMIT 1";
		$result = mysqli_query($this->dblink,$q);

        self::$villageBattleDataCache[$vid] = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return self::$villageBattleDataCache[$vid];
	}

	function getOasisV($vid, $use_cache = true) {
	    list($vid) = $this->escape_input((int) $vid);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$oasisFieldsCache, $vid)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

		$q = "SELECT * FROM " . TB_PREFIX . "odata where wref = $vid LIMIT 1";
		$result = mysqli_query($this->dblink,$q);

        self::$oasisFieldsCache[$vid] = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return self::$oasisFieldsCache[$vid];
	}

	function getMInfo($id, $use_cache = true) {
	    $array_passed = is_array($id);

	    if (!$array_passed) {
	        $id = [(int) $id];
	    } else {
	        foreach ($id as $index => $idValue) {
	            $id[$index] = (int) $idValue;
	        }
	    }

	    if (!count($id)) {
	        return [];
	    }

	    // first of all, check if we should be using cache and whether the data
	    // required is already cached
	    if ($use_cache && !$array_passed && ($cachedValue = self::returnCachedContent(self::$worldAndVillageDataCache, $id[0])) && !is_null($cachedValue)) {
	        return $cachedValue;
	    } else if ($use_cache && $array_passed) {
	        // only select the world IDs we haven't cached yet
	        $newIDs = [];
	        foreach ($id as $key) {
	            if (!isset(self::$worldAndVillageDataCache[$key])) {
	                $newIDs[] = $key;
	            }
	        }

	        // everything's cached, return the whole cache
	        if (!count($newIDs)) {
	            return self::$worldAndVillageDataCache;
	        }
	        $id = $newIDs;
	    }

		$q = "SELECT * FROM " . TB_PREFIX . "wdata left JOIN " . TB_PREFIX . "vdata ON " . TB_PREFIX . "vdata.wref = " . TB_PREFIX . "wdata.id where " . TB_PREFIX . "wdata.id IN(".implode(', ', $id).")";
		$result = mysqli_query($this->dblink,$q);

	    // preserve the original MYSQLI_BOTH semantics (numeric + associative keys)
	    $rows = [];
	    if ($result) {
	        while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
	            $rows[] = $row;
	        }
	    }

	    // return a single value
	    if (!$array_passed) {
	        self::$worldAndVillageDataCache[$id[0]] = isset($rows[0]) ? $rows[0] : null;
	        return self::$worldAndVillageDataCache[$id[0]];
	    }

	    // cache each returned record by its world ID (wdata.id)
	    foreach ($rows as $record) {
	        self::$worldAndVillageDataCache[$record['id']] = $record;
	    }

	    return self::$worldAndVillageDataCache;
	}

	function getOMInfo($id, $use_cache = true) {
	    list($id) = $this->escape_input((int) $id);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$worldAndOasisDataCache, $id)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

		$q = "SELECT * FROM " . TB_PREFIX . "wdata left JOIN " . TB_PREFIX . "odata ON " . TB_PREFIX . "odata.wref = " . TB_PREFIX . "wdata.id where " . TB_PREFIX . "wdata.id = $id LIMIT 1";
		$result = mysqli_query($this->dblink,$q);

        self::$worldAndOasisDataCache[$id] = mysqli_fetch_array($result);
        return self::$worldAndOasisDataCache[$id];
	}

	function getOasis($vid, $use_cache = true) {
	    list($vid) = $this->escape_input((int) $vid);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$oasisFieldsCacheByConqueredID, $vid)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

		$q = "SELECT * FROM " . TB_PREFIX . "odata where conqured = $vid";
		$result = mysqli_query($this->dblink,$q);

        self::$oasisFieldsCacheByConqueredID[$vid] = $this->mysqli_fetch_all($result);
        return self::$oasisFieldsCacheByConqueredID[$vid];
	}

	function getOasisInfo($wid, $use_cache = true) {
	    return $this->getOasisV($wid, $use_cache);
	}

    function getVillageField($ref, $field, $use_cache = true) {
        // return all data, don't waste time by selecting fields one by one
        $villageArray = $this->getVillage($ref, 0, $use_cache);
        $result = (isset($villageArray[$field]) ? $villageArray[$field] : null);

        if($result){
            // will return the result
        }elseif($field=="name"){
            $result = "[?]";
        }else $result = 0;

        return $result;
    }

    function getVillageFields($ref, $fields, $use_cache = true) {
        // return all data, don't waste time by selecting fields one by one
        return $this->getVillage($ref, 0, $use_cache);
    }

	function getOasisField($ref, $field, $use_cache = true) {
        // return all data, don't waste time by selecting fields one by one
        $oasisArray = $this->getOasisV($ref, $use_cache);
        return (isset($oasisArray[$field]) ? $oasisArray[$field] : null);
	}

    function getOasisFields($ref, $use_cache = true) {
        // return all data, don't waste time by selecting fields one by one
        return $this->getOasisV($ref, $use_cache);
    }

	function setVillageField($ref, $field, $value) {
	    if (!is_array($field)) {
	        $field = [$field];
	        $value = [$value];
        }

        $pairs = [];
	    foreach ($field as $index => $fieldValue) {
            $newValue = ((Math::isInt($value[$index]) || Math::isFloat($value[$index])) ? $value[$index] : '"'.$this->escape($value[$index]).'"');
	        $pairs[] = $this->escape($fieldValue).' = '.$newValue;

	        // update cache
	        if (isset(self::$villageFieldsCache[$ref])) {
                self::$villageFieldsCache[$ref][$fieldValue] = $newValue;
            }
        }

		$q = "UPDATE " . TB_PREFIX . "vdata SET ".implode(', ', $pairs)." WHERE wref = ".(int) $ref;
		return mysqli_query($this->dblink,$q);
	}

    function setVillageFields($ref, $fields, $values) {
        list($ref, $fields, $values) = $this->escape_input((int) $ref, $fields, $values);

        if (!count($fields)) {
            return;
        }

        // build the field-value query parts
        $fieldValues = [];
        foreach ($fields as $id => $fieldName) {
            $fieldValues[] = $this->escape($fieldName).' = '.((Math::isInt($values[$id]) || Math::isFloat($values[$id])) ? $values[$id] : '"'.$this->escape($values[$id]).'"');
        }

        $q = "UPDATE " . TB_PREFIX . "vdata set ".implode(', ', $fieldValues)." where wref = $ref";
        return mysqli_query($this->dblink,$q);
    }

	function setVillageLevel($ref, $fields, $values) {
	    list($ref, $fields, $values) = $this->escape_input((int) $ref, $fields, $values);

        // build the field-value query parts
        $fieldValues = [];

        if (!is_array($fields)) {
            $fields = [$fields];
            $values = [$values];
        }

        foreach ($fields as $id => $fieldName) {
            $fieldValues[] = $this->escape($fieldName).' = '.((Math::isInt($values[$id]) || Math::isFloat($values[$id])) ? $values[$id] : '"'.$this->escape($values[$id]).'"');
        }

		$q = "UPDATE " . TB_PREFIX . "fdata set ".implode(', ', $fieldValues)." where vref = " . $ref;
		return mysqli_query($this->dblink,$q);
	}

	function cacheResourceLevels($vids) {
        if (!is_array($vids)) {
            $vids = [$vids];
        }

        $newVids = [];
	    foreach ($vids as $index => $vidValue) {
            $vids[ $index ] = (int) $vidValue;

            // don't cache what's cached
	        if (!isset(self::$resourceLevelsCache[$vids[ $index ]])) {
                $newVids[] = $vids[ $index ];
            }
        }
        $vids = $newVids;

	    if (!count($vids)) {
	        return [];
        }

        $q = "SELECT * FROM " . TB_PREFIX . "fdata WHERE vref IN(".implode(', ', $vids).")";
        $result = mysqli_query($this->dblink,$q);

        foreach ( $this->mysqli_fetch_all( $result ) as $row ) {
            self::$resourceLevelsCache[ $row['vref'] ] = $row;
        }

        return self::$resourceLevelsCache;
    }
	
	function getResourceLevel($vid, $use_cache = true) {
	    list($vid) = $this->escape_input((int) $vid);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$resourceLevelsCache, $vid)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

		$q = "SELECT * from " . TB_PREFIX . "fdata where vref = $vid";
		$result = mysqli_query($this->dblink,$q);

        self::$resourceLevelsCache[$vid] = mysqli_fetch_assoc($result);
        return self::$resourceLevelsCache[$vid];
	}

	public static function clearResourseLevelsCache() {
	    self::$resourceLevelsCache = [];
        self::$fieldLevelsInVillageSearchCache = [];
        self::$fieldLevelsCache = [];
    }
	//end fix

	function getCoor($wref, $use_cache = true) {
	    // retirieve form cache
        return $this->getVillageByWorldID($wref, $use_cache);
	}

	function getVillageType2($wref, $use_cache = true) {
        // retirieve form cache
        return $this->getVillageByWorldID($wref, $use_cache)['oasistype'];
	}

	// no need to cache this method
	function checkVilExist($wref) {
	    list($wref) = $this->escape_input((int) $wref);

	    // first of all, check if this exists in our cache already - and if so, we don't need an extra query
        $mode = 0;
        if (isset(self::$villageFieldsCache[((int) $wref).$mode])) {
            return true;
        }

		$q = "SELECT Count(*) as Total FROM " . TB_PREFIX . "vdata where wref = '$wref'";
		$result = mysqli_fetch_array(mysqli_query($this->dblink,$q), MYSQLI_ASSOC);
		
		return $result['Total'];
	}

	// no need to cache this method
	function checkOasisExist($wref) {
	    list($wref) = $this->escape_input((int) $wref);

		$q = "SELECT Count(*) as Total FROM " . TB_PREFIX . "odata where wref = '$wref'";
		$result = mysqli_fetch_array(mysqli_query($this->dblink,$q), MYSQLI_ASSOC);
		if($result['Total']) {
			return true;
		} else {
			return false;
		}
	}

	 // FIX #1b (Day 1): param nou optional $setLastupdate - cand e true, lastupdate
	 // se seteaza in aceeasi interogare (Village::processProduction nu mai are nevoie
	 // de updateVillage() separat). Default false => zero impact pe restul call-site-urilor.
	 function modifyResource($vid, $wood, $clay, $iron, $crop, $mode, $setLastupdate = false) {
	     list($vid, $wood, $clay, $iron, $crop, $mode) = $this->escape_input((int) $vid, $wood, $clay, $iron, $crop, $mode);
         $sign = (!$mode ? '-' : '+');
         $lastupdateSql = ($setLastupdate ? ",
                    lastupdate = " . time() : "");

         $q = "
            UPDATE " . TB_PREFIX . "vdata
                SET
                    wood = IF(wood $sign $wood < 0, 0, IF(wood $sign $wood > maxstore, maxstore, wood $sign $wood)),
                    clay = IF(clay $sign $clay < 0, 0, IF(clay $sign $clay > maxstore, maxstore, clay $sign $clay)),
                    iron = IF(iron $sign $iron < 0, 0, IF(iron $sign $iron > maxstore, maxstore, iron $sign $iron)),
                    crop = IF(crop $sign $crop < 0, 0, IF(crop $sign $crop > maxcrop, maxcrop, crop $sign $crop))$lastupdateSql
                WHERE
                    wref = " . $vid ;
					
         return mysqli_query( $this->dblink, $q);
	}

   	function setMaxStoreForVillage($vid, $maxLevel) {
	    $vid = (int) $vid;
	    $maxLevel = (int) $maxLevel;

        $this->query("
                        UPDATE
                            ".TB_PREFIX."vdata
                        SET
                            `maxstore` = IF( `maxstore` - $maxLevel < ".STORAGE_BASE.", ".STORAGE_BASE.", `maxstore` - $maxLevel )
                        WHERE
                            wref=$vid");
    }

    function setMaxCropForVillage($vid, $maxLevel) {
        $vid = (int) $vid;
        $maxLevel = (int) $maxLevel;

        $this->query("
                        UPDATE
                            ".TB_PREFIX."vdata
                        SET
                            `maxcrop` = IF( `maxcrop` - $maxLevel < ".STORAGE_BASE.", ".STORAGE_BASE.", `maxcrop` - $maxLevel )
                        WHERE
                            wref=$vid");
    }

	function modifyOasisResource($vid, $wood, $clay, $iron, $crop, $mode) {
	    list($vid, $wood, $clay, $iron, $crop, $mode) = $this->escape_input((int) $vid, (int) $wood, (int) $clay, (int) $iron, (int) $crop, $mode);

        $negativeResources = false;
        $checkres = $this->getOasisV($vid);

        if (!$mode) {
            $nwood = $checkres['wood'] - $wood;
            $nclay = $checkres['clay'] - $clay;
            $niron = $checkres['iron'] - $iron;
            $ncrop = $checkres['crop'] - $crop;

            $negativeResources = $nwood < 0 || $nclay < 0 || $niron < 0 || $ncrop < 0;

            $dwood = ($nwood < 0) ? 0 : $nwood;
            $dclay = ($nclay < 0) ? 0 : $nclay;
            $diron = ($niron < 0) ? 0 : $niron;
            $dcrop = ($ncrop < 0) ? 0 : $ncrop;
        } else {
            $nwood = $checkres['wood'] + $wood;
            $nclay = $checkres['clay'] + $clay;
            $niron = $checkres['iron'] + $iron;
            $ncrop = $checkres['crop'] + $crop;
            $dwood = ($nwood > $checkres['maxstore']) ? $checkres['maxstore'] : $nwood;
            $dclay = ($nclay > $checkres['maxstore']) ? $checkres['maxstore'] : $nclay;
            $diron = ($niron > $checkres['maxstore']) ? $checkres['maxstore'] : $niron;
            $dcrop = ($ncrop > $checkres['maxcrop']) ? $checkres['maxcrop'] : $ncrop;
        }

        if (!$negativeResources) {
            $q = "UPDATE " . TB_PREFIX . "odata SET wood = $dwood, clay = $dclay, iron = $diron, crop = $dcrop WHERE wref = ".$vid;
            return mysqli_query($this->dblink, $q);
        }
        else return false;     
   	}

    function getFieldLevelInVillage($vid, $fieldType, $use_cache = true) {
        $vid = (int) $vid;

        // first of all, check if we should be using cache and whether the field
        // required is already cached. NB: use isset() rather than the generic
        // returnCachedContent(), which treats a cached level of 0 as "empty" and
        // re-queries it on every call — buildings the village does not own
        // (level 0, very common) would otherwise never be cached.
        if ($use_cache && isset(self::$fieldLevelsInVillageSearchCache[$vid.$fieldType])) {
            return self::$fieldLevelsInVillageSearchCache[$vid.$fieldType];
        }

        // $fieldType can be both, integer and string, to be used in the IN statement,
        // so we need to handle it correctly here
        if (!Math::isInt($fieldType)) {
            $fieldType = $this->escape($fieldType);
        }

        // please don't scream...
        // with the current table structure, there really IS NOT another way
        // (except for stored procedures, which we can't rely on to be allowed on the server)
        $result = mysqli_query($this->dblink, 'SELECT '.
         'CASE '.
           'WHEN `f1t` IN ('.$fieldType.') THEN `f1` '.
           'WHEN `f2t` IN ('.$fieldType.') THEN `f2` '.
           'WHEN `f3t` IN ('.$fieldType.') THEN `f3` '.
           'WHEN `f4t` IN ('.$fieldType.') THEN `f4` '.
           'WHEN `f5t` IN ('.$fieldType.') THEN `f5` '.
           'WHEN `f6t` IN ('.$fieldType.') THEN `f6` '.
           'WHEN `f7t` IN ('.$fieldType.') THEN `f7` '.
           'WHEN `f8t` IN ('.$fieldType.') THEN `f8` '.
           'WHEN `f9t` IN ('.$fieldType.') THEN `f9` '.
           'WHEN `f10t` IN ('.$fieldType.') THEN `f10` '.
           'WHEN `f11t` IN ('.$fieldType.') THEN `f11` '.
           'WHEN `f12t` IN ('.$fieldType.') THEN `f12` '.
           'WHEN `f13t` IN ('.$fieldType.') THEN `f13` '.
           'WHEN `f14t` IN ('.$fieldType.') THEN `f14` '.
           'WHEN `f15t` IN ('.$fieldType.') THEN `f15` '.
           'WHEN `f16t` IN ('.$fieldType.') THEN `f16` '.
           'WHEN `f17t` IN ('.$fieldType.') THEN `f17` '.
           'WHEN `f18t` IN ('.$fieldType.') THEN `f18` '.
           'WHEN `f19t` IN ('.$fieldType.') THEN `f19` '.
           'WHEN `f20t` IN ('.$fieldType.') THEN `f20` '.
           'WHEN `f21t` IN ('.$fieldType.') THEN `f21` '.
           'WHEN `f22t` IN ('.$fieldType.') THEN `f22` '.
           'WHEN `f23t` IN ('.$fieldType.') THEN `f23` '.
           'WHEN `f24t` IN ('.$fieldType.') THEN `f24` '.
           'WHEN `f25t` IN ('.$fieldType.') THEN `f25` '.
           'WHEN `f26t` IN ('.$fieldType.') THEN `f26` '.
           'WHEN `f27t` IN ('.$fieldType.') THEN `f27` '.
           'WHEN `f28t` IN ('.$fieldType.') THEN `f28` '.
           'WHEN `f29t` IN ('.$fieldType.') THEN `f29` '.
           'WHEN `f30t` IN ('.$fieldType.') THEN `f30` '.
           'WHEN `f31t` IN ('.$fieldType.') THEN `f31` '.
           'WHEN `f32t` IN ('.$fieldType.') THEN `f32` '.
           'WHEN `f33t` IN ('.$fieldType.') THEN `f33` '.
           'WHEN `f34t` IN ('.$fieldType.') THEN `f34` '.
           'WHEN `f35t` IN ('.$fieldType.') THEN `f35` '.
           'WHEN `f36t` IN ('.$fieldType.') THEN `f36` '.
           'WHEN `f37t` IN ('.$fieldType.') THEN `f37` '.
           'WHEN `f38t` IN ('.$fieldType.') THEN `f38` '.
           'WHEN `f39t` IN ('.$fieldType.') THEN `f39` '.
           'WHEN `f40t` IN ('.$fieldType.') THEN `f40` '.
           'WHEN `f99t` IN ('.$fieldType.') THEN `f99` '.
           'ELSE 0 '.
         'END AS level '.
         'FROM `'.TB_PREFIX.'fdata` '.
         'WHERE '.
           '`vref` = '.$vid.' '.
           'AND ('.
          '`f1t` IN ('.$fieldType.') OR '.
          '`f2t` IN ('.$fieldType.') OR '.
          '`f3t` IN ('.$fieldType.') OR '.
          '`f4t` IN ('.$fieldType.') OR '.
          '`f5t` IN ('.$fieldType.') OR '.
          '`f6t` IN ('.$fieldType.') OR '.
          '`f7t` IN ('.$fieldType.') OR '.
          '`f8t` IN ('.$fieldType.') OR '.
          '`f9t` IN ('.$fieldType.') OR '.
          '`f10t` IN ('.$fieldType.') OR '.
          '`f11t` IN ('.$fieldType.') OR '.
          '`f12t` IN ('.$fieldType.') OR '.
          '`f13t` IN ('.$fieldType.') OR '.
          '`f14t` IN ('.$fieldType.') OR '.
          '`f15t` IN ('.$fieldType.') OR '.
          '`f16t` IN ('.$fieldType.') OR '.
          '`f17t` IN ('.$fieldType.') OR '.
          '`f18t` IN ('.$fieldType.') OR '.
          '`f19t` IN ('.$fieldType.') OR '.
          '`f20t` IN ('.$fieldType.') OR '.
          '`f20t` IN ('.$fieldType.') OR '.
          '`f21t` IN ('.$fieldType.') OR '.
          '`f22t` IN ('.$fieldType.') OR '.
          '`f23t` IN ('.$fieldType.') OR '.
          '`f24t` IN ('.$fieldType.') OR '.
          '`f25t` IN ('.$fieldType.') OR '.
          '`f26t` IN ('.$fieldType.') OR '.
          '`f27t` IN ('.$fieldType.') OR '.
          '`f28t` IN ('.$fieldType.') OR '.
          '`f29t` IN ('.$fieldType.') OR '.
          '`f30t` IN ('.$fieldType.') OR '.
          '`f30t` IN ('.$fieldType.') OR '.
          '`f31t` IN ('.$fieldType.') OR '.
          '`f32t` IN ('.$fieldType.') OR '.
          '`f33t` IN ('.$fieldType.') OR '.
          '`f34t` IN ('.$fieldType.') OR '.
          '`f35t` IN ('.$fieldType.') OR '.
          '`f36t` IN ('.$fieldType.') OR '.
          '`f37t` IN ('.$fieldType.') OR '.
          '`f38t` IN ('.$fieldType.') OR '.
          '`f39t` IN ('.$fieldType.') OR '.
          '`f40t` IN ('.$fieldType.') OR '.
          '`f99t` IN ('.$fieldType.')) '.
         'LIMIT 1');
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

        self::$fieldLevelsInVillageSearchCache[$vid.$fieldType] = isset($row['level']) ? (int)$row['level'] : 0;
        return self::$fieldLevelsInVillageSearchCache[$vid.$fieldType];
    }

	function getFieldLevel($vid, $field, $use_cache = true) {
	    list($vid, $field) = $this->escape_input((int) $vid, $field);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$resourceLevelsCache, $vid.$field)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

		$q = "SELECT f" . $field . " from " . TB_PREFIX . "fdata where vref = $vid LIMIT 1";
		$result = mysqli_query($this->dblink,$q);
        $row = $result ? mysqli_fetch_array($result, MYSQLI_ASSOC) : null;

        self::$resourceLevelsCache[$vid.$field] = (is_array($row) && array_key_exists("f".$field, $row)) ? (int)$row["f" . $field] : 0;
        return self::$resourceLevelsCache[$vid.$field];
	}

	function getSingleFieldTypeCount($uid, $field, $lvlComparisonSign = '=', $lvl = false, $use_cache = true) {
	    $uid = (int) $uid;
	    $field = (int) $field;
	    $lvl = ($lvl === false ? $lvl : (int) $lvl);

	    if (!in_array($lvlComparisonSign, ['=', '<', '>', '>=', '<=', '!='])) {
	        $lvlComparisonSign = '=';
	    }

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$singleFieldTypeCountCache, $uid.$field.$lvlComparisonSign.($lvl ? 1 : 0))) && !is_null($cachedValue)) {
            return $cachedValue;
        }

	    $q = "
            SELECT
            	Count(*) as Total
            FROM
            	".TB_PREFIX."fdata f
            	LEFT JOIN ".TB_PREFIX."vdata v ON f.vref = v.wref
                LEFT JOIN ".TB_PREFIX."users u ON v.owner = u.id
            WHERE
            	u.id = ".$uid."
                AND
                (
                    (f1t = ".$field.($lvl !== false ? ' AND f1 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f2t = ".$field.($lvl !== false ? ' AND f2 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f3t = ".$field.($lvl !== false ? ' AND f3 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f4t = ".$field.($lvl !== false ? ' AND f4 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f5t = ".$field.($lvl !== false ? ' AND f5 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f6t = ".$field.($lvl !== false ? ' AND f6 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f7t = ".$field.($lvl !== false ? ' AND f7 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f8t = ".$field.($lvl !== false ? ' AND f8 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f9t = ".$field.($lvl !== false ? ' AND f9 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f10t = ".$field.($lvl !== false ? ' AND f10 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f11t = ".$field.($lvl !== false ? ' AND f11 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f12t = ".$field.($lvl !== false ? ' AND f12 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f13t = ".$field.($lvl !== false ? ' AND f13 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f14t = ".$field.($lvl !== false ? ' AND f14 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f15t = ".$field.($lvl !== false ? ' AND f15 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f16t = ".$field.($lvl !== false ? ' AND f16 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f17t = ".$field.($lvl !== false ? ' AND f17 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f18t = ".$field.($lvl !== false ? ' AND f18 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f19t = ".$field.($lvl !== false ? ' AND f19 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f20t = ".$field.($lvl !== false ? ' AND f20 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f21t = ".$field.($lvl !== false ? ' AND f21 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f22t = ".$field.($lvl !== false ? ' AND f22 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f23t = ".$field.($lvl !== false ? ' AND f23 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f24t = ".$field.($lvl !== false ? ' AND f24 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f25t = ".$field.($lvl !== false ? ' AND f25 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f26t = ".$field.($lvl !== false ? ' AND f26 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f27t = ".$field.($lvl !== false ? ' AND f27 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f28t = ".$field.($lvl !== false ? ' AND f28 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f29t = ".$field.($lvl !== false ? ' AND f29 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f30t = ".$field.($lvl !== false ? ' AND f30 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f31t = ".$field.($lvl !== false ? ' AND f31 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f32t = ".$field.($lvl !== false ? ' AND f32 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f33t = ".$field.($lvl !== false ? ' AND f33 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f34t = ".$field.($lvl !== false ? ' AND f34 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f35t = ".$field.($lvl !== false ? ' AND f35 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f36t = ".$field.($lvl !== false ? ' AND f36 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f37t = ".$field.($lvl !== false ? ' AND f37 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f38t = ".$field.($lvl !== false ? ' AND f38 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f39t = ".$field.($lvl !== false ? ' AND f39 '.$lvlComparisonSign.' '.$lvl : '').")
                    OR (f40t = ".$field.($lvl !== false ? ' AND f40 '.$lvlComparisonSign.' '.$lvl : '').")
                )";

	    $result = mysqli_query($this->dblink,$q);
	    $row = mysqli_fetch_array($result);

        self::$singleFieldTypeCountCache[$uid.$field.$lvlComparisonSign.($lvl ? 1 : 0)] = $row["Total"];
        return self::$singleFieldTypeCountCache[$uid.$field.$lvlComparisonSign.($lvl ? 1 : 0)];
	}

	function getFieldType($vid, $field, $use_cache = true) {
	    list($vid, $field) = $this->escape_input((int) $vid, $field);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$fieldTypeCache, $vid.$field)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

	    if ($field && $vid) {
    		$q = "SELECT f" . $field . "t from " . TB_PREFIX . "fdata where vref = $vid LIMIT 1";
    		$result = mysqli_query($this->dblink,$q);
    		$row = mysqli_fetch_array($result);
            self::$fieldTypeCache[$vid.$field] = $row["f" . $field . "t"];
	    } else {
            self::$fieldTypeCache[$vid.$field] = 0;
	    }

	    return self::$fieldTypeCache[$vid.$field];
	}

	// no need to cache this method
	function getFieldDistance($wid) {
	    list($wid) = $this->escape_input((int) $wid);

        $array = $this->getProfileVillages($wid, 3);
        $coor = $this->getCoor($wid);
        $x1 = intval($coor['x']);
        $y1 = intval($coor['y']);
        $prevdist = 0;
        $array2 = $this->getVillage(0, 4);
        $vill = $array2['wref'];

        if ($array && count($array)){
            foreach($array as $village){
                $coor2 = $this->getCoor($village['wref']);
                $max = 2 * WORLD_MAX + 1;
                $x2 = intval($coor2['x']);
                $y2 = intval($coor2['y']);
                $distanceX = min(abs($x2 - $x1), abs($max - abs($x2 - $x1)));
                $distanceY = min(abs($y2 - $y1), abs($max - abs($y2 - $y1)));
                $dist = sqrt(pow($distanceX, 2) + pow($distanceY, 2));
                if($dist < $prevdist or $prevdist == 0){
                    $prevdist = $dist;
                    $vill = $village['wref'];
                }
            }
        }
        return $vill;
    }

    function updateVSumField($field) {
        list($field) = $this->escape_input($field);

        //fix by ronix
        if (SPEED >10) {
            $speed = 10;
        } else {
            $speed = SPEED;
        }

        // cultural points to gain during a day
        $dur_day = (86400/SPEED);

        if ($dur_day < 3600) {
            $dur_day = 3600;
        }

        $q = "
            UPDATE " . TB_PREFIX . "users as users
                SET cp = cp + (
                        ( SELECT sum($field) FROM " . TB_PREFIX . "vdata as vdata WHERE vdata.owner = users.id ".($field == 'cp' ? ' AND vdata.natar = 0' : '')." ) *
                        (UNIX_TIMESTAMP() - lastupdate) / $dur_day
                    ),
                    lastupdate = UNIX_TIMESTAMP()
                WHERE
                    lastupdate < (UNIX_TIMESTAMP() - 600)
        "; // recount every 10 minutes

        mysqli_query($this->dblink, $q);
    }

    function getVSumField($uid, $field, $use_cache = true) {
        list($field) = $this->escape_input($field);

        $array_passed = is_array($uid);
        if (!$array_passed) {
            $uid = [(int) $uid];
        } else {
            foreach ($uid as $index => $uidValue) {
                $uid[$index] = (int) $uidValue;
            }
        }

        if (!count($uid)) {
            return [];
        }

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && !$array_passed && ($cachedValue = self::returnCachedContent(self::$userSumFieldCache, $uid[0].$field)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

        if($field != "cp"){
            $q = "SELECT owner, MIN(lastupdate), SUM(" . $field . ") as Total FROM " . TB_PREFIX . "vdata where owner IN(".implode(', ', $uid).") GROUP BY owner";
        }else{
            $q = "SELECT owner, MIN(lastupdate), SUM(" . $field . ") as Total FROM " . TB_PREFIX . "vdata where owner IN(".implode(', ', $uid).") and natar = 0 GROUP BY owner";
        }

        $result = mysqli_query($this->dblink,$q);

        // return a single value
        if (!$array_passed) {
            $row = mysqli_fetch_row( $result );
            self::$userSumFieldCache[$row[0].$field] = $row[2];
        } else {
            $result = $this->mysqli_fetch_all($result);
            if ($result && count($result)) {
                foreach ( $result as $record ) {
                    self::$userSumFieldCache[ $record['owner'] . $field ] = $record['Total'];
                }
            }
        }

        return ($array_passed ? $result : self::$userSumFieldCache[$uid[0].$field]);
    }

    function updateVillage($vid) {
        list($vid) = $this->escape_input((int) $vid);

        $time = time();
        $q = "UPDATE " . TB_PREFIX . "vdata set lastupdate = $time where wref = $vid";
        return mysqli_query($this->dblink,$q);
    }


    function updateOasis($vid) {
        list($vid) = $this->escape_input((int) $vid);

        $time = time();
        $q = "UPDATE " . TB_PREFIX . "odata set lastupdated = $time where wref = $vid";
        return mysqli_query($this->dblink,$q);
    }

	function setVillageName($vid, $name) {
    $vid = (int)$vid;
    $name = trim($name);
    if ($name === '') return false;
    $name = mb_substr($name, 0, 30, 'UTF-8');

    $stmt = $this->dblink->prepare(
        "UPDATE `".TB_PREFIX."vdata` SET name = ? WHERE wref = ? LIMIT 1"
    );
    $stmt->bind_param("si", $name, $vid);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
	}

    /**
     * Recalculeaza capacitatea de depozitare a unui sat din cladirile lui.
     *
     * Aceeasi regula ca recalcularea periodica din Automation::updateStore():
     * se aduna `attri` * STORAGE_MULTIPLIER pentru fiecare depozit/hambar
     * (normal si mare) din sloturile f19..f39, cu prag minim STORAGE_BASE.
     *
     * De ce recalculare, nu scadere incrementala: `attri` este capacitatea
     * TOTALA la acel nivel (1200, 1700, 2300...), nu incrementul. Scaderea
     * folosita la demolare lua toata valoarea nivelului si ignora si
     * STORAGE_MULTIPLIER, deci taia prea mult - efect mascat de pragul minim.
     * Recalcularea nu poate ramane in urma, indiferent ce s-a schimbat.
     */
    function recalculateStorage($wid) {
        $wid = (int) $wid;

        global $bid10, $bid11, $bid38, $bid39;

        $fdata = $this->getResourceLevel($wid, false);

        if (!$fdata) {
            return false;
        }

        $multiplier = defined('STORAGE_MULTIPLIER') ? STORAGE_MULTIPLIER : 1;
        $base       = defined('STORAGE_BASE') ? STORAGE_BASE : 0;

        $store = 0;
        $crop  = 0;

        $map = array(
            10 => array('store', $bid10),
            38 => array('store', $bid38),
            11 => array('crop',  $bid11),
            39 => array('crop',  $bid39),
        );

        for ($i = 19; $i < 40; $i++) {
            $type  = isset($fdata['f' . $i . 't']) ? (int) $fdata['f' . $i . 't'] : 0;
            $level = isset($fdata['f' . $i])       ? (int) $fdata['f' . $i]       : 0;

            if (!isset($map[$type]) || $level <= 0) {
                continue;
            }

            list($target, $data) = $map[$type];

            if (!isset($data[$level]['attri'])) {
                continue;
            }

            $amount = $data[$level]['attri'] * $multiplier;

            if ($target === 'store') {
                $store += $amount;
            } else {
                $crop += $amount;
            }
        }

        if ($store < $base) { $store = $base; }
        if ($crop  < $base) { $crop  = $base; }

        $result = mysqli_query(
            $this->dblink,
            "UPDATE " . TB_PREFIX . "vdata
                SET maxstore = " . (int) $store . ", maxcrop = " . (int) $crop . "
              WHERE wref = " . $wid
        );

        // randul de sat s-a schimbat: urmatoarea citire trebuie sa vina din DB
        unset(self::$villageFieldsCache[$wid . '0'], self::$villageFieldsCache[$wid . '3']);

        return $result;
    }

    function modifyPop($vid, $pop, $mode) {
        list($vid, $pop, $mode) = $this->escape_input((int) $vid, (int) $pop, $mode);

        if(!$mode) {
            $q = "UPDATE " . TB_PREFIX . "vdata set pop = pop + $pop where wref = $vid";
        } else {
            $q = "UPDATE " . TB_PREFIX . "vdata set pop = pop - $pop where wref = $vid";
        }
        return mysqli_query($this->dblink,$q);
    }

    function addCP($ref, $cp) {
        list($ref, $cp) = $this->escape_input((int) $ref, (int) $cp);

        $q = "UPDATE " . TB_PREFIX . "vdata set cp = cp + $cp where wref = $ref";
        return mysqli_query($this->dblink,$q);
    }

    function addCel($ref, $cel, $type) {
        list($ref, $cel, $type) = $this->escape_input((int) $ref, (int) $cel, (int) $type);

        $q = "UPDATE " . TB_PREFIX . "vdata set celebration = $cel, type= $type where wref = $ref";
        return mysqli_query($this->dblink,$q);
    }

    // no need to cache this method
    function getCel() {
        return $this->getProfileVillages(time(), 4);
    }

    function clearCel($ref) {
        list($ref) = $this->escape_input((int) $ref);

        $q = "UPDATE " . TB_PREFIX . "vdata set celebration = 0, type = 0 where wref = $ref";
        return mysqli_query($this->dblink,$q);
    }

    function setCelCp($user, $cp) {
        list($user, $cp) = $this->escape_input((int) $user, (int) $cp);

        $q = "UPDATE " . TB_PREFIX . "users set cp = cp + $cp where id = $user";
        return mysqli_query($this->dblink,$q);
    }

    /**
     * Mead-Festival (Brewery, building 35 — Teutons only).
     * Mirrors addCel()/getCel()/clearCel() above, but the festival grants no
     * culture points: it only gates the temporary combat bonus, the chief
     * persuasion penalty and the catapult randomization while it is active.
     */
    function addFestival($ref, $end) {
        list($ref, $end) = $this->escape_input((int) $ref, (int) $end);

        $q = "UPDATE " . TB_PREFIX . "vdata set festival = $end where wref = $ref";
        return mysqli_query($this->dblink,$q);
    }

    // no need to cache this method
    function getFestivals() {
        $q = "SELECT * FROM " . TB_PREFIX . "vdata WHERE festival < " . time() . " AND festival != 0";
        $result = mysqli_query($this->dblink,$q);
        return $this->mysqli_fetch_all($result);
    }

    function clearFestival($ref) {
        list($ref) = $this->escape_input((int) $ref);

        $q = "UPDATE " . TB_PREFIX . "vdata set festival = 0 where wref = $ref";
        return mysqli_query($this->dblink,$q);
    }

    /**
     * Delete a single village or multiple ones
     *
     * @param mixed $wref The Village ID(s)
     */
    
    function DelVillage($wref){
        list($wref) = $this->escape_input($wref);
        global $units;
        
        //Check if we've to delete a single village or multiple ones
        if(!is_array($wref)) $wref = [$wref];
        
        //Create the list of village IDs
        $wrefs = implode(", ", $wref);        
        
        $this->clearExpansionSlot($wref);
        $q = "DELETE FROM ".TB_PREFIX."abdata where vref IN($wrefs)";
        $this->query($q);
        $q = "DELETE FROM ".TB_PREFIX."bdata where wid IN($wrefs)";
        $this->query($q);
        $q = "DELETE FROM ".TB_PREFIX."market where vref IN($wrefs)";
        $this->query($q);
        $q = "DELETE FROM ".TB_PREFIX."research where vref IN($wrefs)";
        $this->query($q);
        $q = "DELETE FROM ".TB_PREFIX."tdata where vref IN($wrefs)";
        $this->query($q);
        $q = "DELETE FROM ".TB_PREFIX."fdata where vref IN($wrefs)";
        $this->query($q);
        $q = "DELETE FROM ".TB_PREFIX."training where vref IN($wrefs)";
        $this->query($q);
        $q = "DELETE FROM ".TB_PREFIX."units where vref IN($wrefs)";
        $this->query($q);
        $q = "DELETE FROM ".TB_PREFIX."farmlist where wref IN($wrefs)";
        $this->query($q);
        $q = "UPDATE ".TB_PREFIX."artefacts SET del = 1 where vref IN($wrefs)";
        $this->query($q);
        $q = "DELETE FROM ".TB_PREFIX."raidlist where towref IN($wrefs)";
        $this->query($q);
        $q = "DELETE FROM ".TB_PREFIX."route where wid IN($wrefs) OR `from` IN($wrefs)";
        $this->query($q);
        $q = "DELETE FROM ".TB_PREFIX."movement where proc = 0 AND ((`to` IN($wrefs) AND sort_type = 4) OR (`from` IN($wrefs) AND sort_type = 3))";
        $this->query($q);
        $this->removeOases($wref, 1);

        // In-flight attacks still heading for the deleted village(s) must be
        // bounced straight home. Query them directly instead of using
        // getMovement(3, $wref, 1): when passed an array, getMovement() returns
        // the WHOLE movement cache (a map of "type.village.mode" => record list),
        // not the flat record list this loop expects — so $movedata['moveid'] /
        // ['starttime'] were NULL and the follow-up waves were never bounced,
        // leaving them stuck at sort_type=3/proc=0 and looping forever once the
        // village is gone. Pre-dates the sendunitsComplete() split (issue #298).
        $q = "SELECT * FROM ".TB_PREFIX."movement, ".TB_PREFIX."attacks
              WHERE ".TB_PREFIX."movement.`to` IN($wrefs)
                AND ".TB_PREFIX."movement.ref = ".TB_PREFIX."attacks.id
                AND ".TB_PREFIX."movement.proc = 0
                AND ".TB_PREFIX."movement.sort_type = 3
              ORDER BY endtime ASC";
        $getmovement = $this->mysqli_fetch_all(mysqli_query($this->dblink, $q));

        $moveIDs = [];
        $time = microtime(true);
        $types = [];
        $froms = [];
        $tos = [];
        $refs = [];
        $times = [];
        $endtimes = [];
        
        foreach($getmovement as $movedata) {
            $time2 = $time - $movedata['starttime'];
            $moveIDs[] = $movedata['moveid'];
            $types[] = 4;
            $froms[] = $movedata['to'];
            $tos[] = $movedata['from'];
            $refs[] = $movedata['ref'];
            $times[] = $time;
            $endtimes[] = $time+$time2;
        }
        
        $this->setMovementProc(implode(', ', $moveIDs));
        $this->addMovement($types, $froms, $tos, $refs, $times, $endtimes);
        
        $q = "DELETE FROM ".TB_PREFIX."enforcement WHERE `from` IN($wrefs)";
        $this->query($q);
        
        //check return enforcement from del village
        foreach($wref as $w) $units->returnTroops($w);

        $q = "DELETE FROM ".TB_PREFIX."vdata WHERE `wref` IN($wrefs)";
        $this->query($q);
        
        if (mysqli_affected_rows($this->dblink) > 0) {
            $q = "UPDATE ".TB_PREFIX."wdata set occupied = 0 where id IN($wrefs)";
            $this->query($q);
            
            // clear expansion slots, if this village is an expansion of any other village
            $this->clearExpansionSlot($wref, 1);
            
            // HOTFIX warning-uri t1..t11/wref/id: pe calea cu array + cache plin,
            // getPrisoners() intoarce INTREGUL cache (inclusiv intrari goale [] pentru
            // sate fara prizonieri), nu doar satele cerute - de aici cheile lipsa.
            // Gardam randurile incomplete; pentru randurile valide comportamentul e identic.
            // ANOMALIE de urmarit separat: "return self::$prisonersCache" din getPrisoners()
            // poate livra si prizonierii ALTOR sate decat cele cerute.
            $getprisoners = $this->getPrisoners($wref);
            foreach($getprisoners as $pris) {
                if (!is_array($pris) || !isset($pris['wref'], $pris['id'])) continue;
                $troops = 0;
                for($i = 1; $i < 12; $i++) $troops += (int) ($pris['t'.$i] ?? 0);
                $this->modifyUnit($pris['wref'], ["99o"], [$troops], [0]);
                $this->deletePrisoners($pris['id']);
            }
            
            $getprisoners = $this->getPrisoners($wref, 1);
            foreach($getprisoners as $pris) {
                if (!is_array($pris) || !isset($pris['wref'], $pris['id'])) continue;
                $troops = 0;
                for($i = 1; $i < 12; $i++) $troops += (int) ($pris['t'.$i] ?? 0);
                $this->modifyUnit($pris['wref'], ["99o"], [$troops], [0]);
                $this->deletePrisoners($pris['id']);
            }
        }
    }
    
    /**
     * Clear the expansion slots of a specified village(s)
     * 
     * @param mixed $id The village ID(s)
     * @param number $mode 0 If there's the need to clear all expansion slots of a village,
     *        1 if there's the need to clear a single expansion slot of a village 
     */
    
	function clearExpansionSlot($id, $mode = 0) {
    // acceptă int sau array, fără (int) pe array
    if(!is_array($id)) {
        $id = [$id];
    }
    // curățare sigură – doar numere
    $id = array_map('intval', $id);
    $ids = implode(",", $id);
    
    if(!$ids) return;
    
    if(!$mode){ 
        // ștergem sloturile DIN satul care se distruge
        $pairs = [];
        for($i = 1; $i <= 3; $i++) $pairs[] = 'exp'.$i.' = 0';
        $q = "UPDATE ".TB_PREFIX."vdata SET ".implode(',', $pairs)." WHERE wref IN($ids)";
    }else{
        // ștergem referința DIN satul părinte
        $q = "
            UPDATE ".TB_PREFIX."vdata
            SET
                exp1 = IF(exp1 IN($ids), 0, exp1),
                exp2 = IF(exp2 IN($ids), 0, exp2),
                exp3 = IF(exp3 IN($ids), 0, exp3)
            WHERE
                exp1 IN($ids) OR
                exp2 IN($ids) OR
                exp3 IN($ids)";
			}
		mysqli_query($this->dblink, $q);
	}

	function getVillageByName($name, $use_cache = true) {
        return $this->getVillage($name, 1, $use_cache)['wref'];
	}

	/**
	 * Build the village-name autocomplete suggestions for the rally point and
	 * the marketplace, honouring the player's auto-completion preferences
	 * (issue #198):
	 *   v1 -> own villages
	 *   v2 -> villages in the surroundings of the active village
	 *   v3 -> villages of the player's alliance members
	 * System accounts (Nature, Natars, Multihunter, ...) are excluded.
	 *
	 * @param int $uid      Player id (own villages / self).
	 * @param int $alliance Player's alliance id (0 = none).
	 * @param int $x        Active village X coordinate (vicinity center).
	 * @param int $y        Active village Y coordinate (vicinity center).
	 * @param bool $v1      Include own villages.
	 * @param bool $v2      Include surrounding villages.
	 * @param bool $v3      Include alliance villages.
	 * @param int $radius   Vicinity radius in fields (v2).
	 * @param int $limit    Max number of names returned.
	 * @return string[]     Distinct village names.
	 */
	function getAutoCompleteVillages($uid, $alliance, $x, $y, $v1, $v2, $v3, $radius = 25, $limit = 100) {
		$uid      = (int) $uid;
		$alliance = (int) $alliance;
		$x        = (int) $x;
		$y        = (int) $y;
		$radius   = (int) $radius;
		$limit    = (int) $limit;

		$joins = "JOIN " . TB_PREFIX . "users u ON u.id = v.owner ";
		$conds = [];

		if ($v1) {
			$conds[] = "v.owner = $uid";
		}
		if ($v3 && $alliance > 0) {
			$conds[] = "u.alliance = $alliance";
		}
		if ($v2) {
			$joins  .= "JOIN " . TB_PREFIX . "wdata w ON w.id = v.wref ";
			$conds[] = "(ABS(w.x - $x) <= $radius AND ABS(w.y - $y) <= $radius)";
		}

		if (!count($conds)) {
			return [];
		}

		$q = "SELECT DISTINCT v.name FROM " . TB_PREFIX . "vdata v " .
			$joins .
			"WHERE u.id > 5 AND (" . implode(' OR ', $conds) . ") " .
			"ORDER BY v.name LIMIT $limit";

		$result = mysqli_query($this->dblink, $q);
		$names  = [];
		if ($result) {
			while ($row = mysqli_fetch_assoc($result)) {
				$names[] = $row['name'];
			}
		}
		return $names;
	}

    function getVillageByOwner($uid, $use_cache = true) {
        $uid = (int) $uid;

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$villageDataByOwnerCache, $uid)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

        $q = 'SELECT * FROM `' . TB_PREFIX . 'vdata` WHERE `owner` = ' . $uid . ' LIMIT 1';
        $result = mysqli_fetch_array(mysqli_query($this->dblink,$q), MYSQLI_ASSOC);

        self::$villageDataByOwnerCache[$uid] = $result;
        return self::$villageDataByOwnerCache[$uid];
    }

	//MARKET FIXES
	function getWoodAvailable($wref, $use_cache = true) {
        // return from cache
        return $this->getVillage($wref, 0, $use_cache)['wood'];
	}

	function getClayAvailable($wref, $use_cache = true) {
        // return from cache
        return $this->getVillage($wref, 0, $use_cache)['clay'];
	}

	function getIronAvailable($wref, $use_cache = true) {
        // return from cache
        return $this->getVillage($wref, 0, $use_cache)['iron'];
	}

	function getCropAvailable($wref, $use_cache = true) {
        // return from cache
        return $this->getVillage($wref, 0, $use_cache)['crop'];
	}

	function Getowner($vid) {
        // return from cache
        return $this->getVillage($vid, 0, $use_cache)['owner'];
	}
	

    // no need to cache, not used in any loops or more than once for each page load
	public function getAvailableExpansionTraining() {
		global $building, $session, $technology, $village;

    $vilData = $this->getVillage($village->wid);
    $maxslots = (($vilData['exp1'] == 0 ? 1 : 0) + ($vilData['exp2'] == 0 ? 1 : 0) + ($vilData['exp3'] == 0 ? 1 : 0));
    $residence = $building->getTypeLevel(25);
    $palace = $building->getTypeLevel(26);

    if($residence > 0) {
        $maxslots -= (3 - floor($residence / 10));
    }

    if($palace > 0) {
        $maxslots -= (3 - floor(($palace - 5) / 5));
    }

    // Command Center (Huni) - sloturi de expansiune ca Residence (nivel 10/20)
    $commandcenter = $building->getTypeLevel(44);
    if($commandcenter > 0) {
        $maxslots -= (3 - floor($commandcenter / 10));
    }

    // Units at home
    $q = "SELECT (u10+u20+u30+u60+u70+u80+u90) as R1, (u9+u19+u29+u59+u69+u79+u89) as R2
          FROM " . TB_PREFIX . "units
          WHERE vref = " . (int)$village->wid;
    $result = mysqli_query($this->dblink,$q);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $settlers = (int)$row['R1'];
    $chiefs   = (int)$row['R2'];

    // Movements
    $settlers += 3 * count($this->getMovement(5, $village->wid, 0));

    $current_movement = $this->getMovement(3, $village->wid, 0);
    if(!empty($current_movement)) {
        foreach($current_movement as $build) {
            $settlers += (int)$build['t10'];
            $chiefs   += (int)$build['t9'];
        }
    }

    $current_movement = $this->getMovement(4, $village->wid, 1);
    if(!empty($current_movement)) {
        foreach($current_movement as $build) {
            $settlers += (int)$build['t10'];
            $chiefs   += (int)$build['t9'];
        }
    }

    // FIX: Count ALL reinforcements properly (SUM over ALL rows)
    $q = "SELECT COALESCE(SUM(u10+u20+u30+u60+u70+u80+u90),0) AS s
          FROM " . TB_PREFIX . "enforcement
          WHERE `from` = " . (int)$village->wid;
    $result = mysqli_query($this->dblink,$q);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $settlers += (int)$row['s'];

    $q = "SELECT COALESCE(SUM(u9+u19+u29+u59+u69+u79+u89),0) AS c
          FROM " . TB_PREFIX . "enforcement
          WHERE `from` = " . (int)$village->wid;
    $result = mysqli_query($this->dblink,$q);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $chiefs += (int)$row['c'];

    // Training queue (your existing logic)
    $trainlist = $technology->getTrainingList(4);
    if(!empty($trainlist)) {
        foreach($trainlist as $train) {
            if($train['unit'] % 10 == 0) {
                $settlers += (int)$train['amt'];
            }
            if($train['unit'] % 10 == 9) {
                $chiefs += (int)$train['amt'];
            }
        }
    }

    // Trapped troops
    $trappedTroops = $this->getPrisoners($village->wid, 1);
    if(!empty($trappedTroops)){
        foreach($trappedTroops as $trapped){
            $settlers += (int)$trapped['t10'];
            $chiefs   += (int)$trapped['t9'];
        }
    }

    // Slot math (unchanged, but clamp to 0 to avoid negatives)
    $settlerslots = ($maxslots * 3) - ($chiefs * 3) - $settlers;
    $chiefslots   = $maxslots - $chiefs - floor(($settlers + 2) / 3);

    if(!$technology->getTech(($session->tribe - 1) * 10 + 9)) {
        $chiefslots = 0;
    }

    if ($settlerslots < 0) $settlerslots = 0;
    if ($chiefslots < 0) $chiefslots = 0;

    return ["chiefs" => $chiefslots, "settlers" => $settlerslots];
}

    // no need to cache this method
	function getArrayMemberVillage($uid) {
	    list($uid) = $this->escape_input((int) $uid);
		$q = 'SELECT a.wref, a.name, b.x, b.y from '.TB_PREFIX.'vdata AS a left join '.TB_PREFIX.'wdata AS b ON b.id = a.wref where owner = '.$uid.' ORDER BY name ASC';
		$result = mysqli_query($this->dblink,$q);
		$array = $this->mysqli_fetch_all($result);
		return $array;
	}

	function getCropProdstarv($wref, $use_cache = true) {
	    global $bid4, $bid8, $bid9, $technology;

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$cropProductionStarvationValueCache, $wref)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

        $basecrop = $grainmill = $bakery = $cropo = 0;
		$owner = $this->getVrefField($wref, 'owner', $use_cache);
		$bonus = $this->getUserField($owner, 'b4', 0);

		$buildarray = $this->getResourceLevel($wref);
		$cropholder = [];
		for($i = 1; $i <= 38; $i++){
			if($buildarray['f'.$i.'t'] == 4) array_push($cropholder, 'f'.$i);
			if($buildarray['f'.$i.'t'] == 8) $grainmill = $buildarray['f'.$i];
			if($buildarray['f'.$i.'t'] == 9) $bakery = $buildarray['f'.$i];
		}
		
		$q = "SELECT type FROM `" . TB_PREFIX . "odata` WHERE conqured = ".(int) $wref;
		$oasis = $this->query_return($q);
		foreach($oasis as $oa){
			switch($oa['type']) {
                case 3:
                case 6:
                case 9:
                case 10:
                case 11:
                    $cropo++;
                    break;
                case 12:
                    $cropo += 2;
                    break;
			}
		}
		
        for($i = 0; $i <= count($cropholder) - 1; $i++){
			$basecrop += $bid4[$buildarray[$cropholder[$i]]]['prod'];
		}
		
		$crop = $basecrop + $basecrop * 0.25 * $cropo;
		
		if($grainmill >= 1 || $bakery >= 1){
			$crop += $basecrop / 100 * ((isset($bid8[$grainmill]['attri']) ? $bid8[$grainmill]['attri'] : 0) + (isset($bid9[$bakery]['attri']) ? $bid9[$bakery]['attri'] : 0));
		}
		if($bonus > time()) $crop *= 1.25;

		$crop *= SPEED;

        self::$cropProductionStarvationValueCache[$wref] = $crop;
        return self::$cropProductionStarvationValueCache[$wref];
	}

	/**
	 * Adds the starvation data in villages with a negative value of crop
	 *
	 * @param int $wref The village ID where the crop is negative
	 */
	
	public function addStarvationData($wref){
	    global $technology;
	    
	    $getVillage = $this->getVillage($wref);
		
		 // FIX: dacă satul nu există, ieși imediat
		if (!$getVillage || !is_array($getVillage)) {
        return;
		}
	    
	    //Exlude Support, Nature, Natars, TaskMaster and Multihunter
	    if (($getVillage['owner'] ?? 0) > 5){
	        $crop = $this->getCropProdstarv($wref, false);
	        $unitArrays = $technology->getAllUnits($wref, false, 0, false);
	        $villageUpkeep = $getVillage['pop'] + $technology->getUpkeep($unitArrays, 0, $wref);
	        $starv = $getVillage['starv'];
	        
	        if ($crop < $villageUpkeep){
	            //Add starvation data
	            $fields = ['starv'];
	            $values = [$villageUpkeep];
	            
	            //Update the starvupdate if it's set to 0
	            if($getVillage['starvupdate'] == 0) {
	                $fields[] = 'starvupdate';
	                $values[] = time();
	            }

	            //Update the starvation datas
	            $this->setVillageFields($wref, $fields, $values);
	        }
	    }
	}


    /**
     * Changed the actual capital with a new one
     * 
     * @param int $wref The village ID that will became the new capital
     * @return bool Return true if the query was successful, false otherwise
     */
	
    function changeCapital($wref, $mode = 1){
    	list($wref, $mode) = $this->escape_input($wref, $mode);

    	if ($mode == 1) {
    	    // Bug fix: this function only ever did `SET capital = $mode WHERE
    	    // wref = $wref` — it set the NEW capital's flag but never cleared
    	    // any OTHER village belonging to the same owner that was already
    	    // flagged capital = 1. Nothing enforces uniqueness at the schema
    	    // level (no UNIQUE key on owner+capital), so after any capital
    	    // change that doesn't delete the old village, the owner was left
    	    // with two (or more) rows with capital = 1. This was harmless for
    	    // years because nothing queried "owner=X AND capital=1" expecting
    	    // a single row — until getVillage(..., 3) (added for the Brewery
    	    // Mead-Festival empire-wide bonus lookup) started relying on that
    	    // invariant, at which point a stale duplicate could be the row
    	    // returned (no ORDER BY / LIMIT 1 on an ambiguous match), silently
    	    // pointing Brewery's bonus/penalty checks at the wrong village.
    	    $owner = $this->getVillageField($wref, 'owner');
    	    if ($owner !== false && $owner !== null) {
    	        $owner = (int) $owner;
    	        $q = "UPDATE " . TB_PREFIX . "vdata SET capital = 0 WHERE owner = $owner AND wref != $wref";
    	        mysqli_query($this->dblink, $q);
    	    }
    	}

    	$q = "UPDATE ".TB_PREFIX."vdata SET capital = ".$mode." WHERE wref = $wref";
    	return mysqli_query($this->dblink, $q);
    }
}
