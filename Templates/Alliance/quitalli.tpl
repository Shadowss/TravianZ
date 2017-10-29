<?php
if(isset($aid)) {
$aid = $aid;
}
else {
$aid = $session->alliance;
}
$allianceinfo = $database->getAlliance($aid);
$isOwner      = ($aid && $database->isAllianceOwner($session->uid) == $aid);

if ($isOwner) {
	$membersCount = $database->countAllianceMembers($aid);
}

echo "<h1>".$allianceinfo['tag']." - ".$allianceinfo['name']."</h1>";
include("alli_menu.tpl"); 
?>
<table cellpadding="1" cellspacing="1" id="quit" class="small_option"><thead>

<form method="post" action="allianz.php">
<input type="hidden" name="a" value="11">
<input type="hidden" name="o" value="11">
<input type="hidden" name="s" value="5">

<tr>
<th colspan="2">Quit alliance</th>
</tr>
</thead><tbody>
<?php
	if ($isOwner && $membersCount > 0) {
?>
<tr>
	<td colspan="2" class="info">
		Because you are the alliance founder, you need to select a replacement founder before you leave.
	</td>
</tr>
<tr>
	<th>
		new&nbsp;founder:
		</th>
	<td>
		<?php
			$memberlist = $database->getAllMember($aid);
		?>
		<select name="new_founder" class="name dropdown">
		<?php
			$canQuit = false;
           	foreach($memberlist as $member) {
           		if (($member['id'] != $session->uid) && ($database->getSingleFieldTypeCount($member['id'], 18, 3, '>=') >= 1)) {
               		echo "<option value=\"".$member['id']."\">".$member['username']."</option>";
               		$canQuit = true;
               	}
            }

            if (!$canQuit) {
            	echo "<option value=\"-1\">no candidates!</option>";
            }
        ?>
            </select>
	</td>
</tr>
<?php
	}
?>
<tr>
	<td colspan="2" class="info">
		<br />In order to quit the alliance you have to enter your password again for safety reasons.
	</td>
</tr>
<tr>
	<th>
		password:
		</th>
	<td>
		<input class="pass text" type="password" name="pw" maxlength="20">
	</td>
</tr>
</tbody>
</table>

<?php
	if (!$canQuit) {
?>
	<span style="color: red">
		<br />
		Unfortunately, there are no members of the alliance with Embassy at level 3 or more. In this case, you will not be able 
		to reassign the founder role. You can still <a href="allianz.php?s=5">kick all members</a> and quit the alliance afterwards,
		if you wish.
	</span>
	<?php
        }
    ?>

<p><input type="image" value="ok" name="s1" id="btn_ok" class="dynamic_img" src="img/x.gif" alt="OK" /></form></p>