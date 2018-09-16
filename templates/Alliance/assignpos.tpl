<?php
if(!isset($aid)) $aid = $session->alliance;

$allianceinfo = $database->getAlliance($aid);
$memberlist = $database->getAllMember($aid);

echo "<h1>".$allianceinfo['tag']." - ".$allianceinfo['name']."</h1>";
include("alli_menu.tpl");
?>
			<form method="post" action="allianz.php">
				<table cellpadding="1" cellspacing="1" id="position" class="small_option">
					<thead>
						<tr>
							<th colspan="2">Assign to position</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th colspan="2">Here you can grant the players from your alliance rights & positions.</th>
						</tr>
						<tr>
							<th>Name</th>
							<td>
								<select name="a_user" class="name dropdown">
								<?php
                                foreach($memberlist as $member){
                                    if($member['id'] != $session->uid && !$database->isAllianceOwner($member['id'])){
                                        echo "<option value=".$member['id'].">".$member['username']."</option>";
                                    }
                                }
                                ?>
                                </select>
							</td>
						</tr>
					</tbody>
				</table>
				<p>
					<input type="hidden" name="o" value="1">
					<input type="hidden" name="s" value="5">
					<button value="ok" name="s1" id="btn_ok" class="trav_buttons">OK</button>
				</p>
			</form>
