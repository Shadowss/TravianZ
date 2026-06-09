<?php
#################################################################################
## -= TravianZ Alliance Kick (incremental refactor) =-                        ##
## - preserves logic                                                           ##
## - improves structure                                                        ##
## - reduces duplication                                                       ##
## - adds safety + comments                                                    ##
#################################################################################

// -------------------------------------------------
// SAFE ALLIANCE ID
// -------------------------------------------------

$aid = isset($aid) ? (int)$aid : (int)$session->alliance;

// -------------------------------------------------
// DATA LOAD (kept original logic)
// -------------------------------------------------

$memberlist = $database->getAllMember($aid);
$allianceinfo = $database->getAlliance($aid);

// -------------------------------------------------
// HEADER OUTPUT
// -------------------------------------------------

echo "<h1>" .
    htmlspecialchars($allianceinfo['tag'], ENT_QUOTES, 'UTF-8') .
    " - " .
    htmlspecialchars($allianceinfo['name'], ENT_QUOTES, 'UTF-8') .
    "</h1>";

include("alli_menu.tpl");
?>

<!-- KICK FORM -->
<form method="post" action="allianz.php">

<table cellpadding="1" cellspacing="1" id="position" class="small_option">

<thead>
<tr>
    <th colspan="2"><?php echo TZ_KICK_PLAYER; ?></th>
</tr>
</thead>

<tbody>

<tr>
    <th colspan="2">
        <?php echo TZ_HERE_YOU_CAN_KICK_THE_PLAYERS_FROM; ?>
    </th>
</tr>

<tr>
    <th><?php echo NAME; ?></th>
    <td>

        <select name="a_user" class="name dropdown">

        <?php
        // -------------------------------------------------
        // MEMBER LIST (exclude current user)
        // -------------------------------------------------
        foreach ($memberlist as $member) {

            // prevent self-kick
            if ((int)$member['id'] == $session->uid) {
                continue;
            }

            echo "<option value=\"" . (int)$member['id'] . "\">" .
                htmlspecialchars($member['username'], ENT_QUOTES, 'UTF-8') .
            "</option>";
        }
        ?>

        </select>

    </td>
</tr>

</tbody>
</table>

<!-- ACTION BUTTONS -->
<p>
    <input type="hidden" name="o" value="2">
    <input type="hidden" name="s" value="5">
    <input type="hidden" name="a" value="2">

    <button
        type="submit"
        name="s1"
        id="btn_ok"
        class="trav_buttons"
        onclick="this.disabled=true;this.form.submit();">
        <?php echo TZ_OK_2; ?>
    </button>
</p>

</form>

<!-- ERROR OUTPUT -->
<p class="error">
    <?php echo $form->getError("perm"); ?>
</p>