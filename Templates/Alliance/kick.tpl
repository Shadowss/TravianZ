<?php
if(isset($aid)) {
$aid = $aid;
}
else {
$aid = $session->alliance;
}
$memberlist = $database->getAllMember($aid);
$allianceinfo = $database->getAlliance($aid);
echo "<h1>".$allianceinfo['tag']." - ".$allianceinfo['name']."</h1>";
include("alli_menu.tpl"); 
?>
			<form method="post" action="allianz.php">
				<table cellpadding="1" cellspacing="1" id="position" class="small_option">
					<thead>
						<tr>
							<th colspan="2">Kick Player:</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th colspan="2">Here you can kick the players from your alliance.</th>
						</tr>
						<tr>
							<th>Name</th>
							<td>
								<select name="a_user" class="name dropdown">
								<?php
                                foreach($memberlist as $member) {
                                echo "<option value=".$member['id'].">".$member['username']."</option>";
                                }
                                ?>
                                </select>
							</td>
						</tr>
					</tbody>
				</table>
				<p>
					<input type="hidden" name="o" value="2">
					<input type="hidden" name="s" value="5">
					<input type="hidden" name="a" value="2">                    
					<input type="image" value="ok" name="s1" id="btn_ok" class="dynamic_img" src="img/x.gif" alt="OK" />
				</p>
			</form>
			<p class="error"></p>