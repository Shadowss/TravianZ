<div id="build" class="gid20"><a href="#" onClick="return Popup(20,4);" class="build_logo">
<img class="building g20" src="img/x.gif" alt="Stable" title="Stable" /> </a>

<h1>Stable <span class="level">Level <?php echo $village->resarray['f'.$id]; ?></span></h1>
<p class="build_desc">Cavalry can be trained in the stable. The higher its level the faster the troops are trained.<br /></p>

<?php if ($building->getTypeLevel(20) > 0) { ?>

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
				if($session->tribe != 4){
                include("20_".$session->tribe.".tpl");
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
		echo "<b>Training can commence when stables are completed.</b><br>\n";
	}
    $trainlist = $technology->getTrainingList(2);
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
			if ($TrainCount == 1) {
				$NextFinished = $generator->getTimeFormat($train['timestamp2']-time());
				echo "<span id=timer1>".$generator->getTimeFormat($train['timestamp']-time())."</span>";
			} else {
				echo $generator->getTimeFormat($train['eachtime']*$train['amt']);
			}
			echo "</span></td><td class=\"fin\">";
			$time = $generator->procMTime($train['timestamp']);
			if($time[0] != "today") {
				echo "on ".$time[0]." at ";
            }
            echo $time[1];
		} ?>
		</tr><tr class="next"><td colspan="3">The next unit will be finished in <span id="timer2"><?php echo $NextFinished; ?></span></td></tr>
        </tbody></table>
    <?php }
    ?>
	<?php 
include("upgrade.tpl");
?> </p></div>
