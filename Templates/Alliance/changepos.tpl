<?php
#################################################################################
## -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                              ##
## --------------------------------------------------------------------------- ##
## Project:     TravianZ (Refactor incremental)                                ##
## File:        changepos.tpl                                                  ##
## Description: Alliance member permissions                                   ##
## Improvements:                                                               ##
##  - Fixed PHP 5.3 compatibility (no [] arrays)                               ##
##  - Removed invalid array syntax                                              ##
##  - Input validation & casting                                               ##
##  - XSS protection                                                           ##
##  - Cleaner checkbox rendering                                               ##
#################################################################################

// secure input
$aUser = isset($_POST['a_user']) ? (int)$_POST['a_user'] : 0;

// validation checks
if ($database->getUserField($aUser, "alliance", 0) != $session->alliance) {
    $form->addError("perm", USER_NOT_IN_YOUR_ALLY);

} elseif ($aUser == $session->uid) {
    $form->addError("perm", CANT_EDIT_YOUR_PERMISSIONS);

} elseif ($database->isAllianceOwner($aUser)) {
    $form->addError("perm", CANT_EDIT_LEADER_PERMISSIONS);
}

// error handling redirect
if ($form->returnErrors() > 0) {
    $_SESSION['errorarray'] = $form->getErrors();
    $_SESSION['valuearray'] = $_POST;

    header("Location: allianz.php?s=5");
    exit;
}

// fallback alliance id
if (!isset($aid)) {
    $aid = $session->alliance;
}

// load data
$playerData = $database->getAlliPermissions($aUser, $aid);
$playername = $database->getUserField($aUser, 'username', 0);
$allianceinfo = $database->getAlliance($aid);

// header
echo "<h1>" . htmlspecialchars($allianceinfo['tag'], ENT_QUOTES, 'UTF-8') .
     " - " .
     htmlspecialchars($allianceinfo['name'], ENT_QUOTES, 'UTF-8') .
     "</h1>";

include("alli_menu.tpl");
?>

<form method="post" action="allianz.php">

<table cellpadding="1" cellspacing="1" id="position" class="small_option">

<thead>
<tr>
    <th colspan="2">Assign to position</th>
</tr>
</thead>

<tbody>

<tr>
    <th>Name:</th>
    <td><?php echo htmlspecialchars($playername, ENT_QUOTES, 'UTF-8'); ?></td>
</tr>

<tr>
    <th>Position:</th>
    <td>
        <input class="name text"
               type="text"
               name="a_titel"
               value="<?php echo htmlspecialchars($playerData['rank'], ENT_QUOTES, 'UTF-8'); ?>"
               maxlength="50" />
    </td>
</tr>

</tbody>
</table>

<!-- RIGHTS TABLE -->
<table cellpadding="1" cellspacing="1" id="rights" class="small_option">

<thead>
<tr>
    <th colspan="2">Assign rights</th>
</tr>
</thead>

<tbody>

<?php
/*
|--------------------------------------------------------------------------
| Permission map
| IMPORTANT:
| - folosim array() pentru compatibilitate PHP 5.3
|--------------------------------------------------------------------------
*/
$map = array(
    array('e1','opt1','Assign to position'),
    array('e2','opt2','Kick player'),
    array('e3','opt3','Change alliance description'),
    array('e6','opt6','Alliance diplomacy'),
    array('e7','opt7','IGMs to every alliance member'),
    array('e4','opt4','Invite a player into the alliance'),
    array('e5','opt5','Manage forums')
);

/*
|--------------------------------------------------------------------------
| Render checkbox rights
|--------------------------------------------------------------------------
*/
foreach ($map as $r) {

    $field = $r[0];
    $opt   = $r[1];
    $label = $r[2];

    $checked = !empty($playerData[$opt]) ? 'checked="checked"' : '';

    echo "<tr>
            <td class=\"sel\">
                <input class=\"check\" type=\"checkbox\" name=\"$field\" value=\"1\" $checked>
            </td>
            <td>$label</td>
          </tr>";
}
?>

</tbody>
</table>

<!-- SUBMIT -->
<p>
    <input type="hidden" name="a" value="1">
    <input type="hidden" name="o" value="1">
    <input type="hidden" name="s" value="5">
    <input type="hidden" name="a_user" value="<?php echo $aUser; ?>">

    <input type="image" value="ok" name="s1" id="btn_ok"
           class="dynamic_img" src="img/x.gif" alt="OK" />
</p>

</form>