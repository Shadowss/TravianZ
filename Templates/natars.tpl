<?php 
$time = time();
$artifactsSpawn = (COMMENCE + NATARS_SPAWN_TIME * 86400) - $time;
$wwSpawn = (COMMENCE + NATARS_WW_SPAWN_TIME * 86400) - $time;
$wwBuildingPlansSpawn = (COMMENCE + NATARS_WW_BUILDING_PLAN_SPAWN_TIME * 86400) - $time;
$daysToDisplay = 432000 / SPEED; //5 days / SPEED of the server

if($artifactsSpawn <= $daysToDisplay && $artifactsSpawn > 0){
?>
<br /><br />
<div>
	<span><b>Artifacts</b> will spawn in: </span>
	<span id="timer<?php echo ++$session->timer; ?>"><?php echo $generator->getTimeFormat($artifactsSpawn); ?></span>
</div>
<?php } 

if($wwSpawn <= $daysToDisplay && $wwSpawn > 0){
?>
<br /><br />
<div>
	<span><b>WW villages</b> will spawn in: </span>
	<span id="timer<?php echo ++$session->timer; ?>"><?php echo $generator->getTimeFormat($wwSpawn); ?></span>
</div>
<?php }

if($wwBuildingPlansSpawn <= $daysToDisplay && $wwBuildingPlansSpawn > 0){ ?>
<br /><br />
<div>
	<span><b>WW building plans</b> will spawn in: </span>
	<span id="timer<?php echo ++$session->timer; ?>"><?php echo $generator->getTimeFormat($wwBuildingPlansSpawn); ?></span>
</div>
<?php } ?>