<div id="content"  class="build">
{if isset($parameters['id'])}
	{if $villageBuildings[$parameters['id']]['id'] == 0}
		{include file={$smarty.const.TEMPLATES_DIR}|cat:'village/buildings/available.tpl'}
	{else}
		{include file={$smarty.const.TEMPLATES_DIR}|cat:'village/buildings/base.tpl'}
	{/if}
{/if}
</div>