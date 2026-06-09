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

        echo "<div>";
        echo "<a href=\"spieler.php?s=3&e=3&id=".$uid."&a=".$session->checker."&type=".$type."\">";
        echo "<img class=\"del\" src=\"img/x.gif\" title=\"Remove sitters\" alt=\"Remove sitters\" />";
        echo "</a>";
        echo "<a href=\"spieler.php?uid=".$uid."\">".$uname."</a>";
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
    echo "<span class=\"none\">You have no sitters.</span>";
} else {
    foreach ($sitee as $sit) {
        echo "<div>";
        echo "<a href=\"spieler.php?s=3&e=2&id=".$sit['id']."&a=".$session->checker."\">";
        echo "<img class=\"del\" src=\"img/x.gif\" title=\"Remove sitters\" alt=\"Remove sitters\" />";
        echo "</a>";
        echo "<a href=\"spieler.php?uid=".$sit['id']."\">".$database->getUserField($sit['id'], "username", 0)."</a>";
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