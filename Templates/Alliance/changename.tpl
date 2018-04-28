<?php
if(!isset($aid)) $aid = $session->alliance;

$allianceinfo = $database->getAlliance($aid);
echo "<h1>".$allianceinfo['tag']." - ".$allianceinfo['name']."</h1>";
include("alli_menu.tpl"); 
?>
<form method="post" action="allianz.php">
<input type="hidden" name="a" value="100">
<input type="hidden" name="o" value="100">
<input type="hidden" name="s" value="5">

<table cellpadding="1" cellspacing="1" cellpadding="1" cellspacing="1" id="name" class="small_option"><thead>
<tr>
<th colspan="2">Change name</th>
</tr></thead>
<tbody><tr>
<th>Tag</th>
<td><input class="tag text" name="ally1" value="<?php echo $allianceinfo['tag']; ?>" maxlength="15">
<span class="error2"><?php echo $form->getError("ally1"); ?></span></td>
</tr>

<tr>
<th>Name</th>
<td><input class="name text" name="ally2" value="<?php echo $allianceinfo['name']; ?>" maxlength="50">
<span class="error2"><?php echo $form->getError("ally2"); ?></span></td>
</tr></tbody></table>

<p><button value="ok" name="s1" id="btn_ok" class="trav_buttons" alt="OK" /> Ok </button></form></p>
<p class="error"><?php echo $form->getError("perm"); ?></p>
