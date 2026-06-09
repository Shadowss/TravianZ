<?php
#################################################################################
## -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                              ##
## --------------------------------------------------------------------------- ##
## Project:     TravianZ (Refactor incremental)                                ##
## File:        chgdiplo.tpl                                                   ##
## Description: Alliance diplomacy system                                      ##
## Improvements:                                                               ##
##  - Cleaner structure                                                       ##
##  - Reduced duplication                                                     ##
##  - Fixed HTML form nesting issues                                          ##
##  - Safer output (XSS protection)                                            ##
##  - More stable loops                                                       ##
#################################################################################

// fallback alliance id
if (!isset($aid)) {
    $aid = $session->alliance;
}

// alliance info
$allianceinfo = $database->getAlliance($aid);

// header
echo "<h1>" . htmlspecialchars($allianceinfo['tag'], ENT_QUOTES, 'UTF-8') .
     " - " .
     htmlspecialchars($allianceinfo['name'], ENT_QUOTES, 'UTF-8') .
     "</h1>";

include("alli_menu.tpl");

// diplomacy labels
$diplLabels = [
    1 => "Conf",
    2 => "Nap",
    3 => "War"
];

$allyId = (int)$session->alliance;
?>

<!-- DIPLOMACY FORM -->
<form method="post" action="allianz.php">

<input type="hidden" name="a" value="6">
<input type="hidden" name="o" value="6">
<input type="hidden" name="s" value="5">

<table cellpadding="1" cellspacing="1" id="diplomacy" class="dipl">

<thead>
<tr>
    <th colspan="2"><?php echo TZ_ALLIANCE_DIPLOMACY; ?></th>
</tr>
</thead>

<tbody>

<tr>
    <th><?php echo ALLIANCE; ?></th>
    <td>
        <input class="ally text" type="text" name="a_name" maxlength="15">
    </td>
</tr>

<tr><td colspan="2" class="empty"></td></tr>

<tr>
    <td colspan="2"><label><input class="radio" type="radio" name="dipl" value="1"> <?php echo TZ_OFFER_A_CONFEDERATION; ?></label></td>
</tr>

<tr>
    <td colspan="2"><label><input class="radio" type="radio" name="dipl" value="2"> <?php echo TZ_OFFER_NON_AGGRESSION_PACT; ?></label></td>
</tr>

<tr>
    <td colspan="2"><label><input class="radio" type="radio" name="dipl" value="3"> <?php echo TZ_DECLARE_WAR; ?></label></td>
</tr>

</tbody>
</table>

<!-- HINT -->
<table cellpadding="1" cellspacing="1" id="hint" class="infos">
<thead>
<tr>
    <th colspan="2"><?php echo TZ_HINT; ?></th>
</tr>
</thead>

<tbody>
<tr>
    <td colspan="2">
        <?php echo TZ_IT_S_PART_OF_DIPLOMATIC_ETIQUETTE; ?>
    </td>
</tr>
</tbody>
</table>

<!-- SUBMIT -->
<div id="box">
    <p>
        <input type="image" name="s1" id="btn_ok"
               class="dynamic_img" src="img/x.gif" alt="OK">
    </p>

    <p class="error"><?php echo $form->getError("name"); ?></p>
</div>

</form>

<div class="clear"></div>

<!-- OWN OFFERS -->
<table cellpadding="1" cellspacing="1" id="own" class="dipl">

<thead>
<tr>
    <th colspan="3"><?php echo OWN_OFFERS; ?></th>
</tr>
</thead>

<tbody>

<?php
$offers = $database->diplomacyOwnOffers($allyId);

if (!empty($offers)) {

    foreach ($offers as $row) {

        $typeLabel = $diplLabels[$row['type']] ?? "-";

        echo "<tr>

        <td width=\"18\">
            <form method=\"post\" action=\"allianz.php\">
                <input type=\"hidden\" name=\"o\" value=\"101\">
                <input type=\"hidden\" name=\"id\" value=\"" . (int)$row['id'] . "\">
                <input type=\"image\" class=\"cancel\" src=\"img/x.gif\" title=\"Cancel\">
            </form>
        </td>

        <td>
            <a href=\"allianz.php?aid=" . (int)$row['alli2'] . "\">
                <center>" . htmlspecialchars($database->getAllianceName($row['alli2']), ENT_QUOTES, 'UTF-8') . "</center>
            </a>
        </td>

        <td width=\"80\">
            <center>$typeLabel</center>
        </td>

        </tr>";
    }

} else {
    echo "<tr><td colspan=\"3\" class=\"none\">none</td></tr>";
}
?>

</tbody>
</table>

<!-- TIP -->
<table cellpadding="1" cellspacing="1" id="tip" class="infos">
<thead>
<tr>
    <th colspan="2"><?php echo TZ_TIP; ?></th>
</tr>
</thead>

<tbody>
<tr>
    <td colspan="2">
        <?php echo TZ_USE; ?> <span class="e">[diplomatie]</span>, <span class="e">[ally]</span>,
        <span class="e">[nap]</span>, <span class="e">[war]</span> <?php echo TZ_IN_DESCRIPTION; ?>
    </td>
</tr>
</tbody>
</table>

<!-- FOREIGN OFFERS -->
<table cellpadding="1" cellspacing="1" id="foreign" class="dipl">

<thead>
<tr>
    <th colspan="4"><?php echo TZ_FOREIGN_OFFERS; ?></th>
</tr>
</thead>

<tbody>

<?php
$invites = $database->diplomacyInviteCheck($allyId);

if (!empty($invites)) {

    foreach ($invites as $row) {

        $typeLabel = $diplLabels[$row['type']] ?? "-";

        echo "<tr>

        <td width=\"18\">
            <form method=\"post\" action=\"allianz.php\">
                <input type=\"hidden\" name=\"o\" value=\"102\">
                <input type=\"hidden\" name=\"id\" value=\"" . (int)$row['id'] . "\">
                <input type=\"image\" class=\"cancel\" src=\"img/x.gif\" title=\"Cancel\">
            </form>
        </td>

        <td width=\"18\">
            <form method=\"post\" action=\"allianz.php\">
                <input type=\"hidden\" name=\"o\" value=\"103\">
                <input type=\"hidden\" name=\"id\" value=\"" . (int)$row['id'] . "\">
                <input type=\"image\" class=\"accept\" src=\"img/x.gif\" title=\"Accept\">
            </form>
        </td>

        <td>
            <a href=\"allianz.php?aid=" . (int)$row['alli1'] . "\">
                <center>" . htmlspecialchars($database->getAllianceName($row['alli1']), ENT_QUOTES, 'UTF-8') . "</center>
            </a>
        </td>

        <td width=\"80\">
            <center>$typeLabel</center>
        </td>

        </tr>";
    }

} else {
    echo "<tr><td colspan=\"4\" class=\"none\">none</td></tr>";
}
?>

</tbody>
</table>

<!-- EXISTING RELATIONSHIPS -->
<table cellpadding="1" cellspacing="1" id="existing" class="dipl">

<thead>
<tr>
    <th colspan="3"><?php echo TZ_EXISTING_RELATIONSHIPS; ?></th>
</tr>
</thead>

<tbody>

<?php
$rels = $database->diplomacyExistingRelationships($allyId);

if (!empty($rels)) {

    foreach ($rels as $row) {

        $otherAlliance = ($row['alli1'] == $allyId) ? $row['alli2'] : $row['alli1'];

        $typeLabel = $diplLabels[$row['type']] ?? "-";

        echo "<tr>

        <td width=\"18\">
            <form method=\"post\" action=\"allianz.php\">
                <input type=\"hidden\" name=\"o\" value=\"104\">
                <input type=\"hidden\" name=\"id\" value=\"" . (int)$row['id'] . "\">
                <input type=\"image\" class=\"cancel\" src=\"img/x.gif\" title=\"Cancel\">
            </form>
        </td>

        <td>
            <a href=\"allianz.php?aid=" . (int)$otherAlliance . "\">
                <center>" . htmlspecialchars($database->getAllianceName($otherAlliance), ENT_QUOTES, 'UTF-8') . "</center>
            </a>
        </td>

        <td width=\"80\">
            <center>$typeLabel</center>
        </td>

        </tr>";
    }

} else {
    echo "<tr><td colspan=\"3\" class=\"none\">none</td></tr>";
}
?>

</tbody>
</table>