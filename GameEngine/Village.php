<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : Village.php                      	                       ##
##  Type           : Village System Backend                                    ##
## --------------------------------------------------------------------------- ##
##  Developed by   : Dzoki           			                               ##
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

include_once("Session.php");
include_once("Building.php");
include_once("Market.php");
include_once("GameEngine/Units.php");
include_once("Technology.php");

class Village {

	public $type;
	public $coor = [];
	public $awood, $aclay, $airon, $acrop, $pop, $maxstore, $maxcrop, $atotal;
	public $wid, $vname, $capital, $natar, $master;
	public $resarray = [];
	public $unitarray, $techarray, $unitall, $researching, $abarray = [];
	public $enforcetome = [];
	public $enforcetoyou = [];
	public $enforceoasis = [];
	public $currentcel = 0;
	public $allcrop = 0;
	public $loyalty = 0;
	private $infoarray = [];
	private $production = [];
	private $oasisowned, $ocounter = [];

	// single-load guards
	private static $loadedWid = null;
	private static $cacheCleared = false;

	function __construct() {
		global $session, $database;

		// set village id
		if (isset($_SESSION['wid'])) $this->wid = $_SESSION['wid'];
		else $this->wid = $session->villages[0];

		// preload caches (safe warmup)
		$this->preloadVillagesData();

		// validate existence
		if (!$database->checkVilExist($this->wid)) {
			$this->wid = $database->getVillageID($session->uid);
			$_SESSION['wid'] = $this->wid;
		}

		// prevent double init in same request
		if (self::$loadedWid === $this->wid) {
			return;
		}
		self::$loadedWid = $this->wid;

		$this->LoadTown();

		$database->cacheResourceLevels($this->wid);

		$this->calculateProduction();
		$this->processProduction();
		$this->ActionControl();
	}

	/**
	 * preload user + world cache
	 */
	private function preloadVillagesData() {
		global $database, $session;

		$database->getProfileVillages($session->uid, 5);
		$database->cacheVillageByWorldIDs($session->uid);
	}

	public function getProd($type) {
		return $this->production[$type];
	}

	public function getAllUnits($vid) {
		global $database, $technology;

		return $technology->getUnits(
			$database->getUnit($vid),
			$database->getEnforceVillage($vid, 0)
		);
	}

	/**
	 * LOAD VILLAGE DATA (single source of truth)
	 */
	private function LoadTown($second_run = false) {
		global $database, $session, $logging, $technology;

		// prevent duplicate reload in same request
		if (self::$loadedWid === $this->wid && !$second_run && !empty($this->infoarray)) {
			return;
		}

		$this->infoarray = $database->getVillage($this->wid);

		if ($this->infoarray['owner'] != $session->uid && !$session->isAdmin) {
			unset($_SESSION['wid']);
			$logging->addIllegal($session->uid, $this->wid, 1);

			$this->wid = $session->villages[0];
			$this->infoarray = $database->getVillage($this->wid);
		}

		$this->resarray = $database->getResourceLevel($this->wid);
		$this->coor = $database->getCoor($this->wid);
		$this->type = $database->getVillageType($this->wid);
		$this->oasisowned = $database->getOasis($this->wid);
		$this->ocounter = $this->sortOasis();

		$this->unitarray = $database->getUnit($this->wid);
		$this->enforcetome = $database->getEnforceVillage($this->wid, 0);
		$this->enforcetoyou = $database->getEnforceVillage($this->wid, 1);
		$this->enforceoasis = $database->getOasisEnforce($this->wid, 0);

		$this->unitall = $technology->getAllUnits($this->wid);
		$this->techarray = $database->getTech($this->wid);
		$this->abarray = $database->getABTech($this->wid);
		$this->researching = $database->getResearching($this->wid, !$second_run);

		$this->capital = $this->infoarray['capital'];
		$this->natar = $this->infoarray['natar'];
		$this->currentcel = $this->infoarray['celebration'];
		$this->currentfestival = $this->infoarray['festival'];
		$this->wid = $this->infoarray['wref'];
		$this->vname = $this->infoarray['name'];

		$this->awood = $this->infoarray['wood'];
		$this->aclay = $this->infoarray['clay'];
		$this->airon = $this->infoarray['iron'];
		$this->acrop = $this->infoarray['crop'];

		$this->atotal = (int)($this->awood + $this->aclay + $this->airon + $this->acrop);

		$this->pop = $this->infoarray['pop'];
		$this->maxstore = $this->infoarray['maxstore'];
		$this->maxcrop = $this->infoarray['maxcrop'];

		$this->allcrop = $this->getCropProd();
		$this->loyalty = $this->infoarray['loyalty'];

		$this->master = count($database->getMasterJobs($this->wid));

		// overflow fix
		$updates = [];

		if ($this->awood > $this->maxstore) { $this->awood = $this->maxstore; $updates['wood'] = $this->maxstore; }
		if ($this->aclay > $this->maxstore) { $this->aclay = $this->maxstore; $updates['clay'] = $this->maxstore; }
		if ($this->airon > $this->maxstore) { $this->airon = $this->maxstore; $updates['iron'] = $this->maxstore; }
		if ($this->acrop > $this->maxcrop) { $this->acrop = $this->maxcrop; $updates['crop'] = $this->maxcrop; }

		if (count($updates)) {
			$database->updateResource($this->wid, array_keys($updates), array_values($updates));
		}
	}

	/**
	 * PRODUCTION CALC
	 */
	private function calculateProduction() {
		global $technology, $database;

		if (!self::$cacheCleared) {
			$db = get_class($database);
			$db::clearVillageCache();
			self::$cacheCleared = true;
		}

		$upkeep = $technology->getUpkeep($this->unitall, 0, $this->wid);

		$this->production['wood'] = $this->getWoodProd();
		$this->production['clay'] = $this->getClayProd();
		$this->production['iron'] = $this->getIronProd();

		$this->production['crop'] =
			$this->getCropProd()
			- (!$this->natar ? $this->pop : round($this->pop / 2))
			- $upkeep;
	}

	/**
	 * APPLY PRODUCTION (NO MORE LOADTOWN RELOAD)
	 */
	private function processProduction() {
		global $database;

		$timepast = time() - $this->infoarray['lastupdate'];

		$nwood = min(($this->production['wood'] / 3600) * $timepast, $this->maxstore);
		$nclay = min(($this->production['clay'] / 3600) * $timepast, $this->maxstore);
		$niron = min(($this->production['iron'] / 3600) * $timepast, $this->maxstore);
		$ncrop = min(($this->production['crop'] / 3600) * $timepast, $this->maxcrop);

		if (!self::$cacheCleared) {
			$db = get_class($database);
			$db::clearVillageCache();
			self::$cacheCleared = true;
		}
		$database->modifyResource($this->wid, $nwood, $nclay, $niron, $ncrop, 1);
		$database->updateVillage($this->wid);

		// lightweight sync ONLY (no DB reload)
		$this->infoarray['lastupdate'] = time();

		$this->awood = min($this->awood + $nwood, $this->maxstore);
		$this->aclay = min($this->aclay + $nclay, $this->maxstore);
		$this->airon = min($this->airon + $niron, $this->maxstore);
		$this->acrop = min($this->acrop + $ncrop, $this->maxcrop);
	}
	
	private function getWoodProd() {
		
		global $bid1, $bid5, $session;
		$wood = $sawmill = 0;
		$holder = [];
		for ($i = 1; $i <= 38; $i++) {
			if ($this->resarray['f'.$i.'t'] == 1) $holder[] = 'f'.$i;
			if ($this->resarray['f'.$i.'t'] == 5) $sawmill = $this->resarray['f'.$i];
		}
		$cnt = count($holder);
		for ($i = 0; $i < $cnt; $i++) {
			$wood += $bid1[$this->resarray[$holder[$i]]]['prod'];
		}
		$wood += $wood * 0.25 * $this->ocounter[0];
		if ($sawmill >= 1) {
			$wood += $wood / 100 * $bid5[$sawmill]['attri'];
		}
		if ($session->bonus1 == 1) $wood *= 1.25;
		return round($wood * SPEED);
	}

	private function getClayProd() {
		
		global $bid2, $bid6, $session;
		$clay = $brick = 0;
		$holder = [];
		for ($i = 1; $i <= 38; $i++) {
			if ($this->resarray['f'.$i.'t'] == 2) $holder[] = 'f'.$i;
			if ($this->resarray['f'.$i.'t'] == 6) $brick = $this->resarray['f'.$i];
		}
		$cnt = count($holder);
		for ($i = 0; $i < $cnt; $i++) {
			$clay += $bid2[$this->resarray[$holder[$i]]]['prod'];
		}
		$clay += $clay * 0.25 * $this->ocounter[1];
		if ($brick >= 1) {
			$clay += $clay / 100 * $bid6[$brick]['attri'];
		}
		if ($session->bonus2 == 1) $clay *= 1.25;
		return round($clay * SPEED);
	}

	private function getIronProd() {
		
		global $bid3, $bid7, $session;
		$iron = $foundry = 0;
		$holder = [];
		for ($i = 1; $i <= 38; $i++) {
			if ($this->resarray['f'.$i.'t'] == 3) $holder[] = 'f'.$i;
			if ($this->resarray['f'.$i.'t'] == 7) $foundry = $this->resarray['f'.$i];
		}
		$cnt = count($holder);
		for ($i = 0; $i < $cnt; $i++) {
			$iron += $bid3[$this->resarray[$holder[$i]]]['prod'];
		}
		$iron += $iron * 0.25 * $this->ocounter[2];
		if ($foundry >= 1) {
			$iron += $iron / 100 * $bid7[$foundry]['attri'];
		}
		if ($session->bonus3 == 1) $iron *= 1.25;
		return round($iron * SPEED);
	}

	private function getCropProd() {
		
		global $bid4, $bid8, $bid9, $session;
		$crop = $grainmill = $bakery = 0;
		$holder = [];
		for ($i = 1; $i <= 38; $i++) {
			if ($this->resarray['f'.$i.'t'] == 4) $holder[] = 'f'.$i;
			if ($this->resarray['f'.$i.'t'] == 8) $grainmill = $this->resarray['f'.$i];
			if ($this->resarray['f'.$i.'t'] == 9) $bakery = $this->resarray['f'.$i];
		}
		$cnt = count($holder);
		for ($i = 0; $i < $cnt; $i++) {
			$crop += $bid4[$this->resarray[$holder[$i]]]['prod'];
		}
		$crop += $crop * 0.25 * $this->ocounter[3];
		if ($grainmill >= 1 || $bakery >= 1) {
			$crop += $crop / 100 * (
				(isset($bid8[$grainmill]['attri']) ? $bid8[$grainmill]['attri'] : 0) +
				(isset($bid9[$bakery]['attri']) ? $bid9[$bakery]['attri'] : 0)
			);
		}
		if ($session->bonus4 == 1) $crop *= 1.25;
		return round($crop * SPEED);
	}

	/**
	 * OASIS
	 */
	private function sortOasis() {
		$wood = $clay = $iron = $crop = 0;
		if (!empty($this->oasisowned)) {
			foreach ($this->oasisowned as $oasis) {
				switch ($oasis['type']) {
					case 1: case 2: $wood++; break;
					case 3: $wood++; $crop++; break;
					case 4: case 5: $clay++; break;
					case 6: $clay++; $crop++; break;
					case 7: case 8: $iron++; break;
					case 9: $iron++; $crop++; break;
					case 10: case 11: $crop++; break;
					case 12: $crop += 2; break;
				}
			}
		}
		return [$wood, $clay, $iron, $crop];
	}

	private function ActionControl() {
		
		global $session;
		$page = $_SERVER['SCRIPT_NAME'];
		if (!SERVER_WEB_ROOT) {
			$page = basename($_SERVER['SCRIPT_NAME']);
		}
		if ($page == "build.php" && $session->uid != $this->infoarray['owner']) {
			unset($_SESSION['wid']);
			header("Location: dorf1.php");
			exit;
		}
	}
}
$village = new Village;
$building = new Building;

// automation
if (!file_exists(AUTOMATION_LOCK_FILE_NAME)) {
	define('AUTOMATION_MANUAL_RUN', true);
	file_put_contents(AUTOMATION_LOCK_FILE_NAME, '');
	include_once("Automation.php");
}
?>