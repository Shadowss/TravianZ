<?php
$to = $database->getVillage($enforce['from']);
$fromcoor = $database->getCoor($enforce['from']);
$tocoor = $database->getCoor($enforce['vref']);

$att_tribe = $database->getUserField($to['owner'],'tribe',0);
$start = ($att_tribe - 1) * 10 + 1;
$end = $att_tribe * 10;
?>

<h1>Send units back</h1>			

<form method="POST" name="snd" action="a2b.php">

			<table id="short_info" cellpadding="1" cellspacing="1">

				<tbody>

					<tr>

						<th>Destination:</th>

						<td><a href="karte.php?d=<?php echo $generator->getBaseID($fromcoor['x'],$fromcoor['y']); ?>&amp;c=<?php echo $generator->getMapCheck($generator->getBaseID($fromcoor['x'],$fromcoor['y'])); ?>"><?php echo $to['name']; ?> (<?php echo $fromcoor['x']; ?>|<?php echo $fromcoor['y']; ?>)</a></td>

					</tr>

					<tr>

						<th>Owner:</th>

						<td><a href="spieler.php?uid=<?php echo $to['owner']; ?>"><?php echo $database->getUserField($to['owner'],'username',0); ?></a></td>

					</tr>

				</tbody>

			</table>




<table class="troop_details" cellpadding="1" cellspacing="1">
	<thead>
		<tr>
		<td colspan="10">Send units back to <?php echo $to['name']; ?></td>
		</tr>
	</thead>
</table>
		<table id="troops" cellpadding="1" cellspacing="1">
	<tbody><tr>
		<td class="line-first column-first large"><img class="unit u<?php echo $start; ?>" src="img/x.gif" title="<?php echo $technology->getUnitName($start); ?>" alt="<?php echo $technology->getUnitName($start); ?>"> <input class="text" <?php if ($enforce['u'.$start] <= 0) {echo ' disabled="disabled"';}?> name="t1" value="<?php echo $enforce['u'.$start]; ?>" maxlength="6" type="text">
		<?php 
       	echo"<span class=\"none\">(".$enforce['u'.$start].")</span></td>";

        ?>
		
        <td class="line-first large"><img class="unit u<?php echo $start + 3; ?>" src="img/x.gif" title="<?php echo $technology->getUnitName($start + 3); ?>" alt="<?php echo $technology->getUnitName($start + 3); ?>"> <input class="text" <?php if ($enforce['u'.($start + 3)] <= 0) {echo ' disabled="disabled"';}?> name="t4" value="<?php echo $enforce['u'.($start + 3)]; ?>" maxlength="6" type="text">
		<?php 
		echo"<span class=\"none\">(".$enforce['u'.($start + 3)].")</span></td>";

        ?>
        <td class="line-first regular"><img class="unit u<?php echo $start + 6; ?>" src="img/x.gif" title="<?php echo $technology->getUnitName($start + 6); ?>" alt="<?php echo $technology->getUnitName($start + 6); ?>"> <input class="text" <?php if ($enforce['u'.($start + 6)] <= 0) {echo ' disabled="disabled"';}?> name="t7" value="<?php echo $enforce['u'.($start + 6)]; ?>" maxlength="6" type="text">
		<?php 
		echo"<span class=\"none\">(".$enforce['u'.($start + 6)].")</span></td>";

        ?>

		
        <td class="line-first column-last small"><img class="unit u<?php echo $start + 8; ?>" src="img/x.gif" title="<?php echo $technology->getUnitName($start + 8); ?>" alt="<?php echo $technology->getUnitName($start + 8); ?>"> <input class="text" <?php if ($enforce['u'.($start + 8)] <= 0) {echo ' disabled="disabled"';}?> name="t9" value="<?php echo $enforce['u'.($start + 8)]; ?>" maxlength="6" type="text">
		<?php 
		echo"<span class=\"none\">(".$enforce['u'.($start + 8)].")</span></td>";

        ?>
	</tr>
	<tr>
		<td class="column-first large"><img class="unit u<?php echo $start + 1; ?>" src="img/x.gif" title="<?php echo $technology->getUnitName($start + 1); ?>" alt="<?php echo $technology->getUnitName($start + 1); ?>"> <input class="text" <?php if ($enforce['u'.($start + 1)] <= 0) {echo ' disabled="disabled"';}?> name="t2" value="<?php echo $enforce['u'.($start + 1)]; ?>" maxlength="6" type="text">
		<?php 
		echo"<span class=\"none\">(".$enforce['u'.($start + 1)].")</span></td>";

        ?>

		<td class="large"><img class="unit u<?php echo $start + 4; ?>" src="img/x.gif" title="<?php echo $technology->getUnitName($start + 4); ?>" alt="<?php echo $technology->getUnitName($start + 4); ?>"> <input class="text" <?php if ($enforce['u'.($start + 4)] <= 0) {echo ' disabled="disabled"';}?> name="t5" value="<?php echo $enforce['u'.($start + 4)]; ?>" maxlength="6" type="text">
		<?php 
		echo"<span class=\"none\">(".$enforce['u'.($start + 4)].")</span></td>";

        ?>
		<td class="regular"><img class="unit u<?php echo $start + 7; ?>" src="img/x.gif" title="<?php echo $technology->getUnitName($start + 7); ?>" alt="<?php echo $technology->getUnitName($start + 7); ?>"> <input class="text" <?php if ($enforce['u'.($start + 7)] <= 0) {echo ' disabled="disabled"';}?> name="t8" value="<?php echo $enforce['u'.($start + 7)]; ?>" maxlength="6" type="text">
		<?php 
		echo"<span class=\"none\">(".$enforce['u'.($start + 7)].")</span></td>";

        ?>
		<td class="column-last small"><img class="unit u<?php echo $start + 9; ?>" src="img/x.gif" title="<?php echo $technology->getUnitName($start + 9); ?>" alt="<?php echo $technology->getUnitName($start + 9); ?>"> <input class="text" <?php if ($enforce['u'.($start + 9)] <= 0) {echo ' disabled="disabled"';}?> name="t10" value="<?php echo $enforce['u'.($start + 9)]; ?>" maxlength="6" type="text">
		<?php 
		echo"<span class=\"none\">(".$enforce['u'.($start + 9)].")</span></td>";

        ?>
	</tr>
	<tr>
		<td class="line-last column-first large"><img class="unit u<?php echo $start + 2; ?>" src="img/x.gif" title="<?php echo $technology->getUnitName($start + 2); ?>" alt="<?php echo $technology->getUnitName($start + 2); ?>"> <input class="text" <?php if ($enforce['u'.($start + 2)] <= 0) {echo ' disabled="disabled"';}?> name="t3" value="<?php echo $enforce['u'.($start + 2)]; ?>" maxlength="6" type="text">
		<?php 
		echo"<span class=\"none\">(".$enforce['u'.($start + 2)].")</span></td>";

        ?>
		<td class="line-last large"><img class="unit u<?php echo $start + 5; ?>" src="img/x.gif" title="<?php echo $technology->getUnitName($start + 5); ?>" alt="<?php echo $technology->getUnitName($start + 5); ?>"> <input class="text" <?php if ($enforce['u'.($start + 5)] <= 0) {echo ' disabled="disabled"';}?> name="t6" value="<?php echo $enforce['u'.($start + 5)]; ?>" maxlength="6" type="text">
		<?php 
		echo"<span class=\"none\">(".$enforce['u'.($start + 5)].")</span></td>";
		if($enforce['hero']>0){
        ?>
		<td class="line-last large"><img class="unit uhero" src="img/x.gif" title="Hero" alt="Hero"> <input class="text" name="t11" value="<?php echo $enforce['hero']; ?>" maxlength="6" type="text">
		<?php 
       	echo"<span class=\"none\">(".$enforce['hero'].")</span></td>";
		}
        ?>
		<td class="line-last regular"></td>
			<td class="line-last column-last"></td>		</tr>
</tbody></table>

<table class="troop_details" cellpadding="1" cellspacing="1">
	<tbody class="infos">
		<tr>
			<th>Arrived:</th>

			<?php
			$troopsTime = $units->getWalkingTroopsTime($enforce['from'], $enforce['vref'], $to['owner'], $att_tribe, $enforce, 1);
			$time = $database->getArtifactsValueInfluence($session->uid, $village->wid, 2, $troopsTime);
			?>

			<td colspan="10">
			<div class="in">in <?php echo $generator->getTimeFormat($time); ?></div>
			<div class="at">at <span id="tp2"> <?php echo date("H:i:s",time() + $time)?></span><span> hours</span></div>
			</td>
		</tr>
	</tbody>
</table>


<input name="ckey" value="<?php echo $ckey; ?>" type="hidden"> 
<input name="id" value="39" type="hidden"> 
<input name="a" value="533374" type="hidden">
<input name="c" value="8" type="hidden">


<p class="btn"><input value="ok" name="s1" id="btn_ok" class="dynamic_img " src="img/x.gif" alt="OK" type="image" onclick="if (this.disabled==false) {document.getElementsByTagName('form')[0].submit();} this.disabled=true;" onLoad="this.disabled=false;"></p>

</form>
</div>
