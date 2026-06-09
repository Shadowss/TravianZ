<?php
#################################################################################
## -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                              ##
## --------------------------------------------------------------------------- ##
## Project:     TravianZ (Refactor incremental)                                ##
## File:        changename.tpl                                                 ##
## Description: Alliance name/tag change                                      ##
## Improvements:                                                               ##
##  - Fixed HTML issues                                                       ##
##  - XSS protection                                                          ##
##  - Cleaner structure                                                       ##
##  - Removed duplicate attributes                                            ##
#################################################################################

// fallback alliance id
if (!isset($aid)) {
    $aid = $session->alliance;
}

// load alliance info
$allianceinfo = $database->getAlliance($aid);

// header
echo "<h1>" . htmlspecialchars($allianceinfo['tag'], ENT_QUOTES, 'UTF-8') .
     " - " .
     htmlspecialchars($allianceinfo['name'], ENT_QUOTES, 'UTF-8') .
     "</h1>";

// menu
include("alli_menu.tpl");
?>

<form method="post" action="allianz.php">

<input type="hidden" name="a" value="100">
<input type="hidden" name="o" value="100">
<input type="hidden" name="s" value="5">

<table cellpadding="1" cellspacing="1" id="name" class="small_option">

<thead>
<tr>
    <th colspan="2"><?php echo TZ_CHANGE_NAME; ?></th>
</tr>
</thead>

<tbody>

<!-- TAG -->
<tr>
    <th><?php echo TAG; ?></th>
    <td>
        <input class="tag text"
               name="ally1"
               value="<?php echo htmlspecialchars($allianceinfo['tag'], ENT_QUOTES, 'UTF-8'); ?>"
               maxlength="15">

        <span class="error2">
            <?php echo $form->getError("ally1"); ?>
        </span>
    </td>
</tr>

<!-- NAME -->
<tr>
    <th><?php echo NAME; ?></th>
    <td>
        <input class="name text"
               name="ally2"
               value="<?php echo htmlspecialchars($allianceinfo['name'], ENT_QUOTES, 'UTF-8'); ?>"
               maxlength="50">

        <span class="error2">
            <?php echo $form->getError("ally2"); ?>
        </span>
    </td>
</tr>

</tbody>
</table>

<!-- SUBMIT -->
<p>
    <button type="submit" name="s1" id="btn_ok" class="trav_buttons">
        <?php echo TZ_OK_2; ?>
    </button>
</p>

</form>

<!-- PERMISSION ERROR -->
<p class="error">
    <?php echo $form->getError("perm"); ?>
</p>