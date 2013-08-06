<h1>Player profile</h1>

<?php include("menu.tpl"); ?>
<form action="spieler.php" method="POST">
<input type="hidden" name="ft" value="p3">
<input type="hidden" name="uid" value="<?php echo $session->uid; ?>" />
<table cellpadding="1" cellspacing="1" id="change_pass" class="account">
<thead><tr>
    <th colspan="2">Change password</th>
</tr></thead><tbody>
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
</tr></tbody></table>
<?php
if($form->getError("pw") != "") {
echo "<span class=\"error\">".$form->getError('pw')."</span>";
}
?>
<table cellpadding="1" cellspacing="1" id="change_mail" class="account"><thead><tr>
        <th colspan="2">Change email</th>

    </tr></thead>
    <tbody><tr>
        <td class="note" colspan="2">Please enter your old and your new e-mail addresses. You will then receive a code snippet at both e-mail addresses which you have to enter here.</td></tr>
    <tr>
        <th>Old email</th>
        <td><input class="text" type="text" name="email_alt" /></td>
    </tr>
    <tr>

        <th>New email</th>
        <td><input class="text" type="text" name="email_neu" /></td>
    </tr></tbody></table>
<?php
if($form->getError("email") != "") {
echo "<span class=\"error\">".$form->getError('email')."</span>";
}
?>
    <table cellpadding="1" cellspacing="1" id="sitter" class="account"><thead>
<tr>
    <th colspan="2">Account sitters</th>
</tr></thead>
<tbody><tr>
    <td class="note" colspan="2">A sitter can log into your account by using your name and his/her password. You can have up to two sitters.</td>
</tr>
    <?php
    $count = 0;
    if($session->userinfo['sit1'] != 0) $count +=1; if($session->userinfo['sit2'] !=0) $count += 1;
    if($count < 2) {
    ?>
<tr>
    <th>Name of the sitter</th>
    <td><input class="text" type="text" name="v1" maxlength="15"><span class="count">(<?php echo $count; ?>/2)</span></td>
</tr>
<?php 
}
?><tr><td colspan="2" class="sitter">
<?php if($count == 0) { echo "<span class=\"none\">You have no sitters.</span></td>"; }
if($session->userinfo['sit1'] != 0) {
	echo "<div>";
    echo "<a href=\"spieler.php?s=3&e=3&id=".$session->userinfo['sit1']."&a=".$session->checker."&type=1\"><img class=\"del\" src=\"img/x.gif\" title=\"Remove sitters\" alt=\"Remove sitters\" /></a>";
    echo "<a href=\"spieler.php?uid=".$session->userinfo['sit1']."\">".$database->getUserField($session->userinfo['sit1'],"username",0)."</a>";
    echo "</div>";
}
if($session->userinfo['sit2'] != 0) {
echo "<div>";
echo "<a href=\"spieler.php?s=3&e=3&id=".$session->userinfo['sit2']."&a=".$session->checker."&type=2\"><img class=\"del\" src=\"img/x.gif\" title=\"Remove sitters\" alt=\"Remove sitters\" /></a>";
echo "<a href=\"spieler.php?uid=".$session->userinfo['sit2']."\">".$database->getUserField($session->userinfo['sit2'],"username",0)."</a>";
    echo "</div>";
}
?></tr>
<tr><td class="note" colspan="2">You have been entered as sitter on the following accounts. You can cancel this by clicking the red X.</td></tr><tr><td colspan="2" class="sitter">
<?php 
$sitee = $database->getSitee($session->uid);
if(count($sitee) == 0) {
echo "<span class=\"none\">You have no sitters.</span>";
}
else {
foreach($sitee as $sit) {
echo "<div>";
echo "<a href=\"spieler.php?s=3&e=2&id=".$sit['id']."&a=".$session->checker."\"><img class=\"del\" src=\"img/x.gif\" title=\"Remove sitters\" alt=\"Remove sitters\" /></a>";
echo "<a href=\"spieler.php?uid=".$sit['id']."\">".$database->getUserField($sit['id'],"username",0)."</a>";
    echo "</div>";
}
}
?>
</td></tr></table>
<?php
if($form->getError("email") != "") {
echo "<span class=\"error\">".$form->getError('email')."</span>";
}
?>
    <table cellpadding="1" cellspacing="1" id="del_acc" class="account"><thead>
<tr>
    <th colspan="2">Delete account</th>
</tr>
</thead><tbody>
<tr>
	<td class="note" colspan="2">You can delete your account here. After starting the cancellation it will take three days to complete the cancellation of your account. You can cancel this process within the first 24 hours.</td>
</tr><tr>
<?php
$timestamp = $database->isDeleting($session->uid);
if($timestamp) {
echo "<td colspan=\"2\" class=\"count\">";
echo "<a href=\"spieler.php?s=3&id=".$session->uid."&a=1&e=4\"><img
		class=\"del\" src=\"img/x.gif\" alt=\"Cancel process\"
		title=\"Cancel process\" /> </a>";
		$time=$generator->getTimeFormat(($timestamp-time()));
        echo "The account will be deleted in <span
		id=\"timer1\">".$time."</span> .</td>";
}
else {
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
        <?php 
        }
        ?>
    </tr></tbody></table>
    <?php
if($form->getError("del") != "") {
echo "<span class=\"error\">".$form->getError("del")."</span>";
}
?>
    <p class="btn"><input type="image" value="" name="s1" id="btn_save" class="dynamic_img" src="img/x.gif" alt="save" /></p>
</form>
