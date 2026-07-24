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
##  Refactor D1    : in-memory production clamp = SQL clamp; 1 UPDATE/hit;     ##
##                   removed wid=wref; flock on the automation lock            ##
##  Refactor W1    : single getProdFor() (no 4 copy-paste methods);            ##
##                   scan f1..f38 only once; globals pulled in constructor     ##
##  Refactor W2    : constructor without side effects; explicit tick() +       ##
##                   ActionControl() in bootstrap; static guards removed       ##
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

	/** cache per sat pentru productia adusa de erou (null = neincarcat) */
	private $heroProd = null;
	public $currentcel = 0;
	public $currentfestival = 0;
	public $allcrop = 0;
	public $loyalty = 0;
	private $infoarray = [];
	private $production = [];
	private $oasisowned, $ocounter = [];
	private $oasisFactor = 0.25;

	// W1 #6: dependencies pulled from globals once, in the constructor
	private $db;
	private $sess;
	private $tech;
	private $bids = [];

	// W1 #4: index of the f1..f38 fields, built lazily, once per load
	private $fieldIndex = null;

	/**
	 * W1 #4: per-resource configuration for getProdFor().
	 * field = the production field type (and the number of the $bidN production table),
	 * bonus = the gids of the bonus buildings (Sawmill/Brickyard/Foundry/Grain Mill+Bakery),
	 * oasis = the index into $this->ocounter, sessionBonus = the 25% bonus flag.
	 */
	private const PROD_CONFIG = [
		'wood' => ['field' => 1, 'bonus' => [5],    'oasis' => 0, 'sessionBonus' => 'bonus1'],
		'clay' => ['field' => 2, 'bonus' => [6],    'oasis' => 1, 'sessionBonus' => 'bonus2'],
		'iron' => ['field' => 3, 'bonus' => [7],    'oasis' => 2, 'sessionBonus' => 'bonus3'],
		'crop' => ['field' => 4, 'bonus' => [8, 9], 'oasis' => 3, 'sessionBonus' => 'bonus4'],
	];

	/**
	 * W2 #7: the constructor ONLY loads. No DB writes, no redirect,
	 * no production tick. "new Village" is safe to call anywhere
	 * (multiple instances, admin switch). The static loadedWid /
	 * cacheCleared guards were removed (W2 #10) - they are no longer
	 * needed now that side effects are explicit.
	 */
	function __construct() {
		global $database, $session, $technology,
			$bid1, $bid2, $bid3, $bid4, $bid5, $bid6, $bid7, $bid8, $bid9, $bid45;

		$this->db   = $database;
		$this->sess = $session;
		$this->tech = $technology;
		$this->bids = [
			1 => $bid1, 2 => $bid2, 3 => $bid3, 4 => $bid4,
			5 => $bid5, 6 => $bid6, 7 => $bid7, 8 => $bid8, 9 => $bid9,
			45 => $bid45, // Waterworks (Egyptians) - used by getOasisBonusFactor()
		];

		// set village id
		if (isset($_SESSION['wid'])) $this->wid = $_SESSION['wid'];
		else $this->wid = $this->sess->villages[0];

		// preload caches (safe warmup)
		$this->preloadVillagesData();

		// validate existence
		if (!$this->db->checkVilExist($this->wid)) {
			$this->wid = $this->db->getVillageID($this->sess->uid);
			$_SESSION['wid'] = $this->wid;
		}

		$this->LoadTown();

		$this->db->cacheResourceLevels($this->wid);
	}

	/**
	 * W2 #8: explicit tick - computes and applies production. Called from the
	 * bootstrap at the end of this file (not from dorf1/dorf2 individually:
	 * 28 pages include Village.php and all of them need up-to-date resources).
	 */
	public function tick(): void {
		// W2 #10: the cache clear used to be guarded by static::$cacheCleared so it
		// would run once per request; with an explicit tick (called once, from the
		// bootstrap) that guard is no longer needed. A repeated clear on a second
		// instance only means a cold cache, not a correctness bug.
		$db = get_class($this->db);
		$db::clearVillageCache();

		$this->calculateProduction();
		$this->processProduction();
	}

	/**
	 * preload user + world cache
	 */
	private function preloadVillagesData(): void {
		$this->db->getProfileVillages($this->sess->uid, 5);
		$this->db->cacheVillageByWorldIDs($this->sess->uid);
	}

	public function getProd($type) {
		return $this->production[$type];
	}

	public function getAllUnits($vid) {
		return $this->tech->getUnits(
			$this->db->getUnit($vid),
			$this->db->getEnforceVillage($vid, 0)
		);
	}

	/**
	 * LOAD VILLAGE DATA (single source of truth)
	 * W2: the dead $second_run parameter was removed (it was not passed from
	 * anywhere; getResearching always received use_cache = true).
	 */
	private function LoadTown(): void {
		global $logging;

		$this->infoarray = $this->db->getVillage($this->wid);

		if ($this->infoarray['owner'] != $this->sess->uid && !$this->sess->isAdmin) {
			unset($_SESSION['wid']);
			$logging->addIllegal($this->sess->uid, $this->wid, 1);

			$this->wid = $this->sess->villages[0];
			$this->infoarray = $this->db->getVillage($this->wid);
		}

		$this->resarray = $this->db->getResourceLevel($this->wid);
		$this->coor = $this->db->getCoor($this->wid);
		$this->type = $this->db->getVillageType($this->wid);
		$this->oasisowned = $this->db->getOasis($this->wid);
		$this->ocounter = $this->sortOasis();
		$this->oasisFactor = $this->getOasisBonusFactor();

		$this->unitarray = $this->db->getUnit($this->wid);
		$this->enforcetome = $this->db->getEnforceVillage($this->wid, 0);
		$this->enforcetoyou = $this->db->getEnforceVillage($this->wid, 1);
		$this->enforceoasis = $this->db->getOasisEnforce($this->wid, 0);

		$this->unitall = $this->tech->getAllUnits($this->wid);
		$this->techarray = $this->db->getTech($this->wid);
		$this->abarray = $this->db->getABTech($this->wid);
		$this->researching = $this->db->getResearching($this->wid);

		$this->capital = $this->infoarray['capital'];
		$this->natar = $this->infoarray['natar'];
		$this->currentcel = $this->infoarray['celebration'];
		$this->currentfestival = $this->infoarray['festival'];
		// FIX #2 (Day 1): removed "$this->wid = $this->infoarray['wref']" - it overwrote
		// the village id in the middle of the load; in the normal flow it was a no-op
		// (wref == wid), but it masked any wrong row coming from the cache. wid stays
		// the source of truth.
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

		$this->master = count($this->db->getMasterJobs($this->wid));

		// FIX #1a (Day 1): overflow fix in memory only - no updateResource() here.
		// The SQL clamp in modifyResource() (IF > maxstore -> maxstore) corrects the
		// DB in the same request anyway, in processProduction(). Saves one UPDATE.
		if ($this->awood > $this->maxstore) $this->awood = $this->maxstore;
		if ($this->aclay > $this->maxstore) $this->aclay = $this->maxstore;
		if ($this->airon > $this->maxstore) $this->airon = $this->maxstore;
		if ($this->acrop > $this->maxcrop) $this->acrop = $this->maxcrop;
		// NOTE (pre-existing, unchanged): $this->atotal is computed above from the
		// un-clamped values and before the production tick.
	}

	/**
	 * PRODUCTION CALC
	 */
	private function calculateProduction(): void {
		$upkeep = $this->tech->getUpkeep($this->unitall, 0, $this->wid);

		$this->production['wood'] = $this->getProdFor('wood');
		$this->production['clay'] = $this->getProdFor('clay');
		$this->production['iron'] = $this->getProdFor('iron');

		$this->production['crop'] =
			$this->getProdFor('crop')
			- (!$this->natar ? $this->pop : round($this->pop / 2))
			- $upkeep;
	}

	/**
	 * APPLY PRODUCTION (NO MORE LOADTOWN RELOAD)
	 */
	private function processProduction(): void {
		// hardening: do not let a lastupdate from the future (clock skew) produce a negative delta
		$timepast = max(0, time() - $this->infoarray['lastupdate']);

		$nwood = min(($this->production['wood'] / 3600) * $timepast, $this->maxstore);
		$nclay = min(($this->production['clay'] / 3600) * $timepast, $this->maxstore);
		$niron = min(($this->production['iron'] / 3600) * $timepast, $this->maxstore);
		$ncrop = min(($this->production['crop'] / 3600) * $timepast, $this->maxcrop);

		// FIX #1b (Day 1): a single UPDATE - lastupdate is set in the same query as the
		// resources (the $setLastupdate param in modifyResource); updateVillage() removed.
		$this->db->modifyResource($this->wid, $nwood, $nclay, $niron, $ncrop, 1, true);

		// lightweight sync ONLY (no DB reload)
		$this->infoarray['lastupdate'] = time();

		// FIX #0 (Day 1): the in-memory sync mirrors exactly the SQL clamp from
		// modifyResource: floor at 0 (before, negative crop from starvation could
		// drop below 0 in memory while the DB stayed at 0 -> divergence).
		$this->awood = min(max($this->awood + $nwood, 0), $this->maxstore);
		$this->aclay = min(max($this->aclay + $nclay, 0), $this->maxstore);
		$this->airon = min(max($this->airon + $niron, 0), $this->maxstore);
		$this->acrop = min(max($this->acrop + $ncrop, 0), $this->maxcrop);
	}

	// W1 #4: the 4 methods remain as one-line wrappers - zero API changes,
	// all the logic lives in getProdFor().
	private function getWoodProd() { return $this->getProdFor('wood'); }
	private function getClayProd() { return $this->getProdFor('clay'); }
	private function getIronProd() { return $this->getProdFor('iron'); }
	private function getCropProd() { return $this->getProdFor('crop'); }

	/**
	 * W1 #4: gross production for one resource. Replaces the 4 copy-paste
	 * methods (~120 lines). The order of the operations is kept 1:1 with the
	 * original: sum of fields -> oasis bonus -> building bonus (%) ->
	 * account bonus (x1.25) -> round(x * SPEED).
	 */
	private function getProdFor(string $type): float {
		$cfg = self::PROD_CONFIG[$type];
		$index = $this->getFieldIndex();

		$amount = 0;
		if (!empty($index['levels'][$cfg['field']])) {
			foreach ($index['levels'][$cfg['field']] as $level) {
				$amount += $this->bids[$cfg['field']][$level]['prod'];
			}
		}

		$amount += $amount * $this->oasisFactor * $this->ocounter[$cfg['oasis']];

		// NOTE: the isset() guard on 'attri' existed in the original only for crop;
		// here it is applied everywhere (numerically identical on valid data, no
		// warning on corrupted data). The bonus building level = the value of the
		// LAST field of that type, exactly as in the original (on real data there is
		// at most one building per type).
		$bonusPct = 0;
		foreach ($cfg['bonus'] as $buildingType) {
			$level = $index['last'][$buildingType] ?? 0;
			if ($level >= 1 && isset($this->bids[$buildingType][$level]['attri'])) {
				$bonusPct += $this->bids[$buildingType][$level]['attri'];
			}
		}
		if ($bonusPct > 0) {
			$amount += $amount / 100 * $bonusPct;
		}

		// Productia de resurse a eroului (atributul "Resources", ca in T4).
		// Se adauga DUPA bonusurile de cladiri si oaze (alea se aplica doar campurilor)
		// dar INAINTE de bonusul de 25% si de inmultirea cu SPEED, fiindca in T4 si
		// bonusul de 25% si viteza serverului se aplica si productiei eroului.
		$amount += $this->getHeroProdFor($type);

		if ($this->sess->{$cfg['sessionBonus']} == 1) $amount *= 1.25;

		return round($amount * SPEED);
	}

	/**
	 * Productia orara adusa de atributul "Resources" al eroului, pentru satul asta.
	 *
	 * Regula T4: fiecare punct produce 3 din FIECARE resursa (res_type = 0) sau 10
	 * dintr-un singur tip (res_type = 1..4 pentru lemn/lut/fier/cereale).
	 * Bonusul merge in satul in care se afla eroul (hero.wref), deci mutarea
	 * eroului muta si productia.
	 *
	 * Randul de erou se citeste O SINGURA DATA per instanta de sat.
	 */
	private function getHeroProdFor(string $type): float {

		if ($this->heroProd === null) {
			$this->heroProd = $this->loadHeroProd();
		}

		return $this->heroProd[$type] ?? 0.0;
	}

	/** Citeste eroul acestui sat si transforma punctele in productie per resursa. */
	private function loadHeroProd(): array {

		$empty = ['wood' => 0.0, 'clay' => 0.0, 'iron' => 0.0, 'crop' => 0.0];

		if (!defined('NEW_FUNCTIONS_HERO_T4') || !NEW_FUNCTIONS_HERO_T4) {
			return $empty;
		}

		$row = $this->db->getHeroForVillage($this->wid);

		if (!$row) {
			return $empty;
		}

		$points = (int) $row['resources'];

		if ($points <= 0) {
			return $empty;
		}

		$resType = (int) $row['res_type'];
		$map     = [1 => 'wood', 2 => 'clay', 3 => 'iron', 4 => 'crop'];

		// 0 = raspandit egal: 3 din fiecare. Altfel: 10 dintr-un singur tip.
		if ($resType === 0 || !isset($map[$resType])) {
			$each = $points * (defined('HERO_RES_PER_POINT_ALL') ? (int) HERO_RES_PER_POINT_ALL : 3);
			return ['wood' => $each, 'clay' => $each, 'iron' => $each, 'crop' => $each];
		}

		$single = $points * (defined('HERO_RES_PER_POINT_ONE') ? (int) HERO_RES_PER_POINT_ONE : 10);

		$out = $empty;
		$out[$map[$resType]] = $single;

		return $out;
	}

	/**
	 * W1 #4: scans the f1..f38 fields ONLY once per load (instead of 4 passes)
	 * and buckets them by type.
	 * 'levels' => [type => [the levels of every field of that type]]
	 * 'last'   => [type => the (raw) level of the last field of that type] -
	 *             identical semantics to the overwritten assignments in the original.
	 */
	private function getFieldIndex(): array {
		if ($this->fieldIndex !== null) {
			return $this->fieldIndex;
		}

		$levels = [];
		$last = [];
		for ($i = 1; $i <= 38; $i++) {
			$t = (int) $this->resarray['f'.$i.'t'];
			$lvl = $this->resarray['f'.$i];
			$levels[$t][] = $lvl;
			$last[$t] = $lvl;
		}

		return $this->fieldIndex = ['levels' => $levels, 'last' => $last];
	}

	/**
	 * OASIS
	 */
	/**
	 * The base oasis bonus (25%) increased by the Waterworks (gid 45, Egyptians):
	 * attri = +5% relative per level, up to +100% at level 20 (0.25 -> 0.50).
	 * NOTE: intentionally kept outside getFieldIndex() - it scans f19..f40
	 * (includes f39/f40, past the index limit of 38).
	 */
	private function getOasisBonusFactor(): float {
		$wwLevel = 0;
		for ($i = 19; $i <= 40; $i++) {
			if (isset($this->resarray['f'.$i.'t']) && (int)$this->resarray['f'.$i.'t'] == 45) {
				$wwLevel = max($wwLevel, (int)$this->resarray['f'.$i]);
			}
		}
		if ($wwLevel > 0 && isset($this->bids[45][$wwLevel]['attri'])) {
			return 0.25 * (1 + $this->bids[45][$wwLevel]['attri']);
		}
		return 0.25;
	}

	private function sortOasis(): array {
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

	/**
	 * W2 #9: moved out of the constructor; called explicitly from the bootstrap
	 * below. It keeps its own guard on build.php, so the effect is identical to
	 * putting it at the top of build.php, but without editing the entry pages.
	 */
	public function ActionControl(): void {
		$page = $_SERVER['SCRIPT_NAME'];
		if (!SERVER_WEB_ROOT) {
			$page = basename($_SERVER['SCRIPT_NAME']);
		}
		if ($page == "build.php" && $this->sess->uid != $this->infoarray['owner']) {
			unset($_SESSION['wid']);
			header("Location: dorf1.php");
			exit;
		}
	}
}

// W2: bootstrap with EXPLICIT side effects, in the same order as the old
// constructor (load -> production tick -> ActionControl). Village.php is
// include_once-d, so this block runs only once per request.
// "new Village" stays safe for additional instances (admin switch).
$village = new Village;
$village->tick();
$village->ActionControl();
$building = new Building;

// automation
// P2: if a dedicated cron is running (cron.php), we no longer trigger automation
// from the player pages - cron.php writes a timestamped marker on every run.
// A fresh marker (< 90s) => cron is active, so we skip. Fallback: if the cron
// stops (marker old or missing), the pages take over automatically, as before, so
// the game does not stall if you forget to set up the cron or if it dies.
$__cronMarker = __DIR__ . '/Prevention/cron_active.txt';
$__cronActive = false;
if (@is_file($__cronMarker)) {
	$__cronTime = (int)@file_get_contents($__cronMarker);
	if ($__cronTime > 0 && (time() - $__cronTime) < 90) {
		$__cronActive = true;
	}
}

if (!$__cronActive) {
	// FIX #3 (Day 1): file_exists() + file_put_contents() was a classic TOCTOU - two
	// simultaneous requests both passed the check and ran Automation twice.
	// fopen('c') + flock(LOCK_EX|LOCK_NB) is atomic; the lock is released by itself
	// even if the process dies. It uses the SAME file, so the internal guard in
	// Automation.php (cron/direct path: file_exists + mtime < 60s) keeps working;
	// touch() keeps mtime fresh while we are running.
	$__automationLock = @fopen(AUTOMATION_LOCK_FILE_NAME, 'c');
	if ($__automationLock !== false) {
		if (flock($__automationLock, LOCK_EX | LOCK_NB)) {
			define('AUTOMATION_MANUAL_RUN', true);
			@touch(AUTOMATION_LOCK_FILE_NAME);
			include_once("Automation.php");
			// Automation.php deletes the file itself at the end (behavior kept for the
			// cron path); on Linux flock stays valid on the inode until fclose.
			flock($__automationLock, LOCK_UN);
		}
		fclose($__automationLock);
	}
}
?>