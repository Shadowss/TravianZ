<form method="POST" name="snd" action="build.php">
				<input type="hidden" name="id" value="<?php echo $id; ?>" />
                <input type="hidden" name="ft" value="t1" />

			<table cellpadding="1" cellspacing="1" class="build_details">
				<thead>
					<tr>
						<td>Naam</td>
						<td>Aantal</td>
						<td>max</td>
					</tr>
				</thead>
				<tbody>
<?php
$i = 20;
               echo "<tr><td class=\"desc\">
					<div class=\"tit\">
						<img class=\"unit u".$i."\" src=\"img/x.gif\" alt=\"".$technology->getUnitName($i)."\" title=\"".$technology->getUnitName($i)."\" />
						<a href=\"#\" onClick=\"return Popup(".$i.",1);\">".$technology->getUnitName($i)."</a>  <span class=\"info\">(Available: ".$village->unitarray['u'.$i].")</span>
					</div>
					<div class=\"details\"><img class=\"r1\" src=\"img/x.gif\" alt=\"Lumber\" title=\"Lumber\" />".${'u'.$i}['wood']."|<img class=\"r2\" src=\"img/x.gif\" alt=\"Clay\" title=\"Clay\" />".${'u'.$i}['clay']."|<img class=\"r3\" src=\"img/x.gif\" alt=\"Iron\" title=\"Iron\" />".${'u'.$i}['iron']."|<img class=\"r4\" src=\"img/x.gif\" alt=\"Crop\" title=\"Crop\" />".${'u'.$i}['crop']."|<img class=\"clock\" src=\"img/x.gif\" alt=\"duration\" title=\"duration\" />";
                    echo $generator->getTimeFormat(round(${'u'.$i}['time']/SPEED));
                    //if($session->userinfo['gold'] >= 3 && $building->getTypeLevel(17) > 1) {
                   //echo "|<a href=\"build.php?gid=17&t=3&r1=".${'r'.$i}['wood']."&r2=".${'r'.$i}['clay']."&r3=".${'r'.$i}['iron']."&r4=".${'r'.$i}['crop']."\" title=\"NPC trade\"><img class=\"npc\" src=\"img/x.gif\" alt=\"NPC trade\" title=\"NPC trade\" /></a>";
                   //}
                   echo "
				<td class=\"val\"><input type=\"text\" class=\"text\" name=\"t".$i."\" value=\"0\" maxlength=\"4\"></td>
				<td class=\"max\"><a href=\"#\" onClick=\"document.snd.t".$i.".value=".$technology->maxUnit($i)."; return false;\">(".$technology->maxUnit($i).")</a></td></tr></tbody>
	";
                ?>

				</tbody>
			</table>
			<p>
				<input type="image" id="btn_train" class="dynamic_img" value="ok" name="s1" src="img/x.gif" alt="train" />
			</p>

                <?php
    $trainlist = $technology->getTrainingList(20);
    if(count($trainlist) > 0) {
    $timer = 2*count($trainlist);
    	echo "
    <table cellpadding=\"1\" cellspacing=\"1\" class=\"under_progress\">
		<thead><tr>
			<td>Training</td>
			<td>Duration</td>
			<td>Finished</td>
		</tr></thead>
		<tbody>";
        foreach($trainlist as $train) {
        echo "<tr><td class=\"desc\">";
        echo "<img class=\"unit u".$train['unit']."\" src=\"img/x.gif\" alt=\"".$train['name']."\" title=\"".$train['name']."\" />".$train['amt']." ".$train['name']."</td><td class=\"dur\"><span id=timer".$timer.">".$generator->getTimeFormat(($train['commence']+($train['eachtime']*$train['amt']))-time())."</span></td><td class=\"fin\">";
        $timer -= 1;
        $time = $generator->procMTime($train['commence']+(1*$train['amt']));
        if($time[0] != "today") {
            echo "on ".$time[0]." at";
            }
            echo $time[1]."</span><span> o'clock</td>
		</tr><tr class=\"next\"><td colspan=\"3\">The next unit will be finished in <span id=timer".$timer.">".$generator->getTimeFormat(($train['commence']+$train['eachtime'])-time())."</span></td></tr>";
        }
        echo "</tbody></table>";
    }
    ?>

		</form>
