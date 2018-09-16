<div id="content" class="activate">
	{if empty($del) and empty($activated)}
		{include file={$smarty.const.TEMPLATES_DIR}|cat:'account/activation/needToActivate.tpl'}
	{elseif !empty($activated)}
		{include file={$smarty.const.TEMPLATES_DIR}|cat:'account/activation/activated.tpl'}
	{else}
		{include file={$smarty.const.TEMPLATES_DIR}|cat:'account/activation/delete.tpl'}
	{/if}
</div>