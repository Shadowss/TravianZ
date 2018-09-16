{if $units.unitsArray[11]['amount'] > 0 && $showTroops} 
	{assign var='colspan' value=11} 
{else} 
	{assign var='colspan' value=10} 
{/if}

<table class="troop_details" cellpadding="1" cellspacing="1">
	<thead>
		<tr>
			<td class="role">
				<a href="karte.php?d={$units.villageVref}&c={$units.villageMapCheck}">{$units.villageName}</a>
			</td>
			<td colspan="{$colspan}">
				{if !$isMovement && !$isPrisoner}
				<a href="spieler.php?uid={$units.ownerId}">{$unitsText}</a>
				{else}
				<a href="karte.php?d={$units.targetVillageVref}&c={$units.targetVillageMapCheck}">{$unitsText}</a>
				{/if}
			</td>
		</tr>
	</thead>
	<tbody class="units">
		<tr>
			<th>&nbsp;</th> 
			{foreach $units.unitsArray as $index => $unit}
				{if (!$showTroops || $units.unitsArray[11]['amount'] == 0) && $index == 11}
					{continue}
				{/if}
				<td>
					<img src="assets/img/x.gif" class="unit u{if $index != 11}{($units.ownerTribe - 1) * 10 + $index}{else}hero{/if}" title="{$unit.name}" alt="{$unit.name}" />
				</td>
			{/foreach}

		</tr>
		<tr>
			<th>{$smarty.const.TROOPS}</th> 
			
			{foreach $units.unitsArray as $index => $unit}
				{if (!$showTroops || $units.unitsArray[11]['amount'] == 0) && $index == 11}
					{continue}
				{/if}

			<td {if $unit.amount == 0}class="none"{/if}>{$unit.amount}</td>
			{assign var='upkeep' value=$upkeep + $unit.totalUpkeep} {/foreach}

		</tr>
	</tbody>
	<tbody class="infos">
		<tr>
			{if $isMovement}
			<th>{$smarty.const.ARRIVAL}</th>
			<td colspan="{$colspan}">
				<div class="in small">
					<span class="timer">{$units.arrivalTime}</span> {$smarty.const.SHORT_HOURS}
				</div>
				<div class="at">
					{if $units.arrivalDate[0] != 'today'}{$smarty.const.ON} {$units.arrivalDate[0]}{/if}
					{$smarty.const.AT} {$units.arrivalDate[1]} {$smarty.const.HRS}
				</div>
				{if $units.canBeCanceled}
				<div class="abort">
					<a href="build.php?id={$parameters['id']}&cancel={$units.id}">
						<img src="assets/img/x.gif" class="del" />
					</a>
				</div>
				{/if}
			</td>
			{else}
			<th>{$smarty.const.UPKEEP}</th>
			<td colspan="{$colspan}">
				<div class='sup'>{$upkeep}
					<img class="r4" src="assets/img/x.gif" title="{$smarty.const.CROP}" alt="{$smarty.const.CROP}" />{$smarty.const.PER_HR}
				</div>
				{if $canBeSentBack}
					<div class="sback">
						<a href="a2b.php?{$unitsSendBackType}={$units.id}">{$unitsSendBackText}</a>
					</div>
				{/if}
			</td>
			{/if}
		</tr>
	</tbody>
</table>