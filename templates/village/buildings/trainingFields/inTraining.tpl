{if !empty($villageUnitsInTraining[$villageUnitsToTrainClass][$villageUnitsToTrainGreat])}
    <table cellpadding="1" cellspacing="1" class="under_progress">
	<thead>
		<tr>
			<td>{$smarty.const.TRAINING}</td>
			<td>{$smarty.const.DURATION}</td>
			<td>{$smarty.const.FINISHED}</td>
		</tr>
	</thead>
	<tbody>
		{assign var=trainingCount value=count($villageUnitsInTraining[$villageUnitsToTrainClass][$villageUnitsToTrainGreat])}
		{foreach $villageUnitsInTraining[$villageUnitsToTrainClass][$villageUnitsToTrainGreat] as $unit}
		{assign var=i value=$i + 1}
			<tr>
				<td class="desc">
				<img class="unit u{if $unit.type == 12}99{else}{($tribe - 1) * 10 + $unit.type}{/if}" src="assets/img/x.gif" alt="{$unit.name}" title="{$unit.name}" />
					{$unit.amount} {$unit.name}
				</td>
				<td class="dur">
					<span {if !isset($nextFinished)}{assign var=nextFinished value=$unit.nextFinished}class="timer"{/if}>
						{$unit.duration}
					</span>
				</td>
				<td class="fin">
					{if $unit.finishTime[0] != 'today'}
						{$smarty.const.AT} {$unit.finishTime[0]} {$smarty.const.ON}
					{/if}
					{$unit.finishTime[1]}
				</td>
			</tr>
		{/foreach}
		<tr class="next">
			<td colspan="3">
				{$smarty.const.UNIT_FINISHED}
				<span class="timer">{$nextFinished}</span>
			</td>
		</tr>
	</tbody>
</table>
{/if}