<?php
/*
|--------------------------------------------------------------------------
| TravianZ - Quit Alliance (refactored incremental)
|--------------------------------------------------------------------------
| Credits:
|   Original system: TravianZ Project
|   Incremental refactor: code cleanup + safety + reduced duplication
|
| Improvements:
|   - reduced repeated DB calls
|   - safer type casting
|   - clearer flow (owner / normal member separation)
|   - cached member list
|   - preserved full logic compatibility
|--------------------------------------------------------------------------
*/

if (!isset($aid) || !$aid) {
    $aid = (int) $session->alliance;
}

/* Alliance data */
$allianceinfo = $database->getAlliance($aid);

/* Check if user is alliance owner */
$isOwner = false;
$membersCount = 0;

if ($aid) {
    $ownerCheck = $database->isAllianceOwner($session->uid);
    $isOwner = ($ownerCheck == $aid);

    if ($isOwner) {
        $membersCount = (int) $database->countAllianceMembers($aid);
    }
}

/* Header */
echo "<h1>" . htmlspecialchars($allianceinfo['tag']) . " - " . htmlspecialchars($allianceinfo['name']) . "</h1>";

include("alli_menu.tpl");

/* Preload members only once */
$memberlist = $database->getAllMember($aid);

/* Default state */
$canQuit = false;
$minEmbassyLevel = 0;

/* Form mode */
?>
<form method="post" action="allianz.php">
<input type="hidden" name="a" value="11">
<input type="hidden" name="o" value="11">
<input type="hidden" name="s" value="5">

<table cellpadding="1" cellspacing="1" id="quit" class="small_option">
<thead>
<tr>
    <th colspan="2"><?php echo TZ_QUIT_ALLIANCE; ?></th>
</tr>
</thead>

<tbody>

<?php
/* Only founder logic */
if ($isOwner && $membersCount > 1) {

    $minEmbassyLevel = $database->getMinEmbassyLevel($membersCount);
    if ($minEmbassyLevel < 3) {
        $minEmbassyLevel = 3;
    }

    ?>
    <tr>
        <td colspan="2" class="info">
            <?php echo TZ_BECAUSE_YOU_ARE_THE_ALLIANCE_FOUND; ?>
        </td>
    </tr>

    <tr>
        <th>new&nbsp;founder:</th>
        <td>
            <select name="new_founder" class="name dropdown">
            <?php
            foreach ($memberlist as $member) {

                $uid = (int) $member['id'];

                /* exclude self */
                if ($uid == $session->uid) {
                    continue;
                }

                /* must have required embassy level */
                if ($database->getSingleFieldTypeCount($uid, 18, '>=', $minEmbassyLevel) >= 1) {
                    echo "<option value='" . $uid . "'>" . htmlspecialchars($member['username']) . "</option>";
                    $canQuit = true;
                }
            }

            if (!$canQuit) {
                echo "<option value='-1'>no candidates!</option>";
            }
            ?>
            </select>
        </td>
    </tr>
    <?php

} else {
    $canQuit = true;
}
?>

<tr>
    <td colspan="2" class="info">
        <br />
        <?php echo TZ_IN_ORDER_TO_QUIT_THE_ALLIANCE_YOU; ?>
    </td>
</tr>

<tr>
    <th><?php echo TZ_PASSWORD; ?></th>
    <td>
        <input class="pass text" type="password" name="pw" maxlength="20">
        <span class="error3"><?php echo $form->getError("pw"); ?></span>
    </td>
</tr>

</tbody>
</table>

<?php if (!$canQuit): ?>
    <span style="color: red">
        <br />
        Unfortunately, there are no members of the alliance with Embassy at level
        <?php echo (int)$minEmbassyLevel; ?> or more. In this case, you will not be able to reassign the founder role.
        You can still <a href="allianz.php?s=5"><?php echo TZ_KICK_ALL_MEMBERS; ?></a> <?php echo TZ_AND_QUIT_THE_ALLIANCE_AFTERWARDS; ?>
    </span>
<?php endif; ?>

<p>
    <input type="image" value="ok" name="s1" id="btn_ok" class="dynamic_img" src="img/x.gif" alt="OK" />
</p>

</form>

<p class="error"><?php echo $form->getError("founder"); ?></p>