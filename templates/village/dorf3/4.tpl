<table id="culture_points" cellpadding="1" cellspacing="1">
	<thead>
		<tr>
			<th colspan="5">{$smarty.const.CULTURE_POINTS}</th>
		</tr>
		<tr>
			<td>{$smarty.const.VILLAGE}</td>
			<td>{$smarty.const.CULTURE_POINT}/{$smarty.const.DAY}</td>
			<td>{$smarty.const.CELEBRATIONS}</td>
			<td>{$smarty.const.TROOPS}</td>
			<td>{$smarty.const.SLOTS}</td>
		</tr>
	</thead>
	<tbody>

{foreach $villages as $village}    
	{assign var=totalCPs value=$totalCPs + $village.villageCulturePoints}
    <tr class="{if $village.villageIsCapital}hl{/if}">
    	<td class="vil fc">
    		<a href="dorf1.php?newdid={$village.villageVref}">{$village.villageName}</a>
    </td>
    <td class="cps">{$village.villageCulturePoints}</td>
    <td class="cel">
    {if $village.villageIsTownHallBuilt}
    	<a href="build.php?newdid={$village.villageVref}&amp;gid=24">
    	{if $village.villageIsCelebrating}
    		<span class="timer">{$village.villageCelebrationTime}</span>
    		{assign var=totalCelebration value=$totalCelebration + 1}
    	{else}
    		●
    	{/if}
    	</a>
    {else}
    	{if $village.villageIsCelebrating}
    		<span class="timer">{$village.villageCelebrationTime}</span>
    		{assign var=totalCelebration value=$totalCelebration + 1}
    	{/if}
    {/if}
    </td>
    <td class="tro">
    	<span>
    		{assign var=totalSenators value=$totalSenators + $village.villageTotalUnits[9]}
    		{assign var=totalSettlers value=$totalSettlers + $village.villageTotalUnits[10]}
    		{for $i = 1 to $village.villageTotalUnits[9]}
    			<img src=assets/img/un/u/{$tribe * 10 - 1}.gif />
    		{/for}
    		{for $i = 1 to $village.villageTotalUnits[10]}
    			<img src=assets/img/un/u/{$tribe}0.gif />
    		{/for}
    	</span>
    </td>
    <td class="slo lc">
    	{$village.villageSlots['used']}/{$village.villageSlots['available']}
    	{assign var=totalUsedSlots value=$totalUsedSlots + $village.villageSlots['used']}
    	{assign var=totalAvailableSlots value=$totalAvailableSlots + $village.villageSlots['available']}
    </td>
    </tr>
{/foreach}
		<tr>
			<td colspan="5" class="empty"></td>
		</tr>

		<tr class="sum">
			<th class="vil">{$smarty.const.SUM}</th>
			<td class="cps">{$totalCPs}</td>
			<td class="cel">{$totalCelebration}</td>
			<td class="tro">
				{if $totalSenators > 0}
					{$totalSenators} <img src=assets/img/un/u/{$tribe * 10 - 1}.gif />
				{/if}
				&nbsp;
				{if $totalSettlers > 0}
					{$totalSettlers} <img src=assets/img/un/u/{$tribe}0.gif />
				{/if}
			</td>
			<td class="slo">{$totalUsedSlots}/{$totalAvailableSlots}</td>
		</tr>
	</tbody>
</table>
