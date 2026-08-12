<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ      					       		 		  	   ##
##  Version:       06.05.2026 						       	 				   ##
##  Filename       account.tpl                                                 ##
##  Refactored by  Shadow					                                   ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2026. All rights reserved.                ##
##  URLs:          http://travianz.org						       	 		   ##
##  Source code:   http://github.com/Shadowss/TravianZ/         	       	   ##
##                                                                             ##
#################################################################################

?>

<h1><?php echo PLAYER_PROFILE; ?></h1>

<?php include("menu.tpl"); ?>

<?php
// =========================
// INIT HELPERS (safe vars)
// =========================
$pwError     = $form->getError("pw");
$emailError  = $form->getError("email");
$sitterError = $form->getError("sit");

// Sitters count (keep original logic)
$count = 0;
if ($session->userinfo['sit1'] != 0) $count += 1;
if ($session->userinfo['sit2'] != 0) $count += 1;

/**
 * PERMISIUNI SITTER
 *
 * Lista e definita o singura data si folosita si la sitterii existenti, si la
 * casuta de adaugare, ca sa nu se desincronizeze. Cheile din $_POST sunt
 * perm1[], perm2[] si perm_new[], fiecare continand valorile bitilor bifati.
 */
$sitterPermList = array(
    SITTER_PERM_ATTACK => defined('SITTER_P_ATTACK') ? SITTER_P_ATTACK : 'send attacks',
    SITTER_PERM_RAID   => defined('SITTER_P_RAID')   ? SITTER_P_RAID   : 'send raids',
    SITTER_PERM_REINF  => defined('SITTER_P_REINF')  ? SITTER_P_REINF  : 'send reinforcements',
    SITTER_PERM_RES    => defined('SITTER_P_RES')    ? SITTER_P_RES    : 'send resources to other players',
    SITTER_PERM_GOLD   => defined('SITTER_P_GOLD')   ? SITTER_P_GOLD   : 'spend Gold',
);

/**
 * Casutele editabile pentru un slot de sitter.
 * $mask = permisiunile curente, $field = numele campului din formular.
 */
function sitterPermBoxes($mask, $field, $list) {

    /**
     * Marcaj ascuns: o casuta nebifata nu se trimite deloc prin POST, deci
     * "toate debifate" ar arata identic cu "sectiunea nu a fost afisata".
     * Campul asta e mereu trimis, asa ca Profile.php poate deosebi cele doua
     * situatii si nu reseteaza permisiunile din greseala.
     */
    $out  = '<input type="hidden" name="' . $field . '_sent" value="1" />';
    $out .= '<ul class="permGrid">';

    foreach ($list as $bit => $label) {

        $on = (((int) $mask & $bit) === $bit);

        $out .= '<li class="permItem' . ($on ? ' isOn' : '') . '">'
              . '<label>'
              . '<input type="checkbox" name="' . $field . '[]" value="' . (int) $bit . '"'
              . ($on ? ' checked' : '') . ' />'
              . '<span>' . htmlspecialchars($label, ENT_QUOTES, 'UTF-8') . '</span>'
              . '</label></li>';
    }

    return $out . '</ul>';
}

/**
 * Aceleasi drepturi, dar DOAR pentru citire: se foloseste in lista conturilor
 * pe care esti tu sitter, ca sa vezi ce ti-a permis fiecare proprietar.
 * Bifa verde = ai voie, X gri = nu ai voie.
 */
function sitterPermView($mask, $list) {

    $out = '<ul class="permGrid permView">';

    foreach ($list as $bit => $label) {

        $on = (((int) $mask & $bit) === $bit);

        $out .= '<li class="permItem ' . ($on ? 'isOn' : 'isOff') . '">'
              . '<i class="permMark">' . ($on ? '&#10003;' : '&#10007;') . '</i>'
              . '<span>' . htmlspecialchars($label, ENT_QUOTES, 'UTF-8') . '</span>'
              . '</li>';
    }

    return $out . '</ul>';
}
?>

<form action="spieler.php" method="POST">
<input type="hidden" name="ft" value="p3">

<!-- =========================
     CHANGE PASSWORD
========================= -->
<table cellpadding="1" cellspacing="1" id="change_pass" class="account">
<thead>
<tr>
    <th colspan="2"><?php echo CHANGE_PASSWORD; ?></th>
</tr>
</thead>
<tbody>
<tr>
    <th><?php echo OLD_PASSWORD; ?></th>
    <td><input class="text" type="password" name="pw1" maxlength="30" /></td>
</tr>

<tr>
    <th><?php echo NEW_PASSWORD; ?></th>
    <td><input class="text" type="password" name="pw2" maxlength="30" /></td>
</tr>

<tr>
    <th><?php echo NEW_PASSWORD; ?></th>
    <td><input class="text" type="password" name="pw3" maxlength="30" /></td>
</tr>
</tbody>
</table>

<?php
// Password error output (unchanged logic)
if (!empty($pwError)) {
    echo "<span class=\"error\">".$pwError."</span>";
}
?>

<!-- =========================
     CHANGE EMAIL
========================= -->
<table cellpadding="1" cellspacing="1" id="change_mail" class="account">
<thead>
<tr>
    <th colspan="2"><?php echo CHANGE_EMAIL; ?></th>
</tr>
</thead>
<tbody>
<tr>
    <td class="note" colspan="2">
        <?php echo TZ_PLEASE_ENTER_YOUR_OLD_AND_YOUR_NEW; ?>
    </td>
</tr>

<tr>
    <th><?php echo CURRENT_EMAIL; ?></th>
    <td><?php echo htmlspecialchars($session->userinfo['email'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
</tr>

<tr>
    <th><?php echo OLD_EMAIL; ?></th>
    <td><input class="text" type="text" name="email_alt" /></td>
</tr>

<tr>
    <th><?php echo NEW_EMAIL; ?></th>
    <td><input class="text" type="text" name="email_neu" /></td>
</tr>
</tbody>
</table>

<?php
if (!empty($emailError)) {
    echo "<span class=\"error\">".$emailError."</span>";
}
?>

<style type="text/css">
/* =======================================================================
   Sitteri: permisiuni
   Totul e limitat la #sitter, deci nu atinge restul paginii de cont.

   Fara CSS grid si fara "gap": jocul e deschis si din browsere vechi, iar
   acolo grid-ul cade pe o singura coloana, iar gap-ul e ignorat (bifele
   raman lipite de text). inline-block + margini merg peste tot.
   ======================================================================= */

/* --- cardul unui sitter: nume sus, drepturi dedesubt --- */
#sitter .sitterCard {
    margin: 0 0 8px 0;
    padding: 7px 9px;
    background: #fbfaf8;
    border: 1px solid #dedbd4;
    border-radius: 4px;
}

#sitter .sitterCard:last-child { margin-bottom: 0; }

#sitter .sitterCard { text-align: left; }

#sitter .sitterHead {
    padding-bottom: 6px;
    margin-bottom: 7px;
    border-bottom: 1px solid #e8e5df;
}

#sitter .sitterHead .del  { margin-right: 6px; vertical-align: -1px; cursor: pointer; }
#sitter .sitterHead .name { font-weight: bold; }

/* --- grila de drepturi: doua coloane --- */
#sitter .permGrid {
    margin: 0;
    padding: 0;
    list-style: none;
    font-size: 0;          /* elimina spatiul dintre elementele inline-block */
    text-align: left;      /* celulele tabelului sunt centrate; grila nu trebuie */
}

#sitter .permGrid .permItem {
    display: inline-block;
    width: 50%;
    box-sizing: border-box;
    margin: 0;
    padding: 2px 10px 2px 0;
    font-size: 11px;
    line-height: 15px;
    color: #6f6b64;
    vertical-align: top;
}

#sitter .permGrid .permItem label {
    display: block;
    font-weight: normal;
    cursor: pointer;
}

#sitter .permGrid .permItem input {
    margin: 0 5px 0 0;
    padding: 0;
    vertical-align: -1px;
}

#sitter .permGrid .permItem.isOn { color: #2f2d29; }

/* --- varianta doar-citire (conturile pe care esti TU sitter) --- */
#sitter .permMark {
    display: inline-block;
    width: 13px;
    height: 13px;
    margin-right: 5px;
    line-height: 13px;
    text-align: center;
    font-style: normal;
    font-size: 10px;
    border-radius: 2px;
    vertical-align: -2px;
}

#sitter .permView .isOn  .permMark { color: #ffffff; background: #5aa02c; }
#sitter .permView .isOff .permMark { color: #ffffff; background: #c2bfb8; }
#sitter .permView .isOff { color: #a5a19a; }

/* --- casuta de adaugare a unui sitter nou --- */
/* titlul cardului de adaugare: acelasi loc ca numele unui sitter existent,
   dar fara accentul de nume propriu */
#sitter .addSitter .name { font-weight: normal; color: #8a877f; }

#sitter span.none { color: #a5a19a; }
</style>

<!-- =========================
     SITTERS
========================= -->
<table cellpadding="1" cellspacing="1" id="sitter" class="account">
<thead>
<tr>
    <th colspan="2"><?php echo ACCOUNT_SITTERS; ?></th>
</tr>
</thead>

<tbody>
<tr>
    <td class="note" colspan="2">
        <?php echo TZ_A_SITTER_CAN_LOG_INTO_YOUR_ACCOUNT; ?>
    </td>
</tr>

<?php if ($count < 2) { ?>
<tr>
    <th><?php echo SITTER_NAME; ?></th>
    <td>
        <input class="text" type="text" name="v1" maxlength="15">
        <span class="count">(<?php echo $count; ?>/2)</span>
    </td>
</tr>
<tr>
    <td colspan="2" class="sitter">
        <?php
        /**
         * Permisiunile noului sitter stau pe UN RAND PROPRIU, pe toata latimea.
         *
         * Inainte erau inghesuite in celula de langa "Name of the sitter", care
         * are ~300px: cele doua coloane ieseau la ~150px fiecare, iar etichetele
         * lungi ("send resources to other players") se taiau. Acum folosesc
         * acelasi card ca sitterii existenti de mai jos, deci si latimea, si
         * aspectul sunt identice.
         */
        ?>
        <div class="sitterCard addSitter">
            <div class="sitterHead">
                <span class="name"><?php
                    echo defined('SITTER_P_HINT') ? SITTER_P_HINT : 'Permissions for the new sitter:';
                ?></span>
            </div>
            <?php
            // permisiunile cu care intra noul sitter; implicit toate bifate
            echo sitterPermBoxes(SITTER_PERM_ALL, 'perm_new', $sitterPermList);
            ?>
        </div>
    </td>
</tr>
<?php } ?>

<tr>
<td colspan="2" class="sitter">

<?php
// =========================
// OWN SITTERS (sit1/sit2)
// =========================
if ($count == 0) {
    echo "<span class=\"none\">You have no sitters.</span>";
}

$sitSlots = [1 => 'sit1', 2 => 'sit2'];

foreach ($sitSlots as $type => $key) {
    if ($session->userinfo[$key] != 0) {
        $uid = $session->userinfo[$key];
        $uname = $database->getUserField($uid, "username", 0);

        // permisiunile curente ale acestui sitter
        $permField = 'perm' . $type;
        $permMask  = isset($session->userinfo[$key . '_perm'])
            ? (int) $session->userinfo[$key . '_perm']
            : SITTER_PERM_ALL;

        echo "<div class=\"sitterCard\">";
        echo "<div class=\"sitterHead\">";
        echo "<a href=\"spieler.php?s=3&e=3&id=".$uid."&a=".$session->checker."&type=".$type."\">";
        echo "<img class=\"del\" src=\"img/x.gif\" title=\"Remove sitters\" alt=\"Remove sitters\" />";
        echo "</a>";
        echo "<a class=\"name\" href=\"spieler.php?uid=".$uid."\">".$uname."</a>";
        echo "</div>";

        echo sitterPermBoxes($permMask, $permField, $sitterPermList);
        echo "</div>";
    }
}
?>

</td>
</tr>

<tr>
<td class="note" colspan="2">
    <?php echo TZ_YOU_HAVE_BEEN_ENTERED_AS_SITTER_ON; ?>
</td>
</tr>

<tr>
<td colspan="2" class="sitter">

<?php
// =========================
// ACCOUNTS WHERE USER IS SITTER
// =========================
$sitee = $database->getSitee($session->uid);

if (count($sitee) == 0) {
    // textul de aici spunea tot "You have no sitters", desi lista arata
    // conturile pe care esti TU sitter - doua lucruri diferite
    echo "<span class=\"none\">"
       . (defined('SITTER_P_NOT_SITTING') ? SITTER_P_NOT_SITTING
          : 'You are not a sitter on any account.')
       . "</span>";
} else {
    foreach ($sitee as $sit) {

        /**
         * Ce drepturi mi-a dat ACEST proprietar.
         *
         * getSitee() intoarce randul lui, deci ne uitam pe care dintre cele
         * doua sloturi stam si citim masca potrivita. Daca serverul inca nu are
         * coloanele (migrarea nerulata), cadem pe SITTER_PERM_ALL - exact ce
         * face si backendul, deci afisajul nu minte.
         */
        $myMask = SITTER_PERM_ALL;

        if ((int) ($sit['sit1'] ?? 0) === (int) $session->uid) {
            $myMask = isset($sit['sit1_perm']) ? (int) $sit['sit1_perm'] : SITTER_PERM_ALL;
        } else if ((int) ($sit['sit2'] ?? 0) === (int) $session->uid) {
            $myMask = isset($sit['sit2_perm']) ? (int) $sit['sit2_perm'] : SITTER_PERM_ALL;
        }

        echo "<div class=\"sitterCard\">";
        echo "<div class=\"sitterHead\">";
        echo "<a href=\"spieler.php?s=3&e=2&id=".$sit['id']."&a=".$session->checker."\">";
        echo "<img class=\"del\" src=\"img/x.gif\" title=\"Remove sitters\" alt=\"Remove sitters\" />";
        echo "</a>";
        echo "<a class=\"name\" href=\"spieler.php?uid=".$sit['id']."\">"
           . $database->getUserField($sit['id'], "username", 0)."</a>";
        echo "</div>";

        echo sitterPermView($myMask, $sitterPermList);
        echo "</div>";
    }
}
?>

</td>
</tr>
</tbody>
</table>

<?php
if (!empty($sitterError)) {
    echo "<span class=\"error\">".$sitterError."</span>";
}
?>

<!-- =========================
     DELETE ACCOUNT
========================= -->
<table cellpadding="1" cellspacing="1" id="del_acc" class="account">
<thead>
<tr>
    <th colspan="2"><?php echo VAC_OP6; ?></th>
</tr>
</thead>

<tbody>
<tr>
    <td class="note" colspan="2">
        <?php echo TZ_YOU_CAN_DELETE_YOUR_ACCOUNT_HERE_A; ?>
    </td>
</tr>

<tr>
<?php
// =========================
// DELETE STATUS CHECK
// =========================
$timestamp = $database->isDeleting($session->uid);

if ($timestamp) {
    echo "<td colspan=\"2\" class=\"count\">";
    echo "<a href=\"spieler.php?s=3&id=".$session->uid."&a=1&e=4\">";
    echo "<img class=\"del\" src=\"img/x.gif\" alt=\"Cancel process\" title=\"Cancel process\" />";
    echo "</a>";

    $time = $generator->getTimeFormat(($timestamp - time()));
    echo "The account will be deleted in <span id=\"timer".++$session->timer."\">".$time."</span> .</td>";
} else {
?>
    <th><?php echo TZ_DELETE_ACCOUNT; ?></th>
    <td class="del_selection">
        <label><input class="radio" type="radio" name="del" value="1" /> <?php echo YES; ?></label>
        <label><input class="radio" type="radio" name="del" value="0" checked /> <?php echo NO; ?></label>
    </td>
</tr>

<tr>
    <th><?php echo TZ_CONFIRM_WITH_PASSWORD; ?></th>
    <td><input class="text" type="password" name="del_pw" maxlength="30" /></td>
<?php } ?>
</tr>
</tbody>
</table>

<?php
if (!empty($deleteError = $form->getError("del"))) {
    echo "<span class=\"error\">".$deleteError."</span>";
}
?>

<p class="btn">
    <input type="image" value="" name="s1" id="btn_save" class="dynamic_img" src="img/x.gif" alt="<?php echo SAVE; ?>" />
</p>

</form>