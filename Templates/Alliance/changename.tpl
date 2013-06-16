<?php
if(isset($aid)) {
$aid = $aid;
}
else {
$aid = $session->alliance;
}
$allianceinfo = $database->getAlliance($aid);
echo "<h1>".$allianceinfo['tag']." - ".$allianceinfo['name']."</h1>";
include("alli_menu.tpl"); 
?>
<table cellpadding="1" cellspacing="1" cellpadding="1" cellspacing="1" id="name" class="small_option"><thead>
<form method="post" action="allianz.php">
<input type="hidden" name="a" value="100">
<input type="hidden" name="o" value="100">
<input type="hidden" name="s" value="5">

<tr>
<th colspan="2">Change name</th>
</tr></thead>
<tbody><tr>
<th>Tag</th>
<td><input class="tag text" name="ally1" value="<?php echo $allianceinfo['tag']; ?>" maxlength="15">
<span class="error2"></span></td>
</tr>

<tr>
<th>Name</th>
<td><input class="name text" name="ally2" value="<?php echo $allianceinfo['name']; ?>" maxlength="50">
<span class="error2"></span></td>
</tr></tbody></table>

<p><input type="image" value="ok" name="s1" id="btn_ok" class="dynamic_img" src="img/x.gif" alt="OK" /></form></p>
<p class="error3"><?php echo $form->getError("ally1"); ?></p>
<p class="error3"><?php echo $form->getError("ally2"); ?></p>
<p class="error3"><?php echo $form->getError("owner"); ?></p>
<p class="error3"><?php echo $form->getError("tag"); ?></p>
<p class="error3"><?php echo $form->getError("name"); ?></p>