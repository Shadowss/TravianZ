<table cellpadding="1" cellspacing="1" class="build_details">
	<thead>
		<tr>
			<td><?php echo BLACKSMITH; ?></td>
			<td><?php echo ACTION; ?></td>
		</tr>
	</thead>
	<tbody>
		<tr>
		<?php
		$abdata = $database->getABTech($village->wid);
		$ABups = $technology->getABUpgrades('b');
		for($i=($session->tribe*10-9);$i<=($session->tribe*10-2);$i++) {
			$j = $i % 10 ;
			if ( $technology->getTech($i) || $j == 1 ) {
				echo "<tr><td class=\"desc\"><div class=\"tit\">
<img class=\"unit u".$i."\" src=\"img/x.gif\" alt=\"".$technology->getUnitName($i)."\" title=\"".$technology->getUnitName($i)."\" />
<a href=\"#\" onClick=\"return Popup(".$i.",1);\">".$technology->getUnitName($i)."</a> (Level ".$abdata['b'.$j].")
</div>";
				if($abdata['b'.$j] != 20) {
echo "<div class=\"details\"><img class=\"r1\" src=\"img/x.gif\" alt=\"Lumber\" title=\"Lumber\" />".${'ab'.$i}[$abdata['b'.$j]+1]['wood']."|<img class=\"r2\" src=\"img/x.gif\" alt=\"Clay\" title=\"Clay\" />".${'ab'.$i}[$abdata['b'.$j]+1]['clay']."|<img class=\"r3\" src=\"img/x.gif\" alt=\"Iron\" title=\"Iron\" />".${'ab'.$i}[$abdata['b'.$j]+1]['iron']."|<img class=\"r4\" src=\"img/x.gif\" alt=\"Crop\" title=\"Crop\" />".${'ab'.$i}[$abdata['b'.$j]+1]['crop']."|<img class=\"clock\" src=\"img/x.gif\" alt=\"duration\" title=\"duration\" />";
				echo $generator->getTimeFormat(round(${'ab'.$i}[$abdata['b'.$j]+1]['time']*($bid12[$building->getTypeLevel(12)]['attri'] / 100)/SPEED));
					if($session->userinfo['gold'] >= 3 && $building->getTypeLevel(17) >= 1) {
					echo "|<a href=\"build.php?gid=17&t=3&r1=".${'ab'.$i}[$abdata['b'.$j]+1]['wood']."&r2=".${'ab'.$i}[$abdata['b'.$j]+1]['clay']."&r3=".${'ab'.$i}[$abdata['b'.$j]+1]['iron']."&r4=".${'ab'.$i}[$abdata['b'.$j]+1]['crop']."\" title=\"NPC trade\"><img class=\"npc\" src=\"img/x.gif\" alt=\"NPC trade\" title=\"NPC trade\" /></a>";
					}
				}
		        if($abdata['b'.$j] == 20) {
					echo "<td class=\"act\"><div class=\"none\">".MAXIMUM_LEVEL."</div></td></tr>";
				}
				else if(${'ab'.$i}[$abdata['b'.$j]+1]['wood'] > $village->maxstore || ${'ab'.$i}[$abdata['b'.$j]+1]['clay'] > $village->maxstore || ${'ab'.$i}[$abdata['b'.$j]+1]['iron'] > $village->maxstore) {
					echo "<td class=\"act\"><div class=\"none\">".EXPAND_WAREHOUSE."</div></td></tr>";
				}
				else if (${'ab'.$i}[$abdata['b'.$j]+1]['crop'] > $village->maxcrop) {
					echo "<td class=\"act\"><div class=\"none\">".EXPAND_GRANARY."</div></td></tr>";
				}
				else if (${'ab'.$i}[$abdata['b'.$j]+1]['wood'] > $village->awood || ${'ab'.$i}[$abdata['b'.$j]+1]['clay'] > $village->aclay || ${'ab'.$i}[$abdata['b'.$j]+1]['iron'] > $village->airon || ${'ab'.$i}[$abdata['b'.$j]+1]['crop'] > $village->acrop) {
					if($village->getProd("crop")>0 || $village->acrop > ${'ab'.$i}[$abdata['b'.$j]+1]['crop']){
						$time = $technology->calculateAvaliable(12,${'ab'.$i}[$abdata['b'.$j]+1]);
			            echo "<br><span class=\"none\">".ENOUGH_RESOURCES." ".$time[0]." at ".$time[1]."</span></div></td>";
					} else {
						echo "<br><span class=\"none\">".CROP_NEGATIVE."</span></div></td>";
					}
		            echo "<td class=\"act\"><div class=\"none\">".TOO_FEW_RESOURCES."</div></td></tr>";
				}
				else if ($building->getTypeLevel(12) <= $abdata['b'.$j]) {
					echo "<td class=\"act\"><div class=\"none\">".UPGRADE_BLACKSMITH."</div></td></tr>";
				}
				else if (count($ABups) > 0) {
					echo "<td class=\"act\"><div class=\"none\">".UPGRADE_IN_PROGRESS."</div></td></tr>";
				}
				else if($session->access != BANNED){
					echo "<td class=\"act\"><a class=\"research\" href=\"build.php?id=$id&amp;a=$j&amp;c=".$session->mchecker."\">".UPGRADE."</a></td></tr>";
				}else{
					echo "<td class=\"act\"><a class=\"research\" href=\"banned.php\">".UPGRADE."</a></td></tr>";
				}
			}
		}
		?>
	</tbody>
</table>

<?php
	if(count($ABups) > 0) {
		echo "<table cellpadding=\"1\" cellspacing=\"1\" class=\"under_progress\"><thead><tr><td>".UPGRADING."</td><td>".DURATION."</td><td>".COMPLETE."</td></tr>
</thead><tbody>";
		$timer = 1;
		foreach($ABups as $black) {
			$unit = ($session->tribe-1)*10 + substr($black['tech'],1,2);
			echo "<tr><td class=\"desc\"><img class=\"unit u$unit\" src=\"img/x.gif\" alt=\"".$technology->getUnitName($unit)."\" title=\"".$technology->getUnitName($unit)."\" />".$technology->getUnitName($unit)."</td>";
			echo "<td class=\"dur\"><span id=\"timer$timer\">".$generator->getTimeFormat($black['timestamp']-time())."</span></td>";
			$date = $generator->procMtime($black['timestamp']);
			echo "<td class=\"fin\"><span>".$date[1]."</span><span> hrs</span></td>";
			echo "</tr>";
			$timer +=1;
		}
		echo "</tbody></table>";
	}
?>
