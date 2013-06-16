<?php
include('menu.tpl');
?>
<table id="warehouse" cellpadding="1" cellspacing="1">
<thead><tr><th colspan="7">Warehouse</th></tr>
<tr><td>Village</td>
<td><img class="r1" src="img/x.gif" title="Wood" alt="Wood"></td>
<td><img class="r2" src="img/x.gif" title="Clay" alt="Clay"></td>
<td><img class="r3" src="img/x.gif" title="Iron" alt="Iron"></td>
<td><img class="clock" src="img/x.gif" title="Clock" alt="Clock"></td>
<td><img class="r4" src="img/x.gif" title="Crop" alt="Crop"></td>
<td><img class="clock" src="img/x.gif" title="Clock" alt="Clock"></td>
</tr></thead><tbody>
<?php
$varray = $database->getProfileVillages($session->uid);  
$timer = 1;
foreach($varray as $vil){  
	$vid = $vil['wref'];
	$vdata = $database->getVillage($vid);  
	$pop = $vdata['pop'];
	$wood = floor($vdata['wood']);
	$clay = floor($vdata['clay']);
	$iron = floor($vdata['iron']);
	$crop = floor($vdata['crop']);
	$maxs = $vdata['maxstore'];
	$maxc = $vdata['maxcrop'];

	$vresarray = $database->getResourceLevel($vid);
	$prod_wood = $sawmill = 0;
	$prod_clay = $claypit = 0;
	$prod_iron = $foundry = 0;
	$prod_crop = $grainmill = $bakery = 0;
	$woodholder = array();
	$clayholder = array();
	$ironholder = array();
	$cropholder = array();
	for($i=1;$i<=38;$i++) {
		if($vresarray['f'.$i.'t'] == 1) {
			array_push($woodholder,'f'.$i);
		} elseif($vresarray['f'.$i.'t'] == 5) {
			$sawmill = $vresarray['f'.$i];
		} elseif($vresarray['f'.$i.'t'] == 2) {
			array_push($clayholder,'f'.$i);
		} elseif($vresarray['f'.$i.'t'] == 6) {
			$claypit = $vresarray['f'.$i];
		} elseif($vresarray['f'.$i.'t'] == 3) {
			array_push($ironholder,'f'.$i);
		} elseif($vresarray['f'.$i.'t'] == 7) {
			$foundry = $vresarray['f'.$i];
		} elseif($vresarray['f'.$i.'t'] == 4) {
			array_push($cropholder,'f'.$i);
		} elseif($vresarray['f'.$i.'t'] == 8) {
			$grainmill = $vresarray['f'.$i];
		} elseif($vresarray['f'.$i.'t'] == 9) {
			$bakery = $vresarray['f'.$i];
		}
	}
	for($i=0;$i<=count($woodholder)-1;$i++) { $prod_wood+= $bid1[$vresarray[$woodholder[$i]]]['prod']; }
	for($i=0;$i<=count($clayholder)-1;$i++) { $prod_clay+= $bid2[$vresarray[$clayholder[$i]]]['prod']; }
	for($i=0;$i<=count($ironholder)-1;$i++) { $prod_iron+= $bid3[$vresarray[$ironholder[$i]]]['prod']; }
	for($i=0;$i<=count($cropholder)-1;$i++) { $prod_crop+= $bid4[$vresarray[$cropholder[$i]]]['prod']; }
	if($sawmill >= 1) {
		$prod_wood += $prod_wood /100 * $bid5[$sawmill]['attri'];
	}
	if($claypit >= 1) {
		$prod_clay += $prod_clay /100 * $bid6[$claypit]['attri'];
	}
	if($foundry >= 1) {
		$prod_iron += $prod_iron /100 * $bid7[$foundry]['attri'];
	}
	if ($grainmill >= 1 || $bakery >= 1) {
		$prod_crop += $prod_crop /100 * ($bid8[$grainmill]['attri'] + $bid9[$bakery]['attri']);
	}
	$oasisowned = $database->getOasis($vid);
	//more oasis logic required
	if($session->plus) {
		$prod_wood *= 1.25;
		$prod_clay *= 1.25;
		$prod_iron *= 1.25;
		$prod_crop *= 1.25;
	}
	$prod_wood *= SPEED;
	$prod_clay *= SPEED;
	$prod_iron *= SPEED;
	$prod_crop *= SPEED;

	$prod_crop -= $pop;
    $prod_crop -= $technology->getUpkeep($technology->getAllUnits($vid),0);

	$percentW = floor($wood/($maxs/100));
	$percentC = floor($clay/($maxs/100));
	$percentI = floor($iron/($maxs/100));
	$percentCr = floor($crop/($maxc/100));
  
	if($vdata['capital'] == 1) {$class = 'hl';} else {$class = '';}  
	$cr = 95;   //warning percentage
	if($percentW >= $cr) {$critW = 'crit';} else {$critW = '';}
	if($percentC >= $cr) {$critC = 'crit';} else {$critC = '';}
	if($percentI >= $cr) {$critI = 'crit';} else {$critI = '';}
	if($percentCr >= $cr) {$critCR = 'crit';} else {$critCR = '';}
  
	$timerwood = floor(($maxs-$wood)/$prod_wood*3600);
	$timerclay = floor(($maxs-$clay)/$prod_clay*3600);
	$timeriron = floor(($maxs-$iron)/$prod_iron*3600);
	$timer1 = $generator->getTimeFormat(min($timerwood,$timerclay,$timeriron));
	$timer2 = $generator->getTimeFormat(floor(($maxc-$crop)/$prod_crop*3600));
  
	echo '<tr class="'.$class.'">
		<td class="vil fc"><a href="dorf1.php?newdid='.$vid.'">'.$vdata['name'].'</a></td>
		<td class="lum '.$critW.'" title="'.$wood.'/'.$maxs.'">'.$percentW.'%</td> 
		<td class="clay '.$critC.'" title="'.$clay.'/'.$maxs.'">'.$percentC.'%</td>
		<td class="iron '.$critI.'" title="'.$iron.'/'.$maxs.'">'.$percentI.'%</td>
		<td class="max123"><span '.($timer1!="0:00:00"?'id="timer'.$timer.'"':'').'>'.$timer1.'</span></td>';
	if($timer1 != "0:00:00") { $timer++; }  		
	echo '	
		<td class="crop '.$critCR.'" title="'.$crop.'/'.$maxc.'">'.$percentCr.'%</td>
		<td class="max4 lc"><span '.($timer2!="0:00:00"?'id="timer'.$timer.'"':'').'>'.$timer2.'</span></td></tr>';  
	if($timer2 != "0:00:00") { $timer++; }  		
}
?>
</tbody></table>
