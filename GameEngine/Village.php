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
##  Refactor D1    : clamp productie in memorie = clamp SQL; 1 UPDATE/hit;    ##
##                   eliminat wid=wref; flock pe lock-ul de automation         ##
##  Refactor W1    : getProdFor() unic (fara cele 4 metode copy-paste);        ##
##                   scan f1..f38 o singura data; globals trase in constructor ##
##  Refactor W2    : constructor fara side effects; tick() + ActionControl()   ##
##                   explicite in bootstrap; garduri statice eliminate         ##
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
	public $currentfestival = 0;
	public $allcrop = 0;
	public $loyalty = 0;
	private $infoarray = [];
	private $production = [];
	private $oasisowned, $ocounter = [];
	private $oasisFactor = 0.25;

	// W1 #6: dependinte trase o singura data din globals, in constructor
	private $db;
	private $sess;
	private $tech;
	private $bids = [];

	// W1 #4: index-ul campurilor f1..f38, construit lazy, o data per incarcare
	private $fieldIndex = null;

	/**
	 * W1 #4: configuratia per resursa pentru getProdFor().
	 * field = tipul campului de productie (si nr. tabelei $bidN de productie),
	 * bonus = gid-urile cladirilor bonus (Sawmill/Brickyard/Foundry/Grain Mill+Bakery),
	 * oasis = indexul in $this->ocounter, sessionBonus = flag-ul de bonus 25%.
	 */
	private const PROD_CONFIG = [
		'wood' => ['field' => 1, 'bonus' => [5],    'oasis' => 0, 'sessionBonus' => 'bonus1'],
		'clay' => ['field' => 2, 'bonus' => [6],    'oasis' => 1, 'sessionBonus' => 'bonus2'],
		'iron' => ['field' => 3, 'bonus' => [7],    'oasis' => 2, 'sessionBonus' => 'bonus3'],
		'crop' => ['field' => 4, 'bonus' => [8, 9], 'oasis' => 3, 'sessionBonus' => 'bonus4'],
	];

	/**
	 * W2 #7: constructorul DOAR incarca. Fara scrieri in DB, fara redirect,
	 * fara tick de productie. "new Village" e sigur de apelat oriunde
	 * (instante multiple, admin switch). Gardurile statice loadedWid /
	 * cacheCleared au fost eliminate (W2 #10) - nu mai sunt necesare cu
	 * side effects explicite.
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
			45 => $bid45, // Waterworks (Egipteni) - folosit de getOasisBonusFactor()
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
	 * W2 #8: tick explicit - calculeaza si aplica productia. Apelat din
	 * bootstrap-ul de la finalul fisierului (nu din dorf1/dorf2 individual:
	 * 28 de pagini includ Village.php si toate au nevoie de resurse la zi).
	 */
	public function tick(): void {
		// W2 #10: clear-ul de cache era gardat de static::$cacheCleared ca sa
		// ruleze o data per request; cu tick explicit (apelat o data, din
		// bootstrap) gardul nu mai e necesar. Un clear repetat la o a doua
		// instanta inseamna doar cache rece, nu un bug de corectitudine.
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
	 * W2: parametrul mort $second_run eliminat (nu era pasat de nicaieri;
	 * getResearching primea mereu use_cache = true).
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
		// FIX #2 (Day 1): eliminat "$this->wid = $this->infoarray['wref']" - suprascria
		// id-ul satului la mijlocul incarcarii; in flux normal era no-op (wref == wid),
		// dar masca orice rand gresit venit din cache. wid ramane sursa de adevar.
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

		// FIX #1a (Day 1): overflow fix doar in memorie - fara updateResource() aici.
		// Clamp-ul SQL din modifyResource() (IF > maxstore -> maxstore) corecteaza
		// oricum DB-ul in acelasi request, in processProduction(). Scapa un UPDATE.
		if ($this->awood > $this->maxstore) $this->awood = $this->maxstore;
		if ($this->aclay > $this->maxstore) $this->aclay = $this->maxstore;
		if ($this->airon > $this->maxstore) $this->airon = $this->maxstore;
		if ($this->acrop > $this->maxcrop) $this->acrop = $this->maxcrop;
		// NOTA (pre-existent, nemodificat): $this->atotal e calculat mai sus din
		// valorile ne-clamp-uite si inainte de tick-ul de productie.
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
		// hardening: nu lasa un lastupdate din viitor (clock skew) sa produca delta negativ
		$timepast = max(0, time() - $this->infoarray['lastupdate']);

		$nwood = min(($this->production['wood'] / 3600) * $timepast, $this->maxstore);
		$nclay = min(($this->production['clay'] / 3600) * $timepast, $this->maxstore);
		$niron = min(($this->production['iron'] / 3600) * $timepast, $this->maxstore);
		$ncrop = min(($this->production['crop'] / 3600) * $timepast, $this->maxcrop);

		// FIX #1b (Day 1): un singur UPDATE - lastupdate e setat in aceeasi interogare
		// cu resursele (param $setLastupdate in modifyResource); updateVillage() eliminat.
		$this->db->modifyResource($this->wid, $nwood, $nclay, $niron, $ncrop, 1, true);

		// lightweight sync ONLY (no DB reload)
		$this->infoarray['lastupdate'] = time();

		// FIX #0 (Day 1): sincronizarea in memorie oglindeste exact clamp-ul SQL
		// din modifyResource: podea la 0 (inainte, crop-ul negativ din starvation
		// putea cobori sub 0 in memorie in timp ce DB-ul ramanea la 0 -> divergenta).
		$this->awood = min(max($this->awood + $nwood, 0), $this->maxstore);
		$this->aclay = min(max($this->aclay + $nclay, 0), $this->maxstore);
		$this->airon = min(max($this->airon + $niron, 0), $this->maxstore);
		$this->acrop = min(max($this->acrop + $ncrop, 0), $this->maxcrop);
	}

	// W1 #4: cele 4 metode raman ca wrappere de o linie - zero schimbari de API,
	// toata logica e in getProdFor().
	private function getWoodProd() { return $this->getProdFor('wood'); }
	private function getClayProd() { return $this->getProdFor('clay'); }
	private function getIronProd() { return $this->getProdFor('iron'); }
	private function getCropProd() { return $this->getProdFor('crop'); }

	/**
	 * W1 #4: productia bruta pentru o resursa. Inlocuieste cele 4 metode
	 * copy-paste (~120 linii). Ordinea operatiilor e pastrata 1:1 cu originalul:
	 * suma campuri -> bonus oaze -> bonus cladire (%) -> bonus cont (x1.25)
	 * -> round(x * SPEED).
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

		// NOTA: garda isset() pe 'attri' exista in original doar la crop; aici e
		// aplicata peste tot (identic numeric pe date valide, fara warning pe date
		// corupte). Nivelul cladirii bonus = valoarea ULTIMULUI camp de acel tip,
		// exact ca in original (in date reale exista cel mult o cladire per tip).
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

		if ($this->sess->{$cfg['sessionBonus']} == 1) $amount *= 1.25;

		return round($amount * SPEED);
	}

	/**
	 * W1 #4: scaneaza campurile f1..f38 O SINGURA data per incarcare (in loc de
	 * 4 treceri) si le bucket-uieste dupa tip.
	 * 'levels' => [tip => [nivelele fiecarui camp de acel tip]]
	 * 'last'   => [tip => nivelul (raw) al ultimului camp de acel tip] -
	 *             semantica identica cu atribuirile suprascrise din original.
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
	 * Bonusul de baza al oazei (25%) crescut de Waterworks (gid 45, Egipteni):
	 * attri = +5% relativ per nivel, pana la +100% la nivel 20 (0.25 -> 0.50).
	 * NOTA: ramane intentionat in afara getFieldIndex() - scaneaza f19..f40
	 * (include f39/f40, peste limita de 38 a index-ului).
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
	 * W2 #9: scos din constructor; apelat explicit din bootstrap-ul de mai jos.
	 * Isi pastreaza singur garda pe build.php, deci efectul e identic cu a-l
	 * pune la inceputul build.php, dar fara sa editam paginile de intrare.
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

// W2: bootstrap cu side effects EXPLICITE, in aceeasi ordine ca vechiul
// constructor (load -> tick productie -> ActionControl). Village.php e
// include_once-uit, deci blocul ruleaza o singura data per request.
// "new Village" ramane sigur pentru instante suplimentare (admin switch).
$village = new Village;
$village->tick();
$village->ActionControl();
$building = new Building;

// automation
// FIX #3 (Day 1): file_exists() + file_put_contents() era un TOCTOU clasic - doua
// request-uri simultane treceau amandoua de check si rulau Automation dublu.
// fopen('c') + flock(LOCK_EX|LOCK_NB) e atomic; lock-ul se elibereaza singur si
// daca procesul moare. Se foloseste ACELASI fisier, deci gardul intern din
// Automation.php (calea cron/directa: file_exists + mtime < 60s) ramane functional;
// touch() tine mtime proaspat cat rulam noi.
$__automationLock = @fopen(AUTOMATION_LOCK_FILE_NAME, 'c');
if ($__automationLock !== false) {
	if (flock($__automationLock, LOCK_EX | LOCK_NB)) {
		define('AUTOMATION_MANUAL_RUN', true);
		@touch(AUTOMATION_LOCK_FILE_NAME);
		include_once("Automation.php");
		// Automation.php sterge singur fisierul la final (comportament pastrat
		// pentru calea cron); pe Linux flock ramane valid pe inode pana la fclose.
		flock($__automationLock, LOCK_UN);
	}
	fclose($__automationLock);
}
?>
