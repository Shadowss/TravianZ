<div id="content" class="village2">
	<h1>
	{$villageName}
	{if $villageLoyalty < 100}
    	{if $villageLoyalty > 33} 
        	{assign var='color' value='gr'}
    	{else}
        	{assign var='color' value='re'}
		{/if}
		<div id="loyality" class="{$color}">
			{$smarty.const.LOYALTY}: {$villageLoyalty}%
		</div>
	{/if}
	</h1>

	{include file={$smarty.const.TEMPLATES_DIR}|cat:'village/village.tpl'}
	{if !empty($villageBuildingJobs)} {include file={$smarty.const.TEMPLATES_DIR}|cat:'village/building.tpl'} {/if}
</div>