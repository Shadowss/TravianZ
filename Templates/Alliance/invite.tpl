<?php
if(isset($aid)) {
$aid = $aid;
}
else {
$aid = $session->alliance;
}
$allianceinfo = $database->getAlliance($aid);
$allianceInvitations = $database->getAliInvitations($aid);
echo "<h1>".$allianceinfo['tag']." - ".$allianceinfo['name']."</h1>";
include("alli_menu.tpl"); 
?>

<table cellpadding="1" cellspacing="1" id="invite" class="small_option"><thead>

<form method="post" action="allianz.php">
<input type="hidden" name="s" value="5">
<input type="hidden" name="o" value="4">
<input type="hidden" name="a" value="4">

<tr>
<th colspan="2">Invite a player into the alliance</th>
</tr>
</thead><tbody>
<tr><th>Name</th>
<td><input class="name text" type="text" name="a_name" maxlength="30"><span class="error"></span></td>
</tr>
</tbody></table>
<p><input type="image" value="ok" name="s1" id="btn_ok" class="dynamic_img" src="img/x.gif" alt="OK" onclick="this.disabled=true;this.form.submit();"/></form> </p>

<p class="error"><?php echo $form->getError("name1"); ?><br /><?php echo $form->getError("name2"); ?><br /><?php echo $form->getError("name3"); ?><br /><?php echo $form->getError("name4"); ?><br /><?php echo $form->getError("name5"); ?><br /><?php echo $form->getError("perm"); ?></p><br />
<table cellpadding="1" cellspacing="1" id="invitations" class="small_option"><thead>

<tr>

<th colspan="2">Invitations:</th>
</tr></thead>
<tbody>
<?php
if (count($allianceInvitations) == 0) {
	echo "<tr>";
    echo "<td class=none colspan=2>none</td>";
	echo "</tr>";
    } else {
 	foreach($allianceInvitations as $invit) {
	$invited = $database->getUserField($invit['uid'],username,0);
    echo "<tr>";
    echo "<td class=abo><a href=\"?o=4&s=5&d=".$invit['id']."\"><img src=\"gpack/travian_default/img/a/del.gif\" width=\"12\" height=\"12\" alt=\"Del\"></a></td>";    
	echo "<td><a href=spieler.php?uid=".$invit['uid'].">".$invited."</td>";
    echo "</tr>";
	}   
}           
?>
</tbody>
</table>