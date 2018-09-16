<table cellpadding="1" cellspacing="1" id="build_value">
	<tr>
		<th>{$bonusTexts[0]}:</th>
		<td><b>{$villageBuildings[$parameters['id']]['bonus']}</b> {$bonusTexts[2]}</td>
	</tr>

    {if !$villageBuildingToUpgrade['isMax']}	
	<tr>
		<th>{$bonusTexts[1]} {$villageBuildingToUpgrade['level']}:</th>
		<td><b>{$villageBuildingToUpgrade['bonus']} </b> {$bonusTexts[2]}</td>
	</tr>
	{/if}
</table>