{assign var=gidType value=[0 => [0 => 19, 1 => 29], 1 => [0 => 20, 1 => 30], 2 => [0 => 21, 1 => 42]]}
<table id="overview" cellpadding="1" cellspacing="1">
	<thead>
		<tr>
			<th colspan="5">{$smarty.const.OVERVIEW}</th>
		</tr>
		<tr>
			<td>{$smarty.const.VILLAGE}</td>
			<td>{$smarty.const.ATTACKS}</td>
			<td>{$smarty.const.BUILDING}</td>
			<td>{$smarty.const.TROOPS}</td>
			<td>{$smarty.const.MERCHANT}</td>
		</tr>
	</thead>
	<tbody>

{foreach $villages as $village}    
<tr class="{if $village.villageIsCapital}hl{/if}">
	<td class="vil fc">
		<a href="dorf1.php?newdid={$village.villageVref}">{$village.villageName}</a>
	</td>
	<td class="att">
		<a href="build.php?&id=39newdid={$village.villageVref}">
			{if !empty($village.villageMovements['attacks']['village']['to']['amount'])}
				<img class="att1" src="assets/img/x.gif" title="{$village.villageMovements['attacks']['village']['to']['amount']} {$smarty.const.INCOMING_ATTACKS}" alt="{$village.villageMovements['attacks']['village']['to']['amount']} {$smarty.const.INCOMING_ATTACKS}">
			{/if}
			
			{if !empty($village.villageMovements['attacks']['oasis']['to']['amount'])}
				<img class="att3" src="assets/img/x.gif" title="{$village.villageMovements['attacks']['oasis']['to']['amount']} {$smarty.const.INCOMING_OASIS_ATTACKS}" alt="{$village.villageMovements['attacks']['oasis']['to']['amount']} {$smarty.const.INCOMING_OASIS_ATTACKS}">
			{/if}
		</a>
	</td>
	<td class="bui">
		{foreach $village.villageBuildingJobs as $position => $job}
			<a href="build.php?id={$position}&newdid={$village.villageVref}">
				<img class="bau" src="assets/img/x.gif" title="{$job.name}" alt="{$job.name}">
			</a>
		{/foreach}
	</td>
	<td class="tro">
		{foreach $village.villageTotalUnitsInTraining as $type => $unit}
			<a href="build.php?gid={$gidType[$unit.classes.0][$unit.great]}&newdid={$village.villageVref}">
				<img class="unit u{($tribe - 1) * 10 + $type}" src="assets/img/x.gif" title="x{$unit.amount} {$unit.name}" alt="x{$unit.amount} {$unit.name}">
			</a>
		{/foreach}
	</td>
	<td class="tra lc">
		{if $village.villageMerchants['total'] > 0}
			<a href="build.php?gid=17&newdid={$village.villageVref}">{$village.villageMerchants['available']}/{$village.villageMerchants['total']}</a>
		{else}
			0/0
		{/if}
	</td>
</tr>
{/foreach}
</tbody>
</table>
