<?php 
$time = time(); //The actual time
$startDate = strtotime(START_DATE); //When the server has started
$daysToDisplay = 432000 / SPEED; //5 days / SPEED of the server
$spawnTimeArray = ["Artifacts" => ($startDate + NATARS_SPAWN_TIME * 86400) - $time,
				   "WW villages" => ($startDate + NATARS_WW_SPAWN_TIME * 86400) - $time,
				   "WW building plans" => ($startDate + NATARS_WW_BUILDING_PLAN_SPAWN_TIME * 86400) - $time];

foreach($spawnTimeArray as $text => $spawnTime){
	if($spawnTime <= $daysToDisplay && $spawnTime > 0){
?>
<br /><br />
<div>
	<span><b><?php echo $text; ?></b> will spawn in: </span>
	<span id="timer<?php echo ++$session->timer; ?>"><?php echo $generator->getTimeFormat($spawnTime); ?></span>
</div>
<?php }} ?>