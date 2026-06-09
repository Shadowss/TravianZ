<?php
#################################################################################
## -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                              ##
## --------------------------------------------------------------------------- ##
## Project:     TravianZ (Refactor incremental)                                ##
## File:        allidesc.tpl                                                   ##
## Description: Alliance description + medals + edit form                      ##
## Improvements:                                                               ##
##  - Reduced unnecessary loops                                               ##
##  - Safer output (XSS protection)                                            ##
##  - Cleaner structure                                                       ##
##  - Medals switch simplified                                                ##
#################################################################################

// fallback alliance id
if (!isset($aid)) {
    $aid = $session->alliance;
}

// load alliance data
$varmedal = $database->getProfileMedalAlly($aid);
$allianceinfo = $database->getAlliance($aid);
$memberlist = $database->getAllMember($aid);

// build member id list (for population query)
$memberIDs = [];

if (!empty($memberlist)) {
    foreach ($memberlist as $member) {
        $memberIDs[] = (int)$member['id'];
    }
}

// total population calculation (safe fallback)
$totalpop = 0;
$data = [];

if (!empty($memberIDs)) {
    $data = $database->getVSumField($memberIDs, "pop");
}

if (!empty($data)) {
    foreach ($data as $row) {
        $totalpop += (int)$row['Total'];
    }
}

// alliance title output (escaped)
echo "<h1>" . htmlspecialchars($allianceinfo['tag'], ENT_QUOTES, 'UTF-8') . " - " .
     htmlspecialchars($allianceinfo['name'], ENT_QUOTES, 'UTF-8') . "</h1>";

// menu include
include("alli_menu.tpl");
?>

<form method="post" action="allianz.php">
<input type="hidden" name="a" value="3">
<input type="hidden" name="o" value="3">
<input type="hidden" name="s" value="5">

<table cellpadding="1" cellspacing="1" id="edit">

<thead>
<tr>
    <th colspan="3"><?php echo ALLIANCE; ?></th>
</tr>
<tr>
    <td colspan="2"><?php echo DETAIL; ?></td>
    <td><?php echo DESCRIPTION; ?></td>
</tr>
</thead>

<tbody>

<tr>
    <td colspan="2"></td>
    <td class="empty"></td>
</tr>

<!-- TAG + DESCRIPTION -->
<tr>
    <th><?php echo TAG; ?></th>
    <td class="s7">
        <?php echo htmlspecialchars($allianceinfo['tag'], ENT_QUOTES, 'UTF-8'); ?>
    </td>

    <td rowspan="8" class="desc1">
        <textarea tabindex="1" name="be1"><?php
            echo isset($_POST['be1'])
                ? htmlspecialchars($_POST['be1'], ENT_QUOTES, 'UTF-8')
                : htmlspecialchars(stripslashes($allianceinfo['desc']), ENT_QUOTES, 'UTF-8');
        ?></textarea>
    </td>
</tr>

<tr>
    <th><?php echo NAME; ?></th>
    <td><?php echo htmlspecialchars($allianceinfo['name'], ENT_QUOTES, 'UTF-8'); ?></td>
</tr>

<tr><td colspan="2" class="empty"></td></tr>

<!-- RANK -->
<tr>
    <th><?php echo RANK; ?></th>
    <td><?php echo (int)$ranking->getAllianceRank($aid); ?>.</td>
</tr>

<tr>
    <th><?php echo POINTS; ?></th>
    <td><?php echo (int)$totalpop; ?></td>
</tr>

<tr>
    <th><?php echo TZ_MEMBERS; ?></th>
    <td><?php echo count($memberlist); ?></td>
</tr>

<tr><td colspan="2" class="empty"></td></tr>

<!-- NOTICE -->
<tr>
    <td colspan="2" class="desc2">
        <textarea tabindex="2" name="be2"><?php
            echo isset($_POST['be2'])
                ? htmlspecialchars($_POST['be2'], ENT_QUOTES, 'UTF-8')
                : htmlspecialchars(stripslashes($allianceinfo['notice']), ENT_QUOTES, 'UTF-8');
        ?></textarea>
    </td>
</tr>

</tbody>
</table>

<!-- MEDALS -->
<p>
<table cellspacing="1" cellpadding="2" class="tbg">
<tr><td class="rbg" colspan="4"><?php echo MEDALS; ?></td></tr>

<tr>
    <td><?php echo CATEGORY; ?></td>
    <td><?php echo RANK; ?></td>
    <td><?php echo WEEK; ?></td>
    <td><?php echo BB_CODE; ?></td>
</tr>

<?php
/******************************
Medal categories mapping
******************************/

if (!empty($varmedal)) {

    foreach ($varmedal as $medal) {

        // default title
        $titel = "Bonus";

        switch ((string)$medal['categorie']) {

            case "1":  $titel = "Attacker of the Week"; break;
            case "2":  $titel = "Defender of the Week"; break;
            case "3":  $titel = "Climber of the week"; break;
            case "4":  $titel = "Robber of the week"; break;
            case "5":  $titel = "Top 10 of both attackers and defenders"; break;
            case "6":
                $titel = "Top 3 of Attackers of week " . (int)$medal['points'] . " in a row";
                break;
            case "7":
                $titel = "Top 3 of Defenders of week " . (int)$medal['points'] . " in a row";
                break;
            case "8":
                $titel = "Top 3 of Pop climbers of week " . (int)$medal['points'] . " in a row";
                break;
            case "9":
                $titel = "Top 3 of Robbers of week " . (int)$medal['points'] . " in a row";
                break;
            case "10": $titel = "Rank Climber of the week"; break;
            case "11":
                $titel = "Top 3 of Rank climbers of week " . (int)$medal['points'] . " in a row";
                break;
            case "12":
                $titel = "Top 10 of Rank Attackers of week " . (int)$medal['points'] . " in a row";
                break;
        }
        echo "<tr>
                <td>" . htmlspecialchars($titel, ENT_QUOTES, 'UTF-8') . "</td>
                <td>" . (int)$medal['plaats'] . "</td>
                <td>" . (int)$medal['week'] . "</td>
                <td>[#" . (int)$medal['id'] . "]</td>
              </tr>";
    }
}
?>

</table>
</p>

<!-- SAVE BUTTON -->
<p class="btn">
    <input tabindex="3" type="image" name="s1" id="btn_save"
           class="dynamic_img" src="img/x.gif" alt="<?php echo SAVE; ?>">
</p>

</form>