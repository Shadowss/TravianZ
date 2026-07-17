<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ                                                    ##
##  Filename:      DatabaseMarketQueries.php                                   ##
##  Split&Refactor Shadow                                                      ##
##  Purpose:       Marketplace, offers, trade routes, merchants                ##
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

trait DatabaseMarketQueries {


	//fix market log
	function getMarketLog() {
        	$q = "SELECT id,wid,log from " . TB_PREFIX . "market_log where id != 0 ORDER BY id ASC";
        	$result = mysqli_query($this->dblink,$q);
        	return $this->mysqli_fetch_all($result);
	}

	function getMarketLogVillage($village) {
	    list($village) = $this->escape_input((int) $village);

		$q = "SELECT wref,owner,name from " . TB_PREFIX . "vdata where wref =$village ";
        	$result = mysqli_query($this->dblink,$q);
        	return $this->mysqli_fetch_all($result);
        }
	function getMarketLogUsers($id_user) {
	    list($id_user) = $this->escape_input((int) $id_user);

        	$q = "SELECT id,username from " . TB_PREFIX . "users where id = $id_user ";
        	$result = mysqli_query($this->dblink,$q);
        	return $this->mysqli_fetch_all($result);
        }

    /**
    * Delete expired trade routes
    * 
    */
	
	function delTradeRoute() {
	    $time = time();
	    $q = "DELETE from " . TB_PREFIX . "route where timeleft < $time";
	    return mysqli_query($this->dblink, $q);
	}
	
	function createTradeRoute($uid,$wid,$from,$r1,$r2,$r3,$r4,$start,$deliveries,$merchant,$time) {
	    list($uid,$wid,$from,$r1,$r2,$r3,$r4,$start,$deliveries,$merchant,$time) = $this->escape_input((int) $uid,(int) $wid,(int) $from,(int) $r1,(int) $r2,(int) $r3,(int) $r4,(int) $start,(int) $deliveries,(int) $merchant,(int) $time);

	    $x = "UPDATE " . TB_PREFIX . "users SET gold = gold - 2 WHERE id = " . $uid;
        mysqli_query( $this->dblink, $x );
        $timeleft = time() + 604800;
        $q        = "INSERT into " . TB_PREFIX . "route values (0,$uid,$wid,$from,$r1,$r2,$r3,$r4,$start,$deliveries,$merchant,$time,$timeleft)";

        return mysqli_query( $this->dblink, $q );
	}

    // no need to cache this method
	function getTradeRoute($from) {
	    list($from) = $this->escape_input((int) $from);

	    $q = "SELECT * FROM " . TB_PREFIX . "route where `from` = $from ORDER BY timestamp ASC";
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

    // no need to cache this method
	function getTradeRoute2($id) {
	    list($id) = $this->escape_input((int) $id);

		$q = "SELECT * FROM " . TB_PREFIX . "route where id = $id LIMIT 1";
		$result = mysqli_query($this->dblink,$q);
		$dbarray = mysqli_fetch_array($result);
		return $dbarray;
	}

    // no need to cache this method
	function getTradeRouteUid($id) {
	    list($id) = $this->escape_input((int) $id);

		$q = "SELECT uid FROM " . TB_PREFIX . "route where id = $id LIMIT 1";
		$result = mysqli_query($this->dblink,$q);
		$dbarray = mysqli_fetch_array($result);
		return $dbarray['uid'];
	}

	function editTradeRoute($id,$column,$value,$mode) {
	    list($id,$column,$value,$mode) = $this->escape_input((int) $id,$column,(int) $value,$mode);

        if ( ! $mode ) {
            $q = "UPDATE " . TB_PREFIX . "route set $column = $value where id = $id";
        } else {
            $q = "UPDATE " . TB_PREFIX . "route set $column = $column + $value where id = $id";
        }

        return mysqli_query( $this->dblink, $q );
	}

	function deleteTradeRoute($id) {
	    list($id) = $this->escape_input((int) $id);

		$q = "DELETE FROM " . TB_PREFIX . "route where id = $id";
		return mysqli_query($this->dblink,$q);
	}
	
	function deleteTradeRoutesByVillage($id) {
	    list($id) = $this->escape_input((int) $id);

		$q = "DELETE FROM " . TB_PREFIX . "route where `from` = $id";
		return mysqli_query($this->dblink,$q);
	}

	/***************************
	Function to set accept flag on market
	References: id
	***************************/
	function setMarketAcc($id) {
        if (!is_array($id)) {
            $id = [$id];
        }

        foreach ($id as $index => $value) {
            $id[$index] = (int) $value;
        }

		$q = "UPDATE " . TB_PREFIX . "market set accept = 1 where id IN(".implode(', ', $id ).")";
		return mysqli_query($this->dblink,$q);
	}

	/***************************
	Function to send resource to other village
	Mode 0: Send
	Mode 1: Cancel
	References: Wood/ID, Clay, Iron, Crop, Mode
	***************************/
	function sendResource($ref, $clay, $iron, $crop, $merchant, $mode) {
	    // always prepare for multiple inserts at once
	    if (!is_array($ref)) {
	        $ref = [$ref];
	        $clay = [$clay];
	        $iron = [$iron];
	        $crop = [$crop];
	        $merchant = [$merchant];
        }

        $pairs = [];
        foreach ($ref as $index => $refValue) {
            if(!$mode) {
                $pairs[] = '(0, ' . (int) $refValue . ', ' . (int) $clay[$index] . ', ' . (int) $iron[$index] . ', ' . (int) $crop[$index] . ', ' . (int) $merchant[$index] . ')';
            } else {
                $pairs[] = (int) $refValue;
            }
        }

		if(!$mode) {
			$q = "INSERT INTO " . TB_PREFIX . "send VALUES ".implode(', ', $pairs);
			mysqli_query($this->dblink,$q);
			return mysqli_insert_id($this->dblink);
		} else {
			$q = "DELETE FROM " . TB_PREFIX . "send WHERE id IN(".implode(', ', $pairs).")";
			return mysqli_query($this->dblink,$q);
		}
	}

	/***************************
	Function to get resources back if you delete offer
	References: VillageRef (vref)
	Made by: Dzoki
	***************************/

	function getResourcesBack($vref, $gtype, $gamt) {
	    list($vref, $gtype, $gamt) = $this->escape_input((int) $vref, (int) $gtype, (int) $gamt);

		//Xtype (1) = wood, (2) = clay, (3) = iron, (4) = crop
		if($gtype == 1) {
			$q = "UPDATE " . TB_PREFIX . "vdata SET `wood` = `wood` + $gamt WHERE wref = $vref";
			return mysqli_query($this->dblink,$q);
		} else
			if($gtype == 2) {
				$q = "UPDATE " . TB_PREFIX . "vdata SET `clay` = `clay` + $gamt WHERE wref = $vref";
				return mysqli_query($this->dblink,$q);
			} else
				if($gtype == 3) {
					$q = "UPDATE " . TB_PREFIX . "vdata SET `iron` = `iron` + $gamt WHERE wref = $vref";
					return mysqli_query($this->dblink,$q);
				} else
					if($gtype == 4) {
						$q = "UPDATE " . TB_PREFIX . "vdata SET `crop` = `crop` + $gamt WHERE wref = $vref";
						return mysqli_query($this->dblink,$q);
					}
	}

	/***************************
	Function to get info about offered resources
	References: VillageRef (vref)
	Made by: Dzoki
	***************************/

	function getMarketField($vref, $id, $field, $use_cache = true) {
	    list($vref, $id, $field) = $this->escape_input($vref, $id, $field);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$marketFieldCache, $vref.$field)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

		$q = "SELECT * FROM " . TB_PREFIX . "market WHERE id = $id AND vref = $vref";
		$result = mysqli_query($this->dblink,$q);
		$dbarray = mysqli_fetch_array($result);

        self::$marketFieldCache[$vref.$field] = $dbarray[$field];
        return self::$marketFieldCache[$vref.$field];
	}

	function removeAcceptedOffer($id) {
	    list($id) = $this->escape_input((int) $id);

		$q = "DELETE FROM " . TB_PREFIX . "market where id = $id";
		$result = mysqli_query($this->dblink,$q);
		return mysqli_fetch_assoc($result);
	}

   /**
	* Function to add market offer
	* 
	* Mode 0: Add
	* Mode 1: Cancel
	* References: Village, Give, Amt, Want, Amt, Time, Alliance, Mode
	*/
	
	function addMarket($vid, $gtype, $gamt, $wtype, $wamt, $time, $alliance, $merchant, $mode) {
	    list($vid, $gtype, $gamt, $wtype, $wamt, $time, $alliance, $merchant, $mode) = $this->escape_input((int) $vid, (int) $gtype, (int) $gamt, (int) $wtype, (int) $wamt, (int) $time, (int) $alliance, (int) $merchant, $mode);

		if(!$mode) {
			$q = "INSERT INTO " . TB_PREFIX . "market values (0,$vid,$gtype,$gamt,$wtype,$wamt,0,$time,$alliance,$merchant)";
			mysqli_query($this->dblink,$q);
			return mysqli_insert_id($this->dblink);
		} else {
			$q = "DELETE FROM " . TB_PREFIX . "market where id = $gtype and vref = $vid";
			return mysqli_query($this->dblink,$q);
		}
	}

	/***************************
	Function to get market offer
	References: Village, Mode
	***************************/
    // no need to cache this method
	function getMarket($vid, $mode) {
	    list($vid, $mode) = $this->escape_input((int) $vid, $mode);

	    $alliance = (int) $this->getUserField($this->getVillageField($vid, "owner"), "alliance", 0);
		if(!$mode) {
			$q = "SELECT * FROM " . TB_PREFIX . "market where vref = $vid and accept = 0";
		} else {
			$q = "SELECT * FROM " . TB_PREFIX . "market where vref != $vid and alliance = $alliance or vref != $vid and alliance = 0 and accept = 0";
		}
		$result = mysqli_query($this->dblink,$q);
		return $this->mysqli_fetch_all($result);
	}

	/***************************
	Function to get market offer
	References: ID
	***************************/
    // no need to cache this method
	function getMarketInfo($id) {
	    list($id) = $this->escape_input((int) $id);

		$q = "SELECT * FROM " . TB_PREFIX . "market where id = $id";
		$result = mysqli_query($this->dblink,$q);
		return mysqli_fetch_assoc($result);
	}

	/***************************
	Function to retrieve used merchant
	References: Village
	***************************/
	function totalMerchantUsed($vid, $use_cache = true) {
	    list($vid) = $this->escape_input((int) $vid);

        // first of all, check if we should be using cache and whether the field
        // required is already cached
        if ($use_cache && ($cachedValue = self::returnCachedContent(self::$merchantsUseCountCache, $vid)) && !is_null($cachedValue)) {
            return $cachedValue;
        }

        self::$merchantsUseCountCache[$vid] = mysqli_fetch_array(mysqli_query($this->dblink, '
            SELECT
                IFNULL((SELECT sum('.TB_PREFIX.'send.merchant) FROM '.TB_PREFIX.'send, '.TB_PREFIX.'movement WHERE '.TB_PREFIX.'movement.`from` = '.$vid.' AND '.TB_PREFIX.'send.id = '.TB_PREFIX.'movement.ref AND '.TB_PREFIX.'movement.proc = 0 AND sort_type = 0), 0) +
                IFNULL((SELECT sum(ref) FROM '.TB_PREFIX.'movement WHERE sort_type = 2 AND '.TB_PREFIX.'movement.`to` = '.$vid.' AND proc = 0), 0) +
                IFNULL((SELECT sum(merchant) FROM '.TB_PREFIX.'market WHERE vref = '.$vid.' AND accept = 0), 0)
            as merchants_used'
        ), MYSQLI_ASSOC)['merchants_used'];

        return self::$merchantsUseCountCache[$vid];
	}

	/***************************
	Function to acquire/release MySQL advisory lock for merchant operations
	Prevents race conditions when sending merchants concurrently
	***************************/
	function getMerchantLock($vid, $timeout = 10)
	{
		$lockName = TB_PREFIX . 'merchant_' . (int)$vid;
		$result = mysqli_query($this->dblink, "SELECT GET_LOCK('$lockName', $timeout) AS lock_acquired");
		$row = mysqli_fetch_assoc($result);
		return $row['lock_acquired'] == 1;
	}

	function releaseMerchantLock($vid)
	{
		$lockName = TB_PREFIX . 'merchant_' . (int)$vid;
		mysqli_query($this->dblink, "SELECT RELEASE_LOCK('$lockName')");
	}
}
