<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : HEROSMANSION VIEW PAGE  				                   ##
##  Type           : BUILDING TEMPLATE                                         ##
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

include_once("GameEngine/Data/hero_full.php");
global $database;

if (isset($_POST['name']) && !empty($_POST['name'])) {
	$_POST['name'] = $database->escape(stripslashes($_POST['name']));
	mysqli_query($database->dblink, "UPDATE " . TB_PREFIX . "hero SET `name`='" . $_POST['name'] . "' where `uid`='" . $database->escape($session->uid) . "' AND dead = 0") or die("ERROR:" . mysqli_error($database->dblink));
	$hero_info['name'] = $_POST['name'];
	echo "" . NAME_CHANGED . "";
}

// Explicit lookup: action from URL (?add=...) => column from `hero` table.
// Used for both "(+)" links in the table and for the update
// in the DB below. Single source of truth instead of 5 identical blocks.
$heroStatColumns = [
	'off'    => 'attack',
	'deff'   => 'defence',
	'obonus' => 'attackbonus',
	'dbonus' => 'defencebonus',
	'reg'    => 'regeneration',
];

// Atributul "Resources" apartine sistemului de erou T4: apare si poate primi
// puncte doar cand functiile T4 sunt pornite. Tot flag-ul asta decide si daca
// productia se aplica (vezi Village::loadHeroProd), deci cele doua nu pot ajunge
// in dezacord - altfel jucatorii ar investi in ceva care nu produce nimic.
// In plus, cu flag-ul stins interogarile de mai jos nu mai ating coloanele
// `resources` / `res_type`, deci pagina merge si pe un server care inca nu a
// rulat scriptul add-hero-resources.sql.
$t4HeroRes = defined('NEW_FUNCTIONS_HERO_T4') && NEW_FUNCTIONS_HERO_T4;

if ($t4HeroRes) {
	$heroStatColumns['res'] = 'resources';
}

// Render the "(+)" link for a stat, or "(+)" uneditable
// if the hero has no more points or the stat is already at the top (100).
// Identical behavior to the original 5 if/else blocks.
$renderAddLink = function ($action) use ($hero_info, $id, $heroStatColumns) {
	$field = $heroStatColumns[$action];
	if ($hero_info['points'] > 0 && $hero_info[$field] < 100) {
		// class + data-* pentru JS; linkul ramane un GET valid, deci fara JS
		// pagina se comporta exact ca inainte (un punct per click, cu refresh).
		return "<a href=\"build.php?id=" . $id . "&add=" . $action . "\""
			. " class=\"t4AddPoint\" data-stat=\"" . $action . "\""
			. " data-base=\"" . (int) $hero_info[$field] . "\">(<b>+</b>)</a>";
	}
	return "<span class=\"none\">(+)</span>";
};
?>

<style>
/* Aspect in stilul T4 (vezi modelul cerut). Clasele au prefix "t4h-" ca sa nu
   se amestece cu stilurile paginii; tabelul clasic "distribution" nu mai e
   folosit AICI, dar restul paginilor raman neatinse. */
.t4h-wrap{max-width:560px;font-size:12px}
/* colturi drepte si chenar, ca la tabelele originale din joc; fundalul gri si
   barile verzi raman cum erau */
.t4h-panel{background:#f2f2f2;border:1px solid #c9c9c9;padding:6px 8px;margin-bottom:8px}
.t4h-head{display:flex;justify-content:space-between;align-items:center;font-weight:bold;color:#333;margin-bottom:5px}
.t4h-tbl{width:100%;border-collapse:collapse}
.t4h-tbl td{padding:3px 5px;vertical-align:middle;background:none;border:1px solid #dcdcdc}
.t4h-name{width:112px;color:#333}
.t4h-val{width:78px;color:#000}
.t4h-barcell{width:100%}
.t4h-bar{background:#fff;border:1px solid #c9c9c9;height:13px;overflow:hidden}
.t4h-bar i{display:block;height:100%;background:#7db72f}
.t4h-bar.dark i{background:#3f7a12}
.t4h-up{width:34px;text-align:center;white-space:nowrap}
/* plusul se pierdea pe fundalul gri - acum e verde inchis si ingrosat */
.t4h-up a{color:#1f7a1f;font-weight:bold;text-decoration:none;font-size:13px}
.t4h-up a:hover{color:#0f5c0f;text-decoration:underline}
.t4h-up .none{color:#b0b0b0}
.t4h-num{width:38px;text-align:right;font-weight:bold;color:#333}
/* toate cele 5 optiuni pe acelasi rand, aliniate (inclusiv cerealele) */
.t4h-res form{display:flex;flex-wrap:wrap;align-items:center;gap:4px 10px}
.t4h-res label{display:inline-flex;align-items:center;gap:3px;white-space:nowrap;cursor:pointer}
.t4h-res .t4h-note{flex-basis:100%;margin-top:2px}
.t4h-res img.mini{vertical-align:middle;margin:0 2px}
.t4h-res img.t4h-resall{height:16px;width:auto}
.t4h-note{color:#777;font-size:11px;margin-top:4px}
</style>

<div class="t4h-wrap">

<div class="t4h-panel">
    <div class="t4h-head">
        <span>
            <?php
                if (isset($_GET['rename'])) {
                    echo "<form action=\"\" method=\"POST\" style=\"display:inline;margin:0;\">"
                       . "<input type=\"hidden\" name=\"userid\" value=\"" . $session->uid . "\">"
                       . "<input type=\"hidden\" name=\"hero\" value=\"1\">"
                       . "<input type=\"text\" class=\"text\" name=\"name\" maxlength=\"20\" value=\"" . $hero_info['name'] . "\">";
                } else {
                    echo "<a href=\"build.php?id=" . $id . "&rename\">" . $hero_info['name'] . "</a></form>";
                }
            ?>
            <?php echo LEVEL; ?> <?php echo $hero_info['level']; ?>
            <span class="info">( <?php
                echo "<img class=\"unit u" . $hero_info['unit'] . "\" src=\"img/x.gif\" alt=\"" . $technology->getUnitName($hero_info['unit']) . "\" title=\"" . $technology->getUnitName($hero_info['unit']) . "\" /> "
                   . $technology->getUnitName($hero_info['unit']);
            ?> )</span>
        </span>
        <span><?php echo defined('TZ_POINTS') ? TZ_POINTS : 'Points'; ?></span>
    </div>

    <table class="t4h-tbl">
    <?php
        // nume afisat, valoarea, punctele investite si cheia pentru (+)
        $t4Rows = array(
            array(OFFENCE,      $hero_info['atk'],                                 (int) $hero_info['attack'],       'off'),
            array(DEFENCE,      $hero_info['dc'] . '/' . $hero_info['di'],         (int) $hero_info['defence'],      'deff'),
            array(OFF_BONUS,    $hero_info['ob'] . '%',                            (int) $hero_info['attackbonus'],  'obonus'),
            array(DEF_BONUS,    $hero_info['db'] . '%',                            (int) $hero_info['defencebonus'], 'dbonus'),
            array(REGENERATION, ($hero_info['regeneration'] * 5 * SPEED) . '/' . DAY, (int) $hero_info['regeneration'], 'reg'),
        );

        if ($t4HeroRes) {
            $t4ResPoints = (int) ($hero_info['resources'] ?? 0);
            $t4ResType   = (int) ($hero_info['res_type'] ?? 0);
            $t4PerAll    = defined('HERO_RES_PER_POINT_ALL') ? (int) HERO_RES_PER_POINT_ALL : 3;
            $t4PerOne    = defined('HERO_RES_PER_POINT_ONE') ? (int) HERO_RES_PER_POINT_ONE : 10;

            // valoarea afisata: cat produce efectiv, dupa setarea curenta
            $t4ResShown = ($t4ResType >= 1 && $t4ResType <= 4)
                ? (int) round($t4ResPoints * $t4PerOne * SPEED)
                : (int) round($t4ResPoints * $t4PerAll * SPEED);

            $t4Rows[] = array(
                defined('HERO_RES_PRODUCTION') ? HERO_RES_PRODUCTION : 'Resources',
                $t4ResShown,
                $t4ResPoints,
                'res'
            );
        }

        foreach ($t4Rows as $t4Row) {
            list($t4Label, $t4Value, $t4Points, $t4Key) = $t4Row;
            $t4Fill = max(0, min(100, $t4Points));
    ?>
        <tr>
            <td class="t4h-name"><?php echo $t4Label; ?></td>
            <td class="t4h-val"><?php echo $t4Value; ?></td>
            <td class="t4h-barcell">
                <div class="t4h-bar" title="<?php echo $t4Points; ?>/100"><i style="width:<?php echo $t4Fill; ?>%"></i></div>
            </td>
            <td class="t4h-up"><?php echo $renderAddLink($t4Key); ?></td>
            <td class="t4h-num" id="t4po_<?php echo $t4Key; ?>"><?php echo $t4Points; ?></td>
        </tr>
    <?php } ?>
    </table>
</div>

<?php if ($t4HeroRes) { ?>
<div class="t4h-panel t4h-res">
    <div class="t4h-head"><span><?php echo defined('HERO_RES_TYPE') ? HERO_RES_TYPE : 'Change resource production of the hero'; ?></span></div>
    <form action="" method="POST" style="margin:0;">
        <?php
            // fiecare optiune arata CAT ar produce, ca in Travian
            $t4Opts = array(
                // pentru "toate" folosim o singura iconita combinata, nu patru alaturate
                0 => array('img' => 'img/hero/res_all.png', 'amount' => (int) round($t4ResPoints * $t4PerAll * SPEED)),
                1 => array('icons' => array('r1'), 'amount' => (int) round($t4ResPoints * $t4PerOne * SPEED)),
                2 => array('icons' => array('r2'), 'amount' => (int) round($t4ResPoints * $t4PerOne * SPEED)),
                3 => array('icons' => array('r3'), 'amount' => (int) round($t4ResPoints * $t4PerOne * SPEED)),
                4 => array('icons' => array('r4'), 'amount' => (int) round($t4ResPoints * $t4PerOne * SPEED)),
            );

            foreach ($t4Opts as $t4Val => $t4Opt) {
        ?>
        <label>
            <input type="radio" name="t4restype" value="<?php echo $t4Val; ?>"
                   onchange="this.form.submit();" <?php if ($t4ResType === $t4Val) echo 'checked'; ?>>
            <?php if (isset($t4Opt['img'])) { ?>
                <img class="mini t4h-resall" src="<?php echo $t4Opt['img']; ?>" alt="" />
            <?php } else { foreach ($t4Opt['icons'] as $t4Ico) { ?>
                <img class="mini <?php echo $t4Ico; ?>" src="img/x.gif" alt="" />
            <?php } } ?>
            <?php echo $t4Opt['amount']; ?>
        </label>
        <?php } ?>
        <noscript><input type="submit" value="OK"></noscript>
        <div class="t4h-note"><?php echo defined('HERO_RES_TYPE_HINT') ? HERO_RES_TYPE_HINT : 'Can be changed at any time, free of charge.'; ?></div>
    </form>
</div>
<?php } ?>

<div class="t4h-panel">
    <table class="t4h-tbl">
        <tr>
            <td class="t4h-name"><?php echo defined('TZ_HEALTH') ? TZ_HEALTH : 'Health'; ?></td>
            <td class="t4h-val"><?php echo (int) $hero_info['health']; ?>%</td>
            <td class="t4h-barcell" colspan="3">
                <div class="t4h-bar dark"><i style="width:<?php echo max(0, min(100, (int) $hero_info['health'])); ?>%"></i></div>
            </td>
        </tr>
    </table>
</div>

<div class="t4h-panel">
    <table class="t4h-tbl">
    <?php
        $maxExp     = 495000;
        $curLevel   = (int) $hero_info['level'];
        $curExp     = (int) $hero_info['experience'];
        $expCurrent = $hero_levels[$curLevel] ?? 0;
        $expNext    = $hero_levels[$curLevel + 1] ?? $maxExp;

        if ($curExp < $maxExp && $expNext > $expCurrent && $curLevel < 100) {
            $percent = ($curExp - $expCurrent) / ($expNext - $expCurrent) * 100;
            $percent = max(0, min(100, $percent));
        } else {
            $percent = 100;
        }
    ?>
        <tr>
            <td class="t4h-name" title="<?php echo TZ_UNTIL_THE_NEXT_LEVEL; ?>"><?php echo EXPERIENCE; ?>:</td>
            <td class="t4h-val"><?php echo $curExp; ?></td>
            <td class="t4h-barcell" colspan="2"><div class="t4h-bar"><i style="width:<?php echo (int) $percent; ?>%"></i></div></td>
            <td class="t4h-num" id="t4rem"><?php echo $hero_info['points']; ?></td>
        </tr>
        <tr>
            <td class="t4h-name"><?php echo defined('TZ_HERO_LEVEL') ? TZ_HERO_LEVEL : 'Hero level'; ?></td>
            <td class="t4h-val"><?php echo $curLevel; ?></td>
            <td class="t4h-barcell" colspan="3"><div class="t4h-bar"><i style="width:<?php echo max(0, min(100, $curLevel)); ?>%"></i></div></td>
        </tr>
    </table>
</div>

</div>

<?php if ((int) $hero_info['points'] > 0) { ?>
<form id="t4PointsForm" action="" method="POST" style="margin:6px 0;">
    <input type="hidden" name="t4points" value="1">
    <?php foreach ($heroStatColumns as $t4Key => $t4Col) { ?>
        <input type="hidden" name="p_<?php echo $t4Key; ?>" id="t4in_<?php echo $t4Key; ?>" value="0">
    <?php } ?>
    <div id="t4PointsBar" style="display:none;">
        <button type="submit" id="t4PointsSave"><b>&#10003;</b> <?php echo defined('HERO_POINTS_SAVE') ? HERO_POINTS_SAVE : 'Save points'; ?> (<span id="t4PointsCount">0</span>)</button>
        <a href="#" id="t4PointsCancel" style="margin-left:8px;"><?php echo defined('HERO_POINTS_CANCEL') ? HERO_POINTS_CANCEL : 'Cancel'; ?></a>
    </div>
</form>

<script type="text/javascript">
/* Distribuirea punctelor fara reincarcarea paginii la fiecare click.
   Fara JS, linkurile (+) raman GET-uri normale si merg ca inainte.
   JS-ul doar ADUNA local; adevarul ramane la server, care valideaza totul
   intr-un singur UPDATE atomic (vezi handlerul t4points din acest fisier). */
(function () {
    var available = <?php echo (int) $hero_info['points']; ?>;
    var links     = document.getElementsByClassName('t4AddPoint');

    if (!links.length) { return; }

    var pending = {}, base = {};
    var bar     = document.getElementById('t4PointsBar');
    var counter = document.getElementById('t4PointsCount');
    var remCell = document.getElementById('t4rem');

    function render() {
        var used = 0, stat;

        for (stat in pending) {
            if (pending.hasOwnProperty(stat)) {
                used += pending[stat];

                var cell = document.getElementById('t4po_' + stat);
                if (cell) {
                    cell.innerHTML = pending[stat] > 0
                        ? base[stat] + ' <span style="color:#0a0;">(+' + pending[stat] + ')</span>'
                        : String(base[stat]);
                }

                var input = document.getElementById('t4in_' + stat);
                if (input) { input.value = pending[stat]; }
            }
        }

        if (remCell) { remCell.innerHTML = String(available - used); }
        if (counter) { counter.innerHTML = String(used); }
        if (bar)     { bar.style.display = used > 0 ? '' : 'none'; }
    }

    for (var i = 0; i < links.length; i++) {
        (function (link) {
            var stat = link.getAttribute('data-stat');
            base[stat]    = parseInt(link.getAttribute('data-base'), 10) || 0;
            pending[stat] = 0;

            link.onclick = function (e) {
                e.preventDefault();

                var used = 0;
                for (var k in pending) { if (pending.hasOwnProperty(k)) { used += pending[k]; } }

                // nu poti aloca mai mult decat ai, nici trece de 100 pe o statistica
                if (used >= available) { return false; }
                if (base[stat] + pending[stat] >= 100) { return false; }

                pending[stat]++;
                render();
                return false;
            };

            // click dreapta pe (+) scade alocarea, ca sa poti corecta fara reload
            link.oncontextmenu = function (e) {
                e.preventDefault();
                if (pending[stat] > 0) { pending[stat]--; render(); }
                return false;
            };
        })(links[i]);
    }

    var cancel = document.getElementById('t4PointsCancel');
    if (cancel) {
        cancel.onclick = function (e) {
            e.preventDefault();
            for (var k in pending) { if (pending.hasOwnProperty(k)) { pending[k] = 0; } }
            render();
            return false;
        };
    }
})();
</script>
<?php } ?>
	<?php if(isset($_GET['e'])){ 
        echo "<p><font size=\"1\" color=\"red\"><b>".ERROR_NAME_SHORT."</b></font></p>"; 
    } 
    ?> 
    <?php if($hero_info['level'] <= 3){ ?> 
        <p><?php echo YOU_CAN; ?> <a href="build.php?id=<?php echo $id; ?>&add=reset"><?php echo RESET; ?></a><?php echo YOUR_POINT_UNTIL; ?> <b>3</b><?php echo OR_LOWER; ?> </p> 
    <?php } ?> 
     
<p><?php echo YOUR_HERO_HAS; ?> <b><?php echo floor($hero_info['health']); ?></b>% <?php echo OF_HIT_POINTS; ?>.<br/>  
    <?php echo YOUR_HERO_HAS; ?> <?php echo CONQUERED; ?> <b><?php echo $database->VillageOasisCount($village->wid); ?></b> <a href="build.php?id=<?php echo $id; ?>&land"><?php echo OASES; ?></a>.</p> 
	 
<?php
// NOTE: the actions below are triggered by GET (?add=...) and modify
// data in the DB. This was the original (without CSRF), I did not change this aspect -
// it is an existing behavior in all build.php, not specific to this file.
// Distribuire IN BLOC (butonul "Save" din interfata cu JS).
// Siguranta: totul se valideaza pe server intr-un SINGUR UPDATE atomic, cu
// garzi in WHERE. Daca cineva trimite un POST modificat (mai multe puncte decat
// are, sau peste 100 la o statistica), conditiile nu se potrivesc, UPDATE-ul nu
// afecteaza niciun rand si nu se schimba nimic. Fiind o singura instructiune,
// nici doua cereri trimise simultan nu pot cheltui aceleasi puncte de doua ori.
// Schimbarea resursei favorizate. In T4 setarea asta e libera: nu costa puncte
// si nu are nevoie de Book of Wisdom, doar redistribuie acelasi bonus.
if ($t4HeroRes && isset($_POST['t4restype'])) {

	$t4Type = (int) $_POST['t4restype'];

	if ($t4Type >= 0 && $t4Type <= 4) {
		$t4Stmt = $database->dblink->prepare(
			"UPDATE " . TB_PREFIX . "hero SET `res_type` = ? WHERE `heroid` = ? LIMIT 1"
		);

		if ($t4Stmt) {
			$t4HeroId = (int) $hero_info['heroid'];
			$t4Stmt->bind_param('ii', $t4Type, $t4HeroId);
			$t4Stmt->execute();
			$t4Stmt->close();
		}
	}

	header("Location: build.php?id=" . $id);
	exit;
}

// Distribuire IN BLOC (butonul "Save" din interfata cu JS).
// Siguranta: totul se valideaza pe server intr-un SINGUR UPDATE atomic, cu
// garzi in WHERE. Daca cineva trimite un POST modificat (mai multe puncte decat
// are, sau peste 100 la o statistica), conditiile nu se potrivesc, UPDATE-ul nu
// afecteaza niciun rand si nu se schimba nimic. Fiind o singura instructiune,
// nici doua cereri trimise simultan nu pot cheltui aceleasi puncte de doua ori.
if (isset($_POST['t4points'])) {

	$t4Alloc = array();
	$t4Total = 0;

	foreach ($heroStatColumns as $t4Key => $t4Col) {
		$t4Value = isset($_POST['p_' . $t4Key]) ? (int) $_POST['p_' . $t4Key] : 0;

		if ($t4Value < 0) {
			$t4Value = 0;
		}

		$t4Alloc[$t4Col] = $t4Value;
		$t4Total        += $t4Value;
	}

	if ($t4Total > 0) {
		// Interogarea se construieste din $heroStatColumns, deci acopera exact
		// atributele active. Cu functiile T4 oprite nu apare deloc coloana
		// `resources`, asa ca pagina merge si pe un server care inca nu a rulat
		// scriptul add-hero-resources.sql.
		$t4Cols  = array_values($heroStatColumns);
		$t4Set   = array();
		$t4Guard = array();

		foreach ($t4Cols as $t4Col) {
			$t4Set[]   = "`" . $t4Col . "` = `" . $t4Col . "` + ?";
			$t4Guard[] = "`" . $t4Col . "` + ? <= 100";
		}

		$t4Stmt = $database->dblink->prepare(
			"UPDATE " . TB_PREFIX . "hero SET " . implode(", ", $t4Set) . ",
					`points` = `points` - ?
			 WHERE `heroid` = ?
			   AND `points` >= ?
			   AND " . implode(" AND ", $t4Guard)
		);

		if ($t4Stmt) {
			$t4HeroId = (int) $hero_info['heroid'];

			// ordinea parametrilor: cresterile, punctele scazute, heroid, garda
			// de puncte, apoi garzile de maxim 100 pentru fiecare atribut
			$t4Values = array();

			foreach ($t4Cols as $t4Col) { $t4Values[] = $t4Alloc[$t4Col]; }

			$t4Values[] = $t4Total;
			$t4Values[] = $t4HeroId;
			$t4Values[] = $t4Total;

			foreach ($t4Cols as $t4Col) { $t4Values[] = $t4Alloc[$t4Col]; }

			$t4Stmt->bind_param(str_repeat('i', count($t4Values)), ...$t4Values);
			$t4Stmt->execute();
			$t4Stmt->close();
		}
	}

	header("Location: build.php?id=" . $id);
	exit;
}

if (isset($_GET['add'])) {
	$action = $_GET['add'];

	if ($action == "reset") {
		if ($hero_info['level'] <= 3) {
			mysqli_query($database->dblink, "UPDATE " . TB_PREFIX . "hero SET `points` = (`level` * 5) + 5, `attack` = 0, `defence` = 0, `attackbonus` = 0, `defencebonus` = 0, `regeneration` = 0 WHERE `heroid` = " . $hero_info['heroid'] . " AND `level` <= 3 AND (`attack` != 0 OR `defence` != 0 OR `attackbonus` != 0 OR `defencebonus` != 0 OR `regeneration` != 0)");
			header("Location: build.php?id=" . $id . "");
			exit;
		}
	// if level > 3, exactly like in the original: nothing happens (no redirect).
	} elseif (isset($heroStatColumns[$action])) {
		$column = $heroStatColumns[$action];
		mysqli_query($database->dblink, "UPDATE " . TB_PREFIX . "hero SET `$column` = `$column` + 1, `points` = `points` - 1 WHERE `heroid` = " . $hero_info['heroid'] . " AND `points` > 0 AND `$column` < 100");
		header("Location: build.php?id=" . $id . "");
		exit;
	}
}
?>
