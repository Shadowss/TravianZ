<table cellpadding="1" cellspacing="1" class="build_details">
	<thead>
		<tr>
			<td><?php echo ARMOURY; ?></td>
			<td><?php echo ACTION; ?></td>
		</tr>
	</thead>
	<tbody>
		<tr>
		<?php
		$abdata = $database->getABTech($village->wid);
		$ABups = $technology->getABUpgrades('a');
		$totalUps = count($ABups);
		for($i=($session->tribe*10-9);$i<=($session->tribe*10-2);$i++) {
			$j = $i % 10 ;
			if ( $technology->getTech($i) || $j == 1 ) {
			    
				echo "<tr><td class=\"desc\"><div class=\"tit\">
<img class=\"unit u".$i."\" src=\"img/x.gif\" alt=\"".$technology->getUnitName($i)."\" title=\"".$technology->getUnitName($i)."\" />
<a href=\"#\" onClick=\"return Popup(".$i.",1);\">".$technology->getUnitName($i)."</a> (Level ".$abdata['a'.$j];
				$ups = 0;
				if($totalUps > 0){
				    foreach($ABups as $upgrade){
				        if(in_array(("a".$j), $upgrade)) $ups++;
				    }
				    if($ups > 0) echo "+".$ups;	
				}
				echo ")</div>";
				
				if($abdata['a'.$j]+$ups != 20) {
				    echo "<div class=\"details\"><img class=\"r1\" src=\"img/x.gif\" alt=\"Lumber\" title=\"Lumber\" />".${'ab'.$i}[$abdata['a'.$j]+1+$ups]['wood']."|<img class=\"r2\" src=\"img/x.gif\" alt=\"Clay\" title=\"Clay\" />".${'ab'.$i}[$abdata['a'.$j]+1+$ups]['clay']."|<img class=\"r3\" src=\"img/x.gif\" alt=\"Iron\" title=\"Iron\" />".${'ab'.$i}[$abdata['a'.$j]+1+$ups]['iron']."|<img class=\"r4\" src=\"img/x.gif\" alt=\"Crop\" title=\"Crop\" />".${'ab'.$i}[$abdata['a'.$j]+1+$ups]['crop']."|<img class=\"clock\" src=\"img/x.gif\" alt=\"duration\" title=\"duration\" />";
				    echo $generator->getTimeFormat(round(${'ab'.$i}[$abdata['a'.$j]+1+$ups]['time']*($bid13[$building->getTypeLevel(13)]['attri'] / 100)/SPEED));
				
                    //-- If available resources combined are not enough, remove NPC button
				    $total_required = (int)(${'ab'.$i}[$abdata['a'.$j]+1+$ups]['wood'] + ${'ab'.$i}[$abdata['a'.$j]+1+$ups]['clay'] + ${'ab'.$i}[$abdata['a'.$j]+1+$ups]['iron'] + ${'ab'.$i}[$abdata['a'.$j]+1+$ups]['crop']);
                    if($session->userinfo['gold'] >= 3 && $building->getTypeLevel(17) >= 1 && $village->atotal >= $total_required) {
                        echo "|<a href=\"build.php?gid=17&t=3&r1=".${'ab'.$i}[$abdata['a'.$j]+1+$ups]['wood']."&r2=".${'ab'.$i}[$abdata['a'.$j]+1+$ups]['clay']."&r3=".${'ab'.$i}[$abdata['a'.$j]+1+$ups]['iron']."&r4=".${'ab'.$i}[$abdata['a'.$j]+1+$ups]['crop']."\" title=\"NPC trade\"><img class=\"npc\" src=\"img/x.gif\" alt=\"NPC trade\" title=\"NPC trade\" /></a>";
					}
				}
		        if($abdata['a'.$j] == 20) {
					echo "<td class=\"act\"><div class=\"none\">".MAXIMUM_LEVEL."</div></td></tr>";
				}
				else if ($building->getTypeLevel(13) <= $abdata['a'.$j]+$ups) {
				    echo "<td class=\"act\"><div class=\"none\">".UPGRADE_ARMOURY."</div></td></tr>";
				}
				else if(${'ab'.$i}[$abdata['a'.$j]+1+$ups]['wood'] > $village->maxstore || ${'ab'.$i}[$abdata['a'.$j]+1+$ups]['clay'] > $village->maxstore || ${'ab'.$i}[$abdata['a'.$j]+1+$ups]['iron'] > $village->maxstore) {
					echo "<td class=\"act\"><div class=\"none\">".EXPAND_WAREHOUSE."</div></td></tr>";
				}
				else if (${'ab'.$i}[$abdata['a'.$j]+1+$ups]['crop'] > $village->maxcrop) {
					echo "<td class=\"act\"><div class=\"none\">".EXPAND_GRANARY."</div></td></tr>";
				}
				else if (${'ab'.$i}[$abdata['a'.$j]+1+$ups]['wood'] > $village->awood || ${'ab'.$i}[$abdata['a'.$j]+1+$ups]['clay'] > $village->aclay || ${'ab'.$i}[$abdata['a'.$j]+1+$ups]['iron'] > $village->airon || ${'ab'.$i}[$abdata['a'.$j]+1+$ups]['crop'] > $village->acrop) {
				    if($village->getProd("crop")>0 || $village->acrop > ${'ab'.$i}[$abdata['a'.$j]+1+$ups]['crop']){
					    $time = $technology->calculateAvaliable(13,${'ab'.$i}[$abdata['a'.$j]+1+$ups]);
						echo "<br><span class=\"none\">".ENOUGH_RESOURCES." ".$time[0]." at ".$time[1]."</span></div></td>";
					} else {
						echo "<br><span class=\"none\">".CROP_NEGATIVE."</span></div></td>";
					}
		            echo "<td class=\"act\"><div class=\"none\">".TOO_FEW_RESOURCES."</div></td></tr>";
				}				
				else if ($totalUps == 1 && !$session->plus || $totalUps > 1) {
					echo "<td class=\"act\"><div class=\"none\">".UPGRADE_IN_PROGRESS."</div></td></tr>";
				}
				else if($session->access != BANNED){
				    echo "<td class=\"act\"><a class=\"research\" href=\"build.php?id=$id&amp;a=$j&amp;c=".$session->mchecker."\">".UPGRADE."</a>";
				    if($totalUps != 0) echo "<span class=\"none\"> ".WAITING."</span>";
				    echo"</td></tr>";
				}else{
				    echo "<td class=\"act\"><a class=\"research\" href=\"banned.php\">".UPGRADE."</a>";
				    if($totalUps != 0) echo "<span class=\"none\"> ".WAITING."</span>";
				    echo"</td></tr>";
				}
			}
		}
		?>
	</tbody>
</table>

<?php
    if($totalUps > 0) {
		echo "<table cellpadding=\"1\" cellspacing=\"1\" class=\"under_progress\"><thead><tr><td>".UPGRADING."</td><td>".DURATION."</td><td>".COMPLETE."</td></tr>
</thead><tbody>";
		foreach($ABups as $arms) {
			$count++;
		    $ABUnit = substr($arms['tech'], 1, 2);
			$abdata['a' . $ABUnit]++;
			$unit = ($session->tribe - 1) * 10 + $ABUnit;
			echo "<tr><td class=\"desc\"><img class=\"unit u$unit\" src=\"img/x.gif\" alt=\"".$technology->getUnitName($unit)."\" title=\"".$technology->getUnitName($unit)."\" />".$technology->getUnitName($unit);
			echo "<span class=\"none\"> (".LEVEL." ".$abdata['a'.$ABUnit].")</span>";
			if($count > 1) echo "<span class=\"none\"> ".WAITING."</span>";
			echo "</td>";
			echo "<td class=\"dur\"><span id=\"timer".++$session->timer."\">".$generator->getTimeFormat($arms['timestamp']-time())."</span></td>";
			$date = $generator->procMtime($arms['timestamp']);
			echo "<td class=\"fin\"><span>".$date[1]."</span><span> hrs</span></td>";
			echo "</tr>";
		}
		echo "</tbody></table>";
	}
?>
