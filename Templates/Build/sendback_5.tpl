<?php
$to = $database->getVillage($enforce['from']);
$fromcoor = $database->getCoor($enforce['from']);
$tocoor = $database->getCoor($enforce['vref']);

	$fromCor = array('x'=>$tocoor['x'], 'y'=>$tocoor['y']);
	$toCor = array('x'=>$fromcoor['x'], 'y'=>$fromcoor['y']);
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
		<td class="line-first column-first large"><img class="unit u41" src="img/x.gif" title="Pikeman" alt="Pikeman"> <input class="text" <?php if ($enforce['u41']<=0) {echo ' disabled="disabled"';}?> name="t1" value="<?php echo $enforce['u41']; ?>" maxlength="6" type="text">
		<?php 
       	echo"<span class=\"none\">(".$enforce['u41'].")</span></td>";

        ?>
		
        <td class="line-first large"><img class="unit u44" src="img/x.gif" title="Bird of Prey" alt="Bird of Prey"> <input class="text" <?php if ($enforce['u44']<=0) {echo ' disabled="disabled"';}?> name="t4" value="<?php echo $enforce['u44']; ?>" maxlength="6" type="text">
		<?php 
       	echo"<span class=\"none\">(".$enforce['u44'].")</span></td>";

        ?>
        <td class="line-first regular"><img class="unit u47" src="img/x.gif" title="War Elephant" alt="War Elephant"> <input class="text" <?php if ($enforce['u47']<=0) {echo ' disabled="disabled"';}?> name="t7" value="<?php echo $enforce['u47']; ?>" maxlength="6" type="text">
		<?php 
       	echo"<span class=\"none\">(".$enforce['u47'].")</span></td>";

        ?>

		
        <td class="line-first column-last small"><img class="unit u49" src="img/x.gif" title="Natarian Emperor" alt="Natarian Emperor"> <input class="text" <?php if ($enforce['u49']<=0) {echo ' disabled="disabled"';}?> name="t9" value="<?php echo $enforce['u49']; ?>" maxlength="6" type="text">
		<?php 
       	echo"<span class=\"none\">(".$enforce['u49'].")</span></td>";

        ?>
	</tr>
	<tr>
		<td class="column-first large"><img class="unit u42" src="img/x.gif" title="Thorned Warrior" alt="Thorned Warrior"> <input class="text" <?php if ($enforce['u42']<=0) {echo ' disabled="disabled"';}?> name="t2" value="<?php echo $enforce['u42']; ?>" maxlength="6" type="text">
		<?php 
       	echo"<span class=\"none\">(".$enforce['u42'].")</span></td>";

        ?>

		<td class="large"><img class="unit u45" src="img/x.gif" title="Axerider" alt="Axerider"> <input class="text" <?php if ($enforce['u45']<=0) {echo ' disabled="disabled"';}?> name="t5" value="<?php echo $enforce['u45']; ?>" maxlength="6" type="text">
		<?php 
       	echo"<span class=\"none\">(".$enforce['u45'].")</span></td>";

        ?>
		<td class="regular"><img class="unit u48" src="img/x.gif" title="Balista" alt="Balista"> <input class="text" <?php if ($enforce['u48']<=0) {echo ' disabled="disabled"';}?> name="t8" value="<?php echo $enforce['u48']; ?>" maxlength="6" type="text">
		<?php 
       	echo"<span class=\"none\">(".$enforce['u48'].")</span></td>";

        ?>
		<td class="column-last small"><img class="unit u40" src="img/x.gif" title="Settler" alt="Settler"> <input class="text" <?php if ($enforce['u50']<=0) {echo ' disabled="disabled"';}?> name="t10" value="<?php echo $enforce['u50']; ?>" maxlength="6" type="text">
		<?php 
       	echo"<span class=\"none\">(".$enforce['u50'].")</span></td>";

        ?>
	</tr>
	<tr>
		<td class="line-last column-first large"><img class="unit u43" src="img/x.gif" title="Guardsman" alt="Guardsman"> <input class="text" <?php if ($enforce['u3']<=0) {echo ' disabled="disabled"';}?> name="t3" value="<?php echo $enforce['u3']; ?>" maxlength="6" type="text">
		<?php 
       	echo"<span class=\"none\">(".$enforce['u3'].")</span></td>";

        ?>
		<td class="line-last large"><img class="unit u46" src="img/x.gif" title="Natarian Knight" alt="Natarian Knight"> <input class="text" <?php if ($enforce['u6']<=0) {echo ' disabled="disabled"';}?> name="t6" value="<?php echo $enforce['u6']; ?>" maxlength="6" type="text">
		<?php 
       	echo"<span class=\"none\">(".$enforce['u6'].")</span></td>";
        ?>
		<td class="line-last regular"></td>
			<td class="line-last column-last"></td>		</tr>
</tbody></table>

<table class="troop_details" cellpadding="1" cellspacing="1">
	<tbody class="infos">
		<tr>
			<th>Arrived:</th>

			<?php
			$att_tribe = $session->tribe;  
            $start = ($att_tribe-1)*10+1;
            $end = ($att_tribe*10);
            $speeds = array();
                //find slowest unit.
                for($i=$start;$i<=$end;$i++)
                {
                    if (isset($enforce['u'.$i]))
                    { 
                        if($enforce['u'.$i]!='' && $enforce['u'.$i]>0)
                        { 
                            //$speeds[] = $unitspeeds[$i-2];
                            $speeds[] = ${'u'.$i}['speed'];
                        }
                    }
                }
				$time = $generator->procDistanceTime($fromCor,$toCor,min($speeds),1);

			?>

			<td colspan="10">
			<div class="in">in <?php echo $generator->getTimeFormat($time); ?></div>
			<div class="at">at <span id="tp2"> <?php echo date("H:i:s",time()+$time)?></span><span> hours</span></div>
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