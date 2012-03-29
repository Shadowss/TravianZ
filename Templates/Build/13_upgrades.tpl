<table cellpadding="1" cellspacing="1" class="build_details">
	<thead>
		<tr>
			<td>Armoury</td>
			<td>Action</td>
		</tr>
	</thead>
	<tbody>
		<tr>
		<?php
		$abdata = $database->getABTech($village->wid);
		$ABups = $technology->getABUpgrades('a');
		for($i=($session->tribe*10-9);$i<=($session->tribe*10-2);$i++) {
			$j = $i % 10 ;
			if ( $technology->getTech($i) || $j == 1 ) {
				echo "<tr><td class=\"desc\"><div class=\"tit\">
<img class=\"unit u".$i."\" src=\"img/x.gif\" alt=\"".$technology->getUnitName($i)."\" title=\"".$technology->getUnitName($i)."\" />
<a href=\"#\" onClick=\"return Popup(".$i.",1);\">".$technology->getUnitName($i)."</a> (Level ".$abdata['a'.$j].")
</div>";
				if($abdata['a'.$j] != 20) {
echo "<div class=\"details\"><img class=\"r1\" src=\"img/x.gif\" alt=\"Lumber\" title=\"Lumber\" />".${'ab'.$i}[$abdata['a'.$j]+1]['wood']."|<img class=\"r2\" src=\"img/x.gif\" alt=\"Clay\" title=\"Clay\" />".${'ab'.$i}[$abdata['a'.$j]+1]['clay']."|<img class=\"r3\" src=\"img/x.gif\" alt=\"Iron\" title=\"Iron\" />".${'ab'.$i}[$abdata['a'.$j]+1]['iron']."|<img class=\"r4\" src=\"img/x.gif\" alt=\"Crop\" title=\"Crop\" />".${'ab'.$i}[$abdata['a'.$j]+1]['crop']."|<img class=\"clock\" src=\"img/x.gif\" alt=\"duration\" title=\"duration\" />";
				echo $generator->getTimeFormat(round(${'ab'.$i}[$abdata['a'.$j]+1]['time']*($bid13[$building->getTypeLevel(13)]['attri'] / 100)/SPEED));
					if($session->userinfo['gold'] >= 3 && $building->getTypeLevel(17) >= 1) {
					echo "|<a href=\"build.php?gid=17&t=3&r1=".${'ab'.$i}[$abdata['a'.$j]+1]['wood']."&r2=".${'ab'.$i}[$abdata['a'.$j]+1]['clay']."&r3=".${'ab'.$i}[$abdata['a'.$j]+1]['iron']."&r4=".${'ab'.$i}[$abdata['a'.$j]+1]['crop']."\" title=\"NPC trade\"><img class=\"npc\" src=\"img/x.gif\" alt=\"NPC trade\" title=\"NPC trade\" /></a>";
					}
				}
		        if($abdata['a'.$j] == 20) {
					echo "<td class=\"act\"><div class=\"none\">Maximum<br>level</div></td></tr>";
				}
				else if(${'ab'.$i}[$abdata['a'.$j]+1]['wood'] > $village->maxstore || ${'ab'.$i}[$abdata['a'.$j]+1]['clay'] > $village->maxstore || ${'ab'.$i}[$abdata['a'.$j]+1]['iron'] > $village->maxstore) {
					echo "<td class=\"act\"><div class=\"none\">Expand<br>warehouse</div></td></tr>";
				}
				else if (${'ab'.$i}[$abdata['a'.$j]+1]['crop'] > $village->maxcrop) {
					echo "<td class=\"act\"><div class=\"none\">Expand<br>granary</div></td></tr>";
				}
				else if (${'ab'.$i}[$abdata['a'.$j]+1]['wood'] > $village->awood || ${'ab'.$i}[$abdata['a'.$j]+1]['clay'] > $village->aclay || ${'ab'.$i}[$abdata['a'.$j]+1]['iron'] > $village->airon || ${'ab'.$i}[$abdata['a'.$j]+1]['crop'] > $village->acrop) {
					if($village->getProd("crop")>0 || $village->acrop > ${'ab'.$i}[$abdata['a'.$j]+1]['crop']){
						$time = $technology->calculateAvaliable(13,${'ab'.$i}[$abdata['a'.$j]+1]);
						echo "<br><span class=\"none\">Enough resources ".$time[0]." at ".$time[1]."</span></div></td>";
					} else {
						echo "<br><span class=\"none\">Crop production is negative so you will never reach the required resources</span></div></td>";
					}
		            echo "<td class=\"act\"><div class=\"none\">Too few<br>resources</div></td></tr>";
				}
				else if ($building->getTypeLevel(13) <= $abdata['a'.$j]) {
					echo "<td class=\"act\"><div class=\"none\">Upgrade<br>armoury</div></td></tr>";
				}
				else if (count($ABups) > 0) {
					echo "<td class=\"act\"><div class=\"none\">Upgrade in<br>progress</div></td></tr>";
				}
				else if($session->access != BANNED){
				echo "<td class=\"act\"><a class=\"research\" href=\"build.php?id=$id&amp;a=$j&amp;c=".$session->mchecker."\">Upgrade</a></td></tr>";
				}else{
				echo "<td class=\"act\"><a class=\"research\" href=\"banned.php\">Upgrade</a></td></tr>";
				}
			}
		}
		?>
	</tbody>
</table>

<?php
	if(count($ABups) > 0) {
		echo "<table cellpadding=\"1\" cellspacing=\"1\" class=\"under_progress\"><thead><tr><td>Upgrading</td><td>Duration</td><td>Complete</td></tr>
</thead><tbody>";
		$timer = 1;
		foreach($ABups as $arms) {
			$unit = ($session->tribe-1)*10 + substr($arms['tech'],1,2);
			echo "<tr><td class=\"desc\"><img class=\"unit u$unit\" src=\"img/x.gif\" alt=\"".$technology->getUnitName($unit)."\" title=\"".$technology->getUnitName($unit)."\" />".$technology->getUnitName($unit)."</td>";
			echo "<td class=\"dur\"><span id=\"timer$timer\">".$generator->getTimeFormat($arms['timestamp']-time())."</span></td>";
			$date = $generator->procMtime($arms['timestamp']);
			echo "<td class=\"fin\"><span>".$date[1]."</span><span> hrs</span></td>";
			echo "</tr>";
			$timer +=1;
		}
		echo "</tbody></table>";
	}
?>
