<div id="content" class="village3">
{if $plus}
  {include file={$smarty.const.TEMPLATES_DIR}|cat:'village/dorf3/menu.tpl'}
  {if isset($parameters['s'])}
	{if $parameters['s'] == 2}
	  {include file={$smarty.const.TEMPLATES_DIR}|cat:'village/dorf3/2.tpl'}
	{elseif $parameters['s'] == 3}
	  {include file={$smarty.const.TEMPLATES_DIR}|cat:'village/dorf3/3.tpl'}
	{elseif $parameters['s'] == 4}
	  {include file={$smarty.const.TEMPLATES_DIR}|cat:'village/dorf3/4.tpl'}
	{elseif $parameters['s'] == 5}
	  {include file={$smarty.const.TEMPLATES_DIR}|cat:'village/dorf3/5.tpl'}
	{/if}
  {else}
	{include file={$smarty.const.TEMPLATES_DIR}|cat:'village/dorf3/1.tpl'}
  {/if}
{else}
  {include file={$smarty.const.TEMPLATES_DIR}|cat:'village/dorf3/noplus.tpl'}
{/if}
</div>