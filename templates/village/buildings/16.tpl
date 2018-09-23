{if $villageBuildings[$parameters['id']]['level'] > 0}
	{include file=$smarty.const.TEMPLATES_DIR|cat:'village/buildings/rallyPoint/menu.tpl'}
	{if !isset($parameters['t'])}
		{include file=$smarty.const.TEMPLATES_DIR|cat:'village/buildings/rallyPoint/movements.tpl'}
	{elseif $parameters['t'] == 1}
		{include file=$smarty.const.TEMPLATES_DIR|cat:'village/buildings/rallyPoint/sendUnits.tpl'}
	{elseif $parameters['t'] == 2}
		{include file=$smarty.const.TEMPLATES_DIR|cat:'village/buildings/rallyPoint/simulator.tpl'}
	{elseif $parameters['t'] == 3}
		{include file=$smarty.const.TEMPLATES_DIR|cat:'village/buildings/rallyPoint/goldClub.tpl'}
	{/if}
{else}
	<b>{$smarty.const.RALLYPOINT_COMMENCE}</b><br>
{/if}