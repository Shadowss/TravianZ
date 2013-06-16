<div id="build" class="gid18"><a href="#" onClick="return Popup(18,4);" class="build_logo">
	<img class="building g18" src="img/x.gif" alt="Embassy" title="Embassy" />
</a>
<h1>Embassy <span class="level">Level <?php echo $village->resarray['f'.$id]; ?></span></h1>
<p class="build_desc">The embassy is a place for diplomats. The higher its level the more options the king gains.</p>

<?php
if($village->resarray['f'.$id] >= 3 && $session->alliance == 0) {
include("18_create.tpl");
}
if($session->alliance != 0) {
echo "
<table cellpadding=\"1\" cellspacing=\"1\" id=\"ally_info\">
	<thead><tr>
		<th colspan=\"2\">Alliance</th>
	</tr></thead>

	<tbody><tr>
		<th>Tag</th>
		<td>".$alliance->allianceArray['tag']."</td>
	</tr>
	<tr>
		<th>Name</th>
		<td>".$alliance->allianceArray['name']."</td>

	</tr>
	<tr>
		<td class=\"empty\" colspan=\"2\"></td>
	</tr>
	<tr>
		<td colspan=\"2\"><a href=\"allianz.php\">&nbsp;&raquo; to the alliance</a></td>
	</tr></tbody>
	</table>";
    }
    else if($village->resarray['f'.$id] >= 1) {
    ?>
<table cellpadding="1" cellspacing="1" id="join">
<form method="post" action="build.php">
<input type="hidden" name="id" value="<?php echo $id ?>">
<input type="hidden" name="a" value="2">

<thead><tr>
	<th colspan="3">join alliance</th>
</tr></thead>
<tbody><tr>
	<?php
    if($alliance->gotInvite) {
    	foreach($alliance->inviteArray as $invite) {
        	 echo "<td class=\"abo\"><a href=\"build.php?id=".$id."&a=2&d=".$invite['id']."\"><img class=\"del\" src=\"img/x.gif\" alt=\"refuse\" title=\"refuse\" /></a></td>
        <td class=\"nam\"><a href=\"allianz.php?aid=".$invite['alliance']."\">&nbsp;".$database->getAllianceName($invite['alliance'])."</a></td>
        <td class=\"acc\"><a href=\"build.php?id=".$id."&a=3&d=".$invite['id']."\">&nbsp;accept</a></td><tr>";
        }
        }
    else {
		echo "<td colspan=\"3\" class=\"none\">There are no invitations available.</td>";
        }
        ?>
	</tr></tbody></table>
    <?php
        if($alliance->gotInvite) {
        echo "<p class=\"error2\" style=\"color: #DD0000\">".$form->getError("ally_accept")."</p>";
        } 
    }
include("upgrade.tpl");
?>
</p></div>
