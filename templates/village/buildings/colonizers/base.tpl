{include file={$smarty.const.TEMPLATES_DIR}|cat:'/village/buildings/colonizers/menu.tpl'}

{if !isset($parameters['s'])}
	{include file={$smarty.const.TEMPLATES_DIR}|cat:'/village/buildings/colonizers/train.tpl'}
{elseif $parameters['s'] == 1}
	{include file={$smarty.const.TEMPLATES_DIR}|cat:'/village/buildings/colonizers/culturePoints.tpl'}
{elseif $parameters['s'] == 2}
	{include file={$smarty.const.TEMPLATES_DIR}|cat:'/village/buildings/colonizers/loyalty.tpl'}
{elseif $parameters['s'] == 3}
	{include file={$smarty.const.TEMPLATES_DIR}|cat:'/village/buildings/colonizers/expansion.tpl'}
{/if}
