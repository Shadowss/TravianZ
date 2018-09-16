<div id="build" class="gid{$villageBuildings[$parameters['id']]['id']}">
	<a href="#" onClick="return Popup({$villageBuildings[$parameters['id']]['id']}, 4);" class="build_logo"> 
		<img class="building g{$villageBuildings[$parameters['id']]['id']}" src="assets/img/x.gif" alt="{$villageBuildings[$parameters['id']]['name']}" title="{$villageBuildings[$parameters['id']]['name']}" />
	</a>
	<h1>{$villageBuildings[$parameters['id']]['name']}
		<span class="level">{$smarty.const.LEVEL} {$villageBuildings[$parameters['id']]['level']}</span>
	</h1>
	<p class="build_desc">{$villageBuildings[$parameters['id']]['desc']}</p>

	{include file={$smarty.const.TEMPLATES_DIR}|cat:'village/buildings/'|cat:$villageBuildings[$parameters['id']]['id']|cat:'.tpl'}

	{include file={$smarty.const.TEMPLATES_DIR}|cat:'village/buildings/upgrade.tpl'}
</div>
