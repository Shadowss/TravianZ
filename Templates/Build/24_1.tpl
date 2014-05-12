<table cellpadding="1" cellspacing="1" class="build_details">
	<thead>
		<tr>
			<td><?php echo CELEBRATIONS; ?></td>
			<td><?php echo ACTION; ?></td>
		</tr>
	</thead>
	<tbody>

		<tr>
		<?php
		$level = $village->resarray['f'.$id];
		$inuse = $database->getVillageField($village->wid, 'celebration');
		$time = Time();
		$i = 1;
			echo "<tr><td class=\"desc\"><div class=\"tit\">".$cel[$i]['name']." (".$cel[$i]['attri']." ".CULTURE_POINTS.")</div>
					<div class=\"details\"><img class=\"r1\" src=\"img/x.gif\" alt=\"Lumber\" title=\"".LUMBER."\" />".$cel[$i]['wood']."|<img class=\"r2\" src=\"img/x.gif\" alt=\"Clay\" title=\"".CLAY."\" />".$cel[$i]['clay']."|<img class=\"r3\" src=\"img/x.gif\" alt=\"Iron\" title=\"".IRON."\" />".$cel[$i]['iron']."|<img class=\"r4\" src=\"img/x.gif\" alt=\"Crop\" title=\"".CROP."\" />".$cel[$i]['crop']."|<img class=\"clock\" src=\"img/x.gif\" alt=\"duration\" title=\"".DURATION."\" />";
                    echo $generator->getTimeFormat(round($cel[$i]['time'] * ($bid24[$building->getTypeLevel(24)]['attri'] / 100)/SPEED));
                    if($session->userinfo['gold'] >= 3 && $building->getTypeLevel(17) >= 1) {
                   echo "|<a href=\"build.php?gid=17&t=3&r1=".$cel[$i]['wood']."&r2=".$cel[$i]['clay']."&r3=".$cel[$i]['iron']."&r4=".$cel[$i]['crop']."\" title=\"NPC trade\"><img class=\"npc\" src=\"img/x.gif\" alt=\"NPC trade\" title=\"NPC trade\" /></a>";
                   }		   
				if($inuse > $time){
					echo "<td class=\"act\">
					<div class=\"none\">".CELEBRATIONS_IN_PROGRESS."</div>
					</td></tr>";
					}				
                  else if($cel[$i]['wood'] > $village->awood || $cel[$i]['clay'] > $village->aclay || $cel[$i]['iron'] > $village->airon || $cel[$i]['crop'] > $village->acrop) {
					if($village->getProd("crop")>0){
	                   	$time = $technology->calculateAvaliable(24,$cel[$i]);
		                echo "<br><span class=\"none\">".ENOUGH_RESOURCES." ".$time[0]." at ".$time[1]."</span></div></td>";
					} else {
						echo "<br><span class=\"none\">".CROP_NEGATIVE."</span></div></td>";
					}
                    echo "<td class=\"act\"><div class=\"none\">".TOO_FEW_RESOURCES."</div></td></tr>";
                }
                else {
					echo "</td>";
                    echo "<td class=\"act\">";
					echo "<a class=\"research\" href=\"celebration.php?type=$i&id=$id\">".HOLD."</a></td></tr>";
                }
				
			if($level >= 10){	
		$level = $village->resarray['f'.$id];
			echo "<tr><td class=\"desc\">
					<div class=\"tit\">
						".GREAT_CELEBRATIONS." (2000 ".CULTURE_POINTS.")
					</div>
					<div class=\"details\"><img class=\"r1\" src=\"img/x.gif\" alt=\"Lumber\" title=\"".LUMBER."\" />29700|<img class=\"r2\" src=\"img/x.gif\" alt=\"Clay\" title=\"".CLAY."\" />33250|<img class=\"r3\" src=\"img/x.gif\" alt=\"Iron\" title=\"".IRON."\" />32000|<img class=\"r4\" src=\"img/x.gif\" alt=\"Crop\" title=\"".CROP."\" />6700|<img class=\"clock\" src=\"img/x.gif\" alt=\"duration\" title=\"".DURATION."\" />";
                    echo $generator->getTimeFormat(round($gc[$level]/SPEED));
                    if($session->userinfo['gold'] >= 3 && $building->getTypeLevel(17) > 1) {
                   echo "|<a href=\"build.php?gid=17&t=3&r1=29700&r2=33250&r3=32000&r4=6700\" title=\"NPC trade\"><img class=\"npc\" src=\"img/x.gif\" alt=\"NPC trade\" title=\"NPC trade\" /></a>";
                   }
                	if($inuse > $time){
					echo "<td class=\"act\">
					<div class=\"none\">".CELEBRATIONS_IN_PROGRESS."</div>
					</td></tr>";
					}	
                  else if(29700 > $village->awood || 33250 > $village->aclay || 32000 > $village->airon || 6700 > $village->acrop) {
			if($village->getProd("crop")>0){
                   	$time = $technology->calculateAvaliable(24,$cel[2]);
                    echo "<br><span class=\"none\">".ENOUGH_RESOURCES." ".$time[0]." at ".$time[1]."</span></div></td>";
			} else {
		    echo "<br><span class=\"none\">".CROP_NEGATIVE."</span></div></td>";
					}
                    echo "<td class=\"act\">
					<div class=\"none\">".TOO_FEW_RESOURCES."</div>
				</td></tr>";
                }
                else {
                     echo "</td>";
                    echo "<td class=\"act\">
					<a class=\"research\" href=\"celebration.php?type=2&id=$id\">".HOLD."</a></td></tr>";
                }
			}
?>
	</tbody>
</table>

