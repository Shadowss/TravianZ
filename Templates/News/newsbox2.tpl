<?php
$textArray = [["Natars Spawn", "WW Spawn", "WW Plan Spawn"], ["Natars Tribe", "WW Village", "Construction Plan"]];
$spawnTimeArray = [NATARS_SPAWN_TIME, NATARS_WW_SPAWN_TIME, NATARS_WW_BUILDING_PLAN_SPAWN_TIME];
$areSpawned = [$database->areArtifactsSpawned(), $database->areWWVillagesSpawned(), $database->areArtifactsSpawned(true)];

?>
<h5><img src="img/en/t2/newsbox2.gif" alt="newsbox 2"></h5>
<div class="news">
<table width="100%">
<?php for($i = 0; $i < count($spawnTimeArray); $i++){ ?>
<tr>
<td><b>
<?php
    if($areSpawned[$i]) echo $textArray[1][$i];
    else echo $textArray[0][$i];
    ?></b></td>
<td><b>: <font color="Red"><?php
    if($areSpawned[$i]) echo "Released";
    else
    {
        $time = strtotime(START_DATE); // Date of server started (the countdown for the appearance of Natars begins)
        $interval = $spawnTimeArray[$i] * 86400; // The number of seconds in the number of days that is set for the appearance of Natars
        echo date('d.m.Y', $time + $interval);
    }
    ?></font></b></td>
</tr>
<?php } ?>
</table>
</div>