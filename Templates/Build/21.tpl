<div id="build" class="gid21"><a href="#" onClick="return Popup(21,4, 'gid');" class="build_logo"> 
<img class="building g21" src="img/x.gif" alt="Workshop" title="Workshop" /> </a>

<h1>Workshop <span class="level">Level <?php echo $village->resarray['f'.$id]; ?></span></h1>
<p class="build_desc">Siege engines like catapults and rams can be built in the workshop. The higher its level the faster the units are produced.</p>
<?php if ($building->getTypeLevel(21) > 0) { ?>

		<form method="POST" name="snd" action="build.php">
			<input type="hidden" name="id" value="<?php echo $id; ?>" />
            <input type="hidden" name="ft" value="t1" />
			<table cellpadding="1" cellspacing="1" class="build_details">
			<thead>
					<tr>
						<td>Name</td>
						<td>Quantity</td>
						<td>Max</td>
					</tr>
				</thead>
				<tbody>
             <?php 
            $success = 0;
            $start = ($session->tribe == 1)? 7 : (($session->tribe == 2)? 17 : 27);
            if ($session->tribe == 1){
            $start = 7;
            }else if ($session->tribe == 2){
            $start = 17;
            }else if ($session->tribe == 3){
            $start = 27;
            }else if ($session->tribe == 4){
            $start = 37;
            }else if ($session->tribe == 5){
            $start = 47;
            }
            for($i=$start;$i<=($start+1);$i++) {
                if($technology->getTech($i)) {
                echo "<tr><td class=\"desc\"><div class=\"tit\"><img class=\"unit u$i\" src=\"img/x.gif\" alt=\"".$technology->getUnitName($i)."\" title=\"".$technology->getUnitName($i)."\" />
                    <a href=\"#\" onClick=\"return Popup($i,1);\">".$technology->getUnitName($i)."</a> <span class=\"info\">(Avaliable: ".$village->unitarray['u'.$i].")</span></div>";
                    echo "<div class=\"details\">
                                        <img class=\"r1\" src=\"img/x.gif\" alt=\"Wood\" title=\"Wood\" />".${'u'.$i}['wood']."|<img class=\"r2\" src=\"img/x.gif\" alt=\"Clay\" title=\"Clay\" />".${'u'.$i}['clay']."|<img class=\"r3\" src=\"img/x.gif\" alt=\"Iron\" title=\"Iron\" />".${'u'.$i}['iron']."|<img class=\"r4\" src=\"img/x.gif\" alt=\"Crop\" title=\"Crop\" />".${'u'.$i}['crop']."|<img class=\"r5\" src=\"img/x.gif\" alt=\"Crop consumption\" title=\"Crop consumption\" />".${'u'.$i}['pop']."|<img class=\"clock\" src=\"img/x.gif\" alt=\"Duration\" title=\"Duration\" />";
                    echo $generator->getTimeFormat(round(${'u'.$i}['time'] * ($bid21[$village->resarray['f'.$id]]['attri'] / 100) / SPEED));
                    if($session->userinfo['gold'] >= 3 && $building->getTypeLevel(17) >= 1) {
                   echo "|<a href=\"build.php?gid=17&t=3&r1=".((${'u'.$i}['wood'])*$technology->maxUnitPlus($i))."&r2=".((${'u'.$i}['clay'])*$technology->maxUnitPlus($i))."&r3=".((${'u'.$i}['iron'])*$technology->maxUnitPlus($i))."&r4=".((${'u'.$i}['crop'])*$technology->maxUnitPlus($i))."\" title=\"NPC trade\"><img class=\"npc\" src=\"img/x.gif\" alt=\"NPC trade\" title=\"NPC trade\" /></a>";
                 }  
                    echo "</div></td>
                                <td class=\"val\">
                                    <input type=\"text\" class=\"text\" name=\"t$i\" value=\"0\" maxlength=\"$i\">
                                </td>
            
                                <td class=\"max\">
                                    <a href=\"#\" onClick=\"document.snd.t$i.value=".$technology->maxUnit($i)."; return false;\">(".$technology->maxUnit($i).")</a>
                                </td>
                            </tr>";
                      $success += 1;
                }
            }
            if($success == 0) {
                echo "<tr><td class=\"none\" colspan=\"3\">No units avaliable. Research at academy</td></tr>";
            }
            ?>
				</tbody>
			</table>
			<p>
				<input type="image" id="btn_train" class="dynamic_img" value="ok" name="s1" src="img/x.gif" alt="train" />

			</p>
		</form>
<?php
	    } else {
			echo "<b>Training can commence when workshop are completed.</b><br>\n";
		}

    $trainlist = $technology->getTrainingList(3);
    if(count($trainlist) > 0) {
    //$timer = 2*count($trainlist);
    	echo "
    <table cellpadding=\"1\" cellspacing=\"1\" class=\"under_progress\">
		<thead><tr>
			<td>Training</td>
			<td>Duration</td>
			<td>Finished</td>
		</tr></thead>
		<tbody>";
        $TrainCount = 0;
		foreach($trainlist as $train) {
			$TrainCount++;
			echo "<tr><td class=\"desc\">";
			echo "<img class=\"unit u".$train['unit']."\" src=\"img/x.gif\" alt=\"".$train['name']."\" title=\"".$train['name']."\" />";
			echo $train['amt']." ".$train['name']."</td><td class=\"dur\">";
			if ($TrainCount == 1 ) {
				$NextFinished = $generator->getTimeFormat(($train['commence']+$train['eachtime'])-time());
				echo "<span id=timer1>".$generator->getTimeFormat(($train['commence']+($train['eachtime']*$train['amt']))-time())."</span>";
			} else {
				echo $generator->getTimeFormat($train['eachtime']*$train['amt']);
			}
			echo "</td><td class=\"fin\">";
			$time = $generator->procMTime($train['commence']+($train['eachtime']*$train['amt']));
			if($time[0] != "today") {
				echo "on ".$time[0]." at ";
            }
            echo $time[1];
		} ?>
		</tr><tr class="next"><td colspan="3">The next unit will be finished in <span id="timer2"><?php echo $NextFinished; ?></span></td></tr>
        </tbody></table>
    <?php }
include("upgrade.tpl");
?>  
    </p></div>


