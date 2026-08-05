<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : units_common.tpl                                          ##
##  Type           : Rally Point Troop Selection Form (all tribes)             ##
## --------------------------------------------------------------------------- ##
##  Developed by   : Shadow                                                    ##
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

/**
 * Formularul de trimitere a trupelor, comun tuturor triburilor.
 *
 * Inainte exista cate un fisier units_1..units_9, identice in afara numerelor
 * de unitati - aproape 950 de linii duplicate. Orice reparatie trebuia facuta
 * de noua ori, iar in practica se uita cate una.
 *
 * Unitatile unui trib sunt un bloc de zece, consecutiv:
 *     tribul 1 -> u1..u10,  tribul 2 -> u11..u20,  tribul 9 -> u81..u90
 * deci primul indice e (trib - 1) * 10 + 1.
 *
 * Fisierele units_N.tpl au ramas, ca sa nu se schimbe modul de includere din
 * a2b.php, dar acum doar apeleaza acest sablon.
 */

$a2bTribe = isset($session->tribe) ? (int) $session->tribe : 1;

if ($a2bTribe < 1 || $a2bTribe > 9) {
    $a2bTribe = 1;
}

$a2bFirstUnit = ($a2bTribe - 1) * 10 + 1;

// Natarii nu au erou, deci nu li se arata casuta lui.
$a2bShowHero = ($a2bTribe !== 5) && !empty($village->unitarray['hero']);

/**
 * Deseneaza o casuta de unitate.
 *
 * @param int    $slot   pozitia in formular (1..10) - devine numele campului tN
 * @param int    $unitId identificatorul real al unitatii (u1..u90)
 * @param string $class  clasele celulei din tabel
 */
if (!function_exists('a2b_unit_cell')) {
    function a2b_unit_cell($slot, $unitId, $class)
    {
        global $village;

        $have  = isset($village->unitarray['u' . $unitId])
               ? (int) $village->unitarray['u' . $unitId] : 0;
        $label = defined('U' . $unitId) ? constant('U' . $unitId) : ('u' . $unitId);
        $field = 't' . (int) $slot;

        echo '<td class="' . htmlspecialchars($class, ENT_QUOTES, 'UTF-8') . '">';
        echo '<img class="unit u' . (int) $unitId . '" src="img/x.gif"'
           . ' title="' . htmlspecialchars($label, ENT_QUOTES, 'UTF-8') . '"'
           . ' alt="' . htmlspecialchars($label, ENT_QUOTES, 'UTF-8') . '"'
           . ' onclick="document.snd.' . $field . '.value=\'\'; return false;">';
        echo ' <input class="text" name="' . $field . '" value="" maxlength="6" type="text"'
           . ($have <= 0 ? ' disabled="disabled"' : '') . '>';

        if ($have > 0) {
            echo ' <a href="#" onclick="document.snd.' . $field . '.value=' . $have
               . '; return false;">(' . $have . ')</a>';
        } else {
            echo ' <span class="none">(0)</span>';
        }

        echo '</td>';
    }
}
?>
<h1><?php echo SEND_TROOPS; ?></h1>

<form method="POST" name="snd" action="a2b.php">
    <input name="b" value="1" type="hidden">

    <table id="troops" cellpadding="1" cellspacing="1">
        <tbody>
        <tr>
            <?php
                // primul rand: unitatile 1-5 ale tribului
                for ($i = 0; $i < 5; $i++) {
                    a2b_unit_cell(
                        $i + 1,
                        $a2bFirstUnit + $i,
                        'line-first ' . ($i === 0 ? 'column-first large' : 'large')
                    );
                }
            ?>
            <td class="line-first column-last"></td>
        </tr>
        <tr>
            <?php
                // al doilea rand: unitatile 6-10
                for ($i = 5; $i < 10; $i++) {
                    a2b_unit_cell(
                        $i + 1,
                        $a2bFirstUnit + $i,
                        $i === 5 ? 'column-first large' : 'large'
                    );
                }
            ?>
            <td class="column-last"></td>
        </tr>
        <tr>
            <?php
                /**
                 * Casuta eroului.
                 *
                 * BUG REPARAT: varianta veche deschidea celula in HTML si o
                 * inchidea in interiorul unui echo, dar mai lasa un </td> si
                 * dupa blocul PHP. Cand eroul era in sat se generau DOUA
                 * inchideri, iar tabelul iesea stricat. Acum celula se inchide
                 * o singura data, pe ambele ramuri.
                 */
                if ($a2bShowHero) {
                    $heroCount = (int) $village->unitarray['hero'];
                    $heroLabel = defined('TZ_HERO') ? TZ_HERO : 'Hero';
            ?>
            <td class="line-last column-first regular">
                <img class="unit uhero" src="img/x.gif"
                     title="<?php echo htmlspecialchars($heroLabel, ENT_QUOTES, 'UTF-8'); ?>"
                     alt="<?php echo htmlspecialchars($heroLabel, ENT_QUOTES, 'UTF-8'); ?>">
                <input class="text" name="t11" value="" maxlength="6" type="text">
                <a href="#" onclick="document.snd.t11.value=<?php echo $heroCount; ?>; return false;">(<?php echo $heroCount; ?>)</a>
            </td>
            <?php } else { ?>
            <td class="line-last column-first regular"></td>
            <?php } ?>
            <td class="line-last regular"></td>
            <td class="line-last column-last"></td>
        </tr>
        </tbody>
    </table>
<?php
/**
 * ATENTIE: formularul ramane DESCHIS aici, intentionat.
 *
 * a2b.php include imediat dupa acest sablon si search.tpl, care adauga
 * campurile de destinatie si butonul OK, apoi inchide </form>. Daca inchidem
 * formularul aici, butonul ramane in afara lui si trimiterea trupelor nu mai
 * face nimic - fara niciun mesaj de eroare.
 */
?>
