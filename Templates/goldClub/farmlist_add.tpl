<div id="raidListCreate">
	<h4>Create a new list</h4>
	<form action="build.php?gid=16&t=99" method="post">
		<div class="boxes boxesColor gray"><div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div><div class="boxes-ml"></div><div class="boxes-mr"></div><div class="boxes-mc"></div><div class="boxes-bl"></div><div class="boxes-br"></div><div class="boxes-bc"></div><div class="boxes-contents cf">
        <input type="hidden" name="action" value="addList">
			<table cellpadding="1" cellspacing="1" class="transparent">
				<tbody><tr>
					<th>
						Name:					</th>
					<td>
						<input class="text" id="name" name="name" type="text">
					</td>
				</tr>
				<tr>
					<th>
						Village:					</th>
					<td>
                    
						<select id="did" name="did">
<?php
	for($i=1;$i<=count($session->villages);$i++) {
    if($session->villages[$i-1] == $village->wid){
    	$select = 'selected="selected"';
    }else{
        $select = '';
    }
    
		echo "<option value=\"".$session->villages[$i-1]."\" ".$select.">".$database->getVillageField($session->villages[$i-1],'name')."</option>";
    }
?>						</select>
					</td>
				</tr>
			</tbody></table>

			</div>
				</div>

<button type="submit" value="create"><div class="button-container"><div class="button-position"><div class="btl"><div class="btr"><div class="btc"></div></div></div><div class="bml"><div class="bmr"><div class="bmc"></div></div></div><div class="bbl"><div class="bbr"><div class="bbc"></div></div></div></div><div class="button-contents">Create</div></div></button>
</form>
</div>
