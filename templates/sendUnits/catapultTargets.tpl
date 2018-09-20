{$groupNames = [$smarty.const.RESOURCES, $smarty.const.INFRASTRUCTURE, $smarty.const.MILITARY]}

<select name="{$targetName}" class="dropdown">
	{if $randomTargetValue < 0}
		<option value="{$randomTargetValue + 1}">-</option>
	{/if}
	<option value="{$randomTargetValue}">{$smarty.const.RANDOM}</option>
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