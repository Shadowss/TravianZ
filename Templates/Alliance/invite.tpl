<?php
#################################################################################
## -= TravianZ Alliance Invite (refactor incremental safe) =-                 ##
## - cleanup + security + structure improvements                               ##
#################################################################################

// fallback alliance
$aid = isset($aid) ? (int)$aid : (int)$session->alliance;

// alliance data
$allianceinfo = $database->getAlliance($aid);

// invitations list
$allianceInvitations = $database->getAliInvitations($aid);

// header
echo "<h1>" .
    htmlspecialchars($allianceinfo['tag'], ENT_QUOTES, 'UTF-8') .
    " - " .
    htmlspecialchars($allianceinfo['name'], ENT_QUOTES, 'UTF-8') .
    "</h1>";

include("alli_menu.tpl");
?>

<!-- INVITE FORM -->
<form method="post" action="allianz.php">

<input type="hidden" name="s" value="5">
<input type="hidden" name="o" value="4">
<input type="hidden" name="a" value="4">

<table cellpadding="1" cellspacing="1" id="invite" class="small_option">

<thead>
<tr>
    <th colspan="2"><?php echo TZ_INVITE_A_PLAYER_INTO_THE_ALLIANCE; ?></th>
</tr>
</thead>

<tbody>

<tr>
    <th><?php echo NAME; ?></th>
    <td>
        <input class="name text" type="text" name="a_name" maxlength="30">
        <span class="error"></span>
    </td>
</tr>

</tbody>
</table>

<p>
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

<p class="error"><?php echo $form->getError("name"); ?></p>

<br />

<!-- INVITATIONS LIST -->
<table cellpadding="1" cellspacing="1" id="invitations" class="small_option">

<thead>
<tr>
    <th colspan="2"><?php echo TZ_INVITATIONS; ?></th>
</tr>
</thead>

<tbody>

<?php
if (empty($allianceInvitations)) {

    echo "<tr><td class=\"none\" colspan=\"2\">none</td></tr>";

} else {

    foreach ($allianceInvitations as $invit) {

        $uid = (int)$invit['uid'];
        $id = (int)$invit['id'];

        $username = $database->getUserField($uid, 'username', 0);

        echo "<tr>

            <td class=\"abo\">
                <a href=\"?o=4&s=5&d=$id\">
                    <img src=\"gpack/travian_default/img/a/del.gif\" width=\"12\" height=\"12\" alt=\"Del\">
                </a>
            </td>

            <td>
                <a href=\"spieler.php?uid=$uid\">
                    " . htmlspecialchars($username, ENT_QUOTES, 'UTF-8') . "
                </a>
            </td>

        </tr>";
    }
}
?>

</tbody>
</table>