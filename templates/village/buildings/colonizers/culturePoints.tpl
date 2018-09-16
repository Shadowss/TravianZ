<p>{$smarty.const.RESIDENCE_CULTURE_DESC}</p>

<table cellpadding="1" cellspacing="1" id="build_value">
	<tr>
		<th>{$smarty.const.PRODUCTION_POINTS}</th>
	{if !$villageIsNatar}
	<td>
		<b>{$villageCulturePoints}</b> {$smarty.const.POINTS_DAY}
	</td>
    {else}
	<td>
		<b>0</b> {$smarty.const.POINTS_DAY}
	</td>
    {/if}
</tr>
	<tr>
		<th>{$smarty.const.PRODUCTION_ALL_POINTS}</th>
		<td>
			<b>{$totalCulturePointsProduction}</b> {$smarty.const.POINTS_DAY}
		</td>
	</tr>
</table>
<p>{$smarty.const.VILLAGES_PRODUCED} <b>{$totalCulturePoints}</b> {$smarty.const.POINTS_NEED} <b>
{$nextVillageCulturePoints}</b> {$smarty.const.POINTS}.</p>
