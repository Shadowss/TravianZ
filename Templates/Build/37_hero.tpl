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

<table id="distribution" cellpadding="1" cellspacing="1"> 
	<thead><tr>
		<th colspan="5">
			<?php  
				if(isset($_GET['rename'])){ 
					echo "<form action=\"\" method=\"POST\"><input type=\"hidden\" name=\"userid\" value=\"".$session->uid."\"><input type=\"hidden\" name=\"hero\" value=\"1\"><input type=\"text\" class=\"text\" name=\"name\" maxlength=\"20\" value=\"".$hero_info['name']."\">";             
				}else{ 
					echo "<a href=\"build.php?id=".$id."&rename\">".$hero_info['name']."</a></form>"; 
				} 
			?>
			<?php echo LEVEL; ?> <?php echo $hero_info['level']; ?> <span class="info">( <?php echo"<img class=\"unit u".$hero_info['unit']."\" src=\"img/x.gif\" alt=\"".$technology->getUnitName($hero_info['unit'])."\" title=\"".$technology->getUnitName($hero_info['unit'])."\" /> ".$technology->getUnitName($hero_info['unit']); ?> )</span></th>
	</tr></thead> 
    <tbody><tr> 
        <th><?php echo OFFENCE; ?></th> 
        <td class="val"><?php echo $hero_info['atk']; ?></td> 
        <td class="xp"><img class="bar" src="img/x.gif" style="width:<?php echo (2*$hero_info['attack'])+1; ?>px;" alt="<?php echo $hero_info['atk']; ?>" title="<?php echo $hero_info['atk']; ?>" /></td> 
        <td class="up"><span class="none"> 
        <?php echo $renderAddLink('off'); ?> 
        </td> 
        <td class="po" id="t4po_off"><?php echo $hero_info['attack']; ?></td> 
    </tr> 
    <tr> 
        <th><?php echo DEFENCE; ?></th> 
        <td class="val"><?php echo $hero_info['dc'] . "/" . $hero_info['di']; ?></td> 
        <td class="xp"><img class="bar" src="img/x.gif" style="width:<?php echo (2*$hero_info['defence'])+1; ?>px;" alt="<?php echo ($hero_info['di']) . "/" . ($hero_info['dc']); ?>"  title="<?php echo ($hero_info['di']) . "/" . ($hero_info['dc']); ?>" /></td> 
        <td class="up"><span class="none"> 
        <?php echo $renderAddLink('deff'); ?> 
        </td> 
        <td class="po" id="t4po_deff"><?php echo $hero_info['defence']; ?></td> 
    </tr> 
        <tr> 
        <th><?php echo OFF_BONUS; ?></th> 
        <td class="val"><?php echo ($hero_info['ob']-1)*100; ?>%</td> 
        <td class="xp"><img class="bar" src="img/x.gif" style="width:<?php echo ($hero_info['ob']-1)*1000+1; ?>px;" alt="<?php echo ($hero_info['ob']-1)*100; ?>%" title="<?php echo ($hero_info['ob']-1)*100; ?>%" /></td> 
        <td class="up"><span class="none"> 
        <?php echo $renderAddLink('obonus'); ?> 
        </td> 
        <td class="po" id="t4po_obonus"><?php echo $hero_info['attackbonus']; ?></td> 
    </tr> 
    <tr> 
        <th><?php echo DEF_BONUS; ?></th> 
        <td class="val"><?php echo ($hero_info['db']-1)*100; ?>%</td> 
        <td class="xp"><img class="bar" src="img/x.gif" style="width:<?php echo ($hero_info['db']-1)*1000+1; ?>px;" alt="<?php echo ($hero_info['db']-1)*100; ?>%" title="<?php echo ($hero_info['db']-1)*100; ?>%" /></td> 
        <td class="up"><span class="none"> 
        <?php echo $renderAddLink('dbonus'); ?>
        </td> 
        <td class="po" id="t4po_dbonus"><?php echo $hero_info['defencebonus']; ?></td> 
    </tr> 
    <tr> 
        <th><?php echo REGENERATION; ?></th> 
        <td class="val"><?php echo ($hero_info['regeneration']*5*SPEED); ?>/<?php echo DAY; ?></td> 
        <td class="xp"><img class="bar" src="img/x.gif" style="width:<?php echo ($hero_info['regeneration']*2)+1; ?>px;" alt="<?php echo ($hero_info['regeneration']*5*SPEED); ?>%/Day" title="<?php echo ($hero_info['regeneration']*5*SPEED); ?>%/Day" /></td> 
        <td class="up"><span class="none"> 
        <?php echo $renderAddLink('reg'); ?> 
        </td> 
        <td class="po" id="t4po_reg"><?php echo $hero_info['regeneration']; ?></td> 
    </tr> 
        <tr> 
        <td colspan="5" class="empty"></td> 
    </tr> 
	<tr> 
		<?php
			$maxExp = 495000;
			$curLevel = (int)$hero_info['level'];
			$curExp   = (int)$hero_info['experience'];

		// fallback-uri ca să nu mai dea notice
			$expCurrent = $hero_levels[$curLevel] ?? 0;
			$expNext    = $hero_levels[$curLevel + 1] ?? $maxExp;

		if($curExp < $maxExp && $expNext > $expCurrent && $curLevel < 100){
			$percent = ($curExp - $expCurrent) / ($expNext - $expCurrent) * 100;
			$percent = max(0, min(100, $percent));
		?>
		<th title="<?php echo TZ_UNTIL_THE_NEXT_LEVEL; ?>"><?php echo EXPERIENCE; ?>:</th> 
		<td class="val"><?php echo (int)$percent; ?>%</td>
		<td class="xp"><img class="bar" src="img/x.gif" style="width:<?php echo $percent*2; ?>px;" alt="<?php echo (int)$percent; ?>%" title="<?php echo (int)$percent; ?>%" /></td>
		<td class="up"></td> 
		<td class="rem" id="t4rem"><?php echo $hero_info['points']; ?></td> 
	<?php }else{ ?>
		<th title="<?php echo TZ_UNTIL_THE_NEXT_LEVEL; ?>"><?php echo EXPERIENCE; ?>:</th> 
		<td class="val">100%</td> 
		<td class="xp"><img class="bar" src="img/x.gif" style="width:200px;" alt="100%" title="100%" /></td>
		<td class="up"></td> 
		<td class="rem" id="t4rem"><?php echo $hero_info['points']; ?></td> 
	<?php } ?>
	</tr>
    </tbody> 
    </table> 
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
		$t4Stmt = $database->dblink->prepare(
			"UPDATE " . TB_PREFIX . "hero SET
				`attack`        = `attack` + ?,
				`defence`       = `defence` + ?,
				`attackbonus`   = `attackbonus` + ?,
				`defencebonus`  = `defencebonus` + ?,
				`regeneration`  = `regeneration` + ?,
				`points`        = `points` - ?
			 WHERE `heroid` = ?
			   AND `points` >= ?
			   AND `attack` + ?       <= 100
			   AND `defence` + ?      <= 100
			   AND `attackbonus` + ?  <= 100
			   AND `defencebonus` + ? <= 100
			   AND `regeneration` + ? <= 100"
		);

		if ($t4Stmt) {
			$t4HeroId = (int) $hero_info['heroid'];

			$t4Stmt->bind_param(
				'iiiiiiiiiiiii',
				$t4Alloc['attack'], $t4Alloc['defence'], $t4Alloc['attackbonus'],
				$t4Alloc['defencebonus'], $t4Alloc['regeneration'],
				$t4Total, $t4HeroId, $t4Total,
				$t4Alloc['attack'], $t4Alloc['defence'], $t4Alloc['attackbonus'],
				$t4Alloc['defencebonus'], $t4Alloc['regeneration']
			);

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
