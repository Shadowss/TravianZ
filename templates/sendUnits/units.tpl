<table id="troops" cellpadding="1" cellspacing="1">
	<tbody>
	{$quantity = [[1, 4, 7 ,9], [2, 5, 8 ,10], [3, 6, 11]]}
	{$quantityCount = count($quantity) - 1}
	{$class = [
		1 => 'line-first column-first large', 
		4 => 'line-first large',
		7 => 'line-first regular',
		9 => 'line-first column-last small',
		2 => 'column-first large',
		5 => 'large',
		8 => 'regular',
		10 => 'column-last small',
		3 => 'line-last column-first large',
		6 => 'line-last large',
		11 => 'line-last regular'
	]}

	{for $i = 0 to $quantityCount}
		<tr>
		{for $j = 0 to count($quantity[$i]) - 1}
		{$type = $quantity[$i][$j]}
			{if $type == 11 && $villagePresentUnits.unitsArray[$type].amount == 0}
				{continue}
			{/if}
			<td class="{$class[$type]}">
			<img class="unit u{if $type <= 10}{($tribe - 1) * 10 + $type}{else}hero{/if}" src="assets/img/x.gif" onclick="document.getElementsByName('units[{$type}]')[0].value=''; return false;" title="{if $type <= 10}{$villagePresentUnits.unitsArray[$type].name}{else}{$smarty.const.U0}{/if}" alt="{if $type <= 10}{$villagePresentUnits.unitsArray[$type].name}{else}{$smarty.const.U0}{/if}">
			<input class="text" {if $villagePresentUnits.unitsArray[$type].amount == 0}disabled="disabled"{/if} name="units[{$type}]" maxlength="6" type="text" {if $units[$type] > 0}value="{$units[$type]}"{/if}>
				{if $villagePresentUnits.unitsArray[$type].amount > 0}
       				<a href="#" onclick="document.getElementsByName('units[{$type}]')[0].value={$villagePresentUnits.unitsArray[$type].amount}; return false;">({$villagePresentUnits.unitsArray[$type].amount})</a>
				{else}
    				<span class="none">(0)</span>
    			{/if}
    		</td>
		{/for}
		</tr>
	{/for}
	</tbody>
</table>
