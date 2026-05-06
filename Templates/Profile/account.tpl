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
##  URLs:          http://travian.shadowss.ro 				       	 		   ##
##  Source code:   http://github.com/Shadowss/TravianZ/         	       	   ##
##                                                                             ##
#################################################################################

?>

<h1>Player profile</h1>

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
    <th colspan="2">Change password</th>
</tr>
</thead>
<tbody>
<tr>
    <th>Old password</th>
    <td><input class="text" type="password" name="pw1" maxlength="30" /></td>
</tr>

<tr>
    <th>New password</th>
    <td><input class="text" type="password" name="pw2" maxlength="30" /></td>
</tr>

<tr>
    <th>New password</th>
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
    <th colspan="2">Change email</th>
</tr>
</thead>
<tbody>
<tr>
    <td class="note" colspan="2">
        Please enter your old and your new e-mail addresses. You will then receive a code snippet at both e-mail addresses which you have to enter here.
    </td>
</tr>

<tr>
    <th>Old email</th>
    <td><input class="text" type="text" name="email_alt" /></td>
</tr>

<tr>
    <th>New email</th>
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
    <th colspan="2">Account sitters</th>
</tr>
</thead>

<tbody>
<tr>
    <td class="note" colspan="2">
        A sitter can log into your account by using your name and his/her password. You can have up to two sitters.
    </td>
</tr>

<?php if ($count < 2) { ?>
<tr>
    <th>Name of the sitter</th>
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
    You have been entered as sitter on the following accounts. You can cancel this by clicking the red X.
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
    <th colspan="2">Delete account</th>
</tr>
</thead>

<tbody>
<tr>
    <td class="note" colspan="2">
        You can delete your account here. After starting the cancellation it will take three days to complete the cancellation of your account. You can cancel this process within the first 24 hours.
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
    <th>Delete account?</th>
    <td class="del_selection">
        <label><input class="radio" type="radio" name="del" value="1" /> Yes</label>
        <label><input class="radio" type="radio" name="del" value="0" checked /> No</label>
    </td>
</tr>

<tr>
    <th>Confirm with password:</th>
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
    <input type="image" value="" name="s1" id="btn_save" class="dynamic_img" src="img/x.gif" alt="save" />
</p>

</form>