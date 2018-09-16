<div id="content" class="village1">
	<h1>
		{$villageName}
		{if $villageLoyalty < 100} 
			{if $villageLoyalty > 33}
				{assign var='color' value='gr'} 
			{else} 
				{assign var='color' value='re'}
			{/if}
			<div id="loyality" class="{$color}">{$smarty.const.LOYALTY}:{$villageLoyalty}%</div>
		{/if}
	</h1>
	<div id="cap" align="left">
		{if $villageIsCapital} <font color=gray>({$smarty.const.VILLAGE_CAPITAL})</font>{/if}
	</div>
	{include file={$smarty.const.TEMPLATES_DIR}|cat:'village/field.tpl'}
	<div id="map_details">
		<br /><br />
		{include file={$smarty.const.TEMPLATES_DIR}|cat:'village/movement.tpl'}
		{include file={$smarty.const.TEMPLATES_DIR}|cat:'village/production.tpl'}
		{include file={$smarty.const.TEMPLATES_DIR}|cat:'village/units.tpl'}
		{if !empty($villageBuildingJobs)}
			{include file={$smarty.const.TEMPLATES_DIR}|cat:'village/building.tpl'}
			<br /><br /><br /><br /><br /><br />
		{/if}
	</div>
</div>