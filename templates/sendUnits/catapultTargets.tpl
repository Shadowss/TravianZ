{$groupNames = [1 => $smarty.const.RESOURCES, $smarty.const.INFRASTRUCTURE, $smarty.const.MILITARY]}

<select name="ctar{$targetType}" class="dropdown">
	{if $targetType > 1}
		<option value="-1">-</option>
	{/if}

{if !empty($catapultTargetBuildings[0])}
	{foreach $catapultTargetBuildings[0] as $building}
	    <option value="{$building.id}">{$building.name}</option>
	{/foreach}
{/if}

{foreach $groupNames as $type => $groupName}
	{if !empty($catapultTargetBuildings[$type])}
	<optgroup label="{$groupName}">
		{foreach $catapultTargetBuildings[$type] as $building}
			<option value="{$building.id}">{$building.name}</option>
		{/foreach}
	</optgroup>
	{/if}
{/foreach}
</select>
