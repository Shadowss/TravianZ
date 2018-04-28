<?php
if(!isset($aid)) $aid = $session->alliance;

$allianceinfo = $database->getAlliance($aid);
echo "<h1>".$allianceinfo['tag']." - ".$allianceinfo['name']."</h1>";
include("alli_menu.tpl"); 
?>
<form method="post" action="allianz.php">
<input type="hidden" name="a" value="5">
<input type="hidden" name="o" value="5">
<input type="hidden" name="s" value="5">
<table cellpadding="1" cellspacing="1"><thead>
<tr>
<th colspan="2">Link to the forum</th>
</tr>

</thead><tbody>

<tr><th>URL</th>
<td><input class="link text" type="text" name="f_link" value="<?php echo isset($_POST['f_link']) ? $_POST['f_link']  : ((string)($allianceinfo['forumlink']) != "0" ? $allianceinfo['forumlink'] : ""); ?>" maxlength="200">
</td>
</tr>

<tr>
<td colspan="2" class="info">If your alliance wants to use an external forum, you can enter the url here.</td>
</tr></tbody>
</table>

<p><button value="ok" name="s1" id="btn_ok" class="trav_buttons" alt="OK" /> Ok </button></p></form>
<p class="error"><?php echo $form->getError("perm"); ?></p>
