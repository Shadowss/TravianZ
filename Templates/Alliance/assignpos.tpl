<?php
#################################################################################
## -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                              ##
## --------------------------------------------------------------------------- ##
## Project:     TravianZ (Refactor incremental)                                ##
## File:        assignpost.tpl                                                 ##
## Description: Assign alliance positions                                      ##
## Improvements:                                                               ##
##  - Safer output (XSS protection)                                            ##
##  - Cleaner structure                                                       ##
##  - Reduced inline logic clutter                                             ##
##  - Consistent casting                                                       ##
#################################################################################

// fallback alliance id
if (!isset($aid)) {
    $aid = $session->alliance;
}

// load alliance data
$allianceinfo = $database->getAlliance($aid);
$memberlist = $database->getAllMember($aid);

// safe header output
echo "<h1>" . htmlspecialchars($allianceinfo['tag'], ENT_QUOTES, 'UTF-8') .
     " - " .
     htmlspecialchars($allianceinfo['name'], ENT_QUOTES, 'UTF-8') .
     "</h1>";

// menu include
include("alli_menu.tpl");
?>

<form method="post" action="allianz.php">

<table cellpadding="1" cellspacing="1" id="position" class="small_option">

    <thead>
        <tr>
            <th colspan="2"><?php echo TZ_ASSIGN_TO_POSITION; ?></th>
        </tr>
    </thead>

    <tbody>

        <tr>
            <th colspan="2">
                Here you can grant the players from your alliance rights & positions.
            </th>
        </tr>

        <!-- MEMBER SELECT -->
        <tr>
            <th><?php echo NAME; ?></th>
            <td>
                <select name="a_user" class="name dropdown">
                    <?php
                    // list alliance members
                    if (!empty($memberlist)) {
                        foreach ($memberlist as $member) {
                            echo "<option value='" . (int)$member['id'] . "'>"
                                . htmlspecialchars($member['username'], ENT_QUOTES, 'UTF-8')
                                . "</option>";
                        }
                    }
                    ?>
                </select>
            </td>
        </tr>

    </tbody>
</table>

<!-- FORM ACTIONS -->
<p>
    <input type="hidden" name="o" value="1">
    <input type="hidden" name="s" value="5">

    <button type="submit" name="s1" id="btn_ok" class="trav_buttons">
        OK
    </button>
</p>

</form>