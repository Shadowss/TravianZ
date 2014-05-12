<div id="build" class="gid18"><a href="#" onClick="return Popup(18,4);" class="build_logo">
	<img class="building g18" src="img/x.gif" alt="Embassy" title="<?php echo EMBASSY; ?>" />
</a>
<h1><?php echo EMBASSY; ?> <span class="level"><?php echo LEVEL; ?> <?php echo $village->resarray['f'.$id]; ?></span></h1>
<p class="build_desc"><?php echo EMBASSY_DESC; ?></p>

<?php
if($village->resarray['f'.$id] >= 3 && $session->alliance == 0) {
include("18_create.tpl");
}
if($session->alliance != 0) {
echo "
<table cellpadding=\"1\" cellspacing=\"1\" id=\"ally_info\">
	<thead><tr>
		<th colspan=\"2\">".ALLIANCE."</th>
	</tr></thead>

	<tbody><tr>
		<th>".TAG."</th>
		<td>".$alliance->allianceArray['tag']."</td>
	</tr>
	<tr>
		<th>".NAME."</th>
		<td>".$alliance->allianceArray['name']."</td>

	</tr>
	<tr>
		<td class=\"empty\" colspan=\"2\"></td>
	</tr>
	<tr>
		<td colspan=\"2\"><a href=\"allianz.php\">&nbsp;&raquo; ".TO_THE_ALLIANCE."</a></td>
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
	<th colspan="3"><?php echo JOIN_ALLIANCE; ?></th>
</tr></thead>
<tbody><tr>
	<?php
    if($alliance->gotInvite) {
    	foreach($alliance->inviteArray as $invite) {
        	 echo "<td class=\"abo\"><a href=\"build.php?id=".$id."&a=2&d=".$invite['id']."\"><img class=\"del\" src=\"img/x.gif\" alt=\"refuse\" title=\"".REFUSE."\" /></a></td>
        <td class=\"nam\"><a href=\"allianz.php?aid=".$invite['alliance']."\">&nbsp;".$database->getAllianceName($invite['alliance'])."</a></td>
        <td class=\"acc\"><a href=\"build.php?id=".$id."&a=3&d=".$invite['id']."\">&nbsp;".ACCEPT."</a></td><tr>";
        }
        }
    else {
		echo "<td colspan=\"3\" class=\"none\">".NO_INVITATIONS."</td>";
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
