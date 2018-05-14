<h5><img src="img/en/t2/newsbox2.gif" alt="newsbox 2"></h5>
<div class="news">
<table width="100%">
<tr>
<td><b>Natars spawn</b></td>
<td><b>: <font color="Red"><?php
    $time = strtotime(START_DATE); // Date of server installation (the countdown for the appearance of Natars begins)
    $interval = NATARS_SPAWN_TIME * 24 * 3600; // The number of seconds in the number of days that is set for the appearance of Natars
    $time += $interval;
    echo date('m/d/Y', $time); ?></font></b></td>
</tr>
<tr>
<td><b>WW spawn</b></td>
<td><b>: <font color="Red"><?php
    $time = strtotime(START_DATE); // Date of server installation (the countdown for the appearance of Natars begins)
    $interval = NATARS_WW_SPAWN_TIME * 24 * 3600; // The number of seconds in the number of days that is set for the appearance of WW village
    $time += $interval;
    echo date('m/d/Y', $time); ?></font></b></td>
</tr>
<tr>
<td><b>WW Plan spawn</b></td>
<td><b>: <font color="Red"><?php
    $time = strtotime(START_DATE); // Date of server installation (the countdown for the appearance of Natars begins)
    $interval = NATARS_WW_BUILDING_PLAN_SPAWN_TIME * 24 * 3600; // The number of seconds in the number of days that is set for the appearance of Ancient Construction Plan
    $time += $interval;
    echo date('m/d/Y', $time); ?></font></b></td>
</tr>
</table>
</div>
