<?php
#################################################################################
## -= TravianZ Alliance Link Forum (incremental refactor) =-                  ##
## - preserves logic                                                           ##
## - improves readability                                                      ##
## - sanitizes output                                                          ##
#################################################################################

// -------------------------------------------------
// SAFE ALLIANCE ID
// -------------------------------------------------

$aid = isset($aid) ? (int)$aid : (int)$session->alliance;

// -------------------------------------------------
// LOAD DATA
// -------------------------------------------------

$allianceinfo = $database->getAlliance($aid);

// -------------------------------------------------
// HEADER
// -------------------------------------------------

echo "<h1>" .
    htmlspecialchars($allianceinfo['tag'], ENT_QUOTES, 'UTF-8') .
    " - " .
    htmlspecialchars($allianceinfo['name'], ENT_QUOTES, 'UTF-8') .
    "</h1>";

include("alli_menu.tpl");
?>

<!-- LINK FORUM FORM -->
<form method="post" action="allianz.php">

<input type="hidden" name="a" value="5">
<input type="hidden" name="o" value="5">
<input type="hidden" name="s" value="5">

<table cellpadding="1" cellspacing="1">

<thead>
<tr>
    <th colspan="2"><?php echo TZ_LINK_TO_THE_FORUM; ?></th>
</tr>
</thead>

<tbody>

<tr>
    <th>URL</th>
    <td>
        <input
            class="link text"
            type="text"
            name="f_link"
            maxlength="200"
            value="<?php

                // -------------------------------------------------
                // preserve POST value OR fallback DB value
                // -------------------------------------------------
                echo isset($_POST['f_link'])
                    ? htmlspecialchars($_POST['f_link'], ENT_QUOTES, 'UTF-8')
                    : (
                        (string)$allianceinfo['forumlink'] !== "0"
                            ? htmlspecialchars($allianceinfo['forumlink'], ENT_QUOTES, 'UTF-8')
                            : ""
                    );

            ?>">
    </td>
</tr>

<tr>
    <td colspan="2" class="info">
        <?php echo TZ_IF_YOUR_ALLIANCE_WANTS_TO_USE_AN_E; ?>
    </td>
</tr>

</tbody>
</table>

<!-- SUBMIT -->
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

<!-- ERROR -->
<p class="error">
    <?php echo $form->getError("perm"); ?>
</p>