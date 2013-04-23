<?php
include("next.tpl");
?>
<div id="build" class="gid36"><h1>Trapper <span class="level">Level <?php echo $village->resarray['f'.$id]; ?></span></h1>
<p class="build_desc">
	<a href="#" onClick="return Popup(36,4, 'gid');"
		class="build_logo"> <img
		class="building g36"
		src="img/x.gif" alt="Trapper"
		title="Trapper" /> </a>
	The trapper protects your village with well hidden traps. This means that unwary enemies can be imprisoned and won't be able to harm your village anymore. </p>

<table cellpadding="1" cellspacing="1" id="build_value">
	<tr>
		<th>Currect maximum traps to train:</th>

		<td><b><?php echo $bid36[$village->resarray['f'.$id]]['attri']*TRAPPER_CAPACITY; ?></b> Traps</td>
	</tr>
	<tr>
	<?php 
        if(!$building->isMax($village->resarray['f'.$id.'t'],$id)) {
		$next = $village->resarray['f'.$id]+1+$loopsame+$doublebuild+$master;
		if($next<=20){
        ?>
		<th>Maximum traps to train at level <?php echo $next; ?>:</th>
		<td><b><?php echo $bid36[$next]['attri']*TRAPPER_CAPACITY; ?></b> Traps</td>
        <?php
            }else{
		?>
		<th>Maximum traps to train at level 20:</th>
		<td><b><?php echo $bid36[20]['attri']*TRAPPER_CAPACITY; ?></b> Traps</td>
		<?php
			}
			}
        ?>

	</tr>
</table>
<p>Your currently have <b><?php echo $village->unitarray['u99']; ?></b> traps, <b><?php echo $village->unitarray['u99o']; ?></b> of which are occupied.</p>
<?php if ($building->getTypeLevel(36) > 0) { ?>
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

		<tr>
			<td class="desc">
			<div class="tit"><img class="unit u99" src="img/x.gif"
				alt="Trap"
				title="Trap" /> <a href="#"
				onClick="return Popup(36,4,'gid');">Trap</a> <span class="info">(Available: <?php echo $village->unitarray['u99']; ?>)</span>
			</div>
			<div class="details">
			<span><img class="r1" src="img/x.gif"
				alt="Lumber" title="Lumber" />20|</span><span><img class="r2" src="img/x.gif"
				alt="Clay" title="Clay" />30|</span><span><img class="r3" src="img/x.gif"
				alt="Iron" title="Iron" />10|</span><span><img class="r4" src="img/x.gif"
				alt="Crop" title="Crop" />20|</span><span><img class="r5" src="img/x.gif" alt="Crop consumption"
				title="Crop consumption" />0|<img class="clock" src="img/x.gif"
				alt="Duration" title="Duration" /><?php $dur=$generator->getTimeFormat(round(${'u99'}['time'] * ($bid19[$village->resarray['f'.$id]]['attri']*TRAPPER_CAPACITY / 100) / SPEED)); 
				echo ($dur=="0:00:00")? "0:00:01":$dur; ?></span>

			</div>
			</td>
			<?php
			$trainlist = $technology->getTrainingList(8);
			foreach($trainlist as $train) {
			$train_amt += $train['amt'];
			}
			
			$max = $technology->maxUnit(99,false);
			$max1 = 0;
			for($i=19;$i<41;$i++){
			if($village->resarray['f'.$i.'t'] == 36){
			$max1 += $bid36[$village->resarray['f'.$i]]['attri']*TRAPPER_CAPACITY;
			}
			}
			if($max > $max1 - ($village->unitarray['u99'] + $train_amt)){
			$max = $max1 - ($village->unitarray['u99'] + $train_amt);
			}
			if($max < 0){
			$max = 0;
			}
			?>
			<td class="val"><input type="text" class="text" name="t99" value="0" maxlength="4"></td>
			<td class="max"><a href="#" onClick="document.snd.t99.value=<?php echo $max; ?>">(<?php echo $max; ?>)</a></td>
		</tr>
	</tbody>
</table>
	<p><input type="image" id="btn_train" class="dynamic_img" value="ok" name="s1" src="img/x.gif" alt="train" onclick="this.disabled=true;this.form.submit();"/></p></form>
	<?php
	} else {
		echo "<b>Training can commence when trapper are completed.</b><br>\n";
	}
    if(count($trainlist) > 0) {
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
			echo "<img class=\"unit u".$train['unit']."\" src=\"img/x.gif\" alt=\"".U99."\" title=\"".U99."\" />";
			echo $train['amt']." ".U99."</td><td class=\"dur\">";
			if ($TrainCount == 1 ) {
				$NextFinished = $generator->getTimeFormat(($train['timestamp']-time())-($train['amt']-1)*$train['eachtime']);
				echo "<span id=timer1>".$generator->getTimeFormat($train['timestamp']-time())."</span>";
			} else {
				echo $generator->getTimeFormat($train['eachtime']*$train['amt']);
			}
			echo "</td><td class=\"fin\">";
			$time = $generator->procMTime($train['timestamp']);
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