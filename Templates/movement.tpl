<?php 
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       movement.tpl                                                ##
##  Developed by:  Dzoki                                                       ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################

$aantal=(count($database->getMovement(4,$village->wid,1))+count($database->getMovement(4,$village->wid,0))+count($database->getMovement(3,$village->wid,1))+count($database->getMovement(3,$village->wid,0)));
if($aantal > 0){
	echo	'<table id="movements" cellpadding="1" cellspacing="1"><thead><tr><th colspan="3">'.TROOP_MOVEMENTS.'</th></tr></thead><tbody>';
}

$NextArrival = array();

/* Units coming back from Reinf,attack,raid */
$aantal = count($database->getMovement(4,$village->wid,1));
$aantal2 = $database->getMovement(4,$village->wid,1);
if($aantal > 0){
	foreach($aantal2 as $receive) {
		$action = 'def1';
		$aclass = 'd1';
		$title = ''.ARRIVING_REINF_TROOPS.'';
		$short = ''.ARRIVING_REINF_TROOPS_SHORT.'';
		$NextArrival[] = $receive['endtime'];
	}
	echo '<tr><td class="typ"><a href="build.php?id=39"><img src="img/x.gif" class="'.$action.'" alt="'.$title.'" title="'.$title.'" /></a><span class="'.$aclass.'">&raquo;</span></td>
	<td><div class="mov"><span class="'.$aclass.'">'.$aantal.'&nbsp;'.$short.'</span></div><div class="dur_r">in&nbsp;<span id="timer'.$timer.'">'.$generator->getTimeFormat(min($NextArrival)-time()).'</span>&nbsp;'.HOURS.'</div></div></td></tr>';
	$timer += 1;
}

/* attack/raid on you! */
$aantal = count($database->getMovement(3,$village->wid,1));
$aantal2 = $database->getMovement(3,$village->wid,1);
for($i=0;$i<$aantal;$i++){
	if($aantal2[$i]['attack_type'] == 2) { $aantal -= 1; }
	if($aantal2[$i]['attack_type'] == 1) { $aantal -= 1; }
}
if($aantal > 0){
	if(!empty($NextArrival)) { reset($NextArrival); }
	foreach($aantal2 as $receive) {
		if ($receive['attack_type'] != 2) {
			$action = 'att1';
			$aclass = 'a1';
			$title = ''.OWN_ATTACKING_TROOPS.'';
			$short = ''.ATTACK.'';
			$NextArrival[] = $receive['endtime'];
		}
	}
	echo '<tr><td class="typ"><a href="build.php?id=39"><img src="img/x.gif" class="'.$action.'" alt="'.$title.'" title="'.$title.'" /></a><span class="'.$aclass.'">&raquo;</span></td>
	<td><div class="mov"><span class="'.$aclass.'">'.$aantal.'&nbsp;'.$short.'</span></div><div class="dur_r">in&nbsp;<span id="timer'.$timer.'">'.$generator->getTimeFormat(min($NextArrival)-time()).'</span>&nbsp;'.HOURS.'</div></div></td></tr>';
	$timer += 1;
}

/* on attack, raid */
$aantal = count($database->getMovement(3,$village->wid,0));
$aantal2 = $database->getMovement(3,$village->wid,0);
for($i=0;$i<$aantal;$i++){
	if($aantal2[$i]['attack_type'] == 2) { $aantal -= 1; }
}
if($aantal > 0){
	if(!empty($NextArrival)) { reset($NextArrival); }
		foreach($aantal2 as $receive) {
			if ($receive['attack_type'] != 2) {
				$action = 'att2';
				$aclass = 'a2';
				$title = ''.OWN_ATTACKING_TROOPS.'';
				$short = ''.ATTACK.'';
				$NextArrival[] = $receive['endtime'];
			}
		}
	echo '<tr><td class="typ"><a href="build.php?id=39"><img src="img/x.gif" class="'.$action.'" alt="'.$title.'" title="'.$title.'" /></a><span class="'.$aclass.'">&raquo;</span></td>
	<td><div class="mov"><span class="'.$aclass.'">'.$aantal.'&nbsp;'.$short.'</span></div><div class="dur_r">in&nbsp;<span id="timer'.$timer.'">'.$generator->getTimeFormat(min($NextArrival)-time()).'</span>&nbsp;'.HOURS.'</div></div></td></tr>';
	$timer += 1;
}

/* Units send to reinf. (to other town) */
$aantal = count($database->getMovement(3,$village->wid,0));
$lala=$aantal;
$aantal2 = $database->getMovement(3,$village->wid,0);
for($i=0;$i<$aantal;$i++){
	if(($aantal2[$i]['attack_type']==1) or ($aantal2[$i]['attack_type']==3) or ($aantal2[$i]['attack_type']==4)) { $lala -= 1; }
}
if($lala > 0){
	if(!empty($NextArrival)) { reset($NextArrival); }
		foreach($aantal2 as $receive) {
			if ($receive['attack_type'] == 2) {
				$action = 'def2';
				$aclass = 'd2';
				$title = ''.OWN_REINFORCING_TROOPS.'';
				$short = ''.ARRIVING_REINF_TROOPS_SHORT.'';
				$NextArrival[] = $receive['endtime'];
			}
		}
	echo '<tr><td class="typ"><a href="build.php?id=39"><img src="img/x.gif" class="'.$action.'" alt="'.$title.'" title="'.$title.'" /></a><span class="'.$aclass.'">&raquo;</span></td>
	<td><div class="mov"><span class="'.$aclass.'">'.$lala.'&nbsp;'.$short.'</span></div><div class="dur_r">in&nbsp;<span id="timer'.$timer.'">'.$generator->getTimeFormat(min($NextArrival)-time()).'</span>&nbsp;'.HOURS.'</div></div></td></tr>';
	$timer += 1;
}

/* Units send to reinf. (to my town) */
$aantal = count($database->getMovement(3,$village->wid,1)); $lala=$aantal;
$aantal2 = $database->getMovement(3,$village->wid,1);
for($i=0;$i<$aantal;$i++){
	if(($aantal2[$i]['attack_type']==1) or ($aantal2[$i]['attack_type']==3) or ($aantal2[$i]['attack_type']==4)) { $lala -= 1; }
}
if($lala > 0){
	if(!empty($NextArrival)) { reset($NextArrival); }
		foreach($aantal2 as $receive) {
			if ($receive['attack_type'] == 2) {
				$action = 'def1';
				$aclass = 'd1';
				$title = ''.OWN_REINFORCING_TROOPS.'';
				$short = ''.ARRIVING_REINF_TROOPS_SHORT.'';
				$NextArrival[] = $receive['endtime'];
			}
		}
	echo '<tr><td class="typ"><a href="build.php?id=39"><img src="img/x.gif" class="'.$action.'" alt="'.$title.'" title="'.$title.'" /></a><span class="'.$aclass.'">&raquo;</span></td>
	<td><div class="mov"><span class="'.$aclass.'">'.$lala.'&nbsp;'.$short.'</span></div><div class="dur_r">in&nbsp;<span id="timer'.$timer.'">'.$generator->getTimeFormat(min($NextArrival)-time()).'</span>&nbsp;'.HOURS.'</div></div></td></tr>';
	$timer += 1;
}

/* Units coming back from ATTACK 
$gettroops = $database->getMovement(3,$village->wid,1);
for($i=0;$i<count($gettroops);$i++){
	if($gettroops[$i]['attack_type'] == 1) { unset($gettroops[$i]); }
}
$aantal2 = array_values($gettroops);
$aantal = count($aantal2);
if($aantal > 0){
	if(!empty($NextArrival)) { reset($NextArrival); }
		foreach($aantal2 as $receive) {
			$action = 'att1';
			$aclass = 'a1';
			$title = 'Incoming troops';
			$short = 'Attack';
			$NextArrival[] = $receive['endtime'];
		}
	echo '<tr><td class="typ"><a href="build.php?id=39"><img src="img/x.gif" class="'.$action.'" alt="'.$title.'" title="'.$title.'" /></a><span class="'.$aclass.'">&laquo;</span></td>
	<td><div class="mov"><span class="'.$aclass.'">'.$aantal.'&nbsp;'.$short.'</span></div><div class="dur_r">in&nbsp;<span id="timer'.$timer.'">'.$generator->getTimeFormat(min($NextArrival)-time()).'</span>&nbsp;'.HOURS.'</div></div></td></tr>';
	$timer += 1;
}
?>
</tbody></table>
*/