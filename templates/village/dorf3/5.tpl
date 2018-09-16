<table id="troops" cellpadding="1" cellspacing="1">
	<thead>
		<tr>
			<th colspan="12">{$smarty.const.OWN_TROOPS}</th>
		</tr>
		<tr>
			<td>{$smarty.const.VILLAGE}</td>

		{for $i = ($tribe - 1) * 10 + 1 to ($tribe * 10)}
    		<td>
    			<img class="unit u{$i}" src="assets/img/x.gif">
    		</td>
		{/for}

			<td>
				<img class="unit uhero" src="assets/img/x.gif">
			</td>
		</tr>
	</thead>
	<tbody>

	{foreach $villages as $village}
    	<tr class="{if $village.villageIsCapital}hl{/if}">
    		<td class="vil fc">
    			<a href="dorf1.php?newdid={$village.villageVref}">{$village.villageName}</a>
    		</td>
    		{for $i = 1 to 10}
    			<td class="{if $village.villageTotalUnits[$i] == 0}none{/if}">{$village.villageTotalUnits[$i]}</td>
				{assign var="totalUnits{$i}" value=$totalUnits{$i} + $village.villageTotalUnits[$i]}
			{/for}
    		<td class="{if $village.villageTotalUnits[11] == 0}none{/if}">
    			{if $village.villageTotalUnits[11] == 0}
    				0
    			{else}
    				{$village.villageTotalUnits[11]}
    			{/if}
    		</td>
    		{assign var=totalUnits11 value=$totalUnits11 + $village.villageTotalUnits[11]}
    	</tr>
	{/foreach}
		<tr>
			<td class="empty" colspan="12"></td>
		</tr>
		<tr>
			<th>{$smarty.const.SUM}</th>
			{for $i = 1 to 10}
    			<td class="{if $totalUnits{$i} == 0}none{/if}">{$totalUnits{$i}}</td>
			{/for}
			<td class="{if $totalUnits11 == 0}none{/if}">
				{if $totalUnits11 == 0}
					0
				{else}
					{$totalUnits11}
				{/if}
			</td>
		</tr>
	</tbody>
</table>