<?php
if(!isset($aid)) $aid = $session->alliance;

$allianceinfo = $database->getAlliance($aid);

echo "<h1>".$allianceinfo['tag']." - ".$allianceinfo['name']."</h1>";
include_once("alli_menu.tpl"); 
?>
<p class="error"><?php echo $form->getError("perm"); ?></p>
<form method="POST" action="allianz.php">
<input type="hidden" name="s" value="5">
<table cellpadding="1" cellspacing="1" id="options" class="small_option">
<thead>
<tr>
<th colspan="2">Options</th>
</tr></thead><tbody>
<?php
if ($alliance->userPermArray['opt1']==1){
?>		
        <tr>
		<td class="sel"><input class="radio" type="radio" name="o" value="1"></td>
		<td class="val">Assign to position</td>
		</tr>
<?php
}
if ($alliance->userPermArray['opt3']==1){
?>        
        <tr>
		<td class="sel"><input class="radio" type="radio" name="o" value="100"></td>
		<td class="val">Change name</td>
		</tr>
<?php
}
if ($alliance->userPermArray['opt2']==1){
?>        
        <tr>
		<td class="sel"><input class="radio" type="radio" name="o" value="2"></td>
		<td class="val">Kick player</td>
		</tr>		
<?php
}
if ($alliance->userPermArray['opt3']==1){
?>        

		<tr>
		<td class="sel"><input class="radio" type="radio" name="o" value="3"></td>
		<td class="val">Change alliance description</td>
		</tr>
<?php
}
if ($alliance->userPermArray['opt6']==1){
?>         
        <tr>
		<td class="sel"><input class="radio" type="radio" name="o" value="6"></td>
		<td class="val">Alliance diplomacy</td>
		</tr>
<?php
}
if ($alliance->userPermArray['opt4']==1){
?>        
        <tr>
		<td class="sel"><input class="radio" type="radio" name="o" value="4"></td>
		<td class="val">Invite a player into the alliance</td>
		</tr>
<?php
}
if ($alliance->userPermArray['opt5']==1){
?>         
        <tr>
		<td class="sel"><input class="radio" type="radio" name="o" value="5"></td>
		<td class="val">Link to the forum</td>
		</tr>
<?php
}
?>         
        <tr>
		<td class="sel"><input class="radio" type="radio" name="o" value="11"></td>
		<td class="val">Quit alliance</td>
		</tr>
        
        </tbody>
	</table>

	<p><button value="ok" name="s1" id="btn_ok" class="trav_buttons" alt="OK" onclick="this.disabled=true;this.form.submit();" /> Ok </button></p></form>
